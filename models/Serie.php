<?php

require_once $ruta_db_superior . 'controllers/autoload.php';

class Serie extends Model
{
    protected $idserie;
    protected $nombre;
    protected $cod_padre;
    protected $dias_entrega;
    protected $codigo;
    protected $retencion_gestion;
    protected $retencion_central;
    protected $conservacion;
    protected $digitalizacion;
    protected $seleccion;
    protected $otro;
    protected $procedimiento;
    protected $copia;
    protected $tipo;
    protected $estado;
    protected $categoria;
    protected $cod_arbol;
    protected $dbAttributes;

    protected $seriePadre;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)['safe' => [
            'nombre',
            'cod_padre',
            'dias_entrega',
            'codigo',
            'retencion_gestion',
            'retencion_central',
            'conservacion',
            'digitalizacion',
            'seleccion',
            'otro',
            'procedimiento',
            'copia',
            'tipo',
            'estado',
            'categoria',
            'cod_arbol'
        ]];
    }

    protected function afterCreate()
    {
        $cod_arbol = $this->idserie;
        $padre = $this->getCodPadre();
        if ($padre) {
            $cod_arbol = $padre->cod_arbol . '.' . $this->idserie;
        }
        $this->cod_arbol = $cod_arbol;
        $this->update();
        return true;
    }

    protected function afterDelete()
    {
        $EntidadSerie = EntidadSerie::findAllByAttributes(['fk_serie' => $this->getPK()]);
        if ($EntidadSerie) {
            foreach ($EntidadSerie as $instance) {
                $instance->delete();
            }
        }
        return true;
    }

    public function createSerie(string $dependenciasVinculadas = '')
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => ''
        ];

        if ($this->categoria == 3) {
            if ($this->save()) {
                $response['exito'] = 1;
                $response['message'] = 'Datos almacenados';
            } else {
                $response['message'] = 'Error al crear la serie';
            }
        } else {
            if (!empty($dependenciasVinculadas)) {
                if ($this->save()) {
                    $dependencia = explode(",", $dependenciasVinculadas);
                    $cd = count($dependencia);
                    $ok = 0;
                    $attributes = [
                        'fk_serie' => $this->idserie,
                        'estado' => 1,
                        'fecha_creacion' => date('Y-m-d H:i:s')
                    ];
                    $idsEntSe = [];
                    for ($i = 0; $i < $cd; $i++) {
                        $attributes['fk_dependencia'] = $dependencia[$i];

                        $EntidadSerie = new EntidadSerie();
                        $EntidadSerie->SetAttributes($attributes);
                        $infoEntidadSerie = $EntidadSerie->CreateEntidadSerie();
                        if ($infoEntidadSerie['exito']) {
                            $idsEntSe[] = $EntidadSerie->getPK();
                            $ok++;
                        }
                    }
                    if ($ok == $cd) {
                        $response['exito'] = 1;
                        $response['data']['identidad_serie'] = $idsEntSe;
                        $response['message'] = 'Datos almacenados';
                    } else if ($ok) {
                        $response['exito'] = 2;
                        $response['data']['identidad_serie'] = $idsEntSe;
                        $response['message'] = 'Serie creada, NO se vincularon todas las dependencias';
                    } else {
                        $this->delete();
                        $response['message'] = 'No se pudo vincular las dependencias a la serie';
                    }
                } else {
                    var_dump($this->getPK());
                    $response['message'] = 'Error al guardar la Serie';
                    die("---");
                }
            } else {
                $response['message'] = 'Faltan las dependencias para vincular la serie';
            }
        }

        return $response;
    }

    public function updateSerie()
    {
        $response = [
            'exito' => 0,
            'message' => ''
        ];

        if ($this->categoria == 3) {
            if ($this->save()) {
                $response['exito'] = 1;
                $response['message'] = 'Datos actualizados';
            } else {
                $response['message'] = 'Error al actualizar la serie';
            }
        } else {
            if ($this->save()) {
                $response['exito'] = 1;
                $response['message'] = 'Datos actualizados';

                $idsExpediente = $this->getExpedienteFk();
                if ($idsExpediente) {
                    foreach ($idsExpediente as $Expediente) {
                        $attributes = [
                            'nombre' => $this->nombre,
                            'fondo' => $this->nombre,
                            'descripcion' => $this->nombre,
                            'codigo' => $this->codigo,
                            'codigo_numero' => $this->codigo
                        ];
                        $Expediente->SetAttributes($attributes);
                        $Expediente->update();
                    }
                }
            }
        }
        return $response;
    }


    public function getTipo()
    {
        $tipo = array(
            1 => 'SERIE',
            2 => 'SUBSERIE',
            3 => 'TIPO DOCUMENTAL'
        );
        return $tipo[$this->tipo];
    }

    public function getCategoria()
    {
        $categoria = array(
            2 => 'PRODUCCION DOCUMENTAL',
            3 => 'OTRAS CATAGORIAS'
        );
        return $categoria[$this->categoria];
    }

    public function getConservacion()
    {
        $conservacion = array(
            'TOTAL' => 'CONSERVACION',
            'ELIMINACION' => 'ELIMINACION'
        );
        return $conservacion[$this->conservacion];
    }

    public function getLabelCampo($campo)
    {
        $sel = array(
            0 => 'NO',
            1 => 'SI'
        );
        return $sel[$this->$campo];
    }

    public function getEstado()
    {
        $estado = array(
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        );
        return $estado[$this->estado];
    }

    public function getCodPadre()
    {
        if ($this->cod_padre) {
            if (!$this->seriePadre) {
                $this->seriePadre = new self($this->cod_padre);
            }
        } else {
            $this->seriePadre = null;
        }
        return $this->seriePadre;
    }

    public function countDocuments()
    {
        $filtro_docs = false;
        $cant = 0;
        switch ($this->tipo) {
            case 0:
            case 3:
                $filtro_docs = $this->idserie;
                break;
            case 1:
            case 2:
                $filtro_docs = "select distinct idserie from serie where cod_arbol like '{$this->cod_arbol}.%'";
                break;
        }
        if ($filtro_docs !== false) {
            $docs_vinculados = busca_filtro_tabla("count(*) as cant", "documento", "estado not in ('ELIMINADO') and serie in ({$filtro_docs})", "", $conn);
            if ($docs_vinculados[0]["cant"]) {
                $cant = $docs_vinculados[0]["cant"];
            }
        }
        return $cant;
    }

    public function getEntidadSerieFk()
    {
        return EntidadSerie::findAllByAttributes(['fk_serie' => $this->idserie]);
    }

    public function getExpedienteFk()
    {
        return Expediente::findAllByAttributes(['fk_serie' => $this->idserie]);
    }

}
