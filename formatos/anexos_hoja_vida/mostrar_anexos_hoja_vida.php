<?php include_once("../carta/funciones.php"); ?><?php include_once("../solicitud_soporte/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("../seminario_cursos/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td class="encabezado"><span style="font-size: small;">Estructura:</span></td>
<td class="phpmaker"><span style="font-size: small;"><?php mostrar_valor_campo('estructura_hoja_vida',224,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: small;">Fecha Vigencia:</span></td>
<td class="phpmaker"><span style="font-size: small;"><?php mostrar_valor_campo('fecha_vigencia',224,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: small;">Descripci&oacute;n:</span></td>
<td class="phpmaker"><span style="font-size: small;"><?php mostrar_valor_campo('descripcion',224,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: small;">Anexos Digitales:</span></td>
<td class="phpmaker"><span style="font-size: small;"><span style="font-size: small;"><?php mostrar_anexos_hoja_vida(224,$_REQUEST['iddoc']);?></span></span></td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><span style="font-size: small;"><?php listado_anexos_hoja_vida(224,$_REQUEST['iddoc']);?></span><br /><br /><br /></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>