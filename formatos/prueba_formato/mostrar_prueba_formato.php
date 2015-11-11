<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="width: 30%;">Nombre</td>
<td><?php mostrar_valor_campo('nombre',328,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list">Fecha</td>
<td><?php mostrar_valor_campo('fecha',328,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list">Observaciones</td>
<td><?php mostrar_valor_campo('observaciones',328,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado_list">Destino</td>
<td><?php mostrar_valor_campo('destino',328,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>