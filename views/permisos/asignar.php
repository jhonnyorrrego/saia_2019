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
?>
<div class="container-fluid p-0">
    <input type="hidden" id="access_type" value="<?= $_REQUEST['type'] ?>">
    <input type="hidden" id="access_type_id" value="<?= $_REQUEST['typeId'] ?>">

    <div class="row mx-0">
        <div class="col pl-0 pr-1" id="users_component"></div>
        <div class="col-auto p-0 align-self-center">
            <div class="dropdown d-lg-inline-block d-none">
                <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                    <a href="#" class="dropdown-item new_accion" data-type="see">
                        <i class="fa fa-eye"></i> Ver
                    </a>
                    <a href="#" class="dropdown-item new_accion" data-type="edit">
                        <i class="fa fa-edit"></i> Editar
                    </a>
                    <a href="#" class="dropdown-item new_accion" data-type="manager">
                        <i class="fa fa-legal"></i> Propietario
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-0">
        <div class="form-check float-right">
            <input type="checkbox" class="form-check-input" id="send_notification">
            <label class="form-check-label" for="send_notification">Notificar por email.</label>
        </div>
    </div>
    <div class="row mx-0 py-3">
        <div class="col-12 px-0">
            <span class="text-complete cursor" id="show_advanced">Opciones avanzadas</span>
        </div>
    </div>
    <div id="advanced" class="d-none">
        <div class="row">
            <div class="col-12">
                <div class="radio radio-complete">
                    <input type="radio" id="public_radio" name="private" data-type="public">
                    <label for="public_radio">Cualquier usuario de la organización puede buscarlo y acceder. (Público)</label><br>
                    <input type="radio" id="private_radio" name="private" data-type="private">
                    <label for="private_radio">Sólo yo puedo acceder al documento. (Privado)</label><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
                <h5>Usuarios con acceso</h5>
                <div class="row">
                    <ul>
                        <li>1</li>
                        <li>1</li>
                        <li>1</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= arbol() ?>
<?= select2() ?>
<script src="<?= $ruta_db_superior ?>views/permisos/js/asignar.js"></script> 