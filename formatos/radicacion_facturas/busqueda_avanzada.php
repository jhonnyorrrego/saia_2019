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
include_once($ruta_db_superior."assets/librerias.php");
include_once($ruta_db_superior."calendario/calendario.php");
echo(librerias_html5());
echo(jquery());
echo(librerias_arboles());
echo(bootstrap()); 
if($_REQUEST['info_externo']){
	$adicional='?info_externo=1';
}
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
  	        <button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="<?php echo($ruta_db_superior); ?>pantallas/busquedas/procesa_filtro_busqueda.php<?php echo($adicional); ?>" titulo="Resultado">
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
    	<br>
       <form accept-charset="UTF-8" id="kformulario_saia" name="kformulario_saia" method="post" >
        <legend>Filtrar</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="nro_solicitud">
						<strong>Radicado</strong>
						<input type="hidden" name="bksaiacondicion_a@numero" id="bksaiacondicion_a@numero" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_a@numero" name="bqsaia_a@numero" size="50" type="text">
          </div>
        </div>

				<div class="control-group">
		          <label class="string required control-label" for="nombre">
					<strong>Nombre del remitente</strong>
					<input type="hidden" name="bksaiacondicion_b@nombre" id="bksaiacondicion_b@nombre" value="like">
		          </label>
		          <div class="controls">
		            <input id="bqsaia_nombre_b@nombre" name="bqsaia_b@nombre" size="50" type="text">
		          </div>
       		 </div>
       		 
       		 
       		 <div class="control-group">
		          <label class="string required control-label" for="nombre">
					<strong>Nit / Cédula del remitente</strong>
					<input type="hidden" name="bksaiacondicion_b@identificacion" id="bksaiacondicion_b@identificacion" value="like">
		          </label>
		          <div class="controls">
		            <input id="bqsaia_nombre_b@identificacion" name="bqsaia_b@identificacion" size="50" type="text">
		          </div>
       		 </div>
        		
        			<!--Filtro para tipo-->			
			<div class="row">
	          <div class="control-group radio_buttons span4">
	            <label class="radio_buttons optional control-label"><strong>Clasificacion</strong>
	            <input type="hidden" name="bksaiacondicion_b@clasificacion_fact" id="bksaiacondicion_b@clasificacion_fact" value="=">
	            </label>
	            <div class="controls">
	              <label class="radio inline">
	                <input class="radio_buttons optional" id="bqsaia_b@clasificacion_fact1" name="bqsaia_b@clasificacion_fact" type="radio" value="1">Orden de Compra
	              </label>
	              <label class="radio inline">
	                <input class="radio_buttons optional" id="bqsaia_b@clasificacion_fact2" name="bqsaia_b@clasificacion_fact" type="radio" value="2">Contrato
	              </label>
	              <label class="radio inline">
	                <input class="radio_buttons optional" id="bqsaia_b@clasificacion_fact3" name="bqsaia_b@clasificacion_fact" type="radio" value="3">Servicios públicos - Administración
	              </label>
	               <label class="radio inline">
	                <input class="radio_buttons optional" id="bqsaia_b@clasificacion_fact4" name="bqsaia_b@clasificacion_fact" type="radio" value="4">Cuenta de cobro
	              </label>
	            </div>          
	          </div> 
	      </div>
      	
      		
      		
      	<div class="row">
	          <div class="control-group radio_buttons span4">
	            <label class="radio_buttons optional control-label"><strong>Pago realizado desde</strong>
	            <input type="hidden" name="bksaiacondicion_b@pago_desde" id="bksaiacondicion_b@pago_desde" value="=">
	            </label>
	            <div class="controls">
	              <label class="radio inline">
	                <input class="radio_buttons optional" id="bqsaia_b@pago_desde1" name="bqsaia_b@pago_desde" type="radio" value="1">Gasto Cámara
	              </label>
	              <label class="radio inline">
	                <input class="radio_buttons optional" id="bqsaia_b@pago_desde2" name="bqsaia_b@pago_desde" type="radio" value="2">Convenio
	              </label>
	            </div>          
	          </div> 
	      </div>
	      
	      
	      <div class="control-group">
		          <label class="string required control-label" for="nombre">
					<strong>No. convenio</strong>
					<input type="hidden" name="bksaiacondicion_b@no_convenio" id="bksaiacondicion_b@no_convenio" value="like">
		          </label>
		          <div class="controls">
		            <input id="bqsaia_nombre_b@no_convenio" name="bqsaia_b@no_convenio" size="50" type="text">
		          </div>
       		 </div>
       		 
         <!--div class="control-group">
		         <label class="string required control-label" for="b@estado">
		<b>b@estado</b>
			         </label>
			         <div class="controls">
			           <input type="checkbox" name="estado" id="b@estado1" value="1">Recibida
			           <input type="checkbox" name="estado" id="b@estado2" value="2">En proceso
			           <input type="checkbox" name="estado" id="b@estado2" value="3">Anulada
			           <input type="checkbox" name="estado" id="b@estado2" value="4">pagada
			           <input type="checkbox" name="estado" id="b@estado2" value="5">Devuelta
			         </div>
			<input type="hidden" name="bksaiacondicion_b@estado" id="bksaiacondicion_b@estado" value="in">
			<input type="hidden" name="bqsaiaenlace_b@estado" id="bqsaiaenlace_b@estado" value="y" />    		
			<input id="bqsaia_b@estado" name="bqsaia_b@estado" size="50" type="hidden">
			<script>
			$(document).ready(function(){
				$('input[name="estado"]').click(function(){
					document.getElementById('bqsaia_b@estado').value='';
					var cadena='';
					for(i=1;i<=5;i++){
						if(document.getElementById('b@estado'+i).checked){
							cadena+=document.getElementById('b@estado'+i).value+',';
						}
					}
					document.getElementById('bqsaia_b@estado').value=cadena;	
					
				});	
			});
			</script>
       </div-->
      		
      		
      		
      
		        <div class="control-group">
		          <label class="string required control-label" for="nombre">
					<strong>No. de factura</strong>
					<input type="hidden" name="bksaiacondicion_b@num_factura" id="bksaiacondicion_b@num_factura" value="like">
		          </label>
		          <div class="controls">
		            <input id="bqsaia_nombre_b@num_factura" name="bqsaia_b@num_factura" size="50" type="text">
		          </div>
		        </div>
				
		<div class="control-group">
			<strong>Fecha de Radicación</strong><!--Filtro para fecha-->
	            <input type="hidden" name="bksaiacondicion_a@fecha_x" id="bksaiacondicion_a@fecha_x" value=">=">
	        <div class="controls">
	            <input id="bqsaia_a@fecha_x" name="bqsaia_a@fecha_x" style="width:100px" type="text" value="" placeholder="Inicio">
	            <?php selector_fecha("bqsaia_a@fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
	            <input type="hidden" name="bqsaiaenlace_a@fecha_x" id="bqsaiaenlace_a@fecha_x" value="y" />
	            &nbsp;&nbsp;y&nbsp;&nbsp;
	            <input type="hidden" name="bksaiacondicion_a@fecha_y" id="bksaiacondicion_a@fecha_y" value="<=">
	            <input id="bqsaia_a@fecha_y" name="bqsaia_a@fecha_y" style="width:100px" type="text" value="" placeholder="Fin">
	            <?php selector_fecha("bqsaia_a@fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
	        		<input type="hidden" name="bqsaiaenlace_a@fecha_y" id="bqsaiaenlace_a@fecha_y" value="y" />
	       </div>
       </div>
       
       <div class="control-group">
			<strong>Fecha Programada de Pago</strong><!--Filtro para fecha-->
	            <input type="hidden" name="bksaiacondicion_b@fecha_programada_x" id="bksaiacondicion_b@fecha_programada_x" value=">=">
	        <div class="controls">
	            <input id="bqsaia_b@fecha_programada_x" name="bqsaia_b@fecha_programada_x" style="width:100px" type="text" value="" placeholder="Inicio">
	            <?php selector_fecha("bqsaia_b@fecha_programada_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
	            <input type="hidden" name="bqsaiaenlace_b@fecha_programada_x" id="bqsaiaenlace_b@fecha_programada_x" value="y" />
	            &nbsp;&nbsp;y&nbsp;&nbsp;
	            <input type="hidden" name="bksaiacondicion_b@fecha_programada_y" id="bksaiacondicion_b@fecha_programada_y" value="<=">
	            <input id="bqsaia_b@fecha_programada_y" name="bqsaia_b@fecha_programada_y" style="width:100px" type="text" value="" placeholder="Fin">
	            <?php selector_fecha("bqsaia_b@fecha_programada_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
	        		<input type="hidden" name="bqsaiaenlace_b@fecha_programada_y" id="bqsaiaenlace_b@fecha_programada_y" value="y" />
	       </div>
       </div>
       
           <input type="hidden" name="campos_especiales" id="campos_especiales" value="ra@serie_idserib@arbol">
             
					<input type="hidden" name="bqtipodato" value="date|a@fecha_x,a@fecha_y,b@fecha_programada_x,b@fecha_programada_y">
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
        
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
  <?php 
 
  ?>
</html>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ksubmit_saia").click();
    }
});
</script>