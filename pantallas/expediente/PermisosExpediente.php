<?php
namespace pantallas\expediente;

class PermisosExpediente {

    private $idexpediente;

    private $idfuncionario;

    private $expediente;

    private $funcionario;

    const FUNCIONARIO = 1;

    const DEPENDENCIA = 2;

    const CARGO = 4;

    const ROL = 4;

    const PERMISO_EXP_LEER = "l";

    const PERMISO_EXP_MODIFICAR = "m";

    const PERMISO_EXP_ELIMINAR = "e";

    const PERMISO_EXP_COMPARTIR = "p";

    const PERMISO_EXP_ESCRIBIR = "w";

    const PERMISO_SER_LEER = "l";

    const PERMISO_SER_ADICIONAR = "a";

    const PERMISO_SER_ELIMINAR = "e";

    const PERMISO_SER_MODIFICAR = "m";

    const PERMISO_SER_VINCULAR = "v";

    private $permisos_serie = array();

    private $permisos_expediente = array();

    private $propietario = false;

    public function __construct($conn, $idexpediente, $idfuncionario = null) {
        $this->idexpediente = $idexpediente;
        $this->idfuncionario = $idfuncionario;
        $this->conn = $conn;
        $this->init();
    }

    public function obtener_permisos() {
        $permisos = array();
        if ($this->funcionario->funcionario_codigo == $this->expediente->propietario) {
            $this->propietario = true;
            $permisos[] = self::PERMISO_EXP_MODIFICAR;
            $permisos[] = self::PERMISO_EXP_LEER;
            $permisos[] = self::PERMISO_EXP_COMPARTIR;
            $permisos[] = self::PERMISO_EXP_ELIMINAR;
            $permisos[] = self::PERMISO_EXP_ESCRIBIR;
            $this->permisos_expediente = $permisos;
        } else {
            $permisos = array_merge($this->consultar_permisos_funcionario(), $this->consultar_permisos_dependencia(), $this->consultar_permisos_cargo(), $this->consultar_permisos_rol());
            $permisos = array_unique($permisos);
        }
        return $permisos;
    }

    private function init() {
        if (empty($this->idfuncionario)) {
            $this->idfuncionario = usuario_actual('idfuncionario');
        }
        $expediente = busca_filtro_tabla("", "expediente", "idexpediente = {$this->idexpediente}", "", $this->conn);
        if ($expediente["numcampos"]) {
            $this->expediente = new \stdClass();
            foreach ($expediente[0] as $name => $value) {
                if (!is_int($name) && !empty($name)) {
                    $this->expediente->$name = $value;
                }
            }
        } else {
            throw new \Exception("No existe el expediente: {$this->idexpediente}");
        }

        $funcionario = busca_filtro_tabla("idfuncionario, funcionario_codigo, login, iddependencia, idcargo, iddependencia_cargo, estado_dc, estado_dep", "vfuncionario_dc", "estado = 1 and estado_dc=1 and idfuncionario = {$this->idfuncionario}", "", $this->conn);
        if ($funcionario["numcampos"]) {
            $this->funcionario = new \stdClass();
            foreach ($funcionario[0] as $name => $value) {
                if (!is_int($name) && !empty($name)) {
                    $this->funcionario->$name = $value;
                }
            }
            $cargos = array();
            $dependencias = array();
			$roles = array();
            for($i=0;$i<$funcionario["numcampos"];$i++){
            	if($funcionario[$i]["estado_dc"]){
            		$roles[]=$funcionario[$i]["iddependencia_cargo"];
            	}
				if($funcionario[$i]["estado_dep"]){
					$dependencias[]=$funcionario[$i]["iddependencia"];
				}
				$busca_cargo = busca_filtro_tabla("idcargo", "cargo", "estado = 1 and idcargo = {$funcionario[$i]["idcargo"]}", "", $this->conn);
				if($busca_cargo["numcampos"]){
					$cargos[]=$busca_cargo[0]["idcargo"];
				}
            }
            $cargos = array_unique($cargos);
            $dependencias = array_unique($dependencias);
			$roles = array_unique($roles);
			$this->funcionario->iddependencia = implode(",", $dependencias);
			$this->funcionario->idcargo = implode(",", $cargos);
			$this->funcionario->iddependencia_cargo = implode(",", $roles);  
        }
    }

