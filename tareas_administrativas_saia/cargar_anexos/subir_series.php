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

$obj='series2.csv';
$archivo = fopen('cargar_anexos/files/'.$obj,'r');
$a=1;
while($linea = fgetcsv($archivo,0,",")){
	if($_REQUEST["insertar"]==1){
		$sql1="insert into serie (nombre, codigo, retencion_gestion, retencion_central, conservacion, digitalizacion, estado, categoria) values ('".$linea[0]."', '".$linea[3]."', '".$linea[4]."', '".$linea[5]."', '".$linea[6]."', '".$linea[7]."', '1', '2')";
		echo $sql1."<br>";
		phpmkr_query($sql1);
	}
	else if($_REQUEST["insertar"]==2){
		if($linea[2]!=''){
			$buscar=busca_filtro_tabla("","serie","codigo='".$linea[2]."'","",$conn);
			if($buscar["numcampos"]){
				$sql1="update serie set cod_padre='".$buscar[0]["idserie"]."' where codigo='".$linea[3]."'";
				phpmkr_query($sql1);
				echo $sql1."<br><br>";
			}
		}
	}
	else if($_REQUEST["insertar"]==3){
		if($linea[1]!=''){
			$buscar=busca_filtro_tabla("","dependencia","lower(nombre)='".strtolower($linea[1])."'","",$conn);
			$serie=busca_filtro_tabla("","serie","codigo='".$linea[3]."'","",$conn);
			if($buscar["numcampos"]){
				$sql1="insert into entidad_serie(entidad_identidad, serie_idserie, llave_entidad, estado, tipo) values('2', '".$serie[0]["idserie"]."', '".$buscar[0]["iddependencia"]."', '1', '0')";
				phpmkr_query($sql1);
				echo $sql1."<br><br>";
			}
		}
	}
}
?>