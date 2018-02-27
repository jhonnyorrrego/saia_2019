<?php
if(!isset($_SESSION["LOGIN"])){
  @session_name();
  @session_start();
  @ob_start();
}
date_default_timezone_set ("America/Bogota");
if(!isset($_SESSION['LOGIN'])){
  $_SESSION["LOGIN"]=$_REQUEST['sesion'];
}
?>
<frameset cols="350px,*" >
     <frame name="izquierda" src="../arboles/arbolriesgos2.php<?php echo("?edita=".@$_REQUEST["edita"]); ?>" border="1" marginwidth="0" noresize scrolling="no" >
     <frame name="detalles" src="detalles_descripcion_riesgos_proceso.php?riesgos=2" marginwidth="10" marginheight="10" scrolling="auto" >
</frameset>