    private function consultar_permisos_funcionario() {
        $permisos = array();
        // consultar permisos del funcionario en entidad_expediente

        $permisos_expediente = busca_filtro_tabla("permiso, estado", "entidad_expediente", "estado = 1 and expediente_idexpediente = {$this->idexpediente} and entidad_identidad = " . self::FUNCIONARIO . " and llave_entidad = {$this->idfuncionario}", "", $this->conn);
        //print_r($permisos_expediente);
        for ($i = 0; $i < $permisos_expediente["numcampos"]; $i++) {
            $permisos[] = self::PERMISO_EXP_LEER;
            $permisos = array_merge($permisos, array_map('trim', explode(",", $permisos_expediente[$i]["permiso"])));
        }
        $permisos = array_unique($permisos);
        // consultar permisos del funcionario sobre la serie del expediente en permiso_serie
        $permisos_serie = busca_filtro_tabla("permiso, estado", "permiso_serie", "estado = 1 and serie_idserie = {$this->expediente->serie_idserie} and entidad_identidad = " . self::FUNCIONARIO . " and llave_entidad = {$this->idfuncionario}", "", $this->conn);
        $ps = array();
        for ($i = 0; $i < $permisos_serie["numcampos"]; $i++) {
            $ps = array_merge($ps, array_map('trim', explode(",", $permisos_serie[$i]["permiso"])));
        }

        $this->permisos_expediente = array_merge($this->permisos_expediente, $permisos);
        $this->permisos_serie = array_merge($this->permisos_serie, array_unique($ps));
        $this->permisos_serie = array_unique($this->permisos_serie);
        $ps = $this->mezclar_permisos($ps);
        $permisos = array_merge($permisos, $ps);
        $permisos = array_unique($permisos);
        return $permisos;
    }

    /**
     *
     * @param
     *            array ps
     */
    private function mezclar_permisos($ps) {
        $ps = str_replace([
            self::PERMISO_SER_ADICIONAR,
            self::PERMISO_SER_VINCULAR,
            self::PERMISO_SER_MODIFICAR
        ], [
            self::PERMISO_EXP_ESCRIBIR,
            self::PERMISO_EXP_ESCRIBIR,
            self::PERMISO_EXP_ESCRIBIR
        ], $ps);
        return $ps;
    }

    private function consultar_permisos_dependencia() {
        // consultar permisos de la dependencia del funcionario sobre la serie del expediente en permiso_serie
        $permisos_serie = busca_filtro_tabla("permiso, estado", "permiso_serie", "estado = 1 and serie_idserie = {$this->expediente->serie_idserie} and entidad_identidad = " . self::DEPENDENCIA . " and llave_entidad in ({$this->funcionario->iddependencia})", "", $this->conn);
		//print_r($this->funcionario);
        $ps = array();
        for ($i = 0; $i < $permisos_serie["numcampos"]; $i++) {
            if (empty($permisos_serie[$i]["permiso"])) {
                $ps[] = self::PERMISO_SER_LEER;
            } else {
                $ps = array_merge($ps, array_map('trim', explode(",", $permisos_serie[$i]["permiso"])));
            }
        }

        $this->permisos_serie = array_merge($this->permisos_serie, array_unique($ps));
        $this->permisos_serie = array_unique($this->permisos_serie);
        $ps = $this->mezclar_permisos($ps);
        $permisos = array();
        $permisos = array_merge($permisos, $ps);
        $permisos = array_unique($permisos);
        return $permisos;
    }

