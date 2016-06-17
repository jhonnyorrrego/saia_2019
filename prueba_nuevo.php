<?php 


include_once('db.php');


$nombre="ft_proceso";
$formato=busca_filtro_tabla("A.idformato,A.nombre,A.nombre_tabla,A.etiqueta","formato A","A.nombre_tabla LIKE '".$nombre."'","idformato DESC",$conn);



 $imagenes=' im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
 $iddoc=$formato[0]["idformato"]."-".$formato[0]["nombre"]."-".$formato[0]["nombre_tabla"];
 
 $arreglo=explode("-",$iddoc);  
 $campo_ordenar=busca_filtro_tabla("c.nombre,nombre_tabla","campos_formato c,formato f","formato_idformato=idformato and (c.banderas like 'oc' or c.banderas like '%,oc' or c.banderas like 'oc,%' or c.banderas like '%,oc,%') and f.nombre='".strtolower($arreglo[1])."'","",$conn);
 
  if($campo_ordenar["numcampos"])
   { $orden="b.".$campo_ordenar[0]["nombre"]." asc";
   }
 else
   $orden="iddocumento asc"; 
  $imagen_nota="";
  $validacion_macroproceso='';  
  if(@$arreglo[3] && $arreglo[1]=="proceso"){
    $validacion_macroproceso=" AND documento_iddocumento=".$arreglo[3];
  }
 
 
  if($campo_ordenar["numcampos"]){ 
    $formato=busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento","documento A,".$campo_ordenar[0]["nombre_tabla"]." b","documento_iddocumento=iddocumento AND A.estado<>'ELIMINADO'".$validacion_macroproceso,$orden,$conn);
  }  
  
  for($i=0;$i<$formato["numcampos"];$i++){
      $papas=busca_filtro_tabla("id".$arreglo[2]." AS llave,'".$arreglo[2]."' AS nombre_tabla",$arreglo[2],"documento_iddocumento=".$formato[$i]["iddocumento"],"",$conn);
    if($papas["numcampos"])
      $iddoc=$arreglo[0]."-".$papas[0]["llave"]."-id".$arreglo[2];
    else $iddoc=0;
  
  
   llena_datos_formato($iddoc,0);
   
  
   
   
   
   
   
  }  
  
  
  
  
  function llena_datos_formato($formato,$estado=0){
global $conn,$texto,$imagenes,$formatos_calidad;
$arreglo=explode("-",$formato);
$formato=busca_filtro_tabla("","formato","idformato='".$arreglo[0]."'","",$conn);



if($formato["numcampos"]){
  $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%d%'","",$conn);    
 
  if($descripcion["numcampos"]){
    $campo_descripcion=$descripcion[0]["nombre"];
  }
  else{
    $campo_descripcion="id".$formato[0]["nombre_tabla"];
  }
  $idformato=$formato[0]["idformato"]."-".$arreglo[1]."-".$arreglo[2]."-".$arreglo[0];
  
   
  //echo($idformato."<br />");
  $imagenes='im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
  if($estado){
    $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
    $texto.=strip_tags('text="'.decodifica(utf8_encode(html_entity_decode(htmlspecialchars_decode($formato[0]["etiqueta"])))).'" id="'.$formato[0]["idformato"]."-".$arreglo[2]."-r".rand().'">'."\n");
  }
  
  
	if(($formato[0]["nombre"]=="proceso")){
	    llena_datos($idformato,$formato[0]["nombre_tabla"],$campo_descripcion);
	}
	else if(isset($_REQUEST["id"])){
		llena_datos($idformato,$formato[0]["nombre_tabla"],$campo_descripcion);
	}
  if($estado)
    $texto.="</item>\n";
  /*Aqui se deben adicionar los formatos o consideraciones adicionales para el arbol de calidad. Especificamente la parte de Planes de Mejoramiento para los procesos*/
}
return;
}
function decodifica($cadena){
return(str_replace('"','',(htmlspecialchars(strip_tags($cadena)))));
}
function llena_datos($idformato,$tabla,$campo,$categoria){//--
	global $conn,$texto,$imagenes,$validar_macro;
	$where_serie='';
	$arreglo=explode("-",$idformato);
	
	
	
	//echo("<br />".$idformato."<br />");
	$estado=busca_filtro_tabla("estado",$tabla,$arreglo[2]."=".$arreglo[1],"",$conn);
	
	$campo_ordenar=busca_filtro_tabla("c.nombre,nombre_tabla","campos_formato c,formato f","formato_idformato=idformato and (c.banderas like 'oc' or c.banderas like '%,oc' or c.banderas like 'oc,%' or c.banderas like '%,oc,%') and f.idformato='".strtolower($arreglo[0])."'","",$conn);
	
	 if($campo_ordenar["numcampos"])
	   { $orden="a.".$campo_ordenar[0]["nombre"]." asc";
	   }
	 else
	   $orden="id$tabla asc";  
	if($tabla=="ft_proceso" && !$validar_macro){
	    
	    
	  $dato = busca_filtro_tabla("",$tabla,$arreglo[2]."=".$arreglo[1],"",$conn);
	  
	  print_r($dato);die();
	  if($dato["numcampos"] && @$dato[0]["macroproceso"]!=''){
	    return($texto);
	  }
	}  
	if($categoria){
		
		$where_serie=" AND a.serie_idserie=".$categoria;
	}
	if($estado["numcampos"])
	$dato=busca_filtro_tabla("a.".$campo.",documento_iddocumento,id".$tabla,$tabla." a,documento b",$arreglo[2]."=".$arreglo[1]." AND a.estado<>'INACTIVO' and b.estado<>'ELIMINADO' and documento_iddocumento=iddocumento".$where_serie,$orden,$conn);
	else
	$dato=busca_filtro_tabla($campo.",documento_iddocumento,id".$tabla,$tabla." a,documento b",$arreglo[2]."=".$arreglo[1]." and b.estado<>'ELIMINADO' and documento_iddocumento=iddocumento".$where_serie,$orden,$conn);
	$imagen_nota="";
	if($tabla=="ft_norma_proceso") 
	     {$nota=busca_filtro_tabla("",$tabla." a",$arreglo[2]."=".$arreglo[1],$orden,$conn);
	     }
	for($i=0;$i<$dato["numcampos"];$i++){
	  $texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
		if($tabla=="ft_proceso"){
			$texto.=' child="1" ';
		}
	  $llave=$arreglo[0]."-".$arreglo[2]."-".$dato[$i]["id".$tabla];
	 // $texto.=strip_tags('text="'.decodifica(utf8_encode(html_entity_decode(htmlspecialchars_decode($dato[$i][$campo])))).'" id="'.$llave.'">');
	 $texto.=strip_tags('text="'.decodifica(utf8_encode(html_entity_decode(htmlspecialchars_decode(mostrar_valor_campo($campo,$arreglo[0],$dato[$i]["documento_iddocumento"],1))))).'" id="'.$llave.'">');
	  if(@$dato[$i]["nombre"]=="EVALUACION INDEPENDIENTE" && $tabla=="ft_proceso" && isset($_REQUEST["id"])){
	     crear_dato_formato('ft_elemento_subproceso');
	  }
		if(isset($_REQUEST["id"]))
	  	llena_hijos($arreglo[0],$dato[$i]["id".$tabla],$tabla);
	  $texto.="</item>\n";
	}
	return($texto);
}
  
 //print_r($formato);
 
?>

