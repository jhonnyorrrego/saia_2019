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
echo(librerias_jquery('1.7'));

function bases_calidad_ocultar_tipo($idformato,$iddoc){
    global $conn;
    
    $datos=busca_filtro_tabla("","ft_bases_calidad a, documento b","b.iddocumento=a.documento_iddocumento AND lower(b.estado)='aprobado'","",$conn);
    
    $tipos_existentes=extrae_campo($datos,'tipo_base_calidad');
    
    print_r($tipos_existentes);
    
    
    ?>
    
    <?php
    
    
}


?>