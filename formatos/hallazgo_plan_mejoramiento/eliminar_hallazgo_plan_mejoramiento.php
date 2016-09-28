<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><?php $idformato=23 ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_eliminar.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><div><br />
<table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td   class="encabezado" style="text-align: left; border: windowtext 0.5pt solid;" valign="top">Clase de Observaci&oacute;n</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('clase_observacion',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Deficiencia</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('deficiencia',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Causas</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('causas',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">secretarias Vinculadas</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_seleccionados(23,260,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Procesos Involucrados</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('procesos_vinculados',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Acci&oacute;n de Mejoramiento</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('accion_mejoramiento',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Responsables de Mejoramiento</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_seleccionados(23,259,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Tiempo Programado Para Cumplimiento</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('tiempo_programado_cumplimiento',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Mecanismo de Seguimiento Interno</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('mecanismo_seguimiento_interno',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Tiempo Programado Para Seguimiento</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('tiempo_programado_seguimiento',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Responsable del Seguimiento</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; ">&nbsp;<?php mostrar_seleccionados(23,258,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Indicador de Acci&oacute;n de Cumplimiento</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('indicador_accion_cumplimiento',23,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Observaciones</td>
<td   class="celda_transparente" style=" border: windowtext 0.5pt solid; " colspan="2">&nbsp;<?php mostrar_valor_campo('observaciones',23,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
</div>
<p><?php mostrar_estado_proceso(23,$_REQUEST['iddoc']);?></p></td></tr><tr>
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