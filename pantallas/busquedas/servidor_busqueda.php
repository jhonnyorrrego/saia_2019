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
$validar_enteros=array("idbusqueda_componente","idbusqueda_filtro_temp","idbusqueda_temporal","llave_unica");
usuario_actual("login");
$array_export=array();
if(@$_REQUEST["exportar_saia"]=='excel'){
  include_once($ruta_db_superior. 'pantallas/busquedas/PHPExcel.php');
	include_once($ruta_db_superior."pantallas/lib/convertir_estructura.php");
}
$listado_funciones=array();
$page = @$_REQUEST['page']; // pagina actual inicia en 1
$limit = @$_REQUEST['rows']; // registros por listado de datos
$sidx = @$_REQUEST['sidx']; // Campo por el que se debe ordenar
$sord = @$_REQUEST['sord']; // Orden de la consulta
$actual_row = @$_REQUEST['actual_row'];
$count=false;
$start = @$_REQUEST['actual_row'];
crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "INICIO-------".date("Y-m-d H:i:s")."-----------\n");
//$filtro= @$_REQUEST['filtros']; //get the filters from pantalla
if(!$limit) $limit=30;
//if(!$sord) $sord ='desc';
$datos_busqueda=busca_filtro_tabla("","busqueda A, busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".@$_REQUEST["idbusqueda_componente"],"orden",$conn);
if($datos_busqueda["numcampos"]){
	if($datos_busqueda[0]["ruta_libreria"]){
    $librerias=array_unique(explode(",",$datos_busqueda[0]["ruta_libreria"]));
    array_walk($librerias,"incluir_librerias_busqueda");
  }
}

if(@$_REQUEST["exportar_saia"]=='excel'){
	if($datos_busqueda[0]["exportar_encabezado"] && $page==1){
		$columnas_excel=array();
		$datos=explode("|-|",stripslashes($datos_busqueda[0]["exportar_encabezado"]));
		$cant=count($datos);
		$cant_aux=(-$cant-1);
		$imagenes=array();
		$indices_columnas=array();
		$a=0;
		$b=0;
		for($i=0;$i<$cant;$i++){
			$datos2=explode("|",$datos[$i]);
			$cant2=count($datos2);
			for($j=0;$j<$cant2;$j++){
				if(strpos($datos2[$j],"]")){
					$array_export[$cant_aux][""]="";
					$datos_imagenes=explode(",",str_replace(array("[","]"),"",$datos2[$j]));
					$imagenes[$a]["ruta"]=$ruta_db_superior.$datos_imagenes[0];
					$imagenes[$a]["coordenada"]=$datos_imagenes[1];
					$imagenes[$a]["ancho"]=$datos_imagenes[2];
					$imagenes[$a]["alto"]=$datos_imagenes[3];
					if($datos_imagenes[2]){
						$indices_columnas[$b]=$datos_imagenes[1][0];
						$b++;
					}
					$a++;
				} else if(strpos($datos2[$j],"*}")){
					$datos3=str_replace("{*","",str_replace("*}","",$datos2[$j]));
					if(function_exists($datos3)){
						$array_export[$cant_aux][$datos3]=$datos3();
					} else {
						$array_export[$cant_aux][$datos3]="";
					}
				} else {
					$datos3=$datos2[$j];
					$array_export[$cant_aux][$datos3]=$datos3;
				}
			}
			$cant_aux++;
		}
		//$cant_columnas_excel=count($columnas_excel);
	}
	if($datos_busqueda[0]["tipo_busqueda"]==1){
		$columnas_excel=array();
		$datos=explode("|-|",stripslashes($datos_busqueda[0]["exportar"]));
		$cant=count($datos);
		for($i=0;$i<$cant;$i++){
			$datos2=explode(",",$datos[$i]);
			$datos2[1]=str_replace("{*","",str_replace("*}","",$datos2[1]));
			$nombre_campo_funcion=explode("@",$datos2[1]);
			array_push($columnas_excel,$nombre_campo_funcion[0]);
			if($page==1)
				$array_export[-1][$datos2[1]]=codifica_encabezado(html_entity_decode(strip_tags($datos2[0])));
		}
		$cant_columnas_excel=count($columnas_excel);
	} else if($datos_busqueda[0]["tipo_busqueda"]==2) {
		$columnas_excel=array();
		$grupos=explode("|-|",stripslashes($datos_busqueda[0]["info"]));
		$cant=count($grupos);
		for($i=0;$i<$cant;$i++){
			$datos=explode("|",$grupos[$i]);
			$datos[1]=str_replace("{*","",str_replace("*}","",$datos[1]));
			$datos2=explode("@",$datos[1]);
			array_push($columnas_excel,$datos2[0]);
			if($page==1)
				$array_export[-1][$datos2[0]]=codifica_encabezado(html_entity_decode(strip_tags($datos[0])));
		}
		$cant_columnas_excel=count($columnas_excel);
	}
}

