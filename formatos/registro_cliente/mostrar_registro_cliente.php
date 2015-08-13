<?php include_once("../carta/funciones.php"); ?><?php include_once("../estructura_hoja_vida/funciones.php"); ?><?php include_once("../referencias_comerciales/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Datos del Cliente:</span></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_cliente',245,$_REQUEST['iddoc']);?></td>
<td rowspan="4"><?php mostrar_logo_cliente(245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">P&aacute;gina web:</span></td>
<td>&nbsp;<?php mostrar_valor_campo('pagina_web',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Estado del Cliente:</span></td>
<td>&nbsp;<?php mostrar_valor_campo('estado_cliente',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Sector:</span></td>
<td>&nbsp;<?php mostrar_valor_campo('sector',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Origen del contacto:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('descripcion_origen_contacto',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Nombre Contacto 1:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('nombre_contacto1',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Cargo:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('cargo_contacto1',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Tel&eacute;fono:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('telefono_contacto1',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Celular:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('celular_contacto1',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Email:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('email_contacto1',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Nombre contacto 2:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('nombre_contacto2',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Cargo:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('cargo_contacto2',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Tel&eacute;fono:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('telefono_contacto2',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Celular:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('celular_contacto2',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Email:</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('email_contacto2',245,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Responsable</span></td>
<td colspan="2">&nbsp;<?php mostrar_valor_campo('responsable',245,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><strong><?php mostrar_estado_proceso(245,$_REQUEST['iddoc']);?></strong></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>