<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

require_once $ruta_db_superior . "core/autoload.php";

$idcaja = $_REQUEST['idcaja'];
if (!$idcaja) {
  return;
}

$params = [
  'idcaja' => $idcaja,
  'baseUrl' => $ruta_db_superior
];
?>
<div class="row mx-0">
  <div class="col-12">
      <form id="formulario" name="formulario" class="form-horizontal">
        <div class="form-group row">
          <label for="nombre" class="col-md-3 control-label">Nombre de la serie</label>
          <div class="col-md-9">
            <select class="form-control" id="nombre" name="nombre" placeholder="Nombre del funcionario" required="">
            </select>
          </div>
        </div><br>
        
        <div class="row">
            <div class="col-md-12">
              <input type="hidden" id="idcaja" name="idcaja" value="<?= $idcaja; ?>">
            <button class="btn btn-complete" id="vincularSerie">Vincular</button>
          </div>
        </div>
      </form>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Dependencia</th>
            <th scope="col">Serie</th>
            <th scope="col">Fecha Vinculación</th>
            <th scope="col">Eliminar Vinculación</th>
          </tr>
        </thead>
        <tbody id="data-table">
        </tbody>
      </table>

  </div>
</div>
<script id="scriptAsignarEntSe" src="<?= $ruta_db_superior ?>views/caja/js/asignar_entidadserie.js" data-params='<?=json_encode($params)?>'></script>