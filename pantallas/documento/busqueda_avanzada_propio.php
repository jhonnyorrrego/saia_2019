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
						<strong>Radicado</strong>
						<input type="hidden" name="bksaiacondicion_a@numero" id="bksaiacondicion_a@numero" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a@numero" name="bqsaia_a@numero" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
				  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a-numero',this.id)">
				    Y
				  </button>
				  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a-numero',this.id)">
				    O
				  </button>
				  <input type="hidden" name="bqsaiaenlace_a@numero" id="bqsaiaenlace_a-numero" value="" />
				</div>
				
				<div class="control-group">
		<strong>Entre las fechas</strong><!--Filtro para fecha-->
            <input type="hidden" name="bksaiacondicion_a@fecha_x" id="bksaiacondicion_a@fecha_x" value=">=">
        <div class="controls">
            <input id="bqsaia_a@fecha_x" name="bqsaia_a@fecha_x" style="width:100px" type="text" value="" placeholder="Inicio">
            <?php selector_fecha("bqsaia_a@fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
            <input type="hidden" name="bqsaiaenlace_a@fecha_x" id="bqsaiaenlace_a@fecha_x" value="y" />
            &nbsp;&nbsp;y&nbsp;&nbsp;
            <input type="hidden" name="bksaiacondicion_a@fecha_y" id="bksaiacondicion_a@fecha_y" value="<=">
            <input id="bqsaia_a@fecha_y" name="bqsaia_a@fecha_y" style="width:100px" type="text" value="" placeholder="Fin">
            <?php selector_fecha("bqsaia_a@fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
        		<input type="hidden" name="bqsaiaenlace_a@fecha_y" id="bqsaiaenlace_a@fecha_y" value="y" />
        </div>
       </div>
       <div class="btn-group" data-toggle="buttons-radio" >
				  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a-fecha_y',this.id)">
				    Y
				  </button>
				  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a-fecha_y',this.id)">
				    O
				  </button>
				  <input type="hidden" name="bqsaiaenlace_a@fecha_y" id="bqsaiaenlace_a-fecha_y" value="" />
				</div>
				
				<div class="control-group">
          <label class="string required control-label" for="nro_solicitud">
						<strong>Asunto</strong>
						<input type="hidden" name="bksaiacondicion_a@descripcion" id="bksaiacondicion_a@descripcion" value="like_total">
          </label>
          <div class="controls">
            <input id="bqsaia_a@descripcion" name="bqsaia_a@descripcion" size="50" type="text">
          </div>
        </div>
        <div class="btn-group" data-toggle="buttons-radio" >
				  <button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_a-descripcion',this.id)">
				    Y
				  </button>
				  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_a-descripcion',this.id)">
				    O
				  </button>
				  <input type="hidden" name="bqsaiaenlace_a@descripcion" id="bqsaiaenlace_a-descripcion" value="" />
				</div>
<?php
$datos_option=busca_filtro_tabla("","formato A","","",$conn);
for($i=0;$i<$datos_option['numcampos'];$i++){
	$option.="<option value='".$datos_option[$i]["nombre"]."'>".ucwords(strtolower($datos_option[$i]["etiqueta"]))."</option>";
}
?>
				<div class="control-group">
          <label class="string required control-label" for="tipo_servicio">
			<strong>Formato</strong>
			<input type="hidden" name="bksaiacondicion_a@plantilla" id="bksaiacondicion_a@plantilla" value="=">
          </label>
          <div class="controls">
          	<select id="bqsaia_a@plantilla" name="bqsaia_a@plantilla">
          		<option value="">Por favor seleccione...</option>
          		<?php
          			echo $option;
          		?>
          	</select>
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