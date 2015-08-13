<?php

/* 	Input to this file $_POST['productId'] 

This file outputs a string in this format

productId|||productDescription|||price,

i.e. ID of product followed by 3 pipes followed by a description of the product followed by 3 pipes followed by the price

*/

/* This is code only for the demo - You would most likely use a database for this */

include_once("../db.php");

if(!isset($_POST['productId']))
  exit;	/* No product id sent as input to this file */
 
global $conn;
$documentos = busca_filtro_tabla("iddocumento, numero, descripcion, fecha", "documento", "iddocumento=".$_POST['productId'], "numero", $conn);
if($documentos["numcampos"]>0)
  {echo $documentos[0]["iddocumento"]."|||".$documentos[0]["descripcion"]."|||".$documentos[0]["numero"]."|||".substr($documentos[0]["fecha"],0,10)."|||<a href='ordenar.php?accion=mostrar&key=".$documentos[0]["iddocumento"]."&tipo_destino=1'>ver</a>";  
  }
?>