    private function consultar_permisos_cargo() {
        // consultar permisos del cargo del funcionario sobre la serie del expediente en permiso_serie
        $permisos_serie = busca_filtro_tabla("permiso, estado", "permiso_serie", "estado = 1 and serie_idserie = {$this->expediente->serie_idserie} and entidad_identidad = " . self::CARGO . " and llave_entidad in ({$this->funcionario->idcargo})", "", $this->conn);
        $ps = array();
        for ($i = 0; $i < $permisos_serie["numcampos"]; $i++) {
            if (empty($permisos_serie[$i]["permiso"])) {
                $ps[] = self::PERMISO_SER_LEER;
            } else {
                $ps = array_merge($ps, array_map('trim', explode(",", $permisos_serie[$i]["permiso"])));
            }
        }

        $this->permisos_serie = array_merge($this->permisos_serie, array_unique($ps));
        $this->permisos_serie = array_unique($this->permisos_serie);
        $ps = $this->mezclar_permisos($ps);
        $permisos = array();
        $permisos = array_merge($permisos, $ps);
        $permisos = array_unique($permisos);
        return $permisos;
    }

    private function consultar_permisos_rol() {
        // consultar permisos del rol del funcionario (iddependencia_cargo) sobre la serie del expediente en permiso_serie
        $permisos_serie = busca_filtro_tabla("permiso, estado", "permiso_serie", "estado = 1 and serie_idserie = {$this->expediente->serie_idserie} and entidad_identidad = " . self::ROL . " and llave_entidad in ({$this->funcionario->iddependencia_cargo})", "", $this->conn);
        $ps = array();
        for ($i = 0; $i < $permisos_serie["numcampos"]; $i++) {
            if (empty($permisos_serie[$i]["permiso"])) {
                $ps[] = self::PERMISO_SER_LEER;
            } else {
                $ps = array_merge($ps, array_map('trim', explode(",", $permisos_serie[$i]["permiso"])));
            }
        }

        $this->permisos_serie = array_merge($this->permisos_serie, array_unique($ps));
        $this->permisos_serie = array_unique($this->permisos_serie);
        $ps = $this->mezclar_permisos($ps);
        $permisos = array();
        $permisos = array_merge($permisos, $ps);
        $permisos = array_unique($permisos);
        return $permisos;
    }

    public function sin_permisos() {
        return empty($this->permisos_serie) && empty($this->permisos_expediente);
    }

    public function permiso_solo_lectura() {
        return (count($this->permisos_serie) == 1 && in_array(self::PERMISO_SER_LEER, $this->permisos_serie)) || (count($this->permisos_expediente) == 1 && in_array(self::PERMISO_EXP_LEER, $this->permisos_expediente));
    }

    /**
     * Consulta si tiene el permiso $permiso sobre las series
     * @param string $permiso: Valores l, a, v, o m
     * @return boolean
     */
    public function tiene_permiso_serie(string $permiso) {
        return in_array($permiso, $this->permisos_serie);
    }

    /**
     * Consulta si tiene el permiso $permiso sobre las series
     * @param string $permiso: Valores l, a, v, o m
     * @return boolean
     */
    public function tiene_permiso_expediente($permiso) {
        return in_array($permiso, $this->permisos_expediente);
    }

    public function tiene_permiso_escribir_expediente() {
        return $this->tiene_permiso_expediente(self::PERMISO_EXP_ESCRIBIR);
    }

    public function tiene_permiso_compartir_expediente() {
        return $this->tiene_permiso_expediente(self::PERMISO_EXP_COMPARTIR);
    }

    public function tiene_permiso_eliminar_expediente() {
        return $this->tiene_permiso_expediente(self::PERMISO_EXP_ELIMINAR);
    }

    /**
     * Si el funcionario (usuario actual) es propietario de este expediente
     * @return boolean
     */
    public function es_propietario() {
        return $this->propietario;
    }

    public function getPermisosExpediente() {
        return $this->permisos_expediente;
    }

	public function getPermisosSerie() {
        return $this->permisos_serie;
    }
}