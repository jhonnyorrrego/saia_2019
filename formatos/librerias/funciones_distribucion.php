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

function ingresar_distribucion($iddoc,$datos){
	global $conn,$ruta_db_superior;
	
	/*
	 * $datos
	 	* ['origen']   		---> iddependencia_cargo
	 	* ['tipo_origen']	---> 1,funcionario;2,ejecutor
	 	* ['destino']		---> iddependencia_cargo ó dependencia#
	 	* ['tipo_destino']	---> 1,funcionario;2,ejecutor
	 	* ['estado_distribucion']  ---> 0,Pediente; 1,Por Distribuir; 2,En distribucion; 3,Finalizado
	*/
	
	//--------------------------------------------------------
	
	//OBTENER RUTA_ORIGEN
	$idft_ruta_distribucion_origen=0;
	if($datos['tipo_origen']==1){
		$idft_ruta_distribucion_origen=obtener_ruta_distribucion($datos['origen']);
	}
	//OBTENER MENSAJERO_RUTA_ORIGEN
	$iddependencia_cargo_mensajero_origen=0;
	if($idft_ruta_distribucion_origen){
		$iddependencia_cargo_mensajero_origen=obtener_mensajero_ruta_distribucion($idft_ruta_distribucion_origen);
	}
	
	//---------------------------------------------------------------
	
	//ESTADO RECOGIDA
	$estado_recogida=0;
	if($datos['tipo_origen']==2){  //SI VIENE DE AFUERA
		$estado_recogida=1;
	}
	
	//ESTADO_DISTRIBUCION
	$estado_distribucion=0;
	if(@$datos['estado_distribucion']){
		$estado_distribucion=$datos['estado_distribucion'];
	}
	
	//FECHA DE CREACION
	$fecha_creacion=fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s');
	
	//--------------------------------------------------------
	
	//ORGANIZAR DESTINOS DEPENDENCIA - ROLES
	$array_destinos=array();
	$es_dependencia=0;
	if( $datos['destino'][ (strlen($datos['destino'])-1) ] == '#' ){
		$es_dependencia=1;
	}
	if($es_dependencia){
		$array_destinos=obtener_funcionarios_dependencia_destino($datos['destino']);	
		
	}else{
		$array_destinos[]=$datos['destino'];
	}
	
	$array_iddistribucion=array();
	for($j=0;$j<count($array_destinos);$j++){
		
		//NUMERO DE DISTRIBUCION
		$numero_distribucion=obtener_numero_distribucion($iddoc);		
	
		//OBTENER RUTA_DESTINO
		$idft_ruta_distribucion_destino=0;
		if($datos['tipo_destino']==1){
			$idft_ruta_distribucion_destino=obtener_ruta_distribucion($array_destinos[$j]);
		}	
		//OBTENER MENSAJERO_RUTA_DESTINO
		$iddependencia_cargo_mensajero_destino=0;
		if($idft_ruta_distribucion_destino){
			$iddependencia_cargo_mensajero_destino=obtener_mensajero_ruta_distribucion($idft_ruta_distribucion_destino);
		}	
		
		//---------------------------------------------------------
		
		//INSERTAR DISTRIBUCION
		$sqli="INSERT INTO distribucion
			(
				origen,
				tipo_origen,
				ruta_origen,
				mensajero_origen,
				
				destino,
				tipo_destino,
				ruta_destino,
				mensajero_destino,
				
				numero_distribucion,
				estado_distribucion,
				estado_recogida,
				
				documento_iddocumento,
				fecha_creacion
			) 
				VALUES 
			(
				".$datos['origen'].",
				".$datos['tipo_origen'].",
				".$idft_ruta_distribucion_origen.",
				".$iddependencia_cargo_mensajero_origen.",
				
				".$array_destinos[$j].",
				".$datos['tipo_destino'].",
				".$idft_ruta_distribucion_destino.",
				".$iddependencia_cargo_mensajero_destino.",
				
				".$numero_distribucion.",
				".$estado_distribucion.",
				".$estado_recogida.",
				
				".$iddoc.",
				".$fecha_creacion."
				
			)
				
		";	
		phpmkr_query($sqli);
		$array_iddistribucion[]=phpmkr_insert_id();
		
	}
	return($array_iddistribucion);
	
}
function obtener_ruta_distribucion($iddependencia_cargo){
	global $conn,$ruta_db_superior;	
	
	$dependencia_funcionario=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$iddependencia_cargo,"",$conn);
	
	$ruta_distribucion=busca_filtro_tabla("a.idft_ruta_distribucion","ft_ruta_distribucion a, documento b, ft_dependencias_ruta c","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND c.estado_dependencia=1 AND dependencia_asignada=".$dependencia_funcionario[0]['iddependencia'],"",$conn);

	$retorno=0;
	if($ruta_distribucion['numcampos']){
		$retorno=$ruta_distribucion[0]['idft_ruta_distribucion'];
	}
	return($retorno);
}
function obtener_mensajero_ruta_distribucion($idft_ruta_distribucion){
	global $conn,$ruta_db_superior;	
	
	$mensajero_ruta_distribucion=busca_filtro_tabla("c.mensajero_ruta","ft_ruta_distribucion a, documento b, ft_funcionarios_ruta c","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=".$idft_ruta_distribucion,"",$conn);
	$retorno=0;
	if($mensajero_ruta_distribucion['numcampos']){
		$retorno=$mensajero_ruta_distribucion[0]['mensajero_ruta'];
	}
	return($retorno);	
		
}
function obtener_numero_distribucion($iddoc){
	global $conn,$ruta_db_superior;	
	
	$numero_radicado=busca_filtro_tabla("numero,estado","documento","iddocumento=".$iddoc,"",$conn);
	$distribuciones_iddoc=busca_filtro_tabla("iddistribucion","distribucion","documento_iddocumento=".$iddoc,"",$conn);
	$numero_distribucion=$numero_radicado[0]['numero'].'.'.($distribuciones_iddoc['numcampos']+1);
	return($numero_distribucion);
}
function obtener_funcionarios_dependencia_destino($iddependencia){
	global $conn;
	
	$array_funcionarios=array();
	$dependencia=str_replace("#", "", $iddependencia);
	$dependencia.=",".buscar_dependencias_hijas_distribucion($dependencia);
	$dependencia=trim($dependencia,',');
    $busca_funcionarios=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","tipo_cargo=1 AND estado=1 AND estado_dc=1 AND estado_dep=1 AND iddependencia IN(".$dependencia.")","",$conn);
    for ($j=0; $j < $busca_funcionarios['numcampos']; $j++) { 
		$array_funcionarios[]=$busca_funcionarios[$j]['iddependencia_cargo'];
	}
	return($array_funcionarios);
}
function buscar_dependencias_hijas_distribucion($iddependencia){
	global $conn;
	$lista_hijas='';
	$busca_hijas=busca_filtro_tabla("iddependencia","dependencia","cod_padre=".$iddependencia,"",$conn);
	if($busca_hijas['numcampos']){
		for($i=0;$i<$busca_hijas['numcampos'];$i++){
			$lista_hijas.=$busca_hijas[$i]['iddependencia'].",";
			$lista_hijas.=buscar_dependencias_hijas_distribucion($busca_hijas[$i]['iddependencia']);
		}
	}
	return($lista_hijas);
}

