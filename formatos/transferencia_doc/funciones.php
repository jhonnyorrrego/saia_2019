<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

//MOSTRAR
function mostrar_unidad_admin_transf($idformato,$iddoc){
    global $conn;
    $datos=busca_filtro_tabla("b.cod_padre,b.nombre","ft_transferencia_doc a, dependencia b","a.oficina_productora=b.iddependencia AND a.documento_iddocumento=".$iddoc,"",$conn);
    $padre=busca_filtro_tabla("","dependencia","iddependencia=".$datos[0]['cod_padre'],"",$conn);
    if(!$padre['numcampos']){
        $padre=$datos;
    }
    
    echo($padre[0]['nombre']);
}
function mostrar_oficina_productora_transf($idformato,$iddoc){
    global $conn;
    $datos=busca_filtro_tabla("b.nombre","ft_transferencia_doc a, dependencia b","a.oficina_productora=b.iddependencia AND a.documento_iddocumento=".$iddoc,"",$conn);
     echo($datos[0]['nombre']);
}

function validacion_js_transferencia($idformato, $iddoc) {
    global $conn;

    if (@$_REQUEST["id"]) {//SI LLEGA UNA LISTA DE EXPEDIENTES
        $busca_estado = busca_filtro_tabla("estado_archivo", "expediente", "idexpediente IN(" . $_REQUEST["id"] . ")", "", $conn);
        $estado_archivo = $busca_estado[0]['estado_archivo'];
        $selecciona = 0;
        switch($estado_archivo) {
            case 1 :
                $seleccionar = 2;
                break;
            case 2 :
                $seleccionar = 3;
                break;
            case 3 :
                $seleccionar = 3;
                break;
            default :
                $seleccionar = 1;
                break;
        }
        ?>
        <script>
            $(document).ready(function(){
                //$('#transferir_a').children('option[value="<?php echo($seleccionar); ?>"]').attr('selected','selected');
                
                $('#tr_recibido_remitente').hide();
                $('#recibido_por').addClass('required');
                
                $('[name="tipo_transferencia"]').click(function(){
                    if ($(this).val()==1) {
                        $('#tr_recibido_remitente').hide();
                        $('#tr_recibido_por').show();
                        $('#recibido_por').addClass('required');
                        $('#recibido_remitente').removeClass('required');
                    }else{
                        $('#tr_recibido_remitente').show();
                        $('#tr_recibido_por').hide();
                        $('#recibido_por').removeClass('required');
                        $('#recibido_remitente').addClass('required');
                    }
                });
            });
        </script>
        <?php   
    }
}

