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

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("listado_tareas_fk","responsable_tarea","evaluador","idtareas_listado","idtareas_listado_recur");
desencriptar_sqli('form_info');

include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
echo(estilo_bootstrap());
  echo(librerias_jquery("1.7"));
  echo(librerias_notificaciones());
if($_REQUEST['guardar']==1){
	
	$sql="UPDATE tareas_listado SET listado_tareas_fk='".$_REQUEST['listado_tareas_fk']."',evaluador='".$_REQUEST['evaluador']."',cod_padre='".$_REQUEST['cod_padre']."',nombre_tarea='".$_REQUEST['nombre_tarea']."', tipo_tarea='".$_REQUEST['tipo_tarea']."', responsable_tarea='".$_REQUEST['responsable_tarea']."', co_participantes='".implode(",",array_unique(explode(",",$_REQUEST['co_participantes'])))."', seguidores='".implode(",",array_unique(explode(",",$_REQUEST['seguidores'])))."', descripcion_tarea='".$_REQUEST['descripcion_tarea']."', fecha_inicio='".$_REQUEST['fecha_inicio']."', fecha_limite='".$_REQUEST['fecha_limite']."', prioridad= '".$_REQUEST['prioridad']."', tiempo_estimado='".$_REQUEST['tiempo_estimado']."', enviar_email='".$_REQUEST['enviar_email']."',info_recurrencia='".@$_REQUEST["info_recurrencia"]."' WHERE idtareas_listado=".$_REQUEST["idtareas_listado"];
	
	phpmkr_query($sql);
	
	
  if(@$_REQUEST["info_recurrencia"]!=''){
    $datos=json_decode($_REQUEST["info_recurrencia"],true);
    
    $recurrencia=array("fk_tareas_listado"=>$_REQUEST["idtareas_listado"]);
    foreach ($datos as $key => $value) {
      if(@isset($recurrencia[$value["name"]])){
        $recurrencia[$value["name"]].=",".$value["value"];
      }
      else{
        if($value["value"]!==''){
          $recurrencia[$value["name"]]=$value["value"];
        }
      }  
    }
    if($recurrencia["finaliza_el_fecha"]!=''){
      $recurrencia["finaliza_el_fecha"]=fecha_db_almacenar($recurrencia["finaliza_el_fecha"],"Y-m-d");
    }
    $recurrencia["ejecuta_proxima"]=fecha_db_almacenar($recurrencia["ejecuta_proxima"],"Y-m-d");
    $recurrencia["empieza_el"]=fecha_db_almacenar($recurrencia["empieza_el"],"Y-m-d");
    $excluidos=array("finaliza_el_fecha","ejecuta_proxima","empieza_el");
    foreach ($recurrencia as $key => $value) {
      if(!in_array($key, $excluidos)){
        $recurrencia[$key]="'".$value."'";
      }
    }
	
	if(@$_REQUEST['idtareas_listado_recur']){
				
		$sql_update_recur="UPDATE tareas_listado_recur SET ";
		$n=0;
		foreach ($recurrencia as $key => $value){
			if($n+1==count($recurrencia)){
				$sql_update_recur.=$key."=".$value." ";
			}else{
				$sql_update_recur.=$key."=".$value.", ";
			}
			$n++;
		} 	
		$sql_update_recur.=" WHERE idtareas_listado_recur=".$_REQUEST['idtareas_listado_recur'];
	    phpmkr_query($sql_update_recur);	
					
	}else{
	    $sql_insert_recur="INSERT INTO tareas_listado_recur(".implode(", ", array_keys($recurrencia)).") VALUES(".implode(", ", array_values($recurrencia)).")";
	    phpmkr_query($sql_insert_recur);		
	}

  }	
	
	
	if(@$_REQUEST['cod_padre']!=0){
		$llave=$_REQUEST['cod_padre'];
		$titulo_mostrar='Subtarea';
		$componente_subtareas=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='subtareas_listado' ","",$conn);
		$componente=$componente_subtareas[0]['idbusqueda_componente'];;
	}else{
		$llave=$_REQUEST["idtareas_listado"];
		$titulo_mostrar='Tarea';
	    $componente_tareas=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='tareas_listado_reporte' ","",$conn);
	    $componente=$componente_tareas[0]['idbusqueda_componente'];
	}
	
//	redirecciona($ruta_db_superior."pantallas/busquedas/consulta_busqueda_subtareas_listado.php?idtareas_listado=".$llave."&idbusqueda_componente=221");
	
			?>
			<script>
				notificacion_saia('<?php echo($titulo_mostrar); ?> Editada Satisfactoriamente','success','',4000);
				parent.parent.parent.$('#actualizar_info_index').click();
				var json={"idbusqueda_componente":<?php echo($componente); ?>,"llave":<?php echo($_REQUEST["idtareas_listado"]); ?>};
			    parent.postMessage(json,'*');
			    parent.eliminar_panel_kaiten(0);
			</script>
			<?php	
	
	
	
}else{
	
	
	
	
	
	include_once($ruta_db_superior."pantallas/listado_tareas/librerias.php");
  echo(librerias_jquery("1.7"));
  echo(librerias_arboles());
  echo(librerias_bootstrap());
  echo(librerias_datepicker_bootstrap());
  echo(librerias_notificaciones());
  $datos_tarea=busca_filtro_tabla("","tareas_listado","idtareas_listado=".$_REQUEST['idtareas_listado'],"",$conn);
  
  $datos_recurrencia=busca_filtro_tabla("idtareas_listado_recur","tareas_listado_recur","fk_tareas_listado=".$_REQUEST['idtareas_listado'],"",$conn);

  if($datos_recurrencia['numcampos']){
   ?>
   	<script>
   		$(document).ready(function(){
   			 $('[name="idtareas_listado"]').after('<input type="hidden" name="idtareas_listado_recur" value="<?php echo($datos_recurrencia[0]['idtareas_listado_recur']); ?>">');
   		});
	
   	</script>
   <?php
  }	

 	/*SUBTAREAS*/ 
  	$titulo_pantalla="Tareas";
	$titulo_input="tarea";
	if($datos_tarea[0]['cod_padre']!=0){
		$titulo_pantalla="Subtareas";
		$titulo_input="subtarea";
	}
   /*----------*/ 
 
 
	?>
	<div class="container">
		<div class="control-group" nombre="etiqueta">
			<legend><?php echo($titulo_pantalla); ?></legend>
		</div>
		<form id="formulario_tareas" name="formulario_tareas" class="form-horizontal" method="post">
		
		
		<?php
			if($datos_tarea[0]['tipo_tarea']!=1){
				
		?>		

		<div class="control-group element">
  			<label class="control-label" for="cargar">Proceso / Listado*:
  			</label>
  			<div class="controls"> 
    			<input type="text"  class="required" name="listado_tareas_fk" id="listado_tareas_fk" value="<?php echo($datos_tarea[0]['listado_tareas_fk'])?>">
 			 </div>
		</div>				
		
		<?php
			autocompletar_listado_tareas();
			}else{
				IF($_SESSION['LOGINSAIA_PRUEBAS_SOLE']=='cerok'){
		?>
		<div class="control-group element">
  			<label class="control-label" for="cargar">Proceso / Listado*:
  			</label>
  			<div class="controls"> 
    			<input type="text"  class="required" name="listado_tareas_fk" id="listado_tareas_fk" value="<?php echo($datos_tarea[0]['listado_tareas_fk'])?>">
 			 </div>
		</div>		
		<?php					
				}
				autocompletar_listado_tareas_rapidas();
			}
		?>
			
		<!-- div class="control-group element">
  			<label class="control-label" for="cargar">Cargar <?php echo($titulo_input); ?>
  			</label>
  			<div class="controls"> 
    			<input type="text" name="cargar_tarea" id="cargar_tarea" >
 			 </div>
		</div -->
			
		<div class="control-group element">
  			<label class="control-label" for="nombre">Nombre de la <?php echo($titulo_input); ?>*
  			</label>
  			<div class="controls"> 
    			<input type="text" name="nombre_tarea" class="required" id="nombre_tarea" value="<?php echo $datos_tarea[0]["nombre_tarea"]; ?>" >
 			 </div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="etiqueta">Tipo de <?php echo($titulo_input); ?>*:</label>
				<div class="controls">
					<input type="radio" class="required" name="tipo_tarea" id="tipo_tarea0" value="1">&nbsp;Personal&nbsp;
					
							<?php
							if($datos_tarea[0]['tipo_tarea']!=1){
							?>	
					<input type="radio" name="tipo_tarea" id="tipo_tarea1" value="2">&nbsp;Cumplimiento&nbsp;
					<input type="radio" name="tipo_tarea" id="tipo_tarea2" value="3">&nbsp;Rutinaria
							<?php
								}
							?>					
					<label class="error" for="tipo_tarea"></label>
				</div>
		</div>
		
		<!-- div class="control-group">
			<label class="control-label" for="recurrencia">Recurrencia*:</label>
				<div class="controls">
					<select name="recurrencia" id="recurrencia" class="required">
						<option value="">Seleccione</option>
						<option value="1">No se repite</option>
						<option value="2">Eventual</option>
						<option value="3">Diario</option>
						<option value="4">Semanal</option>
						<option value="5">Quincenal</option>
						<option value="6">Mensual</option>
						<option value="7">Bimestral</option>
						<option value="8">Cuatrimestral</option>
						<option value="9">Anual</option>
						<option value="10">Importante</option>
						<option value="11">Semestral</option>
					</select>
					<label class="error" for="recurrencia"></label>
				</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="opcion_recurrencia">Opciones de Recurrencia:</label>
				<div class="controls">
					<select name="opcion_recurrencia" id="opcion_recurrencia">
						<option value="">Seleccione</option>
						<option value="1">Lunes a Viernes</option>
						<option value="2">Dias Seleccionados</option>
						<option value="3">Mensual</option>
					</select>
					<label class="error" for="opcion_recurrencia"></label>
				</div>
		</div -->
		
		<div class="control-group element">
  			<label class="control-label" for="descripcion">Descripci&oacute;n
  			</label>
 			 <div class="controls"> 
    		<textarea name="descripcion_tarea" id="descripcion_tarea"><?php echo $datos_tarea[0]["descripcion_tarea"];?></textarea>
  			</div>
		</div>	
		
		<div class="control-group">
			<label class="control-label" for="etiqueta">Responsable de la <?php echo($titulo_input); ?>*:</label>
			<div class="controls">
				<input type="text" name="responsable_tarea" id="responsable_tarea" class="required" value="<?php echo $datos_tarea[0]["responsable_tarea"];?>">
			<?php
				autocompletar_funcionarios("responsable_tarea","pantallas/tareas_listado/autocompletar_funcionarios.php",1);
			?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="etiqueta">Co-participantes:</label>
			<div class="controls">
				<input type="text" name="co_participantes" id="co_participantes" value="<?php echo $datos_tarea[0]["co_participantes"];?>">
			<?php
				autocompletar_funcionarios("co_participantes","pantallas/tareas_listado/autocompletar_funcionarios.php",0);
			?>
			</div>
		</div>	
			
		<div class="control-group">
			<label class="control-label" for="etiqueta">Seguidores:</label>
			<div class="controls">
			<input type="text" name="seguidores" id="seguidores" value="<?php echo $datos_tarea[0]["seguidores"];?>">
			<?php
				autocompletar_funcionarios("seguidores","pantallas/tareas_listado/autocompletar_funcionarios.php",0);
			?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="etiqueta">Evaluador*:</label>
			<div class="controls">
			<input type="text"  class="required" name="evaluador" id="evaluador" value="<?php echo $datos_tarea[0]["evaluador"];?>">
			<?php
				autocompletar_funcionarios("evaluador","pantallas/tareas_listado/autocompletar_funcionarios.php",1);
			?>
			</div>
		</div>


		<?php
			$ocultar_fecha_inicio_limite='style="display:none;"';
			if(usuario_actual('idfuncionario')==$datos_tarea[0]["evaluador"]){
				$ocultar_fecha_inicio_limite='';
			}
		?>

		<div class="control-group"  <?php echo($ocultar_fecha_inicio_limite); ?>>
				<label class="control-label" for="etiqueta">Fecha de inicio*:</label>
				<div class="controls">
					<div id="datetimepicker1" class="input-append">
    					<input data-format="yyyy-MM-dd" id="fecha_inicio" name="fecha_inicio" type="text" value="<?php echo $datos_tarea[0]["fecha_inicio"]; ?>" class="required" ></input>
    					<span class="add-on">
      					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
    					</span>
  					</div>
				</div>
		</div>

		<div class="control-group" <?php echo($ocultar_fecha_inicio_limite); ?>>
				<label class="control-label" for="etiqueta">Fecha de vencimiento*:</label>
				<div class="controls">
					<div id="datetimepicker2" class="input-append">
    					<input data-format="yyyy-MM-dd" name="fecha_limite" id="fecha_limite"  type="text" value="<?php echo $datos_tarea[0]["fecha_limite"]; ?>" class="required"></input>
    					<span class="add-on">
      					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
    					</span>
  					</div>
				</div>
		</div>
		
		
		
		<script src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-full.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    <script type='text/javascript'>
    $(document).ready(function (){
      hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
      hs.outlineType = 'rounded-white';
    });
    </script>
    <div class="control-group">
      <label class="control-label" for="recurrencia">Recurrencia:</label>
        <div class="controls">
          <input type="text" name="info_recurrencia" id="info_recurrencia" value=""  />
          <a id="enlace_recurrencia" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 380, height: 470,preserveContent:false})" href="<?php echo $ruta_db_superior; ?>pantallas/tareas_listado/opciones_recurrencias.php?fecha_inicial=<?php echo(date('Y-m-d'));?>&fk_tareas_listado=<?php echo($_REQUEST['idtareas_listado']); ?>">Opciones de Recurrencia</a>
        </div>
    </div>		
		
		
		
		
		
		
		
		
		<div class="control-group">
			<label class="control-label" for="etiqueta">Prioridad*:</label>
				<div class="controls">
					<input type="radio" name="prioridad" id="prioridad0" value="0" class="required">&nbsp;&nbsp;Baja&nbsp;&nbsp;
					<input type="radio" name="prioridad" id="prioridad1" value="1" checked="true">&nbsp;&nbsp;Media&nbsp;&nbsp;
					<input type="radio" name="prioridad" id="prioridad2" value="2">&nbsp;&nbsp;Alta&nbsp;&nbsp;
					<input type="radio" name="prioridad" id="prioridad3" value="3">&nbsp;&nbsp;Cr&iacute;tica&nbsp;&nbsp;
					<label class="error" for="prioridad"></label>
				</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="etiqueta">Tiempo estimado:</label>
			<div class="controls">
				<div id="datetimepicker3" class="input-append">
					
					<?php
					$vector_hi=explode(':',$datos_tarea[0]["tiempo_estimado"]);
					?>
    				<input  name="tiempo_estimado" id="tiempo_estimado" type="hidden" value="<?php echo($datos_tarea[0]["tiempo_estimado"]); ?>"/>
    				<input type="text" id="h"  placeholder="H" value="<?php echo($vector_hi[0]); ?>" style="width:50px;" /> 
    				<input type="text" id="i"  placeholder="M" value="<?php echo($vector_hi[1]); ?>"  style="width:50px;"/>
    				<script>
    					$(document).ready(function(){
    						$('#h,#i').keyup(function(){
    							var valor=$(this).val();
    							valor=valor.replace(/[^0-9]/g, '');
    							$(this).val(valor);
    							
    							if( $('#h').val()>838 ){
    								$('#h').val(838);
    							}
    							if( $('#i').val()>59 ){
    								$('#i').val(59);
    							}    							
    							var h=$('#h').val();
    							var i=$('#i').val();
    							var hi=h+':'+i;
    							$('#tiempo_estimado').val(hi);
    						});
    					});
    				</script>
  				</div>
			</div>
		</div>			
		<div class="control-group">
			<label class="control-label" for="etiqueta">Enviar <?php echo($titulo_input); ?> por email*:</label>
				<div class="controls">
					<input type="radio" class="required" name="enviar_email" id="enviar_email0" value="0">&nbsp;&nbsp;Si&nbsp;&nbsp;
					<input type="radio" name="enviar_email" id="enviar_email1" value="1" checked>&nbsp;&nbsp;No
					<label class="error" for="enviar_email"></label>
				</div>
		</div>

			<div class="control-group">
				<div class="controls">
					<input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
					<input type="hidden" name="idtareas_listado" value="<?php echo $_REQUEST["idtareas_listado"]; ?>">
					<input type="hidden" name="cod_padre" value="<?php echo($datos_tarea[0]['cod_padre']);?>">
					<input type="hidden" name="guardar" value="1">
				</div>
			</div>
		</form>
		
		
	

	<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/jquery.validate.1.13.1.js"></script>
	<style>
	label.error {
		font-weight: bold;
		color: red;
	}
