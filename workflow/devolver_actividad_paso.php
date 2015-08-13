<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
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
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");

?>
<script type="text/javascript" src="../ew.js"></script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) { 
  return(true); 
  if (EW_this.observacion_devolucion && !EW_hasValue(EW_this.observacion_devolucion, "TEXTAREA" )) {
  if (!EW_onError(EW_this, EW_this.observacion_devolucion, "TEXTAREA", "Por favor ingrese los campos requeridos - Observaciones Devoluci&oacute;"))
    return false;
}
return true;
}
//-->
</script>
<?php
$paso_instancia_terminada=busca_filtro_tabla("","paso_instancia_terminada A, paso_actividad B","A.paso_actividad_idpaso_actividad=B.idpaso_actividad AND  idpaso_instancia=".$_REQUEST["idpaso_instancia_terminada"] ,"",$conn);



//print_r($paso_instancia_terminada);
if(@$_REQUEST["accion"]=="devolver"){
  $observaciones=$_REQUEST["x_notas"];
  //Accciones que se deben realizar al devolver el paso
  devolver_actividad_paso($paso_instancia_terminada[0]["idpaso_instancia"],$paso_instancia_terminada[0]["estado_actividad"],$observaciones,$_REQUEST["idpaso_documento"],1);

  abrir_url("mapeo_diagrama.php?idpaso_documento=".$_REQUEST["idpaso_documento"],"centro");

}
menu_pasos(0,$_REQUEST["idpaso_documento"]);
//estado paso documento = 7 para devuelto
//Se verifica que el paso este devuelto o que sea el ultimo paso realizado.
$texto='<br><form name="formulario_devolver_paso" id="formulario_devolver_paso" action="devolver_actividad_paso.php" method="post" onSubmit="return EW_checkMyForm(this);">';
$texto.='<table width="95%">';
$texto.='<tr><td class="encabezado" colspan="2">Devoluci&oacute;n '.$paso_instancia_terminada[0]["descripcion"].'</td></tr>';
$texto.='<tr><td class="encabezado">Observaci&oacute;n de la Devoluci&oacute;n*</td><td><textarea name="x_notas" id="observacion_devolucion" cols="40" rows=5></textarea></td></tr>';
$texto.='<tr><td colpan="2"> <input type="hidden" name="accion" value="devolver"> 
<input type="hidden" name="idpaso_instancia_terminada" value="'.$_REQUEST["idpaso_instancia_terminada"].'">
<input type="hidden" name="idpaso_documento" value="'.$_REQUEST["idpaso_documento"].'">
<input type="submit" value="DEVOLVER"></td></tr>';
$texto.='</form></table>';
echo($texto);
?>