<?php

class Serie extends Model
{
    protected $idserie;
    protected $cod_padre;
    protected $cod_arbol;
    protected $nombre;
    protected $codigo;
    protected $tipo;
    protected $dias_respuesta;
    protected $retencion_gestion;
    protected $retencion_central;
    protected $fk_serie_version;
    protected $procedimiento;
    protected $estado;

    protected $dbAttributes;
    protected $seriePadre;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'cod_padre',
                'cod_arbol',
                'nombre',
                'codigo',
                'retencion_gestion',
                'retencion_central',
                'tipo',
                'dias_respuesta',
                'fk_serie_version',
                'procedimiento',
                'estado'
            ]
        ];
    }

    public function beforeCreate()
    {
        $SerieVersion = SerieVersion::VersionActual();
        $this->fk_serie_version = $SerieVersion->getPK();
    }

    /**
     * Se ejecuta despues de crear la serie
     * actualiza el cod padre 
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    protected function afterCreate()
    {
        $codArbol = $this->idserie;
        $padre = $this->getCodPadre();
        if ($padre) {
            $codArbol = $padre->cod_arbol . '.' . $this->idserie;
        }
        $this->cod_arbol = $codArbol;
        return $this->update();
    }

    /**
     * Crea la serie con sus correspondientes vinculaciones (expedientes, entidad serie)
     * NO utilizar create() para crear una serie
     *
     * @param string $dependenciasVinculadas : Dependencias a vinculadas a la serie
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function createSerie(array $data): array
    {
        $response = [
            'data' => [],
            'success' => 0,
            'message' => ''
        ];
        $newId = $this->newRecord($data);
        if ($newId) {
            $infoData['idserie'] = $newId;
            foreach ($data['soporte'] as $value) {
                $id = SerieRetencion::newRecord([
                    'fk_serie' => $newId,
                    'fk_retencion' => $value
                ]);
                if ($id) {
                    $infoData['idserie_retencion'][] = $id;
                }
            }

            foreach ($data['disposicion'] as $value) {
                $id = SerieRetencion::newRecord([
                    'fk_serie' => $newId,
                    'fk_retencion' => $value
                ]);
                if ($id) {
                    $infoData['idserie_retencion'][] = $id;
                }
            }
            $response['success'] = 1;
        }
        return $response;
    }


    /**
     * Actualiza la serie y sus correspondientes vinculados (expedientes)
     * NO utilizar update() para actualizar una serie
     * 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function updateSerie(): array
    {
        $response = [
            'exito' => 0,
            'message' => ''
        ];
        if ($this->categoria == 3) {
            if ($this->update()) {
                $response['exito'] = 1;
                $response['message'] = 'Datos actualizados';
            } else {
                $response['message'] = 'Error al actualizar la serie';
            }
        } else {
            $updateArbol = false;
            $instance = new self($this->idserie);
            if ($instance->cod_padre != $this->cod_padre) {
                $updateArbol = true;
                $codArbolAnt = $instance->cod_arbol;
                $codArbol = $this->idserie;
                if ($this->cod_padre) {
                    $instancePadre = new self($this->cod_padre);
                    $codArbol = $instancePadre->cod_arbol . '.' . $this->idserie;
                }
                $this->cod_arbol = $codArbol;
            }

            if ($this->update()) {
                $response['exito'] = 1;
                $response['message'] = 'Datos actualizados';

                if ($updateArbol) {
                    $update = "UPDATE serie SET cod_arbol=replace(cod_arbol,'{$codArbolAnt}','{$this->cod_arbol}') WHERE cod_arbol LIKE '{$codArbolAnt}.%'";
                    if (!$this->query($update)) {
                        $response['message2'] = 'Error al actualizar el cod arbol';
                    }
                }

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
                        if (!$Expediente->update()) {
                            $response['message2'] .= 'Error al actualizar el expediente';
                        }
                    }
                }

                if (!$this->estado) {
                    $EntidadSerie = EntidadSerie::findAllByAttributes(['fk_serie' => $this->idserie]);
                    if ($EntidadSerie) {
                        foreach ($EntidadSerie as $instance) {
                            $instance->inactiveEntidadSerie();
                        }
                    }
                }
            }
        }

        return $response;
    }

    /**
     * retornar la etiqueta del tipo de la serie
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getTipo(): string
    {
        $tipo = array(
            1 => 'SERIE',
            2 => 'SUBSERIE',
            3 => 'TIPO DOCUMENTAL'
        );
        return $tipo[$this->tipo];
    }



    /**
     * retorna el label si/no utilizado en etiquetas de la serie
     *
     * @param string $nameCampo  : Nombre del campo 
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getLabelCampo(string $nameCampo): string
    {
        $sel = array(
            0 => 'NO',
            1 => 'SI'
        );
        return $sel[$this->$nameCampo];
    }
    /**
     * retorna la etiqueta del estado de la serie
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEstado(): string
    {
        $estado = array(
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        );
        return $estado[$this->estado];
    }
    /**
     * retorna la instancia de la serie padre
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
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

    /**
     * retorna array con ids o instancia de la series hijas
     *
     * @param boolean $instance : true retorna instancia, false retorna los ids
     * @param integer $estado : utlizado en el where, estado de la consulta
     * @param integer $tipo : utlizado en el where, tipo de la consulta
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getChildren($instance = true, int $estado = null, int $tipo = null): array
    {
        $parteWhere = '';
        if (!is_null($estado)) {
            $parteWhere .= " and estado={$estado}";
        }
        if (!is_null($tipo)) {
            $parteWhere .= " and tipo={$tipo}";
        }
        $data = [];
        $sql = "SELECT idserie FROM serie WHERE cod_arbol like '{$this->cod_arbol}.%' {$parteWhere}";
        $hijos = $this->search($sql);
        if ($hijos) {
            foreach ($hijos as $fila) {
                if ($instance) {
                    $data[] = new self($fila['idserie']);
                } else {
                    $data[] = $fila['idserie'];
                }
            }
        }
        return $data;
    }

    public function getInfoCodArbol(): array
    {
        $response = [];
        $codArbol = str_replace('.', ',', $this->cod_arbol);
        $sql = "SELECT idserie,nombre,tipo FROM serie WHERE idserie IN ({$codArbol}) ";
        $records = $this->findBySql($sql, false);
        if ($records) {
            $etiq = [];
            foreach ($records as $record) {
                $etiq[] = $record['nombre'];
                $response[$record['tipo']] = $record['idserie'];
            }
            $response['id'] = $response[2] ?? $response[1];
            $response['etiqueta'] = implode(' - ', $etiq);
        }
        return $response;
    }

    /**
     * valida si tiene series hijas
     *
     * @param integer $estado : utlizado en el where, estado de la consulta
     * @param integer $tipo : utlizado en el where, tipo de la consulta
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function hasChild(int $estado = null, int $tipo = null): bool
    {
        $parteWhere = '';
        if (!is_null($estado)) {
            $parteWhere .= " and estado={$estado}";
        }
        if (!is_null($tipo)) {
            $parteWhere .= " and tipo={$tipo}";
        }
        $sql = "SELECT count(idserie) as cant FROM serie WHERE cod_arbol like '{$this->cod_arbol}.%' {$parteWhere}";
        $hijos = $this->search($sql);
        return $hijos[0]['cant'] ? true : false;
    }
    /**
     * retorna las instancias de EntidadSerie vinculadas
     *
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEntidadSerieFk(int $instance = 1)
    {
        if ($instance) {
            $data = EntidadSerie::findAllByAttributes(['fk_serie' => $this->idserie]);
        } else {
            $data = EntidadSerie::findColumn('idserie', ['fk_serie' => $this->idserie]);
        }

        return $data;
    }
    /**
     * retorna las instancias de expedientes vinculadas a la serie
     * 
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo    <andres.agudelo@cerok.com>
     */
    public function getExpedienteFk(int $instance = 1)
    {
        if ($instance) {
            $data = Expediente::findAllByAttributes(['fk_serie' => $this->idserie]);
        } else {
            $data = Expediente::findColumn('idexpediente', ['fk_serie' => $this->idserie]);
        }

        return $data;
    }
}
