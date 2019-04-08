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
<!DOCTYPE html>
<html lang="en">

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
    <div class="container px-1 py-0">
        <div class="row">
            <div class=" container-fluid   container-fixed-lg m-t-20">
                <div class="row">
                    <div class="col-md-4">
                        <!-- START card -->
                        <div class="card">
                            <div class="card-header ">
                                <div class="card-title">Paleta de colores</div>
                            </div>
                            <div class="card-body">
                                <p>Seleccione un color y haga click en guardar</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-block btn-complete" id="saveColor">Guardar</button>
                            </div>
                        </div>
                        <!-- END card -->
                    </div>
                    <div class="col-md-8">
                        <!-- START card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 sm-m-b-15 color_container cursor">
                                        <div class="bg-primary b-a b-grey">
                                            <div class="bg-white m-t-45 padding-10 text-master">
                                                <p class="small no-margin pull-left">
                                                    <input type="radio" name="theme" value="#6D5CAE">
                                                    #6D5CAE
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 sm-m-b-15 color_container cursor">
                                        <div class="bg-complete b-a b-grey">
                                            <div class="bg-white m-t-45 padding-10">
                                                <p class="small no-margin pull-left">
                                                    <input type="radio" name="theme" value="#48B0F7">
                                                    #48B0F7
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 color_container cursor">
                                        <div class="bg-success b-a b-grey">
                                            <div class="bg-white m-t-45 padding-10">
                                                <p class="small no-margin pull-left">
                                                    <input type="radio" name="theme" value="#10CFBD">
                                                    #10CFBD
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 sm-m-b-15 color_container cursor">
                                        <div class="bg-warning b-a b-grey">
                                            <div class="bg-white m-t-45 padding-10">
                                                <p class="small no-margin pull-left">
                                                    <input type="radio" name="theme" value="#F8D053">
                                                    #F8D053
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 sm-m-b-15 color_container cursor">
                                        <div class="bg-danger b-a b-grey">
                                            <div class="bg-white m-t-45 padding-10">
                                                <p class="small no-margin pull-left">
                                                    <input type="radio" name="theme" value="#F55753">
                                                    #F55753
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 sm-m-b-15 color_container cursor">
                                        <div class="b-a b-grey" id="dinamic_color" style="background:#3B4752">
                                            <div class="bg-white m-t-45 padding-10">
                                                <p class="small no-margin pull-left">
                                                    <input type="radio" name="theme" value="#3B4752" id="dinamic">
                                                    <span id="dinamic_label">#3B4752</span>
                                                    <button class="btn btn-xs py-0" onclick="js:$('input[type=\'color\']').click()">Personalizar</button>
                                                </p>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="d-none" type="color" value="#3B4752" id="example-color-input">
                                </div>
                            </div>
                        </div>
                        <!-- END card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script data-baseurl="<?= $ruta_db_superior ?>" src="<?= $ruta_db_superior ?>views/configuracion/js/cambio_tema.js"></script>
</body>

</html> 