if($datos_busqueda["numcampos"]){
  if($page==""){
    $page=1;
  }
  $campos=array();
  $ordenar=array();
  $agrupar=array();
  $sumar=array();
  $tablas=array();
  $condicion="";
  if($datos_busqueda[0]["tablas"]!=''){
    $tablas=array_merge((array)$tablas,(array)explode(",",$datos_busqueda[0]["tablas"]));
  }
  if($datos_busqueda[0]["tablas_adicionales"]!=''){
    $tablas=array_merge((array)$tablas,(array)explode(",",$datos_busqueda[0]["tablas_adicionales"]));
  }
  if($datos_busqueda[0]["campos"]!=''){
  	$campos=array_merge((array)$campos,(array)explode(",",$datos_busqueda[0]["campos"]));
  }
  if($datos_busqueda[0]["campos_adicionales"]!=''){
    $campos=array_merge((array)$campos,(array)explode(",",$datos_busqueda[0]["campos_adicionales"]));
  }
  if($datos_busqueda[0]["llave"]){
  	$campos=array_merge((array)$campos,(array)explode(",", $datos_busqueda[0]["llave"]));
  }
  $condicion=crear_condicion_sql($datos_busqueda[0]["idbusqueda"],$datos_busqueda[0]["idbusqueda_componente"],@$filtro);
  $funciones_condicion=parsear_datos_plantilla_visual($condicion);

  $valor_variables=array();
  if(@$_REQUEST["variable_busqueda"]!='' && count($funciones_condicion)){
    $variables_final=array();
    $variables1=explode(",",$_REQUEST["variable_busqueda"]);
    foreach($variables1 as $key=>$valor){
      $variable2=explode("=",$valor);
      $variables_final[$variable2[0]]=$variable2[1];
    }
  }
  foreach($funciones_condicion as $key=>$valor){
    unset($valor_variables);
    $valor_variables=array();
    $funcion=explode("@",$valor);
    $variables=explode(",",$funcion[1]);
    $cant_variables=count($variables);
    for($h=0;$h<$cant_variables;$h++){
      if(@$variables_final[$variables[$h]])
        array_push($valor_variables,$variables_final[$variables[$h]]);
      else
        array_push($valor_variables,$variables[$h]);
    }
    $resultado=call_user_func_array($funcion[0],$valor_variables);
    $condicion=str_replace("{*".$valor."*}",$resultado,$condicion);
  }
  $includes=array();

  if(!$sidx){
    if($datos_busqueda[0]["ordenado_por"]){
      $sidx=$datos_busqueda[0]["ordenado_por"];
    }
    if($datos_busqueda[0]["direccion"]){
      $sord=$datos_busqueda[0]["direccion"];
    }
    if(!$sord){
        $sord=" DESC ";
    }
  }
} else
  die();
if(@$_REQUEST["idbusqueda_filtro_temp"]){
  $filtro_temp=busca_filtro_tabla("","busqueda_filtro_temp","idbusqueda_filtro_temp IN(".$_REQUEST["idbusqueda_filtro_temp"].")","",$conn);
  if($filtro_temp["numcampos"]){
    $cadena1='';
    for($i=0;$i<$filtro_temp["numcampos"];$i++){
    	$cadena1=parsear_cadena($filtro_temp[$i]["detalle"]);
      $cadena.=$cadena1;
      if(@$filtro_temp[$i+1]["detalle"]){
        $cadena.=' AND ';
      }
    }
    $condicion.=" AND (".stripslashes($cadena).")";
	//die($condicion);
  }
}
$condicion=str_replace(" AND  and  ", " and ", $condicion);
foreach($campos as $valor){
	$as=strpos(strtolower($valor)," as ");
	if($as!==false){
		$agrupacion[]=substr($valor,0,($as));
		continue;
	}
	$agrupacion[]=$valor;
}
$lcampos=$campos;
$campos_consulta=strtolower(implode(",",array_unique($lcampos)));
$tablas_consulta=strtolower(implode(",",array_unique($tablas)));