function guardar_expedientes_add($idformato, $iddoc) {
    global $conn;
    $ids = @$_REQUEST["id"];
    $texto = "";
    if ($ids) {
        $expedientesPadres = busca_filtro_tabla("nombre,idexpediente," . fecha_db_obtener("fecha", "Y-m-d") . " AS fecha,indice_uno,indice_dos,indice_tres,fk_idcaja,serie_idserie,estado_archivo", "expediente A", "A.idexpediente in(" . $ids . ")", "", $conn);
    } else if (@$_REQUEST['id_caja']) {
        $ids_caja = $_REQUEST['id_caja'];
        $expedientesPadres = busca_filtro_tabla("A.nombre,A.idexpediente," . fecha_db_obtener("fecha", "Y-m-d") . " AS fecha,indice_uno,indice_dos,indice_tres,fk_idcaja,serie_idserie,estado_archivo", "expediente A", "A.fk_idcaja in(" . $ids_caja . ")", "", $conn);
    } else if (@$_REQUEST['iddoc']) {
        $datos = busca_filtro_tabla("expedientes_padre", "ft_transferencia_doc", "documento_iddocumento=" . $_REQUEST['iddoc'], "", $conn);
        $ids = $datos[0]['expedientes_padre'];
        $expedientesPadres = busca_filtro_tabla("idexpediente,nombre," . fecha_db_obtener("fecha", "Y-m-d") . " AS fecha,indice_uno,indice_dos,indice_tres,fk_idcaja,serie_idserie,estado_archivo", "expediente A", "A.idexpediente in(" . $ids . ")", "", $conn);
    } 
    $html = "
		<td><input type='hidden' name='expediente_vinculado' id='expediente_vinculado' value=''>
			<table style='width:100%;border-collapse:collapse;border-color:#cac8c8;border-style:solid;border-width:1px;'  border='1'>
				<tr style='font-weight:bold;text-align:center;'>
					<td> <input type='checkbox' name='boton_todos' id='boton_todos' value='todos'> </td>
					<td> Nombre </td>
					<td> Fecha de creaci&oacute;n </td>
					<td> Indice uno </td>
					<td> Indice Dos </td>
					<td> Indice Tres </td>
					<td> Caja </td>
					<td> Serie asociada </td>
				</tr>";

    for ($i = 0; $i < $expedientesPadres['numcampos']; $i++) {
        $caja = busca_filtro_tabla("fondo,codigo_dependencia,codigo_serie,no_consecutivo", "caja", "idcaja=" . $expedientesPadres[$i]['fk_idcaja'], "", $conn);
        $cadena_caja = $caja[0]['codigo_dependencia'] . $caja[0]['codigo_serie'] . $caja[0]['no_consecutivo'] . "(" . $caja[0]['fondo'] . ")";

        $serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $expedientesPadres[$i]['serie_idserie'], "", $conn);
        $cadena_serie = $serie[0]['nombre'];
        $html .= "
			<tr>
				<td style='text-align:center; width:5%'> <input type='checkbox' name='expediente_vinculado[]' class='padre' value='" . $expedientesPadres[$i]['idexpediente'] . "'> </td>
				<td> " . $expedientesPadres[$i]['nombre'] . " </td>
				<td> " . $expedientesPadres[$i]['fecha'] . " </td>
				<td> " . $expedientesPadres[$i]['indice_uno'] . " </td>
				<td> " . $expedientesPadres[$i]['indice_dos'] . " </td>
				<td> " . $expedientesPadres[$i]['indice_tres'] . " </td>
				<td> " . $cadena_caja . " </td>
				<td> " . $cadena_serie . " </td>
			</tr>				
		";
		
		$hijosExpediente = busca_filtro_tabla("idexpediente,nombre," . fecha_db_obtener("fecha", "Y-m-d") . " AS fecha,indice_uno,indice_dos,indice_tres,fk_idcaja,serie_idserie","expediente","estado_cierre=2 AND (cod_arbol LIKE '%." . $expedientesPadres[$i]['idexpediente'] . ".%' OR cod_arbol LIKE '"  . $expedientesPadres[$i]['idexpediente'] . ".%')","",$conn);
		
		for ($j = 0; $j < $hijosExpediente['numcampos']; $j++) {
			
			if ($hijosExpediente[$j]['idexpediente'] != $expedientesPadres[$i]['idexpediente']) {
				$caja = busca_filtro_tabla("fondo,codigo_dependencia,codigo_serie,no_consecutivo", "caja", "idcaja=" . $hijosExpediente[$j]['fk_idcaja'], "", $conn);
		        $cadena_caja = $caja[0]['codigo_dependencia'] . $caja[0]['codigo_serie'] . $caja[0]['no_consecutivo'] . "(" . $caja[0]['fondo'] . ")";
		
		        $serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $hijosExpediente[$j]['serie_idserie'], "", $conn);
		        $cadena_serie = $serie[0]['nombre'];
		        $html .= "
					<tr>
						<td style='text-align:center; width:5%'> <input type='checkbox' name='expediente_vinculado[]' class='hijos_" . $expedientesPadres[$i]['idexpediente'] . "' value='" . $hijosExpediente[$j]['idexpediente'] . "' disabled> </td>
						<td> " . $hijosExpediente[$j]['nombre'] . " </td>
						<td> " . $hijosExpediente[$j]['fecha'] . " </td>
						<td> " . $hijosExpediente[$j]['indice_uno'] . " </td>
						<td> " . $hijosExpediente[$j]['indice_dos'] . " </td>
						<td> " . $hijosExpediente[$j]['indice_tres'] . " </td>
						<td> " . $cadena_caja . " </td>
						<td> " . $cadena_serie . " </td>
					</tr>				
				";
			}
	    }
    }

    $html .= "</table></td>";
    echo($html);
    
    if($_REQUEST["tipo"]!=5){
    ?>
        <script>
        $(document).ready(function(){
            var estado_archivo=parseInt(<?=$expedientesPadres[0]["estado_archivo"];?>)+1;
            
            $('#boton_todos').click(function(){
                if( $(this).is(':checked') ){ //check
                    $('[name=\"expediente_vinculado[]\"]').attr('checked',true);        
                }else{   
                    $('[name=\"expediente_vinculado[]\"]').attr('checked',false);       
                 }   
             });
             
             $('.padre').click(function(){
                if( $(this).is(':checked') ){ //check
                    $('.hijos_'+$(this).val()).attr('checked',true);
                }else{   
                    $('.hijos_'+$(this).val()).attr('checked',false);   
                 }   
             });
             
             $("[name='expedientes_padre']").val('<?php echo($ids);?>');
             
             $("#transferir_a").val(estado_archivo);
             
             $("#transferir_a").change(function(){
                 if($(this).val()){
                    $("#tr_agrupador").show();
                    cargarAgrupadores($(this).val());   
                 }else{
                    $("#tr_agrupador").hide();
                    $("#agrupador").val("");
                 }
             });
             $("#transferir_a").trigger("change");
				
        });
        
        function cargarAgrupadores(archivo){
            tree_agrupador.deleteChildItems(0);
            tree_agrupador.setXMLAutoLoading("../../test/test_expediente.php?cargar_partes=1&estado_archivo="+archivo);
            tree_agrupador.loadXML("../../test/test_expediente.php?cargar_partes=1&estado_archivo="+archivo);
        }
            
        $('#formulario_formatos').validate({
            submitHandler : function(form) {
                check=new Array();
                i=0;
                $.each($("[name='expediente_vinculado[]']"), function() {
                    if($(this).is(':checked')){
                        check[i]=$(this).val();
                        i++;
                    }
                });
                if(i>0){
                $("#expediente_vinculado").val(check.join(","));
                    form.submit();
                }else{
                	alert("Por favor selecione un expediente");
                    $("#continuar").show();
                    $("#enviando").hide();
                    return false;
                }
            }
        });
        </script>
    <?php
    }
}

