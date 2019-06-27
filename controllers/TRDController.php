<?php

class TRDController
{
    protected $urlEXcel;
    protected $data;
    protected $messageError = [];

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
            'rete_central',
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
        foreach ($this->data as $registro) {

            $row = $this->validateFields($registro);
            if (empty($this->messageError)) {

                if (!$row['idserie']) {
                    $r_ges = 0;
                    $r_cen = 0;
                    $pro = '-';
                    
                    if ($row['idsubserie'] == -1) {
                        $r_ges = $row['ret_gestion'];
                        $r_cen = $row['ret_central'];
                        $pro = $row['procedimiento'];
                    }
                    $attributes = [
                        'cod_padre' => 0,
                        'nombre' => $row['serie'],
                        'codigo' => $row['cod_serie'],
                        'retencion_gestion' => $r_ges,
                        'retencion_central' => $r_cen,
                        'procedimiento' => $pro,
                        'dias_respuesta' => 0,
                        'tipo' => 1,
                        'fk_serie_version' => 0,
                        'cod_arbol' => 0,
                        'estado' => 1
                    ];
                    $idserie = $this->insertSerieTemp($attributes);
                    die("aqui voy");
                    if ($idserie) {
                        $row['idserie'] = $idserie;
                    } else {
                        throw new Exception("Error al insertar la serie, contacte al administrador");
                    }
                }

                if ($row['idserie']) { }
            } else {
                $ul = '<ul><li>' . implode('</li><li>', $this->messageError) . '</li></ul>';
                $response['message'] = "Se encontraron los siguientes errores para el registro # {$fila}:{$ul}";
            }
            $fila++;
        }

        return $response;
    }

    private function validateFields($row)
    {
        if (empty($row['ret_gestion'])) {
            $row['ret_gestion'] = 0;
        }
        if (!is_int($row['ret_gestion'])) {
            $this->error("La retencion gestion debe ser un numero entero ({$row['ret_gestion']})");
        }

        if (empty($row['ret_central'])) {
            $row['ret_central'] = 0;
        }
        if (!is_int($row['ret_central'])) {
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

        return $this->validateSerieSubserie($row);
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


    private function validateSerieSubserie($row)
    {
        $row['serie'] = htmlentities(trim($row['serie']));
        $row['serie'] = htmlentities(trim($row['subserie']));

        $idserie = 0;
        $idsubserie = -1;

        $sqlSerie = "SELECT idserie,nombre FROM serie_temp 
        WHERE codigo like '{$row['cod_serie']}' and tipo=1";
        $existSerie = StaticSql::search($sqlSerie);

        if ($existSerie) {
            if ($existSerie[0]['nombre'] != $row['serie']) {
                $this->error("La serie con codigo {$row['cod_serie']} ya existe con otro nombre");
            } else {
                $idserie = $existSerie[0]['idserie'];
                if ($row['cod_subserie']) {

                    $idsubserie = 0;
                    $sqlSubSerie = "SELECT idserie,nombre FROM serie_temp 
                    WHERE codigo like '{$row['cod_subserie']}' and tipo=2 and cod_padre={$idserie}";
                    $existSubSerie = StaticSql::search($sqlSubSerie);
                    if ($existSubSerie) {
                        $idsubserie = $existSubSerie[0]['idserie'];

                        if ($existSubSerie[0]['nombre'] != $row['subserie']) {
                            $this->error("La Subserie con codigo {$row['cod_subserie']} de la serie ({$row['serie']}) ya existe con otro nombre");
                        }
                    }
                }
            }
        } else {
            if ($row['cod_subserie']) {
                $idsubserie = 0;
            }
        }
        $row['idserie'] = $idserie;
        $row['idsubserie'] = $idsubserie;

        return $row;
    }

    private function insertSerieTemp($data)
    {
        $insert = "INSERT INTO serie_temp (cod_padre, cod_arbol, nombre, codigo, tipo, dias_respuesta, retencion_gestion, retencion_central, fk_serie_version, procedimiento, estado)
        VALUES (0, '0', '{$row['serie']}', '{$row['cod_serie']}', 1, NULL, '5', '8', '1', 'procedimiento', '1');";
    }

    private function error($message)
    {
        $this->messageError[] = $message;
    }
}
