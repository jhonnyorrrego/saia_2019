<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table class="table table-bordered" style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="width: 25%; text-align: center;" colspan="2">MACROPROCESO</td>
</tr>
<tr>
<td>Nombre</td>
<td><?php mostrar_valor_campo('nombre',478,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Descripcion</td>
<td><?php mostrar_valor_campo('des_formato',478,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Caracterizacion</td>
<td><?php mostrar_valor_campo('caracterizacion',478,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(478,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			