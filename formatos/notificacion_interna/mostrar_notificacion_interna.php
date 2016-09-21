<?php include_once("../carta/funciones.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../memorando/../memorando/funciones.php"); ?><?php include_once("../carta/../carta/funciones.php"); ?><?php include_once("../carta_responde_pqr/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; font-family: Arial; font-size: 10pt;" border="0">
<tbody>
<tr>
<td><?php ciudad(242,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(242,$_REQUEST['iddoc']);?><br /><br /><br /><br /></td>
<td style="text-align: right;"><?php mostrar_datos_radicaion(242,$_REQUEST['iddoc']);?><br /><br /><br /><br /></td>
</tr>
</tbody>
</table>
<table style="width: 100%; font-family: Arial; font-size: 10pt;" border="0">
<tbody>
<tr>
<td><strong>DE</strong>:<?php mostrar_origen(242,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>PARA</strong>:<?php lista_destinos1(242,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
<tr>
<td>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="text-align: justify;"><?php mostrar_valor_campo('asunto',242,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><?php mostrar_valor_campo('saludo',242,$_REQUEST['iddoc']);?> <?php mostrar_destinos_carta(242,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php mostrar_valor_campo('contenido',242,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><?php mostrar_valor_campo('despedida',242,$_REQUEST['iddoc']);?><br /><br /></td>
</tr>
<tr>
<td><?php mostrar_estado_proceso(242,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php mostrar_anexos(242,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php mostrar_copias_carta(242,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Elabor&oacute;:&nbsp;<?php mostrar_iniciales(242,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php mostrar_copia_interna(242,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>