<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 25%; text-align: center;"><?php mostrar_logo_empresa(260,$_REQUEST['iddoc']);?></td>
<td style="font-weight: bold; text-align: center; width: 50%; font-size: 8pt;">CONFIRMACI&Oacute;N DE NEGOCIACI&Oacute;N<br />DE VEH&Iacute;CULOS</td>
<td style="font-weight: bold; text-align: center; font-size: 12pt;">No.</td>
</tr>
<tr>
<td style="font-size: 8pt;">TALLER - CONCESIONARIO<br />REPUESTOS<br />NIT: 810000882-8</td>
<td style="font-size: 8pt;">FECHA:<br /> <?php mostrar_fecha(260,$_REQUEST['iddoc']);?></td>
<td style="text-align: center; font-size: 8pt;">&nbsp;<?php formato_numero(260,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; ; width: 100%;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;">DATOS DEL CLIENTE</td>
</tr>
<tr>
<td><?php mostrar_datos_cliente_confirma(260,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: center;">SE SOLICITA FACTURAR A:</td>
</tr>
<tr>
<td><?php mostrar_solicitud_confirma(260,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: center;">DATOS DEL VEH&Iacute;CULO</td>
</tr>
<tr>
<td><?php mostrar_datos_vehiculo_confirma(260,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: center;">FORMA DE PAGO</td>
</tr>
<tr>
<td><?php mostrar_forma_pago(260,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php mostrar_texto_condiciones(260,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>