<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><?php $idformato=19 ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_eliminar.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="2">Evaluacion y Valoracion del Riesgo</td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Actividad:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; ">{*actividad*}</td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Area Responsable:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_seleccionados(19,195,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Descripcion:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('descripcion',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Fuente/causa:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('fuente_causa',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Consecuencia:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('consecuencia',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Controles Existentes:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('controles',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Probabilidad:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('probabilidad',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Impacto:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('impacto',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style=" border: windowtext 0.5pt solid; "  class="encabezado">Da&ntilde;o</td>
<td style=" border: windowtext 0.5pt solid; "  class="phpmaker"><?php danio_riesgo(19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="2">Pol&iacute;ticas de Administracion del Riesgo:</td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Opciones de manejo:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('opciones_manejo',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Acciones:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('acciones',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Responsables:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_seleccionados(19,205,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Cronograma:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('cronograma',19,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Indicador:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('indicador',19,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php mostrar_estado_proceso(19,$_REQUEST['iddoc']);?></p></td></tr><tr>
                <td>
                  <form action="../librerias/funciones_eliminar.php" method="post"><input type="hidden" name="ejecutar" value="1">
                    <input type="hidden" name="ejecutar" value="1">
                    <input type="hidden" name="idformato" value="<?php echo(@$_REQUEST["idformato"]);?>">
                    <input type="hidden" name="iddoc" value="<?php echo(@$_REQUEST["iddoc"]);?>">
                    <input type="hidden" name="llave" value="<?php echo(@$_REQUEST["llave"]);?>">
                    <input type="submit" value="Confirmar Borrado">
                  </form>
                </td>
              </tr>
              <tr><?php include_once("../librerias/footer.php"); ?>