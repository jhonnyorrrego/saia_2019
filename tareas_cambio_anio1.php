<?php
include_once("db.php");

function limpiar_evento()
{global $conn;
 $sql="DELETE FROM  evento where ".fecha_db_obtener("fecha","Y-m-d")."<'".date("Y-m-d")."'";
 $conn->Ejecutar_Sql($sql);
 echo "Terminado";
}

function finalizar_actualizacion()
{global $conn;
 $fin=busca_filtro_tabla("valor","configuracion","nombre='fin_actualizacion'","",$conn);
 if($inicio["numcampos"])
  $sql="update configuracion set valor='".date("Y-m-d H:i:s")."' where nombre='fin_actualizacion'";
 else
  $sql="insert into configuracion(nombre,valor) values('fin_actualizacion','".date("Y-m-d H:i:s")."')"; 
 phpmkr_query($sql); 
 //redirecciona("index.php"); 
}
function actualizar_festivos()
{global $conn;
 if (($handle = fopen("festivos.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
     $existe=busca_filtro_tabla("","asignacion","documento_iddocumento=-1 and ".fecha_db_obtener("fecha_inicial","Y-m-d")." like '".$data[0]."' and ".fecha_db_obtener("fecha_final","Y-m-d")." like '".$data[1]."'","",$conn);
    
     if(!$existe["numcampos"])
       {$sql="insert into asignacion(fecha_inicial,fecha_final,documento_iddocumento) values('".$data[0]."','".$data[1]."',-1)";
        phpmkr_query($sql);
       }
    }
    fclose($handle);
  }
}
function actualizar_contadores()
{global $conn;
 $contadores=array("radicacion_entrada","radicacion_salida");

$texto="";

if(!is_dir("../backup"))
  mkdir("../backup",0777);
$nombre="../backup/backup_contadores_".date("Y").".txt";
if(!is_file($nombre))
 {
  foreach($contadores as $fila)
    {$valores=busca_filtro_tabla("","contador","nombre='$fila'","",$conn);
     $texto.="update contador set consecutivo='".$valores[0]["consecutivo"]."' where idcontador='".$valores[0]["idcontador"]."';\n";
     $sql="update contador set consecutivo=1 where idcontador='".$valores[0]["idcontador"]."'";
     phpmkr_query($sql,$conn);  
    }
  $archi=fopen($nombre,"w");  
  chmod($nombre,0777);
  fwrite($archi,$texto);
  fclose($archi);  
}  
echo "Terminado"; 
}
function eliminar_ingresos()
{global $conn;
 include_once("documento_eliminar.php");
 $borrar = busca_filtro_tabla("iddocumento","documento","estado='INICIADO' and (plantilla='' or plantilla is null ) and ".fecha_db_obtener("fecha","Y-m-d")."<'".date("Y-m-d")."'","",$conn);
 for($i=0;$i<$borrar["numcampos"];$i++)
   datos_documento($borrar[$i]["iddocumento"],"iniciados/");
 echo "Terminado";  
}

function eliminar_no_transferidos()
{global $conn;
 include_once("documento_eliminar.php");
 $borrar = busca_filtro_tabla("iddocumento","documento","estado='ACTIVO' and tipo_radicado=1 and iddocumento not in(select distinct archivo_idarchivo from buzon_salida) and ".fecha_db_obtener("fecha","Y-m-d")."<'".date("Y-m-d")."'","",$conn);
 for($i=0;$i<$borrar["numcampos"];$i++)
   datos_documento($borrar[$i]["iddocumento"],"no_transferidos/");
 echo "Terminado";  
}  

function guardar_log_acceso_archivo()
{global $conn;
 if(!is_dir("../backup"))
  mkdir("../backup",0777);
 $nombre="../backup/backup_log_acceso_".date("Y").".txt";
  if(!is_file($nombre))
  {$archi=fopen($nombre,"w");
   chmod($nombre,0777);
   $aux=$conn->Ejecutar_Sql("select * from log_acceso where ".fecha_db_obtener("fecha","Y")."<'".date("Y")."'");

   while($evento = @phpmkr_fetch_array($aux))
    {fwrite($archi,$evento["idlog_acceso"]."||@@||".$evento["iplocal"]."||@@||".$evento["login"]."||@@||".$evento["ipremota"]."||@@||".$evento["exito"]."||@@||".$evento["fecha"]."||@@||".$evento["fecha_cierre"]."||@@||".$evento["funcionario_idfuncionario"]."||@@||".$evento["idsesion_php"]."||@@||".$evento["sesion_php"]."\n"); 
    }
   fclose($archi);
  }
 $sql="delete from log_acceso where ".fecha_db_obtener("fecha","Y-m-d")."<'".date("Y-m-d")."'";
 $conn->Ejecutar_sql($sql);
 echo "Terminado"; 
}

function eliminar_borradores()
{ global $conn;
  $borrar = busca_filtro_tabla("iddocumento","documento","fecha < ".fecha_db_almacenar("2009-12-31 23:59:59","Y-m-d H:i:s")." and estado='ACTIVO' and plantilla <>'' and numero like '0'","",$conn);  
  include_once("documento_eliminar.php"); 
  for($x=0; $x<$borrar["numcampos"]; $x++)  
   datos_documento($borrar[$x]["iddocumento"],"borradores/");
 echo "Terminado";
}

function actualizar_rol()
{ global $conn;  
  $antes=busca_filtro_tabla("iddependencia_cargo,".fecha_db_obtener("fecha_final","Y-m-d")." as fecha_final","dependencia_cargo","estado=1","",$conn);
  $archi=fopen("../backup/roles_".date("Y").".txt","w");
  chmod("../backup/roles_".date("Y").".txt",0777);  
    for($n=0; $n<$antes["numcampos"]; $n++)
     {fwrite($archi,"update dependencia_cargo set fecha_final=".fecha_db_almacenar($antes[$n]["fecha_final"],"Y-m-d")." where iddependencia_cargo=".$antes[$n]["iddependencia_cargo"].";\n\r");             
     }
  fclose($archi);   
  $sql="update dependencia_cargo set fecha_final=".suma_fechas("fecha_final","1","YEAR")." where estado=1";
  $conn->Ejecutar_Sql($sql);
  echo "Terminado";     
}

function borrar_eliminados()
{global $conn;
 $resultado=busca_filtro_tabla("iddocumento,fecha,numero","documento","estado='ELIMINADO' and ".fecha_db_obtener("fecha","Y-m-d H:i:s")."<'2009-12-31 23:59:59'","fecha asc",$conn);
$m=0;
include_once("documento_eliminar.php");  
for($m=0;$m<$resultado["numcampos"];$m++)
   datos_documento($resultado[$m]["iddocumento"],"eliminados/");
 echo "Terminado";  
}

function terminar_pendientes() 
{ global $conn;
 $funcionarios = busca_filtro_tabla("funcionario_codigo as cod","funcionario","","",$conn); 
 include_once("documento_eliminar.php");
 for($j=0; $j<$funcionarios["numcampos"]; $j++)
 {
 $doc_destino="../backup/terminados/".$funcionarios[$j]["cod"];
 crear_destino($doc_destino);
 $text = terminar_documentos($funcionarios[$j]["cod"]);
 if($text!="")
  {$archivo = '/documento_'.$funcionarios[$j]["cod"].'_'.date("Y-m-d").'.txt';   
   $fp = fopen($doc_destino.$archivo, "w+");  
   if(fwrite($fp, $text) === FALSE)
     echo ("No fue posible escribir los sql al archivo ".$archivo);
   comprimir($funcionarios[$j]["cod"],$doc_destino);   
   fclose($fp);
  }   
 }
 echo "Terminado"; 
}

// Terminar documentos de un funcionario
function terminar_documentos($codigo)
{ global $conn;
  $text = "";
  $fun = $codigo; //usuario_actual("funcionario_codigo");
  $filtro = "and fecha_inicial < ".fecha_db_almacenar("2009-11-30 23:59:59","Y-m-d H:i:s");
 if(MOTOR=='MySql')
  {
   $doc_usuario = busca_filtro_tabla("distinct documento_iddocumento","asignacion,buzon_salida","(buzon_salida.nombre NOT in('LEIDO','BLOQUEADO','POR_APROBAR') and documento_iddocumento=archivo_idarchivo $filtro) and entidad_identidad=1 and llave_entidad=$fun and  estado='PENDIENTE' and tarea_idtarea=2","",$conn);
   //print_r($doc_usuario);  
    for($i=0; $i<$doc_usuario["numcampos"]; $i++)
     $resultados[]=$doc_usuario[$i]["documento_iddocumento"];
    $resultados=array_unique($resultados);     
    sort($resultados);
    //print_r($resultados);
    //echo "Total $fun - ".count($resultados)."<br />";
    for($i=0; $i<count($resultados); $i++) //
    { //echo "..".$resultados[$i]."..";
      $text .=terminar_doc($resultados[$i],$fun);
    }
  }
  else
  {  
  $doc_usuario = busca_filtro_tabla("documento_iddocumento","asignacion","entidad_identidad=1 and llave_entidad=$fun and  estado='PENDIENTE' and tarea_idtarea=2 $filtro","",$conn);
  
  for($i=0; $i<$doc_usuario["numcampos"]; $i++)
   $resultados[]=$doc_usuario[$i]["documento_iddocumento"];
  $resultados=array_unique($resultados); 
  
  $docs_v=array_chunk(explode(",",implode(",",$resultados)), 1000);
  if(count($docs_v)>1)
    {
     foreach($docs_v as $fila)
        $docs2[]=" A.iddocumento in (".implode(",",$fila).") ";
     $docs=implode(" or ",$docs2);   
    }
   else
    $docs=" iddocumento in (".implode(",",$docs_v[0]).") "; 
  $doc = busca_filtro_tabla("key, decode(documento__numero,0,'--',documento__numero) as documento__numero, documento__fecha_creacion,documento__plantilla, documento__descripcion","(SELECT A.iddocumento as key, A.numero as documento__numero,to_char(A.fecha,'YYYY-MM-DD HH24:MI:SS') as documento__fecha_creacion,A.plantilla as documento__plantilla,A.descripcion as documento__descripcion, COUNT(*) OVER () total_rows, ROW_NUMBER() OVER (ORDER BY A.numero) FILAS FROM documento A,buzon_salida B WHERE (A.estado<>'ELIMINADO') and B.nombre not in('BLOQUEADO','POR_APROBAR') and (B.origen='$fun' or B.destino='$fun') and (".$docs.") and B.archivo_idarchivo=A.iddocumento GROUP BY A.iddocumento, A.numero,A.fecha,A.plantilla,A.descripcion,A.estado)","","",$conn);
  //print_r($doc);
  for($i=0; $i<$doc["numcampos"]; $i++) //
   $text.=terminar_doc($doc[$i]["key"],$fun);
  } 
return $text;
}

function terminar_doc($llave,$codigo)
{ 
  global $conn;  
  $sql_copia ="";    
  $estado=busca_filtro_tabla("estado,numero","documento","iddocumento=".$llave." and estado <> 'ELIMINADO'","",$conn);  
  if($estado["numcampos"]>0)
  {   
    if($estado[0]["estado"]=="ACTIVO")
     { $sql_copia .= "UPDATE documento SET estado = 'ACTIVO' WHERE iddocumento=".$llave.";";
       $actualice = "UPDATE documento SET estado = 'APROBADO' WHERE iddocumento=".$llave;
       phpmkr_query($actualice,$conn);
     }    
    $x_detalle = "Termina por cambio de vigencia 2009-2010 de los documentos sin procesos activos sobre los mismos";       
    $destinos = array(); 
    $destinos[0]=$codigo;//usuario_actual("funcionario_codigo");   
    $fieldList = array();
    $fieldList["origen"] = $codigo;
    $fieldList["archivo_idarchivo"] = $llave;
    $fieldList["nombre"] = 'TERMINADO';
    $fieldList["fecha"] = date("Y-m-d H:i:s");
    $fieldList["respuesta"] = '';
    $fieldList["entregado"] = '';
    $fieldList["recibido"] = '';
    $fieldList["notas"] = $x_detalle;
    $fieldList["ver_notas"] = '';  
    $fieldList["tipo"] = 0;
    $fieldList["ruta"] = '';
    $fieldList["tipo_destino"] = 1;
    $fieldList["serie"] = '';
    $datos_adicionales=array();
  	$datos_adicionales["notas"]="'".$fieldList["notas"]."'";
    $sql_copia.=crear_asignacion($llave,$destinos[0]);      	
    transferir_archivo_prueba($fieldList,$destinos,$datos_adicionales);
    $sql_copia.=eliminar_transferencias($llave,$destinos[0]);
  }   
  return $sql_copia;
}

function crear_asignacion($llave,$fun)
{ global $conn;
  $asig = busca_filtro_tabla("idasignacion,".fecha_db_obtener("fecha_inicial","Y-m-d H:i:s")." as fecha","asignacion","documento_iddocumento=$llave and llave_entidad=$fun","idasignacion DESC",$conn);
  $texto = "INSERT INTO asignacion (documento_iddocumento,tarea_idtarea,fecha_inicial,estado,entidad_identidad,llave_entidad) VALUES ($llave,2,".fecha_db_almacenar($asig[0]["fecha"],'Y-m-d H:i:s').",'PENDIENTE',1,$fun);";   
  return $texto;
} 

function eliminar_transferencias($llave,$fun)
{ global $conn;
  $trans = busca_filtro_tabla("idtransferencia","buzon_entrada","archivo_idarchivo=$llave and nombre like 'TERMINADO' AND  origen='$fun' AND destino = '$fun'","idtransferencia DESC",$conn);
  $texto = "Delete from buzon_entrada where idtransferencia=".$trans[0][0].";";
  $trans = busca_filtro_tabla("idtransferencia","buzon_salida","archivo_idarchivo=$llave and nombre like 'TERMINADO' AND  origen='$fun' AND destino = '$fun'","idtransferencia DESC",$conn);
  $texto.= "Delete from buzon_salida where idtransferencia=".$trans[0][0].";";   
  return $texto;  
}

if(isset($_REQUEST["ejecutar_funcion"])&&$_REQUEST["ejecutar_funcion"])
  $_REQUEST["ejecutar_funcion"]();
?>