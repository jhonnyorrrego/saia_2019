<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../acta_adjudicacion/../solicitud_compra/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 40%;"><span style="font-size: small;">Evaluaci&oacute;n T&eacute;cnica</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('evaluacion_tecnica',402,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Evaluaci&oacute;n ecoc&oacute;mica&nbsp;</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('evaluacion_economica',402,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Anexar evaluaci&oacute;n t&eacute;cnica</span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('anexo_tecnica',402,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Anexar evaluaci&oacute;n econ&oacute;mica&nbsp;</span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('anexo_economica',402,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Acta de evaluaci&oacute;n</span></td>
<td><span style="font-size: small;">&nbsp;<?php mostrar_valor_campo('anexar_acta',402,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Proponentes recomendados</span></td>
<td><span style="font-size: small;"><?php mostrar_proponente_recomendado(402,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Proponentes que no cumplen</span></td>
<td><span style="font-size: small;"><?php mostrar_proponentes(402,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><span style="font-size: small;"><span><?php mostrar_anexos_compra_bienes(402,$_REQUEST['iddoc']);?></span></span></p>
<p><span style="font-size: small;"><?php mostrar_estado_proceso(402,$_REQUEST['iddoc']);?></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>