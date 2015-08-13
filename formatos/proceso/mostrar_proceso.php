<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="font-family: arial; width: 100%; border-collapse: collapse;" border="1" cellspacing="0">
<tbody>
<tr>
<td valign="top"><strong>L&iacute;der del proceso: <?php mostrar_valor_campo('lider_proceso',194,$_REQUEST['iddoc']);?></strong></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center;" valign="top">Descripcion<strong></strong></td>
</tr>
<tr>
<td style="text-align: left;" valign="top"><?php mostrar_valor_campo('descripcion',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center; border: #000000 1px solid;">Objetivo del Proceso</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('objetivo',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: center; border: #000000 1px solid;">Pol&iacute;tica de Operaci&oacute;n</td>
</tr>
<tr>
<td><?php mostrar_valor_campo('politica_operacion',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php listar_politicas(194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="celda_transparente" style="border-width: 1px; border-style: solid; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-image: none;">Anexos: <br /><?php mostrar_valor_campo('anexos',194,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Estado: <?php mostrar_valor_campo('estado',194,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(194,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>