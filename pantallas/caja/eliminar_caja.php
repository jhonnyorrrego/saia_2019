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

$idcaja = $_REQUEST['idcaja'];
$Caja = new Caja($idcaja);
if (!$idcaja || !$Caja->isResponsable()) {
  return;
}

$params = [
  'baseUrl' => $ruta_db_superior  
];

include_once $ruta_db_superior . 'assets/librerias.php';
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
		<?= validate() ?>
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">
         
          <form role="form" name="formularioCaja" id="formularioCaja">
            <div class="form-group">
              <label>Desea eliminar tambien los expedientes vinculados a la caja?</label>
              <div class="radio radio-info">
                  <input type="radio" value="0" name="eliminar_expediente" id="delNo">
                  <label for="delNo">NO</label>
                  <input type="radio" value="1" name="eliminar_expediente" checked="checked" id="delSi">
                  <label for="delSi">SI</label>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" id="idcaja" name="idcaja" value="<?=$idcaja?>">
              <input type="hidden" name="methodInstance" value="restoreCajaCont">
              <input type="hidden" name="nameInstance" value="CajaController">
              <button id="delCaja" type="submit" class="btn btn-danger">
                Eliminar
              </button>
            </div>
          </form>

				</div>
			</div>
    </div>
    <script type="text/javascript">
      $(document).ready(function (){
        var params=<?= json_encode($params) ?>;
        $("#formularioCaja").validate({
          rules : {
            idcaja : {
              required : true
            }
          },
          submitHandler : function(form) {
            $("#delCaja").attr('disabled',true);
            $.ajax({
                type : 'POST',
                async : false,
                url: `${params.baseUrl}pantallas/ejecutar_acciones.php`,
                data : $("#formularioCaja").serialize(),
                dataType : 'json',
                success : function(objeto) {
                  if (objeto.exito) {
                      top.notification({
                        message : objeto.message,
                        type : "success",
                        duration : 3000
                      });
                  } else {
                      top.notification({
                        message : objeto.message,
                        type : "error",
                        duration : 3000
                      });
                  }
                },
                error : function() {
                  top.notification({
                    message : "Error al procesar la solicitud (eliminar caja)",
                    type : "error",
                    duration : 3000
                  });
                }
            });
            return false;
          }
        });
      });
    </script>
  </body>           
</html>