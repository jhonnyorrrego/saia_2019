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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

//ADICIONAR / EDITAR
function carga_ciudad_solicitud($idformato,$iddoc){
  global $conn;
	$datos=busca_filtro_tabla("A.idmunicipio as municipio, B.iddepartamento AS departamento","municipio A, departamento B","A.departamento_iddepartamento=B.iddepartamento AND LOWER(A.nombre) LIKE LOWER('%cali%') AND LOWER(B.nombre) LIKE LOWER('%valle%')","",$conn);

?>
	<script type="text/javascript">
		$(document).ready(function(){
			
		  $("[hijo='ciudad_origen']").val("<?php echo($datos[0]['departamento']);?>");
			$("[hijo='ciudad_origen']").trigger("change");
		
			function carga_municipio(){
			  $("#ciudad_origen").attr("value","<?php echo($datos[0]['municipio']);?>");
			  clearTimeout(myVar);
			}
			var myVar=setTimeout(carga_municipio,1000);
	  });
	</script>
<?php
}

function separar_miles_solicitud($idformato,$iddoc){ global $conn;
?>
	<script>
		function cargar_puntos(){
			Moneda_r($("#valor_declarado").attr('id'));
		}
		 
		cargar_puntos();
		$("#valor_declarado").keyup(function(){
			Moneda_r($("#valor_declarado").attr('id'));
		});
		$("#valor_declarado").blur(function(){
			Moneda_r($("#valor_declarado").attr('id'));
		});
		  
		$('#formulario_formatos').
		validate({
			submitHandler: function(form){
				var valor_ =new String($("#valor_declarado").val());
				var nuevo_valor = valor_.replace(/\./g,"");
				$("#valor_declarado").val(nuevo_valor);
				             
				form.submit();  
			}      
		});
		  
		function Moneda_r(input){
			var num = $("#"+input).val().replace(/\./g,'');
			if(!isNaN(num)){
				num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
				num = num.split('').reverse().join('').replace(/^[\.]/,'');
				$("#"+input).val(num);
			}
		}
	</script>
<?php
}

function oculta_campos_adicionar_solicitud($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_solicitud_servicio A","A.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);	
?>
	<script type="text/javascript">
		$(document).ready(function(){
			var tipo_caja="<?php echo($datos[0]['referencia_caja']);?>";
			//Radiobutton tipo envio
			if($("#tipo_envio_solicitud1").is(':checked')){
				$("#valor_declarado,#peso_envio_solicitud,#tamanio_aproximado").parent().parent().show();
			}else{
				$("#valor_declarado,#peso_envio_solicitud,#tamanio_aproximado").parent().parent().hide();
			}
			
			//Checkbox Tipo de Mercancia
			if($("#tipo_mercancia0,#tipo_mercancia1,#tipo_mercancia2").is(':checked')){
				$("#cantidad_mercancia").parent().parent().show();
			}else{
				$("#cantidad_mercancia").parent().parent().hide();				
			}
			
			if($("#tipo_mercancia0").is(':checked')){
				$("#referencia_caja").parent().parent().show();
			}else{				
				$("#referencia_caja").parent().parent().hide();
			}/**/
						
			$("#tipo_mercancia0").click(function(){
				if($(this).is(':checked')){					
					$("#referencia_caja").parent().parent().show();
				}else{
					$("#referencia_caja,#referencia_caja").attr("value","");
					$("#referencia_caja").parent().parent().hide();
				}
			});
			
			var seleccion=0;
			$("#tipo_mercancia0,#tipo_mercancia1,#tipo_mercancia2").click(function(){
				if($(this).is(':checked')){
					seleccion+=1;
				}else{
					seleccion-=1;
				}
				
				if(seleccion>0){
					$("#cantidad_mercancia").parent().parent().show();
				}else{
					$("#cantidad_mercancia").attr("value","");
					$("#cantidad_mercancia").parent().parent().hide();					
				}
			});
			
			////**************
			//Radiobutton Requere recoleccion
			if($("#requiere_recoleccion0").is(':checked')){
				$("#direccion_recoleccion").parent().parent().show();
				$("#fecha_recoleccion").parent().parent().parent().show();
			}else{				
				$("#direccion_recoleccion").parent().parent().hide();
				$("#fecha_recoleccion").parent().parent().parent().hide();
			}
			
		
			//Clic tipo solicitud
			$("#tipo_envio_solicitud1").click(function(){				
				$("#valor_declarado,#peso_envio_solicitud,#tamanio_aproximado").parent().parent().show();
			});
			
			$("#tipo_envio_solicitud0").click(function(){				
				$("#valor_declarado,#peso_envio_solicitud,#tamanio_aproximado").attr("value","");
				$("#valor_declarado,#peso_envio_solicitud,#tamanio_aproximado").parent().parent().hide();
			});
			
			//Clic Recoleccion
			$("#requiere_recoleccion0").click(function(){				
				$("#direccion_recoleccion").parent().parent().show();
				$("#fecha_recoleccion").parent().parent().parent().show();
			});
			
			$("#requiere_recoleccion1").click(function(){
				$("#direccion_recoleccion").attr("value","");
				$("#fecha_recoleccion").attr("value","0000-00-00");								
						
				$("#direccion_recoleccion").parent().parent().hide();
				$("#fecha_recoleccion").parent().parent().parent().hide();
			});
			
			//Chequeo Radiobuton No digitalizacion
			$("input[name='digitalizacion'][value='2']").attr("checked",true);
		});
	</script>
