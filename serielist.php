<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<frameset cols="40%,*">
     <frame name="arbol" src="arbolserie.php" border="1" marginwidth="10" marginheight="50" height="10%" scrolling="no" noresize>
     <frame name="serielist" src="" marginwidth="10" marginheight="10" >
</frameset>   
