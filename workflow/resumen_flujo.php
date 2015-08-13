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
include_once($ruta_db_superior."class_documento_informacion.php");
$paso_documento=busca_filtro_tabla("","paso_documento A","A.idpaso_documento=".$_REQUEST["idpaso_documento"],"",$conn);
$pasos_flujo=busca_filtro_tabla("","paso_documento A,documento B","A.documento_iddocumento=B.iddocumento AND diagram_iddiagram_instance=".$paso_documento[0]["diagram_iddiagram_instance"],"GROUP BY iddocumento ORDER BY fecha DESC",$conn);
//print_r($pasos_flujo);
$texto='<b>Documento(s) asociado(s) al flujo</b><br><br><table border="1px" width="90%">';
$texto.='<tr class="encabezado_list"><td>No Radicado</td><td>Fecha</td><td>Descripcion</td><td>Plantilla</td><td>Anexos</td><td>Detalles</td><!--td>Notas</td><td>Paginas</td--></tr>';
for($i=0;$i<$pasos_flujo["numcampos"];$i++){
  $anexos=anexos_documento($pasos_flujo[$i]["documento_iddocumento"],1);
  $listado_anexos=array();
  for($j=0;$j<$anexos["numcampos"];$j++){
    array_push($listado_anexos,'<a href="'.$ruta_db_superior.$anexos[$j]["ruta"].'">'.$anexos[$j]["etiqueta"].'</a>');
  }
  $lanexos=implode("<br />",$listado_anexos);
  //$paginas=paginas_documento($pasos_flujo[$i]["documento_iddocumento"]);
  //$notas=notas_documento($iddocumento,1,1,1);
  $texto.='<tr><td align="center">'.$pasos_flujo[$i]["numero"].'</td><td>'.$pasos_flujo[$i]["fecha"].'</td><td>'.$pasos_flujo[$i]["descripcion"].'</td><td>&nbsp;'.$pasos_flujo[$i]["plantilla"].'</td><td>&nbsp;'.$lanexos.'</td><td><a href="'.$ruta_db_superior.'ordenar.php?key='.$pasos_flujo[$i]["documento_iddocumento"].'&accion=mostrar&mostrar_formato=1" target="centro">Detalles</a></td><!--td>'.$notas.'</td><td>&nbsp;'.$paginas.'</td--></tr>';
}  
$texto.='</table>';
echo($texto);
?>