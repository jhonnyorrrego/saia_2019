<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../contrato_registro_cliente/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%; border-collapse: collapse;" border="1">
<tbody>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Fecha:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('fecha',249,$_REQUEST['iddoc']);?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Forma de contacto:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('forma_contacto',249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Resultado de Seguimiento:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('resultado_seguimiento',249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Pr&oacute;xima Fecha de Seguimiento:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_seguimiento',249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Estado del Cliente:</strong></span></td>
<td>&nbsp;<?php mostrar_estado_cliente(249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Se Envi&oacute; propuesta:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('envio_propuesta',249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Nombre de la propuesta:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_propuesta',249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Estado de la propuesta:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('estado_propuesta',249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Nombre del Producto o Servicio:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_producto_servicio',249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Empresa Asociada:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('empresa_asociada',249,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #57b0de;"><span style="color: #ffffff;"><strong>Anexos:</strong></span></td>
<td>&nbsp;<?php mostrar_anexos_proyecto(249,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><strong><?php mostrar_estado_proceso(249,$_REQUEST['iddoc']);?></strong></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>