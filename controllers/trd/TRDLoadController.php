<?php

/**
 * VALIDACIONES IMPORTANTES:
 * 1. Una misma serie/subserie NO puede estar vinculada a dos dependencias, 
 * se debe crea una serie por dependencia en caso que la serie/subserie comparta el mismo nombre con el
 * mismo codigo
 * 2. La subserie es quien define el tiempo de retencion, en caso de no existir subserie es la serie, pero
 * para dicha serie no se le debe permitir crear hijos tipo subserie
 * 3. el -1 en la retencion central/gestion de las series/subserie equivale a que siempre se conservara en gestion (Permanentemente)
 */

use \Doctrine\DBAL\Types\Type;

class TRDLoadController
{
    protected $urlEXcel;
    protected $fk_serie_version;
    protected $data;
    public $fila;
    private $row;

    public function __construct(string $url, int $fk_serie_version)
    {
        $this->urlEXcel = $url;
        $this->fk_serie_version = $fk_serie_version;
        $this->init();
    }

    protected function init()
    {
        $this->getDataExcel()
            ->loadTRD();
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
            $this->errorException("La cantidad de columnas del excel ({$cantCabeceraExcel}) no coincide con la cantidad de cabeceras enviadas ({$cantCabecera})");
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
                || $rowAnterior['cod_dependencia'] != $registro['cod_dependencia'] &&
                $registro['cod_dependencia']
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

            $this->row['idserie'] = ($this->row['idserie']) ?? $this->insertSerie();
            $this->row['id'] = $this->row['idserie'];

            if ($this->row['cod_subserie']) {

                $this->row['idsubserie'] = ($this->row['idsubserie']) ?? $this->insertSubserie();
                $this->row['id'] = $this->row['idsubserie'];
            }

            $this->row['idtipo'] = $this->insertTipoDocumental();
            $rowAnterior = $this->row;
        }
        return $this;
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
                    $this->errorException("No debe seleccionar ningun tipo de disposicion si la retencion en gestion es permanente");
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
                $this->errorException("por favor ingrese un numero valido, retencion gestion: ({$row['ret_gestion']}), el separador decimal debe ser una coma");
            }
            if (!is_float($row['ret_central']) && !is_int($row['ret_central'])) {
                $this->errorException("por favor ingrese un numero valido, retencion central: ({$row['ret_central']}), el separador decimal debe ser una coma");
            }

            if (
                (!empty($row['dis_eliminacion']) && !empty($row['dis_conservacion']))
                || (!empty($row['dis_eliminacion']) && !empty($row['dis_seleccion']))
                || (!empty($row['dis_conservacion']) && !empty($row['dis_seleccion']))
            ) {
                $this->errorException("Por favor seleccione solo una de las 3,  E/CT/S para la serie/subserie");
            }

            if (
                empty($row['dis_eliminacion']) && empty($row['dis_seleccion'])
                && empty($row['dis_conservacion'])
            ) {
                $this->errorException("Debe seleccionar un tipo de Disposicion");
            } else {

                $row['dis_eliminacion'] = (!empty($row['dis_eliminacion'])) ? 1 : 0;
                $row['dis_conservacion'] = (!empty($row['dis_conservacion'])) ? 1 : 0;
                $row['dis_seleccion'] = (!empty($row['dis_seleccion'])) ? 1 : 0;
                $row['dis_microfilma'] = (!empty($row['dis_microfilma'])) ? 1 : 0;
            }
        }

        if (empty($row['sop_papel']) && empty($row['sop_electronico'])) {
            $this->errorException("Debe seleccionar un tipo de soporte P/EL");
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
        $existDep = Dependencia::getQueryBuilder()
            ->select('estado,iddependencia')
            ->from('dependencia')
            ->where('codigo like :codigo_dep')
            ->setParameter(':codigo_dep', $codDependencia)
            ->execute()->fetchAll();

        if ($existDep) {
            $cant = count($existDep);
            if ($cant == 1) {
                if ($existDep[0]['estado'] == 1) {
                    return $existDep[0]['iddependencia'];
                } else {
                    $this->errorException("La dependencia con codigo {$codDependencia} se encuentra inactiva");
                }
            } else {
                $this->errorException("La dependencia con codigo {$codDependencia} existe {$cant} veces");
            }
        } else {
            $this->errorException("La dependencia con codigo {$codDependencia} NO existe");
        }
        return false;
    }


    private function insertSerie()
    {
        if (empty($this->row['serie'])) {
            $this->errorException("Por favor ingrese el nombre de la serie");
        }

        $data = [
            'serie' => $this->row['serie'],
            'cod_serie' => $this->row['cod_serie']
        ];
        $idserie = $this->validateSerieSubserie($data);

        $sinSubserie = (!$this->row['cod_subserie']) ? true : false;

        if (!$idserie) {
            $attributes = [
                'cod_padre' => 0,
                'cod_arbol' => 0,
                'nombre' => $this->row['serie'],
                'codigo' => $this->row['cod_serie'],
                'tipo' => 1,
                'fk_serie_version' => $this->fk_serie_version
            ];

            if ($sinSubserie) {
                $otherData = [
                    'retencion_gestion' => $this->row['ret_gestion'],
                    'retencion_central' => $this->row['ret_central'],
                    'procedimiento' => $this->row['procedimiento'],
                    'sop_papel' => 0,
                    'sop_electronico' => 0,
                    'dis_eliminacion' => $this->row['dis_eliminacion'],
                    'dis_conservacion' => $this->row['dis_conservacion'],
                    'dis_seleccion' => $this->row['dis_seleccion'],
                    'dis_microfilma' => $this->row['dis_microfilma']
                ];
                $attributes = array_merge($attributes, $otherData);
            }
            if (!$idserie = SerieTemp::newRecord($attributes)) {
                $this->errorException("Error al insertar la serie");
            }
        }
        $this->inserTSerieDependencia($idserie, 1, $sinSubserie);

        return $idserie;
    }

    private function insertSubserie()
    {
        if (empty($this->row['subserie'])) {
            $this->errorException("Por favor ingrese el nombre de la subserie");
        }

        $data = [
            'idseriePadre' => $this->row['idserie'],
            'serie' => $this->row['subserie'],
            'cod_serie' => $this->row['cod_subserie']
        ];

        $idsubserie = $this->validateSerieSubserie($data, 2);

        if (!$idsubserie) {

            $attributes = [
                'cod_padre' => $this->row['idserie'],
                'cod_arbol' => 0,
                'nombre' => $this->row['subserie'],
                'codigo' => $this->row['cod_subserie'],
                'tipo' => 2,
                'fk_serie_version' => $this->fk_serie_version,
                'retencion_gestion' => $this->row['ret_gestion'],
                'retencion_central' => $this->row['ret_central'],
                'procedimiento' => $this->row['procedimiento'],
                'sop_papel' => 0,
                'sop_electronico' => 0,
                'dis_eliminacion' => $this->row['dis_eliminacion'],
                'dis_conservacion' => $this->row['dis_conservacion'],
                'dis_seleccion' => $this->row['dis_seleccion'],
                'dis_microfilma' => $this->row['dis_microfilma']
            ];

            if (!$idsubserie = SerieTemp::newRecord($attributes)) {
                $this->errorException("Error al insertar la Subserie");
            }
        }
        $this->inserTSerieDependencia($idsubserie, 2);
        return $idsubserie;
    }

    private function inserTSerieDependencia($idserie, $tipo, $sinSubserie = false)
    {
        if ($tipo == 1 && $sinSubserie) { //Serie

            $existSubserie = SerieTemp::getQueryBuilder()
                ->select('count(idserie) as cant')
                ->from('serie_temp')
                ->where('tipo=2 and cod_padre=:idserie')
                ->setParameter(':idserie', $idserie, Type::INTEGER)
                ->execute()->fetch();

            if ($existSubserie['cant']) {
                $this->errorException("NO tiene codigo de subserie, esta debe tener debido a que ya ha sido vinculado a otras subseries");
            }
        }

        $existDepSerie = SerieDependenciaTemp::getQueryBuilder()
            ->select('count(idserie_dependencia) as cant')
            ->from('serie_dependencia_temp')
            ->where('fk_serie=:idserie')
            ->andWhere('fk_dependencia=:iddependencia')
            ->setParameters(
                [
                    ':idserie' => $idserie,
                    ':iddependencia' => $this->row['iddependencia']
                ],
                [
                    ':idserie' => Type::INTEGER,
                    ':iddependencia' => Type::INTEGER,
                ]
            )
            ->execute()->fetch();

        if (!$existDepSerie['cant']) {
            $attributes = [
                'fk_serie' => $idserie,
                'fk_dependencia' => $this->row['iddependencia']
            ];

            if (!SerieDependenciaTemp::newRecord($attributes)) {
                $this->errorException("Error al vincular la serie con la dependencia");
            }
        } else {
            if ($sinSubserie) {
                $this->errorException("La serie ya se encuentra vinculada");
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
            'fk_serie_version' => $this->fk_serie_version,
            'dias_respuesta' => 0,
            'sop_papel' => $this->row['sop_papel'],
            'sop_electronico' => $this->row['sop_electronico'],
            'cod_arbol' => 0
        ];

        if (!$id = SerieTemp::newRecord($attributes)) {
            $this->errorException("Error al insertar el tipo documental");
        }
        return $id;
    }

    private function validateSerieSubserie($data = array(), int $tipo = 1)
    {

        $existSerie = HelperSerie::validateSerieDependencia(
            'serie_temp',
            $tipo,
            $data['cod_serie'],
            $this->row['iddependencia'],
            $data['idseriePadre'] ?? 0
        );

        if ($existSerie) {
            if ($existSerie['nombre'] != trim($data['serie'])) {
                $this->errorException("La serie/subserie con codigo {$data['cod_serie']} ya existe");
            } else {
                if ($tipo == 1) {
                    return $existSerie['idserie'];
                } else {
                    $this->errorException("La subserie ya se encuentra vinculada a esta dependencia");
                }
            }
        }
        return false;
    }

    private function errorException($message)
    {
        if ($this->fila) {
            $text = "En la fila {$this->fila} : {$message}";
        } else {
            $text = $message;
        }
        throw new Exception($text);
    }

    public static function truncate()
    {
        SerieTemp::truncateTable('serie_temp');
        SerieDependenciaTemp::truncateTable('serie_dependencia_temp');
    }
}
