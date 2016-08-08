<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><?php $idformato=22 ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_eliminar.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td  class="encabezado_list" style=" border: windowtext 0.5pt solid; " colspan="18" valign="top">
<div style="text-align: center;"><strong>PLAN DE MEJORAMIENTO&nbsp; <?php mostrar_valor_campo('tipo_plan',22,$_REQUEST['iddoc']);?></strong></div>
</td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="3" valign="top">
<div>Fecha de Suscripci&oacute;n:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="4"><?php mostrar_valor_campo('fecha_suscripcion',22,$_REQUEST['iddoc']);?></td>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="2" valign="top">
<div>Tipo de Auditor&iacute;a:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="5"><?php mostrar_valor_campo('tipo_auditoria',22,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="3" valign="top">
<div>Objetivo:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="4"><?php mostrar_valor_campo('objetivo',22,$_REQUEST['iddoc']);?></td>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="2" valign="top">
<div>Descripci&oacute;n:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="5"><?php mostrar_valor_campo('descripcion',22,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="3" valign="top">
<div>Objetivos Espec&iacute;ficos:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="4"><?php mostrar_valor_campo('objetivos_especificos',22,$_REQUEST['iddoc']);?></td>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="2" valign="top">
<div>Fecha Recepci&oacute;n Informe Final:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="5"><?php mostrar_valor_campo('fecha_informe',22,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="3" valign="top">
<div>Observaciones:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="4"><?php mostrar_valor_campo('observaciones',22,$_REQUEST['iddoc']);?></td>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="2" valign="top">
<div>Per&iacute;odo Evaluado:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="5"><?php mostrar_valor_campo('periodo_evaluado',22,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php listar_hallazgo_plan_mejoramiento(22,$_REQUEST['iddoc']);?><!--CTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//E--></p>
<table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td  class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">
<div>Elaborado por:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="3">
<div><?php estado_elaborado(22,$_REQUEST['iddoc']);?></div>
</td>
<td  class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">
<div>Revisado Por:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="3">
<div><?php estado_revisado(22,$_REQUEST['iddoc']);?></div>
</td>
<td  class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">
<div>Aprobado Por:</div>
</td>
<td  style=" border: windowtext 0.5pt solid; " colspan="3">
<div><?php estado_aprobado(22,$_REQUEST['iddoc']);?></div>
</td>
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