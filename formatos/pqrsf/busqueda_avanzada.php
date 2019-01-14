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
?>
<!DOCTYPE html>     
<html>
  <body>
    <div class="container master-container">
       <form accept-charset="UTF-8" id="kformulario_saia"  method="post" > 
<!-- inicio filtro fecha creacion--> 
  <legend>BUSQUEDA AVANZADA</legend>
  		<!--NUMERO DE REQUERIMIENTO-->
  		<div class="control-group">
  			<label class="string required control-label">
  				<strong>Nro Solicitud</strong>
  				<input type="hidden" name="bksaiacondicion_a@numero" id="bksaiacondicion_a@numero" value="=">
			</label>
			 <div class="controls">
			 	<input id="bqsaia_a@numero" name="bqsaia_a@numero" size="50" type="text">
			 </div>
				</div>
				<!--ENTRE FECHAS-->
        <strong>Entre las fechas</strong>
            <input type="hidden" name="bksaiacondicion_a@fecha_x" id="bksaiacondicion_a@fecha_x" value=">=">
        <div class="controls">
            <input id="bqsaia_a@fecha_x" name="bqsaia_a@fecha_x" style="width:100px" type="text" value="" placeholder="Inicio">
            <?php selector_fecha("bqsaia_a@fecha_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
            <input type="hidden" name="bqsaiaenlace_a@fecha_x" id="bqsaiaenlace_a@fecha_x" value="y" />
            &nbsp;&nbsp;y&nbsp;&nbsp;
            <input type="hidden" name="bksaiacondicion_a@fecha_y" id="bksaiacondicion_a@fecha_y" value="<=">
            <input id="bqsaia_a@fecha_y" name="bqsaia_a@fecha_y" style="width:100px" type="text" value="" placeholder="Fin">
            <?php selector_fecha("bqsaia_a@fecha_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../",""); ?>
        </div><br>
		
		<?php  //consulta responsable
//$datos_option=busca_filtro_tabla("DISTINCT (nombres+' '+apellidos) as nombre,a.iddependencia_cargo","vfuncionario_dc a,documento b,ft_pqrsf c","c.documento_iddocumento=b.iddocumento and b.ejecutor=a.funcionario_codigo","",$conn);
$datos_option=busca_filtro_tabla("DISTINCT (F.nombres+' '+F.apellidos+' '+b.nombre) as nombre,DC.iddependencia_cargo","funcionario F, dependencia_cargo DC, ft_clasificacion_pqrsf D, dependencia b","D.responsable=DC.iddependencia_cargo AND b.iddependencia=DC.dependencia_iddependencia AND DC.funcionario_idfuncionario=F.idfuncionario ","",$conn);
for($i=0;$i<$datos_option['numcampos'];$i++){
	$option.="<option value='".$datos_option[$i]["iddependencia_cargo"]."'>".ucwords(strtolower($datos_option[$i]["nombre"]))."</option>";
}
?>
				<div class="control-group">
          <label class="string required control-label" for="tipo_servicio">
			<strong>Responsable</strong>
			<input type="hidden" name="bksaiacondicion_c@responsable" id="bksaiacondicion_c@responsable" value="=">
          </label>
          <div class="controls">
          	<select id="bqsaia_c@responsable" name="bqsaia_c@responsable">
          		<option value="">Por favor seleccione...</option>
          		<?php
          			echo $option;
          		?>
          	</select>
          </div>
        </div>
        
				
		<div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label"><b>Tipo</b>
            <input type="hidden" name="bksaiacondicion_ft@tipo" id="bksaiacondicion_a-estado" value="=">
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_a-estado1" name="bqsaia_ft@tipo" type="radio" value="1">Peticion
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_a-estado2" name="bqsaia_ft@tipo" type="radio" value="2">Queja
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_a-estado3" name="bqsaia_ft@tipo" type="radio" value="3">Reclamo
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_a-estado4" name="bqsaia_ft@tipo" type="radio" value="4">Sugerencias
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_a-estado5" name="bqsaia_ft@tipo" type="radio" value="5">Felicitaciones
              </label>
            </div>          
          </div> 
      </div><br>
        

 <!--busqueda por tipo-->
	<div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label"><b>Estado</b>
            <input type="hidden" name="bksaiacondicion_ft@estado_reporte" id="bksaiacondicion_ft-estado_reporte" value="=">
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_ft-estado_reporte1" name="bqsaia_ft@estado_reporte" type="radio" value="1">Pendiente
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_ft-estado_reporte2" name="bqsaia_ft@estado_reporte" type="radio" value="2">Asignado
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_ft-estado_reporte3" name="bqsaia_ft@estado_reporte" type="radio" value="3">Entregado
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="bqsaia_ft-estado_reporte4" name="bqsaia_ft@estado_reporte" type="radio" value="4">Verificado
              </label>
            </div>          
          </div> 
      </div><br>
        
		
        <input type="hidden" name="bqsaiaenlace_a@fecha_y" id="bqsaiaenlace_a@fecha_y" value="y" />
        <div class="control-group">
        	
	        
        <div class="form-actions">    
          <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo@$_REQUEST["idbusqueda_componente"]; ?>">
          <input type="hidden" name="bqtipodato" value="date|a@fecha_x,a@fecha_y">
          <input type="hidden" name="bqsaiaenlace_ft@tipo" id="bqsaiaenlace_a-estado" value="" />
          <input type="hidden" name="bqsaiaenlace_ft@estado_reporte" id="bqsaiaenlace_ft-estado_reporte" value="" />
          <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
           <input type="hidden" name="campos_especiales" id="campos_especiales" value="cliente_backup@arbol">
          <button type="button" class="btn btn-primary" id="ksubmit_saia" enlace="<?php echo($ruta_db_superior); ?>pantallas/busquedas/procesa_filtro_busqueda.php" titulo="Resultado">Buscar</button>
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
</html>