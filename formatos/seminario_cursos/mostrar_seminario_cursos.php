<?php include_once("../carta/funciones.php"); ?><?php include_once("../solicitud_soporte/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; border-width: 1px;" border="1" align="center">
<tbody>
<tr>
<td class="encabezado" style="text-align: center;" colspan="2"><span style="font-size: small;"><strong>SEMINARIOS Y CURSOS</strong></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Tipo:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('tipo_seminario',222,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>T&iacute;tulo Obtenido:</strong></span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('titulo_seminario',222,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><span style="font-size: small;"><strong>Anexos:</strong></span></td>
<td><span style="font-size: small;"><?php mostrar_anexos_hoja_vida(222,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>