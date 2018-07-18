<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../funciones.php"); ?><?php include_once("../carta/../librerias/funciones_generales.php"); ?><?php include_once("../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../carta/../../pantallas/qr/librerias.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="0">
<tbody>
<tr>
<td width="15%">&nbsp;</td>
<td width="35%">&nbsp;</td>
<td width="50%">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><?php ciudad(2,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(2,$_REQUEST['iddoc']);?></td>
<td style="text-align: right;" rowspan="5"><?php mostrar_codigo_qr(2,$_REQUEST['iddoc']);?><br /><span style="font-size: 8pt;"><?php formato_radicado_interno(2,$_REQUEST['iddoc']);?></span></td>
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
<td>PARA:</td>
<td><?php lista_destinos(2,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td>DE:</td>
<td><?php mostrar_origen(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>ASUNTO:</td>
<td colspan="2"><?php mostrar_valor_campo('asunto',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="3">
<p><br />Cordial saludo:</p>
<p><?php mostrar_valor_campo('contenido',2,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;Atentamente,&nbsp;&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="3">&nbsp;<?php mostrar_estado_proceso(2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="3"><?php mostrar_anexos(2,$_REQUEST['iddoc']);?><br /><?php mostrar_copias_memo(2,$_REQUEST['iddoc']);?><br />Proyect&oacute;: <?php mostrar_iniciales(2,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>