<?php
include_once("db.php");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$cadena=''; 
if(@$_SESSION["INDEX"]!=''){
  $cadena="index.php?fin=1&INDEX=".$_SESSION["INDEX"];
}
else if($_REQUEST["INDEX"]){  
  $cadena="index.php?fin=1&INDEX=".$_REQUEST["INDEX"];
}
else{
	 $cadena="index.php?fin=1&INDEX=actualizacion";
}


if(@$_REQUEST['texto_salir']){
	$cadena.="&texto_salir=".urlencode(@$_REQUEST['texto_salir'])."";	
}

?>

<form action="index.php" method="POST" id="form_salir">
	<input type="hidden" name="fin" value="1">
<?php	
if(@$_SESSION["INDEX"]!=''){
	echo('<input type="hidden" name="INDEX" value="'.$_SESSION["INDEX"].'">');
}
else if($_REQUEST["INDEX"]){
	echo('<input type="hidden" name="INDEX" value="'.$_REQUEST["INDEX"].'">');  
}
else{
	echo('<input type="hidden" name="INDEX" value="actualizacion">');  
}

if(@$_REQUEST['texto_salir']){
	echo('<input type="hidden" name="texto_salir" value="'.@$_REQUEST['texto_salir'].'">');  
}
?>	
</form>
<?php


cerrar_sesion();
@session_unset();
@session_destroy();
?>
<!-- script type="text/javascript">
  if(typeof(top.ruta_index)=='undefined')
   top.ruta_index="<?php echo($cadena);?>";  
  window.open(top.ruta_index,"_top");
    
</script -->
<script>
	document.getElementById('form_salir').submit();
</script>
<?php
//exit;

?>
