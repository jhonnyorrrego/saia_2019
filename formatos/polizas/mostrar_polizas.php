<?php include_once("../carta/funciones.php"); ?><?php include_once("../contrato_registro_cliente/funciones.php"); ?><?php include_once("../proyecto_registro_cliente/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Fecha de expedici&oacute;n:</span></td>
<td><?php mostrar_valor_campo('fecha_expedicion',253,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Aseguradora:</span></td>
<td><?php mostrar_valor_campo('aseguradora',253,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">N&uacute;mero de p&oacute;liza:</span></td>
<td><?php mostrar_valor_campo('poliza',253,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Vigencia desde:</span></td>
<td><?php mostrar_valor_campo('fecha_inicio',253,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Vigencia hasta:</span></td>
<td><?php mostrar_valor_campo('fecha_fin',253,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Valor de cobertura:</span></td>
<td>$<?php mostrar_valor_campo('valor',253,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;">Anexos:</span></td>
<td><?php mostrar_anexos_poliza(253,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><strong><?php mostrar_estado_proceso(253,$_REQUEST['iddoc']);?></strong></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>