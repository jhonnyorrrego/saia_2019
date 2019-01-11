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
echo(librerias_validar_formulario());
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
        <legend>Filtrar hoja de vida</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			Nombres
			<input type="hidden" name="bksaiacondicion_nombres" id="bksaiacondicion_nombres" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_nombres" name="bqsaia_nombres" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_nombres',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_nombres',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_nombres" id="bqsaiaenlace_nombres" value="" />
		</div>
        <br>
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			Documento
			<input type="hidden" name="bksaiacondicion_documento_identidad" id="bksaiacondicion_documento_identidad" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_documento_identidad" name="bqsaia_documento_identidad" size="50" type="text">
          </div>
        </div>
        <!--div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_documento_identidad',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_documento_identidad',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_documento_identidad" id="bqsaiaenlace_documento_identidad" value="" />
		</div>
        <br-->
        
        <!--div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Tipo de identificaci&oacute;n
            <input type="hidden" name="bksaiacondicion_tipo_documento" id="bksaiacondicion_tipo_documento" value="=">
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_tipo_documento1" name="bqsaia_tipo_documento" type="radio" value="1">C&eacute;dula de ciudadan&iacute;a
              </label>
              <br>
              <label class="radio inline">
              <input class="radio_buttons optional" id="bqsaia_tipo_documento2" name="bqsaia_tipo_documento" type="radio" value="2">Tarjeta de identidad
              </label>
              <br>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_tipo_documento3" name="bqsaia_tipo_documento" type="radio" value="3">C&eacute;dula de extranger&iacute;a
              </label>
            </div>          
          </div> 
        </div--> 
        
        
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>