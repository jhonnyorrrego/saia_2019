<?php
  $max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } ?>
<?php 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."bpmn/bpmn_tarea_usuario/class_bpmn_tarea_usuario.php");
if(@$_REQUEST["idbpmn"] && @$_REQUEST["idsvg"]){
  $dato_tarea=busca_filtro_tabla("","bpmn_tarea B","B.idsvg='".$_REQUEST["idsvg"]."' AND B.fk_idbpmn=".$_REQUEST["idbpmn"],"",$conn);
  if($dato_tarea["numcampos"]){
    $bpmn_tarea_usuario=new bpmn_tarea_usuario();
    $bpmn_tarea_usuario->get_from_tarea($dato_tarea[0]["idbpmn_tarea"]);
    if(!$bpmn_tarea_usuario->existe_bpmn_tarea_usuario()){
      die("AQUI");
      //insertar los datos de la tabla bpmn_tarea_usuario
      $datos=array();
      $datos["fk_idbpmn_tarea"]=$dato_tarea[0]["idbpmn_tarea"];
      //Nombre por defecto de la pantalla que se define para la terminacion de las tareas manuales y la accion_terminar es exito
      $pantalla_manual=busca_filtro_tabla("","pantalla","nombre='bpmn_tarea_manual'","",$conn);
      $datos["fk_idpantalla"]=$pantalla_manual[0]["idpantalla"];
      $datos["accion_terminar"]='enviar_exito';
      $bpmn_tarea_usuario->set_bpmn_tarea_usuario(0,"json",json_encode($datos));
    } 
    //si no inserta debe sacar un error
    //redirecciona($ruta_db_superior."bpmn/bpmn_tarea_manual/adicionar_bpmn_tarea_manual.php?idbpmn=".$_REQUEST["idbpmn"]."&idbpmn_tarea=".$dato[0]["idbpmn_tarea"]."&vista_bpmn=".$_REQUEST["vista_bpmn"]);
  }
  if($bpmn_tarea_usuario->existe_bpmn_tarea_usuario()){
    if($_REQUEST["vista_bpmn"]==1){
      redirecciona($ruta_db_superior."bpmn/bpmn_tarea_usuario/mostrar_bpmn_tarea_usuario.php?idbpmn_tarea_usuario=".$bpmn_tarea_usuario->idbpmn_tarea_usuario);
    }
    else{
      $dato=busca_filtro_tabla("C.nombre AS nombre_pantalla, C.ruta_pantalla","pantalla C","C.idpantalla=".$bpmn_tarea_usuario->get_valor_bpmn_tarea_usuario("bpmn_tarea_usuario","fk_idpantalla"),"",$conn);
			$instancia_bpmni=''; 
			if(@$_REQUEST["idbpmni"]){
				$instancia_bpmni='&bpmni='.$_REQUEST["idbpmni"];
			}
      redirecciona($ruta_db_superior.$dato[0]["ruta_pantalla"]."/".$dato[0]["nombre_pantalla"]."/adicionar_".$dato[0]["nombre_pantalla"].".php?idbpmn=".$_REQUEST["idbpmn"]."&idbpmn_tarea=".$bpmn_tarea_usuario->get_valor_bpmn_tarea_usuario("bpmn_tarea_usuario","fk_idbpmn_tarea").$instancia_bpmni);
    }  
  }
  else{
    echo("Error la tarea no se encuentra creada por favor comuniquese con su administrador");
  }
}
?>