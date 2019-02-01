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

$idexpediente = $_REQUEST['idexpediente'];
if (!$idexpediente) {
  return;
}

include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . "librerias_saia.php";
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>SAIA - SGDEA</title>
		<?= jquery() ?>
		<?= bootstrap() ?>
		<?= theme() ?>
    <?= icons() ?>
		<?= librerias_validar_formulario() ?>
	</head>

  <body>
    <div class="container m-0 p-0 mw-100 mx-100">
      <div class="row mx-0">
        <div class="col-12">


        </div>
      </div>
    </div>
        
    <script type="text/javascript">
      $(document).ready(function (){
        $("#formularioExp").validate({
          rules : {
            agrupador : {
              required : true
            }
          },
          submitHandler : function(form) {

          }
        });
      });
    </script>
  </body>           
</html>