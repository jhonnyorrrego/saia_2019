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
global $conn;
 $archivo="prueba_carga.csv";
 $gestor = fopen($archivo, "rb");
 if($gestor)
    $contenido = fread($gestor, filesize($archivo));
 else
 {
    alerta("No Se Realizo la Actualizacion de Datos de Intranet por el archivo");
    return(false);
 }
 fclose($gestor);
 $records = explode("\n",$contenido);
 for($i=6;$i<count($records);$i++){
	$valores=explode(',',$records[$i]);
	if( $valores[2]!='' && $valores[4]!=''){  // C - E
		$entidad=$valores[14]; // O

		$fieldList=array();//cols
		$fieldList["codigo"] = $valores[1]; //B
		$fieldList["nombre"] = $valores[2]; //C
		$fieldList["categoria"] = $valores[3]; //D
		$fieldList["tipo"] = $valores[4]; //E
		$fieldList["cod_padre"] = $valores[5]; //F
		$fieldList["dias_entrega"] = $valores[6]; //G
		$fieldList["retencion_gestion"] = $valores[7]; //H
		$fieldList["retencion_central"] = $valores[8]; //I
		$fieldList["conservacion"] = $valores[9]; //J
		$fieldList["seleccion"] = $valores[10]; //K
		$fieldList["digitalizacion"] = $valores[11]; //L
		$fieldList["procedimiento"] = $valores[12]; //M
		$fieldList["copia"] = $valores[13]; //N
		$fieldList["estado"] = $valores[15]; //P
		
		$tabla="";
		$strsql = "INSERT INTO ".$tabla." (";
		$strsql .= implode(",", array_keys($fieldList));			
		$strsql .= ") VALUES ('";			
		$strsql .= implode("','", array_values($fieldList));			
		$strsql .= "')";
        phpmkr_query($strsql);


		print_r($strsql);
		
		
		
		
	}
 }
 
 die();
      
?> 
