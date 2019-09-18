<?php
class CajaController
{

    public static function createCajaCont(array $data = []): array
    {
        $response = [
            'exito' => 0,
            'message' => ''
        ];
        if (!empty($data)) {
            $data['propietario'] = $_SESSION['idfuncionario'];
            $data['responsable'] = $_SESSION['idfuncionario'];
            $data['fecha_creacion'] = date('Y-m-d H:i:s');
            $data['estado'] = 1;

            $Caja = new Caja();
            $Caja->setAttributes($data);
            if ($Caja->create()) {
                $response['exito'] = 1;
                $response['message'] = 'Caja creada!';
                $response['data']['id'] = $Caja->getPK();
                if (!empty($data['generarFiltro']) && !empty($data['idbusqueda_componente'])) {
                    $attributes = [
                        'fk_busqueda_componente' => $data["idbusqueda_componente"],
                        'funcionario_idfuncionario' => $_SESSION['idfuncionario'],
                        'fecha' => date("Y-m-d H:i:s"),
                        'detalle' => 'idcaja|=|' . $Caja->getPK(),
                    ];
                    $BusquedaFiltroTemp = new BusquedaFiltroTemp();
                    $BusquedaFiltroTemp->setAttributes($attributes);
                    if ($BusquedaFiltroTemp->create()) {
                        $response['data']['idbusqueda_filtro_temp'] = $BusquedaFiltroTemp->getPK();
                    }
                }
            } else {
                $response['message'] = 'Error al crear la caja';
            }
        } else {
            $response['message'] = 'Faltan parametros obligatorios';
        }
        return $response;
    }

    public static function updateCajaCont(array $data = []): array
    {
        $response = [
            'exito' => 0,
            'message' => ''
        ];
        if (!empty($data['idcaja'])) {

            $Caja = new Caja($data['idcaja']);
            $Caja->setAttributes($data);
            if ($Caja->update()) {
                $response['exito'] = 1;
                $response['message'] = 'Caja actualizada!';
                $response['data']['id'] = $Caja->getPK();
            } else {
                $response['message'] = 'Error al actualizar la caja';
            }
        } else {
            $response['message'] = 'Faltan parametros obligatorios';
        }
        return $response;
    }


