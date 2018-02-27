<?php include_once("../carta/funciones.php"); ?><?php include_once("../transferencia_doc/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table style="text-align: center; width: 100%; font-size: 10pt;" border="0">
<tbody>
<tr>
<td style="text-align: left; font-size: 10pt;" colspan="2"><span>Fecha de creaci&oacute;n: <?php mostrar_fecha(487,$_REQUEST['iddoc']);?></span></td>
<td style="text-align: left;">&nbsp;</td>
<td class="phpmaker" style="text-align: left;">&nbsp;</td>
</tr>
<tr>
<td style="text-align: left;" colspan="2">&nbsp;</td>
<td style="text-align: left;">&nbsp;</td>
<td class="phpmaker" style="text-align: left;">&nbsp;</td>
</tr>
<tr>
<td class="encabezado" style="text-align: left; font-size: 10pt; margin: 5px;">Dependencia:</td>
<td class="phpmaker" style="text-align: left; font-size: 10pt;"><?php mostrar_valor_campo('dependencia_indicador',487,$_REQUEST['iddoc']);?></td>
<td class="encabezado" style="font-size: 10pt;">Proceso:</td>
<td class="phpmaker" style="text-align: left; font-size: 10pt;"><?php nombre_padre(487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="font-size: 1pt; height: 1px;" colspan="4">&nbsp;</td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt;">Nombre Indicador:</td>
<td class="phpmaker" style="text-align: left; font-size: 10pt;"><?php mostrar_valor_campo('nombre',487,$_REQUEST['iddoc']);?></td>
<td class="encabezado" style="font-size: 10pt;">Fuente de Datos:</td>
<td class="phpmaker" style="text-align: left; font-size: 10pt;"><?php mostrar_fuente_datos(487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="font-size: 1pt; height: 1px;" colspan="4">&nbsp;</td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt;">Objetivo de Calidad:</td>
<td class="phpmaker" style="text-align: left; font-size: 10pt;"><?php mostrar_objetivo_calidad_indicador(487,$_REQUEST['iddoc']);?></td>
<td class="encabezado" style="font-size: 10pt;">Responsable del an&aacute;lisis:</td>
<td class="phpmaker" style="text-align: left; font-size: 10pt;"><?php mostrar_valor_campo('responsable_analisis',487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="font-size: 1pt; height: 1px;" colspan="4">&nbsp;</td>
</tr>
<tr>
<td class="encabezado" style="font-size: 10pt;">Tipo Indicador</td>
<td class="phpmaker" style="text-align: left; font-size: 10pt;"><?php mostrar_valor_campo('tipo_indicador',487,$_REQUEST['iddoc']);?></td>
<td style="font-size: 10pt;">&nbsp;</td>
<td class="phpmaker" style="text-align: left; font-size: 10pt;">&nbsp;</td>
</tr>
<tr>
<td style="font-size: 1pt; height: 1px;" colspan="4">&nbsp;</td>
</tr>
<tr>
<td class="phpmaker" style="text-align: center; font-size: 10pt;" colspan="4"><?php formula_calculo(487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style="font-size: 1pt; height: 1px;" colspan="4">&nbsp;</td>
</tr>
<tr>
<td class="phpmaker" style="text-align: center; font-size: 10pt;" colspan="4"><?php resultados_indicador(487,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>