$funciones_tablas=parsear_datos_plantilla_visual($tablas_consulta);
foreach($funciones_tablas AS $key=>$valor){
  unset($valor_variables);
  $valor_variables=array();
  $funcion=explode("@",$valor);
  $variables=explode(",",$funcion[1]);
  $cant_variables=count($variables);
  for($h=0;$h<$cant_variables;$h++){
    if(@$variables_final[$variables[$h]])
      array_push($valor_variables,$variables_final[$variables[$h]]);
    else
      array_push($valor_variables,$variables[$h]);
  }
  $resultado=call_user_func_array($funcion[0],$valor_variables);
  $tablas_consulta=str_replace("{*".$valor."*}",$resultado,$tablas_consulta);
}


$ordenar_consulta="";
$agrupar_consulta=$datos_busqueda[0]["agrupado_por"];

if(MOTOR=='MySql' || MOTOR=='Oracle') {
	if($agrupar_consulta!=""){
	  $ordenar_consulta.=" GROUP BY ".$agrupar_consulta;
	  $ordenar_consulta_aux=" GROUP BY ".implode(",",$agrupacion);
	}
} else if(MOTOR == 'SqlServer' || MOTOR == 'MSSql') {
	$ordenar_consulta2="";
	if($agrupar_consulta!=""){
	  $ordenar_consulta.=" GROUP BY ".$agrupar_consulta;
	  $ordenar_consulta2.=" GROUP BY ".$agrupar_consulta;
	  $ordenar_consulta_aux=" GROUP BY ".implode(",",$agrupacion);
	}
}
if($sidx && $sord){
  if(MOTOR=='MySql' || MOTOR=='Oracle') {
       $ordenar_consulta2.=$ordenar_consulta;
  }
  $ordenar_consulta2.=" ORDER BY ".$sidx." ".$sord;
  $ordenar_grafico=" ORDER BY ".$sidx." ".$sord;
}
$ordenar_consulta=strtolower($ordenar_consulta);
$ordenar_consulta2=strtolower($ordenar_consulta2);
$condicion=str_replace("%y-%m-%d","%Y-%m-%d",strtolower($condicion));
if(@$_REQUEST["idbusqueda_temporal"]){
	$datos=busca_filtro_tabla("","busqueda_filtro","idbusqueda_filtro=".$_REQUEST["idbusqueda_temporal"],"",$conn);
	if($datos["numcampos"]){
		$dat=explode(",",$datos[0]["tabla_adicional"]);
		$cantidad=count($dat);
		for($i=0;$i<$cantidad;$i++){
			$fin=strpos($dat[$i]," ");
			if($fin){
				$tabla2=substr($dat[$i],0,$fin);
			} else {
				$tabla2=$dat[$i];
			}
			if(strpos(@$tablas_consulta,@$tabla2)===false){
				$nuevas_tablas[]=$dat[$i];
			}
		}
		$cantidad=count($nuevas_tablas);
		if($cantidad){
			$tablas_consulta.=",".implode(",",$nuevas_tablas);
			$condicion.=$datos[0]["where_adicional"];
		}
	}
}
if(!@$_REQUEST["cantidad_total"]){
	$result = ejecuta_filtro_tabla("SELECT COUNT(*) AS cant FROM ".$tablas_consulta." WHERE ".$condicion.$ordenar_consulta,$conn);
	if($result["numcampos"]>1){
		$_REQUEST["cantidad_total"]=$result["numcampos"];
	}else{
		$_REQUEST["cantidad_total"]=$result[0]["cant"];
	}
}
else{
	$result["numcampos"]=@$_REQUEST["cantidad_total"];
	$result[0]['cant']=@$_REQUEST["cantidad_total"];
}

