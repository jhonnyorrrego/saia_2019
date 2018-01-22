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
//Esta busqueda no se puede hacer generica, debido a que la consulta particular de las series en este caso deben hacerse sobre el compuesto de 2 tablas 
/*if($_REQUEST['tabla']){
	$tabla=$_REQUEST['tabla'];
	$busca_papas=busca_filtro_tabla("A.idserie,A.nombre,A.cod_padre,B.llave_entidad","serie A,entidad_serie B","lower(nombre) like(lower('%".$_REQUEST['nombre']."%')) AND entidad_identidad=2","",$conn);
	$resultados=array();
	for ($i=0; $i < $busca_papas['numcampos']; $i++) {
		$campos = array();
		$valor_arreglo=$busca_papas[$i]["llave_entidad"]."sub".$busca_papas[$i]["idserie"];
		lista_papas($busca_papas[$i]['idserie'], $campos,$valor_arreglo);
		$resultados[]=array_reverse(array_unique($campos));
	}
	//busca_dependencias para generar las dependencias papas
	
	echo(json_encode($resultados));
}
function lista_papas($id,&$campos,$valor_arreglo){
	global $conn;
	$campos[]=$valor_arreglo;
	$buscar_campo=busca_filtro_tabla("cod_padre","serie A, entidad_serie B","A.idserie=B.serie_idserie AND A.cod_padre IS NOT NULL AND B.entidad_identidad=2 AND A.idserie=".$id,"",$conn);
	
	if($buscar_campo["numcampos"]){
		$valor_arreglo=$buscar_campo[0]["llave_entidad"]."sub".$buscar_campo[0]["cod_padre"];
		lista_papas($buscar_campo[0]["cod_padre"], $campos,$valor_arreglo);
	}
}*/


//------cambio cristian

if($_REQUEST['tabla']){
	$tabla=$_REQUEST['tabla'];
	
	$busca_papas=busca_filtro_tabla("id".$tabla.",nombre,cod_padre",$tabla,"lower(nombre) like(lower('%".$_REQUEST['nombre']."%'))","",$conn);
	global $serie_base,$entidad_base,$dependencia_base,$dependencia_base2,$ind_dependencia,$puntero_array;
	$puntero_array=0;
	$serie_base=array();
	$resultados=array();
		for ($i=0; $i < $busca_papas['numcampos']; $i++) {
			$ind_dependencia='';
			
			$campos = array();
			lista_papas($busca_papas[$i]['id'.$tabla], $campos,$tabla,$puntero_array);
			if($ind_dependencia!=''){
				$serie_base[$puntero_array][]=$ind_dependencia.'sub'.$busca_papas[$i]['idserie'];
				$serie_base[$puntero_array]=array_reverse($serie_base[$puntero_array]);
				$puntero_array=$puntero_array+1;
				
			}
			
			
			//$resultados[]=array_reverse(array_unique($campos));
		}

		/*print_r($serie_base);
		echo('<br/>--------------<br/>');
		print_r($entidad_base);
		echo('<br/>--------------<br/>');
		print_r($dependencia_base2);*/
		
		$resultados['serie_base']=$serie_base;
		$resultados['entidad_base']=$entidad_base;
		$resultados['dependencias']=$dependencia_base2;
		
		echo(json_encode($resultados));
}
function lista_papas($id,&$campos,$tabla,$idserie_base){
	global $conn,$serie_base,$ind_dependencia;
	
	$campos[]=$id;
	$buscar_campo=busca_filtro_tabla("cod_padre",$tabla,"cod_padre IS NOT NULL AND id".$tabla."=".$id,"",$conn);
	
	if($buscar_campo["numcampos"]){
		
		lista_papas($buscar_campo[0]["cod_padre"], $campos,$tabla,$idserie_base);
		if($ind_dependencia!=''){
			$serie_base[$idserie_base][]=$ind_dependencia.'sub'.$buscar_campo[0]['cod_padre'];
		}
	}else{
		listar_entidad($id,'entidad_serie');
	}
	
}

function listar_entidad($id,$tabla){
	global $conn,$serie_base,$entidad_base,$dependencia_base,$dependencia_base2,$ind_dependencia;
	
	$buscar_campo=busca_filtro_tabla("",$tabla,"entidad_identidad=2 and serie_idserie=".$id,"",$conn);
	for ($i=0; $i < $buscar_campo['numcampos']; $i++) {
		$ind_dependencia=$buscar_campo[$i]['llave_entidad'];
		$entidad_base[]=$buscar_campo[$i]['llave_entidad'].'sub'.$buscar_campo[$i]['serie_idserie'];
		$buscar_dependencia=busca_filtro_tabla("cod_padre",'dependencia',"cod_padre IS NOT NULL and iddependencia=".$buscar_campo[$i]['llave_entidad'],"",$conn);
		$dependencia_base2[$i][]='d'.$buscar_campo[$i]['llave_entidad'];
		$dependencia_base[]=$buscar_campo[$i]['llave_entidad'];
		if($buscar_dependencia["numcampos"]){
			$dependencia_base[]=$buscar_dependencia[0]['cod_padre'];
			$dependencia_base2[$i][]='d'.$buscar_dependencia[0]['cod_padre'];
			listar_dependencia($buscar_dependencia[0]['cod_padre'],$i);
		}
		$dependencia_base2[$i]=array_reverse($dependencia_base2[$i]);
	}
}

function listar_dependencia($iddependencia,$iddep_base){
	global $conn,$serie_base,$entidad_base,$dependencia_base;
		$buscar_dependencia=busca_filtro_tabla("cod_padre",'dependencia',"cod_padre IS NOT NULL and iddependencia=".$iddependencia,"",$conn);
		$dependencia_base2[$i][]='d'.$iddependencia;
		$dependencia_base[]=$iddependencia;
		if($buscar_dependencia["numcampos"]){
			$dependencia_base[]=$buscar_dependencia[0]['cod_padre'];
			$dependencia_base2[$i][]='d'.$buscar_dependencia[0]['cod_padre'];
			listar_dependencia($buscar_dependencia[0]['cod_padre'],$iddep_base);
		}
}
?>