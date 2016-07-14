<?php include_once("../carta/funciones.php"); ?><?php include_once("../pqr/funciones.php"); ?><?php include_once("../experiencia_laboral/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="text-align: center; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: left; font-size: 11pt;" colspan="2"><span>Fecha de creaci&oacute;n: <?php mostrar_fecha(385,$_REQUEST['iddoc']);?></span></td>
<td style="text-align: left;">&nbsp;</td>
<td class="phpmaker" style="text-align: left;">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">&nbsp;</td>
<td style="text-align: left;">&nbsp;</td>
<td class="phpmaker" style="text-align: left;">&nbsp;</td>
</tr>
<tr>
<td class="encabezado" style="text-align: left;">Dependencia:</td>
<td class="phpmaker" style="text-align: left;"><?php mostrar_valor_campo('dependencia_indicador',385,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Proceso:</td>
<td class="phpmaker" style="text-align: left;"><?php nombre_padre(385,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Nombre Indicador:</td>
<td class="phpmaker" style="text-align: left;"><?php mostrar_valor_campo('nombre',385,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Fuente de Datos:</td>
<td class="phpmaker" style="text-align: left;"><?php mostrar_valor_campo('fuente_datos',385,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Objetivo de Calidad:</td>
<td class="phpmaker" style="text-align: left;"><?php mostrar_valor_campo('objetivo_calidad_indicador',385,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Objetivo del Indicador:</td>
<td class="phpmaker" style="text-align: left;"><?php mostrar_valor_campo('objetivo_indicador',385,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" style="text-align: left;" valign="top">Responsable del an&aacute;lisis</td>
<td class="phpmaker" style="text-align: left;" valign="middle"><?php mostrar_valor_campo('responsable_analisis',385,$_REQUEST['iddoc']);?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td class="phpmaker" style="text-align: center;" colspan="4"><?php formula_calculo(385,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="phpmaker" style="text-align: center;" colspan="4"><?php resultados_indicador(385,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>