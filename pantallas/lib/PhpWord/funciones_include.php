<?php


function arma_funcion_exportar_word($nombre,$parametros,$accion){

if($accion=="mostrar")
	$ejecutar_funcion=$nombre($parametros,$_REQUEST['iddoc']);

	return $ejecutar_funcion;
}



function incluir_exportar_word($cad,$tipo,$eval=0){
global $incluidos;
  $includes="";
  $lib=explode(",",$cad);
  switch($tipo){
    case "librerias":
     include_once($cad);
    break;
    case "javascript":
      $texto1='<script type="text/javascript" src="';
      $texto2='"></script>';
    break;
    case "estilos":
      $texto1='<link rel="stylesheet" type="text/css" href="';
      $texto2='"/>';
    break;
    default:
      return(""); //retorna un vacio si no existe el tipo
    break;
  }
  for($j=0;$j<count($lib);$j++){
    $pos=array_search($texto1.$lib[$j].$texto2,$incluidos);
    if($pos===false){
      if(!is_file($lib[$j])&$eval){
        if(crear_archivo($lib[$j])){
          $includes.=$texto1.$lib[$j].$texto2;
        }
        else {
          alerta("Problemas al generar el Formato en ".$lib[$j]);
          return("");
        }
      }
      else {
        $includes.=$texto1.$lib[$j].$texto2;
      }
      array_push($incluidos,$texto1.$lib[$j].$texto2);
    }
  }
  include($includes);
}


function incluir_libreria_exportar_word($nombre,$tipo){

  if(!is_file($nombre)){
    if(crear_archivo($nombre)){
      incluir_exportar_word($nombre,$tipo);
    }
    else alerta("No es posible generar el archivo ".$nombre);
  }
  else incluir_exportar_word($nombre,$tipo);

}


function mostrar_estado_documento($iddoc){
	global $conn;

	$estado_documento=busca_filtro_tabla("estado","documento","iddocumento=".$iddoc,"",$conn);
	$retorno='';

	if($estado_documento['numcampos']){
		switch($estado_documento[0]['estado']){
			case 'ACTIVO':
				$retorno='BORRADOR';
				break;
			case 'ANULADO':
				$retorno='ANULADO';
				break;
			default:
				$retorno='';
				break;
		}

	}else{
		$retorno='';
	}
	return $retorno;
}

?>
