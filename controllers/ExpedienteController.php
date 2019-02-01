<?php
class ExpedienteController
{
    /**
     * Procesa los datos del formulario y crea el expediente
     *
     * @param array $data : array con los datos del formulario
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function createExpedienteCont(array $data = []) : array
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
    public function updateExpedienteCont(array $data = []) : array
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

    public function deleteExpedienteCont(array $data = []) : array
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
                        $sql = "UPDATE expediente SET estado=0,fk_expediente_eli={$ExpDel->getPK()} WHERE idexpediente={$data['idexpediente']} OR cod_arbol like '{$Expediente->cod_arbol}.%' ";
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

    public function restoreExpedienteCont(array $data = []) : array
    {

        $response = [
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];

        if (!empty($data['idexpediente'])) {
            $Expediente = new Expediente($data['idexpediente']);
            if ($Expediente->estado == 0) {
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
    public function createTomoExpedienteCont(array $data = []) : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => 'Faltan los datos a procesar'
        ];
        if (!empty($data)) {
            if ($data['idexpediente']) {
                $Expediente = new Expediente($data['idexpediente']);
                $tomoPadre= $data['idexpediente'];
                if($Expediente->tomo_padre){
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
        $cant = count($SeriesPadres);
        unset($idActual);
        if ($cant) {
            $ok = 0;
            foreach ($SeriesPadres as $id) {
                $sql = "SELECT identidad_serie FROM entidad_serie WHERE fk_serie={$id} and fk_dependencia={$attributes['fk_dependencia']} and estado=1";
                $exit = StaticSql::search($sql);
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