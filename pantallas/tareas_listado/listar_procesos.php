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
include_once($ruta_db_superior."pantallas/lib/encabezado_componente.php");
usuario_actual("login");

$listados=busca_filtro_tabla('','listado_tareas a left join permiso_listado_tareas p on a.idlistado_tareas=p.fk_listado_tareas and p.entidad_identidad=1','a.creador_lista='.usuario_actual("idfuncionario").' or p.llave_entidad='.usuario_actual("idfuncionario").' group by a.idlistado_tareas','',$conn);

$tareas_rapidas=busca_filtro_tabla('','tareas_listado','generica=0 AND listado_tareas_fk=-1 AND creador_tarea='.usuario_actual('idfuncionario'),'',$conn);

/*TAREAS VENCIDAS*/
$fecha=date('Y-m-d');
$fecha_final = strtotime ( "-1 day" , strtotime ( $fecha ) ) ;	
$fecha_validar = date ( 'Y-m-d' , $fecha_final );
$tareas_vencidas=busca_filtro_tabla('','tareas_listado','fecha_limite<>"0000-00-00" AND generica=0 AND listado_tareas_fk<>-1 AND cod_padre=0 AND estado_tarea IN("PENDIENTE","EJECUCION") AND fecha_limite<="'.$fecha_validar.'" AND responsable_tarea='.usuario_actual('idfuncionario'),'',$conn);
/*---------*/

$tareas_terminadas=busca_filtro_tabla('','tareas_listado','generica=0 AND estado_tarea="TERMINADO" AND listado_tareas_fk<>-1 AND cod_padre=0 AND responsable_tarea='.usuario_actual('idfuncionario'),'',$conn);


$tareas_genericas=busca_filtro_tabla('','tareas_listado','generica=1','',$conn);



$rol_tareas='';
if(@$_REQUEST['rol_tareas']){
	$rol_tareas="&rol_tareas=".$_REQUEST['rol_tareas'];
}

$idtareas_listado_unico='';
if(@$_REQUEST['idtareas_listado_unico']){
	$idtareas_listado_unico="&idtareas_listado_unico=".$_REQUEST['idtareas_listado_unico'];
}	 


