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
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());

if(@$_REQUEST['id']){
    
    $keys=explode('-',$_REQUEST['id']);
    $idformato=$keys[0];
    $idft=$keys[1];
    $idft_bases_calidad=$keys[2];
    $iddoc=$keys[3];
    
    $datos=busca_filtro_tabla("","ft_bases_calidad","documento_iddocumento=".$iddoc,"",$conn);
    
    $tabla='<table class="table">';
    
    $tabla.='
        <tr>
            <td>'..'</td>
        </tr>
        
    ';
    
    
    $tabla.='</table>';
    
}

die();
?>