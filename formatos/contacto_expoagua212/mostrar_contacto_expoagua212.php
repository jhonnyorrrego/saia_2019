<?php include_once("../memo/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p style="text-align: center;"><strong>SOLICITUD EXPO AGUA 2012</strong></p>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td class="encabezado">Nombre</td>
<td><?php mostrar_valor_campo('nombre_persona',80,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Correo electr&oacute;nico</td>
<td><?php mostrar_valor_campo('email',80,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Ciudad</td>
<td><?php ciudad(80,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Tel&eacute;fono</td>
<td><?php mostrar_valor_campo('telefono',80,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Tel&eacute;fono Celular</td>
<td><?php mostrar_valor_campo('celular',80,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Mensaje</td>
<td><?php mostrar_valor_campo('mensaje',80,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>