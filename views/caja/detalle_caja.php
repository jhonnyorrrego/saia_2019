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
$Caja = new Caja($idcaja);

$params = [
    'idcaja' => $idcaja,
    'baseUrl' => $ruta_db_superior
];

?>
<div class="row mx-0">
    <div class="col-12">
        <div>
            <i data-table="tableInfoCaja" class="fa fa-plus-square inf"></i> Información
            <?php if ($Caja->isResponsable()) : ?>
                <div class="float-right">
                    <button class="btn btn-info" id="editCaja"><i class="fa fa-edit"></i></button>
                </div>
            <?php endif; ?>
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
                    <?= $Caja->getResponsable() ?><br />
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

        <div>
            <i data-table="tableInfoContenido" class="fa fa-minus-square inf"></i> Información de contenido
        </div>

        <table class="table" id="tableInfoContenido">
            <tr>
                <td>No de expedientes:</td>
                <td><?= $Caja->countExpediente() ?></td>
            </tr>
        </table>

    </div>
</div>

<script id="scriptDetalleCaja" data-params='<?= json_encode($params) ?>'>
    $(document).ready(function() {
        var params2 = $("#scriptDetalleCaja").data("params");

        $(".inf").click(function(e) {
            let table = $(this).data("table");
            let icon = $(this).hasClass("fa-plus-square");
            if (icon) {
                $(this).removeClass("fa-plus-square").addClass("fa-minus-square");
                $("#" + table).show();
            } else {
                $(this).removeClass("fa-minus-square").addClass("fa-plus-square");
                $("#" + table).hide();
            }
        });
        $(".inf").trigger("click");

        $("#editCaja").click(function(e) {
            let options = {
                url: `views/caja/editar_caja.php`,
                params: {
                    idcaja: params2.idcaja
                },
                size: "modal-lg",
                title: "EDITAR CAJA",
                centerAlign: false,
                buttons: {}
            };
            top.topModal(options);
        });

    });
</script>