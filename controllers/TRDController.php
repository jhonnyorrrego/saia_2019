<?php

class TRDController
{
    protected $urlEXcel;
    protected $data;
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
            $this->error("No se pudieron limpiar las tablas temporales");
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
            'disp_eliminacion',
            'disp_seleccion',
            'disp_conservacion',
            'disp_microfilmacion',
            'procedimiento'
        ];
        $dataExcel = UtilitiesController::readFileExcel($this->urlEXcel, [4], $fields);
        $cantCabecera = count($fields);
        $cantCabeceraExcel = count($dataExcel[1]);

        if ($cantCabecera != $cantCabeceraExcel) {
            $this->error("La cantidad de columnas del excel ({$cantCabeceraExcel}) no coincide con la cantidad de cabeceras enviadas ({$cantCabecera})");
        } else {
            unset($dataExcel[1]);
        }
        $this->data = $dataExcel;

        return $this;
    }

    public function validateDataExcel()
    {
        $response = [
            'success' => 0,
            'message' => ''
        ];

        $fila = 2;
        $rowAnterior = array();
        foreach ($this->data as $registro) {

            $this->row = $this->validateFields($registro);

            if (empty($this->messageError)) {

                $this->row['idserie'] = $this->insertSerie();
                if ($this->row['idserie']) {

                    $this->row['id'] = $this->row['idserie'];
                    if (!$this->row['cod_subserie']) {
                        // TODO: TRD cuando sea una serie sin subserie
                        $idtipo = $this->insertTipoDocumental();
                    } else {

                        $idsubserie = $this->insertSubserie();
                        if ($idsubserie) {
                            $this->row['id'] = $idsubserie;
                            $this->row['idsubserie']=$idsubserie;

                            $idtipo = $this->insertTipoDocumental();
                        } else {
                            throw new Exception("Error al insertar la Subserie, contacte al administrador");
                        }
                    }
                } else {
                    throw new Exception("Error al insertar la serie, contacte al administrador");
                }
            } else {
                $ul = '<ul><li>' . implode('</li><li>', $this->messageError) . '</li></ul>';
                $response['message'] = "Se encontraron los siguientes errores para el registro # {$fila}:{$ul}";
            }
            $fila++;
            $rowAnterior = $this->row;

            die("--");
        }

        return $response;
    }

    private function validateFields($row)
    {
        if (empty($row['ret_gestion'])) {
            $row['ret_gestion'] = 0;
        }
        if (!is_numeric($row['ret_gestion'])) {
            $this->error("La retencion gestion debe ser un numero entero ({$row['ret_gestion']})");
        }
        if (empty($row['ret_central'])) {
            $row['ret_central'] = 0;
        }
        if (!is_numeric($row['ret_central'])) {
            $this->error("La retencion gestion debe ser un numero entero ({$row['ret_central']})");
        }
        if (empty($row['sop_papel']) && empty($row['sop_electronico'])) {
            $this->error("Debe seleccionar un tipo de soporte");
        }
        if (
            empty($row['disp_eliminacion']) && empty($row['disp_seleccion'])
            && empty($row['disp_conservacion']) && empty($row['disp_microfilmacion'])
        ) {
            $this->error("Debe seleccionar un tipo de Disposicion");
        }
        if (!empty($row['disp_eliminacion']) && !empty($row['disp_conservacion'])) {
            $this->error("NO pueden estar seleccionadas la diposicion CT y E en una misma serie/subserie");
        }

        $iddep = $this->validateDependencia($row['cod_dependencia']);
        if ($iddep !== false) {
            $row['iddependencia'] = $iddep;
        }

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
                    $this->error("La dependencia con codigo {$codDependencia} se encuentra inactiva");
                }
            } else {
                $this->error("La dependencia con codigo {$codDependencia} existe {$cant} veces");
            }
        } else {
            $this->error("La dependencia con codigo {$codDependencia} NO existe");
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

        if (!$idserie) {
            $r_ges = 0;
            $r_cen = 0;
            $pro = '-';

            if (!$this->row['cod_subserie']) {
                $r_ges = $this->row['ret_gestion'];
                $r_cen = $this->row['ret_central'];
                $pro = $this->row['procedimiento'];
            }

            $attributes = [
                'cod_padre' => 0,
                'nombre' => $this->row['serie'],
                'codigo' => $this->row['cod_serie'],
                'retencion_gestion' => $r_ges,
                'retencion_central' => $r_cen,
                'procedimiento' => $pro,
                'dias_respuesta' => 0,
                'tipo' => 1,
                'fk_serie_version' => 0,
                'cod_arbol' => 0,
                'estado' => 1
            ];
            $idserie = SerieTemp::newRecord($attributes);
        }
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
                'retencion_gestion' => $this->row['ret_gestion'],
                'retencion_central' => $this->row['ret_central'],
                'procedimiento' => $this->row['procedimiento'],
                'dias_respuesta' => 0,
                'tipo' => 2,
                'fk_serie_version' => 0,
                'cod_arbol' => 0,
                'estado' => 1
            ];
            $idsubserie = SerieTemp::newRecord($attributes);
        }
        return $idsubserie;
    }

    private function insertTipoDocumental(){

    }

    private function validateSerieSubserie($data = array(), $tipo = 1)
    {
        $nameSerie = htmlentities(trim($data['serie']));
        $parteWhere = '';
        if ($tipo == 2) {
            $parteWhere = "and cod_padre={$data['idseriePadre']}";
        }
        $sqlSerie = "SELECT idserie,nombre FROM serie_temp 
        WHERE codigo like '{$data['cod_serie']}' and tipo={$tipo} {$parteWhere}";
        $existSerie = StaticSql::search($sqlSerie);

        if ($existSerie) {
            if ($existSerie[0]['nombre'] != $nameSerie) {
                $this->error("La serie/subserie con codigo {$data['cod_serie']} ya existe con otro nombre");
            } else {
                return $existSerie[0]['idserie'];
            }
        }
        return false;
    }

    private function error($message)
    {
        $this->messageError[] = $message;
    }
}
