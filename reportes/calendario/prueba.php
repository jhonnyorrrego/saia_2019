<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head><title>Active Calendar Class :: Example</title>
<link rel="stylesheet" type="text/css" href="<?php print @$_GET['css'] ?>" />
<script src="functions.js" type="text/javascript" language="javascript"></script>

</head>
<body>
<center>
<?php require_once("calendario.php"); ?>
<form name="cal" id="cal" action="pruebafecha.php" method="post">
<?php selector_fecha("fecha_ini","cal","d-m-Y H:i",7,2008,"ceramique.css","../","parametros:tarea","VENTANA",TRUE,TRUE); ?>
<input type="text" name="fecha_compra" id="fecha_compra" tipo="fecha" value="0000-00-00"><script src="../../popcalendar.js" type="text/javascript" language="javascript"></script><script src="../../functions.js" type="text/javascript" language="javascript"></script>&nbsp;&nbsp;&nbsp;<a href="javascript:showcalendar('fecha_compra','formulario_formato','Y-m-d','../../calendario/selec_fecha.php?nombre_campo=fecha_compra&amp;nombre_form=formulario_formato&amp;formato=Y-m-d&amp;anio=2008&amp;mes=11&amp;css=default.css&amp;adicionales_tarea=AD:VALOR',220,225)" ><img src="../../calendario/activecalendar/data/img/calendar.gif" border="0" alt="Elija Fecha" /></a>&nbsp;&nbsp;&nbsp; <a href="javascript:showasignatarea('','formulario_formato','Y-m-d','../../asignaciones/asignacionadd.php?popup=1&nom_form=formulario_formato&nom_campo=asig_fecha_compra',500,500)" ><img src="../../calendario/activecalendar/data/img/calendar.gif" border="0" alt="Elija Fecha" /></a><input type="text" name="asig_fecha_compra" id="asig_fecha_compra" value="">
<?php
/*
echo date("Y-m-d", mktime(0, 0, 0, 2, 4, 1996)),"<br>";
echo date("M-d-Y", mktime(0, 0, 0, 3, 4, 1997)),"<br>";
echo date("M-d-Y", mktime(0, 0, 0, 4,1, 99)),"<br>";
echo date("M-d-Y", mktime(0, 0, 0, 5,1, 99)),"<br>"; 

$inicio= "2004-12-24";
$fin= "2005-03-1";

while(strtotime($inicio)<=strtotime($fin)) {
echo $inicio."<br>";
$inicio = date("Y-m-d", strtotime( "$inicio + 1 DAY")) ;
}
*/

?>
</body>
</html>
