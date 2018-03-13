<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="; width: 100%;" border="2">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Ubicaci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('ubicacion',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">No. de Caja</td>
<td>&nbsp;<?php mostrar_valor_campo('numero_caja',408,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha de retiro</td>
<td>&nbsp;<?php mostrar_fecha_retiro_retirados(408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">1er. Apellido</td>
<td>&nbsp;<?php mostrar_valor_campo('primer_apellido',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">2do. Apellido</td>
<td>&nbsp;<?php mostrar_valor_campo('segundo_apellido',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre Completo</td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_completo',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">No. de Identificaci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('num_identificacion',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Extrema Inicial</td>
<td>&nbsp;<?php mostrar_fecha_inicial_retirados(408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Extrema Final</td>
<td>&nbsp;<?php mostrar_fecha_final_retirados(408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Folios</td>
<td>&nbsp;<?php mostrar_valor_campo('folios',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">&Uacute;ltimo Cargo</td>
<td>&nbsp;<?php mostrar_valor_campo('ultimo_cargo',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estamento</td>
<td>&nbsp;<?php mostrar_valor_campo('estamento',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Jubilado por otra instituci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('jubilado_otra_instit',408,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td>&nbsp;<?php mostrar_valor_campo('observaciones',408,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>