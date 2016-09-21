<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../formacion_academica/funciones.php"); ?><?php include_once("../hoja_vida/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>EXPERIENCIA LABORAL (Empleos o contratos anteriores, inicie por el &uacute;ltimo)</strong></span></td>
</tr>
<tr>
<td style="width: 35%;"><span style="font-size: small;"><strong>Nombre de la empresa:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('nombre_empresa',223,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Direcci&oacute;n:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('direccion',223,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Tel&eacute;fono:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('telefonos',223,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Nombre de su Jefe inmediato:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('jefe_inmediato',223,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Cargo(s) Desempe&ntilde;ado(s):</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('cargo_realizado',223,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Funciones Realizadas:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('funciones_realizadas',223,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Fecha de Ingreso:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('fecha_ingreso',223,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Fecha de Retiro:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('fecha_retiro',223,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Documento Adjunto:</strong></span></td>
<td><span class="mceSelected"><?php mostrar_anexos_hoja_vida(223,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>