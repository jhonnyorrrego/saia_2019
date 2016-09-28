<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");


$idformato_riesgos_proceso=busca_filtro_tabla("idformato","formato","nombre='riesgos_proceso'","",$conn);
$campo_area_responsable=busca_filtro_tabla("idcampos_formato","campos_formato","nombre='area_responsable' AND formato_idformato=".$idformato_riesgos_proceso[0]['idformato'],"",$conn);
$campo_responsables=busca_filtro_tabla("idcampos_formato","campos_formato","nombre='responsables' AND formato_idformato=".$idformato_riesgos_proceso[0]['idformato'],"",$conn);
?>


<link type="text/css" rel="stylesheet" media="screen" href="../librerias/estilo.css"><?php $idformato=$idformato_riesgos_proceso[0]['idformato'] ?><?php include_once("funciones.php"); ?><?php include_once("../librerias/funciones_eliminar.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><table border="1" width="100%" cellspacing="0" class="tabla_borde">
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
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_seleccionados($idformato_riesgos_proceso[0]['idformato'],$campo_area_responsable[0]['idcampos_formato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Descripcion:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('descripcion',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Fuente/causa:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('fuente_causa',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Consecuencia:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('consecuencia',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Controles Existentes:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('controles',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Probabilidad:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('probabilidad',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Impacto:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('impacto',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td style=" border: windowtext 0.5pt solid; "  class="encabezado">Da&ntilde;o</td>
<td style=" border: windowtext 0.5pt solid; "  class="phpmaker"><?php danio_riesgo($idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; " colspan="2">Pol&iacute;ticas de Administracion del Riesgo:</td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Opciones de manejo:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('opciones_manejo',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Acciones:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('acciones',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Responsables:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_seleccionados($idformato_riesgos_proceso[0]['idformato'],$campo_responsables[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Cronograma:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('cronograma',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td  class="encabezado" style=" border: windowtext 0.5pt solid; ">Indicador:</td>
<td  class="phpmaker" style=" border: windowtext 0.5pt solid; "><?php mostrar_valor_campo('indicador',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table>
<p>&nbsp;<?php mostrar_estado_proceso($idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></p></td></tr><tr>
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