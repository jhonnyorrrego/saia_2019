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
include_once($ruta_db_superior . "assets/librerias.php");

echo(librerias_html5());
echo(librerias_arboles());
global $conn;
?>
<!DOCTYPE html>     
<html>
    <head>
    	<?= jquery() ?>
        <?= bootstrap() ?>
        <?= breakpoint() ?>
        <?= toastr() ?>
        <?= icons() ?>
        <?= moment() ?>
        <?= validate() ?>
        <?= librerias_html5() ?>
        <?= librerias_arboles() ?>
    	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    	<link class="main-stylesheet" href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" media="screen">
        <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" media="screen">
        <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
        
    </head>
  <body>
 	<div class=" container-fluid container-fixed-lg col-lg-8">
    	<!-- START card -->
    	<div class="card card-default">
            <div class="card-body">
            	<h6>FILTRAR DISTRIBUCIONES</h6>
            	<form accept-charset="UTF-8" id="kformulario_saia"  method="post" class="form-horizontal"> 
                   	<div class="form-group" id="tr_numero_radicacion">
                   		<label class="etiqueta_campo" for="bksaiacondicion_b@numero">N&uacute;mero radicaci&oacute;n:</label>
                   		<input type="hidden" name="bksaiacondicion_b@numero" id="bksaiacondicion_b@numero" value="=">
                   		<div class="controls">
                            <input id="bqsaia_b@numero" class="form-control" name="bqsaia_b@numero" size="50" type="text">
                            <input type="hidden" name="bqsaiaenlace_@numero" id="bqsaiaenlace_b@numero" value="y">
                      </div>
                   	</div>
                   	<div class="form-group" id="tr_numero_distribucion">
                   		<label class="etiqueta_campo" for="bksaiacondicion_a@numero_distribucion">N&uacute;mero de Distribuci&oacute;n:</label>
                   		<input type="hidden" name="bksaiacondicion_a@numero_distribucion" id="bksaiacondicion_a@numero_distribucion" value="=">
                   		<div class="controls">
                            <input id="bqsaia_a@numero_distribucion" class="form-control" name="bqsaia_a@numero_distribucion" size="50" type="text">
                            <input type="hidden" name="bqsaiaenlace_a@numero_distribucion" id="bqsaiaenlace_a@numero_distribucion" value="y">
                      </div>
                   	</div>
                   	<div class="form-group" id="tr_entre_fechas">
                   		<label class="etiqueta_campo" for="bksaiacondicion_a@numero_distribucion">Entre las fechas</label>
                   		<div class="input-daterange input-group" id="datepicker-range">
                        	<input type="hidden" name="bksaiacondicion_b@fecha_x" id="bksaiacondicion_b@fecha_x" value=">=">
                            <input type="text" class="input-sm form-control" name="bqsaia_b@fecha_x" id="bqsaia_b_fecha_x" autocomplete="off"/>
                            <input type="hidden" name="bqsaiaenlace_b@fecha_x" id="bqsaiaenlace_b@fecha_x" value="y" />
                            
                            <div class="input-group-addon"> y </div>
                            
                            <input type="hidden" name="bksaiacondicion_b@fecha_y" id="bksaiacondicion_b@fecha_y" value="<=">
                            <input type="text" class="input-sm form-control" name="bqsaia_b@fecha_y" id="bqsaia_b_fecha_y" autocomplete="off"/>
                       		<input type="hidden" name="bqsaiaenlace_b@fecha_y" id="bqsaiaenlace_b@fecha_y" value="y" />
                       		
                        </div>
                   	</div>
                   	<div class="form-group" id="tr_rutas_distribucion">
                   		<label class="etiqueta_campo" >Rutas de Distribucion:</label>
                   		<?php 
                			$rutas_distribucion=busca_filtro_tabla("idft_ruta_distribucion,nombre_ruta","ft_ruta_distribucion a, documento b"," a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' ","",$conn);
                			
                			$select_rutas='<select id="select_rutas_distribucion" class="full-width">';
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
                   		<div class="controls">
                            <?php echo($select_rutas); ?>
                            <input type="hidden" name="variable_busqueda" id="variable_busqueda" value="">
                      </div>
                   	</div>
                   	<div class="form-group">
                        <label class="etiqueta_campo">Tipo</label>
                        <input type="hidden" name="bksaiacondicion_a@tipo_origen" id="bksaiacondicion_a-tipo_origen" value="=">
                        <div class="radio radio-success">
                          <input type="radio" value="1" name="bqsaia_a@tipo_origen" id="bqsaia_a-tipo_origen">
                          <label for="bqsaia_a-tipo_origen">Interno</label>
                          <input type="radio" value="2" name="bqsaia_a@tipo_origen" id="bqsaia_a-tipo_origen2">
                          <label for="bqsaia_a-tipo_origen2">Externo</label>
                        </div>        
                      </div>
                   	<div class="form-actions">    
                      <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo @$_REQUEST["idbusqueda_componente"]; ?>">
                      <input type="hidden" name="bqtipodato" value="date|b@fecha_x,b@fecha_y">       
                      <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
            
                      <button type="button" class="btn btn-complete" id="ksubmit_saia" enlace="<?php echo $ruta_db_superior; ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>    
                      <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
                    </div>
                 </form>
             </div>
         </div>
     </div>
<script>
    $(document).ready(function(){
    	$('#select_rutas_distribucion').select2();
    	$('#select_rutas_distribucion').change(function(){
    		var valor=$(this).val();
    		$('#variable_busqueda').val('idft_ruta_distribucion|'+valor);
    	});
    	$('#datepicker-range').datepicker({language:'es'});
    });
    $(document).keypress(function(event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13') {
        	$("#ksubmit_saia").click();
        }
    });
</script>
 
  </body>
  <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
  <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
  <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js" type="text/javascript"></script>
  <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
  <script src='<?php echo($ruta_db_superior);?>js/moment.min.js'></script>
   <script src='<?php echo($ruta_db_superior);?>js/moment-es.js'></script>
</html>