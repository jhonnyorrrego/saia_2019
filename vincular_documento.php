<?php
include_once("db.php");
$documentos=explode(",",@$_REQUEST["docs"]);
$funcionario =usuario_actual("idfuncionario");
$cantidad=count($documentos);
for($i=0;$i<$cantidad;$i++){
	for($j=0;$j<$cantidad;$j++){
		if($documentos[$i]!=$documentos[$j]){
			$origen=$documentos[$i];
			$destino=$documentos[$j];
			$sql2="insert into documento_vinculados(documento_origen,documento_destino,fecha,funcionario_idfuncionario) values('".$origen."','".$destino."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$funcionario.")";
		    phpmkr_query($sql2);
		}
	}
}
?>