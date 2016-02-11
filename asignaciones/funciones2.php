<?php

include_once("db.php");
include_once("../calendario/calendario.php");

/*
 * Dibuja un calendario anual con las asignaciones de un documento 
 */
function busca_func()
{
	
}

function busca_nodos($id = NULL )
{
 global $conn;  
 $resultado=array();
 
if(!isset($id))  //Obtengo la dependencia de mas alto nivel !! sin Padre 
 { 
  $dependencias=busca_filtro_tabla("*","dependencia d","cod_padre is NULL AND d.estado=1","nombre ASC",$conn);
}
else // Dependencias con padre !!
{ 
  $dependencias=busca_filtro_tabla("*","dependencia d","d.cod_padre=$id AND d.estado=1 ","d.nombre ASC",$conn);
  
}
//print_r($dependencias);
if($dependencias["numcampos"])
	{  for($i=0;$i<$dependencias["numcampos"];$i++) 
	    {
	     $artmp=array();
	     $artmp["id"]=$dependencias[$i]["iddependencia"]."#";
	     $array["nombre"] = htmlspecialchars($dependencias[$i]["nombre"]);
         $hijos=busca_filtro_tabla("*","dependencia D","D.cod_padre='".$dependencias[$i]["iddependencia"]."'","iddependencia",$conn);
	     echo "despues <br>";print_r($resultado);	
	      if($hijos["numcampos"]) // El hijo tiene mas hijos recursion 
	        {   
	          $arhijos=busca_nodos($dependencias[$i]["iddependencia"]);
	         
	          $artmp["hijos"]=$arhijos; 
	            
	        }
          array_push($resultado,$artmp); 
          echo "despues <br>";print_r($resultado);	
	    } 
    
     return  $resultado;   
   } // fin if numcampos
 
 return($resultado);      
}



function adicionar_tarea($nombre,$descripcion,$tiempo_respuesta,$idpadre=NULL,$idcontrol=NULL,$arentidad=NULL)
{
	global $conn;
	$sql="INSERT INTO tarea (nombre,descripcion,tiempo_respuesta";
	$valores=" VALUES('$nombre','$descripcion',$tiempo_respuesta";
	if($idpadre)
	{ $sql.=",idpadre";
	  $valores.=",$idpadre";
	}
   if($idcontrol)
	{ $sql.=",idcontrol";
	  $valores.=",$idcontrol";
	}  
  $sql.=")";
  $valores.=")";
  $sql.=$valores;
  echo($sql."<br />");
  phpmkr_query($sql,$conn); 
  $id=phpmkr_insert_id();
  if($arentidad && $id){
    $list_entidad=array();
    $list_dep=array(); 
    $arent=explode(",",$arentidad);
    $res=busca_filtro_tabla("*","entidad","nombre='funcionario'","identidad",$conn);
    $identidadf=$res[0]['identidad'];
    $res=busca_filtro_tabla("*","entidad","nombre='dependencia'","identidad",$conn);
    $identidadd=$res[0]['identidad'];
    foreach($arent AS $entidad){ 
      if(!strstr($entidad, '#')){
    	  array_push($list_entidad,$entidad);
    	}  
    	else{	
        array_push($list_dep,str_replace("#","",$entidad));
      }   
    }
    for($i=0;isset($list_dep[$i]);$i++){
      $sql="INSERT INTO entidad_tarea(entidad_identidad,llave_entidad,tarea_idtarea) VALUES('".$identidadd."','".$list_dep[$i]."',".$id.")";
      phpmkr_query($sql,$conn);
    }  
    for($i=0;isset($list_entidad[$i]);$i++){
      $sql="INSERT INTO entidad_tarea(entidad_identidad,llave_entidad,tarea_idtarea) VALUES('".$identidadf."','".$list_entidad[$i]."',".$id.")";
      phpmkr_query($sql,$conn);
    }    
  }
return($id);
}

function busca_tareas_documento($iddoc){
global $conn;
$tareas=array();
$documento=busca_filtro_tabla("","documento","iddocumento=".@$iddoc,"",$conn);
if($documento["numcampos"]){
  $tareas_series=busca_filtro_tabla("","asignacion","serie_idserie=".$documento[0]["serie"],"",$conn);
  if($tareas_series["numcampos"]){
    $tareas=extrae_campo($tareas_series,"tarea_idtarea","U");
  }
}
else alerta("El sistema no ha podido encontrar el documento",'error',4000);
return($tareas);
}
/*Asigna las tareas a un Documento y define los responsables definidos en la tarea
ademas busca las tareas asignadas a la serie documental de poseer y realiza el proceso
como parametro recibe el id del documento y el listado de  tareas adicionales con el formato array("tarea"=>idtarea,"fecha"=>fecha_inicio_tarea) */

