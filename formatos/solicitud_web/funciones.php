<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");

function transferencia_solicitud_web($idformato,$iddoc){
global $conn;
$datos=array();
$datos["origen"]="123456";  //funcionario 
$datos["archivo_idarchivo"]=$iddoc;
$datos["nombre"]="TRANSFERIDO";
$datos["tipo_destino"]=1;
$datos["tipo"]="";
$destinos=array();
$documento=busca_filtro_tabla("","ft_solicitud_web A,documento B","A.documento_iddocumento=B.iddocumento AND A.documento_iddocumento=".$iddoc,"",$conn);                  
 switch($documento[0]["tipo_solicitud"]){
    case 1:      
      array_push($destinos,'42145646');
    break;
    case 4:
      array_push($destinos,'42145646'); 
    break;
    case 3:
      array_push($destinos,'72'); 
    break;
    case 2:
      array_push($destinos,'342'); 
    break;
    default:
     array_push($destinos,'402'); 
    break;
  }
transferir_archivo_prueba($datos,$destinos,'');
}
function responder_solicitud($idformato,$iddoc){
print_r($_SERVER["REMOTE_ADDR"]);
echo("<a href='../../responder.php?iddoc=".$iddoc."&idformato=79'>Generar Respuesta</a>");
}
?>
