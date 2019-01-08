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

//--------------------------------------
function autocompletar_funcionarios($campo,$ruta_autocompletar,$unico=0,$funcion=""){
	global $ruta_db_superior;
?>
<style>
	.ac_results_<?php echo $campo;?> {
		padding: 0px;
		border: 0px solid black;
		background-color: white;
		overflow: hidden;
		z-index: 99999;
	}
	
	.ac_results_<?php echo $campo;?> ul {
		width: 100%;
		list-style-position: outside;
		list-style: none;
		padding: 0;
		margin: 0;
	}
	.ac_results_<?php echo $campo;?> li:hover {
	background-color: A9E2F3;
	}
	
	.ac_results_<?php echo $campo;?> li {
		margin: 0px;
		padding: 2px 5px;
		cursor: default;
		display: block;
		font: menu;
		font-size: 10px;
		line-height:10px;
		overflow: hidden;
	}
</style>
<script>	
	$(document).ready(function(){
		var delay_<?php echo $campo;?> = (function(){
		  var timer = 0;
		  return function(callback, ms){
		    clearTimeout (timer);
		    timer = setTimeout(callback, ms);
		  };
		})();
	  $("#<?php echo $campo;?>").hide();
		$("#<?php echo $campo;?>").parent().append("<input type='text' id='buscar_radicado_<?php echo $campo;?>' size='50' name='buscar_radicado_<?php echo $campo;?>'><div id='ul_completar_<?php echo $campo;?>' class='ac_results_<?php echo $campo;?>'></div>");
		$("#buscar_radicado_<?php echo $campo;?>").keyup(function (){
		  delay_<?php echo $campo;?>(function(){
	      var valor=$("#buscar_radicado_<?php echo $campo;?>").val();
	      if(valor==0 || valor==""){
	        //alert("Ingrese el dato a buscar");
	      }else{
	        $("#ul_completar_<?php echo $campo;?>").load( "<?php echo $ruta_db_superior.$ruta_autocompletar;?>", {campo:"<?php echo $campo;?>", dato_buscar:valor,opt:1});
	      }
	   }, 500 );
		});
	});
		
	function cargar_datos_<?php echo $campo;?>(id,descripcion){
		$("#ul_completar_<?php echo $campo;?>").empty();
    if(!$("#informacion_buscar_radicado_<?php echo $campo;?>").length){    	
      $("#buscar_radicado_<?php echo $campo;?>").after("<br/><table style='font-size:10px;' id='informacion_buscar_radicado_<?php echo $campo;?>'></table>");
    }
   	<?php if($unico==1){?>   		
			if(id!=0){
				$("#informacion_buscar_radicado_<?php echo $campo;?>").empty().append("<tr id='fila_"+id+"' opt='"+id+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+id+"' onclick='eliminar_asociado_<?php echo $campo;?>("+id+");'></td></tr>");
				$("#<?php echo $campo;?>").val(id);
				
				$("#<?php echo $campo;?>").trigger('change');
				
			}
   		<?php
   	}else{
   		?>
			if(id!=0){				
				$("#informacion_buscar_radicado_<?php echo $campo;?>").append("<tr id='fila_"+id+"' opt='"+id+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+id+"' onclick='eliminar_asociado_<?php echo $campo;?>("+id+");'></td></tr>");
				if($("#<?php echo $campo;?>").val()!=''){
					$("#<?php echo $campo;?>").val($("#<?php echo $campo;?>").val()+","+id);
				}else{
					$("#<?php echo $campo;?>").val(id);
				}
				
				$("#<?php echo $campo;?>").trigger('change');
				
			}
   		<?php
   	}
		?>
    $("#buscar_radicado_<?php echo $campo;?>").val("");
    <?php 
    if($funcion!=""){
    	echo $funcion;?>(id);
    <?php
		}
		?>
  }
  
	function eliminar_asociado_<?php echo $campo;?>(id){
		$("#informacion_buscar_radicado_<?php echo $campo;?> #fila_"+id).remove();
		var datos=$("#<?php echo $campo;?>").val().split(",");
		var cantidad=datos.length;
		var nuevos_datos=new Array();
		var a=0;
		for(var i=0;i<cantidad;i++){
			if(id!=datos[i]){
				nuevos_datos[a]=datos[i];
				a++;
			}
		}
		var datos_guardar=nuevos_datos.join(",");
		$("#<?php echo $campo;?>").val(datos_guardar);
	}
	
	function cargar_seleccionados_<?php echo $campo;?>(){
		var seleccionados_<?php echo $campo;?>=$("#<?php echo $campo;?>").val().split(",");
		$("#<?php echo $campo;?>").val("");
		for(var i=0;i<seleccionados_<?php echo $campo;?>.length;i++){
		  $.ajax({
		    type:'POST',
		    async: false,
		    url: "<?php echo $ruta_db_superior.$ruta_autocompletar;?>",
		    data: {id:seleccionados_<?php echo $campo;?>[i],opt:2},
		    success: function(retorno){
		      cargar_datos_<?php echo $campo;?>(seleccionados_<?php echo $campo;?>[i],retorno);
		    } 
		  });
		}
	}
</script>
<?php
}


