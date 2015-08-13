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
/*ADICIONAR-EDITAR*/
/*
function calcular_subtotal($idformato,$iddoc){
global $conn;
?>
<script>
$(document).ready(function(){
	$("#subtotal").attr("readonly",true);
	Moneda($("#subtotal").attr('id'));
	Moneda($("#valor_total").attr('id'));
	
	$("#valor_iva,#valor_total").blur(function(){
		var iva=$("#valor_iva").val();
		var total=$("#valor_total").val().replace(/\./g,'');
		var subtotal=total-((iva*total)/100);
		subtotal=subtotal.toString().replace(".",",");
		$("#subtotal").val(subtotal);
		Moneda($("#subtotal").attr('id'));
	});
	$("#valor_total").keyup(function(){
		Moneda($("#valor_total").attr('id'));
	});
	function Moneda(input){
		var num = $("#"+input).val().replace(/\./g,'');
		if(!isNaN(num)){
			num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			num = num.split('').reverse().join('').replace(/^[\.]/,'');
			$("#"+input).val(num);
		}
	}
});

$("#formulario_formatos").validate({
	submitHandler: function(form) { 
		var total=$("#valor_total").val().replace(/\./g,'');
		var subtotal=$("#subtotal").val().replace(/\./g,'');
		$("#valor_total").val(total);
		$("#subtotal").val(subtotal);
		form.submit();
	}
});	
</script>
<?php
}
*/


function dependencia_creador_funcion($idformato,$iddoc){
	global $conn;
	$dependencia=busca_filtro_tabla("C.nombre","ft_recepcion_cotizacion A, dependencia_cargo B, dependencia C","A.dependencia=B.iddependencia_cargo AND B.dependencia_iddependencia=C.iddependencia AND A.documento_iddocumento=".$iddoc,"",$conn);
	echo(ucfirst(strtolower($dependencia[0]["nombre"])));
}

