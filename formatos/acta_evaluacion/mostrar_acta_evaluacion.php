<?php include_once("../memo/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: center;">SOLICITUD DE OFERTA No <?php mostrar_valor_campo('solitud_oferta',82,$_REQUEST['iddoc']);?>&nbsp; de <?php mostrar_valor_campo('lista',82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: right;"><span style="font-size: xx-small;">Versi&oacute;n:8</span></td>
</tr>
<tr>
<td style="text-align: right;"><span style="font-size: xx-small;">Septiembre 13 de 2012</span></td>
</tr>
<tr>
<td><strong>FECHA: <?php mostrar_fecha(82,$_REQUEST['iddoc']);?></strong></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>PARTICIPANTES:</strong></td>
</tr>
<tr>
<td><?php tabla_participantes(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>1. OBJETO</strong></td>
</tr>
<tr>
<td><?php tabla_objeto_contratacion(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>2. ANTECEDENTES</strong></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="text-align: left; border: 1px solid #000000;">La Empresa de Acueducto y Alcantarillado de Pereira S.A. E.S.P, realiz&oacute; por correo certificado la solicitud de oferta No <?php mostrar_valor_campo('solitud_oferta',82,$_REQUEST['iddoc']);?> de <?php ano_actual(82,$_REQUEST['iddoc']);?> as&iacute;:</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>EMPRESAS INVITADAS</strong>: <?php llenar_empresas(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>3. ASPECTOS T&Eacute;CNICOS: </strong><?php llenar_aspectos_tecnicos(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left; border: 1px solid #000000;"><?php aspectos_tecnicos_objeto(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php conclusion_tecnica_objeto(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>4. ASPECTOS ECON&Oacute;MICOS: </strong><?php llenar_aspectos_economicos(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left; border: 1px solid #000000;"><?php aspectos_economicos_objeto(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php conclusion_economicos_objeto(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>5. ASPECTOS JUR&Iacute;DICOS: </strong><?php llenar_aspectos_juridicos(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="text-align: left; border: 1px solid #000000;"><?php aspectos_juridicos_objeto(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><?php conclusion_juridicos_objeto(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><strong>6. RECOMENDACI&Oacute;N DE ADJUDICACI&Oacute;N</strong> <?php validar_llenado_creador(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>El Comit&eacute; Evaluador, apoyado en la Evaluaci&oacute;n T&eacute;cnica, Econ&oacute;mica y Jur&iacute;dica recomienda que:</td>
</tr>
<tr>
<td style="text-align: left; border: 1px solid #000000;"><?php ver_recomendacion(82,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 30%;">Forma de pago:</td>
<td style="text-align: left; border: 1px solid #000000;"><?php mostrar_valor_campo('forma_pago',82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Plazo:</td>
<td style="text-align: left; border: 1px solid #000000;"><?php mostrar_valor_campo('plazo',82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Valor:</td>
<td style="text-align: left; border: 1px solid #000000;"><?php tabla_empresas_invitadas(82,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>Interventor:</td>
<td style="text-align: left; border: 1px solid #000000;"><?php tabla_forma_pago(82,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php tabla_firmas(82,$_REQUEST['iddoc']);?></p>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td>&nbsp;</td>
<td style="text-align: right;"><span style="font-size: xx-small;">A-GL-AC-R04</span></td>
</tr>
</tbody>
</table>
<p><?php mensaje_empresa(82,$_REQUEST['iddoc']);?> <br /><?php validar_llenado_clientes(82,$_REQUEST['iddoc']);?></p>
<p>&nbsp;</p></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>