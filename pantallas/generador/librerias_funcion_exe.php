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
function historial_funcion(){
	global $conn;
	$funcion=str_replace(")","",$_REQUEST["funcion"]);    
	$funcion_actual=explode("(",$funcion);    
	$funcion_bd=busca_filtro_tabla("C.idpantalla_funcion_exe, B.nombre","pantalla_libreria A, pantalla_funcion B, pantalla_funcion_exe C","A.idpantalla_libreria=B.fk_idpantalla_libreria AND B.idpantalla_funcion=C.fk_idpantalla_funcion AND A.ruta='".trim($_REQUEST["ruta"])."' AND B.nombre='".$funcion_actual[0]."'", "idpantalla_funcion_exe asc", $conn);
	
	$cadena='';
	if($funcion_bd["numcampos"]-1){
		for($i=0;$i<$funcion_bd["numcampos"]-1;$i++){
			$parametros=busca_filtro_tabla("nombre,valor,tipo","pantalla_func_param D","D.fk_idpantalla_funcion_exe=".$funcion_bd[$i]["idpantalla_funcion_exe"],"idpantalla_func_param",$conn);
			$parameters=array();
			for($j=0;$j<$parametros["numcampos"];$j++){
				$valor="";
				if($parametros[$j]["tipo"]==1){
					$nombre_campo=busca_filtro_tabla("nombre,etiqueta","pantalla_campos a","a.idpantalla_campos=".$parametros[$j]["valor"],"",$conn);
					$valor=$nombre_campo[0]["nombre"];
				}
				if($parametros[$j]["tipo"]==2){
					$valor="'".$parametros[$j]["valor"]."'";
				}
				if($parametros[$j]["tipo"]==3){
					$valor="$"."_REQUEST['".$parametros[$j]["valor"]."']";
				}
				$parameters[]="$".$parametros[$j]["nombre"]."=".$valor;
			}
			
			$cadena.="<div id='historial_".$funcion_bd[$i]["idpantalla_funcion_exe"]."' class='highlight' style='width:100%'>".$funcion_bd[$i]["nombre"]."(".implode(",",$parameters).")<div class='close borrar_historial' idregistro='".$funcion_bd[$i]["idpantalla_funcion_exe"]."'>×</div></div>";
		}
		echo $cadena;
	}
}
function borrar_funcion_historial(){
	global $conn;
	$idregistro=@$_REQUEST["idregistro"];
	$func_param=busca_filtro_tabla("idpantalla_func_param","pantalla_func_param a","fk_idpantalla_funcion_exe=".$idregistro,"",$conn);
	$registros=extrae_campo($func_param,"idpantalla_func_param");
	
	$sql1="delete from pantalla_funcion_exe where idpantalla_funcion_exe=".$idregistro;
	phpmkr_query($sql1);
	
	$sql2="delete from pantalla_func_param where idpantalla_func_param in(".implode(",",$registros).")";
	phpmkr_query($sql2);
	echo "1";
}
if(@$_REQUEST["llamado_funcion"])$_REQUEST["llamado_funcion"]();
?>