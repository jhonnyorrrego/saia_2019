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

include_once $ruta_db_superior . 'core/autoload.php';
?>
<?php if (Documento::canSee(
    SessionController::getValue('idfuncionario'),
    $_REQUEST["documentId"]
)) : ?>
    <div class="row mx-0 pt-1" id="acordeon_container">
        <div class="col-12 px-0">
            <div class="mx-0">
                <div class="card-group horizontal my-0" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="card card-default mb-0" id="first_occordion_card">
                        <div class="card-header py-2" role="tab" style="height:32px;min-height:32px;">
                            <h4 class="card-title">
                                <a class="p-0 text-capitalize" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Documento
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse show" role="tabcard">
                            <div id="document_header"></div>
                            <div id="view_document"></div>
                        </div>
                    </div>
                    <div class="card card-default mb-0" style="display:none" id="filestab_accordion">
                        <div class="card-header py-2" role="tab" style="height:32px;min-height:32px;">
                            <h4 class="card-title">
                                <a class="p-0 text-capitalize" data-toggle="collapse" data-parent="#filestab_accordion" href="#files_tab" aria-expanded="false" aria-controls="files_tab">
                                    Anexos
                                </a>
                            </h4>
                        </div>
                        <div id="files_tab" class="collapse" role="tabcard"></div>
                    </div>
                    <div class="card card-default mb-0" style="display:none" id="historytab_accordion">
                        <div class="card-header py-2" role="tab" id="headingTwo" style="height:32px;min-height:32px;">
                            <h4 class="card-title">
                                <a class="collapsed p-0 text-capitalize" data-toggle="collapse" data-parent="#historytab_accordion" href="#history_tab" aria-expanded="false" aria-controls="history_tab">
                                    Trazabilidad del Documento
                                </a>
                            </h4>
                        </div>
                        <div id="history_tab" class="collapse" role="tabcard" aria-labelledby="headingTwo">
                            <div class="card-body px-1 py-0" id="history_content"></div>
                        </div>
                    </div>
                    <div class="card card-default mb-0" style="display:none" id="dinamictab_accordion">
                        <div class="card-header py-2" role="tab" id="headingThree" style="height:32px;min-height:32px;">
                            <h4 class="card-title">
                                <a class="collapsed p-0 text-capitalize" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Adicionar
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse" role="tabcard" aria-labelledby="headingThree">
                            <div class="card-body px-1 py-0">
                                <iframe frameborder="0" id="iframe_dinamictab_accordion" width="100%" onload="this.height = window.innerHeight - 30"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script data-params='<?= json_encode($_REQUEST) ?>' id="acordeon_script" src="<?= $ruta_db_superior ?>views/documento/js/acordeon.js"></script>
<?php else : ?>
    <div class="row justify-content-md-center d-flex align-items-center h-100 bg-master-light">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header">
                    Necesitas permiso
                </div>
                <div class="card body m-0">
                    <div class="row border-0 mx-0">
                        <div class="pt-2 col">
                            <p>¿Quieres acceder? Solicita acceso o usa una cuenta que tenga los permisos necesarios.</p>
                            <p>Has iniciado sesión como <span class="bold" id="login"></span>
                        </div>
                        <div class="pt-2 col-auto">
                            <span class="fa fa-lock fa-5x"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var user = JSON.parse(localStorage.getItem('user'));
        var label = user.name + ' (' + user.login + ')';
        document.getElementById('login').innerHTML = label;
    </script>
<?php endif; ?>