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
  	        <button type="button" class="btn btn-primary btn-mini" id="ksubmit_saia" enlace="<?php echo($ruta_db_superior); ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">
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
						<strong>Nombre</strong>
						<input type="hidden" name="bksaiacondicion_a@nombre" id="bksaiacondicion_a@nombre" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a@nombre" name="bqsaia_a@nombre" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
				  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a-nombre',this.id)">
				    Y
				  </button>
				  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a-nombre',this.id)">
				    O
				  </button>
				  <input type="hidden" name="bqsaiaenlace_a@nombre" id="bqsaiaenlace_a-nombre" value="" />
				</div>
				
				<div class="control-group">
          <label class="string required control-label" for="nro_solicitud">
						<strong>Etiqueta</strong>
						<input type="hidden" name="bksaiacondicion_a@etiqueta" id="bksaiacondicion_a@etiqueta" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a@etiqueta" name="bqsaia_a@etiqueta" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
				  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a-etiqueta',this.id)">
				    Y
				  </button>
				  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a-etiqueta',this.id)">
				    O
				  </button>
				  <input type="hidden" name="bqsaiaenlace_a@etiqueta" id="bqsaiaenlace_a-etiqueta" value="" />
				</div>
				
		<div class="control-group">
          <label class="string required control-label" for="nro_solicitud">
						<strong>Idformato</strong>
						<input type="hidden" name="bksaiacondicion_a@idformato" id="bksaiacondicion_a@idformato" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_a@idformato" name="bqsaia_a@idformato" size="50" type="text">
          </div>
        </div>
        
					<input type="hidden" name="bqtipodato" value="date|a@fecha_x,a@fecha_y">
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
        
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
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