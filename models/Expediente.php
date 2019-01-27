<?php

class Expediente extends Model
{
    protected $idexpediente;
    protected $nombre;
    protected $descripcion;
    protected $codigo;
    protected $cod_padre;
    protected $fk_idcaja;
    protected $propietario;
    protected $fk_serie;
    protected $fk_dependencia;
    protected $cod_arbol;
    protected $codigo_numero;
    protected $fondo;
    protected $proceso;
    protected $fecha_extrema_i;
    protected $fecha_extrema_f;
    protected $no_unidad_conservacion;
    protected $no_folios;
    protected $no_carpeta;
    protected $soporte;
    protected $frecuencia_consulta;
    protected $ubicacion;
    protected $unidad_admin;
    protected $ruta_qr;
    protected $estado_archivo;
    protected $estado_cierre;
    protected $fecha_cierre;
    protected $funcionario_cierre;
    protected $prox_estado_archivo;
    protected $notas_transf;
    protected $tomo_padre;
    protected $tomo_no;
    protected $agrupador;
    protected $indice_uno;
    protected $indice_dos;
    protected $indice_tres;
    protected $consecutivo_inicial;
    protected $consecutivo_final;
    protected $fk_entidad_serie;
    protected $nucleo;
    protected $dbAttributes;

    protected $expedientePadre;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }


    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'nombre',
                'descripcion',
                'codigo',
                'cod_padre',
                'fk_idcaja',
                'propietario',
                'fk_serie',
                'fk_dependencia',
                'cod_arbol',
                'codigo_numero',
                'fondo',
                'proceso',
                'fecha_extrema_i',
                'fecha_extrema_f',
                'no_unidad_conservacion',
                'no_folios',
                'no_carpeta',
                'soporte',
                'frecuencia_consulta',
                'ubicacion',
                'unidad_admin',
                'ruta_qr',
                'estado_archivo',
                'estado_cierre',
                'fecha_cierre',
                'funcionario_cierre',
                'prox_estado_archivo',
                'notas_transf',
                'tomo_padre',
                'tomo_no',
                'agrupador',
                'indice_uno',
                'indice_dos',
                'indice_tres',
                'consecutivo_inicial',
                'consecutivo_final',
                'fk_entidad_serie',
                'nucleo'

            ],
            'date' => [
                'fecha_extrema_i',
                'fecha_extrema_f',
                'fecha_cierre'
            ]
        ];
    }

    /**
     * Se ejecuta despues de crear el expediente
     * Actualiza el cod_arbol del expediente
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    protected function afterCreate()
    {
        $cod_arbol = $this->idexpediente;
        $padre = $this->getCodPadre();
        if ($padre) {
            $cod_arbol = $padre->cod_arbol . '.' . $this->idexpediente;
        }
        $this->cod_arbol = $cod_arbol;
        $this->update();
        return true;
    }
    /**
     * Se ejecuta posterior al eliminar un expediente
     * Elimina las documentos y el historial de cierre vinculadoa al expediente
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    protected function afterDelete()
    {
        $ExpedienteDoc = ExpedienteDoc::findAllByAttributes(['fk_expediente' => $this->getPK()]);
        if ($ExpedienteDoc) {
            foreach ($ExpedienteDoc as $instance) {
                $instance->delete();
            }
        }

        $ExpedienteAbce = ExpedienteDoc::findAllByAttributes(['fk_expediente' => $this->getPK()]);
        if ($ExpedienteAbce) {
            foreach ($ExpedienteAbce as $instance) {
                $instance->delete();
            }
        }
        return true;
    }
    /**
     * Crea el expediente con sus correspondientes vinculados
     * NO utlizar save()
     * 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function CreateExpediente() : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => '',
        ];
        if ($this->save()) {
            $response['exito'] = 1;
            $response['data']['id'] = $this->idexpediente;

        } else {
            $this->delete();
            $response['message'] = 'Error al guardar el Expediente';
        }
        return $response;
    }
    /**
     * retorna la etiqueta del estado del expediente
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEstado() : string
    {
        $estado = array(
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        );
        return $estado[$this->estado];
    }
    /**
     * retorna la instancia del expediente padre
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getCodPadre()
    {
        if ($this->cod_padre) {
            if (!$this->expedientePadre) {
                $this->expedientePadre = new self($this->cod_padre);
            }
        } else {
            $this->expedientePadre = null;
        }
        return $this->expedientePadre;
    }
    /**
     * retorna las instancias de expedientes_doc vinculadas al expediente
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getExpedienteDocFk()
    {
        return ExpedienteDoc::findAllByAttributes(['idexpediente' => $this->idexpediente]);
    }

}
