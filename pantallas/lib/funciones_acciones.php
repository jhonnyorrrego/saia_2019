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
/*<Clase>
<Nombre>listar_acciones_pantalla</Nombre>
<Parametros>$idpantalla:id de la pantalla;$accion:nombre de la accion;$momento:en que momento se debe ejecutar la accion(anterior,posterior)</Parametros>
<Responsabilidades>Retorna los id de las funciones que han sido asociadas a la pantalla por medio de una accion<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida>cadena de numeros separados por pipe(|)</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function listar_acciones_pantalla($idpantalla,$accion=NULL,$momento=NULL){
	global $conn;
	if(strtolower($momento)=='anterior'){
		$momento=1;
	}
	if(strtolower($momento)=='posterior'){
		$momento=2;
	}
	$funciones=busca_filtro_tabla("A.idpantalla_funcion_exe","pantalla_funcion_exe A","A.accion='".strtolower($accion)."' AND A.momento='".$momento."' AND pantalla_idpantalla='".$idpantalla."'","orden asc",$conn);
	$id_funciones=extrae_campo($funciones,"idpantalla_funcion_exe");
	$texto=implode("|",$id_funciones);
	return($texto);
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

    if(call_user_func_array($nombre_funcion,explode("|",$parametros))!==false)
      return(true);
  }
return(false);
}
/*<Clase>
<Nombre>ejecutar_acciones_pantalla</Nombre>
<Parametros>$iddoc:id del documento;$idpantalla:id de la pantalla;$listado_func:nombres de las funciones separadas por (|);$lista_parametros:lista de parametros separados por (,)</Parametros>
<Responsabilidades>Ejecuta una lista de funciones, las ejecuta en el mismo orden en que llegaron sus id<Responsabilidades>
<Notas>En el mismo orden se reciben los parametros de cada func ej   45,"b"|234 serian los paramatros de las 2 primeras funciones</Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
   
function ejecutar_acciones_pantalla($iddoc=NULL,$idpantalla=NULL,$listado_func=NULL,$lista_parametros=NULL){
	global $conn,$ruta_db_superior;
	if(!$listado_func)
	  return FALSE;
	$ar_func=explode("|",$listado_func);
	$cant=count($ar_func);
	for($i=0;$i<$cant;$i++){
		$encontrado=0;
	  $datos_funcion=busca_filtro_tabla("C.nombre as nombre_funcion, E.ruta as ruta_libreria, B.nombre as nombre_parametro, B.tipo as tipo_parametro, B.valor as valor_parametro, D.nombre as nombre_pantalla","pantalla_funcion_exe A, pantalla_func_param B, pantalla_funcion C, pantalla D, pantalla_libreria E","A.idpantalla_funcion_exe=".$ar_func[$i]." AND A.idpantalla_funcion_exe=B.fk_idpantalla_funcion_exe AND A.fk_idpantalla_funcion=C.idpantalla_funcion AND A.pantalla_idpantalla=D.idpantalla AND C.fk_idpantalla_libreria=E.idpantalla_libreria","",$conn);
		
	  if($datos_funcion["numcampos"]){
	    if(!function_exists($datos_funcion[0]["nombre_funcion"])){
	      include_once($ruta_db_superior.$datos_funcion[0]["ruta_libreria"]);
				if(function_exists($datos_funcion[0]["nombre_funcion"])){
					$encontrado=1;
				}
			}
			else{
				$encontrado=1;
			}			
			if($encontrado){
				$parametros=array();
				//$clase=new $datos_funcion[0]["nombre_pantalla"]();
				for($j=0;$j<$datos_funcion["numcampos"];$j++){
					if($datos_funcion[$j]["tipo_parametro"]==1){
						$nombre_campo=busca_filtro_tabla("A.nombre","pantalla_campos A","A.idpantalla_campos=".$datos_funcion[$j]["valor_parametro"],"",$conn);
						$obtener_valor=busca_filtro_tabla($nombre_campo[0]["nombre"]." as valor",$datos_funcion[0]["nombre_pantalla"]." A","A.documento_iddocumento=".$iddoc,"",$conn);
						
						$parametros[]=$obtener_valor[0]["valor"];
						//$parametros[]=$clase->get_valor_ft_comunicacion_interna($datos_funcion[0]["nombre_pantalla"],$datos_funcion[$i]["valor_parametro"]);
					}
					else if($datos_funcion[$j]["tipo_parametro"]==2){
						$parametros[]=$datos_funcion[$j]["valor_parametro"];
					}
					else if($datos_funcion[$j]["tipo_parametro"]==3){
						$parametros[]=$_REQUEST[$datos_funcion[$j]["valor_parametro"]];
					}
				}
      	ejecutar_funcion($datos_funcion[0]["nombre_funcion"],$datos_funcion[0]["ruta_libreria"],implode("|",$parametros));
    	}
		}
	}
}
/*<Clase>
<Nombre>llama_funcion_accion</Nombre>
<Parametros>$iddoc:id del documento;$idpantalla:id de la pantalla;$accion:acci�n relacionada;$momento:momento de ejecucion(anterior,posterior)</Parametros>
<Responsabilidades>Busca y ejecuta las funciones dada una accion y un formato<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
function llama_funcion_accion($iddoc=NULL,$idpantalla=NULL,$accion=NULL,$momento=NULL){
	global $conn;
	$listado_acciones=listar_acciones_pantalla($idpantalla,$accion,$momento);
	if($listado_acciones != ""){
	  ejecutar_acciones_pantalla($iddoc,$idpantalla,$listado_acciones);
	}
}
?>
