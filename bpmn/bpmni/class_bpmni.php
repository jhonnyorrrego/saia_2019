<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php include_once($ruta_db_superior."db.php"); ?><?php
class bpmni{
  var $idbpmni;
	public function __construct(){}
	public function __destruct(){}
	public function get_bpmni($idbpmni){
	  global $conn;
		$this->idbpmni=$idbpmni;
		$this->bpmni=busca_filtro_tabla("","paso_documento A, diagram_instance B","A.diagram_iddiagram_instance=B.iddiagram_instance AND B.iddiagram_instance=".$idbpmni,"",$conn);
	}

	public function existe_bpmni(){
    if(!$this->bpmni["numcampos"]){
      return(false);
    }
		return(true);
	}

public function buscar_tareas_bpmni($nombre_pantalla){
	//Todas las tareas ejecutadas
	$tareasi=busca_filtro_tabla("","bpmn_tarea A,bpmni_tarea B","B.fk_idbpmni=".$this->idbpmni,"HAVING MAX(fecha)",$conn);
	if($tareasi["numcampos"]){
		//Busca la tarea u objeto bpmn siguiente para procesarlo
		$tarea_siguiente=busca_filtro_tabla("","bpmn_evento A, bpmn_enlace B","A.idbpmn_evento=B.origen AND B.tipo_origen='bpmn_evento' AND A.fk_idbpmn=".$this->idbpmni." AND A.tipo_evento='startevent'","",$conn);
		return($tareasi);
	}
	else{
		//busco el inicio dentro de los eventos
		$inicio=busca_filtro_tabla("","bpmn_evento A, bpmn_enlace B","A.idbpmn_evento=B.origen AND B.tipo_origen='bpmn_evento' AND A.fk_idbpmn=".$this->idbpmni." AND A.tipo_evento='startevent'","",$conn);
		if($inicio["numcampos"]){
			//busca la tarea siguiente al inicio para definir la tarea inicial
			$tarea=busca_filtro_tabla("","bpmn_tarea_usuario A, pantalla B","A.fk_idpantalla=B.idpantalla AND A.fk_idbpmn_tarea=".$inicio[0]["destino"]." AND B.nombre LIKE '".$nombre_pantalla."'","",$conn);
			if($tarea["numcampos"]){
				return($tarea);
			}
			else{
				return(false);
			}
		}
	}
}
function finalizar_bpmni($evento_finaliza){
	$datos=array();
	$datos["idbpmni"]=$this->idbpmni;
	$datos["estado_bpmni"]=1;
	$this->update_bpmni("json",json_encode($datos));
}
function finalizado_bpmni(){
	return($this->get_valor_bpmni("bpmni","estado_bpmni"));
}
function iniciar_bpmni($idpantalla,$nombre_pantalla,$idregistro){
	///TODO: Generar vista para la consulta de los eventos que inician un bpmn
	/*$bpmn=busca_filtro_tabla("A.fk_idbpmn,A.idbpmn_tarea","bpmn_tarea A,bpmn_enlace B,bpmn_evento C,bpmn_tarea_usuario D","A.idbpmn_tarea=D.fk_idbpmn_tarea AND B.tipo_origen='bpmn_evento' AND B.origen=C.idbpmn_evento AND C.tipo_evento='startevent' AND B.destino=A.idbpmn_tarea AND D.fk_idpantalla=".$idpantalla ,"","",$conn);
	for($i=0;$i<$bpmn["numcampos"] && $i<10;$i++){
	$datos=array();
	$datos["estado_bpmni"]=0;
	$datos["fk_idbpmn"]=$bpmn[$i]["fk_idbpmn"];
	$datos["descripcion"]="INICIO PROCESO ".$nombre_pantalla;
	$this->set_bpmni(0,"json",json_encode($datos));
	}	*/
	}
} 
?>