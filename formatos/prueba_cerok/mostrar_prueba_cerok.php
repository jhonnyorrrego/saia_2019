<?php include_once("../carta/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; height: 162px;" border="0" cellspacing="0">
<tbody>
<tr>
<td style="text-align: center;" colspan="3">&nbsp;PRUEBA SAIA DIV</td>
</tr>
<tr>
<td>&nbsp;COLUMNA 1</td>
<td>&nbsp;&nbsp;COLUMNA 2</td>
<td>&nbsp;&nbsp;COLUMNA 3</td>
</tr>
<tr>
<td colspan="3">&nbsp;<?php mostrar_valor_campo('contenido',213,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td rowspan="2">&nbsp;<?php mostrar_valor_campo('anexo_formato',213,$_REQUEST['iddoc']);?></td>
<td rowspan="2">&nbsp;FILA 1</td>
<td>&nbsp;FILA 2</td>
</tr>
<tr>
<td>&nbsp;FILA 3</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>