<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Fecha</td>
<td><?php mostrar_valor_campo('fecha_documento',272,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Mensajero</td>
<td><?php mostrar_valor_campo('nombre_mensajero',272,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td><?php mostrar_valor_campo('nivel_urgencia',272,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Destino</td>
<td><?php mostrar_valor_campo('destino',272,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td><?php mostrar_valor_campo('observaciones',272,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(272,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			