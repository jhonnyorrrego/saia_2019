<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
$max_destinos=busca_filtro_tabla("valor","configuracion","nombre='max_transferencias'","",$conn);
$cant=contar_destinos(@$_REQUEST["destino"]);

if($cant>$max_destinos[0]["valor"]){
	echo 1;
}
else{
	echo 2;
}

function contar_destinos($destinos){
 global $conn;
 $destinos=explode(",",$destinos);
 $cantidad=0;
 foreach($destinos as $fila){ 
     if(strpos($fila,'#')>0){
     	$dep=busca_filtro_tabla("","dependencia","iddependencia=".str_replace("#","",$fila),"",$conn);
		 
     	if($dep[0]["cod_padre"]==0||$dep[0]["cod_padre"]==''||!$dep[0]["cod_padre"]){
     		return 10000000;
     	}
     	$roles = busca_filtro_tabla("distinct funcionario_idfuncionario","dependencia_cargo","dependencia_iddependencia=".str_replace("#","",$fila),"",$conn);
		$cantidad+=$roles["numcampos"];
      }
     else{
     	$cantidad+=1;
      }
    }
return $cantidad;
}

?>