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
include_once($ruta_db_superior."calendario/calendario.php");
include_once($ruta_db_superior."librerias_saia.php");

echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(estilo_bootstrap());
	global $raiz_saia;
	$raiz_saia=$ruta_db_superior;
echo(librerias_notificaciones());

?>
<!DOCTYPE html>     
<html>
  <head>
  </head>
  <body>
  	

    <div class="container master-container">
        <legend>Filtrar Reporte</legend>  
		<div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  


<!-- ENTRE FECHAS -->           

<!-- FECHA ENTREGA -->           
        <br>
        <div class="control-group">
        	<label class="string required control-label" for="fecha_real_fin">
        		<b>Entre las Fechas:</b>
        	</label>
        	<input type="hidden" name="bksaiacondicion_a@fecha_inicio_x" id="bksaiacondicion_a@fecha_inicio_x" value=">=">
        	<div class="controls">
        		<input id="bqsaia_a@fecha_inicio_x" name="bqsaia_a@fecha_inicio_x" id="fecha_x" style="width:100px" type="text" value="" placeholder="Inicio">
        		<?php selector_fecha("bqsaia_a@fecha_inicio_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
        		<input type="hidden" name="bqsaiaenlace_a@fecha_inicio_x" id="bqsaiaenlace_a@fecha_inicio_x" value="y" />
        		&nbsp;&nbsp;y&nbsp;&nbsp;
        		<input type="hidden" name="bksaiacondicion_a@fecha_inicio_y" id="bksaiacondicion_a@fecha_inicio_y" value="<=">
        		<input id="bqsaia_a@fecha_inicio_y" name="bqsaia_a@fecha_inicio_y" style="width:100px" type="text" value="" placeholder="Fin" id="fecha_y">
        		<?php selector_fecha("bqsaia_a@fecha_inicio_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
        	</div>
        	
        	  <input type="hidden" name="bqsaiaenlace_a@fecha_inicio_y" id="bqsaiaenlace_a@fecha_inicio_y" value="y" />
        	
        </div>

<!-- FIN FECHA ENTREGA -->   

<!-- FIN ENTRE FECHAS  --> 




<!-- FUNCIONARIO -->
        <div class="control-group">
          <label class="string required control-label" for="descripcion">
			<b>Funcionarios:</b>
			<input type="hidden" name="bksaiacondicion_a@funcionario_idfuncionario" id="bksaiacondicion_a@funcionario_idfuncionario" value="=">
          </label>
          <div class="controls">
            <input type="text" id="bqsaia_idfuncionario" name="bqsaia_a@funcionario_idfuncionario" />
            <input type="hidden" name="bqsaiaenlace_a@funcionario_idfuncionario" id="bqsaiaenlace_a@funcionario_idfuncionario" value="y">
            <?php
			autocompletar_funcionarios("bqsaia_idfuncionario","pantallas/tareas_listado/autocompletar_funcionarios.php",1);
			?>
            
          </div>
        </div>
<!-- FIN FUNCIONARIO -->

<!-- MACROPROCESO -->
        <div class="control-group">
          <label class="string required control-label" for="bqsaia_c@macro_proceso">
			<b>Macroproceso/Proceso:</b>
			<input type="hidden" name="bksaiacondicion_c@macro_proceso" id="bksaiacondicion_c@macro_proceso" value="=">
			<input type="hidden" name="bqsaiaenlace_c@macro_proceso" id="bqsaiaenlace_c@macro_proceso" value="y" />   
			
          </label>
          <div class="controls">
            <input id="bqsaia_macro_proceso" name="bqsaia_c@macro_proceso" size="50" type="text">
          </div>
        </div>
        <?php autocompletar_macro_proceso(); ?>
<!-- FIN MACROPROCESO -->

<!-- LISTADO -->
        <div class="control-group">
          <label class="string required control-label" for="bksaiacondicion_b@listado_tareas_fk">
			<b>listado:</b>
			<input type="hidden" name="bksaiacondicion_b@listado_tareas_fk" id="bksaiacondicion_b@listado_tareas_fk" value="=">
			<input type="hidden" name="bqsaiaenlace_b@listado_tareas_fk" id="bqsaiaenlace_b@listado_tareas_fk" value="y" />   
			
          </label>
          <div class="controls">
            <input id="bqsaia_listado_tareas" name="bqsaia_b@listado_tareas_fk" size="50" type="text">
          </div>
        </div>
        <?php autocompletar_listado_tareas(); ?>
<!-- FIN LISTADO -->




        <div class="form-actions">          	
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
          <input type="hidden" name="variable_busqueda" id="variable_busqueda" value="1">
          <input type="hidden" name="bqtipodato" value="date|a@fecha_inicio_x,a@fecha_inicio_y">
           
          <button type="submit" class="btn btn-primary" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>    
          <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
        </div>
      </form>
    </div>  
  </body>
  
</html> 
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ksubmit_saia").click();
    }
});
</script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_v1.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script>
   
    $('#kformulario_saia').validate({
       submitHandler: function() {
           
           var ejecutar=1;
           if( !$('#bqsaia_idfuncionario').val() ){
               ejecutar=0;
               notificacion_saia('Debe seleccionar un funcionario','warning','',4000);
           }
           if(ejecutar){
              var enlace = $("#ksubmit_saia").attr('enlace');
              $.ajax({      
            	  async: false,
            	  url: enlace,
            	  data:$("#kformulario_saia").serialize(),
            	  type:"post",	  
            	  dataType:"json",
            	  success: function(data) {        
            		 if(data.exito){
            		 	 enlace=data.url;		 
            		 } 
            		 else {
            		 	alert(data.mensaje);
                  enlace='';
            		 }
            	  }
            	});	
              if(enlace!=''){
                var titulo = $("#ksubmit_saia").attr('titulo');
                var conector = "iframe";
                var ancho_columna =  $("#ksubmit_saia").attr('ancho_columna');    
                if(!ancho_columna || ancho_columna=="undefined"){
                  ancho_columna="100%";
                }
                var datos_pantalla = { kConnector:conector, url:enlace, kTitle:titulo , kWidth: ancho_columna} ;   
                parent.crear_pantalla_busqueda(datos_pantalla);
              }  
           }    
              
        }
    });
    
 
    
    
    
