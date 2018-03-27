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
       <form accept-charset="UTF-8" action="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" id="kformulario_saia" method="post">  
        <legend>Filtrar configuracion</legend>  
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            Nombre
            <input type="hidden" name="bksaiacondicion_nombre" id="bksaiacondicion_nombre" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_nombre" name="bqsaia_nombre" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombre',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nombre" id="bqsaiaenlace_nombre" value="" />
		</div>
        <br>
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="string required control-label" for="nombre">
            	Valor
            	<input type="hidden" name="bksaiacondicion_valor" id="bksaiacondicion_valor" value="like">
            </label>
            <div class="controls">
            	<input id="bqsaia_valor" name="bqsaia_valor" size="50" type="text">
          	</div>        
          </div> 
        </div>  
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_valor',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_valor',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_valor" id="bqsaiaenlace_valor" value="" />
		</div>
		<br>
		<div class="row">
          <div class="control-group radio_buttons span4">
            <label class="string required control-label" for="nombre">
            	Tipo
            	<input type="hidden" name="bksaiacondicion_tipo" id="bksaiacondicion_tipo" value="like">
            </label>
            <div class="controls">
            	<input id="bqsaia_tipo" name="bqsaia_tipo" size="50" type="text">
          	</div>        
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