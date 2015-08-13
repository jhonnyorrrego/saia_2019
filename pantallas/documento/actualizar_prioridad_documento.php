<?php
$ruta_file=dirname(__FILE__);
include_once($ruta_file."/../../db.php");
$funcionario=usuario_actual("idfuncionario");
$buscar=busca_filtro_tabla("","prioridad_documento","documento_iddocumento=".$_REQUEST["iddocumento"]." AND funcionario_idfuncionario=".$funcionario,"",$conn);
if($buscar["numcampos"]){
	$sql2="UPDATE prioridad_documento SET prioridad='".$_REQUEST["prioridad"]."', fecha_asignacion=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE documento_iddocumento=".$_REQUEST["iddocumento"]." AND funcionario_idfuncionario=".$funcionario;
}
else{
$sql2="INSERT INTO prioridad_documento(documento_iddocumento,funcionario_idfuncionario,fecha_asignacion,prioridad) VALUES(".$_REQUEST["iddocumento"].",".$funcionario.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$_REQUEST["prioridad"].")";
}
if(phpmkr_query($sql2)){
  echo(1);
}  
?>