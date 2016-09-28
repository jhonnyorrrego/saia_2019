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

?>

<?php include_once("funciones_1.php"); ?><?php include_once("../memorando/funciones.php"); ?><?php include_once("../librerias/funciones_generales.php"); ?><script type="text/javascript" src="../../js/jquery.js"></script><?php include_once("../librerias/header_nuevo.php"); ?><?php include_once("../../class_transferencia.php"); ?><tr><td><p style="text-align: center;"><?php mostrar_valor_campo('identificacion_riesgo',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></p>
<p></p>
<table style="border-collapse: collapse; width: 100%;" border="1" cellspacing="0">
<tbody>
<tr>
<td class="encabezado" colspan="2">Evaluacion y Valoracion del Riesgo</td>
</tr>
<tr>
<td class="encabezado" valign="top">N&uacute;mero:</td>
<td><?php mostrar_valor_campo('consecutivo',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" valign="top">Estado:</td>
<td><?php mostrar_valor_campo('estado',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Actividad:</td>
<td><?php mostrar_valor_campo('nombre',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Area Responsable:</td>
<td><?php mostrar_valor_campo('area_responsable',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Descripci&oacute;n del riesgo:</td>
<td><?php mostrar_valor_campo('descripcion',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Fuente/causa:</td>
<td><?php mostrar_valor_campo('fuente_causa',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Consecuencia o Efecto:</td>
<td><?php mostrar_valor_campo('consecuencia',$idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Controles Existentes:</td>
<td><?php controles_funcion($idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Probabilidad:</td>
<td><?php probabilidad_nueva($idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Impacto:</td>
<td><?php impacto_nuevo($idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado">Da&ntilde;o</td>
<td><?php danio_riesgo($idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
<tr>
<td class="encabezado" colspan="2">Pol&iacute;ticas de Administracion del Riesgo:</td>
</tr>
<tr>
<td colspan="2"><?php ultimas_politicas($idformato_riesgos_proceso[0]['idformato'],$_REQUEST['iddoc']);?></td>
</tr>
</tbody>
</table></td></tr><?php include_once("../librerias/footer_nuevo.php"); ?>