function asignar_tarea_a_documento($iddoc,$ltareas_adicionales=NULL){
global $conn;
$ltareas=busca_tareas_documento($iddoc);
$num_tareas=count($ltareas);
if($num_tareas){
  $tareas=busca_filtro_tabla("","tarea","idtarea IN(".implode(",",$ltareas).")","",$conn);
  $ltareas=array();
}
else $ltareas=array();
for($i=0;$i<$tareas["numcampos"];$i++){
  array_push($ltareas,array("tarea"=>$tareas[$i]["idtarea"],"fecha"=>$tareas[$i]["fecha"]));
}
/*print_r($ltareas);
echo("-------<br />");
print_r($ltareas_adicionales);*/
$totales=array_merge((array)$ltareas_adicionales,(array)$ltareas);
/*echo("+++++++<br />");
print_r($totales);*/
$numero_tareas=count($totales);
for($i=0;$i<$numero_tareas;$i++){
  if(!in_array($totales[$i]["tarea"],$ltareas[$i])){
    $ltareas=$totales[$i]["tarea"];
    $entidades=busca_filtro_tabla("","entidad_tarea","tarea_idtarea=".$totales[$i]["tarea"],"",$conn);
    if($entidades["numcampos"]){
      for($j=0;$j<$entidades["numcampos"];$j++){
        $totales[$i]["llave"]=$entidades[$j]["llave_entidad"];
        $totales[$i]["entidad"]=$entidades[$j]["entidad_identidad"];
  /*      if(isset($tareas_entidad[$ltareas[$i]["entidad"]])){
          array_push($tareas_entidad[$ltareas[$i]["entidad"]],$i);
        }
        else {
          $tareas_entidad[$ltareas[$i]["entidad"]]=array($i);
        }*/
      }
    }
    else {
      $totales[$i]["llave"]=usuario_actual("funcionario_codigo");
      $totales[$i]["entidad"]=1;
      //$tareas_entidad[$ltareas[$i]["entidad"]]=array($i);
    }
    //$ltareas2[$i]["tarea"]=$ltareas[$i][0]["tarea"];
    //$ltareas2[$i]["fecha"]=$ltareas[$i][0]["fecha"];
    asignar_tarea($iddoc,false,$totales[$i]["tarea"],$totales[$i]["llave"],$totales[$i]["entidad"],$totales[$i]["fecha"],NULL);
  }
}
}


function asignar_tarea($iddocumento=false,$idserie=false,$idtarea=false,$list_entidad=NULL,$identidad=NULL,$fecha_inicial=NULL,$fecha_final=NULL){ 
global $conn;
$datos_tarea=busca_filtro_tabla("*","tarea A","A.idtarea=".$idtarea,"",$conn);
if($datos_tarea["numcampos"]){
  $formato = "Y-m-d H:i:s";
  $estado = "PENDIENTE";

  if(!$fecha_inicial)
    $fecha_inicial=date("Y-m-d H:i:s");  
  $ar_fechaini=date_parse($fecha_inicial);
  $anioinicial=$ar_fechaini["year"];
  $mesinicial=$ar_fechaini["month"];
  $diainicial=$ar_fechaini["day"];
  $tiempo_respuesta=$datos_tarea[0]["tiempo_respuesta"]; // En horas
  $id=0;
  if(!$fecha_final)  
    $fecha_final=date($formato, mktime(($ar_fechaini["hour"]+$tiempo_respuesta),$ar_fechaini["minute"] , $ar_fechaini["second"],$mesinicial, $diainicial,$anioinicial));
    if(($idserie||$iddocumento) && isset($idtarea) && $idtarea){

      $responsables=responsables_asignacion($idtarea,1,$list_entidad); // Responsables Funcionarios
      //print_r($responsables);
      for($i=0;$i<$responsables["numcampos"];$i++) {  //array con id's de  Entidades
           if($iddocumento){
                  /*Valida que el documento exista y que no se tenga una asignacion Menor a la que se esta tratando de asignar*/
               $sql="INSERT INTO asignacion (documento_iddocumento,tarea_idtarea,fecha_inicial,fecha_final,estado,fecha_actualizacion,entidad_identidad,llave_entidad) VALUES('".$iddocumento."','".$idtarea."',".fecha_db_almacenar($fecha_inicial,$formato).",".fecha_db_almacenar($fecha_final,$formato).",'".$estado."',".fecha_db_almacenar($fecha_inicial,$formato).",'".$responsables[$i]["entidad"]."','".$responsables[$i]["llave"]."')";
           
               phpmkr_query($sql,$conn) or error("No se Pudo Realizar la insercion de la Asignacion ");
                $id=phpmkr_insert_id();
               }
             else{
              $sql="INSERT INTO asignacion (serie_idserie,tarea_idtarea,fecha_inicial,fecha_final,fecha_actualizacion,entidad_identidad,llave_entidad) VALUES('".$idserie."','".$idtarea."',".fecha_db_almacenar($fecha_inicial,$formato).",".fecha_db_almacenar($fecha_final,$formato).",'".$estado."',".fecha_db_almacenar($fecha_inicial,$formato).",'".$responsables[$i]["entidad"]."','".$responsables[$i]["llave"]."')";
                    phpmkr_query($sql,$conn) or error("No se Pudo Realizar la insercion de la Asignacion ");
                    $id=phpmkr_insert_id();
                  }
                
             }  

        }
   else{
     alerta("Diligencie correctamente los datos e intente nuevamente",'error',4000);
     return FALSE;
  }
}// Fin if $datos_tarea["num_campos"]
else{
  alerta("Error la informacion de la tarea no pudo ser obtenida",'error',4000);
  return(FALSE); 	
}  
return TRUE; 
}
function asignar_tarea_general($iddocumento=false,$idserie=false,$list_entidad=NULL,$entidad_identidad=NULL,$fecha_inicial=NULL,$fecha_final=NULL){
global $conn;
$datos=busca_filtro_tabla("","tarea","documento_iddocumento=-1","",$conn);

}

