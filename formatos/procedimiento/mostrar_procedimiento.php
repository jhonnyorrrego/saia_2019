<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" valign="top">Objetivo:</td>
<td class="phpmaker" valign="top"><?php mostrar_valor_campo('objetivo',496,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Alcances:</td>
<td class="phpmaker"><?php mostrar_valor_campo('alcance',496,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Definiciones:</td>
<td class="phpmaker"><?php mostrar_valor_campo('definicion',496,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="windowtext 0.5pt solid; text-align: center;" colspan="2"><?php listar_pasos_procedimiento(496,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td colspan="2">DISPOSICIONES GENERALES:<br /><?php mostrar_valor_campo('dispocisiones_generales',496,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_anexos_memo(496,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">Aprob&oacute;:<br /><?php mostrar_estado_proceso(496,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			