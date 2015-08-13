<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("../solicid_matenimiento/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="; width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 15%;"><span style="font-size: small;">Fecha solicitud</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('fecha_soporte',233,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Descripci&oacute;n</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('descripcion',233,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Prioridad</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('prioridad',233,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Responsable</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('responsable',233,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Categor&iacute;a</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('categoria',233,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Activo</span></td>
<td><?php mostrar_valor_campo('activos',233,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><span style="font-size: small;"><?php mostrar_estado_proceso(233,$_REQUEST['iddoc']);?></span></td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>