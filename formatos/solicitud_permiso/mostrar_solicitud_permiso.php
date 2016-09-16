<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center;">
<table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="width: 25%; background-color: #d3d3d3; text-align: left;"><strong>FECHA SOLICITUD</strong></td>
<td style="width: 75%; text-align: left;"><?php mostrar_valor_campo('fecha_radiccion_permiso',215,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="background-color: #d3d3d3; text-align: left;"><strong>NOMBRE EMPLEADO</strong></td>
<td style="text-align: left;"><?php nombre_empleado(215,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #d3d3d3; text-align: left;"><strong>C.C</strong></td>
<td style="text-align: left;"><?php muestra_documento(215,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #d3d3d3; text-align: left;"><strong><strong>CARGO</strong></strong></td>
<td style="text-align: left;"><?php nombre_cargo(215,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #d3d3d3; text-align: left;"><strong>FECHA CITA</strong></td>
<td style="text-align: left;"><?php mostrar_valor_campo('fecha_hora_cita',215,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #d3d3d3; text-align: left;"><strong>HORA CITA</strong></td>
<td style="text-align: left;"><?php mostrar_valor_campo('hora_entrada',215,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="background-color: #d3d3d3; text-align: left;"><strong>HORA SALIDA</strong></td>
<td style="text-align: left;"><?php mostrar_valor_campo('hora_salida',215,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #d3d3d3; text-align: left;"><strong>HORA ENTRADA</strong></td>
<td style="text-align: left;"><?php mostrar_valor_campo('hora_entrada',215,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td><br /><br /><br /><br /></td>
</tr>
<tr>
<td style="text-align: left;"><strong>MOTIVO DEL PERMISO<br /><br /><br /></strong></td>
</tr>
<tr>
<td><?php motivo(215,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><?php mostrar_estado_proceso(215,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>