    /**
     * Actualiza el responsable de la caja
     *
     * @param array $data :id de la caja y id del funcionario
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function updateResponsableCajaCont(array $data = []): array
    {
        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];
        if (!empty($data['idcaja'])) {
            if (!empty($data['responsable'])) {
                $Caja = new Caja($data['idcaja']);
                $responsableAnt = $Caja->responsable;
                $Caja->responsable = $data['responsable'][0];
                if ($responsableAnt != $Caja->responsable) {
                    if ($Caja->update()) {
                        $response['message'] = 'Responsable actualizado!';
                        $response['exito'] = 1;
                    } else {
                        $response['message'] = 'Error al actualizar el responsable';
                    }
                } else {
                    $response['message'] = 'Responsable actualizado!';
                    $response['exito'] = 1;
                }
            } else {
                $response['message'] = 'faltan el identificador del responsable';
            }
        } else {
            $response['message'] = 'faltan el identificador de la caja';
        }

        return $response;
    }

    /**
     * Elimina la caja 
     *
     * @param array $data : array con el idcaja
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public static function deleteCajaCont(array $data = []): array
    {
        $response = [
            'exito' => 0,
            'message' => 'Faltan datos a procesar'
        ];

        if (!empty($data['idcaja'])) {
            $Caja = new Caja($data['idcaja']);
            if ($Caja->estado == 1) {
                $sql = "SELECT count(idcaja_eli) as cant FROM caja_eli WHERE fk_caja={$data['idcaja']} AND fecha_accion IS NULL";
                //$exis = //ejecuta el select
                if (!$exis[0]['cant']) {
                    $CajaEli = new CajaEli();
                    $attributes = [
                        'fk_caja' => $data['idcaja'],
                        'eliminar_expediente' => $data['eliminar_expediente'],
                        'fk_funcionario' => $_SESSION['idfuncionario'],
                        'fecha_eliminacion' => date('Y-m-d H:i:s')
                    ];
                    $CajaEli->setAttributes($attributes);
                    if ($CajaEli->create()) {
                        $Caja->estado = 0;
                        $Caja->fk_caja_eli = $CajaEli->getPK();
                        if ($Caja->update()) {
                            $response['message'] = 'Caja eliminada';
                            if ($data['eliminar_expediente']) {
                                $sql = "UPDATE expediente SET estado=0,fk_caja_eli={$CajaEli->getPK()} WHERE fk_caja={$data['idcaja']} AND estado=1";
                                /*if (//ejecuta el update) {
                                    $response['exito'] = 1;
                                } else {
                                    $CajaEli->delete();
                                    $Caja->estado = 1;
                                    $Caja->fk_caja_eli = 'NULL';
                                    $Caja->update();
                                    $response['message'] = 'Error al eliminar los expedientes de la caja';
                                }*/
                            } else {
                                $sql = "UPDATE expediente SET fk_caja=NULL WHERE fk_caja={$data['idcaja']}";
                                /*if (//ejecuta el update) {
                                    $response['exito'] = 1;
                                } else {
                                    $response['message'] = 'Error al actualizar la caja de los expedientes';
                                }*/
                            }
                        } else {
                            $CajaEli->delete();
                            $response['message'] = 'Error al eliminar la Caja';
                        }
                    }
                } else {
                    $response['message'] = 'No se puede eliminar el Caja, contacte al administrador';
                }
            } else {
                $response['message'] = 'El Caja ya se ha eliminado';
            }
        } else {
            $response['message'] = 'Falta el identificar de la Caja';
        }
        return ($response);
    }

    /**
     * Restaura la caja Eliminada
     *
     * @param array $data : array con idcaja
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public static function restoreCajaCont(array $data = []): array
    {

        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];

        if (!empty($data['idcaja'])) {
            $Caja = new Caja($data['idcaja']);
            if ($Caja->estado == 0) {
                $sql = "SELECT * FROM caja_eli WHERE fk_caja={$data['idcaja']} AND fecha_accion IS NULL";
                //$instance = CajaEli:: buscar con queryBuilder;
                if ($instance) {
                    $Caja->estado = 1;
                    $Caja->fk_caja_eli = 'NULL';
                    if ($Caja->update()) {
                        $CajaDel = $instance[0];
                        $CajaDel->fecha_accion = date('Y-m-d H:i:s');
                        $CajaDel->accion = 2;
                        if ($CajaDel->update()) {
                            $response['message'] = 'Caja restaurada';
                            if ($CajaDel->eliminar_expediente) {
                                $sql = "UPDATE expediente SET estado=1,fk_caja_eli=NULL WHERE fk_caja_eli={$CajaDel->getPK()}";
                                /*if (//ejecuta el update) {
                                    $response['exito'] = 1;
                                } else {
                                    $Caja->estado = 0;
                                    $Caja->fk_caja_eli = $CajaDel->getPK();
                                    $Caja->update();

                                    $CajaDel->fecha_accion = 'NULL';
                                    $CajaDel->accion = 'NULL';
                                    $CajaDel->update();
                                    $response['message'] = 'No se pudieron restaurar los expedientes vinculados a la caja';
                                }*/
                            } else {
                                $response['exito'] = 1;
                            }
                        } else {
                            $Caja->estado = 0;
                            $Caja->fk_caja_eli = $CajaDel->getPK();
                            $Caja->update();
                            $response['message'] = 'No se pudo registrar la solicitud de restauracion';
                        }
                    } else {
                        $response['message'] = 'No se pudo restaurar la caja';
                    }
                } else {
                    $response['message'] = 'No se puede restaurar la caja, contacte al administrador';
                }
            } else {
                $response['message'] = 'La caja NO se encuentra eliminada';
            }
        } else {
            $response['message'] = 'Falta el identificador de la caja';
        }
        return ($response);
    }

    /**
     * Elimina definitivamente la caja
     *
     * @param array $data : array con idcaja
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public static function deleteDefCajaCont(array $data = []): array
    {
        $response = [
            'exito' => 0,
            'message' => ''
        ];

        if (!empty($data['idcaja'])) {
            $Caja = new Caja($data['idcaja']);
            if ($Caja->estado == 0) {
                $sql = "SELECT * FROM caja_eli WHERE fk_caja={$data['idcaja']} AND fecha_accion IS NULL";
                //$instance = CajaEli:: buscar con queryBuilder
                if ($instance) {
                    $CajaDel = $instance[0];
                    $CajaDel->fecha_accion = date("Y-m-d H:i:s");
                    $CajaDel->accion = 1;
                    if ($CajaDel->update()) {
                        $response['exito'] = 1;
                        $response['message'] = 'Se ha eliminado la caja';
                    } else {
                        $response['message'] = 'se presento un error al eliminar definitivamente la caja, intente de nuevo';
                    }
                } else {
                    $response['message'] = 'No se puede eliminar definitivamente la caja, contacte al administrador';
                }
            } else {
                $response['message'] = 'La caja NO se encuentra eliminada';
            }
        } else {
            $response['message'] = 'Falta el identificador de la caja';
        }
        return ($response);
    }

    /**
     * Retorna los vinculaciones de la caja
     * 
     *
     * @param array $data : array con el idcaja
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function getCajaEntidadSerieCont(array $data = []): array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];

        if (!empty($data['idcaja'])) {
            $sql = "SELECT ce.idcaja_entidadserie,d.nombre as dependencia,s.nombre as serie,ce.fecha_creacion 
            FROM caja c,caja_entidadserie ce,entidad_serie e,dependencia d,serie s 
            WHERE c.idcaja=ce.fk_caja AND ce.fk_entidad_serie=e.identidad_serie AND e.fk_dependencia=d.iddependencia 
            AND e.fk_serie=s.idserie AND e.estado=1 AND s.estado=1 AND d.estado=1 AND c.idcaja={$data['idcaja']} ";
            //$records = //ejecuta el select
            if ($records) {
                $data = [];
                foreach ($records as $record) {
                    $data[] = [
                        'idcaja_entidadserie' => $record['idcaja_entidadserie'],
                        'nombreDependencia' => $record['dependencia'],
                        'nombreSerie' => $record['serie'],
                        'fechaCreacion' => $record['fecha_creacion'],
                    ];
                }
                $response['data'] = $data;
            }
            $response['exito'] = 1;
            $response['message'] = 'Datos cargados';
        } else {
            $response['message'] = 'faltan el identificador de la caja';
        }

        return $response;
    }

    /**
     * retorna los datos de entidadSerie 
     * para ser procesador por SELECT2
     *
     * @param array $data
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function listEntidadSerie(array $data = []): array
    {
        $response = [
            'results' => []
        ];
        if ($data['search'] != "") {
            $subQuery = "SELECT fk_entidad_serie FROM caja_entidadserie WHERE fk_caja={$data['idcaja']}";

            $sql = "SELECT e.identidad_serie,d.nombre as dependencia,s.nombre as serie FROM entidad_serie e, dependencia d,serie s 
            WHERE e.fk_dependencia=d.iddependencia AND e.fk_serie=s.idserie AND e.estado=1 AND d.estado=1 AND s.estado=1  AND s.tipo in (1,2)
            AND e.identidad_serie NOT IN ({$subQuery}) AND (s.nombre like '%{$data['search']}%' OR d.nombre like '%{$data['search']}%')";
            //$records = //ejecuta el select
            if ($records) {
                $results = [];
                foreach ($records as $record) {
                    $results[] = [
                        'id' => $record['identidad_serie'],
                        'text' => $record['dependencia'] . ' -- ' . $record['serie']
                    ];
                }
                $response['results'] = $results;
            }
        }
        return $response;
    }

    public function insertCajaEntidadSerieCont(array $data = []): array
    {
        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];
        if (!empty($data['idcaja'])) {
            if (!empty($data['ids'])) {
                $success = 0;
                foreach ($data['ids'] as $idEntidadSerie) {
                    $attributes = [
                        'fk_caja' => $data['idcaja'],
                        'fk_entidad_serie' => $idEntidadSerie,
                        'fecha_creacion' => date('Y-m-d H:i:s')
                    ];
                    $CajaEntidadSerie = new CajaEntidadSerie();
                    $CajaEntidadSerie->setAttributes($attributes);
                    if ($CajaEntidadSerie->create()) {
                        $success++;
                    }
                }
                if ($success == count($data['ids'])) {
                    $response['exito'] = 1;
                    $response['message'] = 'Se ha vinculado la dependencia/serie';
                } else if ($success) {
                    $response['exito'] = 2;
                    $response['message'] = 'Se han vinculado algunas dependencia/serie';
                } else {
                    $response['message'] = 'Error al vincular las depencias/serie';
                }
            }
        } else {
            $response['message'] = 'Falta el identificador de la caja';
        }
        return $response;
    }

    public function deleteVinCajaEntidadSerieCont(array $data = []): array
    {
        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];
        if (!empty($data['idcaja_entidadserie'])) {
            $CajaEntidadSerie = new CajaEntidadserie($data['idcaja_entidadserie']);
            if ($CajaEntidadSerie->delete()) {
                $response['exito'] = 1;
                $response['message'] = 'Caja eliminada!';
            }
        }
        return $response;
    }
}