function enlaces_listado_tareas($idlistado_tareas,$nombre){
	global $conn;
	$texto="";
	/*$permiso=new Permiso();
	$ok1=$permiso->acceso_modulo_perfil("eliminar_expediente");
	$ok2=$permiso->acceso_modulo_perfil("editar_expediente");*/
	$componente_tareas=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='tareas_listado_reporte' ","",$conn);
	
	
	$texto.='<div class=\'btn btn-mini eliminar_listado_tarea tooltip_saia pull-right\' idregistro=\''.$idlistado_tareas.'\' title=\'Eliminar\'titulo=\'Eliminar\' '.$nombre.'\'><i class=\'icon-trash\'></i></div>';
	$texto.='<div class=\'btn btn-mini enlace_listado_tareas tooltip_saia pull-right\' idregistro=\''.$idlistado_tareas.'\' title=\'editar\'titulo=\'Editar\''.$nombre.'\' enlace=\'pantallas/listado_tareas/editar_listado_tareas.php?idlistado_tareas='.$idlistado_tareas.'\'><i class=\'icon-pencil\'></i></div>';
	$texto.='<div class=\'btn btn-mini enlace_listado_tareas tooltip_saia pull-right\' title=\'Permisos\' titulo=\'Permisos\' enlace=\'pantallas/listado_tareas/asignar_listado_tareas.php?idlistado_tareas='.$idlistado_tareas.'\' conector=\'iframe\'><i class=\'icon-lock\'></i></div>';
	$texto.='<div class=\'btn btn-mini enlace_listado_tareas tooltip_saia pull-right\' title=\'Tareas del listado\' titulo=\'Tareas del listado\' enlace=\'pantallas/busquedas/consulta_busqueda_subtareas_listado2.php?idbusqueda_componente='.$componente_tareas[0]['idbusqueda_componente'].'&ocultar_subtareas=1&idlistado_tareas='.$idlistado_tareas.'\' conector=\'iframe\'><i class=\'icon-list\'></i></div>';
	return($texto);
}

function obtener_descripcion_listado_tareas($descripcion_lista){
	if($descripcion_lista=="descripcion_lista"){
		$descripcion_lista="";
	}
	return(codifica_encabezado(substr(html_entity_decode($descripcion_lista),0,200))."...");
}

function creador_listado($idfuncionario=0){
	$cadena="";
	if($idfuncionario!=0){
		$nombres=busca_filtro_tabla("","funcionario","idfuncionario=".$idfuncionario,"",$conn);
		$cadena=$nombres[0]["nombres"]." ".$nombres[0]["apellidos"];
	}
	return $cadena;
}

function mostrar_cliente_proyecto($cliente_proyecto){
	$separados= explode(",", $cliente_proyecto);
	for ($i=0; $i < count($separados) ; $i++) { 
		$nombre=busca_filtro_tabla("nombre_corto","ft_clientes_proveedores","documento_iddocumento=".$separados[$i],"",$conn);
		if($nombre["numcampos"]){
			$cadena.=$nombre[0]['nombre_corto'].",";
		}		
	}
	return $cadena;
}

function mostrar_macroproceso($idseries){
	$separados= explode(",", $idseries);
	for ($i=0; $i < count($separados) ; $i++) { 
		$serie=busca_filtro_tabla("s.nombre,sp.nombre as nombre_padre","serie s,serie sp","s.cod_padre=sp.idserie and s.idserie=".$separados[$i],"",$conn);
		if($serie["numcampos"]){
			$cadena.=$serie[0]['nombre_padre']."-".$serie[0]['nombre'].",";
		}		
	}
	return $cadena;
}

