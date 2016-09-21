<?php include_once("../carta/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="height: 100%; ; width: 100%;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;"><strong>Fecha de solicitud:</strong>&nbsp;</td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_solicitud',325,$_REQUEST['iddoc']);?></td>
<td><strong>Solicitante:&nbsp;</strong></td>
<td><?php mostrar_valor_campo('solicitante',325,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
<tr>
<td style="text-align: left;">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;"><strong>Descripci&oacute;n:</strong>&nbsp;</td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion_salida',325,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;"><strong>Fecha de salida:</strong>&nbsp;</td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_salida',325,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="4"><?php mostrar_valor_campo('adicionar_item',325,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;">&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<table cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="td1" valign="middle">
<p class="p1"><span class="s1"><?php mostrar_estado_proceso(325,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
</tbody>
</table>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>