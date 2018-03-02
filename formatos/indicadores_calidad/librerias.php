<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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

include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
//include_once($ruta_db_superior."formatos/indicadores_calidad/index_indicadores.php");
function parsear_fecha($fecha){
	$datos_fecha=date_parse($fecha);
	$cadena=$datos_fecha["day"]." de ".mes($datos_fecha["month"])." del ".$datos_fecha["year"];
	return($cadena);
}
function nombre_indicador_funcion($nombre,$iddocumento){
	$cadena="<div class='link kenlace_saia' conector='iframe' titulo='Indicador: ".$nombre."' enlace='ordenar.php?key=".$iddocumento."&mostrar_formato=1'><span class='badge'>".$nombre."</span></div>";
	return($cadena);
}
function filtrar_procesos($nada){
	global $conn;
	$cadena="";
	if(@$_REQUEST["variable_busqueda"]){
		$cadena=" AND idft_proceso in(".$_REQUEST["variable_busqueda"].")";
	}
	return($cadena);
}



function filtrar_procesos_rojo($nada){
	global $conn;
	$cadena="";
	if(@$_REQUEST["variable_busqueda"]){
		//print_r($_REQUEST["variable_busqueda"]);die();
		$cadena=" AND idft_proceso in(".$_REQUEST["variable_busqueda"].")";
	}else{
		$procesos=busca_filtro_tabla("a.idft_proceso","ft_proceso a, documento d","d.iddocumento=a.documento_iddocumento AND d.estado <> 'ELIMINADO'","",$conn);
		//print_r($procesos);
		$cadena="1";
		if($procesos['numcampos']){
			for($i; $i < $procesos['numcampos']; $i++){
				$cantidad_indicadores=previo_contar_rojo($procesos[$i]['idft_proceso']);
				//print_r($cantidad_indicadores);
				
				if($cantidad_indicadores != 0 || $cantidad_indicadores != ""){
					
					if($cadena=="1"){
						//$cadena=str_replace("1", "", $cadena);
						$cadena=" AND idft_proceso in(".$procesos[$i]['idft_proceso'];
					}else{
						$cadena.=",".$procesos[$i]['idft_proceso'];
					}
					
				}
			}
			$cadena.=")";
		}
		
		
	}
	return($cadena);
}


function filtrar_procesos_amarillo($nada){
	global $conn;
	$cadena="";
	if(@$_REQUEST["variable_busqueda"]){
		//print_r($_REQUEST["variable_busqueda"]);die();
		$cadena=" AND idft_proceso in(".$_REQUEST["variable_busqueda"].")";
	}else{
		$procesos=busca_filtro_tabla("a.idft_proceso","ft_proceso a, documento d","d.iddocumento=a.documento_iddocumento AND d.estado <> 'ELIMINADO'","",$conn);
		//print_r($procesos);
		$cadena="1";
		if($procesos['numcampos']){
			for($i; $i < $procesos['numcampos']; $i++){
				$cantidad_indicadores=previo_contar_amarillo($procesos[$i]['idft_proceso']);
				//print_r($cantidad_indicadores);
				
				if($cantidad_indicadores != 0 || $cantidad_indicadores != ""){
					
					if($cadena=="1"){
						//$cadena=str_replace("1", "", $cadena);
						$cadena=" AND idft_proceso in(".$procesos[$i]['idft_proceso'];
					}else{
						$cadena.=",".$procesos[$i]['idft_proceso'];
					}
					
				}
			}
			$cadena.=")";
		}
		
		
	}
	return($cadena);
}


