<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1


if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ){
  header("Content-type: application/xhtml+xml");
}else{
  header("Content-type: text/xml");
}

$imagenes="";


$formatos_calidad=array('ft_proceso','ft_procedimiento','ft_instructivo','ft_manual','ft_guia','ft_plan_calidad','ft_otros_calidad','ft_formato','ft_listados_maestros','ft_plan_mejoramiento','ft_hallazgo_plan_mejoramiento','ft_seguimiento_plan_mejoramiento','ft_mision_calidad','ft_vision_calidad','ft_objetivos_calidad','ft_politicas','ft_riesgos_proceso','ft_macroproceso','ft_proceso_macroproceso','ft_subproceso','ft_politicas_macroproceso','ft_guia_educacion','ft_instructivo_educacion','ft_formato_educacion','ft_politicas_proceso','ft_norma_meci','ft_elemento_subproceso','ft_componente_subsistema','ft_documentos_meci','ft_norma','ft_documentos_consulta','ft_gestion_educativo','ft_docu_calidad_edu','ft_programas','ft_norma_proceso','ft_norma_procedimiento','ft_indicadores_calidad', 'ft_docu_calidad_edu_macro','ft_normograma');

$id = @$_GET["id"];
$validar_macro=0;


$texto="<?xml version='1.0' encoding='UTF-8' ?>\n";
$texto.="<tree id='0'>\n";
llenar_formatos();
$texto.="</tree>\n";

echo($texto);

function llenar_formatos(){
	global $texto;
	
	crear_dato_formato('ft_mision_calidad');
	crear_dato_formato('ft_vision_calidad');
	crear_dato_formato('ft_objetivos_calidad');
	crear_dato_formato('ft_politicas');
	crear_dato_formato('ft_valores_calidad');
	crear_dato_formato('ft_proceso');
  
	$texto.="<item style='font-family:verdana; font-size:7pt;'";
	
	$identificador = "pm-general-r"; 
	
	$identificador = str_replace("_","##",$identificador);
	
	$texto.=strip_tags(" text='Planes de mejoramiento' id='".$identificador."'>\n");
	
	planes_mejoramiento_institucional();
	planes_mejoramiento_funcional();
	planes_mejoramiento_individual();
	$texto.="</item>\n";
	crear_dato_formato('ft_normograma');
}

function crear_dato_formato($nombre){
	global $texto,$conn,$imagenes,$formatos_calidad;
	
	$formato=busca_filtro_tabla("A.idformato,A.nombre,A.nombre_tabla,A.etiqueta","formato A","A.nombre_tabla LIKE '".$nombre."'","idformato DESC",$conn);
	
	if($formato["numcampos"]){
		
		$imagenes=' im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
		
		$iddoc=$formato[0]["idformato"]."-".$formato[0]["nombre"]."-".$formato[0]["nombre_tabla"];
		
		$texto.="<item style='font-family:verdana; font-size:7pt;' ".$imagenes;
		
		$identificador = $formato[0]["idformato"]."-".$formato[0]["nombre_tabla"];	
		$identificador = str_replace("_","##",$identificador);
		
		$texto.=strip_tags("text='".decodifica($formato[0]["etiqueta"])."' id='".$identificador."' nocheckbox='1'>\n");
    
		llenar_documentos($iddoc);  
		if($nombre=="ft_proceso"){
			crear_macroprocesos($formato);
		}
		$texto.="</item>\n";
	} 
}

function crear_macroprocesos($formato){  
	global $texto,$conn,$imagenes,$formatos_calidad,$validar_macro;
	
	if($formato["numcampos"]){
	
		$macros=busca_filtro_tabla("","ft_macroproceso_calidad B, documento c","B.documento_iddocumento=c.iddocumento and c.estado not in('ELIMINADO')","",$conn);
		
		$formato_macro=busca_filtro_tabla("","formato","lower(nombre)='macroproceso_calidad'","",$conn);
		
		for($i=0;$i<$macros["numcampos"];$i++){
			
			$validar_macro=1;
			
			$documentos=busca_filtro_tabla("","ft_proceso A","A.macroproceso=".$macros[$i]["idft_macroproceso_calidad"],"",$conn);
			
			$imagenes=' im0="proceso.gif" im1="proceso.gif" im2="proceso.gif" ';     
      
			$texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
			
			$identificador = 'macros-'.$macros[$i]["idft_macroproceso_calidad"].'-r'.rand().'-r'.rand();	
			$identificador = str_replace("_","##",$identificador);
			
			
			$texto.=strip_tags('text="'.decodifica($macros[$i]["nombre"]).'" id="'.$identificador.'">\n');      
	  
			llena_hijos($formato_macro[0]["idformato"],$macros[$i]["idft_macroproceso_calidad"],$formato_macro[0]["nombre_tabla"]);
		
			for($j=0;$j<$documentos["numcampos"];$j++){      
      
				$iddoc=$formato[0]["idformato"]."-".$formato[0]["nombre"]."-".$formato[0]["nombre_tabla"]."-".$documentos[$j]["documento_iddocumento"];                
				
				llenar_documentos($iddoc);
      
			}
			$texto.="</item>\n";
		}
	} 
}

