<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; border-width: 1px; width: 100%;" border="1" align="center">
<tbody>
<tr>
<td class="encabezado_list" style="width: 25%; text-align: left;"><span style="font-size: small;">Entidad</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('entidad',226,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Nombre</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('nombre',226,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Cargo</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('cargo_desempeniado',226,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Tel&eacute;fono</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('telefono',226,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>