function expedientes_vinculados_funcion($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$nombre_entidad = busca_filtro_tabla('valor', 'configuracion', "nombre='nombre'", "", $conn);
	$nombre_entidad = strtoupper(codifica_encabezado(html_entity_decode($nombre_entidad[0]['valor'])));
	$texto = '';
	$datos = busca_filtro_tabla("", "ft_transferencia_doc A, documento B", "A.documento_iddocumento=" . $iddoc . " and A.documento_iddocumento=B.iddocumento", "", $conn);
	$expedientes = busca_filtro_tabla("", "expediente A", "A.idexpediente in(" . $datos[0]["expediente_vinculado"] . ")", "", $conn);
	if ($expedientes["numcampos"]) {
		$estilo_general = ' style="text-align:center;font-weight:bold;"';
		$texto .= '<p>&nbsp;</p><table style="width:100%;border-collapse:collapse;" border="1">';
		if ($_REQUEST["tipo"] != 5) {
			$texto .= ' <tr>
      	<td colspan="2" style="border:hidden">
      		ENTIDAD REMITENTE
      	</td>
      	<td colspan="9" style="border-top:hidden;border-top:bottom;">' . $nombre_entidad . '</td>
      	<td colspan="4" >REGISTRO DE ENTRADA</td>
      </tr>
      <tr>
      	<td colspan="2" style="border:hidden">
      		OFICINA PRODUCTORA
      	</td>
      	<td colspan="9" style="border-top:hidden;border-top:bottom;">' . mostrar_valor_campo('oficina_productora', $idformato, $iddoc, 1) . '</td>
      	<td>AÑO</td>
      	<td>MES</td>
      	<td>DIA</td>
      	<td>N.T.</td>
      </tr>
      <tr>
      	<td colspan="2" style="border:hidden">
      		OBJETO
      	</td>
      	<td colspan="9" style="border-top:hidden;border-top:bottom;">TRANSFERENCIA DOCUMENTAL</td>
      	<td></td>
      	<td></td>
      	<td></td>
      	<td></td>
      </tr>
      <tr>
      	<td colspan="2" style="border:hidden">
      	&nbsp;
      	</td>
      	<td colspan="9" style="border-top:hidden;border-top:bottom;"></td>
      	<td style="border-left:hidden;border-right:hidden">&nbsp;</td>
      	<td colspan="3" style="border-left:hidden;border-right:hidden">&nbsp;</td>
      	
      </tr>
      <tr>
      	<td colspan="11" style="border-top:hidden;border-left:hidden;border-right:hidden"></td>
      	 <td style="border-top:hidden;border-left:hidden;border-right:hidden"></td>
      	<td colspan="3" style="border-top:hidden;border-left:hidden;border-right:hidden"></td>
      </tr>';
		} else {
			$texto .= ' <tr>
				<td colspan="2">
						ENTIDAD REMITENTE
					</td>
					<td colspan="9">' . $nombre_entidad . '</td>
					<td colspan="4" >REGISTRO DE ENTRADA</td>
				</tr>
				<tr>
					<td colspan="2">
						OFICINA PRODUCTORA
					</td>
					<td colspan="9">' . mostrar_valor_campo('oficina_productora', $idformato, $iddoc, 1) . '</td>
					<td>AÑO</td>
					<td>MES</td>
					<td>DIA</td>
					<td>N.T.</td>
				</tr>
				<tr>
					<td colspan="2">
						OBJETO
					</td>
					<td colspan="9">TRANSFERENCIA DOCUMENTAL</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">
					&nbsp;
					</td>
					<td colspan="9"></td>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					
				</tr>
				<tr>
					<td colspan="11" style="border-left:none">andres</td>
					 <td></td>
					<td colspan="3"></td>
				</tr>';
		}

		$texto .= ' <tr>
			<th rowspan="2" ' . $estilo_general . '>N. DE <br> ORDEN</th>
			<th rowspan="2" ' . $estilo_general . '>C&Oacute;DIGO</th>
			<th rowspan="2" ' . $estilo_general . '>Nombre de la serie,Subseries o Asuntos</th>
			<th colspan="2" ' . $estilo_general . '>FECHAS EXTREMAS</th>
			<th colspan="4" ' . $estilo_general . '>Unidad de Conservaci&oacute;n</th>
			<th rowspan="2" ' . $estilo_general . '>N&uacute;mero <br> Folios</th>
			<th rowspan="2" ' . $estilo_general . '>Soporte</th>
			<th rowspan="2" ' . $estilo_general . '>Frecuencia <br> Consulta</th>
			<th rowspan="2" ' . $estilo_general . ' colspan="3">Notas</th>
			</tr>
			<tr>
			  <th ' . $estilo_general . '>Inicial</th>
			<th ' . $estilo_general . '>Final</th>
			<th ' . $estilo_general . '>Caja</th>
			<th ' . $estilo_general . '>Carpeta</th>
			<th ' . $estilo_general . '>Tomo</th>
			<th ' . $estilo_general . '>Otro</th>
			</tr>';
		$texto .= "";
		$vector_soportes = array(
			1 => 'CD-ROM',
			2 => 'DISKETE',
			3 => 'DVD',
			4 => 'DOCUMENTO',
			5 => 'FAX',
			6 => 'REVISTA O LIBRO',
			7 => 'VIDEO',
			8 => 'OTROS ANEXOS'
		);
		$vector_frecuencias = array(
			1 => 'Alta',
			2 => 'Media',
			3 => 'Baja'
		);
		for ($i = 0; $i < $expedientes["numcampos"]; $i++) {

			$x_caja = '';
			if ($expedientes[$i]["fk_idcaja"]) {
				$x_caja = 'x';
			}

			$tomo_padre = $expedientes[$i]["idexpediente"];
			if ($expedientes[$i]['tomo_padre']) {
				$tomo_padre = $expedientes[$i]['tomo_padre'];
			}
			$ccantidad_tomos = busca_filtro_tabla("idexpediente", "expediente", "tomo_padre=" . $tomo_padre, "", $conn);
			$cantidad_tomos = $ccantidad_tomos['numcampos'] + 1;
			//tomos + el padre
			$cadena_tomos = ("<i><b style='font-size:10px;'></b></i><i style='font-size:10px;'>" . $expedientes[$i]['tomo_no'] . " de " . $cantidad_tomos . "</i>");

			if (is_object($expedientes[$i]["fecha_extrema_i"]))
				$expedientes[$i]["fecha_extrema_i"] = $expedientes[$i]["fecha_extrema_i"] -> format('Y-m-d');
			if (is_object($expedientes[$i]["fecha_extrema_f"]))
				$expedientes[$i]["fecha_extrema_f"] = $expedientes[$i]["fecha_extrema_f"] -> format('Y-m-d');

			$texto .= '<tr id="tr_' . $expedientes[$i]["idexpediente"] . '">
			<td style="text-align:center">' . ($i + 1) . '</td>
			<td>' . $expedientes[$i]["codigo_numero"] . '</td>
			<td>' . $expedientes[$i]["nombre"] . '</td>
			<td>' . $expedientes[$i]["fecha_extrema_i"] . '</td>
			<td>' . $expedientes[$i]["fecha_extrema_f"] . '</td>
			<td style="text-align:center;">' . $x_caja . '</td>
			<td style="text-align:center;">X</td>
			<td style="text-align:center">' . $cadena_tomos . '</td>
			<td style="text-align:center">' . $expedientes[$i]['no_unidad_conservacion'] . '</td>
			<td style="text-align:center">' . $expedientes[$i]["no_folios"] . '</td>
			<td>' . $vector_soportes[$expedientes[$i]['soporte']] . '</td>
			<td>' . $vector_frecuencias[$expedientes[$i]['frecuencia_consulta']] . '</td>
			<td colspan="3">' . $expedientes[$i]['notas_transf'] . '</td>
			';

			if ($datos[0]["estado"] == 'ACTIVO' && @$_REQUEST["tipo"] != 5) {
				$texto .= '<td><i class="icon-remove expulsar_expediente" idexpediente="' . $expedientes[$i]["idexpediente"] . '" style="cursor:pointer"></i></td>';
			}
			$texto .= "</tr>";
		}
		$texto .= "</table>";
		if ($datos[0]["estado"] == 'ACTIVO' && @$_REQUEST["tipo"] != 5) {
			$texto .= '<script>
			$(document).ready(function(){
			    
				$(".expulsar_expediente").click(function(){
					var expediente=$(this).attr("idexpediente");
					window.open("desvincular_expediente.php?idexpediente="+expediente+"&iddoc=' . $iddoc . '&idformato=' . $idformato . '","_self");
				});
			});
			</script>';
		}
	}
	echo($texto);

}


