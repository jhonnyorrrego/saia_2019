<?php include_once("../carta/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" valign="top"><strong>Datos Hallazgo</strong></td>
</tr>
<tr>
<td style="text-align: center;"><?php detalles_padre(430,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" style="width: 20%;" valign="top">Fecha</td>
<td class="celda_transparente" style="width: 80%;" valign="top"><?php mostrar_fecha_seguimiento_plan_mejoramiento(430,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Porcentaje de Avance</td>
<td class="celda_transparente" valign="top"><?php mostrar_valor_campo('porcentaje',430,$_REQUEST['iddoc']);?> %</td>
</tr>
<tr>
<td class="encabezado" valign="top">Logros alcanzados</td>
<td class="celda_transparente" valign="top"><?php mostrar_valor_campo('logros_alcanzados',430,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Observaciones</td>
<td class="celda_transparente" valign="top"><?php mostrar_valor_campo('observaciones',430,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Evidencia documental Adjunta</td>
<td><?php mostrar_anexos_seguimientop(430,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(430,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>