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
		$fieldList["nombre"] = $valores[1]; //B
		$fieldList["nombre"] = $valores[2]; //C
		$fieldList["nombre"] = $valores[3]; //D
		$fieldList["nombre"] = $valores[4]; //E
		$fieldList["nombre"] = $valores[5]; //F
		$fieldList["nombre"] = $valores[6]; //G
		$fieldList["nombre"] = $valores[7]; //H
		$fieldList["nombre"] = $valores[8]; //I
		$fieldList["nombre"] = $valores[9]; //J
		$fieldList["nombre"] = $valores[10]; //K
		$fieldList["nombre"] = $valores[11]; //L
		$fieldList["nombre"] = $valores[12]; //M
		$fieldList["nombre"] = $valores[13]; //N
		$fieldList["nombre"] = $valores[15]; //P
		
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
