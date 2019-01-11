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
include_once($ruta_db_superior."calendario/calendario.php");
include_once($ruta_db_superior."pantallas/listado_tareas/librerias.php");

echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap()); 

//echo(librerias_validar_formulario());
?>    
<!DOCTYPE html>     
<html>
  <head>    
  </head>
  <body>
  	<div class="navbar navbar-fixed-top">
	    <div class="navbar-inner">                           
	      <ul class="nav pull-left">                                         
	        <li>          
	  	        <button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">
	  	        	&nbsp;Buscar&nbsp;
	  	        </button>
	        </li>                 
	        <li class="divider-vertical">
	        </li>
	        <li>                     
	  	      <input class="btn btn-danger btn-mini reset" name="commit" type="reset" value="Cancelar">                    
	        </li>
	        <li class="divider-vertical">
	        </li> 
	      </ul>      
	    </div>
	  </div>
  	
    <div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia" method="post">  
        <legend>Filtrar Tareas</legend>  
 

        <div class="control-group">
          <label class="string required control-label" for="nombre">
			Nombre de la Tarea:
			<input type="hidden" name="bksaiacondicion_a@idtareas_listado" id="bksaiacondicion_a@idtareas_listado" value="in">
			<input type="hidden" name="bqsaiaenlace_a@idtareas_listado" id="bqsaiaenlace_a@idtareas_listado" value="y" />    
          </label>
          <div class="controls">
            <input id="nombre_tarea" name="bqsaia_a@idtareas_listado" size="50" type="text">
          </div>
        </div>

        <?php $rol_filtro_responsable=array('evaluador','seguidor'); if( in_array(@$_REQUEST['rol_tareas'],$rol_filtro_responsable) ){ ?>

		<div class="control-group">
			<label class="control-label" for="etiqueta">Responsable de la Tarea:</label>
			<div class="controls">
				<input type="hidden" name="bksaiacondicion_a@responsable_tarea" id="bksaiacondicion_a@responsable_tarea" value="=">
			    <input type="hidden" name="bqsaiaenlace_a@responsable_tarea" id="bqsaiaenlace_a@responsable_tarea" value="y" /> 
				<input type="text" name="bqsaia_a@responsable_tarea" id="responsable_tarea" >
			<?php
				
				autocompletar_funcionarios("responsable_tarea","pantallas/tareas_listado/autocompletar_funcionarios.php",1);
			?>
			</div>
		</div>

        <?php } ?>
 
       <div class="control-group">
         <label class="string required control-label" for="nombre">Fecha de Inicio
         </label>
            
	        <div class="controls" >
	        	<input type="hidden" name="bksaiacondicion_a@fecha_inicio_x" id="bksaiacondicion_a@fecha_inicio_x" value=">=">
	            <input id="bqsaia_a@fecha_inicio_x" name="bqsaia_a@fecha_inicio_x" style="width:100px" type="text" value="" placeholder="Inicio">
	            <?php selector_fecha("bqsaia_a@fecha_inicio_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
	            <input type="hidden" name="bqsaiaenlace_a@fecha_inicio_x" id="bqsaiaenlace_a@fecha_inicio_x" value="y" />
	            &nbsp;&nbsp;y&nbsp;&nbsp;
	            <input type="hidden" name="bksaiacondicion_a@fecha_inicio_y" id="bksaiacondicion_a@fecha_inicio_y" value="<=">
	            <input id="bqsaia_a@fecha_inicio_y" name="bqsaia_a@fecha_inicio_y" style="width:100px" type="text" value="" placeholder="Fin">
	            <?php selector_fecha("bqsaia_a@fecha_inicio_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
	            
	             <input type="hidden" name="bqsaiaenlace_a@fecha_inicio_y" id="bqsaiaenlace_a@fecha_inicio_y" value="y" />
	        </div> 
		</div>  
 
 
       <div class="control-group">
         <label class="string required control-label" for="nombre">Fecha Vencimiento
         </label>
            
	        <div class="controls" >
	        	<input type="hidden" name="bksaiacondicion_a@fecha_limite_x" id="bksaiacondicion_a@fecha_limite_x" value=">=">
	            <input id="bqsaia_a@fecha_limite_x" name="bqsaia_a@fecha_limite_x" style="width:100px" type="text" value="" placeholder="Inicio">
	            <?php selector_fecha("bqsaia_a@fecha_limite_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
	            <input type="hidden" name="bqsaiaenlace_a@fecha_limite_x" id="bqsaiaenlace_a@fecha_limite_x" value="y" />
	            &nbsp;&nbsp;y&nbsp;&nbsp;
	            <input type="hidden" name="bksaiacondicion_a@fecha_limite_y" id="bksaiacondicion_a@fecha_limite_y" value="<=">
	            <input id="bqsaia_a@fecha_limite_y" name="bqsaia_a@fecha_limite_y" style="width:100px" type="text" value="" placeholder="Fin">
	            <?php selector_fecha("bqsaia_a@fecha_limite_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
	            
	             <input type="hidden" name="bqsaiaenlace_a@fecha_limite_y" id="bqsaiaenlace_a@fecha_limite_y" value="y" />
	        </div> 
		</div> 
		

       <div class="control-group">
         	<label class="string required control-label" for="bqsaia_a@tipo_tarea">Tipo de Tarea
        	</label>
			<div class="controls">
				<input type="hidden" name="bksaiacondicion_a@tipo_tarea" id="bksaiacondicion_a@tipo_tarea" value="=">
				<input type="hidden" name="bqsaiaenlace_a@tipo_tarea" id="bqsaiaenlace_a@tipo_tarea" value="y" />  				
				<input type="radio" name="bqsaia_a@tipo_tarea" id="tipo_tarea0" value="1">&nbsp;Personal&nbsp;
				<input type="radio" name="bqsaia_a@tipo_tarea" id="tipo_tarea1" value="2">&nbsp;Cumplimiento&nbsp;
				<input type="radio" name="bqsaia_a@tipo_tarea" id="tipo_tarea2" value="3">&nbsp;Rutinaria
			</div>
		</div> 
		
       <div class="control-group"> 
         	<label class="string required control-label" for="bqsaia_a@prioridad">Prioridad
        	</label>
			<div class="controls">
				<input type="hidden" name="bksaiacondicion_a@prioridad" id="bksaiacondicion_a@prioridad" value="=">
				<input type="hidden" name="bqsaiaenlace_a@prioridad" id="bqsaiaenlace_a@prioridad" value="y" /> 
				<input type="radio" name="bqsaia_a@prioridad" id="prioridad0" value="0">&nbsp;&nbsp;<i class="icon-flag-amarillo"></i>&nbsp;Baja&nbsp;&nbsp;
				<input type="radio" name="bqsaia_a@prioridad" id="prioridad1" value="1" >&nbsp;&nbsp;<i class="icon-flag-naranja"></i>&nbsp;Media&nbsp;&nbsp;
				<input type="radio" name="bqsaia_a@prioridad" id="prioridad2" value="2">&nbsp;&nbsp;<i class="icon-flag-morado"></i>&nbsp;Alta&nbsp;&nbsp;
				<input type="radio" name="bqsaia_a@prioridad" id="prioridad3" value="3">&nbsp;&nbsp;<i class="icon-flag-rojo"></i>&nbsp;Crítica&nbsp;&nbsp;
				<label class="error" for="bqsaia_a@prioridad"></label>
			</div>
		</div> 

       <div class="control-group">
         	<label class="string required control-label" for="bqsaia_a@estado_tarea">Estado de la Tarea
        	</label>
			<div class="controls">
				<input type="hidden" name="bksaiacondicion_a@estado_tarea" id="bksaiacondicion_a@estado_tarea" value="=">
				<input type="hidden" name="bqsaiaenlace_a@estado_tarea" id="bqsaiaenlace_a@estado_tarea" value="y" /> 
				
				<input type="radio" name="bqsaia_a@estado_tarea" id="estado_tarea0" value="PENDIENTE">&nbsp;&nbsp;PENDIENTE
				<input type="radio" name="bqsaia_a@estado_tarea" id="estado_tarea1" value="EJECUCION">&nbsp;&nbsp;EJECUCION
				<input type="radio" name="bqsaia_a@estado_tarea" id="estado_tarea2" value="STAND BY">&nbsp;&nbsp;STAND BY
				<input type="radio" name="bqsaia_a@estado_tarea" id="estado_tarea3" value="TERMINADO">&nbsp;&nbsp;TERMINADO
				<input type="radio" name="bqsaia_a@estado_tarea" id="estado_tarea4" value="CANCELADA">&nbsp;&nbsp;CANCELADA
				<label class="error" for="bqsaia_a@estado_tarea"></label>
			</div>
		</div> 
		
        <!-- div class="control-group">
          <label class="string required control-label" for="bksaiacondicion_b@macro_proceso">
			Macroproceso/Proceso:
			<input type="hidden" name="bksaiacondicion_b@macro_proceso" id="bksaiacondicion_b@macro_proceso" value="like_total">
			<input type="hidden" name="bqsaiaenlace_b@macro_proceso" id="bqsaiaenlace_b@macro_proceso" value="y" />   
			<input type="hidden" name="bqsaiaaviso" id="bqsaiaaviso" value="1" />  
          </label>
          <div class="controls">
            <input id="bqsaia_macro_proceso" name="bqsaia_b@macro_proceso" size="50" type="text">
          </div>
        </div -->


		<?php 
			/*if(@$_REQUEST['rol_tareas']=='todos'){  //solo para donde el se muestran todos los roles
		?>

        <div class="control-group">
          <label class="string required control-label" for="roles">
			Rol:
			<input type="hidden" name="condicion_rol" id="condicion_rol" value="">
			<input type="hidden" name="enlace_rol" id="enlace_rol" value="y" />   
			<input type="hidden" name="value_rol" id="value_rol" value="<?php echo(usuario_actual('idfuncionario')); ?>" />  
          </label>
          <div class="controls">
            	<input type="radio" name="roles" id="roles1" value="responsable_tarea">&nbsp;Responsable&nbsp;
            	<input type="radio" name="roles" id="roles2" value="co_participantes">&nbsp;Co-participante;
            	<input type="radio" name="roles" id="roles3" value="seguidores">&nbsp;Seguidor&nbsp;
          </div>
        </div>	
        <script>
        	$('[name="roles"]').click(function(){
       			var bqsaia_valor='bqsaia_a@';
        		var bqsaiaenlace='bqsaiaenlace_a@';
	       		var bksaiacondicion='bksaiacondicion_a@';
        		
   				$('#value_rol').attr('name',bqsaia_valor+$(this).val());
   				$('#enlace_rol').attr('name',bqsaiaenlace+$(this).val());
   				$('#condicion_rol').attr('name',bksaiacondicion+$(this).val());
   				
   				if( $(this).val()=='responsable_tarea' ){
   					$('#condicion_rol').val('=');
   				}else{
   					$('#condicion_rol').val('like_total');
   				}
   				
  
        	});
        </script>	
		
		<?php
			}*/
		?>

          <input type="hidden" name="bqtipodato" value="date|a@fecha_limite_x,a@fecha_limite_y,a@fecha_inicio_x,a@fecha_inicio_y">
          
          
          
          
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
			<input type="hidden" name="rol_tareas" id="rol_tareas" value="<?php echo($_REQUEST['rol_tareas']);?>">
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ksubmit_saia").click();
    }
});
</script>


<!-- ---------------------------------- -->

	<style>
	label.error {
		font-weight: bold;
		color: red;
	}
	.form-horizontal .control-label{
		width: 40%;
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
		
		
	//---------------- AUTOCOMPLETAR---------------------//	
	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer); 
	    timer = setTimeout(callback, ms);
	  };
	})();
		
	$("#nombre_tarea").hide();
	$("#nombre_tarea").parent().append("<input type='text' id='buscar_tarea' size='50' name='buscar_tarea'><div id='ul_completar_tarea' class='ac_results'></div>");
	$("#buscar_tarea").keyup(function (){
	  delay(function(){
      var valor=$("#buscar_tarea").val();
      if(valor==0 || valor==""){
        //alert("Ingrese nombre del macroproceso-proceso");
      }else{
        $("#ul_completar_tarea").empty().load( "<?php echo($ruta_db_superior); ?>pantallas/tareas_listado/autocompletar_tareas_listado.php", { nombre_tarea:valor,rol_tareas:'<?php echo(@$_REQUEST['rol_tareas']); ?>'});
      }
    }, 500 );
	});
	
	//---------------- TERMINA AUTOCOMPLETAR---------------------//
	});
	
	//---------------- AUTOCOMPLETAR---------------------//	

	
	function cargar_datos_tareas(iddoc,descripcion){
		$("#ul_completar_tarea").empty();
    if(!$("#informacion_buscar_radicado_tarea").length){
      $("#buscar_tarea").after("<br/><table style='font-size:10px;'  id='informacion_buscar_radicado_tarea'></table>");
    }
		if(iddoc!=0){
			$("#informacion_buscar_radicado_tarea").append("<tr id='fila_"+iddoc+"' opt='"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_tareas("+iddoc+");'></td></tr>");
			if($("#nombre_tarea").val()!=''){
				$("#nombre_tarea").val($("#nombre_tarea").val()+","+iddoc);
			}else{
				$("#nombre_tarea").val(iddoc);
			}
		}
		
		
    $("#buscar_tarea").val("");
  }
  
	function eliminar_asociado_tareas(iddoc){
		$("#informacion_buscar_radicado_tarea #fila_"+iddoc).remove();
		var datos=$("#nombre_tarea").val().split(",");
		var cantidad=datos.length;
		var nuevos_datos=new Array();
		var a=0;
		for(var i=0;i<cantidad;i++){
			if(iddoc!=datos[i]){
				nuevos_datos[a]=datos[i];
				a++;
			}
		}
		var datos_guardar=nuevos_datos.join(",");
		$("#nombre_tarea").val(datos_guardar);
	}
	
	//---------------- TERMINA AUTOCOMPLETAR---------------------//
	</script>


