function responsables_asignacion($idtarea,$identidad,$list_entidad){
global $conn;
$i=0;
$retorno=array();
if($identidad && $list_entidad){
  if(is_array($list_entidad)){
    for(;$i<isset($list_entidad[$i]);$i++){
      $retorno[$i]["llave"]=$list_entidad[$i];
      $retorno[$i]["entidad"]=$identidad;
    }
  }
  else {
    $i=1;
    $retorno[0]["llave"]=$list_entidad;
    $retorno[0]["entidad"]=$identidad;
  }
$retorno["numcampos"]=$i;  
return($retorno);
}
$entidades=busca_filtro_tabla("","entidad_tarea","tarea_idtarea=".$idtarea,"",$conn);
/////Aqui se deben buscar todas las demas entidad
for($j=0;$j<$entidades["numcampos"];$i++,$j++){
  $retorno[$i]["llave"]=$entidades[$j]["llave_entidad"];
  $retorno[$i]["entidad"]=$entidades[$j]["entidad_identidad"];
}

$retorno["numcampos"]=$i;
return($retorno);
}
/*
 * Revisa asignaciones, cambia el estado de las mismas y siexiste alguna tarea de 
 * control para la asignacion genera la nueva asignacion.
 *  
*/

function revisar_fechas_tareas()
{
  global $conn;
   
    
}

function asignaciones_documento($id_documento=NULL,$anio=0,$mes=0,$dia=0,$hora=0,$minuto=0,$segundo=0)
{
$lista_asignaciones=array();
$formato='Y-m-d H:i:s';
$fecha_busca=date($formato, mktime( $hora, $minuto, $segundo, $mes, $dia, $anio));
//Busco asignaciones directamente al documento
$fecha_busca=fecha_db_almacenar($fecha_busca,$formato); // devuelve la fecha el formato adecuado para comparar o almacenar 
$asignaciones=busca_filtro_tabla("idasignacion","asignacion","documento_iddocumento=\"$id_documento\" AND fecha_inicial<=\"$fecha_busca\" AND  fecha_final>=\"$fecha_busca\"","",$conn);

 if($asignaciones["numcampos"]) //hay asignaciones sobre el documento en la fecha recibida
	 {  
	  for($i=0;$i<$asignaciones["numcampos"];$i++) // Se recorren las asignaciones para el documento
	   { 
	      array_push($lista_asignaciones,$asignaciones[$i]["idasignacion"]);
	   }
	            
    }//Fin if asignaciones por documento

$series_doc=busca_filtro_tabla("documento.serie","documento","documento.iddocumento=\"$id_documento\"","",$conn);
$id_serie=$series_doc[0]["serie"];
//Busca asignaciones para la serie a la cual pertenece 
$asignaciones=busca_filtro_tabla("idasignacion","asignacion","serie_idserie=\"$id_serie\" AND fecha_inicial<=\"$fecha_busca\" AND  fecha_final>=\"$fecha_busca\"","",$conn); 
if($asignaciones["numcampos"]) //hay asignaciones sobre el documento en la fecha recibida
	 {  
	  for($i=0;$i<$asignaciones["numcampos"];$i++) // Se recorren las asignaciones para el documento
	   { 
	      array_push($lista_asignaciones,$asignaciones[$i]["idasignacion"]);
	   }
	            
    }//if asignaciones por serie
 // Retrona los identificadores con el listado de asignaciones en la fecha a evaluar 
return $lista_asignaciones;  	
} // Fin Funcion asignaciones_documento

function buscar_asignacion(){

}

