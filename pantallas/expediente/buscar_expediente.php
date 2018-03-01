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
  	<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap-datetimepicker.min.css"/>
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
        <legend>Filtrar Expediente</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			<b>Nombres</b>
			<input type="hidden" name="bksaiacondicion_nombre" id="bksaiacondicion_nombre" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_nombre" name="bqsaia_nombre" size="50" type="text">
          </div>
        </div>


		<div class="control-group ">
		  <label class="string required control-label" for="bqsaia_fecha">Fecha de creaci&oacute;n
		  </label>
		  <div class="controls"> 
				<div id="fecha" class="input-append date">
					<input data-format="yyyy-MM-dd" type="text" name="bqsaia_fecha"  readonly />
					<span class="add-on">
						<i data-time-icon="icon-time" data-date-icon="icon-calendar">
						</i>
					</span>
				</div>
				<input type="hidden" name="bksaiacondicion_fecha" id="bksaiacondicion_fecha" value="=">
		  </div>
		</div>
		
		
        <div class="control-group">
          <label class="string required control-label" for="bqsaia_descripcion">
			<b>Descripci&oacute;n</b>
			<input type="hidden" name="bksaiacondicion_descripcion" id="bksaiacondicion_descripcion" value="like_total">
          </label>
          <div class="controls">
          	<textarea name="bqsaia_descripcion" id="bqsaia_descripcion"></textarea>
          </div>
        </div>		
        
        <div class="control-group">
          <label class="string required control-label" for="bqsaia_indice_uno">
			<b>Indice uno</b>
			<input type="hidden" name="bksaiacondicion_indice_uno" id="bksaiacondicion_indice_uno" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_indice_uno" name="bqsaia_indice_uno" size="50" type="text">
          </div>
        </div>
        
         <div class="control-group">
          <label class="string required control-label" for="bqsaia_indice_dos">
			<b>Indice Dos</b>
			<input type="hidden" name="bksaiacondicion_indice_dos" id="bksaiacondicion_indice_dos" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_indice_dos" name="bqsaia_indice_dos" size="50" type="text">
          </div>
        </div>
               
         <div class="control-group">
          <label class="string required control-label" for="bqsaia_indice_tres">
			<b>Indice Tres</b>
			<input type="hidden" name="bksaiacondicion_indice_tres" id="bksaiacondicion_indice_tres" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_indice_tres" name="bqsaia_indice_tres" size="50" type="text">
          </div>
        </div>
               
		<div class="control-group element">
		  <label class="control-label" for="bqsaia_fk_idcaja">Caja
		  </label>
		  <div class="controls">
		  	<input type="hidden" name="bksaiacondicion_fk_idcaja" id="bksaiacondicion_fk_idcaja" value="=">
		  	<select name="bqsaia_fk_idcaja" id="bqsaia_fk_idcaja">
		  		<option value="">Por favor seleccione...</option>
		  		<?php
		  		$cajas=busca_filtro_tabla("","caja A","","",$conn);
					for($i=0;$i<$cajas["numcampos"];$i++){
						$selected="";
						if($datos[0]["fk_idcaja"]==$cajas[$i]["idcaja"])$selected="selected";
						echo("<option value='".$cajas[$i]["idcaja"]."' ".$selected.">".$cajas[$i]["fondo"]."(".$cajas[$i]["codigo_dependencia"]."-".$cajas[$i]["codigo_serie"]."-".$cajas[$i]["consecutivo"].")</option>");
					}
		  		?>
		  	</select>
		  </div>
		</div>
        
        
        
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">

      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap-datetimepicker.js"></script>
<script>
$(document).ready(function(){
  $('#fecha').datetimepicker({
    language: 'es',
    pick12HourFormat: true,
    pickTime: false      
  });
}); 
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
        $("#ksubmit_saia").click();
    }
});
</script>
