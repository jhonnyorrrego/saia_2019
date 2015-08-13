<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."sql.php");
include_once($ruta_db_superior."asignacion.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/librerias/funciones_acciones.php");


//ADICIONAR - EDITAR
//************************
function carga_lista_verificacion_afiliados($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_verifica_informacion A","A.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
	if($_REQUEST['anterior']){
		$datos_recepcion=busca_filtro_tabla("A.numero_solicitud","ft_radica_doc_mercantil A","A.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);		
	}else{
		$datos_recepcion=busca_filtro_tabla("B.numero_solicitud, A.datos_remitente","ft_verifica_informacion A, ft_radica_doc_mercantil B","A.ft_radica_doc_mercantil=B.idft_radica_doc_mercantil AND A.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
	}
	$datos_solicitud=busca_filtro_tabla("A.fk_idsolicitud_afiliacion","ft_solicitud_servicio A","A.idft_solicitud_servicio=".$datos_recepcion[0]['numero_solicitud'],"",$conn);
	
	$afiliados=busca_filtro_tabla("","ft_solicitud_afiliacion A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado NOT IN('ANULADO','ELIMIANDO') AND idft_solicitud_afiliacion in(".$datos_solicitud[0]['fk_idsolicitud_afiliacion'].")","",$conn);
	
	$lista_afiliados="<td><select name='datos_remitente' id='datos_remitente'>";
	$lista_afiliados.="<option value=''>Por favor seleccione...</option>";
	for($i=0;$i<$afiliados['numcampos'];$i++){
		$actual=busca_filtro_tabla("","ft_verifica_informacion A, documento B","A.datos_remitente=".$afiliados[$i]['idft_solicitud_afiliacion']." AND ft_radica_doc_mercantil=".$_REQUEST["padre"]." AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO')","",$conn);
		if($actual["numcampos"])continue;
		$id_afiliado=busca_filtro_tabla("A.datos_solicitante","ft_solicitud_afiliacion A","A.idft_solicitud_afiliacion=".$afiliados[$i]['idft_solicitud_afiliacion'],"",$conn);
		$solicitante=busca_filtro_tabla("B.nombre","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$id_afiliado[0]['datos_solicitante'],"",$conn);
		$lista_afiliados.="<option value='".$afiliados[$i]['idft_solicitud_afiliacion']."'>".$solicitante[0]['nombre']."</option>";
	}
	$lista_afiliados.="</select></td>";
	echo ($lista_afiliados);

?>
	<script type="text/javascript">
		$(document).ready(function(){
			var folios="<?php echo($datos[0]['numero_folios_verifi'])?>";
			$("#datos_remitente").change(function(){
				$("#datos_remitente option:selected").each(function () {
					var seleccionado = "";
					seleccionado = $(this).val();
					$.ajax({
						type:'POST',
						dataType: 'json',
						url: "buscar_afiliado.php",
						data: {
										idft_solicitud:seleccionado
						},
						success: function(datos){
							//alert("El mensaje recibido es: "+datos.identificacion);
							$("#identifica_afiliado").val(datos.identificacion);
							$("#fecha_inicial_verifi").val(datos.fecha_solicitud);
							$("#numero_folios_verifi").val(datos.numero_folios);
							$("#numero_folios_recibi").val(datos.numero_folios)/**/
							folios=datos.numero_folios;
						}
					});   
					//Guardo el afiliado seleccionado
					$("#nombre_afiliado").attr("value",$(this).text());     
				});
			});
			
			$("#numero_folios_recibi").keyup(function(){
				$("#numero_folios_recibi").after("<div id='mensaje'></div>");
				console.log($(this).val()+' '+folios);
				if($(this).val()==folios){
					$(".mensaje").remove();
					$("#numero_folios_recibi").after("<div class='mensaje'><font color='red'>Cumple</font></div>");
				}else{
					$(".mensaje").remove();
					$("#numero_folios_recibi").after("<div class='mensaje'><font color='red'>No cumple</font></div>");
				}
			});
			
			//Bloque la edicion de campos
			$("#identifica_afiliado,#fecha_inicial_verifi,#numero_folios_verifi").attr("readonly",true);
			
			//Oculto campos
			$("#nombre_afiliado").parent().parent().hide();
			
			//Selecciono el elemento en el Listado
			console.log("<?php echo($datos_solicitud[0]['datos_remitente'])?>");
			$("#datos_remitente").val("<?php echo($datos_recepcion[0]['datos_remitente'])?>");			
		});
	</script>
<?php
}

function vincular_expediente_documento_verifica($idformato,$iddoc){
	global $conn;
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
	$documento=busca_filtro_tabla("B.documento_iddocumento","ft_verifica_informacion A, ft_solicitud_afiliacion B","A.datos_remitente=B.idft_solicitud_afiliacion AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	if(@$_REQUEST["fk_idexpediente"]){
		$expedientes=explode(",",$_REQUEST["fk_idexpediente"]);
		$cant=count($expedientes);
		include_once($ruta_db_superior."pantallas/expediente/librerias.php");
		for($i=0;$i<$cant;$i++){
			if($expedientes[$i]){
				vincular_documento_expediente($expedientes[$i],$documento[0]["documento_iddocumento"]);
			}
		}
	}
	else if(@$_REQUEST["serie_idserie"]){
		$idexpediente=busca_filtro_tabla("b.idexpediente","serie a, expediente b","a.idserie=".$_REQUEST["serie_idserie"]." and a.cod_padre=b.serie_idserie","",$conn);
		if($idexpediente["numcampos"]){
			include_once($ruta_db_superior."pantallas/expediente/librerias.php");
			vincular_documento_expediente($idexpediente[0]["idexpediente"],$documento[0]["documento_iddocumento"]);
		}
	}
}
//MOSTRAR
//************************
function mostrar_solicitud_afiliacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos_afiliacion=busca_filtro_tabla("B.*","ft_verifica_informacion A, ft_solicitud_afiliacion B","A.datos_remitente=B.idft_solicitud_afiliacion AND A.documento_iddocumento=".$iddoc,"",$conn);
	$idformato_afiliacion=busca_filtro_tabla("A.idformato","formato A","A.nombre='solicitud_afiliacion'","",$conn);
	
//Enlace Informacion Vehiculo
	//$enlace_afiliacion.='<a style="font-size:10pt;" class="abrir_higslide" ruta="http://'.RUTA_PDF.'/formatos/solicitud_afiliacion/mostrar_solicitud_afiliacion.php?iddoc='.$datos_afiliacion[0]["documento_iddocumento"].'&idformato='.$idformato_afiliacion[0]['idformato'].'">Ver SOLICITUD AFILIACIÓN</a>';
	
	$enlace_afiliacion='<a style="font-size:10pt;" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height: 500,preserveContent:false} )" href="'.$ruta_db_superior.'/formatos/solicitud_afiliacion/mostrar_solicitud_afiliacion.php?iddoc='.$datos_afiliacion[0]["documento_iddocumento"].'&idformato='.$idformato_afiliacion[0]['idformato'].'&carga_highslide=1">Ver SOLICITUD DE AFILIACIÓN</a>';
	
	//$enlace_afiliacion='<a class="abrir_higslide" '
	echo($enlace_afiliacion);
	print_r($datos);
	echo(librerias_highslide());
	
?>
	<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
  <link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
  <script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
	</script>
<?php
}
?>