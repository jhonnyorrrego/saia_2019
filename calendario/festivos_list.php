<?php
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache"); // HTTP/1.0  
  
  ?><?php include_once("../header.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php print @$_GET['css'] ?>" />
<script src="functions.js" type="text/javascript" language="javascript"></script>
<table width=100% height=100% border=0>
<tr><td width=10%>
<img src="../botones/configuracion/calendario.png">
</td><td><b>CALENDARIO DE LA ORGANIZACI&Oacute;N</b>
</td></tr><tr><td colspan="2" align=center>
<?php
require_once("calendario.php");

if(isset($_REQUEST['anio']))
  $anio = $_REQUEST['anio'];
else 
  $anio = date("Y"); 
   
//selector_fecha("fecha","us",7,2008,1,NULL,NULL,"antique.css","../");
//echo dias_habiles(22);
calendario_festivos($anio,"festivos_func.php?func=1"); // Se envia el parametro para la adicion de dias
?>
</td></tr></table>
<?php include_once("../footer.php"); ?>