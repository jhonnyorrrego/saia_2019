<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/anexos/librerias_anexos.php");
error_reporting(E_ALL | E_STRICT);
$tipo =  explode('/', $_FILES['files']['type'][0]);
if(@$_REQUEST["idtareas_listado"] || @$_REQUEST['listado_tareas_fk']){
	
	
	if(@$_REQUEST["idtareas_listado"]){
		$ruta = RUTA_ANEXOS_TAREAS.@$_REQUEST['listado_tareas_fk'].'/'.@$_REQUEST['idtareas_listado'].'/';
		$idtareas_listado=@$_REQUEST['idtareas_listado'];
	}else{
		$ruta_temp = (rand());
		$ruta = RUTA_ANEXOS_TAREAS.'temporal_tareas/'.@$_REQUEST['listado_tareas_fk'].'/t_'.@$ruta_temp.'/';
		$idtareas_listado=$ruta_temp;
	}
	
	$configuracion = busca_filtro_tabla("valor,nombre","configuracion","nombre LIKE 'extensiones_upload' OR nombre LIKE 'tamanio_maximo_upload'","",$conn);
	
	$extenciones='';
	$max_tamanio='';
	if($configuracion['numcampos']){
		for($i=0; $i < $configuracion['numcampos']; $i++){
			switch ($configuracion[$i]['nombre']) {
				case 'extensiones_upload':
					$extenciones = str_replace(',','|',$configuracion[$i]['valor']);
					break;
				case 'tamanio_maximo_upload':
					$max_tamanio = $configuracion[$i]['valor'];
					break;
			}
		}		
	}
	$options = array('upload_dir'=> $ruta_db_superior.$ruta,
			'upload_url'=> $ruta_db_superior.$ruta,
			'accept_file_types' => '/\.('.$extenciones.')$/i',
			'max_file_size' => $max_tamanio
	);
  	crear_destino($ruta_db_superior.$ruta);
	$upload_handler = new UploadHandler($options);
	$files = $upload_handler->get_resultado_carga(1);
	foreach ($files->files as $key => $value){
		if(!isset($value->error)){
			
			
			
			$tipo =  explode('.', $_FILES['files']['name'][0]);
			$cant=count($tipo);
			if($cant)
				$type=$tipo[($cant-1)];
			else{
				$type=$tipo[1];
			}
			$nombre = (rand());
			
			rename($ruta_db_superior.$ruta."/".$_FILES['files']['name'][0], $ruta_db_superior.$ruta."/".$nombre.'.'.$type);
			chmod($ruta_db_superior.$ruta,0777);
			chmod($ruta_db_superior.$ruta."/".$nombre.'.'.$type,0777);
			
			$sql2 = "INSERT INTO tareas_listado_anexos
 (etiqueta,ruta,tipo,fk_tareas_listado,fecha_hora,funcionario_idfuncionario) values('".$_FILES['files']['name'][0]."','".$ruta.$nombre.'.'.$type."','".$type."','".$idtareas_listado."','".date('Y-m-d H:i:s')."','".usuario_actual('idfuncionario')."')";
			phpmkr_query($sql2);
			
			if(file_exists($ruta_db_superior.$ruta."/".$nombre.'.'.$type)){
                    $ruta_anexo=$ruta_db_superior.$ruta."/".$nombre.'.'.$type;
                    $fecha_actual=date("Y-m-d H:i");
        		    $responsable=busca_filtro_tabla("co_participantes,seguidores,responsable_tarea,nombre_tarea,evaluador","tareas_listado t","t.idtareas_listado=".$_REQUEST['idtareas_listado'],"",$conn);
        			if($responsable["numcampos"]){
        				
        				$funcionarios_enviar=$responsable[0]['responsable_tarea'].','.$responsable[0]['co_participantes'].','.$responsable[0]['seguidores'].','.$responsable[0]['evaluador'];
        				
        				$valor=explode(',',$funcionarios_enviar);
        				$longitud=count($valor);
        				for($i=0;$i<$longitud;$i++){
        					if($valor[$i]==''){
        						unset($valor[$i]); 
        					}
        				}
        				$valor=array_values($valor);
        				$valor=implode(',',$valor);
        				$funcionarios_enviar=$valor;
        				$funcionarios=busca_filtro_tabla("funcionario_codigo","funcionario f","idfuncionario in(".$funcionarios_enviar.") and estado=1","",$conn);
        				if($funcionarios["numcampos"]){
        					$funcionarios_enviar='';
        					for($i=0;$i<$funcionarios["numcampos"];$i++){
        						
        						if($i+1==$funcionarios["numcampos"]){
        							$funcionarios_enviar.=$funcionarios[$i]['funcionario_codigo'];
        						}else{
        							$funcionarios_enviar.=$funcionarios[$i]['funcionario_codigo'].',';
        						}	
        					}
        					
        					$funcionarios_enviar_vector=explode(',',$funcionarios_enviar);
        					
        			        $parametro="?".base64_encode("idtareas_listado_unico=".$_REQUEST['idtareas_listado']); 
        		        	$ruta=PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/index.php";
        			        $link="<a href='".$ruta.$parametro."' target='_blank'>Ver Tarea</a>";
        					
        					$mensaje="Saludos,<br/><br/>Se ha adicionado un anexo a la tarea <strong>".$responsable[0]["nombre_tarea"]."</strong><br/><br/>
        					Fecha: ".$fecha_actual."<br/>
        					<br/>".$link;
        					enviar_mensaje("","codigo",$funcionarios_enviar_vector,"Nuevo Anexo",$mensaje,array($ruta_anexo));
        				} //fin if funcionario numcampos        				
        				
        			}	//fin if responsable numcampos
			    				    
			} //fin if file_exists
			
			if(! @$_REQUEST["idtareas_listado"]){
				$idanexo=phpmkr_insert_id();
				
				if(isset($_SESSION['idanexo_tareas'])){
					$_SESSION['idanexo_tareas']=$_SESSION['idanexo_tareas'].','.$idanexo;
				}else{
					$_SESSION['idanexo_tareas']=$idanexo;
				}
				
			}
			
		}
	}
}
?>