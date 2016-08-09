<?php include_once("funciones_1.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../memorando/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" cellspacing="0" width="100%">

<tr>
<td class="encabezado" width="30%" valign="top">FECHA:</td>
<td style="windowtext 0.5pt solid; "><?php mostrar_valor_campo('fecha_seguimiento',14,$_REQUEST['iddoc']);?> <?php notificar_seguimiento_riesgo(14,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">RESPONSABLE:</td>
<td style="windowtext 0.5pt solid; "><?php datos_usuario_documento(14,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">LOGRO:</td>
<td style="windowtext 0.5pt solid; "><?php mostrar_valor_campo('logro',14,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2" valign="top">LOS CONTROLES FRENTE AL RIESGO:</td>
</tr>
<tr>
<td colspan="2" valign="top">&iquest;SE ESTAN APLICANDO EN LA ACTUALIDAD?:&nbsp; <?php mostrar_valor_campo('aplican',14,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2" valign="top">&iquest;SON EFECTIVOS PARA MINIMIZAR EL RIESGO?:&nbsp; <?php mostrar_valor_campo('minimiza',14,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2" valign="top">&iquest;EST&Aacute;N DOCUMENTADOS?:&nbsp; <?php mostrar_valor_campo('documentados',14,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center;" colspan="2" valign="top"><strong>VALORACION DEL RIESGO:<br /></strong>"La valoracion del riesgo es el produto de confrontar los resultados de la evaluaci&oacute;n del riesgo con los controles identificados en el elemento de control"</td>
</tr>
<tr>
<td colspan="2" valign="top">EL IMPACTO: <?php mostrar_valor_campo('impacto',14,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2" valign="top">LA PROBABILIDAD: <?php mostrar_valor_campo('probabilidad',14,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center;" colspan="2" valign="top"><strong>OBSERVACIONES:</strong> <br />(limitantes en el cumplimiento de la acci&oacute;n, dificultades)</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_valor_campo('observaciones',14,$_REQUEST['iddoc']);?></td>
</tr>

</table>
<p><?php mostrar_valor_campo('evidencia_documental',14,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>