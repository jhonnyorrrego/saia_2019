<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; font-family: Arial; font-size: 17px;" border="0">
<tbody>
<tr>
<td colspan="2"><span><?php ciudad(212,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(212,$_REQUEST['iddoc']);?></span></td>
<td style="text-align: right;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <?php mostrar_datos_radicaion(212,$_REQUEST['iddoc']);?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
</tbody>
</table>
<table style="width: 100%; font-family: Arial; font-size: 17px;" border="0">
<tbody>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;<?php destino_pqr(212,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><strong>Asunto: <?php mostrar_valor_campo('asunto',212,$_REQUEST['iddoc']);?></strong></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><span><?php mostrar_valor_campo('saludo',212,$_REQUEST['iddoc']);?> <?php mostrar_destinos_carta(212,$_REQUEST['iddoc']);?></span><br />&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><span><?php mostrar_valor_campo('contenido',212,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><br /><span><?php mostrar_valor_campo('despedida',212,$_REQUEST['iddoc']);?></span><br /><br /></td>
</tr>
<tr>
<td colspan="2"><strong><?php mostrar_estado_proceso(212,$_REQUEST['iddoc']);?></strong></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: x-small;"><?php mostrar_anexos(212,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: x-small;"><?php mostrar_copias_carta(212,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span style="font-size: x-small;">Elaboro:&nbsp;<?php mostrar_iniciales(212,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>