/*
if(!@$_REQUEST["cantidad_total"]){ //DESARROLLO ALEJANDRO CARVAJAL
    $consulta_conteo = "SELECT COUNT(1) AS cant FROM " . $tablas_consulta . " WHERE " . $condicion . $ordenar_consulta;
    if(MOTOR == 'SqlServer' || MOTOR == 'MSSql'){
        $consulta_conteo = "WITH conteo AS (SELECT " . $campos_consulta . " FROM " . $tablas_consulta . " WHERE " . $condicion . $ordenar_consulta.") SELECT COUNT(*) as cant FROM conteo";
    } else if(strpos(strtolower($campos_consulta), "sum(") !== false || strpos(strtolower($campos_consulta), "avg(") !== false) {
        $consulta_conteo = "SELECT COUNT(1) AS cant FROM (SELECT " . $campos_consulta . " FROM " . $tablas_consulta . " WHERE " . $condicion . $ordenar_consulta.") as cant";
    }
    $conteo_filas = $conn->Ejecutar_sql($consulta_conteo);
    $result=phpmkr_fetch_array($conteo_filas);
    $result[0]=array();
    $result[0]['cant']=$result['cant'];
    $result["numcampos"]=$result['cant'];
    $_REQUEST["cantidad_total"]=$result["numcampos"];

} else {
	$result["numcampos"]=@$_REQUEST["cantidad_total"];
	$result[0]['cant']=@$_REQUEST["cantidad_total"];
}

*/
$response=new stdClass();
$response->cantidad_total = $result[0]['cant'];
$response->exito=0;
$response->mensaje='Error inesperado';
if(trim($agrupar_consulta)!=""&&!@$count&&$datos_busqueda[0]["tipo_busqueda"]==2){
  if(@$_REQUEST["exportar_saia"]){
	$count = ($result["numcampos"]);
  } else {
  	$count = ($result["numcampos"] - 1);
  }
} else if(trim($agrupar_consulta)!=""&&!@$count) {
  $count = ($result["numcampos"]);
} elseif(trim($agrupar_consulta) == "" && ! @$count)
  $count = $result[0]['cant'];
$aux_limit=$limit;

if($limit=="todos"){
	$limit=$count;
}
if($actual_row=='')
  $actual_row=0;
if( $count >0 ) {
  $total_pages = ceil($count/$limit);
} else {
  $total_pages = 0;
	$response->exito=0;
	$response->mensaje="No existen registros";
}
if($count<=$actual_row){
  $response->exito=0;
	$response->mensaje="Existe un error al recuperar los datos de la consulta ".$result["sql"];
}
if ($page >= $total_pages){
  //$page=$total_pages;
  $response->exito=0;
	$response->mensaje="Fin del listado";
}
if(@$start!==0&&$aux_limit!="todos"&&@$_REQUEST["reporte"]){
  $start = $limit*$page - $limit; // do not put $limit*($page - 1)
}

if(@$_REQUEST['llave_unica']){
    $condicion.=" AND ".$datos_busqueda[0]["llave"]."='".$_REQUEST['llave_unica']."'";
}


if ($start < 0)
    $start = 0;
if(MOTOR=='SqlServer'){
	//Sin esta validacion, los reportes de grillas embolan 1 registro en cada pagina
	$result=busca_filtro_tabla_limit($campos_consulta,$tablas_consulta,$condicion,$ordenar_consulta2,intval($start),intval($limit),$conn);
}else{
	$result=busca_filtro_tabla_limit($campos_consulta,$tablas_consulta,$condicion,$ordenar_consulta2,intval($start),intval($limit-1),$conn);
}

$start = $limit*$page - $limit; // do not put $limit*($page - 1)
if($datos_busqueda[0]["tipo_busqueda"]==1 || $_REQUEST['tipo_busqueda']==1){
  $response->page = $page+1;
} else {
  $response->page = $page;
}
//$response->total = $count; //DESARROLLO ALEJANDRO CARVAJAL
$response->total = $total_pages;
$response->records = $count;

