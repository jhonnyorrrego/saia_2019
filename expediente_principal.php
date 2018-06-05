<?php
$doc = 0;
if ($_REQUEST["iddoc"]) {
	$doc = $_REQUEST["iddoc"];
}
if (@$_REQUEST["iddoc"] || @$_REQUEST["key"]) {
	include_once ("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento($_REQUEST["iddoc"], @$_REQUEST["vista"]));
}
?>
<frameset cols="30%,*">
	<frame name="arbol_expediente" id="arbol_expediente" src="arbolexpediente.php<?php echo("?iddoc=" . $doc); ?>" border="1" marginwidth="10" marginheight="50" scrolling="no" height="10%" width="100%" >
	<frame name="expedientelist" src="" marginwidth="10" marginheight="10" scrolling="auto" >
	<frameset>
