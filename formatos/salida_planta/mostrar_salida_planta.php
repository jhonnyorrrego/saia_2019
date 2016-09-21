<?php include_once("../carta/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../correo_saia/funciones.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="border-collapse: collapse; font-size: 10pt; width: 100%;" border="1" align="center">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="4">DATOS SOLICITANTE</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2"><strong>NOMBRE Y APELLIDO:</strong><?php mostrar_nombre_apellido_funcionario(331,$_REQUEST['iddoc']);?><br />&nbsp;</td>
<td style="text-align: left;"><strong>C&Oacute;DIGO N&Oacute;MINA:</strong><?php mostrar_codigo_nomina_funcionario(331,$_REQUEST['iddoc']);?><br />&nbsp;</td>
<td style="text-align: center;" rowspan="2"><strong>TURNO<br /></strong><?php mostrar_valor_campo('turno_datos',331,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" colspan="3"><strong>&Aacute;REA / DEPARTAMENTO:</strong><?php mostrar_cargo_dependencia_funcionario(331,$_REQUEST['iddoc']);?><br />&nbsp;</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: center;" colspan="4">DATOS ENTRADA / SALIDA</td>
</tr>
<tr>
<td style="text-align: left; width: 150px;"><strong>FECHA:</strong>&nbsp;<br /><?php mostrar_valor_campo('fecha_salida',331,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;"><strong>HORA DE SALIDA</strong>:<?php mostrar_valor_campo('hora_salida',331,$_REQUEST['iddoc']);?></td>
<td style="text-align: center;" rowspan="2"><strong>TOTAL HORAS:<br /></strong><?php total_horas(331,$_REQUEST['iddoc']);?><br /><br /><strong>FECHA Y HORA DE ENTRADA REPORTADA:</strong><?php hora_entrada_reportada(331,$_REQUEST['iddoc']);?>&nbsp;&nbsp;</td>
<td style="text-align: left;" rowspan="2"><strong>MOTIVO:</strong> <?php mostrar_valor_campo('motivo_salida',331,$_REQUEST['iddoc']);?><br /><br /></td>
</tr>
<tr>
<td style="text-align: left;"><strong>FECHA:</strong>&nbsp;<br /><?php mostrar_valor_campo('fecha_entrada',331,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;"><strong>HORA DE ENTRADA PLANEADA:</strong><?php mostrar_valor_campo('hora_entrada',331,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left;" colspan="3"><strong>OBSERVACIONES:</strong>&nbsp;<?php mostrar_valor_campo('observaciones',331,$_REQUEST['iddoc']);?></td>
<td style="text-align: left;" rowspan="3">
<p><strong>Control Interno:</strong></p>
<p><?php ver_boton_cierre(331,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p>
<p><strong><br /></strong></p>
</td>
</tr>
</tbody>
</table>
<p>C&Oacute;DIGOS: D04: LICENCIA NO REMUNERADA, P30: PERMISO SINDICAL, P31: PERMISO EPS REMUNERADO, P32: POR MATRIMONIO, P33: POR NACIMIENTO, P34: CALAMIDAD DOM&Eacute;STICA, P35: DILIGENCIA EMPRESA.</p>
<p><?php mostrar_estado_proceso(331,$_REQUEST['iddoc']);?></p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>