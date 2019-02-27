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

require_once $ruta_db_superior . "controllers/autoload.php";

$opcion = $_REQUEST['opcion'];
if ($opcion) {
  if ($opcion == 1) {
    $idexpediente = $_REQUEST['idexpediente'];
    $Expediente = new Expediente($idexpediente);
    if (!$idexpediente || !$Expediente->getAccessUser("c")) {
      return;
    }
    $ids = $_REQUEST["idexpediente"];
  } else {
    $idexpediente = explode(",", $_REQUEST["ids"]);
    if (!count($idexpediente)) {
      return;
    }
    $ids = $_REQUEST["ids"];
  }
} else {
  return;
}

$params = [
  'idexpediente'=>$idexpediente,
  'baseUrl'=> $ruta_db_superior
];

include_once $ruta_db_superior . 'assets/librerias.php';
echo validate();
echo select2();
?>
    
<div class="row mx-0">
  <div class="col-12">

      <form id="formularioExp" name="formularioExp" class="form-horizontal">
        <div class="form-group row">
          <label for="nombre" class="col-md-3 control-label">Nombre del funcionario</label>
          <div class="col-md-9">
            <select class="form-control" id="nombre" name="nombre" placeholder="Nombre del funcionario" required="">
            </select>
          </div>
        </div><br>
        
        <div class="row">
            <div class="col-md-12">
              <input type="hidden" id="idexpediente" name="idexpediente" value="<?= $ids; ?>">
            <button class="btn btn-complete" id="guardarPermiso">Compartir</button>
          </div>
        </div>
      </form>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Funcionario</th>
            <th scope="col">Expediente</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody id="data-table">
        </tbody>
      </table>

  </div>
</div>
<script id="scriptCompartirExp" src="<?= $ruta_db_superior ?>views/expediente/js/compartir_expediente.js" data-params='<?=json_encode($params)?>'></script>