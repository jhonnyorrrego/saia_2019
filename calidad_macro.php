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
     <frame name="izquierda" src="formatos/arboles/arbolcalidad_macro.php<?php echo("?edita=".@$_REQUEST["edita"]); echo("&from_modulo_calidadedita=".@$_REQUEST["from_modulo_calidad"]);  ?>" border="1" marginwidth="0" noresize scrolling="no" >
     <frame name="detalles" src="" marginwidth="10" marginheight="10" scrolling="auto" >
</frameset>  
