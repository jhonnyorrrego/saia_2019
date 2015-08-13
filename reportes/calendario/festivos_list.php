<?php

  header("Cache-Control: post-check=0, pre-check=0", false); 
  header("Pragma: no-cache"); // HTTP/1.0  
  ?>
<html>
<head><title>Active Calendar Class :: Example</title>
<link rel="stylesheet" type="text/css" href="<?php print @$_GET['css'] ?>" />
<script src="functions.js" type="text/javascript" language="javascript"></script>
</head>
<body>
<h4>Calendario de la Organizaci&oacute;n<h4>

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

</body>
</html>
