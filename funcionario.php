<?php
//include_once("header.php");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
//include_once("db.php");
$key=@$_REQUEST["key"];
?>
<frameset cols="450,*" >
     <frame name="detalle_fun" id="detalle_fun" src="funcionario_detalles.php?key=<?php echo($key);?>" marginwidth="0" marginheight="0" scrolling="no" >
     <frame name="detalles" src="" border="0" marginwidth="0" marginheight="10" scrolling="auto" noresize>
</frameset>
