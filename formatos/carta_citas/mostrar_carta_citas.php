<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; font-size: 10pt; border-collapse: collapse; font-family: arial;" border="0">
<tbody>
<tr>
<td><?php mostrar_destino(266,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Asunto:&nbsp;<?php mostrar_valor_campo('asunto',266,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Coordial Saludo:</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: justify;">Un texto es una composici&oacute;n de signos codificado en un sistema de escritura (como un alfabeto) que forma una unidad de sentido. Su tama&ntilde;o puede ser variable.
<p>Tambi&eacute;n es texto una composici&oacute;n de caracteres imprimibles (con grafema) generados por un algoritmo de cifrado que, aunque no tienen sentido para cualquier persona, s&iacute; puede ser descifrado por su destinatario original. En otras palabras, un texto es un entramado de signos con una intenci&oacute;n comunicativa que adquiere sentido en determinado contexto.</p>
<p>Las ideas esenciales que comunica un texto est&aacute;n contenidas en lo que se suele denominar &laquo;macroproposiciones&raquo;, unidades estructurales de nivel superior o global, que otorgan coherencia al texto constituyendo su hilo central, el esqueleto estructural que cohesiona elementos ling&uuml;&iacute;sticos formales de alto nivel, como los t&iacute;tulos y subt&iacute;tulos, la secuencia de p&aacute;rrafos, etc. En contraste, las &laquo;microproposiciones&raquo; son los elementos coadyudantes de la cohesi&oacute;n de un texto, pero a nivel m&aacute;s particular o local. Esta distinci&oacute;n fue realizada por Teun van Dijk en 1980.1</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><?php mostrar_remitidos(266,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(266,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>