function llenar_documentos($iddoc){
	global $conn,$texto;
  
	$arreglo=explode("-",$iddoc);  
	
	$campo_ordenar=busca_filtro_tabla("c.nombre,nombre_tabla","campos_formato c,formato f","formato_idformato=idformato and (c.banderas like 'oc' or c.banderas like '%,oc' or c.banderas like 'oc,%' or c.banderas like '%,oc,%') and f.nombre='".strtolower($arreglo[1])."'","",$conn);
	
	if($campo_ordenar["numcampos"]){ 
		$orden="b.".$campo_ordenar[0]["nombre"]." asc";
	}else{
		$orden="iddocumento asc"; 
	}
	
	$imagen_nota="";
	$validacion_macroproceso='';  
	
	if(@$arreglo[3] && $arreglo[1]=="proceso"){
		$validacion_macroproceso=" AND documento_iddocumento=".$arreglo[3];
	}
  
	if($campo_ordenar["numcampos"]){ 
		$formato=busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento","documento A,".$campo_ordenar[0]["nombre_tabla"]." b","documento_iddocumento=iddocumento AND A.estado<>'ELIMINADO'".$validacion_macroproceso,$orden,$conn);
	}else{
		$formato=busca_filtro_tabla("A.numero,A.descripcion ,A.iddocumento","documento A","lower(A.plantilla)='".strtolower($arreglo[1])."' AND A.estado<>'ELIMINADO'".$validacion_formato,"iddocumento asc",$conn);
	} 
  
	for($i=0;$i<$formato["numcampos"];$i++){
		
		$papas=busca_filtro_tabla("id".$arreglo[2]." AS llave,'".$arreglo[2]."' AS nombre_tabla",$arreglo[2],"documento_iddocumento=".$formato[$i]["iddocumento"],"",$conn);
		
		if($papas["numcampos"]){
			$iddoc=$arreglo[0]."-".$papas[0]["llave"]."-id".$arreglo[2];
		}else{
			$iddoc=0;
		}
		
		llena_datos_formato($iddoc,0);
	}
}

function llena_datos_formato($formato,$estado=0){
	global $conn,$texto,$imagenes,$formatos_calidad;
	
	$arreglo=explode("-",$formato);
	
	$formato=busca_filtro_tabla("","formato","idformato='".$arreglo[0]."'","",$conn);
	
	if($formato["numcampos"]){
		
		$descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%d%'","",$conn);    
  
		if($descripcion["numcampos"]){			
			$campo_descripcion=$descripcion[0]["nombre"];
		}else{
			$campo_descripcion="id".$formato[0]["nombre_tabla"];
		}
		
		$idformato=$formato[0]["idformato"]."-".$arreglo[1]."-".$arreglo[2]."-".$arreglo[0];
  
		$imagenes='im0="'.strtolower($formato[0]["nombre"]).'.gif" im1="'.strtolower($formato[0]["nombre"]).'.gif" im2="'.strtolower($formato[0]["nombre"]).'.gif" ';
		
		if($estado){
			$texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
			$identificador = $formato[0]["idformato"]."-".$formato[0]['nombre_tabla']."-r".rand().'-r'.rand();	
			$identificador = str_replace("_","##",$identificador);
			$texto.=strip_tags('text="'.decodifica(utf8_encode(html_entity_decode(htmlspecialchars_decode($formato[0]["etiqueta"])))).'" id="'.$identificador.'">\n');
		}
		
		llena_datos($idformato,$formato[0]["nombre_tabla"],$campo_descripcion);
		
		if($estado){
			$texto.="</item>\n";
		}
	
		/*Aqui se deben adicionar los formatos o consideraciones adicionales para el arbol de calidad. Especificamente la parte de Planes de Mejoramiento para los procesos*/
	}
}

function decodifica($cadena){
	return(str_replace('"','',(htmlspecialchars(strip_tags($cadena)))));
}