<?php
}

//MOSTRAR
function oculta_campos_mostrar_solicitud($idformato,$iddoc){
  global $conn;
	
?>
	<script type="text/javascript">
		$(document).ready(function(){
			var tipo_envio="<?php echo($datos[0][''])?>";
		});
	</script>
<?php
}

function mostrar_fecha_solicitud($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla(fecha_db_obtener("A.fecha_hora_solicitud","d-m-Y h:i")." AS fecha_hora_solicitud,".fecha_db_obtener("A.fecha_hora_solicitud","H")." AS horas","ft_solicitud_servicio A","A.documento_iddocumento=".$iddoc,"",$conn);
	
	if($datos[0]['horas']>=12){
		$hora=" PM";
	}else{
		$hora=" AM";
	}
	
	echo($datos[0]['fecha_hora_solicitud'].' '.$hora);
}

function mostrar_ciudad_solicitud($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.ciudad_origen","ft_solicitud_servicio A","A.documento_iddocumento=".$iddoc,"",$conn);
	$ciudad=busca_filtro_tabla("A.nombre AS municipio, B.nombre AS departamento","municipio A, departamento B","A.departamento_iddepartamento=B.iddepartamento AND A.idmunicipio=".$datos[0]['ciudad_origen'],"",$conn);
	echo($ciudad[0]['municipio'].', '.$ciudad[0]['departamento']);
}
function fk_idsolicitud_afiliacion_funcion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$valor="";
	if(@$_REQUEST["iddoc"]){
		$seleccionado=busca_filtro_tabla("fk_idsolicitud_afiliacion","ft_solicitud_servicio A","A.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$valor=$seleccionado[0]["fk_idsolicitud_afiliacion"];
	}
	/*$datos=busca_filtro_tabla("","ft_solicitud_afiliacion A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO')","",$conn);
	if(@$_REQUEST["iddoc"]){
		$iddoc=$_REQUEST["iddoc"];
		$actual=busca_filtro_tabla("fk_idsolicitud_afiliacion","ft_solicitud_servicio A","A.documento_iddocumento=".$iddoc,"",$conn);
		$seleccionados=explode(",",$actual[0]["fk_idsolicitud_afiliacion"]);
	}*/
	echo('<td><input type="text" id="validar_afiliacion"><br />
	<span id="descripcion_mensaje"></span>
	<input type="hidden" name="fk_idsolicitud_afiliacion" id="fk_idsolicitud_afiliacion" value="'.$valor.'">
	</td>');
	?>
	<script src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
	<script>
	$("#validar_afiliacion").blur(function(){
		var valor=$(this).val();
		if(!valor)return false;
		$.post("validar_afiliacion.php",{idft_solicitud_afiliacion:valor},function(respuesta){
			var datos=respuesta.split("|");
			if(datos[0]==1){
				$("#descripcion_mensaje").after(datos[1]+"<br>");
				$("#validar_afiliacion").val("");
				
				nuevo_valor(valor);
			}
			else if(datos[0]==2){
				notificacion_saia('Radicacion no encontrada','succes','',3500);
				$("#validar_afiliacion").val("");
			}
			else if(datos[0]==3){
				notificacion_saia('Radicacion ya se encuentra registrada en un paquete','succes','',3500);
				$("#validar_afiliacion").val("");
			}
		});
	});
	function nuevo_valor(valor){
		var valores_guardados=$("#fk_idsolicitud_afiliacion").val().split(",");
		var cant=valores_guardados.length;
		var dato_guardar=new Array();
		var indice=0;
		for(var i=0;i<cant;i++){
			if(valores_guardados[i]!=valor&&valores_guardados[i]){
				dato_guardar[indice]=valores_guardados[i];
				indice++;
			}
		}
		dato_guardar[indice]=valor;
		$("#fk_idsolicitud_afiliacion").val(dato_guardar.join(","));
	}
	</script>
	<?php
}
function enlaces_afiliaciones_funcion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$dato=busca_filtro_tabla("fk_idsolicitud_afiliacion","ft_solicitud_servicio A","A.documento_iddocumento=".$iddoc,"",$conn);
	$afiliaciones=busca_filtro_tabla("","ft_radicacion_entrada A","A.idft_radicacion_entrada in(".$dato[0]["fk_idsolicitud_afiliacion"].")","",$conn);
	$formato=busca_filtro_tabla("","formato A","A.nombre='radicacion_entrada'","",$conn);
	$texto=array();
	if($_REQUEST["tipo"]!=6){
	?><script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
  <script type='text/javascript'>
    hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php
	}
	for($i=0;$i<$afiliaciones["numcampos"];$i++){
		$nombres=busca_filtro_tabla("","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$afiliaciones[$i]["persona_natural"],"",$conn);
		$texto[]='<a href="'.$ruta_db_superior.'formatos/solicitud_afiliacion/mostrar_solicitud_afiliacion.php?idformato='.$formato[0]["idformato"].'&iddoc='.$afiliaciones[$i]["documento_iddocumento"].'&cargar_highslide=1" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 850, height: 500,contentId:\'cuerpo_paso\', preserveContent:false} )">'.ucwords(strtolower($nombres[0]["nombre"].' - '.$nombres[0]["identificacion"])).'</a>';
	}
	echo("<b>Radicaciones de entrada Incluidas:</b><br/><br/>".implode("<br/>",$texto));
}
?>