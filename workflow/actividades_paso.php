<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
//menu_pasos($_REQUEST["idpaso"]);
$actividades_paso=busca_filtro_tabla("","paso_actividad A","A.paso_idpaso=".$_REQUEST["idpaso"],"",$conn);
//print_r($actividades_paso);
$texto = '
<script type="text/javascript" src="'.$ruta_db_superior.'js/jquery.js"></script>
<script>
function eliminar_actividad(id){
	var seguro = confirm("Seguro que desea eliminar la actividad?");
	if(seguro)
	{
		$.post("eliminar_actividad.php",{idactividad : id},function(exito){
			window.location="actividades_paso.php?idpaso='.$_REQUEST["idpaso"].'";
		});
	}
}
</script>
';
$texto.='<table width="90%" border="1px" style="border-collapse:collapse;">
<tr><td colspan="6">Listado de Actividades del Paso</td></tr>
<tr><td colspan="6"><a href="adicionar_actividad_paso.php?paso_idpaso='.$_REQUEST["idpaso"].'">Adicionar Actividad al Paso</a></td></tr>
<tr class="encabezado_list"><td colspan="6">Actividades Pendientes</td></tr>';     
$texto.='<tr class="encabezado_list"><td>Descripcion</td><td>Propiedades</td><td>Responsable</td><td>Acciones</td><td colspan="2"></td></tr>';
$restrictivo[0]=$ruta_db_superior.'botones/workflow/restrictivo.png'; //Se deben ejecutar todas las acciones en el paso.
$restrictivo[1]=$ruta_db_superior.'botones/workflow/norestrictivo.png'; //El cumplimiento de una de las acciones 
$tipo_paso[0]=$ruta_db_superior.'botones/workflow/sistema.png';
$tipo_paso[1]=$ruta_db_superior.'botones/workflow/manual.png';
for($i=0;$i<$actividades_paso["numcampos"];$i++){
  $responsables=buscar_entidad_asignada($actividades_paso[$i]["entidad_identidad"],$actividades_paso[$i]["llave_entidad"]);
	$cantidad_caracter=strlen($responsables["nombre"]);
	if($cantidad_caracter > 150){
		$responsables["nombre"]="<span title='".$responsables["nombre"]."'>".substr($responsables["nombre"],0,150)."...</span>";
	}
  $texto.='<tr><td>'.$actividades_paso[$i]["descripcion"].'</td>
  <td><img src="'.$restrictivo[$actividades_paso[$i]["restrictivo"]].'">-<img src="'.$tipo_paso[$actividades_paso[$i]["tipo"]].'"></td>
  <td>'.$responsables["nombre"].'</td>
  <td>'.acciones_edicion_actividad($actividades_paso[$i]["idpaso_actividad"]).'</td>';
  if($actividades_paso[0]["accion_idaccion"]==1 && $actividades_paso[0]["formato_idformato"]!=''){
  	$texto.= '<td style="text-align:center">
  	<a href="'.$ruta_db_superior.'formatos/generar_formato.php?genera=tabla&idformato='.$actividades_paso[0]["formato_idformato"].'&archivo=workflow-actividades_paso.php?idpaso='.$_REQUEST["idpaso"].'">Generar tabla</a><br>
  	<a href="'.$ruta_db_superior.'formatos/generar_formato.php?crea=adicionar&idformato='.$actividades_paso[0]["formato_idformato"].'&archivo=workflow-actividades_paso.php?idpaso='.$_REQUEST["idpaso"].'">Adicionar</a><br>
  	<a href="'.$ruta_db_superior.'formatos/generar_formato.php?crea=editar&idformato='.$actividades_paso[0]["formato_idformato"].'&archivo=workflow-actividades_paso.php?idpaso='.$_REQUEST["idpaso"].'">Editar</a><br>
  	<a href="'.$ruta_db_superior.'formatos/generar_formato.php?crea=mostrar&idformato='.$actividades_paso[0]["formato_idformato"].'&archivo=workflow-actividades_paso.php?idpaso='.$_REQUEST["idpaso"].'">Mostrar</a><br></td>  	
  	';
  }
  $texto.= '<td><a href="actividad_pasoedit.php?idactividad_paso='.$actividades_paso[$i]["idpaso_actividad"].'&paso_idpaso='.$_REQUEST["idpaso"].'">Editar</a></td><!--td><a href="#" onclick="eliminar_actividad('.$actividades_paso[$i]["idpaso_actividad"].');">Eliminar</a></td--></tr>';
}
if(!$actividades_paso["numcampos"]){
  $texto.='<tr><td colspan="5">Paso Terminado</td></tr>';
}
$texto.='</table>';
echo($texto."<br />");
?>