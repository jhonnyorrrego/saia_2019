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
$modulos_padres=busca_filtro_tabla("","modulo","cod_padre=0 or cod_padre is null","",$conn);
for($i=0;$i<$modulos_padres["numcampos"];$i++){
	$opciones.='<option value="'.$modulos_padres[$i]["idmodulo"].'">'.$modulos_padres[$i]["etiqueta"].' ('.$modulos_padres[$i]["nombre"].')</option>';
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
        <legend>Filtrar modulos</legend>  
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
            	Etiqueta
            	<input type="hidden" name="bksaiacondicion_etiqueta" id="bksaiacondicion_etiqueta" value="like">
            </label>
            <div class="controls">
            	<input id="bqsaia_etiqueta" name="bqsaia_etiqueta" size="50" type="text">
          	</div>        
          </div> 
        </div>  
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_etiqueta',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_etiqueta',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_etiqueta" id="bqsaiaenlace_etiqueta" value="" />
		</div>
		<br>
		<div class="row">
          <div class="control-group radio_buttons span4">
            <label class="string required control-label" for="nombre">
            	Enlace
            	<input type="hidden" name="bksaiacondicion_enlace" id="bksaiacondicion_enlace" value="like">
            </label>
            <div class="controls">
            	<input id="bqsaia_enlace" name="bqsaia_enlace" size="50" type="text">
          	</div>        
          </div> 
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_enlace',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_enlace',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_enlace" id="bqsaiaenlace_enlace" value="" />
		</div>
		<br>
        
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Padre
            <input type="hidden" name="bksaiacondicion_cod_padre" id="bksaiacondicion_cod_padre" value="=">
            </label>
            <div class="controls">
              	<select name="bqsaia_cod_padre" id="bqsaia_cod_padre">
              		<option value="">Seleccione...</option>
              		<?php
              		echo $opciones;
              		?>
              	</select>
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