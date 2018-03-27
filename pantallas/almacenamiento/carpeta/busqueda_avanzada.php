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
$cajas=busca_filtro_tabla("","caja","","fondo asc",$conn);
for($i=0;$i<$cajas["numcampos"];$i++){
	$opciones.='<option value="'.$cajas[$i]["idcaja"].'">'.$cajas[$i]["fondo"].' ('.$cajas[$i]["codigo"].')</option>';
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
        <legend>Filtrar carpetas</legend>  
        
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            Numero de orden
            <input type="hidden" name="bksaiacondicion_b@numero_orden" id="bksaiacondicion_b@numero_orden" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_b@numero_orden" name="bqsaia_b@numero_orden" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_b_numero_orden',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_b_numero_orden',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_b@numero_orden" id="bqsaiaenlace_b_numero_orden" value="" />
		</div>
        <br>
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            Nombre expediente
            <input type="hidden" name="bksaiacondicion_b@nombre_expediente" id="bksaiacondicion_b@nombre_expediente" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_b@nombre_expediente" name="bqsaia_b@nombre_expediente" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_b_nombre_expediente',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_b_nombre_expediente',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_b@nombre_expediente" id="bqsaiaenlace_b_nombre_expediente" value="" />
		</div>
		<br>
		
		<div class="control-group">
          <label class="string required control-label" for="nombre">
            No de tomo
            <input type="hidden" name="bksaiacondicion_b@no_tomo" id="bksaiacondicion_b@no_tomo" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_b@no_tomo" name="bqsaia_b@no_tomo" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_b_no_tomo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_b_no_tomo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_b@no_tomo" id="bqsaiaenlace_b_no_tomo" value="" />
		</div>
		<br>
		
		<div class="control-group">
          <label class="string required control-label" for="nombre">
            Codigo numero
            <input type="hidden" name="bksaiacondicion_b@codigo_numero" id="bksaiacondicion_b@codigo_numero" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_b@codigo_numero" name="bqsaia_b@codigo_numero" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_b_codigo_numero',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_b_codigo_numero',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_b@codigo_numero" id="bqsaiaenlace_b_codigo_numero" value="" />
		</div>
		<br>
		
		<div class="control-group">
          <label class="string required control-label" for="nombre">
            Fondo
            <input type="hidden" name="bksaiacondicion_b@fondo" id="bksaiacondicion_b@fondo" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_b@fondo" name="bqsaia_b@fondo" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_b_fondo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_b_fondo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_b@fondo" id="bqsaiaenlace_b_fondo" value="" />
		</div>
		<br>
		
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            No unidad conversacion
            <input type="hidden" name="bksaiacondicion_b@no_unidad_conservacion" id="bksaiacondicion_b@no_unidad_conservacion" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_b@no_unidad_conservacion" name="bqsaia_b@no_unidad_conservacion" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_b_no_unidad_conservacion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_b_no_unidad_conservacion',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_b@no_unidad_conservacion" id="bqsaiaenlace_b_no_unidad_conservacion" value="" />
		</div>
		<br>
		
		<div class="control-group">
          <label class="string required control-label" for="nombre">
            No folios
            <input type="hidden" name="bksaiacondicion_b@no_folios" id="bksaiacondicion_b@no_folios" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_b@no_folios" name="bqsaia_b@no_folios" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_b_no_folios',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_b_no_folios',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_b@no_folios" id="bqsaiaenlace_b_no_folios" value="" />
		</div>
        <br>
        
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label">Caja
            <input type="hidden" name="bksaiacondicion_idcaja" id="bksaiacondicion_idcaja" value="=">
            </label>
            <div class="controls">
              	<select name="bqsaia_idcaja" id="bqsaia_idcaja">
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