function mostrar_listado_distribucion_documento($idformato,$iddoc){  //PENDIENTE DE TERMINAR, ESTA TABLA SE VA AENLISTAR EN EL MOSTRAR DE LOS DOCUMENTOS QUE VAN A SER DISTRIBUIDOS
	global $conn,$ruta_db_superior;
	
	$distribuciones=busca_filtro_tabla("","distribucion","documento_iddocumento=".$iddoc,"",$conn);
    $tabla='
    	<table class="table table-bordered adicionar_campo" style="width: 100%; font-size:10px; text-align:left;" border="1">
    	<tr>
        	<th style="text-align:center;">No. Item</th>
        	<th style="text-align:center;">Nombre origen</th>
        	<th style="text-align:center;">Nombre destino</th>
       		<th style="text-align:center;">Cargo</th>
        	<th style="text-align:center;">Ubicación</th>
        	<th style="text-align:center;">Observaciones</th>
        	<th style="text-align:center;">Acciones</th>
      	</tr>
    ';
	$tabla.='</table>';
}

//---------------------------------------------------------------------------------------------

//REPORTE DE DISTRIBUCION

function ver_documento_distribucion($iddocumento,$tipo_origen) {
	global $conn;
	
	$cadena_fecha_obtener=fecha_db_obtener('a.fecha','Y-m-d')." AS fecha";
	$datos_documento=busca_filtro_tabla("a.numero,".$cadena_fecha_obtener,"documento a, formato b","lower(a.plantilla)=lower(b.nombre) AND a.iddocumento=".$iddocumento,"",$conn);

	$numero=$datos_documento[0]['numero'];
	$fecha=$datos_documento[0]['fecha'];
	$array_tipo_origen=array(1=>'I',2=>'E');
	$cadena_mostrar=$fecha.'-'.$numero.'-'.$array_tipo_origen[$tipo_origen];
	
	$enlace_documento='<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$numero.'"><center><span class="badge">'.$cadena_mostrar.'</span></center></div>';
	
	return($enlace_documento);
} 

