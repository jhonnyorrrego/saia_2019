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
include_once($ruta_db_superior."pantallas/documento/librerias.php");
$mensaje=array();
if(@$_REQUEST["documento_iddocumento"]){  
  if(!@$_REQUEST["idfuncionario"]){
    $_REQUEST["idfuncionario"]=usuario_actual("idfuncionario");
  }
  if(@$_REQUEST["arreglo"]){
    
    $arreglo=explode(",",$_REQUEST["arreglo"]);
    $cant_arreglo=count($arreglo);
    $documentos=array();
    $anexos=array();  
    $docs_anexos=array();
    $paginas=array(); 
    $docs_paginas=array();
    for($i=0;$i<$cant_arreglo;$i++){
      $variable=explode("_",$arreglo[$i]);
      if($variable[0] && $variable[1]){
        switch($variable[0]){
          case "documento":        
            array_push($documentos,$variable[1]);
            
          break;
          case "pagina":  
            array_push($paginas,$variable[1]);
            array_push($docs_paginas,$variable[2]);
          break;
          case "anexo":  
            array_push($anexos,$variable[1]);
            array_push($docs_anexos,$variable[2]);
          break;
        }        
      }    
    }
    $exito=1;
    if(count($paginas)){
      include_once($ruta_db_superior."pantallas/paginas/vincular_pagina.php");
      $paginas_insertadas=vincular_paginas($_REQUEST["documento_iddocumento"],$paginas,$_REQUEST["idfuncionario"]);
      if(count($paginas)==count($paginas_insertadas)){
        array_push($mensaje,array("mensaje"=>"<b>ATENCI&Oacute;N</b><br>Todas las p&aacute;ginas han sido vinculadas","tipo"=>"success"));
      }
      else{
        array_push($mensaje,array("mensaje"=>"<b>ATENCI&Oacute;N</b><br>Algunas p&aacute;ginas no han podido vincularse por favor verifique e intente de nuevo","tipo"=>"warning"));
        $exito=0; 
      }
    }  
    if(count($anexos)){
      include_once($ruta_db_superior."pantallas/anexos/vincular_anexos.php");
      $anexos_insertados=vincular_anexos($_REQUEST["documento_iddocumento"],$anexos,$_REQUEST["idfuncionario"]);
      if(count($anexos)==count($anexos_insertados)){
        array_push($mensaje,array("mensaje"=>"<b>ATENCI&Oacute;N</b><br>Todos las anexos han sido vinculados","tipo"=>"success"));
      }
      else{
        array_push($mensaje,array("mensaje"=>"<b>ATENCI&Oacute;N</b><br>Algunos anexos no han podido vincularse por favor verifique e intente de nuevo","tipo"=>"warning"));
        $exito=0; 
      }
    }  
    if(count($documentos)){
      $vincular=$documentos;
      array_push($vincular,$_REQUEST["documento_iddocumento"]);
      $cantidad=count($vincular);
      $insertados=0;
      for($i=0;$i<$cantidad;$i++){
      	for($j=0;$j<$cantidad;$j++){
      		if($vincular[$i]!=$vincular[$j]){
      			$origen=$vincular[$i];
      			$destino=$vincular[$j];
      			$sql2="INSERT INTO documento_vinculados(documento_origen,documento_destino,fecha,funcionario_idfuncionario) VALUES('".$origen."','".$destino."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$_REQUEST["idfuncionario"].")";
      		    phpmkr_query($sql2);
              if(phpmkr_insert_id()){
                $insertados++;
              }
      		}
      	}                          
      }
      // se le resta el documento que se adiciona del documento original
      if($insertados>=$cantidad){
        array_push($mensaje,array("mensaje"=>"<b>ATENCI&Oacute;N</b><br>Todos los documentos han sido vinculados","tipo"=>"success"));
      }
      else{
        array_push($mensaje,array("mensaje"=>"<b>ATENCI&Oacute;N</b><br>Algunos documentos no han podido vincularse por favor verifique e intente de nuevo","tipo"=>"warning"));
      }      
    }      
  }
  else{
    array_push($mensaje,array("mensaje"=>"<b>ATENCI&Oacute;N</b><br>Por favor selecione los documentos, paginas o anexos seleccionados que desea vincular","tipo"=>"warning"));
    $exito=0;
  }
if($exito&&@$_REQUEST["deseleccionar"]){
  $ldocs=array_merge((array)$docs_paginas,(array)$docs_anexos,(array)$documentos);
  array_push($mensaje,deseleccionar_documento($ldocs));
}
}
else{
  array_push($mensaje,array("mensaje"=>"<b>ATENCI&Oacute;N</b><br>Por favor selecione un documento al que desea vincular los documentos, paginas o anexos seleccionados","tipo"=>"warning"));
}
echo stripslashes(json_encode($mensaje));
?>