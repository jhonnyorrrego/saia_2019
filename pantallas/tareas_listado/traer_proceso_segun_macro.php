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




if(@$_REQUEST['idserie']){


	$procesos=busca_filtro_tabla("idserie,nombre","serie","estado=1 AND cod_padre=".$_REQUEST['idserie'],"",$conn);
	$cadena_procesos=implode(',',extrae_campo($procesos,'idserie'));
	$cadena='<option value="0" selected>Procesos...</option>';
	for($i=0;$i<$procesos['numcampos'];$i++){
		$cadena.='<option value="'.$procesos[$i]['idserie'].'" >'.$procesos[$i]['nombre'].'</option>';
	}

	
	echo(json_encode(array(  'cadena'=>$cadena, 'registros'=>$procesos['numcampos'], 'cadena_procesos'=>$cadena_procesos )));
}else if(@$_REQUEST['macro_proceso']){

	$listado_tareas=busca_filtro_tabla("","listado_tareas a, tareas_listado b","b.generica=0 AND a.idlistado_tareas=b.listado_tareas_fk AND  a.macro_proceso=".$_REQUEST['macro_proceso']." group by a.idlistado_tareas","",$conn);
	$cadena_listado_tareas=implode(',',extrae_campo($listado_tareas,'idlistado_tareas'));
	$cadena='<option value="0" selected>Listados...</option>';
	for($i=0;$i<$listado_tareas['numcampos'];$i++){
		$cadena.='<option value="'.$listado_tareas[$i]['idlistado_tareas'].'" >'.$listado_tareas[$i]['nombre_lista'].'</option>';
	}

	
	echo(json_encode(array(  'cadena'=>$cadena, 'registros'=>$listado_tareas['numcampos'], 'cadena_listado_tareas'=>$cadena_listado_tareas )));

}else{
	echo(json_encode(array(  'cadena'=>'', 'registros'=>'', 'cadena_procesos'=>'' )));
}

?>
