<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

function mostrar_proponentes($idformato,$iddoc){
	global $conn;	
	$documento=busca_filtro_tabla("proponentes","ft_acta_evaluacion c","c.documento_iddocumento=".$iddoc,"",$conn);
	
	$ejecutor=busca_filtro_tabla("distinct a.nombre","ejecutor a, datos_ejecutor b","a.idejecutor=b.ejecutor_idejecutor and idejecutor in(".$documento[0]["proponentes"].")","",$conn);				
		
	for($i=0;$i<$ejecutor["numcampos"];$i++){
		echo $ejecutor[$i]["nombre"];
		if(($i+1)<$ejecutor["numcampos"]){
			echo "<br>";
		}
	}
}


function proponentes_informacio($idformato,$iddoc){
    global $conn,$ruta_db_superior,$conn2;
	if($_REQUEST["iddoc"]){
		$padre=busca_filtro_tabla("ft_solicitud_compra, proponentes","ft_acta_evaluacion a","a.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
		$seleccionados=explode(",",$padre[0]["proponentes"]);
	}
	else{
		$padre[0]["ft_solicitud_compra"]=$_REQUEST["padre"];
	}

  $papas=busca_filtro_tabla("e.idejecutor as id, e.nombre","ft_recepcion_ofertas A, documento B, datos_ejecutor de, ejecutor e","A.ft_solicitud_compra=".$padre[0]["ft_solicitud_compra"]." and A.nombre_empresa=de.iddatos_ejecutor and A.documento_iddocumento=B.iddocumento and B.estado not in('ELIMINADO', 'ANULADO') and de.ejecutor_idejecutor=e.idejecutor","e.nombre ASC",$conn); 

  $opciones="";

	for($i=0;$i<$papas["numcampos"];$i++){
		$checked='';
		if(in_array($papas[$i]["id"],@$seleccionados))$checked='checked';
  			$opciones.='<input type="checkbox" name="proponentes[]" id="proponentes'.$i.'" value="'.$papas[$i]["id"].'" '.$checked.' ';
 		
 		if($i==0)$opciones.=' class="required" ';
  			$opciones.='>'.html_entity_decode($papas[$i]["nombre"]);
  		
  		if(($i+1)<$papas["numcampos"]){
  			$opciones.='<br>';
  		}
}

echo("<td>".$opciones."</td>");
                
}
											
function lista_proponentes($idformato,$iddoc){

	global $conn;
	if($_REQUEST["iddoc"]){
		$padre=busca_filtro_tabla("ft_solicitud_compra, proponente_recomenda","ft_acta_evaluacion a","a.documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);

		$seleccionados=explode(",",$padre[0]["proponente_recomenda"]);
	}
	else{
		$padre[0]["ft_solicitud_compra"]=$_REQUEST["padre"];
	}

  $papas=busca_filtro_tabla("e.idejecutor as id, e.nombre","ft_recepcion_ofertas A, documento B, datos_ejecutor de, ejecutor e","A.ft_solicitud_compra=".$padre[0]["ft_solicitud_compra"]." and A.nombre_empresa=de.iddatos_ejecutor and A.documento_iddocumento=B.iddocumento and B.estado not in('ELIMINADO', 'ANULADO') and de.ejecutor_idejecutor=e.idejecutor","e.nombre ASC",$conn); 

  $opciones='';
  	if(in_array(0,$seleccionados)){	
		$opciones.='<input type="checkbox" name="proponente_recomenda[]" id="proponente_recomenda" value="0" checked>NINGUNO';
  	}else{
  		$opciones.='<input type="checkbox" name="proponente_recomenda[]" id="proponente_recomenda" value="0" >NINGUNO';
  	} 	
	for($i=0;$i<$papas["numcampos"];$i++){
		$checked='';
		if(in_array($papas[$i]["id"],@$seleccionados))$checked='checked';
  			$opciones.='<input type="checkbox" name="proponente_recomenda[]" id="proponente_recomenda'.$i.'" value="'.$papas[$i]["id"].'" '.$checked.' ';
 		
 		if($i==0)$opciones.=' class="required" ';
  			$opciones.='>'.html_entity_decode($papas[$i]["nombre"]);
  		
  		if(($i+1)<$papas["numcampos"]){
  			$opciones.='<br>';
  		}
}

echo("<td>".$opciones."</td>");
}

function mostrar_proponente_recomendado($idformato,$iddoc){
	global $conn;	
	
	$documento=busca_filtro_tabla("proponente_recomenda","ft_acta_evaluacion c","c.documento_iddocumento=".$iddoc,"",$conn);
	
	$ejecutor=busca_filtro_tabla("distinct a.nombre","ejecutor a, datos_ejecutor b","a.idejecutor=b.ejecutor_idejecutor and idejecutor in(".$documento[0]["proponente_recomenda"].")","",$conn);				
	
	if(in_array(0,explode(",",$documento[0]["proponente_recomenda"]))){	
		echo("Ninguno");		
	}	
		
	for($i=0;$i<$ejecutor["numcampos"];$i++){
		echo $ejecutor[$i]["nombre"];
		if(($i+1)<$ejecutor["numcampos"]){
			echo "<br>";
		}
	}
}

?>