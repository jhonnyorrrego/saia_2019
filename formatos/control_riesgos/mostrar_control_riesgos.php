<?php include_once("../carta/funciones.php"); ?><?php include_once("../riesgos_proceso/../riesgos_proceso/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;<?php botones_valoracion_riesgos(394,$_REQUEST['iddoc']);?></p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="width: 30%; text-align: left;">Fecha</td>
<td style="width: 70%;"><?php mostrar_valor_campo('fecha_valoracion',394,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Descripci&oacute;n</td>
<td><?php mostrar_valor_campo('descripcion_control',394,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Tipo de control</td>
<td><?php mostrar_valor_campo('tipo_control',394,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="2">DESPLAZAMIENTO PARA EJERCER EL CONTROL</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">1. Posee una herramienta para ejercer el control?</td>
<td><?php mostrar_valor_campo('herramienta_ejercer',394,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">2. Existen manuales, instructivos o procedimientos para el manejo de la herramienta?</td>
<td><?php mostrar_valor_campo('procedimiento_herramienta',394,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">3. En el tiempo que lleva la herramienta, ha demostrado ser efectiva?</td>
<td><?php mostrar_valor_campo('herramienta_efectiva',394,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">4. Estan definidos los responsables de la ejecuci&oacute;n del control y del seguimiento?</td>
<td><?php mostrar_valor_campo('responsables_ejecucion',394,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">5. La frecuencia de la ejecuci&oacute;n del control y seguimiento es adecuado?</td>
<td>&nbsp;<?php mostrar_valor_campo('frecuencia_ejecucion',394,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>