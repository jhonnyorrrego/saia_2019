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
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap()); 
echo(librerias_acciones_kaiten());
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
	        <li>
	        	<button id="adicionar_pantalla" class="btn btn-mini kenlace_saia" enlace="pantallas/ejecutor/adicionar_ejecutor.php?variable_busqueda=<?php echo(@$_REQUEST["variable_busqueda"]); ?>" titulo="Adicionar Remitentes" title="Adicionar Remitentes" destino="_self" conector="iframe" onclick=" ">Adicionar</button>
	        </li>
	      </ul>      
	    </div>
	  </div>
    <div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >
       	<br />  
        <legend>Filtrar Remitentes</legend>
        
    <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label"><b>Tipo</b>
            <input type="hidden" name="bksaiacondicion_b@tipo" id="bksaiacondicion_b@tipo" value="=">
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_b-tipo1" name="bqsaia_b@tipo" type="radio" value="1">Natural
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_b-tipo2" name="bqsaia_b@tipo" type="radio" value="2">Jur&iacute;dico
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_b-tipo2" name="bqsaia_b@tipo" type="radio" value="" checked>Ninguno
              </label>
            </div>          
          </div> 
        </div>
        
        <!--div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_estado',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_estado" id="bqsaiaenlace_estado" value="" />
		</div-->
        
          
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            <b>Nombre</b>
            <input type="hidden" name="bksaiacondicion_b@nombre" id="bksaiacondicion_b@nombre" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_b@nombre" name="bqsaia_b@nombre" size="50" type="text">
          </div>
        </div>
        
        <!--div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_b-nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_b-nombre',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_b@nombre" id="bqsaiaenlace_b-nombre" value="" />
		</div-->
		
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			<b>Identificaci&oacute;n</b>
			<input type="hidden" name="bksaiacondicion_b@identificacion" id="bksaiacondicion_b@identificacion" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_b@identificacion" name="bqsaia_b@identificacion" size="50" type="text">
          </div>
        </div>
        
        
        <div>    
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
          <input type="hidden" name="variable_busqueda" id="variable_busqueda" value="<?php echo(@$_REQUEST["variable_busqueda"]); ?>">
        </div>
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
  <?php 
  echo(librerias_bootstrap());
  ?>
</html>
<script src="<?php echo($ruta_db_superior); ?>pantallas/lib/librerias_arboles.js"></script>
<script src="<?php echo($ruta_db_superior); ?>pantallas/lib/librerias_codificacion.js"></script>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ksubmit_saia").click();
    }
});
</script>