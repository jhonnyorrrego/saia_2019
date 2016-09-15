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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");

if(@$_REQUEST['accion']=='despacho_documento' && @$_REQUEST['iddocs']){


function terminar_actividad_despacho($idactividad,$iddocumento,$idpaso_documento){
		
	
	$_REQUEST["idactividad"]=$idactividad;
	$_REQUEST["iddocumento"]=$iddocumento;
	$_REQUEST["idpaso_documento"]=$idpaso_documento;
	
  $verificar=verificar_instancia_terminada($_REQUEST["idactividad"],$_REQUEST["iddocumento"],$_SESSION["usuario_actual"],2);
  if($verificar["numcampos"]){
    return 1;
    //$retorno->idterminacion=$verificar[0]["idpaso_instancia"];
    //$retorno->mensaje='La actividad ya se encuentra terminada';
  }else{
  	
    $terminacion=terminar_actividad_paso($_REQUEST["iddocumento"],'',2,$_REQUEST["idpaso_documento"],$_REQUEST["idactividad"]);
	
    if($terminacion){  
    	
      $idterminacion_manual=terminar_actividad_manual($_REQUEST["idpaso_documento"],$terminacion,'Confirmaci&oacute; recibida a satisfaci&oacute;n');
      if($idterminacion_manual){
        return 1;
        //$retorno->idterminacion=$terminacion;
        //$retorno->mensaje='Actividad terminada de forma exitosa';
      }
      else{
      	return 0;
        //$retorno->mensaje='Error al terminar la actividad de forma manual';
      }    
    } 
  }	
	
	
}
	
	
	$iddocs=explode(',',$_REQUEST['iddocs']);
	
	for( $i=0; $i<count($iddocs); $i++ ){
		$paso_documento=busca_filtro_tabla("diagram_iddiagram","paso_documento a, diagram_instance b","a.diagram_iddiagram_instance=b.iddiagram_instance AND a.documento_iddocumento=".$iddocs[$i],"",$conn);
		$paso_actividad=busca_filtro_tabla("","paso a,paso_actividad b","b.estado=1 AND a.idpaso=b.paso_idpaso AND b.descripcion like'Confirmacion de recibido' AND a.diagram_iddiagram=".$paso_documento[0]['diagram_iddiagram'],"",$conn);
		
		if($paso_actividad['numcampos']){
			$paso_anterior=paso_anterior($paso_actividad[0]['paso_idpaso'],$paso_actividad[0]['diagram_iddiagram'],$iddocs[$i]);
			
			$paso_documento_anterior=busca_filtro_tabla("","paso_documento a, diagram_instance b","a.diagram_iddiagram_instance=b.iddiagram_instance AND paso_idpaso=".$paso_anterior." AND  a.documento_iddocumento=".$iddocs[$i],"",$conn);

			if($paso_documento_anterior[0]['estado_paso_documento']==2){
				
				$idpaso_documento_terminar=busca_filtro_tabla("","paso_documento","estado_paso_documento=4 AND documento_iddocumento=".$iddocs[$i]." AND paso_idpaso=".$paso_actividad[0]['paso_idpaso'],"",$conn);
				
				if($idpaso_documento_terminar['numcampos']){
					$ok=terminar_actividad_despacho($paso_actividad[0]['idpaso_actividad'],$iddocs[$i],$idpaso_documento_terminar[0]['idpaso_documento']);
					
				}
			}
		}
	}
		
	
}


?>