function cambiar_estado_expedientes($idformato, $iddoc) {
    global $conn;
    $datos = busca_filtro_tabla("a.expediente_vinculado, a.transferir_a,a.tipo_transferencia,a.recibido_por,a.expedientes_padre,a.agrupador", "ft_transferencia_doc a", "a.documento_iddocumento=" . $iddoc, "", $conn);

    $mystring = $datos[0]["expediente_vinculado"];
    $findme = 'cajas_';
    $pos = strpos($mystring, $findme);

    if ($pos !== false) {//son cajas //fue encontrada
        $ids_caja = trim($datos[0]["expediente_vinculado"], "cajas_");
        $sql_c = "UPDATE caja SET estado_archivo=" . $datos[0]["transferir_a"] . " WHERE idcaja IN(" . $ids_caja . ")";
        phpmkr_query($sql_c);
        $busca_expediente = busca_filtro_tabla("idexpediente", "expediente", "fk_idcaja IN(" . $ids_caja . ")", "", $conn);
        $expedientes_lista = implode(",", extrae_campo($busca_expediente, 'idexpediente'));
        $expedientes = explode(',', $expedientes_lista);
        obtener_expedientes_hijos($expedientes_lista, $expedientes, 1);
    } else {
        $expedientes = explode(",", $datos[0]["expediente_vinculado"]);
        obtener_expedientes_hijos($datos[0]["expediente_vinculado"], $expedientes, 1);
    }
    
    if ($datos[0]['tipo_transferencia'] == 1) {
    	transferencia_automatica($idformato, $iddoc, $datos[0]['recibido_por'], 1);
    }
    
    $sql1 = "update expediente set estado_archivo=" . $datos[0]["transferir_a"] . " where idexpediente in(" . implode(",", $expedientes) . ")";
    phpmkr_query($sql1);
	
	if ($datos[0]['agrupador']) {
		$sqlAgrupador = "update expediente set cod_padre=" . $datos[0]["agrupador"] . " where idexpediente in(" . $datos[0]['expedientes_padre'] . ")";
    	phpmkr_query($sqlAgrupador);
	}
}

function obtener_expedientes_hijos($idexpediente,&$expedientes,$indice){
	global $conn;
	if($indice>=100)return false;
	
	$expediente=busca_filtro_tabla("","expediente a","a.cod_padre in(".$idexpediente.")","",$conn);
	for($i=0;$i<$expediente["numcampos"];$i++){
		$expedientes[]=$expediente[$i]["idexpediente"];
		
		$hijos=busca_filtro_tabla("","expediente a","a.cod_padre=".$expediente[$i]["idexpediente"],"",$conn);
		if($hijos["numcampos"]){
			$indice++;
			obtener_expedientes_hijos($expediente[$i]["idexpediente"],$expedientes,$indice);
		}
	}
	return true;
}
?>