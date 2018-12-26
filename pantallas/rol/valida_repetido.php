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
/*Se encarga de validar que no exista cargos (codigo cargo y/o nombre del cargo) o dependencias repetidas en el momento de adicionar, este script se llama mediante ajax en dependenciaadd.php y cargoaadd.php*/
$error=0;
if($_REQUEST['cargo']==1){//es cargo
	if(isset($_REQUEST['campo']) && isset($_REQUEST['valor'])){
		$cargo=busca_filtro_tabla("idcargo","cargo","lower(".$_REQUEST['campo'].") like lower('".$_REQUEST['valor']."')","",$conn);
		if($cargo['numcampos']){
			$error=1;
		}
	}
}elseif($_REQUEST['cargo']==0){//es dependencia
	$dependencia=busca_filtro_tabla("iddependencia","dependencia","lower(nombre) like lower('".$_REQUEST['nombre']."')","",$conn);
	if($dependencia['numcampos']){
		$error=1;
	}
}
echo($error);
?>
