<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../carta/funciones.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><p><span style="font-family: arial, helvetica, sans-serif;"><?php botones_valoracion_riesgos(500,$_REQUEST['iddoc']);?></span></p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">Fecha</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('fecha_valoracion',500,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">Descripci&oacute;n</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('descripcion_control',500,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">Tipo de control</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('tipo_control',500,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2"><span style="font-family: arial, helvetica, sans-serif;">DESPLAZAMIENTO PARA EJERCER EL CONTROL</span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">1. Posee una herramienta para ejercer el control?</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('herramienta_ejercer',500,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">2. Existen manuales, instructivos o procedimientos para el manejo de la herramienta?</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('procedimiento_herram',500,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">3. En el tiempo que lleva la herramienta, ha demostrado ser efectiva?</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('herramienta_efectiva',500,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">4. Estan definidos los responsables de la ejecuci&oacute;n del control y del seguimiento?</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('responsables_ejecuci',500,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;"><span style="font-family: arial, helvetica, sans-serif;">5. La frecuencia de la ejecuci&oacute;n del control y seguimiento es adecuado?</span></td>
<td><span style="font-family: arial, helvetica, sans-serif;"><?php mostrar_valor_campo('frecuencia_ejecucion',500,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(500,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			