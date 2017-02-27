<?php
include_once("../header.php");
include_once("librerias/funciones_acciones.php");

$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

?>
<!--script type="text/javascript" src="../js/jquery.js"></script-->
<!--script type="text/javascript" src="../js/jquery.validate.js"></script-->
<!--script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#asignar_funcion_formato').validate();
	
});
</script-->
<?php
if(@$_REQUEST["adicionar"]==1){
	if(adicionar_funciones_accion(@$_REQUEST["acciones"],@$_REQUEST["idformato"],@$_REQUEST["funciones"],@$_REQUEST["momento"],@$_REQUEST["estado"])){
    alerta("Asignacion realizada Correctamente");
  }
  else alerta("Problemas al realizar la asignacion");
}
else if(@$_REQUEST["editar"]==1 && @$_REQUEST["idformato"]){
	//print_r($_REQUEST);die();
  if(modificar_funciones_accion(@$_REQUEST["acciones"],@$_REQUEST["idformato"],@$_REQUEST["funciones"],@$_REQUEST["momento"],@$_REQUEST["estado"],@$_REQUEST["idaccion_funcion"])){
    alerta("Asignacion Editada Correctamente");
  }
  else alerta("Problemas al editar la asignacion");
}
else if(@$_REQUEST["eliminar"]==1 && @$_REQUEST["idformato"]){
  if(eliminar_funciones_accion(@$_REQUEST["acciones"],@$_REQUEST["idformato"],@$_REQUEST["funciones"],@$_REQUEST["momento"],@$_REQUEST["estado"],@$_REQUEST["idaccion_funcion"])){
    alerta("Asignacion eliminada Correctamente");
    redirecciona("asignar_funciones.php?idformato=".$_REQUEST["idformato"]);
  }
  else alerta("Problemas al eliminar la funcion");
}