function filtrar_procesos_verde($nada){
	global $conn;
	$cadena="";
	if(@$_REQUEST["variable_busqueda"]){
		
		//print_r($_REQUEST["variable_busqueda"]);die();
		$cadena=" AND idft_proceso in(".$_REQUEST["variable_busqueda"].")";
	}else{
		$colores=contadores_colores($procesos_rojo, $procesos_amarillo, $procesos_verde);
		//print_r($procesos_verde);
		
		$procesos_verde=array_unique($procesos_verde);
		for($h; $h < count($procesos_verde);$h++){
			//print_r($h);
			if($procesos_verde[$h] == '321'){
				unset($procesos_verde[$h]);
			}
		}
		
		if(count($procesos_verde)){
			$idft_proceso_busqueda_verde=implode(",",$procesos_verde);
			$cadena=" AND idft_proceso in(".$idft_proceso_busqueda_verde.")";
			
		}

}
return ($cadena);
}
function filtrar_indicadores($nada){
	global $conn;
	$cadena="";
	if(@$_REQUEST["variable_busqueda"]){
		$prueba=explode(",",$_REQUEST["variable_busqueda"]);
		$prueba=array_unique($prueba);
		$_REQUEST["variable_busqueda"]=implode(",",$prueba);
		$cadena=" AND idft_indicadores_calidad in(".$_REQUEST["variable_busqueda"].")";
	}
	return($cadena);
	//print_r($cadena);die();
}


function filtrar_indicadores_total($nada){
	global $conn;
	$cadena="";
	if(@$_REQUEST["variable_busqueda"]){
		$prueba=explode(",",$_REQUEST["variable_busqueda"]);
		$prueba=array_unique($prueba);
		$_REQUEST["variable_busqueda"]=implode(",",$prueba);
		$cadena=" AND idft_indicadores_calidad in(".$_REQUEST["variable_busqueda"].")";
	}else{
		$colores=contadores_colores($procesos_rojo, $procesos_amarillo, $procesos_verde);
		//print_r($procesos_verde);die();
		
		$procesos_verde=array_unique($procesos_verde);
		for($h; $h < count($procesos_verde);$h++){
			//print_r($h);
			if($procesos_verde[$h] == '321'){
				unset($procesos_verde[$h]);
			}
		}
		
		if(count($procesos_verde)){
			$idft_proceso_busqueda=implode(",",$procesos_rojo);
			$idft_proceso_busqueda.=",";
			$idft_proceso_busqueda.=implode(",",$procesos_amarillo);
			$idft_proceso_busqueda.=",";
			$idft_proceso_busqueda.=implode(",",$procesos_verde);
			$cadena=" AND idft_proceso in(".$idft_proceso_busqueda.")";
			return ($cadena);
		}
	}
	return($cadena);
}

