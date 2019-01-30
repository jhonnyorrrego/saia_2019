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
                $attributes['fk_dependencia'] = $instance->fk_dependencia;
                $attributes['fk_entidad_serie'] = $instance->fk_entidad_serie;
                if (empty($attributes['fecha'])) {
                    $attributes['fecha'] = date('Y-m-d H:i:s');
                }

                $Expediente = new Expediente();
                $Expediente->setAttributes($attributes);
                $response = $Expediente->CreateExpediente();
                if ($response['exito']) {
                    $response['message'] = 'Expediente guardado';
                    if (!empty($data['generarfiltro']) && !empty($data['idbusqueda_componente'])) {
                        $attributes = [
                            'fk_busqueda_componente' => $data["idbusqueda_componente"],
                            'funcionario_idfuncionario' => $Expediente->propietario,
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
                $response['message'] = 'falta el expediente padre';
            }
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
                $cant = $Expediente->countTomos();

                $ExpTomo = clone $Expediente;
                $ExpTomo->setPK(0);
                $attributes = [
                    'fecha' => date('Y-m-d H:i:s'),
                    'propietario' => $_SESSION['idfuncionario'],
                    'responsable' => $_SESSION['idfuncionario'],
                    'tomo_padre' => $data['idexpediente'],
                    'tomo_no' => $cant+1,
                    'cod_arbol' => 0
                ];
                $ExpTomo->setAttributes($attributes);
                $info = $ExpTomo->CreateExpediente();
                $response = $info;

                if($info['exito']){
                    $response['data']['cod_padre']=$ExpTomo->cod_padre;
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
                $exist = busca_filtro_tabla("identidad_serie", "entidad_serie", "fk_serie={$id} and fk_dependencia={$attributes['fk_dependencia']} and estado=1", "", $conn);
                if (!$exist['numcampos']) {
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
