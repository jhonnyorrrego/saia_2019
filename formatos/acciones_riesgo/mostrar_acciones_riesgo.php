<?php include_once("../carta/funciones.php"); ?><?php include_once("../control_riesgos/funciones.php"); ?><?php include_once("../riesgos_proceso/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><span style="font-family: arial, helvetica, sans-serif;"><?php botones_acciones_riesgos(501,$_REQUEST['iddoc']);?></span></p>
<table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Fecha</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php fecha_acciones_riesgo(501,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Control</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_control(501,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Accion</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('acciones_accion',501,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Reponsables</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('reponsables',501,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Indicador</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('indicador',501,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Fecha de Suscripci&oacute;n de la Acci&oacute;n</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?php fecha_subscripcion_accion(501,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Fecha de Cumplimiento</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?php fecha_accion_cumplimiento(501,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Opciones Administraci&oacute;n del Riesgo</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?php mostrar_valor_campo('opcio_admin_riesgo',501,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_estado_proceso(501,$_REQUEST['iddoc']);?></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>