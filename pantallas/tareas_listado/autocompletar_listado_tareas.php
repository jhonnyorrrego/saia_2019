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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."class.funcionarios.php");

if(isset($_REQUEST['nombre_lista'])){


$idserie_macro=busca_filtro_tabla("idserie","serie","lower(nombre) LIKE 'macroprocesos%-%procesos'","",$conn);
$macro=busca_filtro_tabla("idserie","serie","cod_padre=".$idserie_macro[0]['idserie']." and estado=1","nombre",$conn);
if($macro["numcampos"]){
	$idserie_macro=extrae_campo($macro,"idserie");	
	$datos_admin_funcionario=busca_datos_administrativos_funcionario(0);
	$identidad_series_funcionario=array_merge($datos_admin_funcionario["series_funcionario"],$datos_admin_funcionario["series_cargo"]);
	$identidad_series_funcionario=array_unique($identidad_series_funcionario);
	$cidseries_fun=busca_filtro_tabla("","entidad_serie","identidad_serie IN(".implode(',',$identidad_series_funcionario).")","",$conn);
	$series_funcionario=extrae_campo($cidseries_fun,'serie_idserie');	
	
	$datos_macro_proceso=busca_filtro_tabla("s.idserie as idserie_proceso,sp.idserie as idserie_macro,s.nombre,sp.nombre as nombre_padre","serie s, serie sp","s.cod_padre=sp.idserie AND (lower(sp.nombre) like '%".strtolower($_REQUEST['nombre_lista'])."%' OR lower(s.nombre) like '%".strtolower($_REQUEST['nombre_lista'])."%')  and sp.estado=1 and s.estado=1 and s.cod_padre in (".implode(",", $idserie_macro).") and s.idserie IN(".implode(',',$series_funcionario).")","sp.nombre",$conn);

	$html="<ul>";
	if($datos_macro_proceso['numcampos']){
		
		for($j=0;$j<$datos_macro_proceso['numcampos'];$j++){
		    
		    if(@$_REQUEST['calendario_planeador']){
		        $descripcion=$datos_macro_proceso[$j]['nombre_padre']." / ".$datos_macro_proceso[$j]['nombre'];
    			$html.="<li onclick=\"cargar_datos_listado_tareas(".$datos_macro_proceso[$j]['idserie_proceso'].",'".$descripcion."')\">".$descripcion."</li>";
		    }else{
    			 $datos=busca_filtro_tabla("a.idlistado_tareas,a.nombre_lista","listado_tareas a","( a.macro_proceso=".$datos_macro_proceso[$j]['idserie_proceso']." )","",$conn);
    			
    			if($datos['numcampos']){
    				for($i=0;$i<$datos['numcampos'];$i++){
    					$descripcion=$datos_macro_proceso[$j]['nombre_padre']." / ".$datos_macro_proceso[$j]['nombre']." - ".$datos[$i]['nombre_lista'];
    					$html.="<li onclick=\"cargar_datos_listado_tareas(".$datos[$i]['idlistado_tareas'].",'".$descripcion."')\">".$descripcion."</li>";
    				}									
    			}
    			
    			$idlistados_anteriores=extrae_campo($datos,'idlistado_tareas');
    			
    			$datos_permiso=busca_filtro_tabla("a.idlistado_tareas,a.nombre_lista","listado_tareas a, permiso_listado_tareas b","a.idlistado_tareas=b.fk_listado_tareas AND b.llave_entidad=".usuario_actual('idfuncionario')." AND ( a.macro_proceso=".$datos_macro_proceso[$j]['idserie_proceso']." )","",$conn);
    			
    			if($datos_permiso['numcampos']){
    				for($i=0;$i<$datos_permiso['numcampos'];$i++){
    					if(!in_array($datos_permiso[$i]['idlistado_tareas'], $idlistados_anteriores)){
    						$descripcion=$datos_macro_proceso[$j]['nombre_padre']." / ".$datos_macro_proceso[$j]['nombre']." - ".$datos_permiso[$i]['nombre_lista'];
    						$html.="<li onclick=\"cargar_datos_listado_tareas(".$datos_permiso[$i]['idlistado_tareas'].",'".$descripcion."')\">".$descripcion."</li>";						
    					}
    				}									
    			}
		    }	
		}

		if($html=="<ul>"){
			$html.="<li onclick=\"cargar_datos_listado_tareas(0)\">NO hay listados con el proceso ingresado</li>";
		}
		
	}else{
		$html.="<li onclick=\"cargar_datos_listado_tareas(0)\">NO hay listados con el proceso ingresado</li>";
	}
}else{
	$html.="<li onclick=\"cargar_datos_listado_tareas(0)\">NO hay listados con el proceso ingresado</li>";
}
$html.="</ul>";
echo($html);
}	

?>