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
include_once($ruta_db_superior."class_transferencia.php");
?>
<script type="text/javascript" src="../ew.js"></script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) { 
  return(true); 
if (EW_this.paso_devolucion && !EW_hasValue(EW_this.paso_devolucion, "SELECT" )) {
  if (!EW_onError(EW_this, EW_this.paso_devolucion, "SELECT", "Por favor ingrese los campos requeridos - Devolver hasta"))
    return false;
}
if (EW_this.observacion_devolucion && !EW_hasValue(EW_this.observacion_devolucion, "TEXTAREA" )) {
  if (!EW_onError(EW_this, EW_this.observacion_devolucion, "TEXTAREA", "Por favor ingrese los campos requeridos - Observaciones Devoluci&oacute;"))
    return false;
}
return true;
}
//-->
</script>
<?php
$paso_documento=busca_filtro_tabla("","paso_documento A","idpaso_documento=".$_REQUEST["idpaso_documento"],"",$conn);
$pasos_flujo=busca_filtro_tabla("","paso_documento A, paso B","A.paso_idpaso=B.idpaso AND diagram_iddiagram_instance=".$paso_documento[0]["diagram_iddiagram_instance"],"A.idpaso_documento DESC",$conn);

//------------------------------

$datos = busca_filtro_tabla("","paso_documento","idpaso_documento=".$_REQUEST["idpaso_documento"],"",$conn);
$campos_devolucion = '';
$iddoc = $datos[0]["documento_iddocumento"];
$campos_devolucion .= '<input type="hidden" name="iddoc" value="'.$iddoc.'">';
$x_fecha = date("Y-m-d H:i:s");
$campos_devolucion .= '<input type="hidden" name="x_fecha" value="'.$x_fecha.'">';

//----------------------------------------------------------------------------------

$x_recibido=usuario_actual("funcionario_codigo");
  $transferencias = busca_filtro_tabla("buzon_entrada.destino","buzon_entrada","archivo_idarchivo=".$iddoc." AND origen='".$x_recibido."' AND destino<>'".$x_recibido."' and nombre in('REVISADO','TRANSFERIDO','APROBADO','DEVOLUCION') ORDER BY fecha DESC","",$conn);
  //print_r($transferencias); die();   
    if(!$transferencias["numcampos"])
    {$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
      //die($iddoc."aaa ".$_REQUEST["iddoc"]);
     echo "<script>alert('No es posible devolver el documento, por favor transfieralo o terminelo.');</script>";
     abrir_url("mapeo_diagrama.php?idpaso_documento=".$_REQUEST["idpaso_documento"],"centro");
	 die();
    }


$x_recibido=usuario_actual("funcionario_codigo");
$transferencias = busca_filtro_tabla("buzon_entrada.destino,fecha","buzon_entrada"," archivo_idarchivo='".$iddoc."' AND origen='".$x_recibido."' AND nombre in('TRANSFERIDO','REVISADO') and destino<>'".$x_recibido."' ORDER BY fecha DESC","",$conn);

	

    if($transferencias["numcampos"]==0)
    {$ruta="";   
     alerta("No existe funcionarios para devolver el documento");
     abrir_url("mapeo_diagrama.php?idpaso_documento=".$_REQUEST["idpaso_documento"],"centro");
	 die();
    }
    else
    {$funcionario_destino = busca_filtro_tabla("","funcionario","funcionario_codigo=".$transferencias[0]["destino"],"",$conn);
      //echo ucwords($funcionario_destino[0]["nombres"]." ".$funcionario_destino[0]["apellidos"])."<br><br />";
    }

//-----------------------------------------------------------------------------------
$x_funcionario_destino = $funcionario_destino[0]["funcionario_codigo"];
$campos_devolucion .= '<input type="hidden" name="x_funcionario_destino" value="'.$x_funcionario_destino.'">';
$campos_devolucion .= '<input type="hidden" name="x_nombre" value="DEVOLUCION">';
$campos_devolucion .= '<input type="hidden" name="funcion" value="devolucion">
      <input type="hidden" name="ruta_idruta" id="ruta_idruta" value="0">
      <input type="hidden" name="retornar" value="1">';


//------------------------------
if(@$_REQUEST["accion"]=="devolver"){
  //Accciones que se deben realizar al devolver el paso
  devolver_paso_documento($_REQUEST["idpaso_documento"],$_REQUEST["paso_devolucion"],$_REQUEST["x_notas"],$_REQUEST["iddiagram_instance"]);
  //devolucion();
  redirecciona("comentarios_paso.php?idpaso=".$_REQUEST["idpaso_documento"]);
}
menu_pasos(0,$_REQUEST["idpaso_documento"]);
//estado paso documento = 7 para devuelto
//Se verifica que el paso este devuelto o que sea el ultimo paso realizado.
$texto='<br><form name="formulario_devolver_paso" id="formulario_devolver_paso" action="devolver_paso.php" method="post" onSubmit="return EW_checkMyForm(this);">';
$texto.='<table width="95%">';
if($pasos_flujo["numcampos"] && ($paso_documento[0]["estado_paso_documento"]==7 || $pasos_flujo[0]["idpaso_documento"]==$paso_documento[0]["idpaso_documento"])){
  $texto.='<tr><td class="encabezado" title="Se incluir&aacute; el paso seleccionado en la devolucion poniendo todas las actividades de los pasos en modo devoluci&oacute;n y pendientes por restaurar">Devolver hasta*</td><td><select name="paso_devolucion" id="paso_devolucion">';
  for($i=1;$i<$pasos_flujo["numcampos"];$i++){
    $texto.='<option value="'.$pasos_flujo[$i]["idpaso_documento"].'"';
    if($i==1){
      $texto.=" selected ";
    }
    $texto.='>'.$pasos_flujo[$i]["nombre_paso"].'</option>';  
  }
  $texto.='</select></td></tr>';
}
$texto.='<tr><td class="encabezado">Observaci&oacute;n de la Devoluci&oacute;n*</td><td><textarea name="x_notas" id="observacion_devolucion" cols="40" rows=5></textarea></td></tr>';

$texto.='<tr><td colpan="2"> <input type="hidden" name="accion" value="devolver"> 
<input type="hidden" name="idpaso_documento" value="'.$_REQUEST["idpaso_documento"].'">
<input type="hidden" name="iddiagram_instance" value="'.$pasos_flujo[0]["diagram_iddiagram_instance"].'">
<input type="submit" value="DEVOLVER"></td></tr>';
$texto.= $campos_devolucion;
$texto.='</form></table>';
echo($texto);
?>