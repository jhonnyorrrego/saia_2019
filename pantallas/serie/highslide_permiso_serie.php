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

$sel = [
    'l' => '',
    'l,a' => ''
];
$checked1 = "";
$checked0 = "";
if (!empty($_REQUEST["identidad_serie"]) && !empty($_REQUEST['fk_entidad']) && !empty($_REQUEST['llave_entidad'])) {

    if ($_REQUEST['idpermiso']) {
        $idpermiso = $_REQUEST['idpermiso'];
        $PermisoSerie = new PermisoSerie($_REQUEST['idpermiso']);
    } else {
        $conditions = [
            'fk_entidad_serie' => $_REQUEST['identidad_serie'],
            'llave_entidad' => $_REQUEST['llave_entidad'],
            'fk_entidad' => $_REQUEST['fk_entidad']
        ];
        $response = PermisoSerie::findAllByAttributes($conditions);
        if ($response) {
            $cant = count($response);
            if ($cant > 1) {
                for ($i = 1; $i < $cant; $i++) {
                    $response[$i]->delete();
                }
            }
            $PermisoSerie = $response[0];
            $idpermiso = $PermisoSerie->getPK();
        }
    }
    if (!$idpermiso) {
        return;
    }
    $sel[$PermisoSerie->permiso] = 'checked';
} else {
    return;
}

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
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">
                    <input type="hidden" id="idpermiso_serie" name="idpermiso_serie" value="<?= $idpermiso; ?>"/>
                    <p>Tiene permiso para crear expedientes</p>
                    Si &nbsp; <input type="radio" value="l,a" name="permiso" <?= $sel['l,a'] ?>> &nbsp;&nbsp;
                    No &nbsp; <input type="radio" value="l" name="permiso" <?= $sel['l'] ?>>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function(){    	
                $("[name='permiso']").change(function(){
                    $.ajax({
                        type:"post",
                        dataType: "json",
                        url: "asignar_permiso.php",
                        data: {
                            accion:2,
                            permiso:$(this).val(),
                            idpermiso_serie:$("#idpermiso_serie").val()
                        },
                        success: function(response){
                            top.notification({
                                message: response.message,
                                type: response.type,
                                duration: 5000
                            });
                            parent.hs.close();
                        },
                        error:function(){
                            top.notification({
                                message: 'Error al actualizar la información',
                                type: 'error',
                                duration: 5000
                            });
                        }
                    });                     
                });
            });
        </script>
    </body>
</html>   