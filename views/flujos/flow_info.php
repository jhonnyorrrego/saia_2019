<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';

include_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

$consulta = array(
    "campoid" => "idexpediente",
    "campotexto" => ["nombre"],
    "tablas" => ["expediente"],
    "condicion" => "agrupador=0",
    "orden" => "nombre"
);

$consulta64 = base64_encode(json_encode($consulta));

$origen = array("url" => "arboles/arbol_formatos.php", "ruta_db_superior" => $ruta_db_superior,
    "params" => array(
        "seleccionable" => "checkbox"
    ));
//$opciones_arbol = array("keyboard" => true, "onNodeClick" => "evento_click", "busqueda_item" => 1);
$opciones_arbol = array("keyboard" => true, "selectMode" => 2);
$extensiones = array("filter" => array());
$arbol = new ArbolFt("formato_flujo", $origen, $opciones_arbol, $extensiones);

?>

<form>
<fieldset>
<legend>Informaci&oacute;n general</legend>
  <div class="row">
      <div class="col-sm-9">
          <div class="form-group">
            <label for="nombre_flujo">Nombre del proceso</label>
            <input type="text" class="form-control" id="nombre_flujo" name="nombre" placeholder="Nombre del proceso">
          </div>
      </div>
      <div class="col-sm-3">
          <div class="form-group">
            <label for="version_flujo">Versi&oacute;n</label>
            <input type="text" class="form-control" id="version_flujo" name="version">
          </div>
      </div>
  </div>

  <div class="row">
    <div class="col-sm-9">
      <div class="form-group">
        <label for="descripcion_flujo">Descripci&oacute;n del Proceso</label>
        <textarea class="form-control" id="descripcion_flujo" name="descripcion"></textarea>
      </div>
	</div>
    <div class="col-sm-3">
	  <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="version_flujo">C&oacute;digo</label>
            <input type="text" class="form-control" id="version_flujo" name="version">
          </div>
        </div>
      </div>
	  <div class="row">
        <div class="col-sm-12">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Mostrar código en el nombre del Formato</label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="expediente_flujo">Expediente preestablecido</label>
    <input type="text" id="expediente_flujo" name="expediente" class="demo-default" value="">
    <script>
    </script>
  </div>

  <div class="form-check">
    <label for="formato_flujo">Elija los formatos que intervienen en este proceso*</label>
	<?= $arbol->generar_html() ?>
  </div>

  <div class="col-6">
    <label for="expediente_flujo">Adjuntar documentación del proceso</label>
    <div id="dropzone" class="dropzone">
      <div class="dz-message"><span>Haga clic para elegir un archivo o Arrastre acá el archivo.</span></div>
    </div>
  </div>


  <div class="form-group">
    <label for="info_flujo">Instrucciones o políticas adicionales del proceso</label>
    <textarea class="form-control" id="info_flujo" name="info"></textarea>
  </div>

  </fieldset>

  <button type="submit" class="btn btn-primary">Guardar</button>

</form>
<script src="<?= $ruta_db_superior ?>views/flujos/js/flujos.js" data-consulta64="<?= $consulta64 ?>"></script>
