<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php include_once($ruta_db_superior."pantallas/generador/class_generador.php"); ?><?php
$pantalla = new generador(); 
  if(@$_REQUEST["ejecutar_generador"]){  
    if(!@$_REQUEST["tipo_retorno"]){
      $_REQUEST["tipo_retorno"]=1;
    }
    if($_REQUEST["tipo_retorno"]){
      echo(json_encode($pantalla->$_REQUEST["ejecutar_generador"]()));
    }  
    else{
      $pantalla->$_REQUEST["ejecutar_generador"]();
    }
  }
  ?>
