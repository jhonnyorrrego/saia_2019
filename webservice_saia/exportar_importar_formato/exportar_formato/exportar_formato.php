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
include_once('../define_exportar_importar.php');
require_once('lib/nusoap.php');  

$cliente = new nusoap_client(SERVIDOR_EXPORTAR);

if(@$_REQUEST['nombre_formato']){
	$nombre_formato = array();
	$nombre_formato['nombre_formato']=$_REQUEST['nombre_formato'];
	$nombre_formato = json_encode($nombre_formato);
	$ridformato = $cliente->call('generar_idformato', array($nombre_formato));
	$ridformato = json_decode($ridformato);	
	if($ridformato->exito){
		$idformato = $ridformato->idformato;
	}
}
if(@$_REQUEST['idformato'] || @$idformato){ //idformato a exportar
	if(@$_REQUEST['idformato']){
		$idformato=$_REQUEST['idformato'];
	}
	$vidformato = array();
	$vidformato['idformato']=$idformato; 
	$vidformato = json_encode($vidformato);
	$ridformato = $cliente->call('generar_exportar', array($vidformato));
	$ridformato = json_decode($ridformato);

	if($ridformato->exito){
		$exportar=json_encode($ridformato);
		
		if(@$_REQUEST["imprimir_json"]){
			print_r($exportar);
			die();
		}
		
		$medio = new nusoap_client(SERVIDOR_MEDIO);
		$respuesta_medio = $medio->call('conexion_exportar_importar', array($exportar));
		
		$respuesta_medio = json_decode($respuesta_medio,true);
		
		$cadena_respuesta='<table width="100" style="border-collapse:collapse;width:100%;border-width:1px;border-style:solid;" border="1">';
		$cadena_respuesta.='
			<tr>
				<td>Exito de la operacion:</td><td>'.$respuesta_medio['exito'].'</td>
			</tr>
			<tr>
				<td>Mensaje: </td><td>'.$respuesta_medio['mensaje'].'</td>
			</tr>
		';
		
		if(@$respuesta_medio['campos_formato_error']){
				$cadena_respuesta.='
					<tr>
						<td colspan="2" style="text-align:center;font-weight:bold;">Errores En \'campos_formato\'</td>
					</tr>
				';
			for($i=0;$i<count($respuesta_medio['campos_formato_error']);$i++){
				$cadena_respuesta.='<tr>
						<td>Error Campo Nro.'.($i+1).': </td><td>'.$respuesta_medio['campos_formato_error']['campos_formato_error_'.$i].'</td></tr>
				';
			}	
		}
		if(@$respuesta_medio['funciones_formato_error']){
				$cadena_respuesta.='<tr>
					<td colspan="2">Errores En \'funciones_formato\'</td>
					</tr>
				';
			for($i=0;$i<count($respuesta_medio['funciones_formato_error']);$i++){
				$cadena_respuesta.='<tr>
						<td>Error Funcion Nro.'.($i+1).': </td><td>'.$respuesta_medio['funciones_formato_error']['funciones_formato_error_'.$i].'</td></tr>
				';
					
			}		
		}		
		if(@$respuesta_medio['funciones_formato_accion_error']){
				$cadena_respuesta.='<tr>
					<td colspan="2">Errores En \'funciones_formato_accion\'</td>
					</tr>
				';
			for($i=0;$i<count($respuesta_medio['funciones_formato_accion_error']);$i++){
				$cadena_respuesta.='<tr>
						<td>Error Funcion Accion Nro.'.($i+1).': </td><td>'.$respuesta_medio['funciones_formato_accion_error']['funciones_formato_accion_error_'.$i].'</td></tr>
				';
					
			}		
		}		
		
		$cadena_respuesta.='</table>';
		echo($cadena_respuesta);
		//echo($respuesta_medio);	//ARRAY CON RESPUESTA FINAL
	}
}else{ 
	
	echo(json_encode(array('mensaje'=>'No existe formato con ese Nombre')));
}

?>