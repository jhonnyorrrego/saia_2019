<?php

$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}

include_once($ruta_db_superior . "db.php");

function cargar_items_radicacion($idformato, $iddoc) {
    global $conn, $ruta_db_superior;

    include_once($ruta_db_superior . "app/distribucion/funciones_distribucion.php");

    $padre = busca_filtro_tabla("idft_despacho_ingresados", "ft_despacho_ingresados", "documento_iddocumento=" . $_REQUEST['anterior'], "");

    $items = busca_filtro_tabla("ft_destino_radicacio", "ft_item_despacho_ingres", "ft_despacho_ingresados=" . $padre[0]['idft_despacho_ingresados'], "");
    $cadena_items_seleccionados = '';
    for ($i = 0; $i < $items['numcampos']; $i++) {
        $cadena_items_seleccionados .= $items[$i]['ft_destino_radicacio'];
        if (($i + 1) != $items['numcampos']) {
            $cadena_items_seleccionados .= ',';
        }
    }

    $registros = busca_filtro_tabla("b.descripcion,a.tipo_origen,a.estado_recogida,a.numero_distribucion," . fecha_db_obtener("a.fecha_creacion", "Y-m-d") . " as fecha_creacion,a.origen,a.tipo_origen,a.destino,a.tipo_destino,a.iddistribucion", "distribucion a,documento b", "a.documento_iddocumento=b.iddocumento AND a.iddistribucion in(" . $cadena_items_seleccionados . ")", "");

    $html = "<td>
		<table style='width:100%;border-collapse:collapse;border-color:#cac8c8;border-style:solid;border-width:1px;'  border='1'>
		<tr style='font-weight:bold;text-align:center;'>
                    <td>
                        <div class='checkbox check-success'>  
                            <input type='checkbox' name='boton_todos' id='boton_todos' value='todos'>
                            <label for='boton_todos' ></label>
                        </div>
                    </td>
                    <td>
                        TR&Aacute;MITE
                    </td>
                    <td>
                        TIPO
                    </td>
                    <td>
                        Rad. Item
                    </td>
                    <td>
                        FECHA DE RECIBO
                    </td>	
                    <td>
                        ORIGEN	
                    </td>
                    <td>
                        DESTINO	
                    </td>	
                    <td>
                        ASUNTO
                    </td>																			
		</tr>
	";
    for ($i = 0; $i < $registros['numcampos']; $i++) {

        $html .= "
    	 <tr>
            <td style='text-align:center; width:5%'>
                <div class='checkbox check-success'>
                    <input type='checkbox' name='item_radicacion[]' value='" . $registros[$i]['iddistribucion'] . "' id='item_radicacion_" . $registros[$i]['iddistribucion'] . "'/>
                    <label for='item_radicacion_" . $registros[$i]['iddistribucion'] . "' ></label>
                </div>
            </td>
            <td style='text-align:center; width:5%'>
                    " . mostrar_diligencia_distribucion($registros[$i]["tipo_origen"], $registros[$i]["estado_recogida"]) . "
            </td>    	 
            <td style='text-align:center; width:10%'>
                    " . mostrar_tipo_radicado_distribucion($registros[$i]["tipo_origen"]) . "
            </td>
            <td style='text-align:center; width:5%'>
                    " . $registros[$i]["numero_distribucion"] . "
            </td>
            <td style='text-align:center; width:10%'>
                    " . $registros[$i]["fecha_creacion"] . "
            </td>
            <td style='text-align:left; width:21,66%;'>
                    " . retornar_origen_destino_distribucion($registros[$i]['tipo_origen'], $registros[$i]['origen']) . '<br>' . retornar_ubicacion_origen_destino_distribucion($registros[$i]['tipo_origen'], $registros[$i]['origen']) . "
            </td>
            <td style='text-align:left; width:21,66%;'>
                    " . retornar_origen_destino_distribucion($registros[$i]['tipo_destino'], $registros[$i]['destino']) . '<br>' . retornar_ubicacion_origen_destino_distribucion($registros[$i]['tipo_destino'], $registros[$i]['destino']) . "
            </td>
            <td style='text-align:left; width:21,66%;'>
                    " . $registros[$i]["descripcion"] . "
            </td>
            </tr>";
    }
    $html .= "
    </table>
    </td>
    <script>
    	$(document).ready(function(){
            $('#boton_todos').click(function(){
                if( $(this).is(':checked') ){ //check
                    $('[name=\"item_radicacion[]\"]').attr('checked',true);		
                }else{  //un-check	
                    $('[name=\"item_radicacion[]\"]').attr('checked',false);		
                }	
            });
    	});
    </script>
    ";
    echo($html);
}

