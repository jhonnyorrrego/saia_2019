<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");
$listado_tablas=listar_tablas();
$listado_indices=listar_indices();
function listar_tablas(){
ini_set("display_errors",true);
$tablas_excluidas=array("","");
global $conn;
switch(MOTOR){
  case 'MySql':
    $sql2="SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema ='".DB."'";
  break;
  case 'SQLServer':
    $sql2="SELECT name AS TABLE_NAME FROM sysobjects WHERE type='U'";
  break;  
  case 'MSSql':
    $sql2="SELECT name AS TABLE_NAME FROM sysobjects WHERE type='U'";
  break;
  case 'Oracle':
    $sql2="select TABLE_NAME from DBA_TABLES where OWNER='".strtoupper(DB)."'";
  break;
}

$listado=ejecuta_filtro_tabla($sql2,$conn);
return($listado);  
}
function listar_indices($tabla){
global $conn;
switch(MOTOR){
  case 'MySql':
    $sql2="SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema ='".DB."'";
  break;
  case 'SQLServer':
    $sql2="SELECT name AS TABLE_NAME FROM sysobjects WHERE type='U'";
  break;  
  case 'MSSql':
    $sql2="SELECT name AS TABLE_NAME FROM sysobjects WHERE type='U'";
  break;
  case 'Oracle':
    $sql2="SELECT INDEX_NAME FROM all_indexes WHERE OWNER='".strtoupper(DB)."'";
  break;
}  
}
?>