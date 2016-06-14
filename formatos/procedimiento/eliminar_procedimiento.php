<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><?php $idformato=2 ?><?php include_once("../librerias/funciones_archivo.php"); ?><script type="text/javascript" src="../librerias/funciones_formatos.js"></script><?php include_once("funciones.php"); ?><?php include_once("../proceso/funciones.php"); ?><?php include_once("../librerias/funciones_eliminar.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td  class="encabezado" style="width: 30%; border: windowtext 0.5pt solid;" valign="top">Objetivo:</td>
<td  class="phpmaker" style="width: 70%; border: windowtext 0.5pt solid;" valign="top"><?php mostrar_valor_campo('objetivo',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Alcances:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('alcance',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Definiciones:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('definicion',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; text-align: center;" colspan="2"><?php listar_pasos_procedimiento(2,$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table border="1" width="100%" cellspacing="0" class="tabla_borde">
<tbody>
<tr>
<td  style=" border: windowtext 0.5pt solid; " colspan="2">DISPOSICIONES GENERALES:<br /><?php mostrar_valor_campo('dispocisiones_generales',2,$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  style=" border: windowtext 0.5pt solid; " colspan="2">Anexos Digitales:<br /><?php listar_anexos('183','2',$_REQUEST['iddoc'],0); ?></td>
</tr>
<tr>
<td  style=" border: windowtext 0.5pt solid; " colspan="2">Aprob&oacute;:<br /><?php aprobacion(2,$_REQUEST['iddoc']);?></td>
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