<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");

if(@$_REQUEST['idft_proceso']){
    $coordenadas=busca_filtro_tabla("coordenadas","ft_proceso","idft_proceso=".$_REQUEST['idft_proceso'],"",$conn);
    $retorno=array();
    if($cordenadas['numcampos'] && @$coordenadas[0]['coordenadas']!='' && !is_null(@$coordenadas[0]['coordenadas'])){
        
        $retorno['cordenadas']=$coordenadas[0]['coordenadas'];
    }
    echo(json_encode($retorno));
    
}


?>