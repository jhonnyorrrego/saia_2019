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
       <form accept-charset="UTF-8" action="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" id="kformulario_saia" method="post" >  
        <legend>Filtrar funcionarios</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			Estado rol
			<input type="hidden" name="bksaiacondicion_D@estado" id="bksaiacondicion_D@estado" value="=">
          </label>
          <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_D@estado1" name="bqsaia_D@estado" type="radio" value="1">Activo
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_D@estado2" name="bqsaia_D@estado" type="radio" value="0">Inactivo
              </label>
          </div>   
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_D@estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_D@estado',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_D@estado" id="bqsaiaenlace_D@estado" value="" />
		</div>
        <br>
        <div class="control-group">
          <label class="string required control-label" for="nombre">
			Estado cargo
			<input type="hidden" name="bksaiacondicion_C@estado" id="bksaiacondicion_C@estado" value="=">
          </label>
          
         <div class="controls">
          <label class="radio inline">
            <input class="radio_buttons optional" id="bqsaia_C@estado1" name="bqsaia_C@estado" type="radio" value="1">Activo
          </label>
          <label class="radio inline">
            <input class="radio_buttons optional" id="bqsaia_C@estado2" name="bqsaia_C@estado" type="radio" value="0">Inactivo
          </label>
      	 </div>   
       
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_C@estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_C@estado',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_C@estado" id="bqsaiaenlace_C@estado" value="" />
		</div>
		<br>
		
		
		<div class="control-group">
          <label class="string required control-label" for="nombre">
			Estado dependencia
			<input type="hidden" name="bksaiacondicion_B@estado" id="bksaiacondicion_B@estado" value="=">
          </label>
          
         <div class="controls">
          <label class="radio inline">
            <input class="radio_buttons optional" id="bqsaia_B@estado1" name="bqsaia_B@estado" type="radio" value="1">Activo
          </label>
          <label class="radio inline">
            <input class="radio_buttons optional" id="bqsaia_B@estado2" name="bqsaia_B@estado" type="radio" value="0">Inactivo
          </label>
      	 </div>   
       
        </div>
		
		<div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_B@estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_B@estado',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_B@estado" id="bqsaiaenlace_B@estado" value="" />
		</div>
		<br>
		
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Cargo
            <input type="hidden" name="bksaiacondicion_idcargo" id="bksaiacondicion_idcargo" value="=">
            </label>
            <div class="controls">
              	<select name="bqsaia_idcargo" id="bqsaia_idcargo">
              		<option value="">Seleccione...</option>
              		<?php
              		$perfiles=busca_filtro_tabla("","cargo","","",$conn);
					for($i=0;$i<$perfiles["numcampos"];$i++){
						echo '<option value="'.$perfiles[$i]["idcargo"].'">'.$perfiles[$i]["nombre"].'</option>';
					}
              		?>
              	</select>
            </div>          
          </div> 
        </div>   
        
             
    <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_idcargo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_idcargo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_idcargo" id="bqsaiaenlace_idcargo" value="" />
		</div>​
		<br>
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            Apellidos funcionario
            <input type="hidden" name="bksaiacondicion_apellidos" id="bksaiacondicion_apellidos" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_apellidos" name="bqsaia_apellidos" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_apellidos',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_apellidos',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_apellidos" id="bqsaiaenlace_apellidos" value="" />
		</div>
        <br>
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="string required control-label" for="nombre">
            	Nombres funcionario
            	<input type="hidden" name="bksaiacondicion_nombres" id="bksaiacondicion_nombres" value="like">
            </label>
            <div class="controls">
            	<input id="bqsaia_nombres" name="bqsaia_nombres" size="50" type="text">
          	</div>        
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
       
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="string required control-label" for="nombre">
            	C&oacute;digo funcionario
            	<input type="hidden" name="bksaiacondicion_funcionario_codigo" id="bksaiacondicion_funcionario_codigo" value="=">
            </label>
            <div class="controls">
            	<input id="bqsaia_funcionario_codigo" name="bqsaia_funcionario_codigo" size="50" type="text">
          	</div>        
          </div> 
        </div>  
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_funcionario_codigo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_funcionario_codigo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_funcionario_codigo" id="bqsaiaenlace_funcionario_codigo" value="" />
		</div>
        <br>
        
        
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="string required control-label" for="nombre">
            	Estado funcionario
            	<input type="hidden" name="bksaiacondicion_A@estado" id="bksaiacondicion_A@estado" value="=">
            </label>
            <div class="controls">
	          <label class="radio inline">
	            <input class="radio_buttons optional" id="bqsaia_A@estado1" name="bqsaia_A@estado" type="radio" value="1">Activo
	          </label>
	          <label class="radio inline">
	            <input class="radio_buttons optional" id="bqsaia_A@estado2" name="bqsaia_A@estado" type="radio" value="0">Inactivo
	          </label>
	      	 </div>        
          </div> 
        </div>         
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_A@estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_A@estado',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_A@estado" id="bqsaiaenlace_A@estado" value="" />
		</div>
        <br>
        
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            Login funcionario
            <input type="hidden" name="bksaiacondicion_login" id="bksaiacondicion_login" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_login" name="bqsaia_login" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_login',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_login',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_login" id="bqsaiaenlace_login" value="" />
		</div>
        <br>
        
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Dependencia
            <input type="hidden" name="bksaiacondicion_iddependencia" id="bksaiacondicion_iddependencia" value="=">
            </label>
            <div class="controls">
              	<select name="bqsaia_iddependencia" id="bqsaia_iddependencia">
              		<option value="">Seleccione...</option>
              		<?php
              		$perfiles=busca_filtro_tabla("","dependencia","","",$conn);
					for($i=0;$i<$perfiles["numcampos"];$i++){
						echo '<option value="'.$perfiles[$i]["iddependencia"].'">'.$perfiles[$i]["nombre"].'</option>';
					}
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