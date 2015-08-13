<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php")){
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

function nombre_proveedor_funcion($idformato,$iddoc){
	global $conn,$dato,$padre;
	$padre=busca_filtro_tabla("B.ft_recepcion_cotizacion,B.ft_justificacion_compra","ft_orden_compra A, ft_evaluacion_proveedores B","A.documento_iddocumento=".$iddoc." AND A.ft_evaluacion_proveedores=B.idft_evaluacion_proveedores","",$conn);
	$dato=busca_filtro_tabla("C.nombre, B.telefono, B.direccion","ft_recepcion_cotizacion A, datos_ejecutor B, ejecutor C","A.idft_recepcion_cotizacion=".$padre[0]["ft_recepcion_cotizacion"]." AND A.proveedor=B.iddatos_ejecutor AND B.ejecutor_idejecutor=C.idejecutor","",$conn);
	echo($dato[0]["nombre"]);

}
function direccion_proveedor_funcion($idformato,$iddoc){
	global $conn,$dato;
	echo($dato[0]["direccion"]);
}
function telefono_proveedor_funcion($idformato,$iddoc){
	global $conn,$dato;
	echo($dato[0]["telefono"]);
}
function productos_seleccionar($idformato,$iddoc){
	global $conn,$padre,$ruta_db_superior;	
	$papa=busca_filtro_tabla("","ft_justificacion_compra A","A.idft_justificacion_compra=".$padre[0]["ft_justificacion_compra"],"",$conn);
	
	$documento_padre=busca_filtro_tabla("","ft_recepcion_cotizacion A, ft_justificacion_compra B","A.ft_justificacion_compra=B.idft_justificacion_compra AND A.idft_recepcion_cotizacion=".$padre[0]["ft_recepcion_cotizacion"],"",$conn);
	
	$iddoc2=$papa[0]["documento_iddocumento"];
	$formato=busca_filtro_tabla("","formato A","A.nombre='justificacion_compra'","",$conn);
	$idformato2=$formato[0]["idformato"];
	$padre2=busca_filtro_tabla("","ft_justificacion_compra A","A.documento_iddocumento=".$iddoc2,"",$conn);
	
	$botones=true;
	$estado=busca_filtro_tabla("","documento A","A.iddocumento=".$iddoc,"",$conn);
	if($estado[0]["estado"]!='ACTIVO'){
		$botones=false;
		$hijos=busca_filtro_tabla("","ft_item_justificacion_compra A,ft_valores_item_recepcion B","A.ft_justificacion_compra=".$padre2[0]["idft_justificacion_compra"]." AND B.fk_idft_item=idft_item_justificacion_compra AND B.estado='2'","",$conn);
	}
	else{
		$hijos=busca_filtro_tabla("","ft_item_justificacion_compra A","A.ft_justificacion_compra=".$padre2[0]["idft_justificacion_compra"],"",$conn);
	}
	$formato_hijo=busca_filtro_tabla("","formato A","A.nombre='item_justificacion_compra'","",$conn);
	$texto="";
	$suma=0;
	if($hijos["numcampos"]){
		$texto.='<table style="border-collapse:collapse;width:100%" border="1px"><tr>
		<td style="text-align:center"><b>Descripci&oacute;n</b></td>
		<td style="text-align:center"><b>Cantidad</b></td>
		<td style="text-align:center"><b>Precio unitario</b></td>
		<td style="text-align:center"><b>Valor total</b></td>';
		if($botones){
			$texto.='<td></td>';
		}
		$texto.='</tr>';
		for($i=0;$i<$hijos["numcampos"];$i++){
			$total="";
			$valor_hijo=busca_filtro_tabla("","ft_valores_item_recepcion A","A.ft_recepcion_cotizacion=".$documento_padre[0]["idft_recepcion_cotizacion"]." AND A.fk_idft_item='".$hijos[$i]["idft_item_justificacion_compra"]."'","",$conn);
			//print_r($valor_hijo);
			$total=($valor_hijo[0]["valor"]*$hijos[$i]["cantidad"]);
			$suma+=$total;
			$texto.='<tr>
			<td style="text-align:left">'.utf8_encode(html_entity_decode($hijos[$i]["descripcion_item"])).'</td>
			<td style="text-align:right">'.$hijos[$i]["cantidad"].'</td>
			';
			$valor_unitario=number_format($valor_hijo[0]["valor"],0,",",".");
			$total=number_format($total,0,",",".");
			$texto.="<td style='text-align:right'>$".$valor_unitario."</td>
			<td style='text-align:right'>$".$total."</td>";
			if($valor_hijo[0]["estado"]==1){
				if($botones){
					$texto.="<td id='registro_".$valor_hijo[0]["idft_valores_item_recepcion"]."'>";
					$texto.="<img src='".$ruta_db_superior."imagenes/accept.png' class='guardar_seleccionado' idregistro='".$valor_hijo[0]["idft_valores_item_recepcion"]."' style='cursor:pointer'>";
					$texto.="</td>";
				}
				else{
					$texto.="<td>Sin selecci&oacute;n</td>";
				}
			}
			else if($valor_hijo[0]["estado"]==2&&$botones){
				$texto.="<td id='registro_".$valor_hijo[0]["idft_valores_item_recepcion"]."'>Seleccionado</td>";
			}
			$texto.='</tr>';
		}
		$texto.='<tr><td colspan="3" style="text-align:right">Valor Subtotal:</td><td style="text-align:right">$'.number_format($documento_padre[0]['subtotal'],0,",",".").'</td></tr>';
		
		$texto.='<tr><td colspan="3" style="text-align:right">Iva:</td><td style="text-align:right">$'.number_format($documento_padre[0]['subtotal']*($documento_padre[0]['valor_iva']/100),0,",",".").'</td></tr>';
		
		$texto.='<tr><td colspan="3" style="text-align:right">Valor total:</td><td style="text-align:right">$'.number_format($documento_padre[0]['valor_total'],0,",",".").'</td></tr>';
		
		$texto.='</table>';
		$texto.='<script>
		$(".guardar_seleccionado").click(function(){
			var idregistro=$(this).attr("idregistro");
			$.post("registrar_seleccionados.php",{id:idregistro},function(html){
				$("#registro_"+idregistro).html("Seleccionado");
			});
		});
		</script>';
	}
	echo($texto);
}
function descripcion_funcion_justificacion($idformato,$iddoc){
	global $conn;
	$doc_padre=buscar_papa_primero($iddoc);
	$justificacion=busca_filtro_tabla("descripcion_justificacion","ft_justificacion_compra A","A.documento_iddocumento=".$doc_padre,"",$conn);
	echo(utf8_encode(html_entity_decode(strip_tags($justificacion[0]["descripcion_justificacion"]))));
}
function facturas_vinculadas($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	if(@$_REQUEST["tipo"]!=5){
		$idf=busca_filtro_tabla("C.numero,C.iddocumento,C.descripcion, C.fecha","ft_orden_compra A, ft_radicacion_facturas B, documento C","A.idft_orden_compra=B.ft_orden_compra AND A.documento_iddocumento=".$iddoc." AND B.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO','ANULADO','ACTIVO')","",$conn);
		
		if($idf["numcampos"]){
			$texto="<p></p>";
			$texto.="<table style='width:100%'>";
			$texto.="<tr><td>Facturas vinculadas:</td></tr>";
			for($i=0;$i<$idf["numcampos"];$i++){
				$texto.='<tr><td><a href="'.$ruta_db_superior.'ordenar.php?key='.$idf[$i]["iddocumento"].'&mostrar_formato=1" target="centro"><b>Fecha:</b> '.$idf[$i]["fecha"].' - <b>Radicado No:</b> '.$idf[$i]["numero"].' - '.$idf[$i]["descripcion"].'</a></td></tr>';
			}
			$texto.="</table>";
		}
		echo($texto);
	}
}

