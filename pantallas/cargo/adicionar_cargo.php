<?php 
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta;
  }
  $ruta .= "../";
  $max_salida--;
}
$nombre_formulario_saia="cargo";
include_once($ruta_db_superior."pantallas/header_adicionar.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
include_once($ruta_db_superior."pantallas/cargo_librerias.php");
if(@$_REQUEST["guardar_".$nombre_formulario_saia]==1){
  if(array_key_exists("form_info_".$nombre_formulario_saia, $_REQUEST)) {
    adicionar_cargo($_POST["form_info_".$nombre_formulario_saia]);
  }  
}
else{
?>
<div class="container">
  <div class="control-group" nombre="etiqueta">
    <legend>Adicionar cargo</legend>
  </div>
  <form id="formulario_<?php echo($nombre_formulario_saia);?>" class="form-horizontal" method="post">
    <div class="control-group">
      <label class="control-label" for="nombre">Nombre*:</label>
      <div class="controls">
        <input type="text" class="required" name="nombre" id="nombre" placeholder="Nombre">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="tipo">Tipo*:</label>
      <div class="controls">
        <input type="radio" class="required" name="tipo" id="tipo1" value="1" checked="checked">Administrativo
        <input type="radio" name="tipo" id="tipo2" value="2">Funcional
      </div>
    </div> 
    <div class="control-group">
      <div class="controls">
        <input type='submit' class="btn btn-primary btn-mini" name="submit" id="continuar_<?php echo($nombre_formulario_saia);?>" value="continuar">
        <input type="hidden" name="form_info_<?php echo($nombre_formulario_saia);?>" id="form_info_<?php echo($nombre_formulario_saia);?>" value="">
        <input type="hidden" name="guardar_<?php echo($nombre_formulario_saia);?>" value="1">
      </div>
    </div>
  </form>
</div>      
<?php
}
include_once($ruta_db_superior."pantallas/footer_adicionar.php");
?>