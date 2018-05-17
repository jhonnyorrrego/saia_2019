<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="border: 1px solid #b6b8b7; text-align: center; background-color: #3f91f2;" colspan="2"><span style="color: #ffffff;"><strong>RUTA DE DISTRIBUCI&Oacute;N</strong></span></td>
</tr>
<tr>
<td style="border: 1px solid #b6b8b7;"><strong>&nbsp;Fecha</strong></td>
<td style="border: 1px solid #b6b8b7;">&nbsp;<?php mostrar_valor_campo('fecha_ruta_distribuc',404,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="border: 1px solid #b6b8b7;"><strong>&nbsp;Nombre de la Ruta&nbsp;</strong></td>
<td style="border: 1px solid #b6b8b7;">&nbsp;<?php mostrar_valor_campo('nombre_ruta',404,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="border: 1px solid #b6b8b7;"><strong>&nbsp;Descripci&oacute;n Ruta&nbsp;</strong></td>
<td style="border: 1px solid #b6b8b7;">&nbsp;<?php mostrar_valor_campo('descripcion_ruta',404,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
</tbody>
</table>
<p><?php enlace_item_dependencias_ruta(404,$_REQUEST['iddoc']);?>&nbsp;</p>
<p><?php mostrar_datos_dependencias_ruta(404,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p><?php enlace_item_funcionarios_ruta(404,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_datos_funcionarios_ruta(404,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(404,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			