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

$idft_funcionario=json_decode($_REQUEST['idft_funcionario'],1);
for($i=0;$i<count($idft_funcionario);$i++){
	$separacion_idft_funcionario=explode('|',$idft_funcionario[$i]['value']);
	$datos=busca_filtro_tabla('recepcion','ft_destino_radicacion','idft_destino_radicacion='.$separacion_idft_funcionario[0],'',$conn);
	if($datos[0]['recepcion']==0){
		$sql="UPDATE ft_destino_radicacion SET recepcion='".$separacion_idft_funcionario[1]."', recepcion_fecha=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").", estado_item=3 WHERE idft_destino_radicacion=".$separacion_idft_funcionario[0];
		phpmkr_query($sql);
	}		
}
