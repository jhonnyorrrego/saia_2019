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
?>
<frameset cols="40%,*">
<!--table border='1' width='100%'><tr><td-->
     <frame name="arbol_dep" src="arbolcargo.php" border="1" marginwidth="10" marginheight="50" scrolling="no" height="10%" width="100%" ><!--/iframe>
     </td><td-->
     <frame name="cargolist" src="" marginwidth="10" marginheight="10" scrolling="auto" ><!--/iframe></td></tr></table-->
<frameset>   

