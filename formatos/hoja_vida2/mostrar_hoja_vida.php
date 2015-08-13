<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table class="tabla_no_borde" border="1" cellspacing="0" cellpadding="0" width="100%">
<tbody>
<tr>
<td class="phpmaker" style="width: 15%; text-align: center;" rowspan="5"><?php foto_hoja_vida(71,$_REQUEST['iddoc']);?><br /></td>
<td class="encabezado" style="width: 25%;"><span style="color: #ffffff;">Documento Identidad:</span></td>
<td class="phpmaker" style="width: 60%;"><?php mostrar_valor_campo('documento_identidad',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado"><span style="color: #ffffff;">Nombres:</span></td>
<td><?php mostrar_valor_campo('nombres',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado"><span style="color: #ffffff;">Apellidos:</span></td>
<td><?php mostrar_valor_campo('apellidos',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Dependencia:</td>
<td><?php mostrar_valor_campo('dependencia_hoja_vida',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Cargo:</td>
<td><?php mostrar_valor_campo('cargo',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" colspan="2"><span style="color: #ffffff;">Fecha de Nacimiento:</span><br /></td>
<td><?php mostrar_valor_campo('fecha_nacimiento',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" colspan="2"><span style="color: #ffffff;">Direcci&oacute;n:</span><br /></td>
<td><?php mostrar_valor_campo('direccion_residencia',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" colspan="2"><span style="color: #ffffff;">Tel&eacute;fono:</span><br /></td>
<td><?php mostrar_valor_campo('telefono',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" colspan="2"><span style="color: #ffffff;">Celular:</span><br /></td>
<td><?php mostrar_valor_campo('celular',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" colspan="2"><span style="color: #ffffff;">E-mail:</span><br /></td>
<td><?php mostrar_valor_campo('email',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" colspan="2"><span style="color: #ffffff;">Tipo Sanguineo:</span><br /></td>
<td><?php mostrar_valor_campo('tipo_sanguineo',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" colspan="2">Estado</td>
<td><?php mostrar_valor_campo('estado',71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="3">
<p style="text-align: center;"><?php menu_hoja_vida(71,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td style="text-align: center;" colspan="3"><?php documentos_vinculados_hoja_vida(71,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>