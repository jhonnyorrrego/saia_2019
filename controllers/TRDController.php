<?php

/**
 * VALIDACIONES IMPORTANTES:
 * 1. Una misma serie NO puede estar vinculada a dos dependencias, 
 * se debe crea una serie por dependencia en caso que la serie/subserie comparta el mismo nombre con el
 * mismo codigo
 * 2. La subserie es quien define el tiempo de retencion, en caso de no existir subserie es la serie, pero
 * para dicha serie no se le debe permitir crear hijos tipo subserie
 * 3. el -1 en la retencion central/gestion de las series/subserie equivale a que siempre se conservara en gestion (Permanentemente)
 */

class TRDController
{
    protected $urlEXcel;
    protected $data;
    public $fila;
    protected $messageError = [];
    private $row;

    public function __construct(string $url)
    {
        $this->urlEXcel = $url;
        $this->init();
    }

    protected function init()
    {
        $this->truncateTables()
            ->getDataExcel();
    }

    protected function truncateTables()
    {
        $trun1 = StaticSql::query("TRUNCATE TABLE serie_temp");
        $trun2 = StaticSql::query("TRUNCATE TABLE dependencia_serie_temp");
        if ($trun1 !== true && $trun2 !== true) {
            throw new Exception("No se pudieron limpiar las tablas temporales");
        }
        return $this;
    }

    protected function getDataExcel()
    {
        $fields = [
            'cod_dependencia',
            'cod_serie',
            'cod_subserie',
            'serie',
            'subserie',
            'tipo',
            'ret_gestion',
            'ret_central',
            'sop_papel',
            'sop_electronico',
            'dis_eliminacion',
            'dis_seleccion',
            'dis_conservacion',
            'dis_microfilma',
            'procedimiento'
        ];
        $dataExcel = UtilitiesController::readFileExcel($this->urlEXcel, [4], $fields);
        $cantCabecera = count($fields);
        $cantCabeceraExcel = count($dataExcel[1]);

        if ($cantCabecera != $cantCabeceraExcel) {
            throw new Exception("La cantidad de columnas del excel ({$cantCabeceraExcel}) no coincide con la cantidad de cabeceras enviadas ({$cantCabecera})");
        } else {
            unset($dataExcel[1]);
        }
        $this->data = $dataExcel;

        return $this;
    }


    public function loadTRD()
    {

        $rowAnterior = array();
        foreach ($this->data as $fila => $registro) {
            $this->fila = $fila;

            if (
                $rowAnterior['cod_serie'] != $registro['cod_serie'] && $registro['cod_serie']
                || $rowAnterior['cod_dependencia'] != $registro['cod_dependencia'] && $registro['cod_dependencia']
            ) {

                $this->row = $this->validateFields($registro);
            } else if (!$registro['cod_serie'] && $registro['tipo']) {

                $newData = array(
                    'tipo' => $registro['tipo'],
                    'sop_papel' => $registro['sop_papel'],
                    'sop_electronico' => $registro['sop_electronico']
                );

                $registro = array_merge($rowAnterior, $newData);
                $this->row = $this->validateFields($registro);
            } else if ($rowAnterior['cod_subserie'] != $registro['cod_subserie']) {

                $newData = array(
                    'idserie' => $rowAnterior['idserie'],
                    'iddependencia' => $rowAnterior['iddependencia']
                );
                $registro = array_merge($registro, $newData);
                $this->row = $this->validateFields($registro);
            }

            // if($this->fila==3){
            //     print_r($this->row);
            //     die();
            // }

            $this->row['idserie'] = ($this->row['idserie']) ?? $this->insertSerie();
            $this->row['id'] = $this->row['idserie'];

            if ($this->row['cod_subserie']) {

                $this->row['idsubserie'] = ($this->row['idsubserie']) ?? $this->insertSubserie();
                $this->row['id'] = $this->row['idsubserie'];
            }

            $this->row['idtipo'] = $this->insertTipoDocumental();
            $rowAnterior = $this->row;
        }
        return true;
    }

