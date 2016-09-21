<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../hoja_vida/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td class="normal" style="width: 25%;">
<p><span style="font-size: small;">Nombre:</span></p>
</td>
<td class="phpmaker">
<p><span style="font-size: small;"><?php mostrar_valor_campo('nombre',225,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
<tr>
<td class="normal"><span style="font-size: small;">Codigo del Padre:</span></td>
<td class="phpmaker"><span style="font-size: small;"><?php mostrar_valor_campo('cod_padre',225,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="normal">
<p><span style="font-size: small;">Caracter&iacute;sticas:&nbsp;</span></p>
</td>
<td class="phpmaker">
<p><span style="font-size: small;"><?php mostrar_valor_campo('caracteristicas',225,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
<tr>
<td class="normal">
<p><span style="font-size: small;">Obligatoriedad</span></p>
</td>
<td class="phpmaker">
<p><span style="font-size: small;"><?php mostrar_valor_campo('obligatoriedad',225,$_REQUEST['iddoc']);?></span></p>
</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>