function llena_datos($idformato,$tabla,$campo){
	global $conn,$texto,$imagenes,$validar_macro;
	
	$arreglo=explode("-",$idformato);
	
	$estado=busca_filtro_tabla("estado",$tabla,$arreglo[2]."=".$arreglo[1],"",$conn);
	
	$campo_ordenar=busca_filtro_tabla("c.nombre,nombre_tabla","campos_formato c,formato f","formato_idformato=idformato and (c.banderas like 'oc' or c.banderas like '%,oc' or c.banderas like 'oc,%' or c.banderas like '%,oc,%') and f.idformato='".strtolower($arreglo[0])."'","",$conn);
	
	if($campo_ordenar["numcampos"]){
		$orden="a.".$campo_ordenar[0]["nombre"]." asc";
	}else{
		$orden="id".$tabla." asc";  
	}
	
	if($tabla=="ft_proceso" && !$validar_macro){
		$dato = busca_filtro_tabla("",$tabla,$arreglo[2]."=".$arreglo[1],"",$conn);
		
		if($dato["numcampos"] && @$dato[0]["macroproceso"]!=''){
			return($texto);
		}
	}  
	
	if($estado["numcampos"]){
		$dato=busca_filtro_tabla("a.".$campo.",documento_iddocumento,id".$tabla,$tabla." a,documento b",$arreglo[2]."=".$arreglo[1]." AND a.estado<>'INACTIVO' and b.estado<>'ELIMINADO' and documento_iddocumento=iddocumento",$orden,$conn);
	}else{
		$dato=busca_filtro_tabla($campo.",documento_iddocumento,id".$tabla,$tabla." a,documento b",$arreglo[2]."=".$arreglo[1]." and b.estado<>'ELIMINADO' and documento_iddocumento=iddocumento",$orden,$conn);
	}
	
	$imagen_nota="";
	
	if($tabla=="ft_norma_proceso"){
		$nota=busca_filtro_tabla("",$tabla." a",$arreglo[2]."=".$arreglo[1],$orden,$conn);
    }
	
	for($i=0;$i<$dato["numcampos"];$i++){
		$texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
		//$llave=$arreglo[0]."-".$arreglo[2]."-".$dato[$i]["id".$tabla];
		//$llave=$dato[$i]["documento_iddocumento"]."-".$arreglo[2]."-".$dato[$i]["id".$tabla];
		$llave=$dato[$i]["documento_iddocumento"]."-".$tabla."-".$dato[$i]["id".$tabla];
		$identificador = $llave.'-r'.rand();	
		$identificador = str_replace("_","##",$identificador);
		
		$texto.=strip_tags('text="'.decodifica(utf8_encode(html_entity_decode(htmlspecialchars_decode(mostrar_valor_campo($campo,$arreglo[0],$dato[$i]["documento_iddocumento"],1))))).'" id="'.$identificador.'">\n');
		
		if(@$dato[$i]["nombre"]=="EVALUACION INDEPENDIENTE" && $tabla=="ft_proceso"){
			crear_dato_formato('ft_elemento_subproceso');
		} 
		
		llena_hijos($arreglo[0],$dato[$i]["id".$tabla],$tabla);
		$texto.="</item>\n";
	}
	
	return($texto);
}

function llena_hijos($idformato,$iddato,$tabla){
	global $conn,$texto,$formatos_calidad;
	
	$formato=busca_filtro_tabla("","formato","cod_padre=".$idformato." AND nombre_tabla IN('".implode("','",$formatos_calidad)."')","",$conn);
	
	if($idformato==9||$idformato==68){
		$formato=ejecuta_filtro_tabla("select * from formato where nombre='gestion_educativo' union all select * from formato where cod_padre=".$idformato." and nombre_tabla IN('".implode("','",$formatos_calidad)."')",$conn);
	}
	
	for($i=0;$i<$formato["numcampos"];$i++){
		
		$campo_formato=busca_filtro_tabla("","campos_formato","nombre LIKE '".$tabla."' AND formato_idformato=".$formato[$i]["idformato"],"",$conn);
		
		$llave=$formato[$i]["idformato"]."-".$iddato;
		
		if($campo_formato["numcampos"]){
			$llave.="-".$campo_formato[0]["nombre"]."-".$iddato;
		}else{
			$llave.="-"."id".$formato[$i]["nombre_tabla"]."-".$iddato;
		}  
		llena_datos_formato($llave,1);  
	}
	return;
}

