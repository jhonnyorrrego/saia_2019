<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php include_once($ruta_db_superior."db.php"); ?>
<?php include_once($ruta_db_superior."bpmn/bpmni/class_bpmni.php"); ?>
<?php include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php"); ?>
<?php
class bpmn{
var $bpmn;
var $idbpmn;
var $bpmni;
public function __construct(){
	$this->bpmni=new bpmni();
}
public function __destruct(){}
public function get_bpmn($idbpmn){
  global $conn;
	$this->idbpmn=$idbpmn;
	$this->bpmn=busca_filtro_tabla("","diagram A, diagramdata B","A.id=B.diagramid AND id=".$this->idbpmn,"",$conn);
}

public function existe_bpmn(){
    if(!$this->bpmn["numcampos"]){
      return(false);
    }
//TODO: Pendiente validar que el archivo exista en el campo filename 
    return(true);
}

public function inicializar(){
	global $ruta_db_superior;
	$this->archivo="";
	$this->formas=array();
	$this->enlaces=array();
	$this->dom = new DOMDocument;
	$this->dom->validateOnParse = true;
	$this->texto_svg="";
	$this->html="";
	$this->canvas = new svgCanvas(300, 500,'');
	$this->texto_estados="";
	$this->tipo_vista_bpmn=0;
	$this->tareas_siguientes=array();
  $this->pasos_ruta=array();
	if($_REQUEST["vista_bpmn"]==1 || $this->tipo_vista_bpmn==1){
		//tipo Vista bpmn es el tipo de vista 1: administrador,0:normal
		$this->tipo_vista_bpmn=1;
		$this->cargar_bpmn_saia();
		$this->validar_inicio_bpmn();
	}
	else{
		$this->dibuja_bpmn();
	}
}
public function dibuja_bpmn(){
	//Se cargan los datos de tareas, eventos , condicionales y enlaces para dibujarlos
	$this->get_tareas_bpmn();
	$this->get_eventos_bpmn();
	$this->get_condicionales_bpmn();
	$this->get_enlaces_bpmn();
	$this->dibuja_tareas();
	$this->dibuja_eventos();
	$this->dibuja_condicionales();
	$this->dibuja_enlaces();
	$this->habilitar_tarea_siguiente();
}
public function load_file_bpmn($campo){
	$archivo[0]["ruta"]=$this->bpmn[0]["fileName"];
	return($archivo);
}
public function dibuja_tareas(){
	for($i=0;$i<$this->tareas["numcampos"];$i++){
		$this->adicionar_texto_SVG($this->tareas[$i]["texto_svg"]);
		$this->validar_estado_tarea($this->tareas[$i]);
	}
	if(!$this->tareas_siguientes["numcampos"]){
		//print_r($this->evento_final_proceso);
		//En la validacion de las tareas se debe validar si la tarea siguiente es una terminacion adicionarla a un arreglo de terminaciones
		$inicio=$this->get_inicio_proceso();
    //Se cambia para que busque la tarea inicial con idpaso_evento=-1 
    $inicio[0]["idpaso_evento"]=-1;
		$this->tarea_siguiente($inicio[0],"bpmn_evento","paso_evento");
		//$this->texto_estados.='$("#'.$this->tareas_siguientes[0]["idsvg"].'").addClassSVG("habilitado");';
		if(@$this->tareas_siguientes[0]["idsvg"]){
			$this->texto_estados.='bpmn.annotation("'.$this->tareas_siguientes[0]["idsvg"].'").addClasses(["habilitado","task"]);';
		}
	}
}
public function validar_estado_tarea($tarea){
	//TODO: Verificar si aqui aplican mas tipos de tareas el default toma las tareas manuales(manualtask) y las treas(task) y las tareas de usuario
	if($this->tipo_vista_bpmn==1){
		$this->texto_estados.='bpmn.annotation("'.$tarea["idsvg"].'").addClasses(["habilitado"]);';
		return;
	}
	else {
		$this->validar_tarea_usuario($tarea);
	}
}
//Valida la opcion de que el ultimo paso este deshabilitado por un enlace posterior a un condicional
public function habilitar_tarea_siguiente(){
  //valida que el bpmn este pendiente, atrasado o iniciado  
  if(in_array($this->get_estado_bpmni(),array(4,5,6))){
    $tareas_activas=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND estado_paso_documento IN(4,5,6)","",$conn);
    //print_r($tareas_activas);
    //Si no hay pasos pendientes, iniciados o atrazados (4,5,6), busca el ultimo paso cerrado (0,1,2) para buscar el paso siguiente y ponerlo pendiente, validar que pasa cuando se devuelve.
    if(!$tareas_activas["numcampos"]){
      $ultimo_paso=busca_filtro_tabla("","paso_documento A,paso B","A.paso_idpaso=B.idpaso AND A.diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND A.estado_paso_documento=0","A.idpaso_documento DESC",$conn);
      if($ultimo_paso["numcampos"]){
        //TODO: Validar  que  pasa con los atrasados 
        $sql2="UPDATE paso_documento SET estado_paso_documento=4 WHERE idpaso_documento=".$ultimo_paso[0]["idpaso_documento"];
        phpmkr_query($sql2);   
        $this->texto_estados.='bpmn.annotation("'.$ultimo_paso[0]["idfigura"].'").addClasses(["habilitado","task_iniciada","taski"]);';
      }
    }  
  }
} 
function get_estado_bpmni(){
  if($this->bpmni->existe_bpmni()){
    //1,Ejecutado;2,Cerrado,3,Cancelado;4,Pendiente;5,Atrasado;6,Iniciado
    return($this->bpmni->bpmni[0]["estado_diagram_instance"]);
  }
  return(0);
}
public function listado_pasos_ruta(){
  $this->pasos_ruta=busca_filtro_tabla("","paso A, paso_actividad B, accion C","B.estado=1 AND A.idpaso=B.paso_idpaso AND B.accion_idaccion=C.idaccion AND (C.nombre LIKE 'confirmar%' OR C.nombre LIKE 'aprobar%') AND A.diagram_iddiagram=".$this->bpmn[0]["id"],"",$conn);
}
public function crear_posible_ruta($iddoc){
  $this->listado_pasos_ruta();
  $ruta=array();
  $radicador_salida=busca_filtro_tabla("","configuracion A, vfuncionario_dc B","A.valor=B.login AND A.nombre='radicador_salida'","",$conn);
  //pasos_ruta se debe almacenar por medio de acciones si se va a confirmar, confirmar y firmar, aprobar o aprobar y firmar, confirmar y responsable, aprobar y responsable o confirmar y firma manual o confirmar y firma manual validar si se hace por medio del paso_actividad o por medio de la accion intencionalidad por medio del paso_actividad
  for($i=0;$i<$this->pasos_ruta["numcampos"];$i++){
     array_push($ruta,array("funcionario"=>-1,"tipo_firma"=>0,"paso_actividad"=>$this->pasos_ruta[$i]["idpaso_actividad"]));
  }
  insertar_ruta($ruta,$iddoc,0);
}
public function tarea_siguiente($objeto_svg,$tipo_objeto,$tabla){
	if($tipo_objeto==""){
		$tipo_objeto="bpmn_tarea";
	}
	$tarea_siguiente=busca_filtro_tabla("","paso_enlace","tipo_origen='".$tipo_objeto."' AND origen=".$objeto_svg["id".$tabla]." AND diagram_iddiagram=".$this->idbpmn,"",$conn);
  for($i=0;$i<$tarea_siguiente["numcampos"];$i++){
		if($tarea_siguiente[$i]["tipo_destino"]=="bpmn_condicional"){
			$this->tarea_siguiente(array("idpaso_condicional"=>$tarea_siguiente[$i]["destino"]),"bpmn_condicional","paso_condicional");
		}
		else if($tarea_siguiente[$i]["tipo_destino"]=="bpmn_tarea"){
			$tarea_siguiente_destino=busca_filtro_tabla("","paso","idpaso=".$tarea_siguiente[$i]["destino"],"",$conn);
			if($tarea_siguiente_destino["numcampos"]){
				array_push($this->tareas_siguientes, array("idpaso"=>$tarea_siguiente_destino[0]["idpaso"],"idsvg"=>$tarea_siguiente_destino[0]["idfigura"]));
				$this->tareas_siguientes["numcampos"]++;
			}
			else{
				array_push($this->error_bpmn,$tarea_siguiente[0]["idfigura"]);
			}
		}
		else if($tarea_siguiente[$i]["tipo_destino"]=="bpmn_evento"){
			$evento_siguiente=busca_filtro_tabla("","paso_evento","paso_evento=".$tarea_siguiente[$i]["destino"],"",$conn);
			if($evento_siguiente["numcampos"]){
			  if($evento_siguiente[0]["tipo_evento"]=="endevent"){
          $this->evento_final_proceso=$evento_siguiente[0]["idpaso_evento"];
          if($this->bpmni->existe_bpmni()){
            $this->bpmni->finalizar_bpmni($this->evento_final_proceso);
          }  
			  }
			}
			else{
				array_push($this->error_bpmn,$tarea_siguiente[0]["idevento"]);
			}
			return;
		}
	}
	return;
}
public function imprime_estado_bpmni(){
$texto='';
//1,Ejecutado;2,Cerrado,3,Cancelado;4,Pendiente;5,Atrasado;6,Iniciado
switch ($this->get_estado_bpmni()){
	case 1 :
		$texto='<span class="label label-success">Ejecutado</span>';
	break;
	case 2 :
		$texto='<span class="label label-success">Cerrado</span>';
	break;
	case 3 :
		$texto='<span class="label label-important">Cancelado</span>';
		$motivo_cancela=busca_filtro_tabla("","diagram_closed A,paso_documento B, paso C","B.idpaso_documento=A.documento_idpaso_documento AND B.paso_idpaso=C.idpaso AND  A.diagram_iddiagram_instance=".$this->bpmni->idbpmni,"",$conn);
		
		$texto.='<br>Paso Cancelaci&oacute;n: '.$motivo_cancela[0]["nombre_paso"].'<br>Motivo:'.$motivo_cancela[0]["observaciones"];
	break;
	case 4 :
		$texto='<span class="label label-warning">Pendiente</span>';
	break;
	case 5 :
		$texto='<span class="label label-important">Atrasado</span>';
	break;
	default:
		$texto='<span class="label label-warning">Iniciado</span>';
	break;
}
return($texto);
} 
public function validar_tarea_usuario($tarea){
	$exito=0;
	$this->tareas_siguientes=array("numcampos"=>0);
	$this->errores_bpmn=array();
	$this->evento_final_proceso=0;
	if(in_array($tarea["idpaso"],$this->tareas_iniciadas)){
		$this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["task_iniciada","taski"]);';
		$this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["habilitado"]);';
		
	}
	if(in_array($tarea["idpaso"],$this->tareas_exito)){
		$this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["task_ok","taski"]);';
		$this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["habilitado"]);';
		$exito=1;
	}
	if(in_array($tarea["idpaso"],$this->tareas_devueltas)){
		$this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["task_error","taski"]);';
		$this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["habilitado"]);';
		$exito=1;
	}
	if(in_array($tarea["idpaso"],$this->tareas_anuladas)){
		$this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["task_error","taski"]);';
		$this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["habilitado"]);';
		$exito=1;
	}
	if(in_array($tarea["idpaso"],$this->tareas_atrasadas)){
    $this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["task_error","taski"]);';
    $this->texto_estados.='bpmn.annotation("'.$tarea["idfigura"].'").addClasses(["habilitado"]);';
    $exito=1;
  }
	/*if($exito && !$this->bpmni->finalizado_bpmni()){
		$this->tarea_siguiente($tarea,"bpmn_tarea");
		if($this->tareas_siguientes["numcampos"]){
			for($i=0;$i<$this->tareas_siguientes["numcampos"];$i++){
				if(!in_array($this->tareas_siguientes[$i]["idbpmn_tarea"],$this->tareas_activas)){
					$this->texto_estados.='bpmn.annotation("'.$this->tareas_siguientes[$i]["idsvg"].'").addClasses(["habilitado","task"]);';
				} 
			}
		}
	}*/
}
public function imprimir_estados_tarea(){
	if(!count($this->tareas_exito)&&!count($this->tareas_error)&&!count($this->tareas_anuladas)&&!count($this->tareas_iniciadas)&&!count($this->tareas_atrasadas) ){
		$inicio=$this->get_inicio_proceso();
		$siguiente=busca_filtro_tabla("","paso_enlace A,paso_evento B","A.origen=B.idpaso_evento AND A.origen=".$inicio[0]["idpaso_evento"]." AND A.tipo_origen='bpmn_evento' AND B.tipo_evento='startevent'","",$conn);
		if($siguiente["numcampos"]){
			if($siguiente[0]["tipo_destino"]=="bpmn_tarea" ){
				$tarea=busca_filtro_tabla("","bpmn_tarea","idbpmn_tarea=".$siguiente[0]["destino"],"",$conn);
				if($tarea["numcampos"]){
					$this->texto_estados.='bpmn.annotation("'.$tarea[0]["idsvg"].'").addClasses(["habilitado","task"]);';
				}
			}
		}
	}
	if($this->texto_estados){
		echo($this->texto_estados);
	}

}
public function dibuja_eventos(){
	for($i=0;$i<$this->eventos["numcampos"];$i++){
		$this->adicionar_texto_SVG($this->eventos[$i]["texto_svg"]);
		//TODO: Verificar el estado del evento
		//$this->validar_estado_evento();
	}
}
public function dibuja_condicionales(){
	for($i=0;$i<$this->condicionales["numcampos"];$i++){
		$this->adicionar_texto_SVG($this->condicionales[$i]["texto_svg"]);
		//definir si existen otros tipos de condicional o solo se tiene en cuenta el condicional exclusivo
		if($this->condicionales[$i]["tipo_condicional"]=="exclusivegateway"){
		  $this->texto_estados.='bpmn.annotation("'.$this->condicionales[$i]["idcondicional"].'").addClasses(["habilitado","exclusivegateway"]);';
			//$this->validar_estado_condicional($this->condicionales[$i]);
		}
	}
}
public function validar_estado_condicional($condicional){
	$exito=0;
	$this->tareas_siguientes=array("numcampos"=>0);
  $condicional_si=array();
  $condicional_no=array();
  $this->excluir_condicional=array();
  $incluir_condicional=array();
	$this->tarea_siguiente($condicional,"bpmn_condicional","paso_condicional");
  // Aqui se deben validar las condicionales para ingresar a la lista de tareas siguientes iniciadas
	if($this->tareas_siguientes["numcampos"]){
		for($i=0;$i<$this->tareas_siguientes["numcampos"];$i++){
			if(in_array($this->tareas_siguientes[$i]["idpaso"],$this->tareas_exito)){
				$eliminar_iniciadas=1;
			}
		}
		if($eliminar_iniciadas){
			$this->desactivar_tareas($this->tareas_siguientes,$this->tareas_iniciadas);
		}
    else{
      //Entra si estan iniciadas todas las tareas siguientes y se deben filtrar por medio de los condicionales
      $condicional_admin=busca_filtro_tabla("","paso_condicional_admin A","A.fk_paso_condicional=".$condicional["idpaso_condicional"],"",$conn);
      if($condicional_admin["numcampos"] && $this->bpmni->idbpmni){
        //Buscar todos los documentos que se han ejecutado y no estan devueltos o cancelados, para validar los campos y formatos e identificar si se deben habilitar las tareaas o no de los pasos siguientes
        for($i=0;$i<$condicional_admin["numcampos"];$i++){
          $tareas=busca_filtro_tabla("A.*,B.*,C.*,D.nombre_tabla","paso_documento A, paso_actividad B, campos_formato C, formato D","B.estado=1 AND C.formato_idformato=D.idformato AND A.paso_idpaso=B.paso_idpaso AND A.diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND A.estado_paso_documento NOT IN(3,7,0) AND B.formato_idformato=C.formato_idformato AND C.idcampos_formato=".$condicional_admin[$i]["fk_campos_formato"],"",$conn);
          if($tareas["numcampos"]){
            $tabla=busca_filtro_tabla($tareas[0]["nombre"],$tareas[0]["nombre_tabla"],"documento_iddocumento=".$tareas[0]["documento_iddocumento"],"",$conn);
            if($tabla["numcampos"]){
              $evaluacion=eval("return(".$tabla[0][$tareas[0]["nombre"]].$condicional_admin[$i]["comparacion"].$condicional_admin[$i]["valor"].");");
              if($evaluacion){
                $pasos_incluir=busca_filtro_tabla("","paso","idpaso IN(".$condicional_admin[$i]["habilitar_pasos_si"].")","",$conn);
                for($j=0;$j<$pasos_incluir["numcampos"];$j++){
                  array_push($incluir_condicional,$pasos_incluir[$j]["idpaso"]);
                }
              }
              else{
                $pasos_incluir=busca_filtro_tabla("","paso","idpaso IN(".$condicional_admin[$i]["habilitar_pasos_no"].")","",$conn);
                for($j=0;$j<$pasos_incluir["numcampos"];$j++){
                  array_push($incluir_condicional,$pasos_incluir[$j]["idpaso"]);
                }
              }
            }
          }
        }
        if(count($incluir_condicional)){
          $incluir_condicional=array_unique($incluir_condicional);
          for($i=0;$i<$this->tareas_siguientes["numcampos"];$i++){
            if(!in_array($this->tareas_siguientes[$i]["idpaso"],$incluir_condicional)){
              array_push($this->excluir_condicional,$this->tareas_siguientes[$i]["idpaso"]);
            }
          }
          $this->desactivar_tareas($this->tareas_siguientes,$this->excluir_condicional);
        }
      }
    }
	}
}
//tipo define si incluye o excluye para tipo =1 dehabilita idfigura, si tipo =2 deshabilita todo excepto los que llegan en excluir
public function desactivar_tareas($listado,$excluir,$tipo=1){
	for($i=0;$i<$listado["numcampos"];$i++){
		if(in_array($listado[$i]["idpaso"],$excluir)){
			$this->texto_estados.='bpmn.annotation("'.$listado[$i]["idsvg"].'").removeClasses(["habilitado","task_iniciada","task_error"]);';
      //TODO: Aqui se excluyen los pasos en la base de datos, verificar que el estado_paso_documento=0 no afecte con el funcionamiento regular del flujo  
      $sql2="UPDATE paso_documento SET estado_paso_documento=0 WHERE diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND paso_idpaso=".$listado[$i]["idpaso"];
      phpmkr_query($sql2);
		}
	}
}
public function dibuja_enlaces(){
	$archivo=$this->load_file_bpmn("archivo_bpmn");
	$this->archivo=$archivo[0]["ruta"];
	/*for($i=0;$i<$this->enlaces["numcampos"];$i++){
	 $this->adicionar_texto_SVG($this->enlaces[$i]["texto_svg"]);
	}*/
}
public function cargar_bpmn_saia(){
	global $ruta_db_superior;
	//TODO:Vincular el proceso en la base de datos con el idproceso
	//TODO:Validar que el archivo existe y otras validaciones con el archivo
	$archivo=$this->load_file_bpmn("archivo_bpmn");
	$this->archivo=$archivo[0]["ruta"];
	$this->dom->load($ruta_db_superior.$this->archivo);
	$this->get_formas();
	$this->get_enlaces();
}
public function get_formas(){
	$this->formas=$this->dom->getElementsByTagName("BPMNShape");
	foreach($this->formas AS $forma){
		$id = $forma->getAttribute("bpmnElement");
		$bounds=$forma->getElementsByTagName("Bounds");
		$i=0;
		foreach($bounds AS $bound){
			if($i==0){
				$x=$bound->getAttribute("x");
				$y=$bound->getAttribute("y");
				$alto=$bound->getAttribute("height");
				$ancho=$bound->getAttribute("width");
				$this->generar_forma_svg($id,$x,$y,$ancho,$alto);
			}
			$i++;
		}
	}
}
public function get_enlaces(){
	$this->enlaces=$this->dom->getElementsByTagName("BPMNEdge");
	$del_pe="DELETE FROM paso_enlace WHERE diagram_iddiagram=".$this->idbpmn;
	phpmkr_query($del_pe);
	foreach($this->enlaces AS $forma){
		$id = $forma->getAttribute("bpmnElement");
		$camino=$forma->getElementsByTagName("id:waypoint");
		$puntos=array();
		foreach($camino AS $punto){
			array_push($puntos,array("type"=>"L","x"=>$punto->getAttribute("x"),"y"=>$punto->getAttribute("y")));
		}
		$this->generar_enlace_svg($id,$puntos);
	}
}
public function generar_forma_svg($id,$x,$y,$ancho,$alto){
	$buscar = new DOMXPath($this->dom);
	$dato=$this->get_objeto_svg($id);
	$tagName=str_replace("bpmn:", "", $dato->item(0)->tagName);
	$tagName=str_replace("bpmn2:", "", $tagName);
	$elemento=strtolower($tagName);
	$this->texto_estados.='bpmn.annotation("'.$id.'").addClasses(["'.$elemento.'"]);';
	if($this->tipo_vista_bpmn==1){
		$this->texto_estados.='bpmn.annotation("'.$id.'").addClasses(["habilitado"]);';
	}
	$nombre=$dato->item(0)->getAttribute("name");
	//TODO: Definir los demas elementos
	switch($elemento){
		case "task":
			//TODO: Definir color de las tareas debe enviarse una cadena separada por comas con el RGB del color que se requiere  y cambiar el icono del cuadro
			$this->generar_tarea($nombre,"manualtask",$id,$x,$y,$ancho,$alto);
			break;
		case "manualtask":
			//TODO: Definir color de las tareas debe enviarse una cadena separada por comas con el RGB del color que se requiere y cambiar el icono del cuadro
			$this->generar_tarea($nombre,$elemento,$id,$x,$y,$ancho,$alto);
			break;
		case "usertask":
			//TODO: Definir color de las tareas debe enviarse una cadena separada por comas con el RGB del color que se requiere y cambiar el icono del cuadro
			$this->generar_tarea($nombre,$elemento,$id,$x,$y,$ancho,$alto);
			break;
		case "endevent":
			//Sacado desde activity
			$this->fin_proceso($id,$x+($ancho/2),$y+($ancho/2),$ancho-15);
			break;
		case "intermediatethrowevent":
			//Sacado desde bpmn.io
			$this->fin_proceso($id,$x+($ancho/2),$y+($ancho/2),$ancho-15);
			break;
		case "startevent":
			$this->inicio_proceso($id,$x+($ancho/2),$y+($ancho/2),$ancho-15);
			break;
		case "exclusivegateway":
			$this->condicion_exclusiva($elemento,$id,$x,$y,$ancho,$alto);
			break;
		default:
			$this->generar_tarea($elemento."???",$elemento,$id,$x,$y,$ancho,$alto);
			break;
	}
}
public function fin_proceso($id,$x,$y,$radio){
	global $ruta_db_superior;
	include_once($ruta_db_superior."pantallas/lib/svg/class_circulo.php");
	$circulo = new svgCircle(floatval($radio));
	$circulo->setX(floatval($x));
	$circulo->setY(floatval($y));
	$circulo->addAttr("tipo_tarea","endevent");
	$circulo->addClass("endevent habilitado");
	$circulo->addId($id);
	$this->asignar_evento_proceso($id,$circulo,"endevent");
}
public function inicio_proceso($id,$x,$y,$radio){
	global $ruta_db_superior;
	include_once($ruta_db_superior."pantallas/lib/svg/class_circulo.php");
	$circulo = new svgCircle(floatval($radio));
	$circulo->setX(floatval($x));
	$circulo->setY(floatval($y));
	$circulo->addId($id);
	$circulo->addAttr("tipo_tarea","startevent");
	$circulo->addClass("startevent habilitado");
	$this->asignar_evento_proceso($id,$circulo,"startevent");
}
public function generar_tarea($texto,$elemento,$id,$x,$y,$ancho,$alto,$ffamily=null,$fstyle=null, $fweight=null,$fsize=12){
	global $ruta_db_superior;
	include_once($ruta_db_superior."pantallas/lib/svg/class_cuadro_texto.php");
	include_once($ruta_db_superior."pantallas/lib/svg/class_imagen.php");
	//echo("Elemento:".$elemento."-->".$id);
	$tarea = new svgTextBox($texto, floatval($ancho), floatval($alto));
	$tarea->setX(floatval($x));
	$tarea->setY(floatval($y));
	$tarea->text->setFont($ffamily,$fstyle,$fweight,$fsize);
	$tarea->box->addAttr("tipo_tarea",$elemento);
	$tarea->box->addClass("tarea");
	$tarea->box->addId($id);
	$tarea->box->roundBorder(10,10);
	//$tarea->xml='<g onmousedown="mouseDown(evt)" onmousemove="move(evt)" onmouseup="endMove(evt)" onmouseout="endMove(evt)">'.$tarea->getXML().$this->imagen_svg($x+10,$y+10,$id,$elemento)."</g>";
	$tarea->xml='<g>'.$tarea->getXML().$this->imagen_svg($x+10,$y+10,$id,$elemento)."</g>";
	$this->asignar_tarea_proceso($id,$elemento,$tarea);
	$tarea->box->addClass("habilitado");
	$this->adicionar_texto_SVG("<g>".$tarea->getXML().$this->imagen_svg($x+10,$y+10,$id,$elemento)."</g>");
}
public function imagen_svg($x,$y,$id,$elemento){
	$icono=new svgImage(14,14,$this->ruta_icono_bpmn($elemento));
	$icono->setX(floatval($x));
	$icono->setY(floatval($y));
	$icono->addClass($elemento);
	$icono->addId($id);
	$this->adicionar_texto_SVG($icono->getXML());
	return($icono->getXML());
}
public function ruta_icono_bpmn($elemento){
	global $ruta_db_superior;
	$ruta=array();
	switch($elemento){
		case "task":
			$ruta=PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/accept.png";
			break;
		case "manualtask":
			$ruta=PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/accept.png";
			break;
		case "usertask":
			$ruta=PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/delete.gif";
			break;
		case "exclusivegateway":
			$ruta=PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/delete.gif";
			break;
	}
	return($ruta);
}
public function generar_enlace_svg($id,$puntos){
	global $ruta_db_superior;
	include_once($ruta_db_superior."pantallas/lib/svg/class_enlace.php");
	$enlace=new svgPath();
	$enlace->setPoints($puntos);
	$dato=$this->get_objeto_svg($id);
	$origen=$dato->item(0)->getAttribute("sourceRef");
	$destino=$dato->item(0)->getAttribute("targetRef");
	$this->asignar_enlace_proceso($id,$enlace,$origen,$destino);
}
public function condicion_exclusiva($elemento,$id,$x,$y,$ancho,$alto){
	global $ruta_db_superior;
	include_once($ruta_db_superior."pantallas/lib/svg/class_cuadro_texto.php");
	//echo("Elemento:".$elemento."-->".$id);
	$condicional = new svgRectangle( floatval($ancho), floatval($alto));
	$condicional->setX(0);
	$condicional->setY(0);
	$condicional->addAttr("tipo_tarea",$elemento);
	$condicional->addId($id);
	//if($this->tipo_vista_bpmn==1){
		$condicional->addClass("habilitado");
	//}
	//angulo de rotacion para el rombo
	$rotar=45;
	//$rx,$ry es la posicion sobre la que se debe rotar la fgura
	$condicional->rotate($rotar,$ancho/2,$alto/2);
	$condicional->translate($x,$y);
	$condicional->xml=$condicional->getXML().$this->imagen_svg($x+($ancho/3),$y+($alto/3),$id,$elemento);
	$this->asignar_condicional_proceso($id,$condicional,"exclusivegateway");

}
public function get_condicional_proceso($id){
	$condicional=busca_filtro_tabla("","paso_condicional A","A.diagram_iddiagram=".$this->idbpmn." AND idcondicional='".$id."'","",$conn);
	return($condicional);
}
public function asignar_condicional_proceso($id,$objeto_svg,$tipo_condicional){
	global $ruta_db_superior;
	$condicional=$this->get_condicional_proceso($id);
	if($condicional["numcampos"]){
		// Se debe actualizar la condicional del bpmn
		$datos["idcondicional"]=$id;
		$datos["diagram_iddiagram"]=$this->idbpmn;
		$datos["tipo_condicional"]=$tipo_condicional;
		$arreglo_update=array();;
		$sql_update="UPDATE paso_condicional SET ";
		foreach($datos AS $key=>$valor){
			array_push($arreglo_update,$key."='".$valor."'");
		}
		$sql_update.=implode(", ",$arreglo_update);
		$sql_update.=" WHERE idpaso_condicional=".$condicional[0]["idpaso_condicional"];
		phpmkr_query($sql_update);
		//retorna el listado de acciones (funciones ejecutables relacionadas con la accion)
		//las acciones se deben guardar en una tabla adicional y estan definidas por el estado_ejecucion=administracion,ejecucion y debe tener un estado que defina si esta activo o inactivo
		$estado="administracion";
		//$bpmn_evento->ejecutar_acciones_bpmn_tarea($estado);
	}
	else{
		//adicionar inicio de proceso BPMN
		$datos=array();
		$datos["idcondicional"]=$id;
		$datos["diagram_iddiagram"]=$this->idbpmn;
		$datos["tipo_condicional"]=$tipo_condicional;
		$sql_insert="INSERT INTO paso_condicional(".implode(",",array_keys($datos)).") VALUES ('".implode("','",array_values($datos))."')";
		phpmkr_query($sql_insert);
	}
	//$this->adicionar_texto_SVG($objeto_svg->xml);
}
public function adicionar_texto_SVG($texto){
	$this->texto_svg.= $texto;
}
public function imprimir_SVG(){
	$this->canvas->setXML($this->texto_svg);
	echo $this->canvas->getXML();
}
public function verificar_bpmn($idbpmni,$idpaso_documento){
	global $ruta_db_superior,$conn;
	if(@$this->tipo_vista_bpmn==1 || @$_REQUEST["vista_bpmn"]==1){
		$this->tipo_vista_bpmn=$_REQUEST["vista_bpmn"];
		return;
	}
	$this->bpmni->get_bpmni($idbpmni);
	if(!$this->bpmni->existe_bpmni() && $this->idbpmn){
		die("No existe BPMN instanciado");
	}
	if($this->existe_bpmn() && $this->bpmni->existe_bpmni()){
		//estado 1,Ejecutado;2,Cerrado,3,Cancelado;4,Pendiente;5,Atrasado;6,Iniciado;7,devuelto
		//TODO: Verificar los demas estados se debe validar con el funcionamiento actual aqui debe crear un arreglo para cada estado
		$tareas=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND estado_paso_documento=4","",$conn);
		$this->tareas_iniciadas=extrae_campo($tareas,"paso_idpaso");
		$tareas=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND (estado_paso_documento=1 OR estado_paso_documento=2)","",$conn);
		$this->tareas_exito=extrae_campo($tareas,"paso_idpaso");
		$tareas=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND estado_paso_documento=7","",$conn);
		$this->tareas_devueltas=extrae_campo($tareas,"paso_idpaso");
		$tareas=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND estado_paso_documento=3","",$conn);
		$this->tareas_anuladas=extrae_campo($tareas,"paso_idpaso");
    $tareas=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$this->bpmni->idbpmni." AND estado_paso_documento=5","",$conn);
    $this->tareas_atrasadas=extrae_campo($tareas,"paso_idpaso");
		$this->tareas_activas=array_merge((array)$this->tareas_exito,(array)$this->tareas_devueltas,(array)$this->tareas_anuladas,(array)$this->tareas_iniciadas,(array)$this->tareas_atrasadas);
	}
	else{
		die("Error en el BPMN seleccionado");
	}
}
public function validar_inicio_bpmn(){
	$inicio=$this->get_tarea_inicio();
	if($inicio["numcampos"]){
		$sql2="UPDATE bpmn_tarea SET inicia_bpmn=1 WHERE idbpmn_tarea=".$inicio[0]["idbpmn_tarea"];
		phpmkr_query($sql2);
	}
}
public function delete_inicio_proceso(){

}
public function asignar_evento_proceso($id,$objeto_svg,$tipo_evento){
	if($tipo_evento=="startevent"){
		$inicio=$this->get_inicio_proceso();
		if($inicio["numcampos"]==1){
			// Se debe actualizar el inicio del bpmn
			$datos["idevento"]=$id;
			$datos["diagram_iddiagram"]=$this->idbpmn;
			//$datos["texto_svg"]=''; //$objeto_svg->getXML();
			$datos["tipo_evento"]=$tipo_evento;
			$arreglo_update=array();;
			$sql_update="UPDATE paso_evento SET ";
			foreach($datos AS $key=>$valor){
				array_push($arreglo_update,$key."='".$valor."'");
			}
			$sql_update.=implode(", ",$arreglo_update);
			$sql_update.=" WHERE idpaso_evento=".$inicio[0]["idpaso_evento"];
			phpmkr_query($sql_update);
			/// para cada nodo se adicionan 3 acciones basicas, 1-Accion vacio=No se ha definido accion para el nodo en el bpmn actual. 2-Accion ejecutar=Accion que se debe ejecutar al dar click en el nodo (ejemplo: abrir highslide con opciones, esto solo aplica a la parte administrativa).3-Accion Error=Accion que se ejecuta al generar un error en la cracion del nodo (ejemplo: pintar componente de color rojo, todas las opciones se deben realizar como funciones del sistema y se ejecutar como acciones de pantalla )
			//retorna el listado de acciones (funciones ejecutables relacionadas con la accion)
			//las acciones se deben guardar en una tabla adicional y estan definidas por el estado_ejecucion=administracion,ejecucion y debe tener un estado que defina si esta activo o inactivo
			$estado="administracion";
			//$bpmn_evento->ejecutar_acciones_bpmn_evento($estado);
		}
		else if($inicio["numcampos"]>1){
			//Solo puede existir un inicio por proceso BPMN, reportar error
			$objeto_svg->addClass("error");
		}
		else{
			//adicionar inicio de proceso BPMN
			$datos=array();
			$datos["idevento"]=$id;
			$datos["diagram_iddiagram"]=$this->idbpmn;
			//$datos["texto_svg"]=$objeto_svg->getXML();
			$datos["tipo_evento"]=$tipo_evento;
			$sql_insert="INSERT INTO paso_evento(".implode(",",array_keys($datos)).") VALUES ('".implode("','",array_values($datos))."')";
			phpmkr_query($sql_insert);
		}
	}
	else{
		$final=$this->get_final_proceso($id);
		if($final["numcampos"]){
			// Se debe actualizar cada uno de los finales del bpmn, teniendo en cuenta que se hace un recorrido por cada uno de los items del flujo
			$datos["idevento"]=$id;
			$datos["diagram_iddiagram"]=$this->idbpmn;
			$datos["tipo_evento"]=$tipo_evento;
			$arreglo_update=array();;
			$sql_update="UPDATE paso_evento SET ";
			foreach($datos AS $key=>$valor){
				array_push($arreglo_update,$key."='".$valor."'");
			}
			$sql_update.=implode(", ",$arreglo_update);
			$sql_update.=" WHERE idpaso_evento='".$final[0]["idpaso_evento"];
			phpmkr_query($sql_update);
			/// para cada nodo se adicionan 3 acciones basicas, 1-Accion vacio=No se ha definido accion para el nodo en el bpmn actual. 2-Accion ejecutar=Accion que se debe ejecutar al dar click en el nodo (ejemplo: abrir highslide con opciones, esto solo aplica a la parte administrativa).3-Accion Error=Accion que se ejecuta al generar un error en la cracion del nodo (ejemplo: pintar componente de color rojo, todas las opciones se deben realizar como funciones del sistema y se ejecutar como acciones de pantalla )
			//retorna el listado de acciones (funciones ejecutables relacionadas con la accion)
			//las acciones se deben guardar en una tabla adicional y estan definidas por el estado_ejecucion=administracion,ejecucion y debe tener un estado que defina si esta activo o inactivo
			$estado="administracion";
			//$bpmn_evento->ejecutar_acciones_bpmn_evento($estado);
		}
		else{
			//adicionar inicio de proceso BPMN
			$datos=array();
			$datos["idevento"]=$id;
			$datos["diagram_iddiagram"]=$this->idbpmn;
			$datos["tipo_evento"]=$tipo_evento;
			$sql_insert="INSERT INTO paso_evento(".implode(",",array_keys($datos)).") VALUES ('".implode("','",array_values($datos))."')";
			phpmkr_query($sql_insert);
		}
	}
}
public function get_inicio_proceso(){
	$inicio=busca_filtro_tabla("","paso_evento A","A.diagram_iddiagram=".$this->idbpmn." AND A.tipo_evento='startevent'","",$conn);
	return($inicio);
}
public function get_tarea_inicio(){
	if(!@$this->tarea_inicio["numcampos"]){
		$this->tarea_inicio=busca_filtro_tabla("B.*","paso_enlace A, paso B","A.destino=B.idpaso AND A.origen=-1","",$conn);
	}	
	return($this->tarea_inicio);
}
public function get_tarea_inicio_instancia($bpmni){
	if(!@$this->tarea_inicio_instancia["numcampos"]){
		$this->tarea_inicio_instancia=busca_filtro_tabla("C.*","paso_enlace A, paso B, paso_documento C","A.destino=B.idpaso AND A.origen=-1 AND A.destino=C.paso_idpaso AND diagram_iddiagram_instance=".$bpmni,"",$conn);
	}
	return($this->tarea_inicio_instancia);
}
public function get_final_proceso($id){
	$fin=busca_filtro_tabla("","paso_evento A","A.diagram_iddiagram=".$this->idbpmn." AND idevento='".$id."'","",$conn);
	return($fin);
}
public function asignar_tarea_proceso($id,$elemento,$objeto_svg){
	$tarea=$this->get_tarea_proceso($id);
	if($tarea["numcampos"]){
		// Se debe actualizar la tarea del bpmn
		$datos["idfigura"]=$id;
		$datos["diagram_iddiagram"]=$this->idbpmn;
		$datos["posicion"]='';//$objeto_svg->xml;
		$datos["nombre_paso"]=trim($objeto_svg->getText());
		$datos["descripcion"]='';
		$datos["responsable"]=usuario_actual("idfuncionario");
		$datos["estado"]=1;
		$arreglo_update=array();;
		$sql_update="UPDATE paso SET ";
		foreach($datos AS $key=>$valor){
			array_push($arreglo_update,$key."='".$valor."'");
		}
		$sql_update.=implode(", ",$arreglo_update);
		$sql_update.=" WHERE idpaso=".$tarea[0]["idpaso"];
		phpmkr_query($sql_update);
		//retorna el listado de acciones (funciones ejecutables relacionadas con la accion)
		//las acciones se deben guardar en una tabla adicional y estan definidas por el estado_ejecucion=administracion,ejecucion y debe tener un estado que defina si esta activo o inactivo
		$estado="administracion";
		//$bpmn_evento->ejecutar_acciones_bpmn_tarea($estado);
	}
	else{
		//adicionar inicio de proceso BPMN
		$datos=array();
		$datos["descripcion"]='';
		$datos["idfigura"]=$id;
		$datos["diagram_iddiagram"]=$this->idbpmn;
		$datos["posicion"]='';//$objeto_svg->xml;
		$datos["nombre_paso"]=trim($objeto_svg->getText());
		$datos["descripcion"]='';
		$datos["responsable"]=usuario_actual("idfuncionario");
		$datos["estado"]=1;
		$sql_insert="INSERT INTO paso(".implode(",",array_keys($datos)).") VALUES ('".implode("','",array_values($datos))."')";
		phpmkr_query($sql_insert);
	}
}
public function get_tarea_proceso($id){
	$tarea=busca_filtro_tabla("","paso A","A.diagram_iddiagram=".$this->idbpmn." AND A.idfigura='".$id."'","",$conn);
	return($tarea);
}
public function asignar_enlace_proceso($id,$objeto_svg,$origen,$destino){
			
		//adicionar inicio de proceso BPMN
		$datos=array();
		$datos["idconector"]=$id;
		$datos["diagram_iddiagram"]=$this->idbpmn;
		//$datos["texto_svg"]=''; //$objeto_svg->getXML();
		$origen_svg=$this->get_objeto_svg($origen);
		$destino_svg=$this->get_objeto_svg($destino);
		$cad_orig=str_replace("bpmn:","",strtolower($origen_svg->item(0)->tagName));
		$cad_orig=str_replace("bpmn2:","",$cad_orig);
		$cad_destino=str_replace("bpmn:","",strtolower($destino_svg->item(0)->tagName));
		$cad_destino=str_replace("bpmn2:","",$cad_destino);
		$dato_origen=$this->validar_tipo_svg($cad_orig,$origen);
		$dato_destino=$this->validar_tipo_svg($cad_destino,$destino);
		$datos["tipo_origen"]=$dato_origen["tipo"];
		$datos["tipo_destino"]=$dato_destino["tipo"];
		
		if($cad_orig=="startevent"){
			$dato_origen["iddato"]=-1;
		}
		if($cad_destino=="endevent" || $cad_destino=="intermediatethrowevent"){
			$dato_destino["iddato"]=-2;
		}
		$datos["origen"]=$dato_origen["iddato"];
		$datos["destino"]=$dato_destino["iddato"];
		$sql_insert="INSERT INTO paso_enlace(".implode(",",array_keys($datos)).") VALUES ('".implode("','",array_values($datos))."')";
		phpmkr_query($sql_insert);
	
}
public function get_enlace_proceso($id){
	$enlace=busca_filtro_tabla("","paso_enlace A","A.diagram_iddiagram=".$this->idbpmn." AND A.idconector='".$id."'","",$conn);
	return($enlace);
}
public function validar_tipo_svg($elemento,$id){
	$retorno=array();
	switch($elemento){
		case "task":
			$dato=$this->get_tarea_proceso($id);
			$retorno["tipo"]="bpmn_tarea";
			$retorno["iddato"]=$dato[0]["idpaso"];
			break;
		case "manualtask":
			$dato=$this->get_tarea_proceso($id);
			$retorno["tipo"]="bpmn_tarea";
			$retorno["iddato"]=$dato[0]["idpaso"];
			break;
		case "usertask":
			$dato=$this->get_tarea_proceso($id);
			$retorno["tipo"]="bpmn_tarea";
			$retorno["iddato"]=$dato[0]["idpaso"];
			break;
		case "endevent":
			$dato=$this->get_final_proceso($id);
			$retorno["tipo"]="bpmn_evento";
			$retorno["iddato"]=$dato[0]["idpaso_evento"];
			break;
		case "intermediatethrowevent":
			$dato=$this->get_final_proceso($id);
			$retorno["tipo"]="bpmn_evento";
			$retorno["iddato"]=$dato[0]["idpaso_evento"];
			break;
		case "startevent":
			$dato=$this->get_inicio_proceso();
			$retorno["tipo"]="bpmn_evento";
			$retorno["iddato"]=$dato[0]["idpaso_evento"];
			break;
		case "exclusivegateway":
			$dato=$this->get_condicional_proceso($id);
			$retorno["tipo"]="bpmn_condicional";
			$retorno["iddato"]=$dato[0]["idpaso_condicional"];
			break;
		default:
			$retorno["tipo"]="";
			$retorno["iddato"]=0;
			break;
	}
	return($retorno);
}
public function get_objeto_svg($id){
	$buscar = new DOMXPath($this->dom);
	$dato=$buscar->query("//*[@id='".$id."']");
	return($dato);
}
public function get_tareas_bpmn($forzar=0){
	if(!@$this->tareas["numcampos"] || $forzar){
		$this->tareas=busca_filtro_tabla("","paso","diagram_iddiagram=".$this->idbpmn,"",$conn);
	}
}
public function get_eventos_bpmn($forzar=0){
	if(!@$this->eventos["numcampos"] || $forzar){
		$this->eventos=busca_filtro_tabla("","paso_evento","diagram_iddiagram=".$this->idbpmn,"",$conn);
	}
}

public function get_condicionales_bpmn($forzar=0){
	if(!@$this->condicionales["numcampos"] || $forzar){
		$this->condicionales=busca_filtro_tabla("","paso_condicional","diagram_iddiagram=".$this->idbpmn,"",$conn);
	}
}
public function get_enlaces_bpmn($forzar=0){
	if(!@$this->enlaces["numcampos"] || $forzar){
		$this->enlaces=busca_filtro_tabla("","paso_enlace","diagram_iddiagram=".$this->idbpmn,"",$conn);
	}
}
public function instanciar_bpmn(){
	//Debe hacer un recorrido por todos los objetos para instanciarlos de forma individual
	for($i=0;$i<$this->tareas["numcampos"];$i++){
		if($this->tareas[$i]["tipo"]=="manualtask"){
			$tarea=new tarea_manual();
			$tarea->get_from_tarea($tarea);
		}
	}
}
//TODO: Adicionar una funcion que adicione todas las tareas manuales
} 
?>