<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; }
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_bootstrap());
echo(librerias_notificaciones());
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<form name="formulario_datos_ejecutor" id="formulario_datos_ejecutor">
<input type="hidden" name="ejecutor_idejecutor" id="ejecutor_idejecutor" value="<?php echo($_REQUEST["idejecutor"]);?>">
<legend>Actualizar datos al remitente</legend>
<div class="control-group element">
  <label class="control-label" for="cargo">Cargo
  </label>
  <div class="controls"> 
    <input type="text" name="cargo" id="cargo">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="empresa">Empresa
  </label>
  <div class="controls"> 
    <input type="text" name="empresa" id="empresa">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="cargo">Direcci&oacute;n
  </label>
  <div class="controls"> 
    <input type="text" name="direccion" id="direccion">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="telefono">Tel&eacute;fono
  </label>
  <div class="controls"> 
    <input type="text" name="telefono" id="telefono">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="email">Email
  </label>
  <div class="controls"> 
    <input type="text" name="email" id="email">
  </div>
</div>
<div class="control-group element">
  <label class="control-label" for="titulo">Titulo
  </label>
  <div class="controls"> 
    <select name="titulo" id="titulo">
    	<option value="Se&ntilde;or">Se&ntilde;or</option>
    	<option value="Se&ntilde;ora">Se&ntilde;ora</option>
    	<option value="Doctor">Doctor</option>
    	<option value="Doctora">Doctora</option>
    	<option value="Ingeniero">Ingeniero</option>
    	<option value="Ingeniera">Ingeniera</option>
    </select>
  </div>
</div>
<?php
$pais=busca_filtro_tabla("","pais A","","A.nombre asc",$conn);
?>
<div class="control-group element">
  <label class="control-label" for="titulo">Ciudad
  </label>
  <div class="controls"> 
    <select class="span2" name="pais" id="pais"><option value="">Seleccione...</option>
    <?php
    for($i=0;$i<$pais["numcampos"];$i++){
    	echo("<option value='".$pais[$i]["idpais"]."'>".$pais[$i]["nombre"]."</option>");
    }
    ?>
    </select>
		<select class="span2" name="departamento" id="departamento"><option value=''>Seleccione...</option></select>
		<select class="span2" id="municipios" name="ciudad" class="required"><option value=''>Seleccione...</option></select>
  </div>
</div>
<div>
<button class="btn btn-primary btn-mini" id="submit_formulario_expediente">Aceptar</button>
<button class="btn btn-mini" onclick="window.open('mostrar_datos_ejecutor.php?idejecutor=<?php echo(@$_REQUEST["idejecutor"]); ?>','_self'); return false;">Volver</button>
</div>
</form>
<script>
$(document).ready(function(){
	var formulario_remitente=$("#formulario_datos_ejecutor");
	
	$("#pais").change(function(){
		$.ajax({
		  url: 'solicitud_ciudad.php',
		  type: 'POST',
		  data: {
		  	tipo: 1,
		  	idpais: $(this).val()			  	
		  },			  
		  success: function(data) {
		  	$("#departamento").html("");			    
		    $("#departamento").append(data);
		    $("#municipios").html("<option value=''>Seleccione...</option>");
		  }
		});
	});
	$("#departamento").change(function(){
		$.ajax({
		  url: 'solicitud_ciudad.php',
		  type: 'POST',
		  data: {
		  	tipo: 2,
		  	iddepartamento: $(this).val()			  	
		  },			  
		  success: function(data) {
		  	$("#municipios").html("");			    
		    $("#municipios").append(data);
		  }
		});
	});
	
	$("#submit_formulario_expediente").click(function(){
    $.ajax({
      type:'GET',
      async:false,
      url: "<?php echo($ruta_db_superior);?>pantallas/remitente/ejecutar_acciones.php",
      data: "ejecutar_remitente=set_remitente&tipo_retorno=1&rand="+Math.round(Math.random()*100000)+"&"+formulario_remitente.serialize(),
      success: function(html){
      	if(html){
      		var objeto=jQuery.parseJSON(html);
      		if(objeto.exito){
      			notificacion_saia(objeto.mensaje,"success","",2500);
      			window.open('mostrar_datos_ejecutor.php?idejecutor=<?php echo(@$_REQUEST["idejecutor"]); ?>','_self');
      		}
      	}
      }
  	});
  	return false;
  });
});
</script>