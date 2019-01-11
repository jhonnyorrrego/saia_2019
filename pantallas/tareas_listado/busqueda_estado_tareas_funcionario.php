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
			<input type="hidden" name="bksaiacondicion_b@nombre_tarea" id="bksaiacondicion_b@nombre_tarea" value="like_total">
			<input type="hidden" name="bqsaiaenlace_b@nombre_tarea" id="bqsaiaenlace_b@nombre_tarea" value="y" />    
          </label>
          <div class="controls">
            <input id="bqsaia_b@nombre_tarea" name="bqsaia_b@nombre_tarea" size="50" type="text">
          </div>
        </div>


        <div class="control-group">
          <label class="string required control-label" for="bksaiacondicion_b@macro_proceso">
			Macroproceso/Proceso:
			<input type="hidden" name="bksaiacondicion_c@macro_proceso" id="bksaiacondicion_c@macro_proceso" value="like_total">
			<input type="hidden" name="bqsaiaenlace_c@macro_proceso" id="bqsaiaenlace_c@macro_proceso" value="y" />   
			<input type="hidden" name="bqsaiaaviso" id="bqsaiaaviso" value="1" />  
          </label>
          <div class="controls">
            <input id="bqsaia_macro_proceso" name="bqsaia_c@macro_proceso" size="50" type="text">
          </div>
        </div>
        
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
			
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

	</style>
	<script>
	/*---------------- AUTOCOMPLETAR---------------------*/		
	
	$(document).ready(function(){
		
		

	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();
		
	$("#bqsaia_macro_proceso").hide();
	$("#bqsaia_macro_proceso").parent().append("<input type='text' id='buscar_macro' size='50' name='buscar_macro'><div id='ul_completar_macro' class='ac_results'></div>");
	$("#buscar_macro").keyup(function (){
	  delay(function(){
      var valor=$("#buscar_macro").val();
      if(valor==0 || valor==""){
        //alert("Ingrese nombre del macroproceso-proceso");
      }else{
        $("#ul_completar_macro").empty().load( "<?php echo($ruta_db_superior); ?>pantallas/listado_tareas/autocompletar_procesos.php", { nombre_macro:valor,opt:4});
      }
    }, 500 );
	});
	

	});
	


	
	function cargar_datos_macro(iddoc,descripcion){
		$("#ul_completar_macro").empty();
    if(!$("#informacion_buscar_radicado_macro").length){
      $("#buscar_macro").after("<br/><table style='font-size:10px;'  id='informacion_buscar_radicado_macro'></table>");
    }
		if(iddoc!=0){
			$("#informacion_buscar_radicado_macro").append("<tr id='fila_"+iddoc+"' opt='"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_macro("+iddoc+");'></td></tr>");
			if($("#bqsaia_macro_proceso").val()!=''){
				$("#bqsaia_macro_proceso").val($("#bqsaia_macro_proceso").val()+","+iddoc);
			}else{
				$("#bqsaia_macro_proceso").val(iddoc);
			}
		}
    $("#buscar_macro").val("");
  }
  
	function eliminar_asociado_macro(iddoc){
		$("#informacion_buscar_radicado_macro #fila_"+iddoc).remove();
		var datos=$("#bqsaia_macro_proceso").val().split(",");
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
		$("#bqsaia_macro_proceso").val(datos_guardar);
	}
	
	//---------------- TERMINA AUTOCOMPLETAR---------------------//
	</script>


















