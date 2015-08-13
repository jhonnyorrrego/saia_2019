<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

//ADICIONAR - EDITAR
//***************************
/*function carga_listado_organizaciones($idformato,$iddoc){
	global $conn;
	$idserie_papa=busca_filtro_tabla("","serie A","LOWER(A.nombre) LIKE LOWER('%codigo%organizacion%')","",$conn);
	$datos=busca_filtro_tabla("A.nombre, A.idserie","serie A","A.cod_padre=".$idserie_papa[0]['idserie'],"",$conn);

	$lista_organizacion="<td><select name='codigo_organizacion' id='codigo_organizacion'>";
    $lista_organizacion.="<option value=''>Por favor seleccione...</option>";
    for($i=0;$i<$datos['numcampos'];$i++){
        $lista_organizacion.="<option value='".$datos[$i]['idserie']."'>".$datos[$i]['nombre']."</option>";
    }
    $lista_organizacion.="</select></td>";
    echo ($lista_organizacion);
}*/

function listar_ordenes_compra($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	if(@$_REQUEST["iddoc"]){
		$doc=$_REQUEST["iddoc"];
		$datos=busca_filtro_tabla("A.ft_orden_compra","ft_radicacion_facturas A","A.documento_iddocumento=".$doc,"",$conn);
		$guardado=$datos[0]["ft_orden_compra"];
	}
	$formato=busca_filtro_tabla("","formato A","A.nombre='orden_compra'","",$conn);
	$ordenes=busca_filtro_tabla("B.numero, A.idft_orden_compra, B.iddocumento","ft_orden_compra A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO','ACTIVO')","B.fecha asc",$conn);
	
	$texto="";
	$texto.="<td><select name='ft_orden_compra' id='ft_orden_compra'><option value=''>Por favor seleccione...</option>";
	$evento=false;
	for($i=0;$i<$ordenes["numcampos"];$i++){
		$doc_padre=buscar_papa_primero($ordenes[$i]["iddocumento"]);
		$descripcion_padre=busca_filtro_tabla("descripcion_justificacion","ft_justificacion_compra A","A.documento_iddocumento=".$doc_padre,"",$conn);
		
		$seleccionado="";
		if($guardado==$ordenes[$i]["idft_orden_compra"]){
			$seleccionado="selected";
			$evento=true;
		}
		$texto.="<option value='".$ordenes[$i]["idft_orden_compra"]."' iddocumento='".$ordenes[$i]["iddocumento"]."' ".$seleccionado.">".$ordenes[$i]["numero"]." - ".substr(strip_tags($descripcion_padre[0]["descripcion_justificacion"]),0,70)."...</option>";
	}
	$texto.="</select><br><span id='mostrar_enlace'></span></td>";
	echo($texto);
	?>
	<script>
	$(document).ready(function(){
		<?php if($evento){ ?>
		$('#ft_orden_compra').change();
		<?php } ?>
	});
	$('#ft_orden_compra').change(function(){
		var documento=$('#ft_orden_compra option:selected').attr('iddocumento');
		if(documento){
			$('#mostrar_enlace').html('<a href="<?php echo($ruta_db_superior); ?>formatos/<?php echo($formato[0]["nombre"]); ?>/<?php echo($formato[0]["ruta_mostrar"]); ?>?iddoc='+documento+'&idformato=<?php echo($formato[0]["idformato"]); ?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 650, height: 500,contentId:\'cuerpo_paso\', preserveContent:false});">Ver orden</a>');
		}
		else{
			$('#mostrar_enlace').html("");
		}
	});
	</script>
	<?php
}

function cargar_remitente_orden_compra(){
?>
<script>
$("#ft_orden_compra").change(function(){   
	$.ajax({
	url: "cargar_proveedor.php", 
	type: "POST", 			
	data: {idft:$(this).val()},			
	success: function(msg) {	
		if(msg==0){
			alert('No se Encuentra el Proveedor');
		}else{
			vector=msg.split('|');
			$("#proveedor").val(vector[1]); 
			document.getElementById("frame_proveedor").src="../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=copia&campos_auto=nombre,identificacion&tipo=unico&campos=direccion&destinos="+vector[1];
			alert("Destino cargado");
		}  
	}		
	});
});
</script>
<?php
}

