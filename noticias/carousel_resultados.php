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
$page = @$_REQUEST['page']; // get the requested page 
$limit = @$_REQUEST['rows']; // get how many rows we want to have into the grid 
$sidx = @$_REQUEST['sidx']; // get index row - i.e. user click to sort 
$sord = @$_REQUEST['sord']; // get the direction 
$filtro= @$_REQUEST['filtros']; //get the filters from pantalla
if(!$sidx) $sidx =1; // connect to the database 
if(!$limit){
  $limit=30;
}
if(!$page){
  $page=1;
}
$campos_consulta="count(idcontenidos_carrusel) AS contenidos,A.nombre,MIN(".fecha_db_obtener("B.fecha_inicio","Y-m-d").") AS fecha_inicio, MAX(".fecha_db_obtener("B.fecha_fin","Y-m-d").") AS fecha_fin,idcarrusel";
$tablas_consulta="carrusel A,contenidos_carrusel B";
$agrupar_consulta="A.idcarrusel";
$ordenar_temporal="A.nombre ";
$condicion="A.idcarrusel=B.carrusel_idcarrusel";
if(@$_REQUEST["numero"]){
  $condicion.=" AND (A.nombre LIKE '%".$_REQUEST["numero"]."%')";
}
if($agrupar_consulta!=""){
  $ordenar_consulta.=" GROUP BY ".$agrupar_consulta;
}
if($sidx && $sord){
  $ordenar_consulta.=" ORDER BY ".$sidx." ".$sord;
}
else if($ordenar_consulta!="" || $ordenar_temporal!=''){
  $ordenar_consulta.=" ORDER BY ".$ordenar_temporal;
}  
$result = ejecuta_filtro_tabla("SELECT COUNT(*) AS count FROM ".$tablas_consulta." WHERE ".$condicion,$conn);
$count = $result[0]['count']; 
if( $count >0 ) { 
$total_pages = ceil($count/$limit); 
} else { 
$total_pages = 0; 
} 
$start = ($limit*$page - $limit); // do not put $limit*($page - 1) 
if($start){
    $start++;    
}
if($pages<$total_pages){
  $result=busca_filtro_tabla_limit($campos_consulta,$tablas_consulta,$condicion,$ordenar_consulta,$start,$limit,$conn);
  
  $responce->pagina = $page; 
  $responce->total_paginas = $total_pages; 
  $responce->total_registros = $count;
  $responce->limite_pagina = $limit;
  $responce->inicio_pagina = $start;
  for($i=0;$i<$result["numcampos"];$i++){
    $responce->datos[$i]["fecha_inicio"]=$result[$i]["fecha_inicio"];
    $responce->datos[$i]["idcarousel"]=$result[$i]["idcarrusel"];
    $responce->datos[$i]["nombre"]=$result[$i]["nombre"];
    $responce->datos[$i]["fecha_fin"]=$result[$i]["fecha_fin"];
    $responce->datos[$i]["contenidos"]=$result[$i]["contenidos"];
  } 
echo stripslashes(json_encode($responce));
}
?>