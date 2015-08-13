<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("../hoja_vida/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; border-width: 1px; width: 90%;" border="1" align="center">
<tbody>
<tr>
<td class="encabezado" style="text-align: center;"><span style="font-size: small;">Nombre</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('nombre',228,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center;"><span style="font-size: small;">Tel&eacute;fono</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('telefono',228,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center;"><span style="font-size: small;">Ocupaci&oacute;n</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('ocupacion',228,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>