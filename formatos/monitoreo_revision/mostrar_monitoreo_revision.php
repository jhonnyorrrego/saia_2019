<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><?php include_once("../seguimiento_plan_mejoramiento/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;<?php editar_documento_responsable_direccion_control_interno(435,$_REQUEST['iddoc']);?></p>
<table style="border-collapse: collapse;" border="1">
<tbody>
<tr>
<td class="encabezado">FECHA</td>
<td style="width: 350px;">&nbsp;<?php mostrar_valor_campo('fecha_monitoreo',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">RIESGO Nro</td>
<td>&nbsp;<?php mostrar_valor_campo('numero_riesgo',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">NOMBRE DEL RIESGO</td>
<td>&nbsp;<?php mostrar_valor_campo('nombre_riesgo',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">SE REALIZARON CAMBIOS EN LA <strong><em>IDENTIFICACION DEL RIESGO?</em></strong></td>
<td>&nbsp;<?php mostrar_valor_campo('cambio_identificacion',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">DESCRIPCI&Oacute;N DE LOS CAMBIOS</td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion_cambio',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">SE REALIZARON CAMBIOS EN EL <strong><em>ANALISIS DEL RIESGO?</em></strong></td>
<td>&nbsp;<?php mostrar_valor_campo('cambios_analisis',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">DESCRIPCI&Oacute;N DE LOS CAMBIOS</td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion_analisis',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">SE EVALUARON LOS CONTROLES EXISTENTES?</td>
<td>&nbsp;<?php mostrar_controles_existentes_riesgo(435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">RESULTADOS DE LA EVALUACI&Oacute;N</td>
<td>&nbsp;<?php mostrar_valor_campo('resultado_evaluacion',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">SE CUMPLIERON LAS ACCIONES PROPUESTAS?</td>
<td>&nbsp;<?php mostrar_acciones_propuestas_riesgo(435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">LOGROS ALCANZADOS Y/O OBSERVACIONES</td>
<td>&nbsp;<?php mostrar_valor_campo('logros_alcanzados',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">SE IMPLEMENTARON NUEVOS CONTROLES?</td>
<td>&nbsp;<?php mostrar_valor_campo('controles_nuevos',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">DESCRIPCI&Oacute;N DEL NUEVO(S) CONTROL(ES)</td>
<td>&nbsp;<?php mostrar_valor_campo('descripcion_ncontrol',435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">EVIDENCIA(S) DOCUMENTAL</td>
<td><?php mostrar_anexos_memo(435,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">OBSERVACIONES GENERALES</td>
<td><?php mostrar_valor_campo('observaciones_generales',435,$_REQUEST['iddoc']);?>&nbsp;</td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(435,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>