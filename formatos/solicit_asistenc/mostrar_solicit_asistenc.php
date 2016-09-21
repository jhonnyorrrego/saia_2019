<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="2">
<tbody>
<tr>
<td>Fecha</td>
<td><?php mostrar_valor_campo('fecha_asis',335,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Descripcion</td>
<td>&nbsp;<?php mostrar_valor_campo('descrip',335,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>