<?php session_start(); ?>
<?php ob_start(); ?>
<?php
//include_once("header.php");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
//include("header.php");
$doc=0;
if($_REQUEST["iddoc"]){
  $doc=$_REQUEST["iddoc"];
}
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
	include_once("formatos/librerias/menu_principal_documento.php");
	echo(menu_principal_documento($_REQUEST["iddoc"],@$_REQUEST["vista"]));
}


?>
<frameset cols="30%,*">
     <frame name="arbol_expediente" id="arbol_expediente" src="arbolexpediente.php<?php echo("?iddoc=".$doc);?>" border="1" marginwidth="10" marginheight="50" scrolling="no" height="10%" width="100%" >
     <frame name="expedientelist" src="" marginwidth="10" marginheight="10" scrolling="auto" >
<frameset>
