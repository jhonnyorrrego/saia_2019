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

if($_REQUEST['formato']){
	$formato=busca_filtro_tabla("*","formato","nombre like'".$_REQUEST['formato']."'","",$conn);
	if($formato['numcampos']){
		echo(1);
	}else{
		echo(0);
	}
}elseif($_REQUEST['campo']){
	$campo=busca_filtro_tabla("*","campos_formato","nombre like'".$_REQUEST['campo']."' AND formato_idformato=".$_REQUEST['idformato'],"",$conn);
	
	if($campo['numcampos']){
		echo(1);
	}else{
		echo(0);
	}
}
?>
