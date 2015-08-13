<?php include_once("../carta/funciones.php"); ?><?php include_once("../solicitud_permiso/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0">
<tbody>
<tr>
<td><strong>Fecha</strong>:&nbsp;<?php fecha_docu(216,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>De</strong>: &nbsp; <?php nombre_empleado(216,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Para</strong>: <?php mostrar_valor_campo('gestio_humana',216,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="1">
<p style="text-align: justify;">Por medio de la presente me permito solicitar <strong><?php calcula_fecha(216,$_REQUEST['iddoc']);?></strong>&nbsp;d&iacute;as de vacaciones, los cuales disfrutar&eacute; iniciando&nbsp;<strong><?php fecha_in_vacaciones(216,$_REQUEST['iddoc']);?></strong>&nbsp; y terminando el&nbsp;<strong><?php fecha_fn_vacaciones(216,$_REQUEST['iddoc']);?>, </strong>en este sentido, estar&eacute; reiniciando a mis labores el d&iacute;a <strong><?php fecha_inic_labores(216,$_REQUEST['iddoc']);?>.<br /><br /></strong>Agradeciendo de antemano la atenci&oacute;n prestada a esta solicitud.&nbsp; &nbsp; </p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Elaboro: <?php nombre_empleado(216,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;<?php mostrar_estado_proceso(216,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>