function planes_mejoramiento_funcional(){
	global $conn,$texto;
	
	$formato_pm=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_plan_mejoramiento'","",$conn);
	$condicion_pm=" A.tipo_plan LIKE '%2%'";

	$campo_descripcion=array();
	
	if($formato_pm){
		$descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato_pm[0]["idformato"]." AND acciones LIKE '%d%'","orden ASC",$conn);
		
		if($descripcion["numcampos"]){
			
			for($i=0,$num_campo=0;$i<$descripcion["numcampos"];$i++,$num_campo++){
				if($descripcion[$i]["tipo_dato"]=="TEXT" && $descripcion[$i]["longitud"]>=4000 && MOTOR=="Oracle"){
					array_push($campo_descripcion,array("nombre"=>$descripcion[$i]["nombre"],"consulta"=>"to_char(A.".$descripcion[$i]["nombre"].") as ".$descripcion[$i]["nombre"],"etiqueta"=>$descripcion[$i]["etiqueta"]));
				}else{
					array_push($campo_descripcion,array("nombre"=>$descripcion[$i]["nombre"],"consulta"=>"A.".$descripcion[$i]["nombre"],"etiqueta"=>$descripcion[$i]["etiqueta"]));
				}
			}
		}else{
			array_push($campo_descripcion,array("nombre"=>"id".$formato[0]["nombre_tabla"],"etiqueta"=>"ID"));
		}
		
		$num_campo=count($campo_descripcion);
		for($i=0;$i<$num_campo;$i++){
			if($i==0){
				$cad_tips=$campo_descripcion[$i]["consulta"];
			}else{
				$cad_tips.=",".$campo_descripcion[$i]["consulta"];
			}
		}
		
		$texto.='<item style="font-family:verdana; font-size:7pt;" ';
		
		$identificador = $formato_pm[0]["idformato"]."-id_".$formato_pm[0]["nombre_tabla"]."-r".rand().'-r'.rand();	
		$identificador = str_replace("_","##",$identificador);
		
		$texto.=strip_tags(('text="Planes de mejoramiento Funcional" id="'.$identificador.'" >\n'));
		
		$plan_mejoramiento=busca_filtro_tabla("DISTINCT ".$cad_tips.",A.documento_iddocumento,"."id".$formato_pm[0]["nombre_tabla"],$formato_pm[0]["nombre_tabla"]." A,ft_hallazgo B,documento c"," A.idft_plan_mejoramiento=B.ft_plan_mejoramiento AND A.estado<>'INACTIVO' and a.documento_iddocumento=c.iddocumento and c.estado<> 'ELIMINADO' AND B.estado<>'INACTIVO' AND ".$condicion_pm,"",$conn);		

		for($i=0;$i<$plan_mejoramiento["numcampos"];$i++){
			$tips="";
			for($j=0;$j<$num_campo;$j++){
				$tips.=strip_tags($campo_descripcion[$j]["etiqueta"].": ".decodifica(mostrar_valor_campo($campo_descripcion[$j]["nombre"],$formato_pm[0]["idformato"],$plan_mejoramiento[$i]["documento_iddocumento"],1)))."\n";
			}

			$texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
			
			$llave=$formato_pm[0]["idformato"]."-id".$formato_pm[0]["nombre_tabla"]."-".$plan_mejoramiento[$i]["id".$formato_pm[0]["nombre_tabla"]]."-r".rand();
			
			$cad=mostrar_valor_campo($campo_descripcion[0]["nombre"],$formato_pm[0]["idformato"],$plan_mejoramiento[$i]["documento_iddocumento"],1);			
			
			$identificador = $llave.'-r'.rand().'-r'.rand().'" tooltip="'.decodifica($tips);	
			$identificador = str_replace("_","##",$identificador);
			
			$texto.=strip_tags('text="'.decodifica($cad).'" id="'.$identificador.'">\n');
			
			$texto.="</item>\n";
		}
		$texto.="</item>\n";
	}
}

function planes_mejoramiento_individual(){
	global $texto;
	
	$texto.='<item style="font-family:verdana; font-size:7pt;" ';
	
	$identificador = 'pm-individual-r'.rand().'-r'.rand();	
	$identificador = str_replace("_","##",$identificador);
	
	$texto.=strip_tags(('text="Planes de mejoramiento Individual" id="'.$identificador.'" >\n'));
	
	$texto.='<item style="font-family:verdana; font-size:7pt;" ';
	
	$identificador = 'pm-i-pendientes-mejoramiento-r'.rand().'-r'.rand();	
	$identificador = str_replace("_","##",$identificador);
	
	$texto.=strip_tags(('text="Pendiente" id="'.$identificador.'" >\n'));
	
	$texto.="</item>\n";
	
	$texto.='<item style="font-family:verdana; font-size:7pt;" ';
	
	$identificador = 'pm-i-terminados-mejoramiento-r'.rand().'-r'.rand();	
	$identificador = str_replace("_","##",$identificador);
	
	$texto.=strip_tags(('text="Terminado" id="'.$identificador.'">\n'));
	
	$texto.="</item>\n";
	
	$texto.="</item>\n";
}