function nombre_proceso_rojo_funcion($nombre,$idft_proceso){
	global $conn;    
    
    $reporte_indicadores_calidad =  busca_filtro_tabla("idbusqueda_componente","busqueda_componente","nombre='listar_indicadores_calidad'","",$conn);//indicadores_calidad
    $idbusqueda_componente=$reporte_indicadores_calidad[0]['idbusqueda_componente'];
    
	$cantidad=contar_color_funcion($idft_proceso,'rojo');
	$cadena="";
	$cadena.='<a class="link kenlace_saia" conector="iframe" titulo="Proceso: '.$nombre.'" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente='.$idbusqueda_componente.'&variable_busqueda='.implode(",",$cantidad[1]).'"><span class="badge">'.$nombre."</span></a>";
	return($cadena);
}
function nombre_proceso_amarillo_funcion($nombre,$idft_proceso){
	global $conn;    
    
    $reporte_indicadores_calidad =  busca_filtro_tabla("idbusqueda_componente","busqueda_componente","nombre='listar_indicadores_calidad'","",$conn);//indicadores_calidad
    $idbusqueda_componente=$reporte_indicadores_calidad[0]['idbusqueda_componente'];
    
	$cantidad=contar_color_funcion($idft_proceso,'amarillo');
	$cadena="";
	$cadena.='<a class="link kenlace_saia" conector="iframe" titulo="Proceso: '.$nombre.'" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente='.$idbusqueda_componente.'&variable_busqueda='.implode(",",$cantidad[1]).'"><span class="badge">'.$nombre."</span></a>";
	return($cadena);
}
function nombre_proceso_verde_funcion($nombre,$idft_proceso){
	global $conn;    
    
    $reporte_indicadores_calidad =  busca_filtro_tabla("idbusqueda_componente","busqueda_componente","nombre='listar_indicadores_calidad'","",$conn);//indicadores_calidad
    $idbusqueda_componente=$reporte_indicadores_calidad[0]['idbusqueda_componente'];    
    
	$cantidad=contar_color_funcion($idft_proceso,'verde');
	$cadena="";
	$cadena.='<a class="link kenlace_saia" conector="iframe" titulo="Proceso: '.$nombre.'" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente='.$idbusqueda_componente.'&variable_busqueda='.implode(",",$cantidad[1]).'"><span class="badge">'.$nombre."</span></a>";
	return($cadena);
}
function nombre_macro($macroproceso){
	global $conn;
	$cadena="";
	if($macroproceso!="macroproceso"){
		$macroproceso=busca_filtro_tabla("nombre","ft_macroproceso_calidad A","A.idft_macroproceso_calidad=".$macroproceso,"",$conn);
		$cadena=$macroproceso[0]["nombre"];
	}
	return($cadena);
}
function previo_contar_rojo($idft_proceso){
	$cantidad=contar_color_funcion($idft_proceso,'rojo');
	return($cantidad[0]);
}
function previo_contar_amarillo($idft_proceso){
	$cantidad=contar_color_funcion($idft_proceso,'amarillo');
	return($cantidad[0]);
}
function previo_contar_verde($idft_proceso){
	$cantidad=contar_color_funcion($idft_proceso,'verde');
	return($cantidad[0]);
}
function contar_color_funcion($idft_proceso,$obtener_color){
	global $conn;
	$formulas=busca_filtro_tabla("b.nombre,
  b.idft_formula_indicador AS id,
  b.unidad,
  b.rango_colores,
  b.tipo_rango,
  a.ft_proceso,
  a.idft_indicadores_calidad","ft_indicadores_calidad a,
  ft_formula_indicador b,
  documento d","b.ft_indicadores_calidad=a.idft_indicadores_calidad
AND b.documento_iddocumento =iddocumento
AND d.estado<>'ELIMINADO'
and a.ft_proceso=".$idft_proceso,"",$conn);
	//print_r($formulas[0]);
	$rojo=0;
	$amarillo=0;
	$verde=0;
	if($formulas["numcampos"]){
		
		for($i=0;$i<$formulas["numcampos"];$i++){
			$seg=busca_filtro_tabla("f.*,".fecha_db_obtener("fecha_seguimiento","Y-m-d")." as fecha_seguimiento","ft_seguimiento_indicador f,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_formula_indicador=".$formulas[$i]["id"],"f.fecha_seguimiento desc",$conn);
			if(!$seg["numcampos"])continue;
			$rango=explode(",",$formulas[$i]["rango_colores"]);
			
			$dato=array();
    	$dato2=array();
    	$dato3=array();
    	$dato4=array();
    	$dato5=array();

     	for($j=0;$j<1;$j++){
      	$vector=explode(";",$seg[$j]["resultado"]);
        $formula2=$formulas[$i]["nombre"];
        $formula2=preg_replace_callback(
            "([A-Za-z_]+[0-9]*)",
            create_function(
            '$matches',
            'return ("{".$matches[0]."}");'
        ),
            $formula2);
        foreach($vector as $fila){
        	$aux=explode(":",$fila);
          $formula2=str_replace("{".$aux[0]."}",$aux[1],$formula2);
        }
        eval("\$respuesta=$formula2;");
     
   			if($formulas[0]["tipo_rango"]==1){
        	$cumplimiento=number_format(($respuesta/$seg[$j]["meta_indicador_actual"])*100,0,".","");
				}
				else if($formulas[0]["tipo_rango"]==0){
					if($respuesta<=$seg[$j]["meta_indicador_actual"]){
						$cumplimiento=(1+(($seg[$j]["meta_indicador_actual"]-$respuesta)/$seg[$j]["meta_indicador_actual"]))*100;
					}
					else{
						$cumplimiento=(($seg[$j]["meta_indicador_actual"]-$respuesta)/$seg[$j]["meta_indicador_actual"])*100;
					}
				}
        if($respuesta<$rango[0]){
        	if($formulas[$i]["tipo_rango"]=="1"){
          	$color="#FF4000";   //ROJO
          	$rojo++;
						$procesos_rojo[]=$formulas[$i]["ft_proceso"];
						
						$indicadores_rojo[]=$formulas[$i]["idft_indicadores_calidad"];
					}
          else{
            $color="#00FF51";  //VERDE
            $verde++;
						$procesos_verde[]=$formulas[$i]["ft_proceso"];
						
						$indicadores_verde[]=$formulas[$i]["idft_indicadores_calidad"];
					}  
        }
        elseif($respuesta>=$rango[0] && $respuesta<=$rango[1]){
        	$color="#EAFF00";//AMARILLO
        	$amarillo++;
					$procesos_amarillo[]=$formulas[$i]["ft_proceso"];
					
					$indicadores_amarillo[]=$formulas[$i]["idft_indicadores_calidad"];
				}
        else{
        	if($formulas[$i]["tipo_rango"]=="0"){
          	$color="#FF4000";   //ROJO
          	$rojo++;
						$procesos_rojo[]=$formulas[$i]["ft_proceso"];
						
						$indicadores_rojo[]=$formulas[$i]["idft_indicadores_calidad"];
					}
          else{
          	$color="#00FF51";  //VERDE
          	$verde++;
						$procesos_verde[]=$formulas[$i]["ft_proceso"];
						
						$indicadores_verde[]=$formulas[$i]["idft_indicadores_calidad"];
					}
        }
      }
		}
	}
	$retorno="";
	if($obtener_color=='rojo'){
		$retorno=$rojo;
		$indicadores=$indicadores_rojo;
	}
	if($obtener_color=='amarillo'){
		$retorno=$amarillo;
		$indicadores=$indicadores_amarillo;
		
	}
	if($obtener_color=='verde'){
		$retorno=$verde;
		$indicadores=$indicadores_verde;
	}
	$indicadores=array_unique($indicadores);
	//print_r(count($indicadores));die();
	$retorno=count($indicadores);
	return(array($retorno,$indicadores));
}
function fuente_datos_funcion($fuente_datos){
	return($fuente_datos);
}
function fecha_seguimiento_funcion($idft_indicadores_calidad){
	global $conn;
	$datos_hijo=busca_filtro_tabla(fecha_db_obtener("fecha_seguimiento",'Y-m-d')." as x_fecha_seguimiento","ft_formula_indicador A, ft_seguimiento_indicador B, documento C, documento D","A.ft_indicadores_calidad=".$idft_indicadores_calidad." AND A.idft_formula_indicador=B.ft_formula_indicador AND A.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO') AND B.documento_iddocumento=D.iddocumento AND D.estado not in('ELIMINADO')","B.fecha_seguimiento desc",$conn);
	return(($datos_hijo[0]["x_fecha_seguimiento"]));
}
function meta_funcion($idft_indicadores_calidad){
	global $conn;
	$datos_hijo=busca_filtro_tabla("meta_indicador_actual","ft_formula_indicador A, ft_seguimiento_indicador B, documento C, documento D","A.ft_indicadores_calidad=".$idft_indicadores_calidad." AND A.idft_formula_indicador=B.ft_formula_indicador AND A.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO') AND B.documento_iddocumento=D.iddocumento AND D.estado not in('ELIMINADO')","B.fecha_seguimiento desc",$conn);
	return($datos_hijo[0]["meta_indicador_actual"]);
}
function resultado_calculo_color($idft_indicadores_calidad){
	$resultado=calculo_indicador($idft_indicadores_calidad);
	return('<span style="background:'.$resultado[0].'">'.$resultado[1].'</span>');
}
function zona_riesgo($idft_indicadores_calidad){
	$resultado=calculo_indicador($idft_indicadores_calidad);
	return($resultado[2]);
}
function calculo_indicador($idft_indicadores_calidad){
	$formulas=busca_filtro_tabla("b.nombre,
  b.idft_formula_indicador AS id,
  b.unidad,
  b.rango_colores,
  b.tipo_rango,
  a.ft_proceso,
  a.idft_indicadores_calidad","ft_indicadores_calidad a,
  ft_formula_indicador b,
  documento d","b.ft_indicadores_calidad=a.idft_indicadores_calidad
AND b.documento_iddocumento =iddocumento
AND d.estado<>'ELIMINADO'
and a.idft_indicadores_calidad=".$idft_indicadores_calidad,"",$conn);
	
	$rojo=0;
	$amarillo=0;
	$verde=0;
	if($formulas["numcampos"]){
		
		for($i=0;$i<$formulas["numcampos"];$i++){
			$seg=busca_filtro_tabla("f.*,".fecha_db_obtener("fecha_seguimiento","Y-m-d")." as fecha_seguimiento","ft_seguimiento_indicador f,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_formula_indicador=".$formulas[$i]["id"],"f.fecha_seguimiento desc",$conn);
			if(!$seg["numcampos"])continue;
			$rango=explode(",",$formulas[$i]["rango_colores"]);
			
			$dato=array();
    	$dato2=array();
    	$dato3=array();
    	$dato4=array();
    	$dato5=array();

     	for($j=0;$j<1;$j++){
      	$vector=explode(";",$seg[$j]["resultado"]);
        $formula2=$formulas[$i]["nombre"];
        $formula2=preg_replace_callback(
            "([A-Za-z_]+[0-9]*)",
            create_function(
            '$matches',
            'return ("{".$matches[0]."}");'
        ),
            $formula2);
        foreach($vector as $fila){
        	$aux=explode(":",$fila);
          $formula2=str_replace("{".$aux[0]."}",$aux[1],$formula2);
        }
        eval("\$respuesta=$formula2;");
     
   			if($formulas[0]["tipo_rango"]==1){
        	$cumplimiento=number_format(($respuesta/$seg[$j]["meta_indicador_actual"])*100,0,".","");
				}
				else if($formulas[0]["tipo_rango"]==0){
					if($respuesta<=$seg[$j]["meta_indicador_actual"]){
						$cumplimiento=(1+(($seg[$j]["meta_indicador_actual"]-$respuesta)/$seg[$j]["meta_indicador_actual"]))*100;
					}
					else{
						$cumplimiento=(($seg[$j]["meta_indicador_actual"]-$respuesta)/$seg[$j]["meta_indicador_actual"])*100;
					}
				}
        if($respuesta<$rango[0]){
        	if($formulas[$i]["tipo_rango"]=="1"){
          	$color="#FF4000";   //ROJO
          	$rojo++;
						$procesos_rojo[]=$formulas[$i]["ft_proceso"];
						
						$indicadores_rojo[]=$formulas[$i]["idft_indicadores_calidad"];
					}
          else{
            $color="#00FF51";  //VERDE
            $verde++;
						$procesos_verde[]=$formulas[$i]["ft_proceso"];
						
						$indicadores_verde[]=$formulas[$i]["idft_indicadores_calidad"];
					}  
        }
        elseif($respuesta>=$rango[0] && $respuesta<=$rango[1]){
        	$color="#EAFF00";//AMARILLO
        	$amarillo++;
					$procesos_amarillo[]=$formulas[$i]["ft_proceso"];
					
					$indicadores_amarillo[]=$formulas[$i]["idft_indicadores_calidad"];
				}
        else{
        	if($formulas[$i]["tipo_rango"]=="0"){
          	$color="#FF4000";   //ROJO
          	$rojo++;
						$procesos_rojo[]=$formulas[$i]["ft_proceso"];
						
						$indicadores_rojo[]=$formulas[$i]["idft_indicadores_calidad"];
					}
          else{
          	$color="#00FF51";  //VERDE
          	$verde++;
						$procesos_verde[]=$formulas[$i]["ft_proceso"];
						
						$indicadores_verde[]=$formulas[$i]["idft_indicadores_calidad"];
					}
        }
      }
		}
	}
	$retorno[0]=$color;
	$retorno[1]=$respuesta;
	if($amarillo)$retorno[2]="Satisfactorio";//AMARILLA
	if($rojo)$retorno[2]="Deficiente";//ROJA
	if($verde)$retorno[2]="Sobresaliente";//VERDE
	return($retorno);
}
function observaciones_funcion($idft_indicadores_calidad){
	global $conn;
	$datos_hijo=busca_filtro_tabla("observaciones","ft_formula_indicador A, ft_seguimiento_indicador B, documento C, documento D","A.ft_indicadores_calidad=".$idft_indicadores_calidad." AND A.idft_formula_indicador=B.ft_formula_indicador AND A.documento_iddocumento=C.iddocumento AND C.estado not in('ELIMINADO') AND B.documento_iddocumento=D.iddocumento AND D.estado not in('ELIMINADO')","B.fecha_seguimiento desc",$conn);
	return($datos_hijo[0]["observaciones"]);
	
}



function contadores_colores(&$procesos_rojo, &$procesos_amarillo, &$procesos_verde){
	global $conn;
	$formulas=busca_filtro_tabla("b.nombre,
  b.idft_formula_indicador AS id,
  b.unidad,
  b.rango_colores,
  b.tipo_rango,
  a.ft_proceso","ft_indicadores_calidad a,
  ft_formula_indicador b,
  documento d","b.ft_indicadores_calidad=a.idft_indicadores_calidad
AND b.documento_iddocumento =iddocumento
AND d.estado<>'ELIMINADO'","",$conn);
	//print_r($formulas['sql']);die();
	$rojo=0;
	$amarillo=0;
	$verde=0;
	if($formulas["numcampos"]){
		
		for($i=0;$i<$formulas["numcampos"];$i++){
			$seg=busca_filtro_tabla("f.*,".fecha_db_obtener("fecha_seguimiento","Y-m-d")." as fecha_seguimiento","ft_seguimiento_indicador f,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_formula_indicador=".$formulas[$i]["id"],"f.fecha_seguimiento desc",$conn);
			if(!$seg["numcampos"])continue;
			$rango=explode(",",$formulas[$i]["rango_colores"]);
			
			$dato=array();
    	$dato2=array();
    	$dato3=array();
    	$dato4=array();
    	$dato5=array();

     	for($j=0;$j<1;$j++){
      	$vector=explode(";",$seg[$j]["resultado"]);
        $formula2=$formulas[$i]["nombre"];
        $formula2=preg_replace_callback(
            "([A-Za-z_]+[0-9]*)",
            create_function(
            '$matches',
            'return ("{".$matches[0]."}");'
        ),
            $formula2);
        foreach($vector as $fila){
        	$aux=explode(":",$fila);
          $formula2=str_replace("{".$aux[0]."}",$aux[1],$formula2);
        }
        eval("\$respuesta=$formula2;");
     
   			if($formulas[0]["tipo_rango"]==1){
        	$cumplimiento=number_format(($respuesta/$seg[$j]["meta_indicador_actual"])*100,0,".","");
				}
				else if($formulas[0]["tipo_rango"]==0){
					if($respuesta<=$seg[$j]["meta_indicador_actual"]){
						$cumplimiento=(1+(($seg[$j]["meta_indicador_actual"]-$respuesta)/$seg[$j]["meta_indicador_actual"]))*100;
					}
					else{
						$cumplimiento=(($seg[$j]["meta_indicador_actual"]-$respuesta)/$seg[$j]["meta_indicador_actual"])*100;
					}
				}
        if($respuesta<$rango[0]){
        	if($formulas[$i]["tipo_rango"]=="1"){
          	$color="#FF4000";   //ROJO
          	$rojo++;
						$procesos_rojo[]=$formulas[$i]["ft_proceso"];
					}
          else{
            $color="#00FF51";  //VERDE
            $verde++;
						$procesos_verde[]=$formulas[$i]["ft_proceso"];
					}  
        }
        elseif($respuesta>=$rango[0] && $respuesta<=$rango[1]){
        	$color="#EAFF00";//AMARILLO
        	$amarillo++;
					$procesos_amarillo[]=$formulas[$i]["ft_proceso"];
				}
        else{
        	if($formulas[$i]["tipo_rango"]=="0"){
          	$color="#FF4000";   //ROJO
          	$rojo++;
						$procesos_rojo[]=$formulas[$i]["ft_proceso"];
					}
          else{
          	$color="#00FF51";  //VERDE
          	$verde++;
						$procesos_verde[]=$formulas[$i]["ft_proceso"];
				} 
        }
      }
		}
	}

	return(array($rojo,$amarillo,$verde));
}

?>