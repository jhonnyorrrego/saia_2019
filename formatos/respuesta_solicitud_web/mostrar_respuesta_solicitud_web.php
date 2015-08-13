<?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="0" width="100%">
<tbody>
<tr>
<td style="text-align: center;">
<p><strong>RESPUESTA<span>&nbsp; </span><?php tipo_solicitud_web(79,$_REQUEST['iddoc']);?></strong></p>
</td>
</tr>
<tr>
<td>Cordial saludo <?php nombre_persona_solicita_web(79,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br />Esta es una respuesta de seguimiento a su solicitud web <?php numero_solicitud_web(79,$_REQUEST['iddoc']);?> : <?php asunto_solicitud_web(79,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Con Fecha de solicitud: <?php fecha_solicitud_web(79,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Fecha de Respuesta:</td>
</tr>
<tr>
<td>Responsable: <?php nombre_cargo_elabora(79,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>
<p>Solicitud:<br /><?php mensaje_solicitud_web(79,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td>
<p class="MsoNormal">A lo cual respondemos:</p>
<p class="MsoNormal"><?php mostrar_valor_campo('cuerpo_respuesta',79,$_REQUEST['iddoc']);?></p>
</td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>