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
/*Adicionado para hacer las acciones del flujo */
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."bpmn/librerias_formato.php");
/*<Clase>
<Nombre>listar_acciones_formato</Nombre>
<Parametros>$idformato:id del formato;$accion:nombre de la accion;$momento:en que momento se debe ejecutar la accion(anterior,posterior)</Parametros>
<Responsabilidades>Retorna los id de las funciones que han sido asociadas al formato por medio de una accion<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>cadena de numeros separados por pipe(|)</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function listar_acciones_formato($idformato,$accion=NULL,$momento=NULL){
global $conn;
if($accion) // Se buscan las acciones particulares
  $acciones=busca_filtro_tabla("","accion","accion.nombre='".$accion."'","",$conn);
else
  $acciones=busca_filtro_tabla("","accion","","",$conn);

if($acciones["numcampos"]){
  // Hay acciones por ejemplo para el  ADICIONAR  idaccion=1
  //Se determina la accion pertenece a alguna relacion con el formato
  $condicion= "formato_idformato=".$idformato." AND accion_idaccion=".$acciones[0]["idaccion"];
  if($momento){ // Se buscan funciones para ejecutar antes o despues
    $condicion.=" AND momento='".$momento."'";
  }
  // Funciones relacionadas con la accion y el formato
  $funciones_asociadas=busca_filtro_tabla("","funciones_formato_accion",$condicion,"orden asc",$conn);

  if($funciones_asociadas["numcampos"]>0){
    $retorno="";
    $retorno=$funciones_asociadas[0]["idfunciones_formato"];
    for($i=1;$i<$funciones_asociadas["numcampos"];$i++){
      $retorno.="|".$funciones_asociadas[$i]["idfunciones_formato"];

    }

    return($retorno);
  }
  else
    return(NULL);
}
}
/*<Clase>
<Nombre>adicionar_accion</Nombre>
<Parametros>$nombre:nombre de la acci�n;$ruta:ruta del archivo que contiene la funcion;$funcion:funci�n a llamar;$parametros:parametros que se deben pasar a la funcion;$descripcion:explicaci�n corta sobre su funcionamiento</Parametros>
<Responsabilidades>Adiciona un registro en la tabla accion<Responsabilidades>
<Notas>NO SE EST� USANDO EN NINGUNA PARTE</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase> */
/*
function adicionar_accion($nombre,$ruta,$funcion,$parametros,$descripcion){
global $conn;
$sql="INSERT INTO accion(nombre,ruta,funcion,parametros,descripcion) VALUES(";
$sql.="'".$nombre."','".$ruta."','".$funcion."','".$parametros."','".$descripcion."')";
$res=phpmkr_query($sql,$conn);
return($res);
}
*/

/*<Clase>
<Nombre></Nombre>
<Parametros></Parametros>
<Responsabilidades><Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function adicionar_funciones_accion($idaccion=NULL,$idformato=NULL,$idfunciones_formato=NULL,$momento="ANTERIOR",$estado=1){
global $conn;
if($idaccion==NULL||$idformato==NULL||$idfunciones_formato==NULL)
  return(FALSE);
$datos_accion=busca_filtro_tabla("idaccion","accion","idaccion=".$idaccion,"",$conn);
$datos_formato=busca_filtro_tabla("idformato","formato","idformato=".$idformato,"",$conn);
$datos_funciones_formato=busca_filtro_tabla("idfunciones_formato","funciones_formato","idfunciones_formato=".$idfunciones_formato,"",$conn);
//Se verifican los datos antes de registrar la relacion
$datos_funcion_accion=busca_filtro_tabla("","funciones_formato_accion","idfunciones_formato=".$idfunciones_formato." AND accion_idaccion=".$idaccion." AND formato_idformato=".$idformato,"",$conn);
if(!$datos_funcion_accion["numcampos"] && $datos_accion["numcampos"]>0&&$datos_formato["numcampos"]>0&&$datos_funciones_formato["numcampos"]>0){
  $sql="INSERT INTO funciones_formato_accion(accion_idaccion,formato_idformato,idfunciones_formato,momento) VALUES(";
  $sql.=$idaccion.",".$idformato.",".$idfunciones_formato.",'".$momento."')";
  $res=phpmkr_query($sql,$conn);
}
else if($datos_funcion_accion["numcampos"]){
  alerta("La Funcion ya se encuentra asiganda al formato");
  return(false);
}
else{
  alerta("Los parametros para asignar la asignacion son incorrectos");
  return(false);
}
return(true);
}
/*<Clase>
<Nombre>modificar_funciones_accion</Nombre>
<Parametros>$idaccion:id de la accion;$idformato:id del formato;$idfunciones_formato:id de la funci�n;$momento:nombre del momento;$estado:activo o inactivo;$accion_funcion:id de registro a modificar</Parametros>
<Responsabilidades>Modifica los parametros de una funci�n que se encuentra asociada a un formato por medio de una acci�n<Responsabilidades>
<Notas>tabla funciones_formato_accion</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones>llenar el formato de edici�n<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function modificar_funciones_accion($idaccion=NULL,$idformato=NULL,$idfunciones_formato=NULL,$momento=NULL,$estado=NULL,$accion_funcion=0){
global $conn;
if($accion_funcion){
  $campos=array();
  if($idaccion)
    array_push($campos," accion_idaccion=".$idaccion);
  if($momento!==NULL)
    array_push($campos," momento='".$momento."'");
  if($estado!==NULL)
    array_push($campos," estado=".$estado);
  if($idfunciones_formato){
    array_push($campos," idfunciones_formato=".$idfunciones_formato);
  }
  if(count($campos)){
    $sql="UPDATE funciones_formato_accion SET ".implode(",",$campos)." WHERE idfunciones_formato_accion=".$accion_funcion;
    phpmkr_query($sql,$conn);
    return(true);
  }
}
else{
  return(false);
}
}
/*<Clase>
<Nombre>eliminar_funciones_accion</Nombre>
<Parametros>$idaccion:id de la accion;$idformato:id del formato;$idfunciones_formato:id de la funci�n;$momento:nombre del momento;$estado:activo o inactivo;$accion_funcion:id de registro a modificar</Parametros>
<Responsabilidades>Elimina la relaci�n entre una funci�n, un formato y una acci�n<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function eliminar_funciones_accion($idaccion=NULL,$idformato=NULL,$idfunciones_formato=NULL,$momento=NULL,$estado=NULL,$accion_funcion=0){
global $conn;
if($accion_funcion){
    $sql="DELETE FROM funciones_formato_accion WHERE idfunciones_formato_accion=".$accion_funcion;
    phpmkr_query($sql,$conn);
    return(true);
}
else{
  alerta("No ha sido posible eliminar la asignacion");
  return(false);
}
}
/*<Clase>
<Nombre>ejecutar_funcion</Nombre>
<Parametros>$nombre_funcion:nombre de la funci�n a ejecutar;$ubicacion:ruta del archivo que la contiene;$parametros:parametros que se le deben pasar</Parametros>
<Responsabilidades>Ejecuta la funci�n especificada<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function ejecutar_funcion($nombre_funcion,$ubicacion=NULL,$parametros=NULL){

  if(function_exists($nombre_funcion)){

    if(call_user_func_array($nombre_funcion,explode(",",$parametros))!==false)
      return(true);
  }
return(false);
}
/*<Clase>
<Nombre>ejecutar_acciones_formato</Nombre>
<Parametros>$iddoc:id del documento;$idformato:id del formato;$listado_func:nombres de las funciones separadas por (|);$lista_parametros:lista de parametros separados por (,)</Parametros>
<Responsabilidades>Ejecuta una lista de funciones, las ejecuta en el mismo orden en que llegaron sus id<Responsabilidades>
<Notas>En el mismo orden se reciben los parametros de cada func ej   45,"b"|234 serian los paramatros de las 2 primeras funciones</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */

