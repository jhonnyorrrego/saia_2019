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
echo(librerias_validar_formulario('1.16'));
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
        <legend>Filtrar Caja</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="no_consecutivo">
			No consecutivo
			<input type="hidden" name="bksaiacondicion_a@no_consecutivo" id="bksaiacondicion_a-no_consecutivo" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a-no_consecutivo" name="bqsaia_a@no_consecutivo" size="50" type="text">
          </div>
        </div>
        
        <div class="control-group">
          <label class="string required control-label" for="fondo">
			Fondo
			<input type="hidden" name="bksaiacondicion_a@fondo" id="bksaiacondicion_a-fondo" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a-fondo" name="bqsaia_a@fondo" size="50" type="text">
          </div>
        </div>
        
        <div class="control-group">
          <label class="string required control-label" for="seccion">
			Seccion
			<input type="hidden" name="bksaiacondicion_a@seccion" id="bksaiacondicion_a-seccion" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a-seccion" name="bqsaia_a@seccion" size="50" type="text">
          </div>
        </div>
        
        <div class="control-group">
          <label class="string required control-label" for="subseccion">
			Subseccion
			<input type="hidden" name="bksaiacondicion_a@subseccion" id="bksaiacondicion_a-subseccion" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a-subseccion" name="bqsaia_a@subseccion" size="50" type="text">
          </div>
        </div>
        
        <div class="control-group">
          <label class="string required control-label" for="division">
			Division
			<input type="hidden" name="bksaiacondicion_a@division" id="bksaiacondicion_a-division" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a-division" name="bqsaia_a@division" size="50" type="text">
          </div>
        </div>
        
        <div class="control-group">
          <label class="string required control-label" for="codigo">
			Codigo
			<input type="hidden" name="bksaiacondicion_a@codigo" id="bksaiacondicion_a-codigo" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a-codigo" name="bqsaia_a@codigo" size="50" type="text">
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