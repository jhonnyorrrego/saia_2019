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
$documentos = busca_filtro_tabla("idserie, codigo, nombre", "serie", "idserie=".$_POST['productId'], "nombre", $conn);
if($documentos["numcampos"]>0)
  echo $documentos[0]["idserie"]."|||".$documentos[0]["codigo"]."|||".utf8_encode($documentos[0]["nombre"]);  
?>
