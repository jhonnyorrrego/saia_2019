<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../hoja_vida/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center width: 25%;" colspan="2"><span style="font-size: small;"><strong>INFORMACI&Oacute;N ACAD&Eacute;MICA</strong></span></td>
</tr>
<tr>
<td class="normal"><?php mostrar_valor_campo('tipo_formacion',220,$_REQUEST['iddoc']);?>:</td>
<td>&nbsp;<?php mostrar_valor_campo('titulo_formacion',220,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="normal">Instituci&oacute;n:</td>
<td>&nbsp;<?php mostrar_valor_campo('institucion_formacion',220,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="normal">Anexos Digitales:</td>
<td><?php mostrar_anexos_hoja_vida(220,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>