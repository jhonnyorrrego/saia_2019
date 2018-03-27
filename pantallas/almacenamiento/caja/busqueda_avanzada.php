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
        <legend>Filtrar cajas</legend>  
        
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            Fondo
            <input type="hidden" name="bksaiacondicion_a@fondo" id="bksaiacondicion_a@fondo" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_a@fondo" name="bqsaia_a@fondo" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a_fondo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a_fondo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_a@fondo" id="bqsaiaenlace_a_fondo" value="" />
		</div>
        <br>
        
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            Codigo
            <input type="hidden" name="bksaiacondicion_a@codigo" id="bksaiacondicion_a@codigo" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_a@codigo" name="bqsaia_a@codigo" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a_codigo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a_codigo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_a@codigo" id="bqsaiaenlace_a_codigo" value="" />
		</div>
		<br>
		
		<div class="control-group">
          <label class="string required control-label" for="nombre">
            No carpetas
            <input type="hidden" name="bksaiacondicion_a@no_carpetas" id="bksaiacondicion_a@no_carpetas" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_a@no_carpetas" name="bqsaia_a@no_carpetas" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a_no_carpetas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a_no_carpetas',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_a@no_carpetas" id="bqsaiaenlace_a_no_carpetas" value="" />
		</div>
		<br>
		
		<div class="control-group">
          <label class="string required control-label" for="nombre">
            No cajas
            <input type="hidden" name="bksaiacondicion_a@no_cajas" id="bksaiacondicion_a@no_cajas" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_a@no_cajas" name="bqsaia_a@no_cajas" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a_no_cajas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a_no_cajas',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_a@no_cajas" id="bqsaiaenlace_a_no_cajas" value="" />
		</div>
		<br>
		
		<div class="control-group">
          <label class="string required control-label" for="nombre">
            No consecutivo
            <input type="hidden" name="bksaiacondicion_a@no_consecutivo" id="bksaiacondicion_a@no_consecutivo" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_a@no_consecutivo" name="bqsaia_a@no_consecutivo" size="50" type="text">
          </div>
        </div>
        
        <div class="btn-group" data-toggle="buttons-radio" >
		  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a_no_consecutivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a_no_consecutivo',this.id)">
		    O
		  </button>
		  <input type="hidden" name="bqsaiaenlace_a@no_consecutivo" id="bqsaiaenlace_a_no_consecutivo" value="" />
		</div>
		<br>
		
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            No correlativo
            <input type="hidden" name="bksaiacondicion_a@no_correlativo" id="bksaiacondicion_a@no_correlativo" value="like">
          </label>
          <div class="controls">
            <input id="bqsaia_a@no_correlativo" name="bqsaia_a@no_correlativo" size="50" type="text">
          </div>
        </div>
        

        
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>