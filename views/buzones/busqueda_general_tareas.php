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

    <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form id="find_tasks_form">
                    <input type="hidden" name="idbusqueda_componente" id="component">
                    <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
                    <input type="hidden" name="bqtipodato" value="date|a@fecha_inicial_x,a@fecha_inicial_y">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select class="full-width" id="filtro_usuario">
                                    <option value="1">Cualquier usuario</option>
                                    <option value="2">Soy el propietario</option>
                                    <option value="3">Usuario especifico</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="user_container" style="display:none">
                        <div class="col-12">
                            <div class="form-group form-group-default form-group-default-select2">
                                <label>Responsable:</label>
                                <select class="full-width" id="select_responsable" multiple="multiple"></select>
                                <input type="hidden" name="bqsaia_b@fk_funcionario" id="user_list">
                                <input type="hidden" name="bksaiacondicion_b@fk_funcionario" value="in">
                                <input type="hidden" name="bqsaiaenlace_b@fk_funcionario" id="bqsaiaenlace_b@fk_funcionario" value="y" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group form-group-default">
                                <label>Nombre de la tarea:</label>
                                <input type="hidden" name="bksaiacondicion_a@nombre" id="bksaiacondicion_a@nombre" value="like">
                                <input type="hidden" name="bqsaiaenlace_a@nombre" id="bqsaiaenlace_a@nombre" value="y" />
                                <input class="form-control" name="bqsaia_a@nombre" type="text">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <select class="full-width" id="filtro_fecha">
                                    <option value="1">En cualquier momento</option>
                                    <option value="2">Hoy</option>
                                    <option value="3">Ayer</option>
                                    <option value="4">Últimos 7 días</option>
                                    <option value="5">Últimos 30 días</option>
                                    <option value="6">Últimos 90 días</option>
                                    <option value="7">Entre las fechas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="date_container" style="display:none">
                        <div class="col-12 col-md-6">
                            <div class="form-group form-group-default input-group">
                                <div class="form-input-group">
                                    <label>Fecha inicial:</label>
                                    <input name="bqsaia_a@fecha_inicial_x" type="text" class="form-control" placeholder="Seleccione.." id="fecha_inicial">
                                    <input type="hidden" name="bksaiacondicion_a@fecha_inicial_x" id="bksaiacondicion_a@fecha_inicial_x" value=">=">
                                    <input type="hidden" name="bqsaiaenlace_a@fecha_inicial_x" id="bqsaiaenlace_a@fecha_inicial_x" value="y" />
                                </div>
                                <div class="input-group-append ">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group form-group-default input-group">
                                <div class="form-input-group">
                                    <label>Fecha final:</label>
                                    <input name="bqsaia_a@fecha_inicial_y" type="text" class="form-control" placeholder="Seleccione.." id="fecha_final">
                                    <input type="hidden" name="bksaiacondicion_a@fecha_inicial_y" id="bksaiacondicion_a@fecha_inicial_y" value="<=">
                                </div>
                                <div class="input-group-append ">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <button type="reset" class="btn btn-danger">Limpiar</button>
                        <button type="submit" class="btn btn-complete">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/locales/es.js"></script>
    <script src="<?= $ruta_db_superior ?>views/buzones/js/busqueda_general_tareas.js" data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html> 