<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; ; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 25%;">Accesorio</td>
<td>&nbsp;<?php mostrar_valor_campo('accesorio_vehiculo',259,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Valor del accesorio</td>
<td>&nbsp;<?php mostrar_valor_campo('valor_accesorio',259,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>