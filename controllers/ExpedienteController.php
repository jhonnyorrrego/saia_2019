<?php
class ExpedienteController
{

    /**
     * Apertura y cierre de los expedientes
     *
     * @param array $data 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function aperturaCierreExpedienteCont(array $data = []) : array
    {
        $response = [
            'exito' => 0,
            'message' => ''
        ];
        if (!empty($data['idexpediente'])) {
            $Expediente = new Expediente($data['idexpediente']);
            $estadoActual = $Expediente->estado_cierre;
 
            if ($estadoActual == 1) {
                $ok = $Expediente->canClose();
                $Expediente->estado_cierre = 2;
                $Expediente->fecha_cierre = date('Y-m-d H:i:s');
                $Expediente->funcionario_cierre = $_SESSION['idfuncionario'];
            } else {
                $ok = true;
                $Expediente->estado_cierre = 1;
                $Expediente->fecha_cierre = 'NULL';
                $Expediente->funcionario_cierre = 'NULL';
            }
            if ($ok) {
                if ($Expediente->update()) {
                    $response['exito'] = 1;
                    $attributes = [
                        'fk_expediente' => $data['idexpediente'],
                        'fk_funcionario' => $_SESSION['idfuncionario'],
                        'accion' => $Expediente->estado_cierre,
                        'observacion' => $data['observacion'],
                        'fecha_accion' => date('Y-m-d H:i:s')
                    ];
                    $ExpedienteCierre = new ExpedienteCierre();
                    $ExpedienteCierre->setAttributes($attributes);
                    if (!$ExpedienteCierre->create()) {
                        $Expediente->estado_cierre = $estadoActual;
                        $Expediente->update();

                        $response['exito'] = 0;
                        $response['message'] = 'Error al crear el historial del cambio';
                    }
                }
            } else {
                $response['message'] = 'Debe cerrar primero los expedientes inferiores';
            }
        } else {
            $response['message'] = 'faltan el identificador del expediente';
        }
        return $response;
    }

    /**
     * Actualiza el responsable del expediente
     *
     * @param array $data :id del expediente y id del funcionario
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function updateResponsableExpedienteCont(array $data = []) : array
    {
        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];
        if (!empty($data)) {
            if (!empty($data['idexpediente'])) {
                if (!empty($data['responsable'])) {
                    $Expediente = new Expediente($data['idexpediente']);
                    $responsableAnt = $Expediente->responsable;
                    $Expediente->responsable = $data['responsable'][0];
                    $response = $Expediente->updateResponsable($responsableAnt);
                    if ($response['exito']) {
                        $response['message'] = 'Responsable actualizado!';
                    }
                } else {
                    $response['message'] = 'faltan el identificador del responsable';
                }
            } else {
                $response['message'] = 'faltan el identificador del expediente';
            }
        }
        return $response;
    }

    /**
     * Inserta permisos al expediente
     * Solo inserta el compartir
     *
     * @param array $data : ids de los expedientes / ids de los funcionarios
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function insertPemisoExpedienteCont(array $data = []) : array
    {
        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];
        if (!empty($data)) {
            if (!empty($data['idsExp'])) {
                if (!empty($data['idfuncionario'])) {

                    $idExp = explode(',', $data['idsExp']);
                    $cant = 0;
                    $success = 0;

                    foreach ($data['idfuncionario'] as $user) {
                        $sql = "SELECT identidad_expediente FROM entidad_expediente WHERE tipo_funcionario=0 AND fk_funcionario={$user}";
                        foreach ($idExp as $idexpediente) {
                            $cant++;
                            $sql .= " AND fk_expediente={$idexpediente}";
                            $record = StaticSql::search($sql);
                            if ($record) {
                                $EntidadExpediente = new EntidadExpediente($record[0]['identidad_expediente']);
                                $EntidadExpediente->setAccessPermits('c');
                                $EntidadExpediente->setAccessPermits('v');
                                $info = $EntidadExpediente->updateEntidadExpediente();
                                if ($info['exito']) {
                                    $success++;
                                }
                            } else {
                                $attributes = [
                                    'fk_funcionario' => $user,
                                    'fecha' => date('Y-m-d H:i:s'),
                                    'tipo_funcionario' => 0,
                                    'permiso' => 'c,v',
                                    'fk_expediente' => $idexpediente
                                ];
                                $EntidadExpediente = new EntidadExpediente();
                                $EntidadExpediente->setAttributes($attributes);
                                $info = $EntidadExpediente->createEntidadExpediente(false);
                                if ($info['exito']) {
                                    $success++;
                                }
                            }
                        }
                    }
                    if ($cant == $success) {
                        $response['exito'] = 1;
                        $response['message'] = 'Permiso adicionado!';
                    } else if ($success) {
                        $response['exito'] = 2;
                        $response['message'] = 'No se adicionaron todos los permisos';
                    } else {
                        $response['message'] = 'Error al vincular el permiso a los expedientes';
                    }

                } else {
                    $response['message'] = 'faltan el identificador del funcionario(s)';
                }
            } else {
                $response['message'] = 'faltan el identificador del expediente';
            }
        }
        return $response;
    }

    /**
     * retorna los datos para ser procesador por SELECT2
     *
     * @param array $data
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function listFuncionarios(array $data = []) : array
    {
        $response = [
            'results' => []
        ];
        if ($data['search'] != "") {
            $sql = "SELECT idfuncionario,nombres,apellidos FROM funcionario WHERE estado=1 and (lower(nombres) like '%{$data['search']}%' OR lower(apellidos) like '%{$data['search']}%' ) ";
            if (!empty($data['where'])) {
                $sql .= $data['where'];
            }
            $records = StaticSql::search($sql);
            if ($records) {
                $results = [];
                foreach ($records as $record) {
                    $results[] = [
                        'id' => $record['idfuncionario'],
                        'text' => $record['nombres'] . ' ' . $record['apellidos']
                    ];
                }
                $response['results'] = $results;
            }
        }
        return $response;
    }

    /**
     * Elimina el permiso de Compartir expediente 
     *
     * @param array $data : array debe tener el idpermiso_expediente
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function deletePemisoExpedienteCont(array $data = []) : array
    {
        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];
        if (!empty($data)) {
            if (!empty($data['idpermiso'])) {
                $sql = "SELECT identidad_expediente FROM permiso_expediente p,entidad_expediente ex WHERE p.fk_funcionario=ex.fk_funcionario AND p.fk_expediente=ex.fk_expediente AND p.tipo_funcionario=ex.tipo_funcionario AND p.idpermiso_expediente={$data['idpermiso']}";
                $instance = UtilitiesController::instanceSql('EntidadExpediente', 'identidad_expediente', $sql);
                if ($instance) {
                    $EntidadExpediente = $instance[0];
                    $EntidadExpediente->setAccessPermits('c', false);
                    $response = $EntidadExpediente->updateEntidadExpediente();
                } else {
                    $permisoExpediente = new PermisoExpediente($data['idpermiso']);
                    if ($permisoExpediente->delete()) {
                        $response['message'] = 'Permiso eliminado!';
                        $response['exito'] = 1;
                    } else {
                        $response['message'] = 'No se pudo eliminar el permiso';
                    }
                }
            } else {
                $response['message'] = 'faltan el identificador del permiso';
            }
        }
        return $response;
    }
    /**
     * Retorna los funciorios
     * con permisos sobre los expedientes
     *
     * @param array $data : array con los ids del los expedientes
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function getPermisoExpedienteCont(array $data = []) : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];

        if (!empty($data)) {
            if (!empty($data['idexpediente'])) {
                $sql = "SELECT DISTINCT f.nombres,f.apellidos,p.idpermiso_expediente,e.nombre as nombre_expediente FROM permiso_expediente p,funcionario f,expediente e WHERE p.fk_funcionario=f.idfuncionario AND e.idexpediente=p.fk_expediente AND p.tipo_funcionario=0 AND p.fk_entidad=1 AND p.permiso like '%c%'";
                if (is_array($data['idexpediente'])) {
                    $sql .= " AND p.fk_expediente in (" . implode(',', $data['idexpediente']) . ")";
                } else {
                    $sql .= " AND p.fk_expediente={$data['idexpediente']}";
                }

                $records = StaticSql::search($sql);
                if ($records) {
                    $permisos = [];
                    foreach ($records as $record) {
                        $permisos[] = [
                            'idpermiso' => $record['idpermiso_expediente'],
                            'nombreExpediente' => $record['nombre_expediente'],
                            'funcionario' => $record['nombres'] . ' ' . $record['apellidos']
                        ];
                    }
                    $response['data'] = $permisos;
                }
                $response['exito'] = 1;
                $response['message'] = 'Funcionarios cargados';
            } else {
                $response['message'] = 'faltan los identificadores de los expedientes';
            }
        }
        return $response;
    }

    /**
     * Procesa los datos del formulario y crea el expediente
     *
     * @param array $data : array con los datos del formulario
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function createExpedienteCont(array $data = []) : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];

        if (!empty($data)) {
            if (!empty($data['cod_padre'])) {
                $instance = new Expediente($data['cod_padre']);

                $attributes = $data;
                $attributes['propietario'] = $_SESSION['idfuncionario'];
                $attributes['responsable'] = $_SESSION['idfuncionario'];
                $attributes['estado_archivo'] = $instance->estado_archivo;
                $attributes['fk_serie'] = $instance->fk_serie;
                $attributes['nucleo'] = 0;
                $attributes['cod_arbol'] = 0;
                $attributes['fk_dependencia'] = $instance->fk_dependencia;
                $attributes['fk_entidad_serie'] = $instance->fk_entidad_serie;
                if (empty($attributes['fecha'])) {
                    $attributes['fecha'] = date('Y-m-d H:i:s');
                }

                $Expediente = new Expediente();
                $Expediente->setAttributes(UtilitiesController::cleanForm($attributes));
                $response = $Expediente->CreateExpediente();
                if ($response['exito']) {
                    $response['message'] = 'Expediente guardado';
                    if (!empty($data['generarfiltro']) && !empty($data['idbusqueda_componente'])) {
                        $attributes = [
                            'fk_busqueda_componente' => $data["idbusqueda_componente"],
                            'funcionario_idfuncionario' => $_SESSION['idfuncionario'],
                            'fecha' => date("Y-m-d H:i:s"),
                            'detalle' => 'idexpediente|=|' . $Expediente->getPK(),
                        ];
                        $BusquedaFiltroTemp = new BusquedaFiltroTemp();
                        $BusquedaFiltroTemp->setAttributes($attributes);
                        if ($BusquedaFiltroTemp->save()) {
                            $response['data']['idbusqueda_filtro_temp'] = $BusquedaFiltroTemp->getPK();
                        }
                    }
                }
            } else {
                $response['message'] = 'falta campos obligatorios expediente padre';
            }
        }
        return ($response);
    }

    /**
     * Procesa los datos del formulario y actualiza el expediente
     *
     * @param array $data : array con los datos del formulario
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function updateExpedienteCont(array $data = []) : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];

        if (!empty($data)) {
            if (!empty($data['cod_padre']) && !empty($data['idexpediente'])) {
                $Expediente = new Expediente($data['idexpediente']);
                if ($data['agrupador'] == 3) {
                    $data['descripcion'] = 'NULL';
                    $data['indice_uno'] = 'NULL';
                    $data['indice_dos'] = 'NULL';
                    $data['indice_tres'] = 'NULL';
                    $data['fk_caja'] = 'NULL';
                    $data['codigo_numero'] = 'NULL';
                    $data['fondo'] = 'NULL';
                    $data['proceso'] = 'NULL';
                    $data['fecha_extrema_i'] = 'NULL';
                    $data['fecha_extrema_f'] = 'NULL';
                    $data['consecutivo_inicial'] = 'NULL';
                    $data['consecutivo_final'] = 'NULL';
                    $data['no_unidad_conservacion'] = 'NULL';
                    $data['no_folios'] = 'NULL';
                    $data['no_carpeta'] = 'NULL';
                    $data['soporte'] = 'NULL';
                    $data['frecuencia_consulta'] = 'NULL';
                    $data['notas_transf'] = 'NULL';
                }
                $Expediente->setAttributes($data);

                if ($Expediente->update()) {
                    $response['message'] = 'Expediente actualizado';
                    $response['exito'] = 1;
                    if (!empty($data['generarfiltro']) && !empty($data['idbusqueda_componente'])) {
                        $attributes = [
                            'fk_busqueda_componente' => $data["idbusqueda_componente"],
                            'funcionario_idfuncionario' => $_SESSION['idfuncionario'],
                            'fecha' => date("Y-m-d H:i:s"),
                            'detalle' => 'idexpediente|=|' . $Expediente->getPK(),
                        ];
                        $BusquedaFiltroTemp = new BusquedaFiltroTemp();
                        $BusquedaFiltroTemp->setAttributes($attributes);
                        if ($BusquedaFiltroTemp->save()) {
                            $response['data']['idbusqueda_filtro_temp'] = $BusquedaFiltroTemp->getPK();
                        }
                    }
                }
            } else {
                $response['message'] = 'faltal campos obligatorios expediente/expediente padre';
            }
        }
        return ($response);
    }

    /**
     * Elimina el expediente y lo mueve a la papelera
     *
     * @param array $data : array con el idexpediente
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public static function deleteExpedienteCont(array $data = []) : array
    {

        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];

        if (!empty($data['idexpediente'])) {
            $Expediente = new Expediente($data['idexpediente']);
            if ($Expediente->estado == 1) {
                $sql = "SELECT count(idexpediente_eli) as cant FROM expediente_eli WHERE fk_expediente={$data['idexpediente']} AND fecha_restauracion IS NULL";
                $exis = StaticSql::search($sql);
                if (!$exis[0]['cant']) {
                    $ExpDel = new ExpedienteEli();
                    $attributes = [
                        'fk_expediente' => $data['idexpediente'],
                        'fk_funcionario' => $_SESSION['idfuncionario'],
                        'fecha_eliminacion' => date('Y-m-d H:i:s')
                    ];
                    $ExpDel->setAttributes($attributes);
                    if ($ExpDel->create()) {
                        $sql = "UPDATE expediente SET estado=0,fk_expediente_eli={$ExpDel->getPK()} WHERE idexpediente={$data['idexpediente']} OR (cod_arbol like '{$Expediente->cod_arbol}.%' AND estado=1)";
                        if (StaticSql::query($sql)) {
                            $response['exito'] = 1;
                            $response['message'] = 'Expediente eliminado';
                        } else {
                            $ExpDel->delete();
                            $response['message'] = 'Error al eliminar el expediente';
                        }
                    }
                } else {
                    $response['message'] = 'No se puede eliminar el expediente, contacte al administrador';
                }
            } else {
                $response['message'] = 'El expediente se encuentra inactivo';
            }
        } else {
            $response['message'] = 'Falta el identificar del expediente';
        }
        return ($response);
    }

    /**
     * Restaura un expediente eliminado
     *
     * @param array $data : array con el idexpediente
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public static function restoreExpedienteCont(array $data = []) : array
    {

        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];

        if (!empty($data['idexpediente'])) {
            $Expediente = new Expediente($data['idexpediente']);
            if ($Expediente->estado == 0) {
                $Expadre = $Expediente->getCodPadre();
                if ($Expadre) {
                    if ($Expadre->estado) {
                        if ($Expadre->estado_cierre == 2) {
                            $response['message'] = 'No se puede restaurar el expediente, el expediente superior se encuentra cerrado';
                        } else {
                            $sql = "SELECT idexpediente_eli FROM expediente_eli WHERE fk_expediente={$data['idexpediente']} AND fecha_restauracion IS NULL";
                            $instance = UtilitiesController::instanceSql('ExpedienteEli', 'idexpediente_eli', $sql);
                            if ($instance) {
                                $ExpDel = $instance[0];
                                $ExpDel->fecha_restauracion = date('Y-m-d H:i:s');
                                if ($ExpDel->update()) {
                                    $sql = "UPDATE expediente SET estado=1,fk_expediente_eli=NULL WHERE idexpediente={$data['idexpediente']} OR cod_arbol like '{$Expediente->cod_arbol}.%' ";
                                    if (StaticSql::query($sql)) {
                                        $response['exito'] = 1;
                                        $response['message'] = 'Expediente restaurado';
                                    } else {
                                        $ExpDel->fecha_restauracion = 'NULL';
                                        $ExpDel->update();
                                        $response['message'] = 'Error al restaurar el expediente';
                                    }
                                }
                            } else {
                                $response['message'] = 'No se puede restaurar el expediente, contacte al administrador';
                            }
                        }
                    } else {
                        $response['message'] = 'No se puede restaurar el expediente, el expediente superior se encuentra eliminado';
                    }

                } else {
                    $response['message'] = 'No se encuentran datos del expediente superior';
                }
            } else {
                $response['message'] = 'El expediente NO se encuentra eliminado';
            }
        } else {
            $response['message'] = 'Falta el identificar del expediente';
        }
        return ($response);
    }

    /**
     * Procesa los datos del formulario y crea el tomo del expediente
     *
     * @param array $data : array con los datos del formulario
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function createTomoExpedienteCont(array $data = []) : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];
        if (!empty($data)) {
            if ($data['idexpediente']) {
                $Expediente = new Expediente($data['idexpediente']);
                $tomoPadre = $data['idexpediente'];
                if ($Expediente->tomo_padre) {
                    $tomoPadre = $Expediente->tomo_padre;
                }
                $cant = $Expediente->countTomos();

                $ExpTomo = clone $Expediente;
                $ExpTomo->setPK(0);
                $attributes = [
                    'fecha' => date('Y-m-d H:i:s'),
                    'propietario' => $_SESSION['idfuncionario'],
                    'responsable' => $_SESSION['idfuncionario'],
                    'tomo_padre' => $tomoPadre,
                    'tomo_no' => $cant + 1,
                    'cod_arbol' => 0
                ];
                $ExpTomo->setAttributes($attributes);
                $info = $ExpTomo->CreateExpediente();
                $response = $info;

                if ($info['exito']) {
                    $response['data']['cod_padre'] = $ExpTomo->cod_padre;
                    if (!empty($data['generarfiltro']) && !empty($data['idbusqueda_componente'])) {
                        $attributes = [
                            'fk_busqueda_componente' => $data["idbusqueda_componente"],
                            'funcionario_idfuncionario' => $ExpTomo->propietario,
                            'fecha' => date("Y-m-d H:i:s"),
                            'detalle' => 'idexpediente|=|' . $ExpTomo->getPK(),
                        ];
                        $BusquedaFiltroTemp = new BusquedaFiltroTemp();
                        $BusquedaFiltroTemp->setAttributes($attributes);
                        if ($BusquedaFiltroTemp->save()) {
                            $response['data']['idbusqueda_filtro_temp'] = $BusquedaFiltroTemp->getPK();
                        }
                    }
                }
            }
        }

        return $response;
    }


    /**
     * Crea la jerarquia de entidad entidad serie
     *
     * @param string $codArbol : codigo arbol de la serie
     * @param array $attributes : datos a almacenar de la serie
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function createEntidadSerieCodArbol(string $codArbol, array $attributes = []) : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => ''
        ];
        $SeriesPadres = explode('.', $codArbol);
        $idActual = array_pop($SeriesPadres);
        unset($idActual);
        $cant = count($SeriesPadres);
        if ($cant) {
            $ok = 0;
            foreach ($SeriesPadres as $id) {
                $sql = "SELECT identidad_serie FROM entidad_serie WHERE fk_serie={$id} and fk_dependencia={$attributes['fk_dependencia']} and estado=1";
                $exist = StaticSql::search($sql);
                if (!$exist) {
                    $attributesPadre = $attributes;
                    $attributesPadre['fk_serie'] = $id;

                    $EntidadSeriePadre = new EntidadSerie();
                    $EntidadSeriePadre->SetAttributes($attributesPadre);
                    $info = $EntidadSeriePadre->CreateEntidadSerie();
                    if ($info['exito']) {
                        $ok++;
                    }
                } else {
                    $ok++;
                }

            }
            if ($cant == $ok) {
                $response['exito'] = 1;
                $response['message'] = 'Se asignaron los permisos a las series padres';
            } else if ($ok) {
                $response['exito'] = 2;
                $response['message'] = 'Se asignaron algunos permisos a las series padres';
            }
        } else {
            $response['exito'] = 1;
            $response['message'] = 'Sin series padres';
        }
        return $response;
    }

}