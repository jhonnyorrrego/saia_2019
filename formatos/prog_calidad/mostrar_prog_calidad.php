<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left;">Nombre</td>
<td><?php mostrar_valor_campo('nombre',367,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td><?php mostrar_valor_campo('estado',367,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Anexos</td>
<td><?php mostrar_valor_campo('anexos',367,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>