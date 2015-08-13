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

include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");

function tabla_avance($idformato,$iddoc){
	global $conn; 

  $consulta=busca_filtro_tabla("*,".fecha_db_obtener("fecha_solucion","Y")." as ano, "
	.fecha_db_obtener("fecha_solucion","m")." as mes,".fecha_db_obtener("fecha_solucion","Y")." as ano,"
	.fecha_db_obtener("fecha_solucion","d")." as dia,".fecha_db_obtener("fecha_solucion","H")." as hora,"
	.fecha_db_obtener("fecha_solucion","i")." as min","ft_solucion_pqr","documento_iddocumento=".$iddoc,"",$conn);
	//print_r($consulta);
  
  $primera=explode("<p>",$consulta[0]["descripcion"]);
  $segunda=explode("</p>",$primera[1]);
  
  
 $texto="";
 $anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn); 
 $arr=array(); 
 for($j=0;$j<$anexos["numcampos"];$j++){
  $etiqueta=$anexos[$j]['etiqueta'];
   array_push($arr,'<a href="'.$ruta_db_superior.'../../anexosdigitales/parsea_accion_archivo.php?idanexo='.$anexos[$j]["idanexos"].'&accion=descargar">'.html_entity_decode($etiqueta).'</a>');
   }
 $texto.=implode("<br/> ",$arr);
 

  $tabla = '';
  	$tabla.= '<table style="width:100%;font-family:Verdana; font-size:8pt;" border="0px">   <tr>
   <td><b>FECHA:</b>'.$consulta[0]["dia"].'-'.$consulta[0]["mes"].'-'.$consulta[0]["ano"].'</td> 
  	<td><b>HORA:</b>'.$consulta[0]["hora"].':'.$consulta[0]["min"].'</td>
	
  </tr> 
	<tr>
	<td><b>DESCRIPCION</b></td><td>'.$segunda[0].'</td>
</tr>
	<tr>
	<td><b>AVANCE</b></td><td>'.$consulta[0]["estado_avance"].'%</td>
</tr>
		<tr>
	<td><b>ANEXO</b></td><td>'.$texto.'</td>
	</tr>
	</table>
';     
  
  echo($tabla);
}



function validar_valores($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	   if(!$_REQUEST['anterior']){	   	
			$papa_solucion_pqr = busca_filtro_tabla("A.ft_pqr AS idft_pqr,A.estado_avance","ft_solucion_pqr A","A.documento_iddocumento=".$iddoc,"",$conn);
		    $_REQUEST['anterior'] = $iddoc;
	   }else{
   			$papa_solucion_pqr = busca_filtro_tabla("A.idft_pqr","ft_pqr A","A.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
	   }
	
	$avance = busca_filtro_tabla("SUM(B.estado_avance) AS avance, A.documento_iddocumento","ft_pqr A, ft_solucion_pqr B","A.idft_pqr=B.ft_pqr AND A.idft_pqr=".$papa_solucion_pqr[0]['idft_pqr'],"",$conn);	
	
	if($papa_solucion_pqr[0]['estado_avance']){
		$avance[0]['avance']=$avance[0]['avance'] - $papa_solucion_pqr[0]['estado_avance'];
	}

	$avance[0]['avance'] = $avance[0]['avance']+$_REQUEST['estado_avance'];		
	if($avance[0]['avance'] > 100){
		alerta('La suma de los avances no puede ser superior al 100%');
		abrir_url($ruta_db_superior.'formatos/pqr/mostrar_pqr.php?idformato=210&iddoc='.$avance[0]['documento_iddocumento'],'_self');
		die();
	}
}

function cambiar_estado_flujo($idformato, $iddoc){ 
global $conn;	
$paso=5;
$actividad=8;
$papa_solucion_pqr = busca_filtro_tabla("B.ft_pqr, A.documento_iddocumento","ft_pqr A,ft_solucion_pqr B","A.idft_pqr=B.ft_pqr AND B.documento_iddocumento=".$iddoc,"",$conn);
$avance = busca_filtro_tabla("SUM(B.estado_avance) AS avance","ft_pqr A, ft_solucion_pqr B","A.idft_pqr=B.ft_pqr AND B.ft_pqr=".$papa_solucion_pqr[0]['ft_pqr'],"",$conn);	
	if($avance[0]['avance'] == 100){
		$paso_documento=busca_filtro_tabla("","paso_documento","documento_iddocumento=".$papa_solucion_pqr[0]["documento_iddocumento"]." AND paso_idpaso=".$paso,"",$conn);			
		//terminar_actividad_paso($papa_solucion_pqr[0]['documento_iddocumento'],"",2,$paso_documento[0]["idpaso_documento"],$actividad);	
	}    
}

/*function cambiar_estado_flujo($idformato, $iddoc){ 
global $conn;	
$paso=5;
$actividad=8;
$papa_solucion_pqr = busca_filtro_tabla("B.ft_pqr, A.documento_iddocumento","ft_pqr A,ft_solucion_pqr B","A.idft_pqr=B.ft_pqr AND B.documento_iddocumento=".$iddoc,"",$conn);
$avance = busca_filtro_tabla("SUM(B.estado_avance) AS avance","ft_pqr A, ft_solucion_pqr B","A.idft_pqr=B.ft_pqr AND B.ft_pqr=".$papa_solucion_pqr[0]['ft_pqr'],"",$conn);	
if($avance[0]['avance'] == 100){
	$paso_documento=busca_filtro_tabla("","paso_documento","documento_iddocumento=".$papa_solucion_pqr[0]["documento_iddocumento"]." AND paso_idpaso=".$paso,"",$conn);			
	//terminar_actividad_paso($papa_solucion_pqr[0]['documento_iddocumento'],"",2,$paso_documento[0]["idpaso_documento"],$actividad);	
}    
}*/

?>