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
include_once($ruta_db_superior."db.php");

function documentos_pendientes_reporte($funcionario_codigo){
    global $ruta_db_superior,$conn;
    
    $datos=busca_filtro_tabla("","documento a,asignacion b,vpantalla_formato c","(lower(a.estado)<>'eliminado' and a.iddocumento=b.documento_iddocumento and b.tarea_idtarea<>-1 and b.entidad_identidad=1  and b.llave_entidad='$funcionario_codigo' and lower(a.plantilla)=c.nombre  )","",$conn);
    
}