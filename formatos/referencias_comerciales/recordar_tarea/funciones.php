<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function eliminar_registro_tarea($idformato,$iddoc){
	global $conn;
	
	$creador=busca_filtro_tabla("ejecutor","documento","iddocumento=".$iddoc,"",$conn);
	if($_REQUEST["tipo"]<>5){		
		if(usuario_actual("funcionario_codigo")==$creador[0][0]){
			echo '<input type="button" value="Eliminar tarea" title="Eliminar Registro de la Tarea" onclick="eliminar_tarea()" />';
		}
	}
	?>
	<script type="text/javascript">
	  function eliminar_tarea() {
			$.ajax({
       	type:'POST',
		    url: "cambiar_estado_tarea.php",
		    data: {iddoc:<?php echo $iddoc ?>},
		    success: function(data){
		    	if(data==1){
		    		alert("El registro de la tarea ha sido eliminado.");
		    		//location.reload();
		    	}else{
		    		alert("El registro de tarea no ha podido ser eliminado.");
		    	} 
     		}
   		});			   
	  }
	</script>
	<?php
}
function aeditar_registro_tare($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	if($_REQUEST["tipo"]<>5)
		$usuario = usuario_actual('funcionario_codigo');
	$creador=busca_filtro_tabla("A.ejecutor","documento A","A.iddocumento=".$iddoc,"",$conn);
		
	if($usuario==$creador[0]['ejecutor']){
		$texto="<a href='editar_recordar_tarea.php?iddoc=".$iddoc."&idformato=".$idformato."' title='Editar Registro de la Tarea'><img width='16' height='16' src='../../botones/comentarios/editar_documento.png'></a>";
	}
	echo ($texto);	
}

function transferir_tarea($idformato,$iddoc){
	global $conn;
	
	$origen=busca_filtro_tabla("funcionario","digitalizacion","documento_iddocumento=".$iddoc,"",$conn);	
	$responsables=busca_filtro_tabla("responsable","ft_recordar_tarea","documento_iddocumento=".$iddoc,"",$conn);	
	$res=explode(',', $responsables[0][0]);
	
	$tam=sizeof($res);
	for ($i=0;$i<$tam;$i++) {
		$codigos=busca_filtro_tabla("funcionario_codigo","dependencia_cargo B, funcionario C","B.iddependencia_cargo=".$res[$i]." and B.funcionario_idfuncionario=idfuncionario and B.estado=1","",$conn);			
		transferencia_automatica_tareas(208,$iddoc,$origen[0][0],$codigos[0][0]."@",3);
	}
	
	$vinculados=busca_filtro_tabla("vinculados","ft_recordar_tarea","documento_iddocumento=".$iddoc,"",$conn);
	$vin=explode(',', $vinculados[0][0]);
	
	$tam2=sizeof($vin);
	for ($i=0;$i<$tam2;$i++) {
		$codigos=busca_filtro_tabla("funcionario_codigo","dependencia_cargo B, funcionario C","B.iddependencia_cargo=".$vin[$i]." and B.funcionario_idfuncionario=idfuncionario and B.estado=1","",$conn);		
		transferencia_automatica_tareas(208,$iddoc,$origen[0][0],$codigos[0][0]."@",3);
	}
}	