function usuario_actual_codigo(){
	return usuario_actual('idfuncionario');
}

function asignar_permiso_listado($idlistador_tarea, $tipo_entidad, $llave_entidad){
	global $conn;
	$busqueda=busca_filtro_tabla("","permiso_listado_tareas a","entidad_identidad=".$tipo_entidad." and llave_entidad=".$llave_entidad." and fk_listado_tareas in(".$idlistador_tarea.")","",$conn);
	
	$listados_aparte=explode(',',$idlistador_tarea);
	
	for($i=0;$i<count($listados_aparte);$i++){
			
	
		if(!$busqueda["numcampos"]){
	
			$sql1="insert into permiso_listado_tareas(entidad_identidad, fk_listado_tareas, llave_entidad, estado) values(".$tipo_entidad.",".$listados_aparte[$i].",".$llave_entidad.",'1')";
			
			
			
		}else{
			$sql1="update permiso_listado_tareas set entidad_identidad=".$tipo_entidad.", fk_listado_tareas=".$listados_aparte[$i].", llave_entidad=".$llave_entidad."  where identidad_expediente=".$busqueda[0]["idpermiso_listado_tareas"];
		}
		
		phpmkr_query($sql1);
		
	}	
	return true;
}

function mostrar_funcionarios_permiso($idlista){
	$cadena="";	
	$funcionarios=busca_filtro_tabla("f.nombres,f.apellidos","permiso_listado_tareas p,funcionario f","p.llave_entidad=f.idfuncionario and p.entidad_identidad=1 and p.estado=1 and p.fk_listado_tareas=".$idlista,"",$conn);
	if($funcionarios["numcampos"]){
		for ($i=0; $i < $funcionarios["numcampos"] ; $i++) { 
			$cadena.=$funcionarios[$i]['nombres']." ".$funcionarios[$i]['apellidos'].", ";
		}
	}
	return $cadena;
}

