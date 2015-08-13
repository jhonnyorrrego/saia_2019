<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0">
<tbody>
<tr>
<td><strong>Elemento de salida</strong></td>
<td><?php mostrar_valor_campo('item_salida',326,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Observaciones</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('observaciones',326,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>