$response->sql= $result["sql"];
$cant_campos=count($lcampos);
$info_base=str_replace('"',"'",$datos_busqueda[0]["info"]);
for($j=0;$j<$cant_campos;$j++){
  $as=strpos(strtolower($lcampos[$j])," as ");
  if($as!==false){
  	$lcampos[$j]=substr($lcampos[$j],($as+4),strlen($lcampos[$j]));
	  continue;
  }
  $pos=strpos($lcampos[$j],".");
  if($pos!==false){
    $lcampos[$j]=substr($lcampos[$j],($pos+1),strlen($lcampos[$j]));
  }
}
$pos=strpos($datos_busqueda[0]["llave"],".");
if($pos!==false){
  $llave=substr($datos_busqueda[0]["llave"],($pos+1),strlen($datos_busqueda[0]["llave"]));
} else {
  $llave=$datos_busqueda[0]["llave"];
}
$listado_funciones=parsear_datos_plantilla_visual($info_base,implode(",",$lcampos));
if(@$_REQUEST["exportar_saia"]){
	$listado_funciones2=parsear_datos_plantilla_visual($datos_busqueda[0]["exportar"],implode(",",$lcampos));
	$listado_funciones=array_merge($listado_funciones,$listado_funciones2);
}
if($result["numcampos"]){
	$response->exito=1;
	$archivo_excel=0;
	$response->mensaje="Registros encontrados";
	if(@$_REQUEST["exportar_saia"]){
		if(@$_REQUEST["ruta_exportar_saia"]){

			if(file_exists($ruta_db_superior.$_REQUEST["ruta_exportar_saia"])===false || $page==1){
				if($page==1 && file_exists($ruta_db_superior.$_REQUEST["ruta_exportar_saia"])){
					unlink($ruta_db_superior.$_REQUEST["ruta_exportar_saia"]);
				}
				$configuracion_temporal=busca_filtro_tabla("valor","configuracion","nombre='ruta_temporal' AND tipo='ruta'","",$conn);
				if($configuracion_temporal['numcampos']){
					$cont_ruta=$configuracion_temporal[0]['valor'];
					$cont_ruta .= '_'.usuario_actual("login");
					crear_destino($ruta_db_superior . $cont_ruta);
				} else {
					crear_destino($ruta_db_superior . "temporal/temporal_" . usuario_actual('login'));
				}
        crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "INICIO CREAR ARCHIVO ".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
				if($_REQUEST["exportar_saia"]=="excel"){
					//AQUI SE CREA EL ARCHIVO SI NO EXISTE
					include_once($ruta_db_superior.'pantallas/busquedas/PHPExcel/IOFactory.php');

					$archivo_excel=1;
					$objPHPExcel = new PHPExcel();
					$nombre=usuario_actual("nombres")." ".usuario_actual("apellidos");
					if(@$_REQUEST["titulo_reporte_saia"]){
						$titulo=@$_REQUEST["titulo_reporte_saia"];
					} else {
						$titulo="Reporte_SAIA_".$datos_busqueda[0]["busqueda_componente.etiqueta"];
					}
          crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "ANTES DEL SORT -------".date("Y-m-d H:i:s")."-----------\n");
					ksort($array_export);
          crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "DESPUES DEL SORT -------".date("Y-m-d H:i:s")."-----------\n");
					$objPHPExcel->getProperties()->setCreator($nombre)
					->setLastModifiedBy($nombre)
					->setTitle($titulo)
					->setSubject($titulo)
					->setKeywords("cerok SAIA reporte");
					$highestRow=0;
				}
			} else if($_REQUEST["exportar_saia"]=="excel") {
				// AQUI SE ABRE EL ARCHIVO DE EXCEL
				include_once($ruta_db_superior.'pantallas/busquedas/PHPExcel/IOFactory.php');
				$fileType = 'Excel5';
        crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "INICIO LEER ARCHIVO ".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
				$objReader = PHPExcel_IOFactory::createReader($fileType);
				$objPHPExcel = $objReader->load($ruta_db_superior.$_REQUEST["ruta_exportar_saia"]);
				crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "FIN LEER ARCHIVO ".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
        $highestRow =$_REQUEST["actual_row"];
				//$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
			}
			if($_REQUEST["exportar_saia"]=="csv"){
				$file_export=fopen($ruta_db_superior.$_REQUEST["ruta_exportar_saia"],"a+");
			}
		}
	}

	if($_REQUEST["exportar_saia"]=="csv" && $page==1){
		fputcsv($file_export,$array_export[-1],",",'"');
	} else if($_REQUEST["exportar_saia"]=="excel" && $page==1) {
		$highestRow++;
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "INICIO CARGA ARREGLO PAG1 ".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
		$objPHPExcel->getActiveSheet()->fromArray($array_export[-1], NULL, 'A'.($highestRow));
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "FIN CARGA ARREGLO INICIO WRITE EXCEL5 PAG 1".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "FIN WRITE EXCEL INICIO SAVE ARCHIVO PAG 1".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
		$objWriter->save($ruta_db_superior.$_REQUEST["ruta_exportar_saia"]);
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "FIN SAVE ARCHIVO PAG 1".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
	}
  if(@$_REQUEST["exportar_saia"]!=''){
    $array_export=array();
  }
	for($i=0;$i<$result["numcampos"];$i++){
	  $response->rows[$i] = new stdClass();
	  unset($listado_campos);
	  $listado_campos=array();
	  $info=$info_base;
	  for($j=0;$j<$cant_campos;$j++){
	    $caden=' \ ';
			if(is_object($result[$i][$lcampos[$j]])){ // para mssql y sqlserver
				$result[$i][$lcampos[$j]]=$result[$i][$lcampos[$j]]->date;
			}
	    $response->rows[$i]->$lcampos[$j]=str_replace('"',"",str_replace(trim($caden),"",$result[$i][$lcampos[$j]]));
	      $info=str_replace("{*".$lcampos[$j]."*}",addslashes($result[$i][$lcampos[$j]]),$info);
	  }
	  foreach($listado_funciones as $key=>$valor){
	    unset($valor_variables);
	    $valor_variables=array();
	    $funcion=explode("@",$valor);
	    $variables=explode(",",$funcion[1]);
	    $cant_variables=count($variables);
	    for($h=0;$h<$cant_variables;$h++){
	      if(@$result[$i][$variables[$h]])
	        array_push($valor_variables,$result[$i][$variables[$h]]);
	      else
	        array_push($valor_variables,$variables[$h]);
	    }
			if(function_exists($funcion[0])){
	    	$valor_funcion=call_user_func_array($funcion[0],$valor_variables);
	    	$info=str_replace("{*".$valor."*}",$valor_funcion,$info);

				if(@$_REQUEST["exportar_saia"]=="excel" || @$_REQUEST["exportar_saia"]=='csv'){
					$response->rows[$i]->$funcion[0]=$valor_funcion;
				}
				if($datos_busqueda[0]["tipo_busqueda"]==2){
					$response->rows[$i]->$funcion[0]=$valor_funcion;
				}
			}
	  }
	  if($datos_busqueda[0]["tipo_busqueda"]==1){
	    if(!@$_REQUEST["estilo_actualizar_informacion"])
	      $response->rows[$i]->info="<div id='resultado_pantalla_".$result[$i][$llave]."' class='well'>";

	    if(!@$_REQUEST["estilo_actualizar_informacion"])
	      $response->rows[$i]->info.="</div>";
			$response->rows[$i]->info=str_replace("\n","",str_replace("\r","",$info));
			$response->rows[$i]->llave=$result[$i][$llave];

			if(@$_REQUEST["exportar_saia"]=='excel' || @$_REQUEST["exportar_saia"]=='csv'){
				for($k=0;$k<$cant_columnas_excel;$k++){
					$array_export[$i][$columnas_excel[$k]] = codifica_encabezado(html_entity_decode(strip_tags($response->rows[$i]->$columnas_excel[$k])));
				}

			}
	  } else if($datos_busqueda[0]["tipo_busqueda"]==2) {
			for($k=0;$k<$cant_columnas_excel;$k++){
				if(@$_REQUEST["exportar_saia"]=='excel' || @$_REQUEST["exportar_saia"]=='csv') {
					$array_export[$i][$columnas_excel[$k]]=(html_entity_decode(strip_tags($response->rows[$i]->$columnas_excel[$k])));
				} else {
					$array_export[$i][$columnas_excel[$k]]=codifica_encabezado(html_entity_decode(strip_tags($response->rows[$i]->$columnas_excel[$k])));
				}
			}
		}
    if($_REQUEST["export_saia"]=="csv" || $_REQUEST["export_saia"]=="excel"){
      unset($response->rows[$i]);
    }
	}
  if(@$_REQUEST["exportar_saia"]=="csv"){
    fputcsv($file_export,$array_export,",",'"');
  } else if(@$_REQUEST["exportar_saia"] == "excel") {
    $highestRow++;
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "INICIO CARGA ARREGLO PAG(".$page.") ".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
    $objPHPExcel->getActiveSheet()->fromArray($array_export, NULL, 'A'.($highestRow));
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "FIN CARGA ARREGLO INICIO WRITE EXCEL5 PAG(".$page.")".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
    $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "FIN WRITE EXCEL INICIO SAVE ARCHIVO PAG (".$page.")".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
    $objWriter->save($ruta_db_superior.$_REQUEST["ruta_exportar_saia"]);
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "FIN SAVE ARCHIVO PAG (".$page.")".$ruta_db_superior.$_REQUEST["ruta_exportar_saia"]." -------".date("Y-m-d H:i:s")."-----------\n");
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "INICIO DATOS--- ".date("Y-m-d H:i:s")."-----------\n");
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", implode("--",$array_export)."\n");
    crear_log_busqueda_excel($ruta_db_superior."../backup/log_exportar.txt", "FIN DATOS--- ".date("Y-m-d H:i:s")."-----------\n");
    $response->exito=1;
  }
	if(@$file_export){
		fclose($file_export);
	}
}
$response->actual_row=$actual_row+$i;
if($response->actual_row>$response->records){
  $response->actual_row=$response->records;
}
if($response->records<0){
  $response->records=0;
}
if(!@$_REQUEST["no_imprime"])
	echo json_encode($response);

