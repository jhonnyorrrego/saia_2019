<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table class="table table-bordered" style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado_list" colspan="3" align="center" valign="middle">
<p style="text-align: center;"><strong><?php mostrar_valor_campo('nombre',477,$_REQUEST['iddoc']);?></strong></p>
</td>
</tr>
<tr>
<td valign="middle">
<p><strong>C&oacute;digo</strong></p>
</td>
<td colspan="2"><?php mostrar_valor_campo('codigo',477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="middle">
<p><strong>Versi&oacute;n</strong></p>
</td>
<td colspan="2"><?php mostrar_valor_campo('version',477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="middle">
<p><strong>Vigencia</strong></p>
</td>
<td colspan="2"><?php mostrar_valor_campo('vigencia',477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="middle">
<p><strong>Estado</strong></p>
</td>
<td colspan="2"><?php mostrar_valor_campo('estado',477,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td valign="middle">
<p><strong>Responsable</strong></p>
</td>
<td colspan="2"><?php mostrar_valor_campo('responsable',477,$_REQUEST['iddoc']);?> <?php icono_detalles(477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="middle"><strong>L&iacute;der</strong></td>
<td colspan="2"><?php mostrar_valor_campo('lider_proceso',477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="middle"><strong>Objetivo</strong></td>
<td colspan="2"><?php mostrar_valor_campo('objetivo',477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="middle"><strong>Alcance</strong></td>
<td colspan="2"><?php mostrar_valor_campo('alcance',477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="middle"><strong>Dependencias participantes</strong></td>
<td colspan="2"><?php mostrar_valor_campo('dependencias_partici',477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td valign="middle"><strong>Permisos de acceso</strong></td>
<td colspan="2"><?php mostrar_valor_campo('permisos_acceso',477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="3"><?php link_cuadro_mando(477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="3">Politicas de Operaci&oacute;n de Proceso</td>
</tr>
<tr>
<td colspan="3"><?php listar_politicas_proceso(477,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="3">Anexos: <?php mostrar_valor_campo('anexos',477,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(477,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			