<?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center; background-color: #3872d0;" colspan="2"><span style="color: #ffffff;"><strong>Seguimiento</strong></span></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>&nbsp;Fecha:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('fecha',246,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>Forma de contacto:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('forma_contacto',246,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>Resultado de Seguimiento:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('resultado_seguimiento',246,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>Pr&oacute;xima Fecha de Seguimiento:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('fecha_seguimiento',246,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>Estado del Cliente:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('estado_cliente',246,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>Se Envi&oacute; propuesta:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('envio_propuesta',246,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>Nombre de la propuesta:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_propuesta',246,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>Nombre del Producto o Servicio:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_producto_servicio',246,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="background-color: #3872d0;"><span style="color: #ffffff;"><strong>Empresa Asociada:</strong></span></td>
<td>&nbsp;<?php mostrar_valor_campo('empresa_asociada',246,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>