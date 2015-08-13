<?php include_once("../memo/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../anexos_hoja_vida/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="width: 100%;" border="0" cellspacing="0">
<tbody>
<tr>
<td colspan="2">
<p style="text-align: center;" align="center">&nbsp;</p>
<p style="text-align: center;" align="center"><strong>CERTIFICADO DE VERTIMIENTOS&nbsp;DE DESECHOS LIQUIDOS AL SISTEMA DE ALCANTARILLADO MUNICIPAL</strong></p>
<p style="text-align: center;" align="center">&nbsp;</p>
</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p style="text-align: center;"><strong>La empresa de Acueducto y Alcantarillado de Pereira S.A. E.S.P.</strong></p>
<p style="text-align: center;">&nbsp;</p>
</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;" colspan="2">
<p><strong>CERTIFICA QUE:</strong></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="width: 25%;" valign="top"><strong>La Firma:</strong></td>
<td valign="top"><?php mostrar_valor_campo('nombre',68,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><strong>Ubicada en:</strong></td>
<td valign="top"><?php mostrar_valor_campo('direccion',68,$_REQUEST['iddoc']);?> </td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><strong>Cuya Actividad Econ&oacute;mica es:</strong></td>
<td valign="top"><?php mostrar_valor_campo('actividad',68,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td><strong>C&oacute;digo CIIU:</strong></td>
<td>
<p><?php mostrar_valor_campo('codigo_ciiu',68,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td>
<p>&nbsp;</p>
<p><strong>Descripci&oacute;n:</strong></p>
</td>
<td>
<p>&nbsp;</p>
<p><?php mostrar_valor_campo('descripcion',68,$_REQUEST['iddoc']);?></p>
</td>
</tr>
<tr>
<td colspan="2">
<p style="text-align: justify;"><br />Ha cumplido hasta la fecha con&nbsp; los requerimientos trazados por el Programa de Control de vertimientos de la Empresa, los cuales evidencian que las descargas provenientes de la actividad econ&oacute;mica descrita, est&aacute;n dentro de los par&aacute;metros t&eacute;cnicos establecidos por las normas nacionales vigentes.</p>
<p style="text-align: justify;">Este Certificado no excluye al establecimiento en menci&oacute;n, de la obligaci&oacute;n de participar en las etapas subsiguientes al programa y de otros requisitos que diferentes entidades puedan solicitarle; si se incumple con los requerimientos establecidos,&nbsp;podr&aacute; ser revocado y, adem&aacute;s, ser&aacute; reportado ante la autoridad ambiental competente.</p>
<p>Se expide en Pereira, el <?php mostrar_fecha(68,$_REQUEST['iddoc']);?>.</p>
<p>Vence el <?php mostrar_vencimiento(68,$_REQUEST['iddoc']);?>.</p>
</td>
</tr>
<tr>
<td colspan="2"><?php mostrar_estado_proceso(68,$_REQUEST['iddoc'],'mostrar_'.$_REQUEST['plantilla'],$_REQUEST['iddoc']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
</tr>
<tr>
<td colspan="2"><span style="font-size: x-small;"><br />Elabor&oacute;: <?php mostrar_valor_campo('iniciales',68,$_REQUEST['iddoc']);?></span></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>