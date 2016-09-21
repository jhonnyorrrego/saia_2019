<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../formacion_academica/funciones.php"); ?><?php include_once("../hoja_vida/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; border-width: 1px; width: 100%;" border="1" align="center">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="3"><span style="font-size: small;"><strong>CONTRATO LABORAL</strong></span></td>
</tr>
<tr>
<td class="encabezado_list" style="width: 25%; text-align: left;"><span style="font-size: small;">N&uacute;mero de Contrato:</span></td>
<td><span style="font-size: small;"><?php mostrar_valor_campo('num_contarto',229,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Tipo de Contrato:</span></td>
<td colspan="1"><span style="font-size: small;"><?php mostrar_valor_campo('tipo_contrato',229,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Fecha de Inicio:</span></td>
<td colspan="1"><span style="font-size: small;"><?php mostrar_valor_campo('fecha_inicio',229,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Fecha de Finalizaci&oacute;n:</span></td>
<td colspan="1"><span style="font-size: small;"><?php mostrar_valor_campo('fecha_final',229,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;">Sueldo inicial</span></td>
<td colspan="1"><span style="font-size: small;">&nbsp;&nbsp;<?php mostrar_valor_campo('sueldo_ini',229,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-size: small;"><span>Documento adjunto:</span></span></td>
<td colspan="1"><span style="font-size: small;">&nbsp;<?php mostrar_anexos_hoja_vida(229,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>