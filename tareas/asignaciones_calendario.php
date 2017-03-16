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
if(@$_REQUEST["usuario"]){
$usuario=$_REQUEST["usuario"];
}
else {
$usuario=usuario_actual("funcionario_codigo");
}
$tipo_busqueda=$_REQUEST["tipo_busqueda"];
$orden='';                               
$where=array();
if($tipo_busqueda=='asignaciones'){
array_push($where,'llave_entidad='.$usuario.' AND entidad_identidad=1 AND tarea_idtarea <> 1 AND tarea_idtarea<>2');
}
else if($tipo_busqueda=='doc_pendientes'){
array_push($where,'llave_entidad='.$usuario.' AND entidad_identidad=1 AND tarea_idtarea = 2');
}
else if($tipo_busqueda=='festivos'){
array_push($where,' tarea_idtarea = 1');
}
else{
$orden='GROUP BY fecha_inicial,fecha_final';
} 
if(@$_REQUEST["estado"]){
  switch($_REQUEST["estado"]){
    case "vencidas":
      array_push($where,'fecha_final < NOW()');
    break;
    case "en_ejecucion":
      array_push($where,"fecha_inicial >=NOW() OR fecha_final='0000-00-00 00:00:00'");
    break;
    case "pendientes":
      array_push($where,' AND fecha_inicial > NOW() ');
    break;
  }
}
if(empty($where)){
  array_push($where,'1=1');
}
$tareas=busca_filtro_tabla("","asignacion",implode(" AND ",$where),$orden,$conn);
//print_r($tareas);
$fecha_act=date('Y-m-d H:i:s');
$arreglo=array();
for($i=0;$i<$tareas["numcampos"];$i++){
  if($tareas[$i]["tarea_idtarea"]==1){
    $titulo="";
    $estado_general='Festivo';
    $url='#';
  }
  elseif($tareas[$i]["tarea_idtarea"]==2){
    $documento=busca_filtro_tabla("","documento","iddocumento=".$tareas[$i]["documento_iddocumento"]);
    if($documento["numcampos"]){
      $titulo="Rad:".$documento[0]["numero"];
      $url=$ruta_db_superior."ordenar.php?accion=mostrar&mostrar_formato=1&key=".$documento[0]["iddocumento"];
    }
    $estado_general='Documento';
  }
  else{
    $titulo=delimita("Tarea: ".$tareas[$i]["descripcion"]);
    $url='asignacionview.php?idasignacion='.$tareas[$i]["idasignacion"];
    if($fecha_act>$tareas[$i]["fecha_final"] && $tareas[$i]["fecha_final"] !='0000-00-00 00:00:00'){
  	  $estado_general="vencida";
    }
    else{
      if($fecha_act>$tareas[$i]["fecha_inicial"]){
  	   $estado_general="en_ejecucion";
  	 }
      else{
  	   $estado_general="pendiente";
      }
    }
  }  
  $cadena='{"id":'.$tareas[$i]["idasignacion"].',"allDay":false,"className":"'.$estado_general.'","title":"'.codifica_encabezado(html_entity_decode($titulo)).' ('.$estado_general.')","start":"'.$tareas[$i]["fecha_inicial"].'","end":"'.$tareas[$i]["fecha_final"].'","url":"'.$url.'"}';
  array_push($arreglo,$cadena);
}   
$feedURL = "http://www.google.com/calendar/feeds/dhemian@gmail.com/private-dc75f64292569547e35189b22f95300b/basic";

// read feed into SimpleXML object
$sxml = simplexml_load_file($feedURL);
foreach ($sxml->entry as $entry) {
  $title = codifica_encabezado(html_entity_decode($entry->title));
  $cadena='{"allDay":true,"title":"Google->'.$title.'"}';
  array_push($arreglo,$cadena);
}
$retorno='[';
$retorno.=implode(",",$arreglo);
$retorno.=']';
echo($retorno);
?>