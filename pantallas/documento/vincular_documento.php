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
include_once($ruta_db_superior."db.php");;
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
      $cantidad=count($vincular);
      //array_push($vincular,$_REQUEST["documento_iddocumento"]);
      $insertados=0;
      $lya_vinculados=0;
      $ya_vinculados=array();
      for($i=0;$i<$cantidad;$i++){
        $origen=$_REQUEST["documento_iddocumento"];
  	    $destino=$vincular[$i];
  	    if($origen && $destino){
      	    $ya_vinculados=busca_filtro_tabla('','documento_vinculados','documento_origen='.$origen." AND documento_destino=".$destino." AND funcionario_idfuncionario=".$_REQUEST["idfuncionario"],'',$conn);    
      	    if($ya_vinculados["numcampos"]){
      	        $lya_vinculados++;
      	    }
  	    }
  	    else{
  	        $ya_vinculados["numcampos"]=0;
  	    }
  		if(@$origen && @$destino && $origen!=$destino && !$ya_vinculados["numcampos"]){
  		  $sql2="INSERT INTO documento_vinculados(documento_origen,documento_destino,fecha,funcionario_idfuncionario) VALUES('".$origen."','".$destino."',".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",".$_REQUEST["idfuncionario"].")";
  		  phpmkr_query($sql2);
          if(phpmkr_insert_id()){
            $insertados++;
          }
  		}
      }
      // se le resta el documento que se adiciona del documento original
      if($lya_vinculados){
        array_push($mensaje,array("mensaje"=>"Algunos documentos ya se encuentran vinculados","tipo"=>"warning"));  
      }
      else if($insertados>=$cantidad){
        array_push($mensaje,array("mensaje"=>"Todos los documentos han sido vinculados","tipo"=>"success"));
      }
      else if($insertados){
        array_push($mensaje,array("mensaje"=>"Algunos documentos han sido vinculados","tipo"=>"warning"));  
      }
      else{
        array_push($mensaje,array("mensaje"=>"Algunos documentos no han podido vincularse por favor verifique e intente de nuevo","tipo"=>"warning"));
      }
    }      
  }
  else{
    array_push($mensaje,array("mensaje"=>"Por favor selecione los documentos, paginas o anexos seleccionados que desea vincular","tipo"=>"warning"));
    $exito=0;
  }
if($exito&&@$_REQUEST["deseleccionar"]){
  $ldocs=array_merge((array)$docs_paginas,(array)$docs_anexos,(array)$documentos);
  array_push($mensaje,deseleccionar_documento($ldocs));
}
}
else{
  array_push($mensaje,array("mensaje"=>"Por favor selecione un documento al que desea vincular los documentos, paginas o anexos seleccionados","tipo"=>"warning"));
}
echo stripslashes(json_encode($mensaje,JSON_FORCE_OBJECT));
?>