function mostrar_numero_item_novedad($idformato, $iddoc) {
    
    $items_seleccionados = busca_filtro_tabla("item_radicacion", "ft_novedad_despacho", "documento_iddocumento=" . $iddoc, "");
    $registros = busca_filtro_tabla("b.numero_distribucion", "distribucion b", "b.iddistribucion in(" . $items_seleccionados[0]['item_radicacion'] . ")", "");
    $cadena = '';
    for ($i = 0; $i < $registros['numcampos']; $i++) {
        $cadena .= $registros[$i]['numero_distribucion'];
        if (($i + 1) != $registros['numcampos']) {
            $cadena .= ', ';
        }
    }
    echo($cadena);
}

function mostrar_novedad_despacho_anexo_soporte($idformato, $iddoc) {
    global $ruta_db_superior, $conn;

    require_once ($ruta_db_superior . 'filesystem/StorageUtils.php');
    require_once ($ruta_db_superior . 'filesystem/SaiaStorage.php');
    $tipo_almacenamiento = new SaiaStorage("archivos");

    $anexos = busca_filtro_tabla("", "anexos", "documento_iddocumento=" . $iddoc, "");
    if ($anexos['numcampos']) {
        $tabla = '<ul>';
        for ($j = 0; $j < $anexos['numcampos']; $j++) {
            $href = '';

            $ruta_imagen = json_decode($anexos[$j]['ruta']);

            if (is_object($ruta_imagen)) {
                if ($tipo_almacenamiento->get_filesystem()->has($ruta_imagen->ruta)) {
                    $ruta64 = base64_encode($anexos[$j]["ruta"]);
                    $ruta_abrir = "filesystem/mostrar_binario.php?ruta=$ruta64";

                    $href = $ruta_db_superior . $ruta_abrir;
                }
            }

            $tabla .= "<li>"
                    . "<a onclick=\"modal_anexos('" . $href . "')\" style='cursor:pointer'>" . $anexos[$j]['etiqueta'] . "</a></li>";
        }
        $tabla .= '<script>
                    function modal_anexos(url){
                        let options = {
                            html: true,
                            content: `<img width="100%" height="100%" src="' . $href . '">`,
                            centerAlign:true,
                            size: "modal-xl",
                            buttons: {}
                        };
                        top.topModal(options);
                    }
                   </script>';

        $tabla .= '</ul>';
        echo($tabla);
    }
}

function generar_select_novedad($idformato, $iddoc) {
    global $ruta_db_superior, $conn;

    $configuracion_tipo_novedad = busca_filtro_tabla("valor", "configuracion", "nombre='novedad_despacho' AND tipo='tipo_novedad'", "");
    $select = '<select class="full-width" name="novedad" id="novedad"><option value="">Por favor seleccione...</option>';
    if ($configuracion_tipo_novedad['numcampos']) {
        $vector_novedades = explode(',', $configuracion_tipo_novedad[0]['valor']);
        for ($i = 0; $i < count($vector_novedades); $i++) {
            $select .= '<option value="' . htmlspecialchars($vector_novedades[$i]) . '">' . codifica_encabezado(html_entity_decode($vector_novedades[$i])) . '</option>';
        }
    }
    $select .= '</select>';
    $select .= "<script>
                    $('#novedad').select2();
                </script>";
    echo($select);
}