function mostrar_avances($idformato,$iddoc){
	global $conn;
	
	$item=busca_filtro_tabla("B.*","ft_recordar_tarea A, ft_avances B","ft_recordar_tarea=idft_recordar_tarea and A.documento_iddocumento=".$iddoc,"",$conn);	
	
	$texto.=("<table  style='border-collapse: collapse; border-width:1px' border='1'>");
	$texto.=("<tr class='encabezado'>
	<td style=font-size:12px><strong>Fecha</strong>
	</td>
	<td style=font-size:12px><strong>Autor</strong>
	</td>
	<td style=width:50%;font-size:12px><strong>Descripci&oacute;n</strong>
	</td>
	<td style=font-size:12px><strong>Estado</strong>
	</td>
	</tr>");
	for ($i=0;$i<$item['numcampos'];$i++) {
		$documento=busca_filtro_tabla("ejecutor","documento","iddocumento=".$item[$i]["documento_iddocumento"],"",$conn);
		$ejecutor=busca_filtro_tabla("","funcionario","funcionario_codigo=".$documento[0][0],"",$conn);
		$texto.=("<tr>
		<td style=font-size:12px>".$item[$i]["fecha_formato"]."</td>
		<td style=font-size:12px>".$ejecutor[0]["nombres"]." ".$ejecutor[0]["apellidos"]."</td>
		<td style=font-size:12px>".html_entity_decode($item[$i]["descripcion_formato"])."</td>
		<td style=font-size:12px>".$item[$i]["estado"]."</td>
		</tr>");
	}
	$texto.=('</table>');
	if($item["numcampos"])
		echo($texto);		
}
function mostrar_calificacion($idformato,$iddoc){
	global $conn;
	
	/*$item=busca_filtro_tabla("B.*","ft_registro_tarea A, ft_calificacion_tarea B","ft_registro_tarea=idft_registro_tarea and A.documento_iddocumento=".$iddoc,"",$conn);
	$texto.=("<table align='center' style='border-collapse: collapse; border-width:1px' border='1'>");
	$texto.=("<tr class='encabezado'><td><strong>Fecha</strong></td><td><strong>Calificaci&oacute;n</strong></td></tr>");
	for ($i=0;$i<$item['numcampos'];$i++) {
		$texto.=("<tr><td>".$item[$i]["fecha_formato"]."</td><td>".$item[$i]["calificacion_tarea"]."</td></tr>");
	}
	$texto.=('</table>');
	if($item["numcampos"])
		echo($texto);*/
}
function recordatorio_funcion($idformato,$iddoc){
	global $conn;
	
	?><script>
		$("#dias_recordar").parent().parent().hide();
		$("#horas_recordar").parent().parent().hide();
		$("#semanas_recordar").parent().parent().hide();
		$("#mes_recordar").parent().parent().hide();
		
		$("#tipo_periodo0").click(function(){
			$("#horas_recordar").parent().parent().show();
			$("#dias_recordar").parent().parent().hide();
			$("#semanas_recordar").parent().parent().hide();
			$("#mes_recordar").parent().parent().hide();
		});
		$("#tipo_periodo1").click(function(){
			$("#dias_recordar").parent().parent().show();
			$("#horas_recordar").parent().parent().hide();
			$("#semanas_recordar").parent().parent().hide();
			$("#mes_recordar").parent().parent().hide();
		});
		$("#tipo_periodo2").click(function(){
			$("#dias_recordar").parent().parent().hide();
			$("#horas_recordar").parent().parent().hide();
			$("#semanas_recordar").parent().parent().show();
			$("#mes_recordar").parent().parent().hide();
		});
		$("#tipo_periodo3").click(function(){
			$("#dias_recordar").parent().parent().hide();
			$("#horas_recordar").parent().parent().hide();
			$("#semanas_recordar").parent().parent().hide();
			$("#mes_recordar").parent().parent().show();
		});
		$("#tipo_periodo4").click(function(){
			$("#dias_recordar").parent().parent().hide();
			$("#horas_recordar").parent().parent().hide();
			$("#semanas_recordar").parent().parent().hide();
			$("#mes_recordar").parent().parent().hide();
		});
	</script><?php
}
function mostrar_anexos_tarea($idformato,$iddoc){
global $conn,$ruta_db_superior;

$anexos=busca_filtro_tabla("ruta,etiqueta","anexos","documento_iddocumento=".$iddoc,"",$conn);
if($anexos["numcampos"]>0){
for ($i=0;$i<$anexos["numcampos"];$i++) {
echo "<a href=../../".$anexos[$i]["ruta"].">".html_entity_decode($anexos[$i]["etiqueta"])."</a><br />";
}
} 
}
?>