<?php include_once("../memo/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>
<table border="0" width="100%" cellspacing="0" >
<tbody>
<tr>
<td><span>
<p><?php ciudad(4,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(4,$_REQUEST['iddoc']);?></p>
</span></td>
<td style="text-align: right;" valign="top">
<p><?php formato_serie(4,$_REQUEST['iddoc']);?>- <strong><?php formato_numero(4,$_REQUEST['iddoc']);?></strong></p>
</td>
</tr>
</tbody>
</table>
</p>
<table border="0" width="100%" cellspacing="0" >
<tbody>
<tr>
<td colspan="2">
<p><span><br /></span></p>
</td>
</tr>
<tr>
<td colspan="2" valign="top"><span><?php mostrar_destinos(4,$_REQUEST['iddoc']);?><br /><br /><br /><br /></span></td>
</tr>
<tr>
<td colspan="2"><br /><br /><span>Asunto: <?php mostrar_valor_campo('asunto',4,$_REQUEST['iddoc']);?><br /><br /></span></td>
</tr>
<tr>
<td colspan="2" valign="top"><br /><span><?php mostrar_valor_campo('contenido',4,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><br /><span><?php mostrar_valor_campo('despedida',4,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span><?php mostrar_estado_proceso(4,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_anexos_memo(4,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2"><?php mostrar_copias_carta(4,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">
<p><span><?php mostrar_preparo(4,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer.php"); ?>
