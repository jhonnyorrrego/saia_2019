<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><?php $idformato=20 ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/funciones_eliminar.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Fecha:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('fecha',20,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Responsable:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php datos_usuario_documento(20,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Logro:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('logro',20,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p></td></tr><tr>
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