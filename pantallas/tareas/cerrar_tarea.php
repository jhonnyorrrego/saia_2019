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
?>
<form id="formulario_tareas" class="form-horizontal">
    
    <div class="control-group">
      <label class="control-label" for="etiqueta">Tarea a realizar:</label>
      <div class="controls">
      	<label class="control-label" for="etiqueta">
      		<b>
        <?php
        $tareas=busca_filtro_tabla("","tareas","idtareas=".$_REQUEST["idtareas"],"",$conn);
		echo $tareas[0]["etiqueta"];
        ?>
        </b>
        </label>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="fecha_vencimiento">Descripci&oacute;n</label>
      <div class="controls">
        <textarea type="text" id="descripcion" placeholder="Descripcion" class="tipo_fecha"></textarea>
      </div>
    </div>
    <input type="hidden" id="idtareas" value="<?php echo($_REQUEST["idtareas"]); ?>">
    <input type="hidden" id="tabla" value="tareas_buzon">
</form>    
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
<script type="text/javascript">
$("#encabezado_modal").html('<h3>Cerrar tarea</h3>'); 

</script>