<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="; width: 100%;" border="0">
<tbody>
<tr>
<td>nombre</td>
<td><?php mostrar_valor_campo('nombre',209,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;fecha:</td>
<td><?php mostrar_valor_campo('fecha_formato',209,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>