function elimina_asignacion($idasignacion){
global $conn;
$entidad=busca_filtro_tabla("","entidad","nombre LIKE 'funcionario'","",$conn);
if($entidad["numcampos"])
  $asignacion=busca_filtro_tabla("B.*","asignacion A,asignacion_entidad B","A.idasignacion=B.asignacion_idasignacion AND A.idasignacion=".$idasignacion." AND B.entidad_identidad=".$entidad[0]["identidad"]." AND B.llave_entidad=".usuario_actual("id"),"",$conn);
if(@$asignacion["numcampos"]){
  $sql="DELETE FROM asignacion_entidad WHERE idasignacion_entidad=".$asignacion[0]["idasignacion_entidad"];
  phpmkr_query($sql,$conn);
  echo($sql."<br />");
  $asignacion2=busca_filtro_tabla("B.*","asignacion A,asignacion_entidad B","A.idasignacion=B.asignacion_idasignacion AND A.idasignacion=".$idasignacion." AND B.entidad_identidad=".$entidad[0]["identidad"],"",$conn);
  if(!$asignacion2["numcampos"]){
    $sql="DELETE FROM asignacion_entidad WHERE asignacion_idasignacion=".$idasignacion;
    phpmkr_query($sql,$conn);
    echo($sql."<br />");
    $sql="DELETE FROM asignacion WHERE idasignacion=".$idasignacion;
    phpmkr_query($sql,$conn);
    echo($sql."<br />");
  }
  return(TRUE);
}
return(FALSE);
}

/*
 * Verifica que una entidad no tenga una tarea Restrictiva pendiente
 * al momento verifica unicamente funcionarios o dep	endencias 
*/
function verificar_restriccion($id_documento,$id_entidad,$llave_entidad)
{
$lista_asignaciones=array(); // retrona array vacio para los demas casos 

switch ($id_entidad)
{ 
   case 1: // funcionarios  busca tareas RESTRICTIVAS SOBRE EL DOCUMENTO para un funcionario y  depen. a las que pertenece   
    $datosfun = busca_datos_administrativos_funcionario($llave_entidad);
    $dependencias= $datosfun["dependencias"];
       // Verifico restricciones sobre dependencias a las cuales pertenece el funcionario
    foreach ($dependencias as $id_dependencia) 
    {
      $restric_depend=$asignaciones=busca_filtro_tabla("A.idasignacion","asignacion A, asignacion_entidad B, tarea C,dependencia D","A.documento_iddocumento=\"$id_documento\" AND A.idasignacion=B.asignacion_idasignacion AND B.entidad_identidad =\"2\" AND B.llave_entidad=$id_dependencia AND B.entidad_identidad=D.iddependencia AND A.tarea_idtarea=C.idtarea AND C.accion=\"RESTRICTIVA\"","",$conn);
      
        if($restric_depend["numcampos"])
        {  
            for($i=0;$i<$restric_depend["numcampos"];$i++)
            { 
              array_push($lista_asignaciones,$restric_depend[$i]["idasignacion"]); // adiciona al listado de tareas restrictivas sobre el documento
              
            }
        }
         	       
    } 
      // Verifico restricciones sobre el funcionario directamente
  $restric_funcionario=busca_filtro_tabla("A.idasignacion","asignacion A, asignacion_entidad B, tarea C","A.documento_iddocumento=\"$id_documento\" AND A.idasignacion=B.asignacion_idasignacion AND B.entidad_identidad =$id_entidad AND B.llave_entidad=$llave_entidad AND A.tarea_idtarea=C.idtarea AND C.accion=\"RESTRICTIVA\"","",$conn);   
	if($restric_funcionario["numcampos"])
        {  
            for($i=0;$i<$restric_funcionario["numcampos"];$i++)
            { 
              array_push($lista_asignaciones,$restric_funcionario[$i]["idasignacion"]); // adiciona al listado de tareas restrictivas sobre el documento
            }
        }
  return $lista_asignaciones;     
  break;  
   
  case 2:
    $restric_depend=$asignaciones=busca_filtro_tabla("A.idasignacion","asignacion A, asignacion_entidad B, tarea C,dependencia D","A.documento_iddocumento=\"$id_documento\" AND A.idasignacion=B.asignacion_idasignacion AND B.entidad_identidad =\"2\" AND B.llave_entidad=$llave_entidad AND B.entidad_identidad=D.iddependencia AND A.tarea_idtarea=C.idtarea AND C.accion=\"RESTRICTIVA\"","",$conn);
    if($restric_depend["numcampos"])
      { for($i=0;$i<$restric_depend["numcampos"];$i++)
          { 
            array_push($lista_asignaciones,$restric_depend[$i]["idasignacion"]); // adiciona al listado de tareas restrictivas sobre el documento
             
          }
      }
 return $lista_asignaciones;  
  break;  	 	
 } 
	
}


?>