/*---------------- AUTOCOMPLETAR---------------------*/	
	.ac_results {
		padding: 0px;
		border: 0px solid black;
		background-color: white;
		overflow: hidden;
		z-index: 99999;
	}
	
	.ac_results ul {
		width: 100%;
		list-style-position: outside;
		list-style: none;
		padding: 0;
		margin: 0;
	}
	.ac_results li:hover {
	background-color: A9E2F3;
	}
	
	.ac_results li {
		margin: 0px;
		padding: 2px 5px;
		cursor: default;
		display: block;
		font: menu;
		font-size: 10px;
		line-height:10px;
		overflow: hidden;
	}
	/*---------------- TERMINA AUTOCOMPLETAR---------------------*/
	</style>
	<script>
		
	$(document).ready(function(){
		$("#formulario_tareas").validate({
			submitHandler: function(form) {
				<?php encriptar_sqli("formulario_tareas",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
		});
   	cargar_seleccionados_responsable_tarea();
  	cargar_seleccionados_co_participantes();
  	cargar_seleccionados_seguidores();
	cargar_seleccionados_evaluador();	
		$('#datetimepicker1,#datetimepicker2').datetimepicker({
			language: 'es',
			pick12HourFormat: true,
			pickTime: false
		}).on('changeDate', function(e){
			$(this).datetimepicker('hide');
			if($(this).attr("id")=="datetimepicker1"){
			  var finicio=e.date.toISOString().split("T");
			 $("#enlace_recurrencia").attr("href","<?php echo $ruta_db_superior; ?>pantallas/tareas_listado/opciones_recurrencias.php?fecha_inicial="+finicio[0]+'&fk_tareas_listado=<?php echo($_REQUEST['idtareas_listado']); ?>');
			}			
		});/*
		$('#datetimepicker3').datetimepicker({
			pickDate: false,
			pickSeconds: false
		});	*/	
		
		var delay = (function(){
		  var timer = 0;
		  return function(callback, ms){
		    clearTimeout (timer);
		    timer = setTimeout(callback, ms);
		  };
		})();
	
		$("#cargar_tarea").after("<div id='ul_completar' class='ac_results'></div>");
		$("#cargar_tarea").keyup(function (){
		  delay(function(){
	      var valor=$("#cargar_tarea").val();
	      if(valor==0 || valor==""){
	        alert("Ingrese el nombre de la tarea");
	      }else{
	      	 $("#ul_completar").empty().load( "cargar_info_tarea.php", { nombre_tarea:valor,opt:1});
	      }
	    }, 500 );
		});
		
		//-----------------CARGAR LOS DATOS-----------//
		$("[name='tipo_tarea'][value='<?php echo $datos_tarea[0]["tipo_tarea"];?>']").attr('checked', true);
		$("#recurrencia [value='<?php echo $datos_tarea[0]["recurrencia"];?>']").attr('selected', true);
		$("#opcion_recurrencia [value='<?php echo $datos_tarea[0]["opcion_recurrencia"];?>']").attr('selected', true);
		$("[name='prioridad'][value='<?php echo $datos_tarea[0]["prioridad"];?>']").attr('checked', true);
		$("[name='enviar_email'][value='<?php echo $datos_tarea[0]["enviar_email"];?>']").attr('checked', true);
		
		
		$("[name='tipo_tarea']").change(function (){
			var tipo=$(this).val();
			if(tipo==3){
				$("#fecha_limite").removeClass("required");
			}else{
				$("#fecha_limite").addClass("required");
			}
		});
		$("[name='tipo_tarea']:checked").trigger("change");
		
	});
		
	function cargar_datos(idtarea){
		if(idtarea==0){
				$("#cargar_tarea").val("");
				$("#ul_completar").empty();
		}else{
			$("#cargar_tarea").val("");
			$("#ul_completar").empty();
			$.ajax({
		    type:'POST',
		    dataType: 'json',
		    async: false,
		    url: "cargar_info_tarea.php",
		    data: {idtarea:idtarea,opt:2},
		    success: function(data){
		      if(data.exito){
		      	$("#nombre_tarea").val(data.nombre_tarea);
		      	$("[name='tipo_tarea'][value='"+data.tipo_tarea+"']").attr('checked', true);
		      	$("#recurrencia [value='"+data.recurrencia+"']").attr('selected', true);
		      	$("#descripcion_tarea").val(data.descripcion_tarea);
		      	$("[name='prioridad'][value='"+data.prioridad+"']").attr('checked', true);
		      	$("[name='enviar_email'][value='"+data.enviar_email+"']").attr('checked', true);
		      	cargar_seleccionados_responsable_tarea();
		      	cargar_seleccionados_co_participantes();
		      	cargar_seleccionados_seguidores();
		      	cargar_seleccionados_evaluador();
		      	notificacion_saia("Datos Cargados","success","",3000);
		      }else{
		      	notificacion_saia(data.msn,"error","",3000);
		      }
		    } 
	  	});
		}
	}
	</script>
	
<?php


?>
	<script>
		$(document).ready(function(){
			var from_generica=parseInt('<?php echo($datos_tarea[0]['from_generica']); ?>');
			if(from_generica){
				$('#nombre_tarea').attr('readonly',true);
				$('#icono_eliminar_<?php echo($datos_tarea[0]['listado_tareas_fk']); ?>').hide();
				var info_recurrencia='<?php echo($datos_tarea[0]['info_recurrencia']); ?>';
				if(info_recurrencia!=''){
					$('#info_recurrencia').val('<?php echo($datos_tarea[0]['info_recurrencia']); ?>');
					$('#enlace_recurrencia').attr('disabled',true);
				}			
				$('[name="prioridad"]').attr('disabled',true);		
				
				var tiempo_estimado='<?php echo($datos_tarea[0]['tiempo_estimado']); ?>';
				if(tiempo_estimado){
					if(tiempo_estimado!='00:00:00'){
						$('#tiempo_estimado').attr('disabled',true);
						$('#tiempo_estimado').parent().children('span').hide();
					}
				}				
				
			}


			var generica=parseInt('<?php echo($datos_tarea[0]['generica']); ?>');
			if(generica){
				$('#descripcion_tarea,#responsable_tarea,#co_participantes,#seguidores,#evaluador,[name="enviar_email"]').parent().parent().hide();
				$('#responsable_tarea,#evaluador,[name="enviar_email"],#fecha_inicio,#fecha_limite').removeClass('required');
					
   				$('#fecha_inicio,#fecha_limite').parent().parent().parent().hide();
    			$('#fecha_inicio,#fecha_limite').attr('aria-required',false);					
				$('#fecha_inicio,#fecha_limite').val('0000-00-00');								
				
			}			
				
			
		});
	</script>

<?php

}


if(!$datos_tarea[0]['cod_padre']){
?>
<script>
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#well_<?php echo($_REQUEST['idtareas_listado']);?>",parent.document).addClass("documento_actual").addClass("alert-info");
</script>
<?php
}	
?>

<?php


function autocompletar_listado_tareas() {
	global $ruta_db_superior;
	global $raiz_saia;
	global $datos_tarea;
	$raiz_saia = $ruta_db_superior;
	

			
		$lista_editar=$datos_tarea[0]["listado_tareas_fk"];
			
		if($lista_editar==-1){		
			$id=$lista_editar;	
			$descripcion = '<b>Lista:</b> Sin lista asignada a&uacute;n';
			$cadena = "<table id='informacion_buscar_radicado_listado_tareas'><tr id='fila_listado_tareas_" . $id . "'><td>" . $descripcion . "</td><td><img style='cursor:pointer' src='" . $ruta_db_superior . "imagenes/eliminar_nota.gif' registro='" . $id . "' onclick='eliminar_asociado_listado_tareas(" . $id . ");'></td></tr></table>";			
		}else{
			$listado_tareas=busca_filtro_tabla("idlistado_tareas,nombre_lista","listado_tareas","idlistado_tareas=".$lista_editar,"",$conn);			
			$id=$lista_editar;	
			$descripcion = '<b>Lista:</b> ' . $listado_tareas[0]['nombre_lista'];
			$cadena = "<table id='informacion_buscar_radicado_listado_tareas'><tr id='fila_listado_tareas_" . $id . "'><td>" . $descripcion . "</td><td><img style='cursor:pointer' src='" . $ruta_db_superior . "imagenes/eliminar_nota.gif' id='icono_eliminar_".$lista_editar."' registro='" . $id . "' onclick='eliminar_asociado_listado_tareas(" . $id . ");'></td></tr></table>";			
		}
			


	

	?>
<style>

#informacion_buscar_radicado_listado_tareas tr td{
	font-size:10px;
}

.ac_results {
	padding: 0px;
	border: 0px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results li:hover {
	background-color: A9E2F3;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	font: menu;
	font-size: 10px;
	line-height: 10px;
	overflow: hidden;
}
</style>
<script>
$(document).ready(function(){
	
 $('[name="info_recurrencia"]').hide();	
		

  var delay = (function(){
          var timer = 0;
          return function(callback, ms){
                  clearTimeout (timer);
                  timer = setTimeout(callback, ms);
          };
  })();
  
  $("#listado_tareas_fk").hide();
  $("#listado_tareas_fk").parent().append("<input type='text' id='buscar_radicado_listado_tareas' size='50' name='buscar_radicado_listado_tareas'><div id='ul_completar_listado_tareas' class='ac_results'></div>");
  $("#buscar_radicado_listado_tareas").keyup(function (){
          if($(this).val()==0 || $(this).val()==""){
                  //alert("Ingrese Numero de Radicado");
          }else{
                  var x_valor=$(this).val();
                  delay(function(){
                          $("#ul_completar_listado_tareas").load( "autocompletar_listado_tareas.php", { nombre_lista: x_valor });
                  },500);
          }
  });
  

  $("#buscar_radicado_listado_tareas").after("<?php echo(addslashes($cadena)); ?>");
  $("#listado_tareas_fk").val("<?php echo($lista_editar); ?>");
  $("#buscar_radicado_listado_tareas").attr('readonly',true);


});
function cargar_datos_listado_tareas(iddoc,descripcion){
  $("#ul_completar_listado_tareas").empty();
  if(iddoc!=0){
          if(!$("#informacion_buscar_radicado_listado_tareas").length){
                  $("#buscar_radicado_listado_tareas").after("<table id='informacion_buscar_radicado_listado_tareas'></table>");
          }
          $("#informacion_buscar_radicado_listado_tareas").append("<tr id='fila_listado_tareas_"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_listado_tareas("+iddoc+");'></td></tr>");
          
       
          $("#listado_tareas_fk").val(iddoc);
          
          $("#buscar_radicado_listado_tareas").val("");
          $("#buscar_radicado_listado_tareas").attr('readonly',true);
          
        
  }else{
          $("#buscar_radicado_listado_tareas").val("");
  }
};
function eliminar_asociado_listado_tareas(iddoc){
  $("#fila_listado_tareas_"+iddoc).remove();
  $("#listado_tareas_fk").val('');
  $("#buscar_radicado_listado_tareas").attr('readonly',false);
}



</script>
<?php
}





function autocompletar_listado_tareas_rapidas() {
	global $ruta_db_superior;
	global $raiz_saia;
	global $datos_tarea;
	$raiz_saia = $ruta_db_superior;
	

			
		$lista_editar=$datos_tarea[0]["listado_tareas_fk"];
			
		if($lista_editar==-1){		
			$id=$lista_editar;	
			$descripcion = '<b>Lista:</b> Sin lista asignada a&uacute;n';
			$cadena = "<table id='informacion_buscar_radicado_listado_tareas'><tr id='fila_listado_tareas_" . $id . "'><td>" . $descripcion . "</td><td><img style='cursor:pointer' src='" . $ruta_db_superior . "imagenes/eliminar_nota.gif' registro='" . $id . "' onclick='eliminar_asociado_listado_tareas(" . $id . ");'></td></tr></table>";			
		}else{
			$listado_tareas=busca_filtro_tabla("idlistado_tareas,nombre_lista","listado_tareas","idlistado_tareas=".$lista_editar,"",$conn);			
			$id=$lista_editar;	
			$descripcion = '<b>Lista:</b> ' . $listado_tareas[0]['nombre_lista'];
			$cadena = "<table id='informacion_buscar_radicado_listado_tareas'><tr id='fila_listado_tareas_" . $id . "'><td>" . $descripcion . "</td><td><img style='cursor:pointer' src='" . $ruta_db_superior . "imagenes/eliminar_nota.gif' id='icono_eliminar_".$lista_editar."' registro='" . $id . "' onclick='eliminar_asociado_listado_tareas(" . $id . ");'></td></tr></table>";			
		}
			


	

	?>
<style>

#informacion_buscar_radicado_listado_tareas tr td{
	font-size:10px;
}

.ac_results {
	padding: 0px;
	border: 0px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
}

.ac_results li:hover {
	background-color: A9E2F3;
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	font: menu;
	font-size: 10px;
	line-height: 10px;
	overflow: hidden;
}
</style>
<script>
$(document).ready(function(){
	
 $('[name="info_recurrencia"]').hide();	
		

  var delay = (function(){
          var timer = 0;
          return function(callback, ms){
                  clearTimeout (timer);
                  timer = setTimeout(callback, ms);
          };
  })();
  
  $("#listado_tareas_fk").hide();
  $("#listado_tareas_fk").parent().append("<input type='text' id='buscar_radicado_listado_tareas' size='50' name='buscar_radicado_listado_tareas'><div id='ul_completar_listado_tareas' class='ac_results'></div>");
  $("#buscar_radicado_listado_tareas").keyup(function (){
          if($(this).val()==0 || $(this).val()==""){
                  //alert("Ingrese Numero de Radicado");
          }else{
                  var x_valor=$(this).val();
                  delay(function(){
                          $("#ul_completar_listado_tareas").load( "autocompletar_listado_tareas_rapidas.php", { nombre_lista: x_valor });
                  },500);
          }
  });
  

  $("#buscar_radicado_listado_tareas").after("<?php echo(addslashes($cadena)); ?>");
  $("#listado_tareas_fk").val("<?php echo($lista_editar); ?>");
  $("#buscar_radicado_listado_tareas").attr('readonly',true);


});
function cargar_datos_listado_tareas(iddoc,descripcion){
  $("#ul_completar_listado_tareas").empty();
  if(iddoc!=0){
          if(!$("#informacion_buscar_radicado_listado_tareas").length){
                  $("#buscar_radicado_listado_tareas").after("<table id='informacion_buscar_radicado_listado_tareas'></table>");
          }
          $("#informacion_buscar_radicado_listado_tareas").append("<tr id='fila_listado_tareas_"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_listado_tareas("+iddoc+");'></td></tr>");
          
       
          $("#listado_tareas_fk").val(iddoc);
          
          $("#buscar_radicado_listado_tareas").val("");
          $("#buscar_radicado_listado_tareas").attr('readonly',true);
          
        
  }else{
          $("#buscar_radicado_listado_tareas").val("");
  }
};
function eliminar_asociado_listado_tareas(iddoc){
  $("#fila_listado_tareas_"+iddoc).remove();
  $("#listado_tareas_fk").val('');
  $("#buscar_radicado_listado_tareas").attr('readonly',false);
}



</script>
<?php
}









?>

