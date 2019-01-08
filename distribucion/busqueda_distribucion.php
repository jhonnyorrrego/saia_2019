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
echo(librerias_arboles());
echo(estilo_bootstrap()); 
global $conn;


?>
<!DOCTYPE html>     
<html>
  <body>
 	<br>
    <div class="container master-container">
        <legend>Filtrar Distribuciones</legend>  
		<div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" >  
       	
        <div class="control-group">
          <label class="string required control-label" for="bksaiacondicion_b@numero">
			<b>N&uacute;mero radicación:</b>
			<input type="hidden" name="bksaiacondicion_b@numero" id="bksaiacondicion_b@numero" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_b@numero" name="bqsaia_b@numero" size="50" type="text">
            <input type="hidden" name="bqsaiaenlace_@numero" id="bqsaiaenlace_b@numero" value="y">
          </div>
        </div>
        
        <div class="control-group">
          <label class="string required control-label" for="numero">
            <b>N&uacute;mero de Distribuci&oacute;n:</b>
            <input type="hidden" name="bksaiacondicion_a@numero_distribucion" id="bksaiacondicion_a@numero_distribucion" value="=">
          </label>
          <div class="controls">
            <input id="bqsaia_a@numero_distribucion" name="bqsaia_a@numero_distribucion" size="50" type="text">
            <input type="hidden" name="bqsaiaenlace_a@numero_distribucion" id="bqsaiaenlace_a@numero_distribucion" value="y">
          </div>
        </div> 
        
         <strong>Entre las fechas</strong>
            
        <div class="controls">
        	<input type="hidden" name="bksaiacondicion_b@fecha_x" id="bksaiacondicion_b@fecha_x" value=">=">
            <input id="bqsaia_b_fecha_x" name="bqsaia_b@fecha_x" style="width:100px" type="text" value="" placeholder="Inicio">
            <?php selector_fecha("bqsaia_b_fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../",""); ?>
            <input type="hidden" name="bqsaiaenlace_b@fecha_x" id="bqsaiaenlace_b@fecha_x" value="y" />
            
            &nbsp;&nbsp;y&nbsp;&nbsp;
            
            <input type="hidden" name="bksaiacondicion_b@fecha_y" id="bksaiacondicion_b@fecha_y" value="<=">
            <input id="bqsaia_b_fecha_y" name="bqsaia_b@fecha_y" style="width:100px" type="text" value="" placeholder="Fin">
            <?php selector_fecha("bqsaia_b_fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../",""); ?>
       		<input type="hidden" name="bqsaiaenlace_b@fecha_y" id="bqsaiaenlace_b@fecha_y" value="y" />
       		
        </div>
        

		<br>
		
		<?php 
			$rutas_distribucion=busca_filtro_tabla("idft_ruta_distribucion,nombre_ruta","ft_ruta_distribucion a, documento b"," a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' ","",$conn);
			
			$select_rutas='<select id="select_rutas_distribucion">';
			$select_rutas.='<option value=""  selected>Seleccione...</option>';
			for($i=0;$i<$rutas_distribucion['numcampos'];$i++){
				$select_rutas.='
					<option value="'.$rutas_distribucion[$i]['idft_ruta_distribucion'].'">
						'.$rutas_distribucion[$i]['nombre_ruta'].'
					</option>
				';				
			}
			$select_rutas.='</select>';
		?>
		
        <div class="control-group">
          <label class="string required control-label" for="lista_dependencia">
            <b>Rutas de Distribucion:</b>
            
          </label>
          <div class="controls">
          		<?php echo($select_rutas); ?>
          		
          	<input type="hidden" name="variable_busqueda" id="variable_busqueda" value="">


          </div>
          <script>
          	$(document).ready(function(){
          		$('#select_rutas_distribucion').change(function(){
          			var valor=$(this).val();
          			$('#variable_busqueda').val('idft_ruta_distribucion|'+valor);
          		});
          	});
          </script>

        </div> 		
		
		<br>


        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label"><b>Tipo</b>
            <input type="hidden" name="bksaiacondicion_a@tipo_origen" id="bksaiacondicion_a-tipo_origen" value="=">
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_a-tipo_origen" name="bqsaia_a@tipo_origen" type="radio" value="1">Interno
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_a-tipo_origen2" name="bqsaia_a@tipo_origen" type="radio" value="2">Externo
              </label>
            </div>          
          </div> 
      </div>
      
	<br>
        <div class="form-actions">    
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="bqtipodato" value="date|b@fecha_x,b@fecha_y">       
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">

          <button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>    
          <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
        </div>
      </form>
    </div>  
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</html>
<?php
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
?>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
    	$("#ksubmit_saia").click();
    }
});

</script>
</html>