<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="text-align: left; width: 30%;"><strong>&nbsp;Estado PQRSF</strong></td>
<td style="text-align: left; width: 20%;">&nbsp;<?php mostrar_valor_campo('estado_reporte',305,$_REQUEST['iddoc']);?></td>
<td style="text-align: left; width: 30%;">&nbsp;<strong>Fecha Cambio Estado</strong></td>
<td style="text-align: left; width: 20%;">&nbsp;<?php ver_fecha_reporte(305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Tipo Comentario:</strong></td>
<td style="text-align: left;" colspan="3">&nbsp;<?php mostrar_valor_campo('tipo',305,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Nombre Completo:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('nombre',305,$_REQUEST['iddoc']);?></td>
<td>&nbsp;<strong>Documento:</strong></td>
<td>&nbsp;<?php mostrar_valor_campo('documento',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Email:&nbsp;</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('email',305,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;">&nbsp;<strong>Telefono o Celular:</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('telefono',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;<strong>Rol en la Insitucion:</strong></strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('rol_institucion',305,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;"><strong>&nbsp;Iniciativa p&uacute;blica:</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('iniciativa_publica',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Sector de la iniciativa:</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('sector_iniciativa',305,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;"><strong>&nbsp;Cluster:</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('cluster',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;"><strong>&nbsp;Region:</strong></td>
<td style="text-align: left;">&nbsp;<?php mostrar_valor_campo('region',305,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;">&nbsp;</td>
<td style="text-align: left;">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="4"><strong>&nbsp;Comentario:</strong></td>
</tr>
<tr>
<td colspan="4">&nbsp;<?php mostrar_valor_campo('comentarios',305,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="4">&nbsp;<strong>Documento Soporte del Comentario:&nbsp;</strong><?php mostrar_anexos_pqrsf(305,$_REQUEST['iddoc']);?><strong></strong></td>
</tr>
</tbody>
</table>
<p><?php mostrar_datos_hijos(305,$_REQUEST['iddoc']);?></p>
<p><?php mostrar_estado_proceso(305,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>