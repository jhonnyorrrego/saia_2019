<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><?php $idformato=1 ?><?php include_once("../librerias/funciones_archivo.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_eliminar.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../app/documento/class_transferencia.php"); ?><tr><td><table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;">Responsable</td>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" colspan="2"><?php mostrar_seleccionados(1,8,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;">L&iacute;der</td>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" colspan="2"><?php mostrar_seleccionados(1,5,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;">Objetivo</td>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" colspan="2"><?php mostrar_valor_campo('objetivo',1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;">Alcance</td>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" colspan="2"><?php mostrar_valor_campo('alcance',1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;">Secretarias participantes:</td>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" colspan="2"><?php mostrar_seleccionados(1,9,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; text-align: center;" colspan="3"><?php actividades_proceso(1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style="text-align: center; border: windowtext 0.5pt solid;" colspan="6"><strong>CONTROLES DEL PROCESO</strong></td>
</tr>
<tr>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; text-align: center;" colspan="3"><?php listar_control_proceso(1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style="text-align: center; border: windowtext 0.5pt solid;"><strong>Soporte legal (normatividad&nbsp; y documentos de consulta)</strong></td>
<td  class="encabezado" style="text-align: center; border: windowtext 0.5pt solid;"><strong>Riesgos del Proceso</strong></td>
<td  class="encabezado" style="text-align: center; border: windowtext 0.5pt solid;"><strong>Listados Maestros</strong></td>
</tr>
<tr>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" rowspan="2"><?php enlace_normograma(1,$_REQUEST['iddoc']);?></td>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" rowspan="2"><?php enlace_riesgos(1,$_REQUEST['iddoc']);?></td>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;"><?php listar_anexos('181','1',$_REQUEST['iddoc'],0); ?><br /></td>
</tr>
<tr>
<td  style=" border: windowtext 0.5pt solid; "><?php listar_anexos('182','1',$_REQUEST['iddoc'],0); ?></td>
</tr>
<tr>
<td  class="encabezado_list" style=" border: windowtext 0.5pt solid; " colspan="3" valign="top">Politicas de Operacion de Proceso</td>
</tr>
<tr>
<td  style=" border: windowtext 0.5pt solid; text-align: center;" colspan="3">&nbsp;<?php listar_politicas_proceso(1,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" colspan="3">Anexos: <br /><?php listar_anexos('29','1',$_REQUEST['iddoc'],0); ?></td>
</tr>
<tr>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" colspan="3">Aprob&oacute;:</td>
</tr>
<tr>
<td  class="celda_transparente" style=" border: windowtext 0.5pt solid; border: #000000 1px solid;" colspan="3"><?php aprobacion(1,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><tr>
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