function barra_superior_busqueda(){
	return('
	<li class="divider-vertical"></li>                          
	<li>            
	 <div class="btn-group">                    
	    <button class="btn btn-mini btn-primary" id="adicionar_expediente" idbusqueda_componente="'.$_REQUEST["idbusqueda_componente"].'" title="Adicionar expediente hijo" enlace="pantallas/listado_tareas/adicionar_listado_tareas.php?listado_tareas_fk='.@$_REQUEST["idlistado_tareas"].'&div_actualiza=resultado_busqueda'.$_REQUEST["idbusqueda_componente"].'&target_actualiza=parent&idbusqueda_componente='.$_REQUEST["idbusqueda_componente"].'&listado_tareas_fk='.$_REQUEST["idlistado_tareas"].'">Adicionar Listado Tareas</button>                                            
	  </div>    
	</li>');
}

function mostrar_contador_tareas($idlistado_tareas){
	global $conn;
	$documentos=busca_filtro_tabla("count(*) as cantidad","tareas_listado","cod_padre=0 AND listado_tareas_fk=".$idlistado_tareas,"",$conn);

	return("<span class='pull-right badge' style='margin-top:3px' id='contador_tareas_".$idlistado_tareas."'>".$documentos[0]["cantidad"]."</span><span class='pull-right' style='margin-top:3px'>&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;");

}


function checkbox_listado_tareas($idlistado_tareas){
$texto='
	<button type="button" class="checkbox_listado_tareas  btn btn-mini tooltip_saia" title="Seleccionar Listado" idregistro="'.$idlistado_tareas.'">
		<i class="icon-uncheck listado_no_seleccionado"></i>
	</button>
';
return($texto);
}


function permiso_masivo_listado_tareas(){
	global $ruta_db_superior;		
	$cadena='
          <li>
          <a href="#">
            <div id="asignar_permiso">Permisos
            </div></a>
          </li>  
		  <script>
		  	$("#asignar_permiso").click(function(){
		  		var seleccionados=$("#seleccionados").val();
				if(seleccionados!=""){
					window.open("'.$ruta_db_superior.'pantallas/listado_tareas/asignar_listado_tareas.php?idlistado_tareas="+seleccionados,"iframe_detalle");	
				}else{
					notificacion_saia("Debe seleccionar al menos un listado","warning","",4000);
				}
		  	});
		  </script>	
	';	
	return($cadena);	
}


function seleccionar_todos_listado_tareas(){
	global $ruta_db_superior;	

	$cadena='
          <li>
          <a href="#">
            <div id="seleccionar_todos_listado_tareas" check="0">Seleccionar Todos <i class="icon-uncheck"></i>
            </div></a>
          </li>  
		  <script>
		  	$(document).ready(function(){
				$("#seleccionar_todos_listado_tareas").click(function(){
					if( $("#seleccionar_todos_listado_tareas").attr("check")==0 ){
						$.ajax({
		                        type:"POST",
		                        dataType: "json",
		                        url: "'.$ruta_db_superior.'pantallas/listado_tareas/ejecutar_acciones.php?ejecutar_accion=seleccionar_todos_listado_tareas_ajax",
		                        success: function(datos){
									$("#seleccionados").val(datos.listados_cadena);
									$("#cargar_with_check").val(1);
									$("#seleccionar_todos_listado_tareas").attr("check",1);
									$("#seleccionar_todos_listado_tareas").html("Seleccionar Todos <i class=\"icon-check\"></i>");
	
									$(".listado_no_seleccionado").removeClass("icon-uncheck");
									$(".listado_no_seleccionado").addClass("icon-check");
									$(".listado_no_seleccionado").addClass("listado_seleccionado");
									$(".listado_no_seleccionado").parent().parent().addClass("alert-info");
									$(".listado_no_seleccionado").removeClass("listado_no_seleccionado");
		                        }
		                 });						
					}
					else{
						$("#seleccionados").val("");
						$("#cargar_with_check").val(0);
						$("#seleccionar_todos_listado_tareas").attr("check",0);
						$("#seleccionar_todos_listado_tareas").html("Seleccionar Todos <i class=\"icon-uncheck\"></i>");

						$(".listado_seleccionado").removeClass("icon-check");
						$(".listado_seleccionado").addClass("icon-uncheck");
						$(".listado_seleccionado").addClass("listado_no_seleccionado");
						$(".listado_seleccionado").parent().parent().removeClass("alert-info");
						$(".listado_seleccionado").removeClass("listado_seleccionado");
					}
				});
		  	});
		  </script>
          '; 
	return($cadena);	  
}


//--------------------------------------------------


/*

function enlace_expediente($idlistado_tareas,$nombre){
return("<div style='' class='link kenlace_saia' enlace='pantallas/busquedas/consulta_busqueda_tareas_listado.php?idbusqueda_componente=".$_REQUEST["idbusqueda_componente"]."&idlistado_tareas=".$idlistado_tareas."' conector='iframe' titulo='".$nombre."'><b>".$nombre."</b></div>");
}

function enlace_adicionar_tareas_listado($idlistado_tareas,$nombre){
	global $conn;
    $componente=busca_filtro_tabla("","busqueda_componente","idbusqueda_componente=".$_REQUEST["idbusqueda_componente"],"",$conn);
	$datos= busca_filtro_tabla("","busqueda_componente","busqueda_idbusqueda=".$componente[0]['busqueda_idbusqueda'],"",$conn);
	
	return("<div style='' class='link kenlace_saia' enlace='pantallas/busquedas/consulta_busqueda_tareas_listado.php?idbusqueda_componente=216&idlistado_tareas=".$idlistado_tareas."' conector='iframe' titulo='".$nombre."'><b>".$nombre."</b></div>");
}

function listado_expedientes_documento($iddocumento){
$expedientes=busca_filtro_tabla("","expediente A, expediente_doc B","A.idexpediente=B.expediente_idexpediente AND B.documento_iddocumento=".$iddocumento,"",$conn);
if($expedientes["numcampos"]){
  $texto='<ul>';
  for($i=0;$i<$expedientes["numcampos"];$i++){
    $texto.='<li>'.$expedientes[$i]["nombre"].'</li>';
  } 
  $texto.='</ul>';
}
else{
  $texto='No existen expedientes vinculados con el documento';
}
return($texto);
}

function dependencia_actual_codigos(){
	global $dependencia;
	$dependencias=busca_filtro_tabla("dependencia_iddependencia","dependencia_cargo a","a.estado='1' and funcionario_idfuncionario=".usuario_actual('idfuncionario'),"",$conn);
	$dependencia=extrae_campo($dependencias,"dependencia_iddependencia");
	return implode(",",$dependencia);
}

*/



?>