function ver_origen_recursos($idformato,$iddoc){
global $conn;
$nombre=busca_filtro_tabla("s.nombre","serie s,ft_orden_compra oc","oc.origen_recursos=s.idserie and oc.documento_iddocumento=".$iddoc,"",$conn);
echo $nombre[0]['nombre'];
}

/*POSTERIOR ADICIONAR*/
function crear_ruta_orden_compra($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("valor_total","ft_recepcion_cotizacion RC, ft_evaluacion_proveedores EP,ft_orden_compra OC","RC.idft_recepcion_cotizacion=EP.ft_recepcion_cotizacion AND EP.idft_evaluacion_proveedores=OC.ft_evaluacion_proveedores AND OC.documento_iddocumento=".$iddoc,"",$conn);
	
	$total=floatval($datos[0]['valor_total']);
	$valor_min=intval(3000000);
	
	$ruta=array();
	if($total<=$valor_min){
		$funcionario1=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc v","cargo like '%gestora%administrativa%' and estado_dc=1 and estado=1","",$conn);
		if($funcionario1['numcampos']){
			array_push($ruta,array("funcionario"=>$funcionario1[0]['funcionario_codigo'],"tipo_firma"=>1));
		}
	}
	$funcionario2=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc v","cargo like '%presidente%ejecutivo%' and estado_dc=1 and estado=1","",$conn);
	if($funcionario2['numcampos']){
		array_push($ruta,array("funcionario"=>$funcionario2[0]['funcionario_codigo'],"tipo_firma"=>1));
	}
	insertar_ruta($ruta,$iddoc,0);
}
?>