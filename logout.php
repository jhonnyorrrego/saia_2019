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
else $cadena="index.php?fin=1&INDEX=actualizacion";
cerrar_sesion();
@session_unset();
@session_destroy();
?>
<script type="text/javascript">
  if(typeof(top.ruta_index)=='undefined')
   top.ruta_index="<?php echo($cadena);?>";  
  window.open(top.ruta_index,"_top");
    
</script>
<?php
exit;

?>