function listar_item_recepcion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$documento_padre=busca_filtro_tabla("B.documento_iddocumento,D.iddocumento,A.idft_recepcion_cotizacion,D.estado,B.idft_justificacion_compra,A.valor_iva,subtotal,valor_total","ft_recepcion_cotizacion A, ft_justificacion_compra B, documento D","A.ft_justificacion_compra=B.idft_justificacion_compra AND D.iddocumento=A.documento_iddocumento AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	$hijos=busca_filtro_tabla("","ft_item_justificacion_compra A","A.ft_justificacion_compra=".$documento_padre[0]["idft_justificacion_compra"],"",$conn);

	$texto="";
	if($hijos["numcampos"]){
		$subtotal=0;
		$texto.='<table style="border-collapse:collapse;width:100%" border="1px"><tr class="encabezado_list">
		<td style="width:10%">Cantidad</td>
		<td style="width:50%">Descripci&oacute;n</td>
		<td style="width:40%">Valor unitario</td>
		</tr>';
		for($i=0;$i<$hijos["numcampos"];$i++){
			$valor_hijo=busca_filtro_tabla("","ft_valores_item_recepcion A","A.ft_recepcion_cotizacion=".$documento_padre[0]["idft_recepcion_cotizacion"]." AND A.fk_idft_item='".$hijos[$i]["idft_item_justificacion_compra"]."'","",$conn);
			if($valor_hijo[0]["valor"]){
				$subtotal+=floatval($hijos[$i]["cantidad"]) * floatval($valor_hijo[0]["valor"]);
			}
			$texto.='<tr>
			<td style="text-align:center" id="cantidad_'.$hijos[$i]["idft_item_justificacion_compra"].'">'.$hijos[$i]["cantidad"].'</td>
			<td style="text-align:left">'.utf8_encode(html_entity_decode($hijos[$i]["descripcion_item"])).'</td><td style="text-align:right;">&nbsp;$ ';
			
			if($documento_padre[0]["estado"]!='ACTIVO' || $_REQUEST['tipo']==5){
				$texto.=number_format($valor_hijo[0]["valor"],0,",",".");
			}else{
				$texto.=" <input type='text' id='valor".$hijos[$i]["idft_item_justificacion_compra"]."' class='valor_item' value='".number_format($valor_hijo[0]["valor"],0,",",".")."' style='width:60%' iditem='".$hijos[$i]["idft_item_justificacion_compra"]."'>";
			
				$texto.="<input type='button' value='Guardar'  style='width:35%' class='guardar_valores' idregistro='".$hijos[$i]["idft_item_justificacion_compra"]."'>";
			}
			$texto.='</td></tr>';
		}
		$iva=($subtotal)*($documento_padre[0]["valor_iva"]/100);
		$total=$subtotal+$iva;
		
		if($documento_padre[0]["estado"]!='ACTIVO'){
			$total=$documento_padre[0]["valor_total"];
			$subtotal=$documento_padre[0]["subtotal"];
			$iva=$total-$subtotal;
		}
		
		$texto.='<tr>';
		$texto.='<td colspan="2" style="text-align:right">Valor Subtotal:</td>';
		$texto.='<td style="text-align:left" id="subtotal">&nbsp;$ '.number_format($subtotal,0,",",".").'</td></tr>';
		
		$texto.='<tr>';
		$texto.='<td colspan="2" style="text-align:right">Iva:</td>';
		$texto.='<td style="text-align:left" id="iva">&nbsp;$ '.number_format($iva,0,",",".").'</td></tr>';
		
		$texto.='<tr>';
		$texto.='<td colspan="2" style="text-align:right">Valor total:</td>';
		$texto.='<td style="text-align:left" id="total">&nbsp;$ '.number_format($total,0,",",".").'</td></tr>';

		$texto.='</table>';
		}
		echo($texto);
	if(@$_REQUEST['tipo']!=5){	
	?>
	<script>
	function Moneda_r(valor){
		var cadena=new String(valor);
		var num = cadena.replace(/\./g,'');
		if(!isNaN(num)){
			num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			num = num.split('').reverse().join('').replace(/^[\.]/,'');
			return(num);
		}
	}
	$(".guardar_valores").click(function(){
		var idregistro=$(this).attr("idregistro");
		var valor=$("#valor"+idregistro).val();
		var subtotal=0;
		$(".valor_item").each(function(){
			if($(this).val()){
				var iditem=$(this).attr("iditem");
				var x2_valor=$(this).val().replace(/\./g,'');
				subtotal+=parseFloat(x2_valor)*parseFloat($("#cantidad_"+iditem).html());
			}
		});
		var idft_recep=parseInt(<?php echo $documento_padre[0]["idft_recepcion_cotizacion"]; ?>);
		var iddoc=parseInt(<?php echo $documento_padre[0]["iddocumento"]; ?>);
		var iva=parseFloat(<?php echo $documento_padre[0]["valor_iva"]; ?>);
		
		$.post("registrar_valores.php",{id:idregistro,x_valor:valor, idft:idft_recep, iddoc_recepcion:iddoc, valor_subtotal:subtotal,iva_recep:iva},function(html){	
			$("#subtotal").html("$"+Moneda_r(subtotal));
			$("#iva").html("$"+Moneda_r(subtotal*(iva/100)));
			$("#total").html("$"+Moneda_r(subtotal+(subtotal*(iva/100))));
		});	
	});
	
	$(".valor_item").keyup(function(){
		var valor=Moneda_r($(this).val());
		$(this).val(valor);
	});
	</script>
	<?php
	}
}

function validar_digitalizacion_recepcion($idformato,$iddoc){
	global $conn;
	if($_REQUEST["digitalizacion"]==1){
		$datos_padre=busca_filtro_tabla("B.documento_iddocumento as doc","ft_recepcion_cotizacion A, ft_justificacion_compra B","A.ft_justificacion_compra=B.idft_justificacion_compra AND A.documento_iddocumento=".$iddoc,"",$conn);
		$formato=busca_filtro_tabla("","formato A","A.idformato=".$idformato,"",$conn);
		$formato_padre=busca_filtro_tabla("","formato A","A.idformato=".$formato[0]["cod_padre"],"",$conn);
		$cadena=$idformato."-".$formato_padre[0]["nombre_tabla"]."-".$formato[0]["nombre_tabla"]."-".$iddoc;
		redirecciona($ruta_db_superior."paginaadd.php?key=".$iddoc."&x_target=formato_detalles&x_enlace=formatos/arboles/arbolformato_documento.php&idformato=".$formato_padre[0]["idformato"]."&iddoc2=".$datos_padre[0]["doc"]."&seleccionar=".$cadena."&recarga_formato=1");
	}
}
?>