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

$datos=busca_filtro_tabla('','ft_destino_radicacion','idft_destino_radicacion='.$_REQUEST['idft_destino_radicacion'],'',conn);

if($datos[0]['recepcion']==0){
$sql="UPDATE ft_destino_radicacion SET recepcion={$_REQUEST['funcionario']} WHERE idft_destino_radicacion={$_REQUEST['idft_destino_radicacion']}";

phpmkr_query($sql);
}