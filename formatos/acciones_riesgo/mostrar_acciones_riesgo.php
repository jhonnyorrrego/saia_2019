<?php include_once("../carta/funciones.php"); ?><?php include_once("../riesgos_proceso/../riesgos_proceso/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><?php botones_acciones_riesgos(395,$_REQUEST['iddoc']);?></p>
<table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="encabezado">Fecha</td>
<td><?php fecha_acciones_riesgo(395,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Control</td>
<td><?php mostrar_valor_control(395,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Accion</td>
<td><?php mostrar_valor_campo('acciones_accion',395,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Reponsables</td>
<td><?php mostrar_valor_campo('reponsables',395,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Indicador</td>
<td><?php mostrar_valor_campo('indicador',395,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado"><span><span>Fecha de Suscripci&oacute;n de la Acci&oacute;n</span></span></td>
<td>&nbsp;<?php fecha_subscripcion_accion(395,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado"><span>Fecha de Cumplimiento</span></td>
<td>&nbsp;<?php fecha_accion_cumplimiento(395,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado"><span><span>Opciones Administraci&oacute;n del Riesgo</span></span></td>
<td>&nbsp;<?php mostrar_valor_campo('opcio_admin_riesgo',395,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(395,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>