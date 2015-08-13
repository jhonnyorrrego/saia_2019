<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0" width="100%">
<tbody>
<tr>
<td><strong>Empresa y/o proveedor</strong></td>
<td><?php empresa_nombre(85,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Entrega cotizaci&oacute;n</strong></td>
<td><?php mostrar_valor_campo('entrega_cotizacion',85,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>