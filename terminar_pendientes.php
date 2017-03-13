<?php
include_once("db.php");
include_once("librerias_saia.php");
include_once("formatos/librerias/estilo_formulario.php");
echo(librerias_jquery());
echo(estilo_bootstrap());
echo(librerias_notificaciones());
echo(librerias_acciones_kaiten());
if(@$_REQUEST["accion"]){
	terminar_documentos();
}
else{
	formulario_terminar();
}
function formulario_terminar(){
	$usuario=usuario_actual('funcionario_codigo');
	$docs=@$_REQUEST["docs"];
	$documentos=busca_filtro_tabla("","documento A","A.iddocumento in(".$docs.")","",$conn);
	$tabla='';
	$tabla.='<style>
	body{
		padding-top: 10px;
		padding-left: 10px;
	}
	</style>';
	$tabla.='<body>';
	$tabla.='<form method="post" name="formulario_formatos"  id="formulario_formatos" action="terminar_pendientes.php">';
	$tabla.='<legend>Terminar Documentos</legend><br>';
	$tabla.='<table style="width:100%;" class="table table-bordered">';
	$tabla.='<tr>';
	$tabla.='<td style="text-align:center" class="encabezado_list"><b>Radicado</b></td>';
	$tabla.='<td style="text-align:center" class="encabezado_list"><b>Descripci&oacute;n</b></td>';
	$tabla.='<td style="text-align:center" class="encabezado_list"><a id="seleccionar_todos" class="link" style="color:white;text-decoration:underline;">Todos</a><br /><a id="ninguno" class="link" style="color:white;text-decoration:underline;">Ninguno</a></td>';
	$tabla.='</tr>';
	for($i=0;$i<$documentos["numcampos"];$i++){
		$pendiente=busca_filtro_tabla("idasignacion","asignacion","documento_iddocumento=".$documentos[$i]["iddocumento"]." and entidad_identidad=1 and llave_entidad=".$usuario,"",$conn);
		$tabla.='<tr>';
		$tabla.='<td style="text-align:center"><div class="btn btn-mini kenlace_saia" conector="iframe" enlace="ordenar.php?key='.$documentos[$i]["iddocumento"].'&accion=mostrar&mostrar_formato=1" title="Radicado No '.$documentos[$i]["numero"].'" titulo="Radicado No '.$documentos[$i]["numero"].'" onclick=" ">'.$documentos[$i]["numero"].'</div></td>';
		$tabla.='<td style="text-align:left">'.strip_tags(codifica_encabezado(html_entity_decode($documentos[$i]["descripcion"]))).'&nbsp;</td>';
		if($pendiente["numcampos"]){
			$tabla.='<td style="text-align:center"><input class="documentos" type="checkbox" name="docs[]" id="documento_'.$documentos[$i]["iddocumento"].'" value="'.$documentos[$i]["iddocumento"].'" checked="true"></td>';
		}
		else{
			$terminado=busca_filtro_tabla("","buzon_salida A","A.archivo_idarchivo=".$documentos[$i]["iddocumento"]." AND nombre='TERMINADO' AND ((tipo_origen='1' AND origen=".$usuario.")OR(tipo_destino='1' AND destino=".$usuario."))","",$conn);
			if($terminado["numcampos"]){
				$tabla.='<td style="text-align:center">Documento terminado</td>';
			}
			else{
				$tabla.='<td style="text-align:center">Documento no encontrado en sus pendientes</td>';
			}
		}
		$tabla.='</tr>';
	}
	$tabla.='<tr><td colspan="3" style="text-align:center">
	<input type="radio" name="detalle" onclick=\'document.getElementById("notas").value=this.value;\' value="Ya fue le&iacute;do">Ya fue le&iacute;do &nbsp;&nbsp;  <input type="radio" name="detalle" onclick=\'document.getElementById("notas").value=this.value;\' value="Recibido en medio f&iacute;sico">Recibido en medio f&iacute;sico &nbsp;&nbsp;<input type="radio" name="detalle" onclick=\'document.getElementById("notas").value=this.value;\' value="Documento Informativo">Documento Informativo<br>
	<textarea style="width:100%;" name="notas" id="notas"></textarea></td></tr>';
	$tabla.='</table>';
	$tabla.='<input class="btn btn-mini btn-primary" type="submit" value="Terminar documentos">';
	$tabla.='<input type="hidden" name="accion" value="1">';
	$tabla.='<input type="hidden" name="docus_preseleccionados" value="'.$docs.'">';
	$tabla.='</form>';
	$tabla.='</body>';
	$tabla.='<script>
	$("#formulario_formatos").bind("submit",function(){
		var notas =$("#notas").val();
		if(notas.trim().length==0 || notas==""){
			alert("Ingrese las observaciones");
			return false;
		}
		return true;
	});
	$("#seleccionar_todos").click(function(){
		$(".documentos").each(function(){
			$(this).attr("checked","true");
		});
	});
	$("#ninguno").click(function(){
		$(".documentos").each(function(){
			$(this).removeAttr("checked");
		});
	});
	</script>';
	echo($tabla);
}
function terminar_documentos(){
	global $conn;
	$documentos=implode(",",$_REQUEST["docs"]);
	$docus_preseleccionados=$_REQUEST["docus_preseleccionados"];
	$usuario=usuario_actual('funcionario_codigo');
	$nota=$_REQUEST["notas"];
	$docs=busca_filtro_tabla("iddocumento,documento.estado,tipo_radicado,idasignacion,numero","asignacion,documento","tarea_idtarea=2 and llave_entidad='$usuario' and documento_iddocumento=iddocumento and entidad_identidad=1 AND iddocumento in(".$documentos.")","documento.fecha desc",$conn);
	
	for($i=0;$i<$docs["numcampos"];$i++){
		$sql="INSERT INTO buzon_entrada(archivo_idarchivo,nombre,fecha,destino,tipo_origen,tipo_destino,ver_notas,origen,notas) values('".$docs[$i]["iddocumento"]."','TERMINADO',".fecha_db_almacenar("","Y-m-d H:i:s").",'$usuario','1','1','1','$usuario','$nota')";
	  phpmkr_query($sql);
	  $sql="INSERT INTO buzon_salida(archivo_idarchivo,nombre,fecha,destino,tipo_origen,tipo_destino,ver_notas,origen,notas) values('".$docs[$i]["iddocumento"]."','TERMINADO',".fecha_db_almacenar("","Y-m-d H:i:s").",'$usuario','1','1','1','$usuario','$nota')";
	  phpmkr_query($sql);
	  $sql="delete from asignacion where idasignacion='". $docs[$i]["idasignacion"]."'";
	 	phpmkr_query($sql);
	 	if($docs[$i]["estado"]=="ACTIVO" && $docs[$i]["tipo_radicado"]=="1"){
	 		$sql="update documento set estado='APROBADO' where  iddocumento='". $docs[$i]["iddocumento"]."'";
	    phpmkr_query($sql);
	  }
	}
	?>
	<script>
	notificacion_saia('Documento(s) terminado(s)','success','',3500);
	</script>
	<?php
	abrir_url("terminar_pendientes.php?docs=".$docus_preseleccionados,"_self");
}
//echo(librerias_bootstrap());
?>