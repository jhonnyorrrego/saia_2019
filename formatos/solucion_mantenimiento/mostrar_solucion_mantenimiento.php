<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; background-color: #b3b3b3; width: 100%; font-size: 10pt;" border="1">
<tbody>
<tr>
<td style="width: 100%;" colspan="2"><span><strong>Soluci&oacute;n</strong>&nbsp;<?php mostrar_valor_campo('tipo',288,$_REQUEST['iddoc']);?></span>&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width: 58%;">&nbsp;</td>
<td style="width: 42%;"><strong>Pre-Requisitos de montaje</strong></td>
</tr>
<tr>
<td><span><strong>Nombre de responsable</strong>&nbsp;<?php mostrar_valor_campo('nombre_responsable',288,$_REQUEST['iddoc']);?></span></td>
<td><?php mostrar_valor_campo('prerequisitos_montaje',288,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><span><strong>Breve descripci&oacute;n soluci&oacute;n</strong></span></td>
<td><span><strong>Observaciones</strong></span></td>
</tr>
<tr>
<td><?php mostrar_valor_campo('descripcion_solucion',288,$_REQUEST['iddoc']);?></td>
<td><?php mostrar_valor_campo('observaciones',288,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><span><strong>Anexos soluciones</strong>&nbsp;<span><?php mostrar_valor_campo('anexos_solucion',288,$_REQUEST['iddoc']);?></span></span></td>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>Firmas y fechas&nbsp;</strong><?php fecha_firma_usuarios(288,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;"><span><strong>Firma y fecha&nbsp;</strong><?php fecha_firma_solicitante(288,$_REQUEST['iddoc']);?>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(288,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p><span><span>&nbsp; &nbsp;</span><br /></span></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>