</script>

 
<?php

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


function autocompletar_macro_proceso(){
    global $conn,$ruta_db_superior;
    ?>
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
				$("#buscar_macro").attr("readonly",true);
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
			$("#buscar_macro").attr("readonly",false);
	}
	
	//---------------- TERMINA AUTOCOMPLETAR---------------------//
	</script>
    <?php
}



function autocompletar_listado_tareas(){
    global $conn,$ruta_db_superior;
    ?>
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
		
	$("#bqsaia_listado_tareas").hide();
	$("#bqsaia_listado_tareas").parent().append("<input type='text' id='buscar_listado' size='50' name='buscar_listado'><div id='ul_completar_listado' class='ac_results'></div>");
	$("#buscar_listado").keyup(function (){
	  delay(function(){
      var valor=$("#buscar_listado").val();
      var macro_proceso=$('#bqsaia_macro_proceso').val();
      if(valor==0 || valor==""){
        
      }else{
        $("#ul_completar_listado").empty().load( "<?php echo($ruta_db_superior); ?>pantallas/tareas_listado/autocompletar_tareas_tiempos_registrados.php", { nombre_lista:valor,macro_proceso:macro_proceso});
      }
    }, 500 );
	});
	

	});
	


	
	function cargar_datos_listado(iddoc,descripcion){
		$("#ul_completar_listado").empty();
    if(!$("#informacion_buscar_radicado_listado").length){
      $("#buscar_listado").after("<br/><table style='font-size:10px;'  id='informacion_buscar_radicado_listado'></table>");
    }
		if(iddoc!=0){
			$("#informacion_buscar_radicado_listado").append("<tr id='fila_"+iddoc+"' opt='"+iddoc+"'><td>"+descripcion+"</td><td><img style='cursor:pointer' src='<?php echo($ruta_db_superior); ?>imagenes/eliminar_nota.gif' registro='"+iddoc+"' onclick='eliminar_asociado_listado("+iddoc+");'></td></tr>");
			if($("#bqsaia_listado_tareas").val()!=''){
				$("#bqsaia_listado_tareas").val($("#bqsaia_listado_tareas").val()+","+iddoc);
			}else{
				$("#bqsaia_listado_tareas").val(iddoc);
			}
		}
    $("#buscar_listado").val("");
  }
  
	function eliminar_asociado_listado(iddoc){
		$("#informacion_buscar_radicado_listado #fila_"+iddoc).remove();
		var datos=$("#bqsaia_listado_tareas").val().split(",");
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
		$("#bqsaia_listado_tareas").val(datos_guardar);
	}
	
	//---------------- TERMINA AUTOCOMPLETAR---------------------//
	</script>
    <?php
}


?>