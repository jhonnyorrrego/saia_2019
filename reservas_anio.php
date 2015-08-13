<table width="100%" border="1px">
<tr><td colspan=2><?php include_once('header.php'); ?>
</td></tr>
<tr><td colspan=2>
<br><a href="solicitudadd.php?cmd=resetall" >RESERVAR DOCUMENTO</a><br><br>
</td></tr>
<tr><td width="42%" aling="left" style="margin:0px; padding:0px;">
<div align="center" style="overflow:auto; border:1px solid #000000; padding : 4px; width : 450px; height : 300px; ">
<?php
 include_once("calendario/calendario.php");
 if(isset($_REQUEST["anio"]))
   $anio=$_REQUEST["anio"];
 else
   $anio=date("Y");
 calendario_reservas($anio,"reservas_anio.php");
?>     
</div>
<input type="hidden" id="reservados" name="reservados">
</div>
</td>
<td valign="top" >
<div align="center" style="font-weight:bold;">DETALLES RESERVAS DIA</div><br>
<iframe name="mostrar_dia" id="mostrar_dia" width="100%" height="100%"" frameborder="0" scrolling="no" heigth="100%"></iframe>
</td></tr>
</table>
<?php include_once('footer.php'); ?>
