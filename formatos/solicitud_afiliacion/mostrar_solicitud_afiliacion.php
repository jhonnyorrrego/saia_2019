<?php include_once("../carta/funciones.php"); ?><?php include_once("../solicitud_servicio/../../pantallas/qr/librerias.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">N&uacute;mero de Solicitud</td>
<td style="width: 60%;"><?php formato_numero(271,$_REQUEST['iddoc']);?></td>
<td style="text-align: center; width: 20%;" rowspan="5"><?php mostrar_codigo_qr(271,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Fecha de Solicitud</td>
<td><?php mostrar_valor_campo('fecha_solicitud',271,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Datos del Solicitante de Afiliaci&oacute;n</td>
<td><?php mostrar_datos_solicita_afiliacion(271,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">N&uacute;mero de Folios</td>
<td><?php mostrar_valor_campo('numero_folios_afilia',271,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Adjuntos</td>
<td><?php mostrar_anexos(271,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php imagenes_digitalizadas_funcion_afiliacion(271,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(271,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>