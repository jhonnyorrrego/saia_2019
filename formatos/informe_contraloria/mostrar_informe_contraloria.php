<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 93%;">
<table style="width: 100%; border-collapse: collapse;" border="2">
<tbody>
<tr>
<td>
<table style="border-collapse: collapse; width: 100% !important;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;"><?php logo_secretaria(431,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</td>
<td style="text-align: center;">
<table style="; width: 100%;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;">
<p>&nbsp;</p>
<p><strong>INFORME DE SEGUIMIENTO AL PLAN DE MEJORAMIENTO</strong></p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
<td style="width: 5%;">&nbsp;</td>
</tr>
</tbody>
</table>
<p style="text-align: left;">&nbsp;<?php link_agregar_campos(431,$_REQUEST['iddoc']);?></p>
<table>
<tbody>
<tr>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 93%;">
<table style="border-collapse: collapse; width: 100%; attr-margin-left: 200; attr-margin-top: 5; table-width-pdf: 1176px !important;" border="2" cellpadding="5">
<tbody>
<tr>
<td class="encabezado" style="width: 30%;"><span style="font-size: large;"><span>NUMERO DE PLAN</span></span></td>
<td style="width: 70%;"><span style="font-size: large;"><?php radicado_plan(431,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado" style="width: 30%;"><span style="font-size: large;"><span><span>PROCESO AUDITADO</span></span></span></td>
<td style="width: 70%;"><span style="font-size: large;"><span><?php mostrar_valor_campo('proceso_auditado',431,$_REQUEST['iddoc']);?></span></span></td>
</tr>
<tr>
<td class="encabezado" style="width: 30%;"><span style="font-size: large;">NOMBRE DE LA ENTIDAD QUE SUSCRIBIO EL PLAN</span></td>
<td style="width: 70%;"><span style="font-size: large;">GOBERNACION DE RISARALDA</span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: large;">NOMBRE DEL REPRESENTANTE LEGAL</span></td>
<td><span style="font-size: large;"><?php representante_legal(431,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: large;">NOMBRE DEL JEFE DE CONTROL INTERNO</span></td>
<td><span style="font-size: large;"><?php mostrar_valor_campo('jefe_control',431,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: large;">FECHA SUSCRIPCION DEL PLAN DE MEJORAMIENTO</span></td>
<td><span style="font-size: large;"><?php suscripcion_plan(431,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: large;">FECHA DE SEGUIMIENTO A COMPROMISOS</span></td>
<td><span style="font-size: large;"><?php mostrar_valor_campo('fecha_compromisos',431,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: large;"><strong>RESULTADOS DE SEGUIMIENTO Y CONTROL</strong>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: large;">CUMPLIMIENTO DEL OBJETIVO GENERAL DEL PLAN</span></td>
<td><span style="font-size: large;"><?php mostrar_valor_campo('cumplimiento_general',431,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: large;">CUMPLIMIENTO DE LOS OBJETIVOS ESPECIFICOS</span></td>
<td><span style="font-size: large;"><?php mostrar_valor_campo('cumplimiento_especificos',431,$_REQUEST['iddoc']);?><?php codificacion_especifica(431,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado" style="width: 30%;"><span style="font-size: large;">PORCENTAJE DE CUMPLIMIENTO DEL PLAN</span></td>
<td style="width: 70%;"><span style="font-size: large;"><?php mostrar_valor_campo('cumplimiento_plan',431,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-size: large;">CONCLUSIONES</span></td>
<td><span style="font-size: large;"><?php mostrar_valor_campo('conclusiones',431,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
</tbody>
</table>
</td>
<td style="width: 5%;">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php mostrar_plan_mejoramiento_completo(431,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>