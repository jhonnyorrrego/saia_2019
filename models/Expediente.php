<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

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

    protected function afterDelete()
    {
        //TODO: Eliminar expediente doc y expediente abc
        //$ExpedienteDoc = ExpedienteDoc::findAllByAttributes(['expediente_idexpediente' => $this->getPK()]);
        return true;
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

    public function CreateExpediente()
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
            if (!$this->expedientePadre) {
                $this->expedientePadre = new self($this->cod_padre);
            }
        } else {
            $this->expedientePadre = null;
        }
        return $this->expedientePadre;
    }

    public function getExpedienteDocFk()
    {
        return ExpedienteDoc::findAllByAttributes(['idexpediente' => $this->idexpediente]);
    }


}
