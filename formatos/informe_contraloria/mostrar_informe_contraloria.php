<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 93%;">
<table style="width: 100%; border-collapse: collapse;" border="2">
<tbody>
<tr>
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
<p style="text-align: left;">&nbsp;<?php link_agregar_campos(483,$_REQUEST['iddoc']);?></p>
<table>
<tbody>
<tr>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 93%;">
<table style="border-collapse: collapse; width: 100%; attr-margin-left: 200; attr-margin-top: 5; table-width-pdf: 1176px !important;" border="2" cellpadding="5">
<tbody>
<tr>
<td class="encabezado" style="width: 30%;"><span><span>NUMERO DE PLAN</span></span></td>
<td style="width: 70%;"><span><?php radicado_plan(483,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado" style="width: 30%;"><span><span><span>PROCESO AUDITADO</span></span></span></td>
<td style="width: 70%;"><span><span><?php mostrar_valor_campo('proceso_auditado',483,$_REQUEST['iddoc']);?></span></span></td>
</tr>
<tr>
<td class="encabezado"><span>NOMBRE DEL JEFE DE CONTROL INTERNO</span></td>
<td><span><?php mostrar_nombre_jefe_control(483,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span>FECHA SUSCRIPCION DEL PLAN DE MEJORAMIENTO</span></td>
<td><span><?php suscripcion_plan(483,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span>FECHA DE SEGUIMIENTO A COMPROMISOS</span></td>
<td><span><?php mostrar_valor_campo('fecha_compromisos',483,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span><strong>RESULTADOS DE SEGUIMIENTO Y CONTROL</strong>&nbsp;</span></td>
</tr>
<tr>
<td class="encabezado"><span>CUMPLIMIENTO DEL OBJETIVO GENERAL DEL PLAN</span></td>
<td><span><?php mostrar_valor_campo('cumplimiento_general',483,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span>CUMPLIMIENTO DE LOS OBJETIVOS ESPECIFICOS</span></td>
<td><span><?php mostrar_valor_campo('cumplimiento_especificos',483,$_REQUEST['iddoc']);?><?php codificacion_especifica(483,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado" style="width: 30%;"><span>PORCENTAJE DE CUMPLIMIENTO DEL PLAN</span></td>
<td style="width: 70%;"><span><?php mostrar_valor_campo('cumplimiento_plan',483,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span>CONCLUSIONES</span></td>
<td><span><?php mostrar_valor_campo('conclusiones',483,$_REQUEST['iddoc']);?>&nbsp;</span></td>
</tr>
</tbody>
</table>
</td>
<td style="width: 5%;">&nbsp;</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><?php mostrar_plan_mejoramiento_completo(483,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			