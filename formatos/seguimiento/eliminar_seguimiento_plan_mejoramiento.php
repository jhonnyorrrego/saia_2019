<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><?php $idformato=24 ?><?php include_once("../hallazgo/funciones.php"); ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_eliminar.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p>&nbsp;</p>
<table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Fecha</td>
<td   class="celda_transparente" style="border: windowtext 0.5pt solid;" valign="top"><?php fecha_documento(24,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Porcentaje de Avance</td>
<td   class="celda_transparente" style="border: windowtext 0.5pt solid;" valign="top"><?php mostrar_valor_campo('porcentaje',24,$_REQUEST['iddoc']);?> %</td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Logros alcanzados</td>
<td   class="celda_transparente" style="border: windowtext 0.5pt solid;" valign="top"><?php mostrar_valor_campo('logros_alcanzados',24,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td   class="encabezado" style="border: windowtext 0.5pt solid;" valign="top">Observaciones</td>
<td   class="celda_transparente" style="border: windowtext 0.5pt solid;" valign="top"><?php mostrar_valor_campo('observaciones',24,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p><?php mostrar_estado_proceso(24,$_REQUEST['iddoc']);?></p></td></tr><tr>
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