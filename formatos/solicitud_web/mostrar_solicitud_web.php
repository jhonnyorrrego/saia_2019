<?php include_once("../memo/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p style="text-align: center;"><strong><?php mostrar_valor_campo('tipo_solicitud',78,$_REQUEST['iddoc']);?></strong></p>
<table style="<?php estilo_formato(78,$_REQUEST['iddoc']);?>" border="0" width="100%">
<tbody>
<tr>
<td class="encabezado">Nombre</td>
<td><?php mostrar_valor_campo('nombre_persona',78,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">No C&eacute;dula</td>
<td><?php mostrar_valor_campo('identificacion',78,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">No Matr&iacute;cula de servicios</td>
<td><?php mostrar_valor_campo('no_matricula',78,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Tipo de Reporte</td>
<td><?php mostrar_valor_campo('tipo_reporte',78,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Correo electr&oacute;nico</td>
<td><?php mostrar_valor_campo('email',78,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Direcci&oacute;n notificiaci&oacute;n</td>
<td><?php mostrar_valor_campo('direccion_residencia',78,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Tel&eacute;fono</td>
<td><?php mostrar_valor_campo('telefono',78,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Mensaje</td>
<td><?php mostrar_valor_campo('mensaje',78,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php responder_solicitud(78,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>