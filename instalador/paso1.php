<?php
/*<Clase>
<Nombre>crear_archivo</Nombre>
<Parametros>$nombre:nombre del archivo a crear;$texto: texto que se va a copiar dentro del archivo;$modo:modo de apertura del archivo</Parametros>
<Responsabilidades>Crea un archivo con cierto texto dentro<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function crear_archivo($nombre,$texto=NULL,$modo='wb'){
  global $cont;
  $cont++;
  echo("Creando Archivo ".$nombre);
  $path=pathinfo($nombre);

  $ruta_dir=explode("/",$path["dirname"]);
  $cont1=count($ruta_dir);
  if($cont1){
    $ruta=$ruta_dir[0];

    for($i=0;$i<$cont1;$i++){
      if(!is_dir($ruta)){
        if(mkdir($ruta,0777)){
          chmod($ruta,0777);
          if(isset($ruta_dir[$i+1]))
            $ruta.="/".$ruta_dir[$i+1];
        }
        else{
          alerta("Problemas al generar las carpetas");
          return(false);
        }
      }
      else {
        if(isset($ruta_dir[$i+1]))
          $ruta.="/".$ruta_dir[$i+1];
      }
    }
  }
  $f=fopen($nombre,$modo);
  if($f){
    chmod($nombre,0777);
    $texto=str_replace("? >","?".">",$texto);
    if(fwrite($f,$texto,strlen($texto))){
      fclose($f);
      return($nombre);
    }
    else {
      fclose($f);
    }
  }
  else{
    alerta('No se puede crear el archivo: '.$nombre);
  }
  return(false);
}
/*<Clase>
<Nombre>crear_destino</Nombre>
<Parametros>$destino:estructura de carpetas a crear</Parametros>
<Responsabilidades>Crea un conjunto de carpetas con cierta jerarquia<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function crear_destino($destino){
  $arreglo=explode("/",$destino);
  if(is_array($arreglo)){
   $cont=count($arreglo);
   for($i=0;$i<$cont;$i++){
    if(!is_dir($arreglo[$i])){
      chmod($arreglo[$i-1],0777);
      if(!mkdir($arreglo[$i],0777)){
        alerta("no es posible crear la carpeta: ".$destino);
        return("");
      }
      else if(isset($arreglo[($i+1)]))
        $arreglo[($i+1)]=$arreglo[$i]."/".$arreglo[($i+1)];
      }
    else if(isset($arreglo[($i+1)]))
        $arreglo[($i+1)]=$arreglo[$i]."/".$arreglo[($i+1)];
    }
  }
 return($destino);
}
/*
Crear las carpetas necesarias para la instalacion.  */
$ruta="../../../".$_REQUEST["nombre"];
if(crear_destino($ruta)!=""){
  echo("Carpeta Principal Creada (".$ruta.")<br />");
  $ruta="../../../".$_REQUEST["nombre"]."/backup";
  if(crear_destino($ruta)!=""){
    echo("Carpeta Creada (".$ruta.")<br />");
  }
  $ruta="../../../".$_REQUEST["nombre"]."/evento";
  if(crear_destino($ruta)!=""){
    echo("Carpeta Creada (".$ruta.")<br />");
  }
  $ruta="../../../".$_REQUEST["nombre"]."/sesiones";
  if(crear_destino($ruta)!=""){
    echo("Carpeta Creada (".$ruta.")<br />");
  }
  $ruta="../../../".$_REQUEST["nombre"]."/versiones";
  if(crear_destino($ruta)!=""){
    echo("Carpeta Creada (".$ruta.")<br />");
  }
}

/* Copia la carpeta saia a la nueva carpeta de instalacion*/ 
include_once("../tarea_copiar_carpeta.php");
copiar_archivos_carpeta("../../saia1.06","../../../".$_REQUEST["nombre"]."/saia1.06") ;          
$define1=file_get_contents("define_.php");
if(@$_REQUEST["nombre"]){
  $ruta=$_SERVER["REQUEST_URI"];
  $ruta2=explode("/",$ruta);
  $ruta3="";
  for($i=0;$i<count($ruta2)-4;$i++){
    $ruta3.=$ruta2[$i]."/";
  }
  $ruta_pdf=$_SERVER["HTTP_HOST"].$ruta3.$_REQUEST["nombre"]."/saia1.06";
  $ruta_script=$ruta3.$_REQUEST["nombre"]."/saia1.06";
  reemplazar_define("RUTA_PDF",$ruta_pdf);
  reemplazar_define("RUTA_SCRIPT",$ruta_script);
  foreach($_REQUEST AS $key=>$valor){
    reemplazar_define($key);
  }
  $ruta_define='../../..'.$ruta_script.'/define.php';  
  if(file_exists($ruta_define)){
    file_put_contents($ruta_define,$define1);
  } 
  else {
    die("Existe un problema con el archivo ".$ruta_define);
  }   
}
else die("ERROR AL TRATAR DE INSTALAR LA APLICACION: Nombre no asignado");
function reemplazar_define($cadena,$nueva=""){
global $define1;
  if($nueva=="" && @$_REQUEST[$cadena]){
    $define1=str_replace("<*".$cadena."*>",$_REQUEST[$cadena],$define1);
      
  }
  else {
    $define1=str_replace("<*".$cadena."*>",$nueva,$define1);
  }
}
?>
<form action="paso2.php" method="POST" id="paso2" name="paso2">
  <input type="submit" value="CONTINUAR" name="continuarp2">
  <?php
  foreach($_REQUEST AS $key=>$valor){
    echo('<input type="hidden" value="'.$valor.'" name="'.$key.'"><br />');
  }
  ?> 
</form>
<script language="JavaScript">
<!--
document.paso2.continuarp2.focus();
-->
</script>