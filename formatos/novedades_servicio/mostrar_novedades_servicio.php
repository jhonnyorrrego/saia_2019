<?php include_once("../carta/funciones.php"); ?><?php include_once("../carta_responde_pqr/funciones.php"); ?><?php include_once("../solicitud_servicio/../../pantallas/qr/librerias.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; ; width: 100%;" border="0">
<tbody>
<tr>
<td><?php ciudad(270,$_REQUEST['iddoc']);?>, <?php mostrar_fecha(270,$_REQUEST['iddoc']);?></td>
<td style="text-align: right;">&nbsp;<?php mostrar_radicado_novedad(270,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<table style="; width: 100%; font-size: 10pt; font-family: arial;" border="0" cellspacing="0">
<tbody>
<tr>
<td><br /><br /><br /><br /><?php mostrar_destinos(270,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><br />Asunto: <?php mostrar_asunto_carta(270,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><br /><br />Cordial Saludo:&nbsp;</td>
</tr>
<tr>
<td style="text-align: justify;"><br />Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br /><br /><?php mostrar_informacion_verificacion(270,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><br /><br />Atentamente,&nbsp;</td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; ; width: 100%;" border="0">
<tbody>
<tr>
<td><?php mostrar_estado_proceso(270,$_REQUEST['iddoc']);?></td>
<td style="text-align: right;"><span><?php mostrar_codigo_qr(270,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td colspan="2"><span><?php mostrar_anexos_ext(270,$_REQUEST['iddoc']);?><?php tamanio_texto_anexos(270,$_REQUEST['iddoc']);?><?php mostrar_copias_comunicacion(270,$_REQUEST['iddoc']);?><span>Transcriptor: <?php mostrar_valor_campo('iniciales',270,$_REQUEST['iddoc']);?></span></span></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>