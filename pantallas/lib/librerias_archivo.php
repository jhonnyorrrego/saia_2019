<?php
function buscar_archivos($dir,$palabra, $buscar_contenido=0,$buscar_archivo=1,$reemplazar=0,$palabra_reemplazar=''){
global $contador_archivos,$a,$resultado_buscar_archivo;
if(!isset($resultado_buscar_archivo)){
  $resultado_buscar_archivo=array();
  $contador_archivos=0;
}
if(!$dh = @opendir($dir)){ 
  return; 
} 
while (false !== ($obj = readdir($dh))) { 
  if($obj == '.' || $obj == '..'){ 
    continue; 
  }   
  $contador_archivos++;
  $extension=substr($obj, (strrpos($obj,".")+1));
  if($buscar_archivo){
    if(strpos($obj,$palabra)!==false){
      $resultado_buscar_archivo[$contador_archivos]=array("etiqueta"=>str_replace(".".$extension,"",$obj),"nodeid"=>$dir.'/'.$obj,"nombre_archivo"=>str_replace("../", "",$dir.'/'.$obj ),"extension"=>$extension);
    }
  }
  else if ($buscar_contenido && $obj<>"busca_infecciones.php" && filesize($dir.'/'.$obj) && $palabra){
    $ar=fopen($dir.'/'.$obj,"r");
    $contenido=fread($ar,filesize($dir.'/'.$obj)); 
    fclose($ar);
    if(strpos($contenido,$palabra)!==false){      
      if($reemplazar && $palabra_reemplazar){
        $contenido=str_replace($palabra,@$palabra_reemplazar,$contenido);
        $ar=fopen($dir.'/'.$obj,"w");
        $evaluado=fwrite($ar,$contenido);
        fclose($ar); 
        if(strpos($contenido,$palabra)===false && $evaluado){
          array_push($resultado_buscar_archivo,$dir.'/'.$obj);
        }
      }
      $resultado_buscar_archivo[$contador_archivos]=array("etiqueta"=>str_replace(".".$extension,"",$obj),"nodeid"=>$dir.'/'.$obj,"nombre_archivo"=>str_replace("../", "",$dir.'/'.$obj ),"extension"=>$extension);
    }
  }
  /*if(strpos($resultado_buscar_archivo[$contador_archivos],"/")===0){
      echo(str_replace("/","",$resultado_buscar_archivo[$contador_archivos],1));
      $resultado_buscar_archivo[$contador_archivos]=str_replace("/","",$resultado_buscar_archivo[$contador_archivos],1);
  }*/
  buscar_archivos($dir.'/'.$obj,$palabra,$buscar_contenido,$buscar_archivo,$reemplazar,$palabra_reemplazar); 
} 
closedir($dh); 
return($resultado_buscar_archivo); 
}
function crear_archivo_carpeta($nombre,$ruta,$extension,$tipo){
    //1=archivos, 2=carpetas
    $extensiones_permitidas_permitidas=array("php","css","js","txt","csv");
    global $ruta_db_superior;
    $reultado='';
    if(strpos($ruta,".")===0 || strpos($ruta,"/")===0){
        $ruta=substr($ruta,1);
    }
    if($tipo==1){
        if(in_array($extension,$extensiones_permitidas)){
            return("La extensi&oacute;n ".$extension." no esta permitida");
        }
        if(file_exists($ruta_db_superior.$ruta."/".$nombre.".".$extension)){
            $resultado="EL archivo ya existe";
        }
        else if(file_put_contents($ruta_db_superior.$ruta."/".$nombre.".".$extension,"")){
            $resultado="Archivo creado con &eacute;xito";
        }
        else{
            $resultado="Error al tratar de crear el archivo";
        }
    }
    else if($tipo==2){
        if(is_dir($ruta_db_superior.$ruta."/".$nombre)){
            $resultado="La carpeta ya existe";
        }
        else if(crear_destino($ruta_db_superior.$ruta."/".$nombre)!==""){
            $resultado="Carpeta creada con &eacute;xito";
        }
        else{
            $resultado="Error al tratar de crear la carpeta";
        }
    }
    return($resultado);
}
if(@$_REQUEST["ejecutar_accion_saia"]){
    if(@$_REQUEST["funcion"]){
        $retorno=call_user_func_array ( $_REQUEST["funcion"], explode(";",@$_REQUEST["parametros"]));
    }
    if($retorno){
        echo json_encode($retorno);
    }
}
?>