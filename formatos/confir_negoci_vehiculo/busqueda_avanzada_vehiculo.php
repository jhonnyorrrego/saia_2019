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
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  
        <legend>Filtrar Vehículos</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
          	
          <div style="background-image: url(<?php echo $ruta_db_superior; ?>imagenes/placa_mediana.jpg); background-repeat:no-repeat;width:400px;height:200px">
	          <div class="control-group" style="top:10%;left:10px;">
	          	<label class="string required control-label" for="nombre">
	            	<input type="hidden" name="bksaiacondicion_placa_asignada_vehiculo" id="bksaiacondicion_placa_asignada_vehiculo" value="=">
	          	</label>
	          	<div class="controls">	            	
	            	<input id="bqsaia_placa_asignada_vehiculo" name="bqsaia_placa_asignada_vehiculo" size="50" maxlength="6" type="text" style='background-color: transparent; border: 0px solid; width: 80%; height: 50%; margin-top: 50px; margin-left: 35px; font-size: 80px; color: black; text-align: center;text-transform:uppercase;' title="Por favor, escriba el número de la Placa que desea buscar.">
	          	</div>
	        	</div>
          </div>	
        </div>         
        <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="130">
        <!--<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"];?>">-->
        <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1"> 
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
  <style>
  	.transparente  {
		  background-color: transparent;
		  border: 1px solid #000000;
		}
  </style>
  <?php 
  //echo(librerias_validar_formulario());
  echo(librerias_bootstrap());
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