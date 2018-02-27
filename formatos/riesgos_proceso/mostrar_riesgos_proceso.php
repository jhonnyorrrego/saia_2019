<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p><span style="font-family: arial, helvetica, sans-serif;"><?php editar_riesgos_proceso(499,$_REQUEST['iddoc']);?></span></p>
<p><span style="font-family: arial, helvetica, sans-serif;"><?php adicionar_control_riesgo(499,$_REQUEST['iddoc']);?></span></p>
<p><span style="font-family: arial, helvetica, sans-serif;"><?php adicionar_acciones_riesgo(499,$_REQUEST['iddoc']);?></span></p>
<table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" colspan="2"><span style="font-family: arial, helvetica, sans-serif;">Evaluacion y Valoracion del Riesgo</span></td>
</tr>
<tr>
<td class="encabezado" valign="top"><span style="font-family: arial, helvetica, sans-serif;">N&uacute;mero:</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('consecutivo',499,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado" valign="top"><span style="font-family: arial, helvetica, sans-serif;">Estado:</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('estado',499,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Area Responsable:</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('area_responsable',499,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Riesgo:</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('riesgo',499,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Tipo de Riesgo</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('tipo_riesgo',499,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Fuente/causa:</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('fuente_causa',499,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Consecuencia:</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('consecuencia',499,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Probabilidad:</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('probabilidad',499,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr id="idfila_impacto">
<td class="encabezado"><span style="font-family: arial, helvetica, sans-serif;">Impacto:</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('impacto',499,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><span style="font-family: arial, helvetica, sans-serif;"><?php matriz_riesgo(499,$_REQUEST['iddoc']);?><br /><br /><br /></span></p>
<p><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_estado_proceso(499,$_REQUEST['iddoc']);?></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>