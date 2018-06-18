<?php include_once("../../librerias_saia.php"); ?><?php echo(librerias_jquery('1.7')); ?><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../class_transferencia.php"); ?><?php include_once("../carta/../librerias/funciones_generales.php"); ?><?php include_once("../carta/../librerias/encabezado_pie_pagina.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../../formatos/librerias/header_nuevo.php"); ?><tr><td><table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="text-align: left;" colspan="4"><span>Fecha de creaci&oacute;n: <?php mostrar_fecha(487,$_REQUEST['iddoc']);?><?php cargar_info_indicador(487,$_REQUEST['iddoc']);?></span></td>
</tr>
<tr>
<td class="encabezado" style="text-align: left;">Dependencia:</td>
<td style="text-align: left;"><?php mostrar_valor_campo('dependencia_indicador',487,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Proceso:</td>
<td style="text-align: left;"><?php nombre_padre(487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Nombre Indicador:</td>
<td style="text-align: left;"><?php mostrar_valor_campo('nombre',487,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Fuente de Datos:</td>
<td style="text-align: left;"><?php mostrar_valor_campo('fuente_datos',487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Objetivo de Calidad:</td>
<td style="text-align: left;"><?php mostrar_valor_campo('objetivo_calidad_indicador',487,$_REQUEST['iddoc']);?></td>
<td class="encabezado">Responsable del an&aacute;lisis:</td>
<td style="text-align: left;"><?php mostrar_valor_campo('responsable_analisis',487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Tipo Indicador</td>
<td style="text-align: left;"><?php mostrar_valor_campo('tipo_indicador',487,$_REQUEST['iddoc']);?></td>
<td class="encabezado">&nbsp;Estado Indicador:</td>
<td style="text-align: left;">&nbsp;<?php estado_indicador(487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;" colspan="4"><?php formula_calculo(487,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td colspan="4">&nbsp;</td>
</tr>
<tr>
<td style="text-align: center;" colspan="4"><?php resultados_indicador(487,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../../formatos/librerias/footer_nuevo.php"); ?>