function planes_mejoramiento_institucional(){
	global $conn,$texto;
	
	$formato_pm=busca_filtro_tabla("","formato","nombre_tabla LIKE 'ft_plan_mejoramiento'","",$conn);
	
	$condicion_pm=" A.tipo_plan LIKE '%1%' ";

	$campo_descripcion=array();
	
	if($formato_pm){
		$descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato_pm[0]["idformato"]." AND acciones LIKE '%d%'","orden ASC",$conn);
		
		if($descripcion["numcampos"]){
			for($i=0,$num_campo=0;$i<$descripcion["numcampos"];$i++,$num_campo++){
				if($descripcion[$i]["tipo_dato"]=="TEXT" && $descripcion[$i]["longitud"]>=4000 && MOTOR=="Oracle"){
					array_push($campo_descripcion,array("nombre"=>"to_char(A.".$descripcion[$i]["nombre"].")","etiqueta"=>$descripcion[$i]["etiqueta"]));
				}else{
					array_push($campo_descripcion,array("nombre"=>"A.".$descripcion[$i]["nombre"],"etiqueta"=>$descripcion[$i]["etiqueta"]));
				}
			}
		}else{
			array_push($campo_descripcion,array("nombre"=>"id".$formato[0]["nombre_tabla"],"etiqueta"=>"ID"));
		}
		
		$num_campo=count($campo_descripcion);
		
		for($i=0;$i<$num_campo;$i++){
			if($i==0){
				$cad_tips=$campo_descripcion[$i]["nombre"];
			}else{
				$cad_tips.=",".$campo_descripcion[$i]["nombre"];
			}
		}
		$texto.='<item style="font-family:verdana; font-size:7pt;" ';
		
		$identificador = $formato_pm[0]["idformato"]."-id_".$formato_pm[0]["nombre_tabla"]."-r".rand().'-r'.rand();	
		$identificador = str_replace("_","##",$identificador);
		
		$texto.=strip_tags(('text="Planes de mejoramiento Institucional" id="'.$identificador.'">\n'));
		
		$plan_mejoramiento=busca_filtro_tabla("DISTINCT ".$cad_tips.",A.documento_iddocumento,"."id".$formato_pm[0]["nombre_tabla"],$formato_pm[0]["nombre_tabla"]." A,ft_hallazgo B, documento C"," A.idft_plan_mejoramiento=B.ft_plan_mejoramiento and a.documento_iddocumento=c.iddocumento and c.estado<> 'ELIMINADO' AND A.estado<>'INACTIVO' AND B.estado<>'INACTIVO' AND ".$condicion_pm,"",$conn);		
	
		for($i=0;$i<$plan_mejoramiento["numcampos"];$i++){
			$tips="";
			for($j=0;$j<$num_campo;$j++){
				$tips.=strip_tags($campo_descripcion[$j]["etiqueta"].": ".mostrar_valor_campo(str_replace("A.","",$campo_descripcion[0]["nombre"]),$formato_pm[0]["idformato"],$plan_mejoramiento[$i]["documento_iddocumento"],1))."\n";
			}
			
			$texto.='<item style="font-family:verdana; font-size:7pt;" '.$imagenes;
			
			$llave=$formato_pm[0]["idformato"]."-id".$formato_pm[0]["nombre_tabla"]."-".$plan_mejoramiento[$i]["id".$formato_pm[0]["nombre_tabla"]]."-r".rand();
			
			$cad=mostrar_valor_campo(str_replace("A.","",$campo_descripcion[0]["nombre"]),$formato_pm[0]["idformato"],$plan_mejoramiento[$i]["documento_iddocumento"],1);		
			
			$identificador = $llave.'-r'.rand();
			$identificador = str_replace("_","##",$identificador);
			
			$texto.=('text="'.strip_tags(decodifica($cad)).'" id="'.$identificador.'" tooltip="'.decodifica($tips).'" >');
			
			$texto.="\n</item>\n";
		}
		$texto.="</item>\n";
	}
}
?>