function crear_log_busqueda_excel($file,$texto){
  // Solo sirve para validar la informacion que se genera al momento de modificar el reporte
  //file_put_contents($file, $texto,FILE_APPEND);
}

function crear_condicion_sql($idbusqueda,$idcomponente,$filtros=''){
global $conn;
$condicion_filtro='';
$datos_condicion=busca_filtro_tabla("","busqueda_condicion_enlace A, busqueda_condicion B","B.idbusqueda_condicion=A.fk_busqueda_condicion AND (B.fk_busqueda_componente=".$idcomponente ." or B.busqueda_idbusqueda=".$idbusqueda.") AND cod_padre IS NULL ".$condicion_filtro,"orden",$conn);
if(!$datos_condicion["numcampos"]){
  $datos_condicion=busca_filtro_tabla("","busqueda_condicion B","B.fk_busqueda_componente=".$idcomponente ." or B.busqueda_idbusqueda=".$idbusqueda.$condicion_filtro,"",$conn);
  $condicion=$datos_condicion[0]["codigo_where"];
} else {
if($filtros!=''){
  $condicion_filtro="AND (A.estado=1 OR (A.estado=2 AND A.condicion_idcondicion IN(".$filtros.")))";
} else
  $condicion_filtro=" AND estado=1 ";
for($i=0;$i<$datos_condicion["numcampos"];$i++){
  if(@$datos_condicion[$i]["comparacion"]==''){
    $datos_condicion[$i]["comparacion"]="AND";
  }
  if(@$datos_condicion[$i]["idbusqueda_condicion"]) {
    if($i>0) {
      $condicion.=" ".$datos_condicion[$i]["comparacion"]." ";
    }
    $condicion.=$datos_condicion[$i]["codigo_where"];
  }
}
}
if($condicion==""){
  if(@$_REQUEST["condicion_adicional"]){
    $condicion=$_REQUEST["condicion_adicional"];
  } else {
    $condicion=' 1=1 ';
  }
  return('('.$condicion.')');
}
if(@$_REQUEST["condicion_adicional"]){
    $condicion.=$_REQUEST["condicion_adicional"];
  }
return('('.$condicion.')');
}

function parsear_datos_plantilla_visual($cadena,$campos=array()){
  $result=preg_match_all( '({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})' ,$cadena, $resultado );
  if($result!==FALSE){
    $patrones=str_replace(array("{*","*}"),"",$resultado[0]);
    if($campos){
      $listado_campos=array_unique(explode(",",$campos));
      $listado_funciones=array_diff($patrones,$listado_campos);
    } else {
      $listado_funciones=$patrones;
    }
  }
return($listado_funciones);
}

function incluir_librerias_busqueda($elemento,$indice){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);
}

?>