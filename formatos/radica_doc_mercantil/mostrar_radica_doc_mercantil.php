<?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 20%;"><strong>Radicado</strong></td>
<td><?php formato_numero(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Fecba y Hora de Radicaci&oacute;n</strong></td>
<td><?php mostrar_fecha_mercantil(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>N&uacute;mero de Solicitud</strong></td>
<td><?php enlace_solicitud_servicios(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Serie Documental</strong></td>
<td><?php mostrar_serie_mercantil(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Tipo de Solicitud</strong></td>
<td><?php mostrar_solicitud_mercantil(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Tipo de Mercancia</strong></td>
<td><?php mostrar_mercancia_mercantil(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Tipo de Privilegios</strong></td>
<td><?php mostrar_privilegios_mercantil(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Fecha Inicial</strong></td>
<td><?php mostrar_fecha_inicial_afiliacion(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Fecha Final</strong></td>
<td><?php mostrar_fecha_final_afiliacion(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong><strong>Destino</strong></strong></td>
<td><?php mostrar_valor_campo('destino_doc_mercantil',268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Copia A</strong></td>
<td><?php mostrar_valor_campo('copia_a_mercantil',268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Anexos Digitales</strong></td>
<td><?php mostrar_anexos(268,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Anexos F&iacute;sicos</strong></td>
<td><?php mostrar_anexo_fisico_recepcion(268,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php imagenes_digitalizadas_funcion(268,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>