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
  if($buscar_archivo){
    if(strpos($obj,$palabra)!==false){
      $extension=substr($obj, (strpos($obj,".")+1));
      
      $resultado_buscar_archivo[$contador_archivos]=array("etiqueta"=>str_replace(substr($obj, strrpos($obj,".")),"",$obj),"nodeid"=>$dir.'/'.$obj,"nombre_archivo"=>str_replace("../", "",$dir.'/'.$obj ),"extension"=>$extension);
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
      $resultado_buscar_archivo[$contador_archivos]=array("nodeid"=>$dir.'/'.$obj,"nombre_archivo"=>str_replace("../", "",$dir.'/'.$obj ),"extension"=>$extension);
    }
  }       
  buscar_archivos($dir.'/'.$obj,$palabra,$buscar_contenido,$buscar_archivo,$reemplazar,$palabra_reemplazar); 
} 
closedir($dh); 
return($resultado_buscar_archivo); 
}

?>