<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
function agregar_zip($dir, $zip){  
  if (is_dir($dir)) { 
    if ($da = opendir($dir)) {              
      while (($archivo = readdir($da))!== false) {   
        if (is_dir($dir . $archivo) && $archivo!="." && $archivo!=".."){                
          agregar_zip($dir.$archivo . "/", $zip);  
        }elseif(is_file($dir.$archivo) && $archivo!="." && $archivo!=".."){                                    
          $zip->addFile($dir.$archivo, $dir.$archivo);                     
        }             
      }
      closedir($da); 
    }
  }       
}      
function comprimir_zip($ruta_origen,$ruta_destino,$archivo_zip,$tipo_retorno=1){
global $ruta_db_superior;
$retorno=array("exito"=>0);
$retorno=array("mensaje"=>"Error al comprimir el archivo ".$ruta_db_superior.$ruta_destino.$archivo_zip);
$zip = new ZipArchive();
$dir = $ruta_db_superior.$ruta_origen.'/';
$rutaFinal=$ruta_db_superior.$ruta_destino.'/';
$archivoZip = $archivo_zip;  
if($zip->open($archivoZip,ZIPARCHIVE::CREATE)===true) {  
  agregar_zip($dir, $zip);
  $zip->close();
  $archivo_final=$rutaFinal.$archivoZip;
  @rename($archivoZip, $archivo_final);
  if (file_exists($archivo_final)){
    $retorno["exito"]=1;  
    $retorno["mensaje"]="Archivo comprimido con &eacute;xito";
  }
  else{
    $retorno["exito"]=0;
    $retorno["mensaje"]="Error al comprimir el archivo ".$archivo_final;
  }                    
}
if($tipo_retorno==1){
  return(json_encode($retorno));
}
else{
  return($retorno);
}
}
if(@$_REQUEST["ruta_origen"] && @$_REQUEST["ruta_destino"] && @$_REQUEST["archivo_zip"]){
if(!@$_REQUEST["tipo_retorno"]){
  !@$_REQUEST["tipo_retorno"]=1;
}
  comprimir_zip($_REQUEST["ruta_origen"],$_REQUEST["ruta_destino"],$_REQUEST["archivo_zip"],$_REQUEST["tipo_retorno"]);
}
?>