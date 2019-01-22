<?php
class ProcessExpedienteController
{

    public static function createEntidadSerieCodArbol(string $codArbol, array $attributes = [])
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
