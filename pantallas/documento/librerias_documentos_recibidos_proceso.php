<?php 

$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once ($ruta_db_superior.'db.php');
include_once($ruta_db_superior."pantallas/documento/librerias_flujo.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");




function filtro_funcionario($funcionario){
  if($funcionario=='funcionario'){
   $retorno=" AND B.llave_entidad='".usuario_actual("funcionario_codigo")."'";
  }
  else{
    $retorno=" AND B.llave_entidad='".$funcionario."'";
  }
  if(@$_REQUEST["variable_busqueda"]){
  	$retorno=" AND B.llave_entidad='".$_REQUEST["variable_busqueda"]."'";
  }
return($retorno);  
}

function mostrar_cantidad_proceso($plantilla){
		global $conn;
	
		
	
	$fun=usuario_actual("funcionario_codigo");

	$documentos=busca_filtro_tabla("","documento A,asignacion B","lower(A.estado)<>'eliminado' AND A.iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad='".$fun."'   GROUP BY A.fecha, A.estado, A.ejecutor, A.serie, A.descripcion, A.pdf, A.tipo_radicado, A.plantilla, A.numero, A.tipo_ejecutor, DATE_FORMAT( B.fecha_inicial,  'y-m-d' ) , A.iddocumento
 ","B.fecha_inicial DESC",$conn);
	
	$cont=0;
	for($i=0;$i<$documentos['numcampos'];$i++){
					
		$formato=busca_filtro_tabla('a.idformato,b.iddocumento,a.nombre,a.cod_padre,a.nombre','formato a, documento b','a.nombre=lower(b.plantilla) AND b.iddocumento='.$documentos[$i]['documento_iddocumento'],'',$conn);	
		
		if($formato[0]['cod_padre']==0 or $formato[0]['cod_padre']==NULL){
			if($formato[0]['nombre']==strtolower($plantilla)){
				$cont++;
			}
		}else{

			$papa_iddoc=buscar_papa_formato($formato[0]['idformato'],$formato[0]['iddocumento'],'ft_',$formato[0]['nombre']);	
			
			$formato_papa=busca_filtro_tabla('a.nombre','formato a, documento b','a.nombre=lower(b.plantilla) AND b.iddocumento='.$papa_iddoc,'',$conn);		
			
			if($formato_papa[0]['nombre']==strtolower($plantilla)){
				$cont++;
			}
		}
	}
	return($cont);
	
}

function mostrar_etiqueta_beauty($etiqueta){
						
	$eti=strtolower($etiqueta);
	$eti=ucwords($eti);
	return($eti);				
				
			
		
}

?>

