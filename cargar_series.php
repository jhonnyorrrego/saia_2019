<?php
include_once("db.php");
global $conn;
 $archivo="series.csv";
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
 for($i=0; $i<count($records)-1; $i++)
 {
    $fila = explode(";",str_replace('"','',strtolower(codifica_encabezado($records[$i]))));
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
  phpmkr_query($sql,$conn);
 }       
?> 
