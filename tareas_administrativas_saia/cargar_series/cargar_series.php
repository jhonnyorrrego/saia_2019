<?php
include_once("db.php");
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

		
		print_r($strsql);
		
	}
 }
 
 
 die();
 
 for($i=0; $i<count($records)-1; $i++)
 {
    $fila = explode(";",str_replace('"','',strtolower(utf8_encode($records[$i]))));
    for($ind=0; $ind<count($fila);$ind++)
      if($fila[$ind]=="\\N")
        $fila[$ind] = "";

  $conservacion=1;
  $digitalizacion=1;
  $seleccion=1;
  if($fila[6]=="")
    $conservacion=0; 
  if($fila[8]=="")
    $digitalizacion=0;
  if($fila[7]=="")
    $seleccion=0;     
  $sql="insert into serie(nombre,dias_entrega,codigo,retencion_gestion,retencion_central,conservacion,digitalizacion,seleccion,procedimiento) values('".strtolower($fila[3])."','15','".$fila[0]."','".$fila[4]."','".$fila[5]."','$conservacion','$digitalizacion','$seleccion','".$fila[10]."')";
  echo($sql.'<br><br><br>');
 }       
?> 
