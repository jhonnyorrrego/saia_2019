<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../carta/../librerias/funciones_generales.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../carta/../../pantallas/qr/librerias.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td colspan="2"><span style="font-family: verdana, geneva;"><?php ciudad(307,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(307,$_REQUEST['iddoc']);?></span></td>
<td style="text-align: right;" rowspan="4"><span style="font-family: verdana, geneva;"><?php mostrar_codigo_qr(307,$_REQUEST['iddoc']);?></span><br /><span style="font-family: verdana, geneva;"><?php formato_radicado_enviada(307,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><span style="font-family: verdana, geneva;"><?php mostrar_destinos(307,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="3"><br />
<p><span style="font-family: verdana, geneva;">ASUNTO: &nbsp; &nbsp; <?php mostrar_valor_campo('asunto',307,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
<tr>
<td colspan="3" width="100%">
<p>&nbsp;<br /><span style="font-family: verdana, geneva;">Cordial saludo:</span></p>
<p><span style="font-family: verdana, geneva;"><?php mostrar_valor_campo('contenido',307,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="font-family: verdana, geneva;">&nbsp;Atentamente,</span></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3"><span style="font-family: verdana, geneva;"><?php mostrar_estado_proceso(307,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="3"><span style="font-family: verdana, geneva;"><?php mostrar_anexos_externa(307,$_REQUEST['iddoc']);?></span><br /><span style="font-family: verdana, geneva;"><?php mostrar_copias_comunicacion_ext(307,$_REQUEST['iddoc']);?>Proyect&oacute;: <?php mostrar_valor_campo('iniciales',307,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>