    private function validateFields($row)
    {

        if (
            (is_null($row['ret_gestion'])  && is_null($row['ret_central']))
            || ($row['ret_gestion'] == -1 && $row['ret_central'] == -1)
        ) {
            if ($row['ret_gestion'] <> -1) {
                if (
                    $row['dis_eliminacion'] || $row['dis_seleccion']
                    || $row['dis_conservacion'] || $row['dis_microfilma']
                ) {
                    throw new Exception("No debe seleccionar ningun tipo de disposicion si la retencion en gestion es permanente");
                }
            }


            $row['ret_gestion'] = -1;
            $row['ret_central'] = -1;

            $row['dis_eliminacion'] = -1;
            $row['dis_conservacion'] = -1;
            $row['dis_seleccion'] = -1;
            $row['dis_microfilma'] = -1;
        } else {

            if (is_null($row['ret_gestion'])) {
                $row['ret_gestion'] = 0;
            }
            if (is_null($row['ret_central'])) {
                $row['ret_central'] = 0;
            }

            if (!is_float($row['ret_gestion']) && !is_int($row['ret_gestion'])) {
                throw new Exception("por favor ingrese un numero valido, retencion gestion: ({$row['ret_gestion']}), el separador decimal debe ser una coma");
            }
            if (!is_float($row['ret_central']) && !is_int($row['ret_central'])) {
                throw new Exception("por favor ingrese un numero valido, retencion central: ({$row['ret_central']}), el separador decimal debe ser una coma");
            }

            if (
                (!empty($row['dis_eliminacion']) && !empty($row['dis_conservacion']))
                || (!empty($row['dis_eliminacion']) && !empty($row['dis_seleccion']))
                || (!empty($row['dis_conservacion']) && !empty($row['dis_seleccion']))
            ) {
                throw new Exception("Por favor seleccione solo una de las 3,  E/CT/S para la serie/subserie");
            }

            if (
                empty($row['dis_eliminacion']) && empty($row['dis_seleccion'])
                && empty($row['dis_conservacion'])
            ) {
                throw new Exception("Debe seleccionar un tipo de Disposicion");
            } else {

                $row['dis_eliminacion'] = (!empty($row['dis_eliminacion'])) ? 1 : 0;
                $row['dis_conservacion'] = (!empty($row['dis_conservacion'])) ? 1 : 0;
                $row['dis_seleccion'] = (!empty($row['dis_seleccion'])) ? 1 : 0;
                $row['dis_microfilma'] = (!empty($row['dis_microfilma'])) ? 1 : 0;
            }
        }

        if (empty($row['sop_papel']) && empty($row['sop_electronico'])) {
            throw new Exception("Debe seleccionar un tipo de soporte P/EL");
        } else {
            $row['sop_papel'] = (!empty($row['sop_papel'])) ? 1 : 0;
            $row['sop_electronico'] = (!empty($row['sop_electronico'])) ? 1 : 0;
        }

        $row['iddependencia'] = ($row['iddependencia']) ??
            $this->validateDependencia($row['cod_dependencia']);

        return $row;
    }

    private function validateDependencia($codDependencia)
    {
        $sql = "SELECT estado,iddependencia FROM dependencia WHERE codigo like '{$codDependencia}'";
        $existDep = Dependencia::findBySql($sql, false);
        if ($existDep) {
            $cant = count($existDep);
            if ($cant == 1) {
                if ($existDep[0]['estado'] == 1) {
                    return $existDep[0]['iddependencia'];
                } else {
                    throw new Exception("La dependencia con codigo {$codDependencia} se encuentra inactiva");
                }
            } else {
                throw new Exception("La dependencia con codigo {$codDependencia} existe {$cant} veces");
            }
        } else {
            throw new Exception("La dependencia con codigo {$codDependencia} NO existe");
        }
        return false;
    }


    private function insertSerie()
    {
        $data = [
            'serie' => $this->row['serie'],
            'cod_serie' => $this->row['cod_serie']
        ];
        $idserie = $this->validateSerieSubserie($data);

        $sinSubserie = (!$this->row['cod_subserie']) ? true : false;

        if (!$idserie) {
            $attributes = [
                'cod_padre' => 0,
                'nombre' => $this->row['serie'],
                'codigo' => $this->row['cod_serie'],
                'tipo' => 1
            ];

            if ($sinSubserie) {
                $otherData = [
                    'retencion_gestion' => $this->row['ret_gestion'],
                    'retencion_central' => $this->row['ret_central'],
                    'procedimiento' => $this->row['procedimiento'],
                    'sop_papel' => $this->row['sop_papel'],
                    'sop_electronico' => $this->row['sop_electronico'],
                    'dis_eliminacion' => $this->row['dis_eliminacion'],
                    'dis_conservacion' => $this->row['dis_conservacion'],
                    'dis_seleccion' => $this->row['dis_seleccion'],
                    'dis_microfilma' => $this->row['dis_microfilma']
                ];
                $attributes = array_merge($attributes, $otherData);
            }
            if (!$idserie = SerieTemp::newRecord($attributes)) {
                throw new Exception("Error al insertar la serie");
            }
        }
        $this->insertDependenciaSerie($idserie, 1, $sinSubserie);

        return $idserie;
    }

