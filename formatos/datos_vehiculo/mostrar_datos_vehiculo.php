<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">Veh&iacute;culo</td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_vehiculo',258,$_REQUEST['iddoc']);?></td>
<td style="width: 35%; text-align: center;" rowspan="6">&nbsp;<?php mostrar_imagen_vehiculo(258,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Modelo</td>
<td>&nbsp;<?php mostrar_valor_campo('modelo_vehiculo',258,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Color</td>
<td>&nbsp;<?php mostrar_valor_campo('color_vehiculo',258,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Motor</td>
<td>&nbsp;<?php mostrar_valor_campo('motor_vehiculo',258,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Serie/Chasis</td>
<td>&nbsp;<?php mostrar_valor_campo('serie_chasis_vehiculo',258,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Valor del veh&iacute;culo</td>
<td>&nbsp;<?php mostrar_valor_campo('valor_vehiculo',258,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_accesorios_vehiculo(258,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(258,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>