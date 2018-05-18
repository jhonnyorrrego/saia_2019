<?php include_once("../../librerias_saia.php"); ?>
			<?php echo(librerias_jquery('1.7')); ?><?php include_once("../../class_transferencia.php"); ?>
			<?php include_once("../librerias/encabezado_pie_pagina.php"); ?>
			<?php include_once("../librerias/funciones_generales.php"); ?>
			<?php include_once("funciones.php"); ?>
			<?php include_once("../librerias/header_nuevo.php"); ?>
			<tr><td><table style="width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Asunto</td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('asunto',348,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Oficio Entrada</td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('fecha_oficio_entrada',348,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">De</td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('de',348,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Para</td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('para',348,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Transferido</td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('transferencia_correo',348,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Con copia</td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('copia_correo',348,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Comentario</td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('comentario',348,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(348,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_anexos_correo(348,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>
			