function ejecutar_acciones_formato($iddoc=NULL,$idformato=NULL,$listado_func=NULL,$lista_parametros=NULL){
global $conn,$ruta_db_superior;
if(!$listado_func)
  return FALSE;
$ar_func=explode("|",$listado_func);
$encontrado=0;

	$ruta = null;
for($i=0;$i<count($ar_func);$i++){
  $datos_funcion=busca_filtro_tabla("","funciones_formato","idfunciones_formato=".$ar_func[$i],"",$conn);
  if($datos_funcion["numcampos"]){
    if(!function_exists($datos_funcion[0]["nombre_funcion"])){
      include_once($ruta_db_superior."class_transferencia.php");
      $datos_formato=busca_filtro_tabla("","formato","idformato IN(".$datos_funcion[0]["formato"].")","",$conn);

      for($j=0;$j<$datos_formato["numcampos"];$j++){
      	$ruta=$ruta_db_superior.FORMATOS_CLIENTE.$datos_formato[$j]["nombre"]."/".$datos_funcion[0]["ruta"];
        if(is_file($ruta)){
          include_once($ruta);
          if(function_exists($datos_funcion[0]["nombre_funcion"])){
            $encontrado=1;
            break;
          }
        }
      }
			} else {
      $encontrado=1;
    }

    if($encontrado){

      if($datos_funcion[0]["parametros"]==""){
        $datos_funcion[0]["parametros"]=$idformato.','.$iddoc;
	  } else {
       $datos_funcion[0]["parametros"]=$idformato.','.$iddoc.",".$datos_funcion[0]["parametros"];      
      }
      ejecutar_funcion($datos_funcion[0]["nombre_funcion"],$ruta,$datos_funcion[0]["parametros"]);
    }
	}
}
}
/*<Clase>
<Nombre>llama_funcion_accion</Nombre>
<Parametros>$iddoc:id del documento;$idformato:id del formato;$accion:acci�n relacionada;$momento:momento de ejecucion(anterior,posterior)</Parametros>
<Responsabilidades>Busca y ejecuta las funciones dada una accion y un formato<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function llama_funcion_accion($iddoc=NULL,$idformato=NULL,$accion=NULL,$momento=NULL){
global $conn;
if($momento=="ANTERIOR" && $accion!='adicionar' && $accion!='responder' && $accion!='transferir'){
  terminar_actividad_paso($iddoc,$accion);
}
if($momento=='POSTERIOR' && ($accion=='adicionar' || $accion=='responder' || $accion=='transferir')){
  terminar_actividad_paso($iddoc,$accion);
}
//error($iddoc."-->".$idformato."-->".$accion."-->".$momento);
$listado_acciones=listar_acciones_formato($idformato,$accion,$momento);
if($listado_acciones != ""){
  ejecutar_acciones_formato($iddoc,$idformato,$listado_acciones);
}
}


/*
function llama_funcion_accion($iddoc=NULL,$idformato=NULL,$accion=NULL,$momento=NULL){
global $conn;
if($momento=="POSTERIOR")
  terminar_actividad_paso($iddoc,$accion);
$listado_acciones=listar_acciones_formato($idformato,$accion,$momento);
if($listado_acciones != ""){
  ejecutar_acciones_formato($iddoc,$idformato,$listado_acciones);
}
}

*/

?>
