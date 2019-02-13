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
if (!$idcaja) {
    return;
}

$Caja=new Caja($idcaja);

$params = [
    'idcaja' => $idcaja,
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
        <?= icons() ?>
        <?= validate() ?>
	</head>

	<body>
		<div class="container m-0 p-0 mw-100 mx-100">
			<div class="row mx-0">
				<div class="col-12">
                    <div>
                        <i data-table="tableInfoCaja" class="fa fa-plus-square inf"></i> Información de la Caja
                    </div>
                    <table class="table" id="tableInfoCaja">
                        <tr>
                            <td>Fecha de creación:</td>
                            <td><?= $Caja->fecha_creacion ?></td>
                        </tr>
                        <tr>
                            <td>Código:</td>
                            <td><?= $Caja->codigo ?></td>
                        </tr>
                        <tr>
                            <td>Tipo:</td>
                            <td><?= $Caja->getEstadoArchivo() ?></td>
                        </tr>
                        <tr>
                            <td>Fondo:</td>
                            <td><?= $Caja->fondo ?></td>
                        </tr>
                        <tr>
                            <td>Propietario:</td>
                            <td><?= $Caja->getPropietario() ?></td>
                        </tr>
                        <tr>
                            <td>Responsable:</td>
                            <td>
                                <?= $Caja->getResponsable() ?><br/>
                                <?php if ($Caja->isResponsable()) : ?>
                                    <button class="btn btn-info" id="openModal"><i class="fa fa-user"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Sección:</td>
                            <td><?= $Caja->seccion ?></td>
                        </tr>

                        <tr>
                            <td>Subsección:</td>
                            <td><?= $Caja->subseccion ?></td>
                        </tr>
                        <tr>
                            <td>División:</td>
                            <td><?= $Caja->division ?></td>
                        </tr>
                        <tr>
                            <td>Módulo:</td>
                            <td><?= $Caja->modulo ?></td>
                        </tr>
                        <tr>
                            <td>Panel:</td>
                            <td><?= $Caja->panel ?></td>
                        </tr>
                        <tr>
                            <td>Nivel:</td>
                            <td><?= $Caja->nivel ?></td>
                        </tr>
                        <tr>
                            <td>Material:</td>
                            <td><?= $Caja->getMaterial() ?></td>
                        </tr>
                        <tr>
                            <td>Seguridad:</td>
                            <td><?= $Caja->getSeguridad() ?></td>
                        </tr>
                    </table>
				</div>
			</div>
        </div>
    
        <script type="text/javascript">
            $(document).ready(function (){
                var params=<?= json_encode($params) ?>;

                $("#openModal").click(function (){
                    let options = {
                        url: `${params.baseUrl}pantallas/caja/cambiar_responsable.php`,
                        params: {
                            idcaja:params.idcaja
                        }, 
                        size: "modal-lg",
                        title: "Actualizar responsable",
                        centerAlign: false,
                        buttons: {}
                    };
                    top.topModal(options);
                });


                $(".inf").click(function (e) {
                    let table=$(this).data("table"); 
                    let icon=$(this).hasClass("fa-plus-square");
                    if(icon){
                        $(this).removeClass("fa-plus-square").addClass("fa-minus-square");
                        $("#"+table).show();
                    }else{
                        $(this).removeClass("fa-minus-square").addClass("fa-plus-square");
                        $("#"+table).hide();
                    }                  
                });
                $(".inf").trigger("click");
            });
        </script>

    </body>           
</html>