if(@$_REQUEST["idformato"]){
  $texto='<br /><br /><div align="center">';
  if(@$_REQUEST["accion_ejecutar"]==1){
    $texto.="<b>EDITANDO ASIGNACION<br /><br /></b>";
  }
  else if(@$_REQUEST["accion_ejecutar"]==2){
    $texto.="<b>ELIMINANDO ASIGNACION<br /><br /></b>";
  }
  else {
    $texto.="<b>ASIGNANDO<br /><br /></b>";
  }
  $texto.='<form method="POST" name="asignar_funcion_formato" id="asignar_funcion_formato"><table style="border-collapse:collapse;" border="1px" width="100%">';
  $idformato=$_REQUEST["idformato"];
  $lacciones=busca_filtro_tabla("","accion","","",$conn);

  $lfunciones=busca_filtro_tabla("","funciones_formato A","(A.formato LIKE '".$idformato."' OR A.formato LIKE '%,".$idformato.",%' OR A.formato LIKE '%,".$idformato."' OR A.formato LIKE '".$idformato.",%') and nombre_funcion<>'transferencia_automatica'","",$conn);
  $accion_formato=0;
  if(@$_REQUEST["accion_funcion"]){
    $accion_formato=$_REQUEST["accion_funcion"];
  }
  $accion_funcion=busca_filtro_tabla("","funciones_formato_accion","idfunciones_formato_accion=".$accion_formato,"",$conn);
  //print_r($lfunciones["numcampos"]."#".$lacciones["numcampos"]);die();
  if($lfunciones["numcampos"] && $lacciones["numcampos"]){
    $texto.='<tr><td class="encabezado" title="Listado de funciones que se encuentran disponibles para el formato, si desea agregar una función debe adicionarla al formato directamente" >Funciones disponibles para el formato *: </td><td class="celda_normal"><select name="funciones" id="funciones"><option value="">Seleccione...</option>';
    for($i=0;$i<$lfunciones["numcampos"];$i++){
      $texto.='<option value="'.$lfunciones[$i]["idfunciones_formato"].'"';
      if($accion_funcion["numcampos"] && $accion_funcion[0]["idfunciones_formato"]== $lfunciones[$i]["idfunciones_formato"])
        $texto.=" SELECTED ";
      $texto.='>'.delimita($lfunciones[$i]["etiqueta"]." (".$lfunciones[$i]["nombre_funcion"],50).')</option>';
    }
    $texto.='</select></td></tr>';
    $texto.='<tr><td class="encabezado" title="momento en que se debe realizar la accion">Momento *: </td><td class="celda_normal"><input type="radio" name="momento" id="momento" value="ANTERIOR" ';
    if($accion_funcion["numcampos"] && $accion_funcion[0]["momento"]== "ANTERIOR")
        $texto.=" CHECKED ";
    $texto.='> ANTERIOR A &nbsp;&nbsp;&nbsp;<input type="radio" name="momento" id="momento" value="POSTERIOR" ';
    if($accion_funcion["numcampos"] && $accion_funcion[0]["momento"]== "POSTERIOR")
        $texto.=" CHECKED ";
    $texto.='> POSTERIOR A</td></tr>';
    $texto.='<tr><td class="encabezado" title="accion que se debe tener en cuenta a la hora de realizar la consulta por ejemplo: editar, adicionar, aprobar en las acciones de los scripts sse deben adicionar estas acciones, la ruta es relativa a la carpeta formato">Accion a validar: </td><td class="celda_normal"><select name="acciones" id="acciones">';
    for($i=0;$i<$lacciones["numcampos"];$i++){
      $texto.='<option value="'.$lacciones[$i]["idaccion"].'"';
      if($accion_funcion["numcampos"] && $accion_funcion[0]["accion_idaccion"]== $lfunciones[$i]["idaccion"])
        $texto.=" SELECTED ";
      $texto.='>'.$lacciones[$i]["nombre"]." (".$lacciones[$i]["ruta"].')</option>';
    }
    $texto.='</td></tr><tr><td class="encabezado" title="Estado Actual de la asignacion que define si se debe realizar la accion o no">Estado: </td><td class="celda_normal"><input type="radio" name="estado" id="estado" value="1" ';
    if($accion_funcion["numcampos"] && $accion_funcion[0]["estado"]== 1)
      $texto.=" CHECKED ";
    $texto.='> ACTIVO &nbsp;&nbsp;&nbsp;<input type="radio" name="estado" id="estado" value="0"';
    if($accion_funcion["numcampos"] && $accion_funcion[0]["estado"]== 0)
      $texto.=" CHECKED ";
    $texto.='> INACTIVO</td></tr>';
    if(@$_REQUEST["accion_ejecutar"]==1){
      $texto.='</select><input type="hidden" name="editar" value="1"><input type="hidden" name="idformato" value="'.$_REQUEST["idformato"].'"><input type="hidden" name="idaccion_funcion" value="'.$_REQUEST["accion_funcion"].'"></td></tr>';
    }
    else if(@$_REQUEST["accion_ejecutar"]==2){
      $texto.='</select><input type="hidden" name="eliminar" value="1"><input type="hidden" name="idformato" value="'.$_REQUEST["idformato"].'"><input type="hidden" name="idaccion_funcion" value="'.$_REQUEST["accion_funcion"].'"></td></tr>';
    }
    else
      $texto.='</select><input type="hidden" name="adicionar" value="1"><input type="hidden" name="idformato" value="'.$_REQUEST["idformato"].'"></td></tr>';
    $texto.='<tr align="center"><td class="celda_normal" colspan="2"><input type="submit"> </td></tr>';
  }
  $texto.='</table></form><br />'."<div align='left'><a href='asignar_funciones.php?idformato=".$_REQUEST["idformato"]."'>ASIGNAR</a></div><br />";
}
$lasignadas=busca_filtro_tabla("A.nombre AS accion, A.ruta AS ruta_accion,B.etiqueta AS funcion, B.ruta AS ruta_funcion, C.estado AS estado_af, B.parametros,C.idfunciones_formato_accion","funciones_formato_accion C,accion A,funciones_formato B","C.accion_idaccion=A.idaccion AND B.idfunciones_formato=C.idfunciones_formato AND C.formato_idformato=".$_REQUEST["idformato"],"",$conn);
if($lasignadas["numcampos"]){
  $texto.='<table style="border-collapse:collapse;" border="1px" width="80%">';
  $texto.='<tr class="encabezado_list"><td>Accion</td><td>Ruta<br />Acci&oacute;n</td><td>Funcion</td><td>Ruta<br />Funci&oacute;n</td><td>Se ejecuta</td><td>&nbsp</td><td>&nbsp;</td></tr>';
  for($j=0;$j<$lasignadas["numcampos"];$j++){
    if($lasignadas[$j]["estado_af"]==1){
      $estado='<img src="../botones/general/mas.png" border="0px">';
    }
    else
      $estado='<img src="../botones/general/menos.png" border="0px">';
      $texto.='<tr class="celda_normal"><td>'.$lasignadas[$j]["accion"].'&nbsp;</td><td>'.$lasignadas[$j]["ruta_accion"].'&nbsp;</td><td>'.$lasignadas[$j]["funcion"].'&nbsp;</td><td>'.$lasignadas[$j]["ruta_funcion"].'&nbsp;</td><td align="center">'.$estado.'</td><td>';
    if($lasignadas[$j]["funcion"]<>"transferencia_automatica")  
      $texto.='<a href="asignar_funciones.php?idformato='.@$_REQUEST["idformato"].'&accion_ejecutar=1&accion_funcion='.$lasignadas[$j]["idfunciones_formato_accion"].'"><img src="../botones/general/editar.png" border="0px" alt="Editar"></a></td><td><a href="asignar_funciones.php?idformato='.@$_REQUEST["idformato"].'&accion_ejecutar=2&accion_funcion='.$lasignadas[$j]["idfunciones_formato_accion"].'"><img src="../botones/general/menos.png" border="0px" alt="Eliminar"></a>';
    else
     $texto.='</td><td>';   
    $texto.='</td></tr>';
  }
  $texto.='</table>';
}
echo($texto."</div>");
encriptar_sqli("asignar_funcion_formato",1,"form_info",$ruta_db_superior);
include_once("../footer.php");
?>