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
echo(librerias_notificaciones());
?>
<!DOCTYPE html>     
<html>
  <head>
  </head>
  <body>
  	

    <div class="container master-container">
        <legend>Filtrar requerimientos</legend>  
		<div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  

<!-- FECHA CIERRE -->           


		<div class="control-group">
				<label class="control-label" for="variable_busqueda">Fecha de cierre*:</label>
				<div class="controls">
					<div id="datetimepicker1" class="input-append">
    					<input data-format="yyyy-MM-dd" id="variable_busqueda" name="variable_busqueda" type="text" class="required" value="<?php echo(date('Y-m-d')); ?>"></input>
    					<span class="add-on">
      					<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
    					</span>
  					</div>
				</div>
		</div>

<!-- FIN FECHA CIERRE -->            

 

<!-- FUNCIONARIO -->
        <div class="control-group">
          <label class="string required control-label" for="descripcion">
			<b>Funcionarios:</b>
			<input type="hidden" name="bksaiacondicion_a@idfuncionario" id="bksaiacondicion_a@idfuncionario" value="in">
          </label>
          <div class="controls">
            <input type="text" id="bqsaia_idfuncionario" name="bqsaia_a@idfuncionario" />
            <input type="hidden" name="bqsaiaenlace_a@idfuncionario" id="bqsaiaenlace_a@idfuncionario" value="y">
            <?php
			autocompletar_funcionarios("bqsaia_idfuncionario","pantallas/tareas_listado/autocompletar_funcionarios.php",0);
			?>
            
          </div>
        </div>
<!-- FIN FUNCIONARIO -->



        <div class="form-actions">          	
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
           

           
          <button type="submit" class="btn btn-primary" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>    
          <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
        </div>
      </form>
    </div>  
  </body>
  
</html> 
<?php
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
?>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
    	$("#ksubmit_saia").click();
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

?>

<script>

$("#ksubmit_saia").live('click', function (){
	var enlace = $(this).attr('enlace');
	
	if( $('#variable_busqueda').val()!='' ){
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
	    var titulo = $(this).attr('titulo');
	    var conector = "iframe";
	    var ancho_columna = $(this).attr('ancho_columna');    
	    if(!ancho_columna || ancho_columna=="undefined"){
	      ancho_columna="100%";
	    }
	    var datos_pantalla = { kConnector:conector, url:enlace, kTitle:titulo , kWidth: ancho_columna} ;   
	    parent.crear_pantalla_busqueda(datos_pantalla);
	  } 		
	}else{
		notificacion_saia('<span style="color:white;">Debe ingresar una fecha de cierre valida</span>','error','',4000);
	}
 
});


		$('#datetimepicker1').datetimepicker({
			language: 'es',
			pick12HourFormat: true,
			pickTime: false
		});

</script>