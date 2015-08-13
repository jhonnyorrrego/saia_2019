<?php include_once("../carta/funciones.php"); ?><?php include_once("../radicacion_entrada/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../pantallas/qr/librerias.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 20%;"><strong>N&uacute;mero de Solicitud</strong></td>
<td style="width: 25%; text-align: center;">SS-<?php formato_numero(267,$_REQUEST['iddoc']);?></td>
<td style="width: 20%;"><strong>Fecha y Hora de Solicitud</strong></td>
<td style="width: 20%;"><?php mostrar_fecha_solicitud(267,$_REQUEST['iddoc']);?></td>
<td style="width: 15%; text-align: center;" rowspan="7"><span><?php mostrar_codigo_qr(267,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><strong>Asunto</strong></td>
<td colspan="3"><?php mostrar_valor_campo('asunto_solicitud',267,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Ciudad de Origen</strong></td>
<td colspan="3"><?php mostrar_ciudad_solicitud(267,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Serie Documental</strong></td>
<td><span><?php mostrar_valor_campo('serie_idserie',267,$_REQUEST['iddoc']);?></span></td>
<td><strong>Tipo de Solicitud</strong></td>
<td><?php mostrar_valor_campo('tipo_solicitud_servi',267,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Tipo de Mercancia</strong></td>
<td><?php mostrar_valor_campo('tipo_mercancia',267,$_REQUEST['iddoc']);?></td>
<td><strong>Cantidad</strong></td>
<td><?php mostrar_valor_campo('cantidad_mercancia',267,$_REQUEST['iddoc']);?><br /><?php mostrar_valor_campo('referencia_caja',267,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><strong>Tipo de Privilegios</strong></td>
<td><?php mostrar_valor_campo('tipo_privilegios',267,$_REQUEST['iddoc']);?></td>
<td><strong>Tipo de Envio</strong></td>
<td><?php mostrar_valor_campo('tipo_envio_solicitud',267,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>Valor declarado</strong></td>
<td><?php mostrar_valor_campo('valor_declarado',267,$_REQUEST['iddoc']);?></td>
<td><strong>Peso (Kilos)</strong></td>
<td><span><?php mostrar_valor_campo('peso_envio_solicitud',267,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td><strong>Tama&ntilde;o Aproximado</strong></td>
<td><?php mostrar_valor_campo('tamanio_aproximado',267,$_REQUEST['iddoc']);?></td>
<td><strong>Requiere Recolecci&oacute;n</strong></td>
<td colspan="2"><span><?php mostrar_valor_campo('requiere_recoleccion',267,$_REQUEST['iddoc']);?></span>&nbsp;</td>
</tr>
<tr>
<td><strong>Direcci&ograve;n de Recolecci&ograve;n</strong></td>
<td><?php mostrar_valor_campo('direccion_recoleccion',267,$_REQUEST['iddoc']);?></td>
<td><strong>Fecha de Recolecci&oacute;n</strong></td>
<td colspan="2"><?php mostrar_valor_campo('fecha_recoleccion',267,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
<tr>
<td><strong>Observaciones</strong></td>
<td colspan="4"><span><?php mostrar_valor_campo('observacion_solicitud',267,$_REQUEST['iddoc']);?></span>&nbsp;</td>
</tr>
<tr>
<td><strong>Anexos Digitales</strong></td>
<td colspan="4"><span><?php mostrar_anexos(267,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; ; width: 100%;" border="0">
<tbody>
<tr>
<td><br /><br /><?php mostrar_estado_proceso(267,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><br /><?php enlaces_afiliaciones_funcion(267,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><br /><br /></p>
<p><br /><br /></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>