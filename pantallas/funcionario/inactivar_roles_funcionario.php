<?php
@set_time_limit(0);
if(!@$_SESSION["LOGIN"]){
@session_start();
$_SESSION["LOGIN"]="cerok";
$_SESSION["usuario_actual"]="1"; 
}
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
global $conn;

	$fecha_actual=date("Y-m-d");
	$roles=busca_filtro_tabla("b.funcionario_idfuncionario,b.iddependencia_cargo","funcionario a,dependencia_cargo b",fecha_db_obtener("b.fecha_final","Y-m-d")."<'".$fecha_actual."' and a.idfuncionario=b.funcionario_idfuncionario and b.estado=1 group by funcionario_idfuncionario,iddependencia_cargo","",$conn);
	
	for ($i=0; $i <$roles["numcampos"] ; $i++) { 
		$sql="update dependencia_cargo set estado=0 where ".fecha_db_obtener("fecha_final","Y-m-d")."<'".$fecha_actual."' and estado=1 and iddependencia_cargo=".$roles[$i]["iddependencia_cargo"];
		phpmkr_query($sql);
	}
	for ($i=0; $i <$roles["numcampos"] ; $i++) { 		
		$funcionario=busca_filtro_tabla("a.idfuncionario,b.fecha_final","funcionario a, dependencia_cargo b","a.idfuncionario=b.funcionario_idfuncionario AND a.idfuncionario=".$roles[$i]["funcionario_idfuncionario"]." and ".fecha_db_obtener("b.fecha_final","Y-m-d").">='".$fecha_actual."' and b.estado=1","",$conn);

		if(!$funcionario["numcampos"]){
			$sql1="update funcionario set estado=0 where idfuncionario=".$roles[$i]["funcionario_idfuncionario"];
			phpmkr_query($sql1);
			
		}
	}
?>