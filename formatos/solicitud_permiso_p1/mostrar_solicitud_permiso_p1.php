<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../carta/../../pantallas/qr/librerias.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center; background-color: #3f91f2;" colspan="4" align="center" valign="middle"><span style="color: #ffffff;"><strong>Solicitud de Permisos Laborales</strong></span><strong></strong></td>
</tr>
<tr>
<td style="text-align: center; background-color: #ffffff;" colspan="4" align="center" valign="middle">&nbsp;</td>
</tr>
<tr>
<td><strong>Fecha de solicitud:</strong></td>
<td><?php mostrar_valor_campo('fecha_solicitud',512,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
<td style="text-align: center;" rowspan="5">&nbsp;<span><?php mostrar_codigo_qr(512,$_REQUEST['iddoc']);?></span><br />
<p><span><strong>Solicitud No. :&nbsp;<span>FO-07 <?php formato_numero(512,$_REQUEST['iddoc']);?></span></strong></span>&nbsp;</p>
</td>
</tr>
<tr>
<td><strong>Nombre de Funcionario:</strong></td>
<td><?php mostrar_valor_campo('funcionario',512,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong><strong>Fecha de Permiso:</strong></strong></td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_permiso',512,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Motivo del Permiso:</strong></td>
<td>&nbsp;<span style="color: #3366ff;"><strong><?php mostrar_valor_campo('tipo_permiso',512,$_REQUEST['iddoc']);?></strong></span></td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="5">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;<strong>Clase de permiso:<br /></strong></td>
<td colspan="3">&nbsp;<?php mostrar_valor_campo('clase_permiso',512,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;<strong>Hora de Llegada:</strong></td>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td>&nbsp;<strong>Porteria de salida:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('salida_porteria',512,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;<strong>Tiempo Real:</strong></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Tiempo Compensado:</strong></td>
<td>&nbsp;</td>
<td>&nbsp;<strong>Compensaci&oacute;n:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('compensacion',512,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="4">&nbsp;<hr /></td>
</tr>
<tr>
<td>&nbsp;<strong>OBSERVACIONES:</strong></td>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" align="center">&nbsp;</td>
<td colspan="3">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" align="center">&nbsp;</td>
<td colspan="3">&nbsp;</td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(512,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>