function validar_fechas($idformato,$iddoc){
	echo(".");
?>	
<script>
function separador_miles(input){
	var num = $("#"+input).val().replace(/\./g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		$("#"+input).val(num);
	}
	else{
		$("#"+input).val(valor.value.replace(/[^\d\.]*/g,''));
	}
}
$("#valor_factura").keyup(function(){
	separador_miles($("#valor_factura").attr('id'));
	console.log($(this).val());
});
separador_miles($("#valor_factura").attr('id'));		
	
$("#formulario_formatos").validate({
	submitHandler: function(form) {
		var fecha_exp=$("#fecha_expedicion").val();
		var fecha_ven=$("#fecha_vencimiento").val();
		if(fecha_exp>fecha_ven){
			alert('La fecha de vencimiento debe ser mayor o igual a la fecha de expedicion');
			$("#continuar").show();
			$("input[value='Enviando...']").hide();
			return false; 
		}else{	  
			$("#valor_factura").val($("#valor_factura").val().replace(/\./g,""));
			form.submit();
		}
	}
});	
</script>
<?php	
}
function codigo_organizacion($idformato,$iddoc){
	
}
//MOSTRAR
//********************
function mostrar_codigo_organizacion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.codigo_organizacion","ft_radicacion_facturas A","A.documento_iddocumento=".$iddoc,"",$conn);
	$organizacion=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$datos[0]['codigo_organizacion'],"",$conn);
	echo($organizacion[0]['nombre']);
}

function ver_valor_factura($idformato,$iddoc){
	global $conn,$datos;
	$datos=busca_filtro_tabla("","ft_radicacion_facturas","documento_iddocumento=".$iddoc,"",$conn);
	echo ("$".number_format($datos[0]['valor_factura'],0,"","."));
}

function ver_responsable_op($idformato,$iddoc){
	global $conn,$datos;
	$funcinario=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$datos[0]['responsable_op'],"",$conn);
	echo ($funcinario[0]['nombres']." ".$funcinario[0]['apellidos']);
}

function ver_adjuntar($idformato,$iddoc){
	global $conn,$ruta_db_superior,$datos;
	$anexo=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
	$html="";
	for($i=0;$i<$anexo['numcampos'];$i++){
		$html.="<a href='".$ruta_db_superior.$anexo[$i]['ruta']."'>".utf8_encode(html_entity_decode($anexo[$i]['etiqueta']))."</a><br />";
	}
	echo $html;
}

function mostrar_imagenes_factura($idformato,$iddoc){
  global $conn,$ruta_db_superior;
  if(@$_REQUEST['tipo']!=6){
  ?>
	<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_ventana_modal.js"></script>
	<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.lazy.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {        
		$("img").lazyload({
			effect : "fadeIn"
		});
	});  
	</script> 
  <?php
  }
	$paginas=busca_filtro_tabla("","pagina","id_documento=".$iddoc,"",$conn);
	if($paginas["numcampos"]){
	$ancho_imagen=  busca_filtro_tabla("", "configuracion", "nombre='ancho_miniatura'", "", $conn);
	$alto_imagen=  busca_filtro_tabla("", "configuracion", "nombre='alto_miniatura'", "", $conn);
	if(!$alto_imagen["numcampos"]){$alto_imagen[0]["valor"]=90;}
	if(!$ancho_imagen["numcampos"]){$ancho_imagen[0]["valor"]=120;}
	for($i=0;$i<$paginas["numcampos"];$i++){
		echo('<img width="80px" height="80px" src="http://'.RUTA_PDF.'/'.$paginas[$i]["imagen"].'" ancho_ventana_modal="730px" alt="" class="enlace_ventana_modal" enlace_ventana_modal="http://'.RUTA_PDF.'/pantallas/documento/pagina_documento.php?idpagina='.$paginas[$i]["consecutivo"].'" encabezado_ventana_modal="P&aacute;gina '.$paginas[$i]["pagina"].' de '.$paginas["numcampos"].'">&nbsp;');
		if(($i%3)==0&&$i!=0)
			echo '<br>';
		}
	}
}

function ordenes_compra_vinculadas($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	if(@$_REQUEST["tipo"]!=5){
		$idf=busca_filtro_tabla("C.numero,C.iddocumento,C.fecha","ft_orden_compra A, ft_radicacion_facturas B, documento C","A.idft_orden_compra=B.ft_orden_compra AND B.documento_iddocumento=".$iddoc." AND A.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO','ANULADO','ACTIVO')","",$conn);
		
		if($idf["numcampos"]){
			$texto="<p></p>";
			$texto.="<table style='width:100%'>";
			$texto.="<tr><td>Ordenes de compra vinculadas:</td></tr>";
			for($i=0;$i<$idf["numcampos"];$i++){
				$doc_padre=buscar_papa_primero($idf[$i]["iddocumento"]);
				$descripcion_padre=busca_filtro_tabla("descripcion_justificacion","ft_justificacion_compra A","A.documento_iddocumento=".$doc_padre,"",$conn);
				
				$texto.='<tr><td><a href="'.$ruta_db_superior.'ordenar.php?key='.$idf[$i]["iddocumento"].'&mostrar_formato=1" target="centro"><b>Fecha:</b> '.$idf[$i]["fecha"].' - <b>Radicado No:</b> '.$idf[$i]["numero"].' - '.substr(strip_tags($descripcion_padre[0]["descripcion_justificacion"]),0,70).'</a></td></tr>';
			}
			$texto.="</table>";
		}
		echo($texto);
	}
}
?>