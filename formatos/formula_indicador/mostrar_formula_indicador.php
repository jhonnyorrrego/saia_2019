<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado" width="30%">F&oacute;rmula:</td>
<td><?php mostrar_valor_campo('nombre',381,$_REQUEST['iddoc']);?> <?php validar_formula_mostrar(381,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Unidad:</td>
<td><?php mostrar_valor_campo('unidad',381,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Periocidad:</td>
<td><?php mostrar_valor_campo('periocidad',381,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Naturaleza:</td>
<td><?php mostrar_valor_campo('naturaleza',381,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Descripci&oacute;n de Variables de la Formula</td>
<td class="phpmaker"><?php mostrar_valor_campo('observacion',381,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Rango en el cual el resultado se considera Satisfactorio</td>
<td><?php mostrar_valor_campo('rango_colores',381,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">La mejora es creciente o decreciente?</td>
<td><?php mostrar_valor_campo('tipo_rango',381,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>