?>
<div class="panel-body">	
  <div class="block-nav">    
	<?php 
		  
		  //COMPONENTES 
		  $componente_listado_tareas=busca_filtro_tabla("idbusqueda_componente","busqueda_componente","lower(nombre)='listado_tareas_reporte'","",$conn);
		  $componente_tareas_listado=busca_filtro_tabla("idbusqueda_componente","busqueda_componente","lower(nombre)='tareas_listado_reporte'","",$conn);
		  $calendario_responsable=busca_filtro_tabla("idcalendario_saia","calendario_saia","lower(nombre)='calendario_tareas_responsable'","",$conn);
		  
		  /*LISTADOS*/
		  $url=$ruta_db_superior."pantallas/busquedas/consulta_busqueda_listado_tareas.php?idbusqueda_componente=".$componente_listado_tareas[0]['idbusqueda_componente'];
		  $texto='';
		  $texto.='<div id="listados" title="Listados" data-load=\'{"kConnector":"iframe", "url":"'.$url.'", "kTitle":"Listados"}\' class="items navigable">';
		  $texto.='<div class="head"></div>';              				            
		  $texto.='<div class="label"> '.codifica_encabezado(html_entity_decode('Listados')).' &nbsp; <span class="badge">'.$listados['numcampos'].'</span> </div>';
		  $texto.='<div class="info"></div>'; 		
		  $texto.='<div class="tail"></div>';
		  $texto.='</div>'; 
	      echo($texto);			  
		  
		  
		  /*TAREAS*/
		  $url=$ruta_db_superior."pantallas/busquedas/consulta_busqueda_tareas_listado2.php?idbusqueda_componente=".$componente_tareas_listado[0]['idbusqueda_componente'].$rol_tareas.$idtareas_listado_unico;
		  $texto='';
		  $texto.='<div id="tareas" title="Tareas" data-load=\'{"kConnector":"iframe", "url":"'.$url.'", "kTitle":"Tareas"}\' class="items navigable">';
		  $texto.='<div class="head"></div>';              				            
		  $texto.='<div class="label">'.codifica_encabezado(html_entity_decode('Tareas')).'</div>';
		  $texto.='<div class="info"></div>'; 		
		  $texto.='<div class="tail"></div>';
		  $texto.='</div>'; 
	      echo($texto);
		  
		  /*CALENDARIOS*/
		  $url=$ruta_db_superior."calendario/fullcalendar.php?idcalendario=".$calendario_responsable[0]['idcalendario_saia'];
		  $texto='';
		  $texto.='<div id="calendarios" title="Calendarios" data-load=\'{"kConnector":"iframe", "url":"'.$url.'", "kTitle":"Calendarios"}\' class="items navigable">';
		  $texto.='<div class="head"></div>';              				            
		  $texto.='<div class="label">'.codifica_encabezado(html_entity_decode('Calendarios')).'</div>';
		  $texto.='<div class="info"></div>'; 		
		  $texto.='<div class="tail"></div>';
		  $texto.='</div>'; 
	      echo($texto);		  

		  /*TAREAS RAPIDAS*/
		  $url=$ruta_db_superior."pantallas/busquedas/consulta_busqueda_tareas_listado2.php?idbusqueda_componente=".$componente_tareas_listado[0]['idbusqueda_componente']."&rol_tareas=tareas_rapidas";
		  $texto='';
		  $texto.='<div id="tareas" title="Tareas rapidas" data-load=\'{"kConnector":"iframe", "url":"'.$url.'", "kTitle":"Tareas rapidas"}\' class="items navigable">';
		  $texto.='<div class="head"></div>';              				            
		  $texto.='<div class="label">'.codifica_encabezado(html_entity_decode('Tareas rapidas')).'&nbsp; <span class="badge">'.$tareas_rapidas['numcampos'].'</span> </div>';
		  $texto.='<div class="info"></div>'; 		
		  $texto.='<div class="tail"></div>';
		  $texto.='</div>'; 
	      echo($texto);  

	      /*TAREAS VENCIDAS*/
		  $url=$ruta_db_superior."pantallas/busquedas/consulta_busqueda_tareas_listado2.php?idbusqueda_componente=".$componente_tareas_listado[0]['idbusqueda_componente']."&rol_tareas=tareas_vencidas";
		  $texto='';
		  $texto.='<div id="tareas" title="Tareas vencidas" data-load=\'{"kConnector":"iframe", "url":"'.$url.'", "kTitle":"Tareas vencidas"}\' class="items navigable">';
		  $texto.='<div class="head"></div>';              				            
		  $texto.='<div class="label">'.codifica_encabezado(html_entity_decode('Tareas vencidas')).'&nbsp; <span class="badge">'.$tareas_vencidas['numcampos'].'</span> </div>';
		  $texto.='<div class="info"></div>'; 		
		  $texto.='<div class="tail"></div>';
		  $texto.='</div>'; 
	      echo($texto); 	  
  
	      /*TAREAS TERMINADAS*/
		  $url=$ruta_db_superior."pantallas/busquedas/consulta_busqueda_tareas_listado2.php?idbusqueda_componente=".$componente_tareas_listado[0]['idbusqueda_componente']."&rol_tareas=tareas_terminadas";
		  $texto='';
		  $texto.='<div id="tareas" title="Tareas terminadas" data-load=\'{"kConnector":"iframe", "url":"'.$url.'", "kTitle":"Tareas terminadas"}\' class="items navigable">';
		  $texto.='<div class="head"></div>';              				            
		  $texto.='<div class="label">'.codifica_encabezado(html_entity_decode('Tareas terminadas')).'&nbsp; <span class="badge">'.$tareas_terminadas['numcampos'].'</span> </div>';
		  $texto.='<div class="info"></div>'; 		
		  $texto.='<div class="tail"></div>';
		  $texto.='</div>'; 
	      echo($texto);  
		  
		  

		  $perfil_usuario_actual=usuario_actual('perfil');
			
		  $busca_perfil_admin=busca_filtro_tabla("idperfil","perfil","lower(nombre)='admin_interno'","",$conn);
			
		  if($busca_perfil_admin[0]['idperfil']==$perfil_usuario_actual){
				
	      /*TAREAS GENERICAS*/
		  $url=$ruta_db_superior."pantallas/busquedas/consulta_busqueda_tareas_listado2.php?idbusqueda_componente=".$componente_tareas_listado[0]['idbusqueda_componente']."&rol_tareas=tarea_generica";
		  $texto='';
		  $texto.='<div id="tareas" title="Tareas genericas" data-load=\'{"kConnector":"iframe", "url":"'.$url.'", "kTitle":"Tareas genericas"}\' class="items navigable">';
		  $texto.='<div class="head"></div>';              				            
		  $texto.='<div class="label">'.codifica_encabezado(html_entity_decode('Tareas genericas')).'&nbsp; <span class="badge">'.$tareas_genericas['numcampos'].'</span> </div>';
		  $texto.='<div class="info"></div>'; 		
		  $texto.='<div class="tail"></div>';
		  $texto.='</div>'; 
	      echo($texto);  				
				
				
		  }
		
		  
 
  
	?>	
  </div>
</div>


<?php 
	if(@$_REQUEST['click']){
		?>
			<script>
				$('#tareas').trigger('click');
			</script>		
		<?php
		
		
	}
?>




<?php
	function acceso_modulo($idmodulo){
	  if($idmodulo=='' || $idmodulo==Null || $idmodulo==0 ||  usuario_actual("login")=="cerok"){
	    return true;
	  }
	  $ok=new Permiso();
	  $modulo=busca_filtro_tabla("","modulo","idmodulo=".$idmodulo,"");
	  $acceso=$ok->acceso_modulo_perfil($modulo[0]["nombre"]);
	  return $acceso;
	}	
	

?>