    private function insertSubserie()
    {
        $data = [
            'idseriePadre' => $this->row['idserie'],
            'serie' => $this->row['subserie'],
            'cod_serie' => $this->row['cod_subserie']
        ];

        $idsubserie = $this->validateSerieSubserie($data, 2);

        if (!$idsubserie) {

            $attributes = [
                'cod_padre' => $this->row['idserie'],
                'nombre' => $this->row['subserie'],
                'codigo' => $this->row['cod_subserie'],
                'tipo' => 2,
                'retencion_gestion' => $this->row['ret_gestion'],
                'retencion_central' => $this->row['ret_central'],
                'procedimiento' => $this->row['procedimiento'],
                'sop_papel' => $this->row['sop_papel'],
                'sop_electronico' => $this->row['sop_electronico'],
                'dis_eliminacion' => $this->row['dis_eliminacion'],
                'dis_conservacion' => $this->row['dis_conservacion'],
                'dis_seleccion' => $this->row['dis_seleccion'],
                'dis_microfilma' => $this->row['dis_microfilma']
            ];

            if (!$idsubserie = SerieTemp::newRecord($attributes)) {
                throw new Exception("Error al insertar la Subserie");
            }
        }
        $this->insertDependenciaSerie($idsubserie, 2);
        return $idsubserie;
    }

    private function insertDependenciaSerie($idserie, $tipo, $sinSubserie = false)
    {
        if ($tipo == 1 && $sinSubserie) { //Serie
            $sql = "SELECT count(idserie) as cant FROM serie_temp WHERE cod_padre={$idserie} and tipo=2";
            $existSubserie = SerieTemp::search($sql);
            if ($existSubserie[0]['cant']) {
                throw new Exception("La serie de la Fila: {$this->fila} NO tiene codigo de subserie, esta debe tener debido a que ya ha sido vinculado a otras subseries");
            }
        }

        $sql = "SELECT count(iddependencia_serie) as cant FROM dependencia_serie_temp WHERE fk_serie={$idserie} and fk_dependencia={$this->row['iddependencia']}";
        $existDepSerie = DependenciaSerieTemp::search($sql);
        if (!$existDepSerie[0]['cant']) {
            $attributes = [
                'fk_serie' => $idserie,
                'fk_dependencia' => $this->row['iddependencia']
            ];

            if (!DependenciaSerieTemp::newRecord($attributes)) {
                throw new Exception("Error al vincular la serie con la dependencia");
            }
        } else {
            if ($sinSubserie) {
                throw new Exception("La serie ya se encuentra vinculada");
            }
        }
        return true;
    }

    private function insertTipoDocumental()
    {
        $attributes = [
            'cod_padre' => $this->row['id'],
            'nombre' => $this->row['tipo'],
            'codigo' => 0,
            'tipo' => 3,
            'dias_respuesta' => 0,
            'sop_papel' => $this->row['sop_papel'],
            'sop_electronico' => $this->row['sop_electronico']
        ];

        if (!$id = SerieTemp::newRecord($attributes)) {
            throw new Exception("Error al insertar el tipo documental", 1);
        }
        return $id;
    }

    private function validateSerieSubserie($data = array(), $tipo = 1)
    {
        $nameSerie = htmlentities(trim($data['serie']));
        $parteWhere = '';
        if ($tipo == 2) {
            $parteWhere = "and s.cod_padre={$data['idseriePadre']}";
        }
        $sqlSerie = "SELECT idserie,nombre FROM serie_temp s,dependencia_serie_temp d 
        WHERE s.idserie=d.fk_serie and d.fk_dependencia={$this->row['iddependencia']}
        and s.codigo like '{$data['cod_serie']}' and s.tipo={$tipo} {$parteWhere}";
        $existSerie = StaticSql::search($sqlSerie);

        if ($existSerie) {
            if ($existSerie[0]['nombre'] != $nameSerie) {
                throw new Exception("La serie/subserie con codigo {$data['cod_serie']} ya se encuentra asignado con otro nombre a esta dependencia");
            } else {
                if ($tipo == 1) {
                    return $existSerie[0]['idserie'];
                } else {
                    throw new Exception("La subserie ya se encuentra vinculada a esta dependencia");
                }
            }
        }
        return false;
    }
}
