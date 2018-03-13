<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="; width: 100%;" border="2">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Ubicaci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('ubicacion',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">No. de Caja</td>
<td>&nbsp;<?php mostrar_valor_campo('numero_caja',409,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha de Jubilaci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_jubilacion',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">No. de Resoluci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('numero_resolucion',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Emanada de</td>
<td>&nbsp;<?php mostrar_valor_campo('emanada_de',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">1er. Apellido</td>
<td>&nbsp;<?php mostrar_valor_campo('primer_apellido',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">2do. Apellido</td>
<td>&nbsp;<?php mostrar_valor_campo('segundo_apellido',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre Completo</td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_completo',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">No. de Identificaci&oacute;n</td>
<td>&nbsp;<?php mostrar_valor_campo('num_identificacion',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Extrema Inicial</td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_extrema_inicia',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha Extrema Final</td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_extrema_final',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Folios</td>
<td>&nbsp;<?php mostrar_valor_campo('folios',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">&Uacute;ltimo Cargo</td>
<td>&nbsp;<?php mostrar_valor_campo('ultimo_cargo',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estamento</td>
<td>&nbsp;<?php mostrar_valor_campo('estamento',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Demandado</td>
<td>&nbsp;<?php mostrar_valor_campo('demandado',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Sustituci&oacute;n Pensional</td>
<td>&nbsp;<?php mostrar_valor_campo('sustitucion_pensiona',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">C&eacute;dula Sustituci&oacute;n Pensional</td>
<td>&nbsp;<?php mostrar_valor_campo('cedula_sustitucion',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha de Reconocimiento Sustituci&oacute;n Pensional</td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_reconocimiento',409,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td>&nbsp;<?php mostrar_valor_campo('observaciones',409,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>