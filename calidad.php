<?php
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  @session_name();
  @session_start();
  @ob_start();
}
date_default_timezone_set ("America/Bogota");
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  $_SESSION["LOGIN".LLAVE_SAIA]=$_REQUEST['sesion'];
}
?>
<frameset cols="27%,*">
     <frame name="izquierda" src="formatos/arboles/arbolcalidad.php<?php echo("?edita=".@$_REQUEST["edita"]); ?>" border="1" marginwidth="0" marginheight="10" scrolling="no">
     <frame name="detalles" src="" marginwidth="10" marginheight="10" scrolling="auto" >
<frameset>  
