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
include_once($ruta_db_superior."calendario/calendario.php"); 
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap()); 

global $conn;
$datos_option=busca_filtro_tabla("distinct tipo_servicio","temp_citas_ejecutadas","","tipo_servicio",$conn);
for($i=0;$i<$datos_option['numcampos'];$i++){
	$option.="<option value='".$datos_option[$i][0]."'>".ucwords(strtolower($datos_option[$i][0]))."</option>";
}
?>    
<!DOCTYPE html>     
<html>
  <head>
  </head>
  <body>
    <div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  
        <br/><legend>FILTRAR POR TIPO SERVICIO</legend>  
        
        <div class="control-group">
          <label class="string required control-label" for="tipo_servicio">
			Tipo Servicio
			<input type="hidden" name="bksaiacondicion_tipo_servicio" id="bksaiacondicion_tipo_servicio" value="=">
          </label>
          <div class="controls">
          	<select id="bqsaia_tipo_servicio" name="bqsaia_tipo_servicio">
          		<?php
          			echo $option;
          		?>
          	</select>
          </div>
        </div>
        <input type="hidden" name="bqsaiaenlace_tipo_servicio" id="bqsaiaenlace_tipo_servicio" value="" />
        
    
		<div class="form-actions">    
      <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo(@$_REQUEST["idbusqueda_componente"]); ?>">
      <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1"> 
      <button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="../../pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>   		  
      <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
    </div>
        		
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
  <?php 
  
  echo(librerias_bootstrap());
  ?>
</html>