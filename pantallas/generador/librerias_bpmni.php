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
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior."librerias_saia.php");

function generar_metodo_validar_bpmni($pantalla,$campos_pantalla){
	$texto_pantalla='';
	$texto_parametro=array();
	$texto_pantalla.='public function validar_bpmni($accion="",$bpmni_key="", $bpmn_tarea_key=""){'."\n";
	$texto_pantalla.='	global $ruta_db_superior;	
	include_once($ruta_db_superior."bpmn/bpmni/class_bpmni.php");
	if($bpmni_key==""){
		if(@$_REQUEST["fk_idbpmni"]){
			$bpmni_key=$_REQUEST["fk_idbpmni"];
		}
		else if(@$this->'.$pantalla[0]["nombre"].'[0]["fk_idbpmni"]){
			$bpmni_key=$this->'.$pantalla[0]["nombre"].'[0]["fk_idbpmni"];
		}
		else if(@$_REQUEST["bpmni"]){
			$bpmni_key=$_REQUEST["bpmni"];
		}
	}
	if($bpmn_tarea_key==""){
		if(@$_REQUEST["fk_idbpmn_tarea"]){
			$bpmn_tarea_key=$_REQUEST["fk_idbpmn_tarea"];
		}
		else if(@$this->'.$pantalla[0]["nombre"].'[0]["fk_idbpmn_tarea"]){
			$bpmn_tarea_key=$this->'.$pantalla[0]["nombre"].'[0]["fk_idbpmn_tarea"];
		}
		else if(@$_REQUEST["idbpmn_tarea"]){
			$bpmn_tarea_key=$_REQUEST["idbpmn_tarea"];
		}
	}
	$bpmni=new bpmni();
	$bpmni->get_bpmni($bpmni_key);
	if($bpmni->existe_bpmni()){
		$this->validar_bpmni_tarea($bpmni,$bpmn_tarea_key,$accion);
	}
	else if(strpos("'.$pantalla[0]["nombre"].'","bpmni")===FALSE){
		$bpmni->iniciar_bpmni($this->idpantalla_'.$pantalla[0]["nombre"].',"'.$pantalla[0]["etiqueta"].'",$this->id'.$pantalla[0]["nombre"].');
		$this->validar_bpmni_tarea($bpmni,$bpmn_tarea_key,$accion);
	}	
	';
	$texto_pantalla.='}'."\n";
	return($texto_pantalla);
}

function generar_metodo_validar_bpmni_tarea($pantalla,$campos_pantalla){
  $texto_pantalla='';
	//Funcion que valida la tarea en el proceso, si encuentra la pantalla instanciada en el proceso lo retorna, de lo contrario devuelve los datos de la tarea
  $texto_pantalla.='public function validar_bpmni_tarea($bpmni,$bpmn_tarea_key,$accion){'."\n";
  $texto_pantalla.='//La tarea siempre debe traer el estado si no se tiene el estado lo adiciona por defecto en 0.
  $bpmni_tarea_temp=$bpmni->validar_tarea_pantalla($this->idpantalla_'.$pantalla[0]["nombre"].',$bpmn_tarea_key,$accion);
  if($bpmni_tarea_temp["numcampos"]){
		if($bpmni_tarea_temp[0]["idbpmni_tarea"]){
			//Acciones que se deban hacer cuando la tarea ya esta instanciada, verificar si se debe reemplazar el registro actual y desactivar el actual
			$this->actualiza_estado_instancia_bpmni($bpmni,$bpmni_tarea_temp[0],1);
		}
		else{
			//Recordar que aqui solo va la tarea en bpmni_tarea_temp
			$this->instancia_bpmni($bpmni,$bpmni_tarea_temp[0]);
		}
  }
';
  $texto_pantalla.='}'."\n";
  return($texto_pantalla);
}
function generar_metodo_instancia_bpmni($pantalla,$campos_pantalla){
	//Esta función genera el registro en la tabla bpmni_tarea y actualiza el registro con los datos de tarea y el bpmni 
	$texto_pantalla='';
  $texto_pantalla.='public function instancia_bpmni($bpmni,$tarea){'."\n";
  $texto_pantalla.='	global $ruta_db_superior;
  	include_once($ruta_db_superior."bpmn/bpmni_tarea/class_bpmni_tarea.php");
  $bpmni_tarea=new bpmni_tarea();
	$bpmni_tarea->get_from_tarea($bpmni,(object)$tarea);
	//Se instancia la tarea bpmni cuando no existe y se adiciona con el estado que se envia si existe 
  if(!$bpmni_tarea->existe_bpmni_tarea() && $this->id'.$pantalla[0]["nombre"].'){
  	$datos=array();
  	$datos["registro"]=$this->id'.$pantalla[0]["nombre"].';
  	$datos["fk_idbpmni"]=$bpmni->idbpmni;
		$datos["fk_idbpmn_tarea"]=$tarea["idbpmn_tarea"];
		$datos["fecha"]=date("Y-m-d H:i:s");
		$datos["estado"]=$tarea["estado"];
		if(@$this->iddocumento){
      $datos["documento_iddocumento"]=$this->iddocumento;
    }
		$bpmni_tarea->set_bpmni_tarea(0,"json",json_encode($datos));
	}
	if($this->get_valor_'.$pantalla[0]["nombre"].'("'.$pantalla[0]["nombre"].'","fk_idbpmni")=="" || $this->get_valor_'.$pantalla[0]["nombre"].'("'.$pantalla[0]["nombre"].'","fk_idbpmn_tarea")==""){
		$datos=array();
		$datos["id'.$pantalla[0]["nombre"].'"]=$this->id'.$pantalla[0]["nombre"].';
		$datos["fk_idbpmni"]=$bpmni->idbpmni;
		$datos["fk_idbpmn_tarea"]=$tarea["idbpmn_tarea"];
		$this->update_'.$pantalla[0]["nombre"].'("json",json_encode($datos));
	}
';
  $texto_pantalla.='}'."\n";
  return($texto_pantalla);
}
function generar_metodo_actualizar_estado_instancia_bpmni($pantalla,$campos_pantalla){
	$texto_pantalla='';
  $texto_pantalla.='public function actualiza_estado_instancia_bpmni($bpmni,$tarea,$estado){'."\n";
  $texto_pantalla.='	global $ruta_db_superior;
  	include_once($ruta_db_superior."bpmn/bpmni_tarea/class_bpmni_tarea.php");
  $bpmni_tarea=new bpmni_tarea();
	$bpmni_tarea->get_from_tarea($bpmni,(object)$tarea);
	//Se instancia la tarea bpmni cuando no existe y se adiciona con el estado que se envia si existe 
  if($bpmni_tarea->existe_bpmni_tarea()){
		$datos=array();
		$datos["idbpmni_tarea"]=$bpmni_tarea->idbpmni_tarea;
  	$datos["estado"]=$estado;
		$bpmni_tarea->update_bpmni_tarea("json",json_encode($datos));
	}';
  $texto_pantalla.='}'."\n";
  return($texto_pantalla);
}
?>