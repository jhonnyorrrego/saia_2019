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

function mostrar_valor_control($idformato,$iddoc){
	global $conn;	
	
	$control_riesgos=busca_filtro_tabla("B.*","ft_acciones_riesgo A, ft_control_riesgos B","A.acciones_control=B.idft_control_riesgos AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	echo(codifica_encabezado(html_entity_decode($control_riesgos[0]['descripcion_control'])));
	
}

function fecha_acciones_riesgo($idformato,$iddoc){
	$fecha=busca_filtro_tabla(fecha_db_obtener("fecha","Y-m-d")." as fechax","documento a","a.iddocumento=".$iddoc,"",$conn);
	echo $fecha[0]["fechax"];	
}

function fecha_subscripcion_accion($idformato,$iddoc){
	$fecha=busca_filtro_tabla(fecha_db_obtener("fecha_accion","Y-m-d")." as fechax","ft_acciones_riesgo a","a.documento_iddocumento=".$iddoc,"",$conn);
	echo $fecha[0]["fechax"];
}
function fecha_accion_cumplimiento($idformato,$iddoc){
	$fecha=busca_filtro_tabla(fecha_db_obtener("fecha_cumplimiento","Y-m-d")." as fechax","ft_acciones_riesgo a","a.documento_iddocumento=".$iddoc,"",$conn);
	echo $fecha[0]["fechax"];
}

function control_funcion($idformato,$iddoc){

	if(@$_REQUEST["padre"]!=''){
		$padre=$_REQUEST["padre"];
	}
	else{
		$accion=busca_filtro_tabla("","ft_acciones_riesgo a","a.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$padre=$accion[0]["ft_riesgos_proceso"];
	}
	
	$valoracion=busca_filtro_tabla("descripcion_control, idft_control_riesgos","ft_control_riesgos a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_riesgos_proceso=".$padre,"idft_control_riesgos asc",$conn);
	$select='';
	$select.='<select name="acciones_control" id="acciones_control" class="required"><option value="">Por favor seleccione...</option>';
	for($i=0;$i<$valoracion["numcampos"];$i++){
		$selected='';
		if($accion[0]["acciones_control"]==$valoracion[$i]["idft_control_riesgos"])$selected='selected';
		$cadena_descripcion=ucfirst(strip_tags(decodifica_encabezado(html_entity_decode($valoracion[$i]["descripcion_control"]))));
		$cadena_descripcion=substr ( $cadena_descripcion , 0 , 50 );
		$select.='<option value="'.$valoracion[$i]["idft_control_riesgos"].'" '.$selected.'>'.$cadena_descripcion.'</option>';
	}//string substr ( string $string , int $start [, int $length ] )
	$select.='<option value="'.$valoracion[$i]["idft_control_riesgos"].'-1" '.$selected.'>Nuevo Control</option>';
	$select.='</select>';
	echo "<td>".$select."</td>";
}
function valor_control($idformato,$iddoc){
	$dato=busca_filtro_tabla("acciones_control","ft_acciones_riesgo a","documento_iddocumento=".$iddoc,"",$conn);
	
	$valor=busca_filtro_tabla("descripcion_control","ft_control_riesgos a","idft_control_riesgos=".$dato[0]["acciones_control"],"",$conn);
	
	echo strip_tags(utf8_decode(html_entity_decode($valor[0]["descripcion_control"])));
}
function validar_entrada_acciones_riesgo($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	include_once($ruta_db_superior."formatos/riesgos_proceso/librerias_riesgos.php");
	$papa=busca_filtro_tabla("probabilidad,impacto,idft_riesgos_proceso","ft_riesgos_proceso a","a.documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
	
	$disminuir=valoraciones($papa[0]["idft_riesgos_proceso"]);
	
	$probabilidad_auto=nuevo_punto_matriz($papa[0]["probabilidad"],$disminuir[0]);
	$impacto_auto=nuevo_punto_matriz($papa[0]["impacto"],$disminuir[1]);
	
	 $letra=tabla_evaluacion($probabilidad_auto,$impacto_auto);
	 if($letra!="M"&&$letra!="A"&&$letra!="E"&&$letra){
?>
<script type="text/javascript">
	$(document).ready(function(){
		//$('#formulario_formatos').find('input, textarea, button, select').attr('disabled',true);				
		//tree_reponsables.destructor();
	});
</script>
<?php
	 	alerta("Actualmente el riesgo se encuentra en Zona de Riesgo Baja. Evaluar si es necesario establecer acciones para mejorar los controles existentes.");
	 }
}

function validar_opciones_administrativas($idformato,$iddoc){
	global $conn, $ruta_db_superior;
	include_once($ruta_db_superior."formatos/riesgos_proceso/librerias.php");
	
	if($_REQUEST['anterior']){
		$riesgo = busca_filtro_tabla("idft_riesgos_proceso,probabilidad,impacto,tipo_riesgo","ft_riesgos_proceso","documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
	}else{
		$riesgo = busca_filtro_tabla("b.idft_riesgos_proceso,b.probabilidad,b.impacto,tipo_riesgo","ft_acciones_riesgo a, ft_riesgos_proceso b","a.ft_riesgos_proceso=b.idft_riesgos_proceso AND a.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
	}
	
	$probabilidad = calificacion_probabilidad($riesgo[0]['idft_riesgos_proceso'],$riesgo[0]['probabilidad'],1);	
	$impacto = calificacion_impacto($riesgo[0]['idft_riesgos_proceso'],$riesgo[0]['impacto'],1);
	
	
?>
<script type="text/javascript">
	$(document).ready(function(){
		
		var tipo_riesgo = "<?php echo($riesgo[0]["tipo_riesgo"]); ?>";
		
		$("#opcio_admin_riesgo0").parent().hide();
		$("#opcio_admin_riesgo1").parent().hide();
		$("#opcio_admin_riesgo2").parent().hide();
		$("#opcio_admin_riesgo3").parent().hide();		
		
		if(tipo_riesgo === "Corrupcion"){			
			$("#opcio_admin_riesgo0").parent().show();
			$("#opcio_admin_riesgo1").parent().show();
		}else{
			var punto_riesgo = "<?php echo("{".$probabilidad.",".$impacto."}");?>";
			var bajo     = ["{1,1}","{1,2}","{2,1}","{2,2}","{3,1}"];
			var moderado = ["{1,3}","{2,3}","{3,2}","{4,1}"];
			var alta     = ["{1,4}","{1,5}","{2,4}","{3,3}","{4,2}","{4,3}","{5,1}","{5,2}"];
			var extrema  = ["{2,5}","{3,4}","{3,5}","{4,4}","{4,5}","{5,3}","{5,4}","{5,5}"];			
			
			if(jQuery.inArray(punto_riesgo, bajo) >= 0){
				$("#opcio_admin_riesgo2").parent().show();
			}else if(jQuery.inArray(punto_riesgo, moderado) >= 0){
				$("#opcio_admin_riesgo1").parent().show();
			$("#opcio_admin_riesgo2").parent().show();
			}else if(jQuery.inArray(punto_riesgo, alta) >= 0){
				$("#opcio_admin_riesgo0").parent().show();
				$("#opcio_admin_riesgo1").parent().show();			
				$("#opcio_admin_riesgo3").parent().show();
			}else if(jQuery.inArray(punto_riesgo, extrema) >= 0){
				$("#opcio_admin_riesgo0").parent().show();
				$("#opcio_admin_riesgo1").parent().show();			
				$("#opcio_admin_riesgo3").parent().show();
			}
		}		
	});
</script>
<?php
}

function validar_revision_aprobacion_acciones_riesgo($idformato, $iddoc){	
	/*global $conn, $ruta_db_superior;
	echo(librerias_notificaciones());		
	
	$proceso = busca_filtro_tabla("a.documento_iddocumento, a.fecha_aprobacion_riesgo,a.fecha_revision_riesgo,a.nombre","
ft_proceso a, ft_riesgos_proceso b","a.idft_proceso=b.ft_proceso AND b.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);

	if($proceso[0]['fecha_aprobacion_riesgo'] && $proceso[0]['fecha_revision_riesgo']){	
?>
<script type="text/javascript">
$(document).ready(function(){
	notificacion_saia('Los riesgos del proceso <b><?php echo($proceso[0]['nombre']);?></b> est&aacute;n aprobados y revisados.<br /> no es posible adicionar mas Acciones','warning','',6500);
})
</script>
<?php	
	abrir_url($ruta_db_superior.'formatos/proceso/mostrar_proceso.php?iddoc='.$proceso[0]['documento_iddocumento'].'&idformato=9','_self');
	}*/
}
function botones_acciones_riesgos($idformato, $iddoc){
  global $ruta_db_superior;
  
  $riesgo = busca_filtro_tabla("a.documento_iddocumento","ft_riesgo_proceso a, ft_acciones_riesgo b","a.idft_riesgos_proceso=b.ft_riesgos_proceso AND b.documento_iddocumento=".$iddoc,"",$conn);  
  
  $ejecutor=busca_filtro_tabla("ejecutor","documento","iddocumento=".$iddoc,"",$conn);
  $area=busca_filtro_tabla("b.area_responsable","ft_acciones_riesgo a, ft_riesgos_proceso b","a.ft_riesgos_proceso=b.idft_riesgos_proceso and a.documento_iddocumento=".$iddoc,"",$conn);  
  $funcionario=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia in (".$area[0]["area_responsable"].")","group by funcionario_codigo",$conn);
	
	if($_REQUEST["tipo"]!=5){
		if(usuario_actual("funcionario_codigo")==$ejecutor[0]["ejecutor"] || usuario_actual("funcionario_codigo")==1449){
		  		$boton  = '<button type="button" id = "editar_valoracion_riesgo" onclick="editar_acciones()">Editar</button>';
				$boton .= '<button type="button" id = "eliminar_valoracion_riesgo" onclick="eliminar_acciones()">Eliminar</button>';
				echo ($boton);
	  	}else{
			for ($i=0; $i <$funcionario["numcampos"] ; $i++) {
				if(usuario_actual("funcionario_codigo")==$funcionario[$i]["funcionario_codigo"]){
					$boton  = '<button type="button" id = "editar_valoracion_riesgo" onclick="editar_acciones()">Editar</button>';
					$boton .= '<button type="button" id = "eliminar_valoracion_riesgo" onclick="eliminar_acciones()" >Eliminar</button>';
					echo ($boton);
				}		
		  	}
		 }
	 }else{
	 	echo("<br/>");
	 }
?>
<script type="text/javascript">
 
 function eliminar_acciones(){
 	$.ajax({
        url: 'cambiar_estado_documento_acciones_riesgo.php',
        type: 'POST',
        dataType: 'json',
        data: {
          iddocumento: '<?php echo($iddoc); ?>'      
        },
        success: function(){
            
            <?php $idformato_riesgos_proceso=busca_filtro_tabla("idformato","formato","nombre='riesgos_proceso'","",$conn);  ?>
            
         window.open("<?php echo($ruta_db_superior);?>/formatos/riesgos_proceso/mostrar_riesgos_proceso.php?iddoc=<?php echo($riesgo[0]["documento_iddocumento"]); ?>&idformato=<?php echo($idformato_riesgos_proceso[0]['idformato']); ?>","_self");
         
          //redireccion: /formatos/riesgos_proceso/mostrar_riesgos_proceso.php?iddoc=116877&idformato=13
        }
    });
 }

 function editar_acciones(){
 	window.open("<?php echo($ruta_db_superior);?>formatos/acciones_riesgo/editar_acciones_riesgo.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato);?>","_self");
 }
</script>
<?php
}
?>