function ver_estado_distribucion($estado_distribucion){
	$array_estado_distribucion=array('estado_distribucion'=>'Pendiente',0=>'Pendiente',1=>'Pendiente por distribuir',2=>'En distribuci&oacute;n',3=>'Finalizado');
	return($array_estado_distribucion[$estado_distribucion]);	
}

function mostrar_diligencia_distribucion($tipo_origen,$estado_recogida){

	if($estado_recogida=='estado_recogida'){
		$estado_recogida=0;
	}
	
	$diligencia='ENTREGA';
	if($tipo_origen==1 && !$estado_recogida){
		$diligencia='RECOGIDA';
	}
	
	return($diligencia);
}

function mostrar_nombre_ruta_distribucion($tipo_origen,$estado_recogida,$ruta_origen,$ruta_destino){
	global $conn;
	
	if($estado_recogida=='estado_recogida'){ $estado_recogida=0; }
	if($ruta_origen=='ruta_origen'){ $ruta_origen=0; }
	if($ruta_destino=='ruta_destino'){ $ruta_destino=0; }
	
	$idft_ruta_distribucion=$ruta_destino; //ENTREGA
	if($tipo_origen==1 && !$estado_recogida){  //RECOGIDA
		$idft_ruta_distribucion=$ruta_origen;
	}
	
	$nombre_ruta_distribucion='Sin definir';
	if($idft_ruta_distribucion){
		$ruta_distribucion=busca_filtro_tabla("nombre_ruta","ft_ruta_distribucion","idft_ruta_distribucion=".$idft_ruta_distribucion,"",$conn);
		if($ruta_distribucion['numcampos']){
			$nombre_ruta_distribucion=$ruta_distribucion[0]['nombre_ruta'];
		}
	}
	return($nombre_ruta_distribucion);	
}

function select_mensajeros_ruta_distribucion($iddistribucion){
	global $conn;
	
	$datos_distribucion=busca_filtro_tabla("tipo_origen,estado_recogida,ruta_origen,ruta_destino,mensajero_origen,mensajero_destino","distribucion","iddistribucion=".$iddistribucion,"",$conn);
	
}




function filtrar_mensajero(){
	
}
function select_finalizar_generar_item(){
	
}

?>