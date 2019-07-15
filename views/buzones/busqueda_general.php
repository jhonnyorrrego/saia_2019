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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAIA - SGDEA</title>
    <?= dateTimePicker() ?>
    <?= fancyTree() ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10">
                <form id="kformulario_saia" method="post">
                    <div class="card-group horizontal my-0" role="tablist" aria-multiselectable="true">
                        <div class="card card-default mb-0" id="firstTab">
                            <div class="card-header py-2" role="tab">
                                <h4 class="card-title">
                                    <a class="p-0 text-capitalize" data-toggle="collapse" data-parent="#firstTab" href="#firstTabContainer" aria-expanded="true" aria-controls="firstTabContainer">
                                        Búsqueda rápida
                                    </a>
                                </h4>
                            </div>
                            <div id="firstTabContainer" class="collapse show" role="tabcard">
                                <div class="row px-5 py-2">
                                    <div class="col-12">
                                        <div class="form-group form-group-default">
                                            <label>Número de radicado:</label>
                                            <input id="bqsaia_numero" name="bqsaia_a@numero" size="50" type="text" class="form-control">
                                            <input type="hidden" name="bksaiacondicion_a@numero" id="bksaiacondicion_a@numero" value="in">
                                            <input type="hidden" name="bqsaiaenlace_a@numero" id="bqsaiaenlace_a@numero" value="y" />
                                        </div>

                                        <div class="form-group form-group-default">
                                            <label>Asunto o descripción:</label>
                                            <textarea class="form-control" id="bqsaia_a@descripcion" name="bqsaia_a@descripcion" rows="4"></textarea>
                                            <input type="hidden" name="bksaiacondicion_a@descripcion" id="bksaiacondicion_a@descripcion" value="like_total">
                                            <input type="hidden" name="bqsaiaenlace_a@descripcion" id="bqsaiaenlace_a@descripcion" value="y" />
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group form-group-default input-group">
                                                    <div class="form-input-group">
                                                        <label>Fecha inicial:</label>
                                                        <input name="bqsaia_a@fecha_x" type="text" class="form-control" placeholder="Seleccione.." id="fecha_inicial">
                                                        <input type="hidden" name="bksaiacondicion_a@fecha_x" id="bksaiacondicion_a@fecha_x" value=">=">
                                                        <input type="hidden" name="bqsaiaenlace_a@fecha_x" id="bqsaiaenlace_a@fecha_x" value="y" />
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
                                                        <input name="bqsaia_a@fecha_y" type="text" class="form-control" placeholder="Seleccione.." id="fecha_final">
                                                        <input type="hidden" name="bksaiacondicion_a@fecha_y" id="bksaiacondicion_a@fecha_y" value="<=">
                                                        <input type="hidden" name="bqsaiaenlace_a@fecha_y" id="bqsaiaenlace_a@fecha_y" value="y" />
                                                    </div>
                                                    <div class="input-group-append ">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default mb-0" id="secondTab">
                            <div class="card-header py-2" role="tab">
                                <h4 class="card-title">
                                    <a class="p-0 text-capitalize collapsed" data-toggle="collapse" data-parent="#secondTab" href="#secondTabContainer" aria-expanded="false" aria-controls="secondTabContainer">
                                        Búsqueda por contenido del documento
                                    </a>
                                </h4>
                            </div>
                            <div id="secondTabContainer" class="collapse" role="tabcard">
                                <div class="row px-5 py-2">
                                    <div class="col-12">
                                        <div class="form-group form-group-default required">
                                            <div id="format_tree"></div>
                                            <input name="bqsaia_c@idformato" type="hidden" id="formatId">
                                            <input type="hidden" name="bksaiacondicion_c@idformato" value="in">
                                            <input type="hidden" name="bqsaiaenlace_c@idformato" value="y" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default mb-0" id="thirdTab">
                            <div class="card-header py-2" role="tab">
                                <h4 class="card-title">
                                    <a class="p-0 text-capitalize collapsed" data-toggle="collapse" data-parent="#thirdTab" href="#thirdTabContainer" aria-expanded="false" aria-controls="thirdTabContainer">
                                        Búsqueda por tipo de gestión del documento
                                    </a>
                                </h4>
                            </div>
                            <div id="thirdTabContainer" class="collapse" role="tabcard">
                                <div class="row px-5 py-2">
                                    <div class="col-12">
                                        <div class="form-group form-group-default">
                                            <div class="user_tree">Transferidos a:</div>
                                            <input name="bqsaia_z@destino" type="hidden" class="treeValue">
                                            <input type="hidden" name="bksaiacondicion_z@destino" value="in">
                                            <input type="hidden" name="bqsaiaenlace_z@destino" value="y" />

                                            <input type="hidden" name="bksaiacondicion_z@nombre__1" value="">
                                            <input type="hidden" name="bqsaia_z@nombre__1" value="">
                                            <input type="hidden" name="bqsaiaenlace_z@nombre__1" value="y">
                                        </div>
                                        <div class="form-group form-group-default">
                                            <div class="user_tree">Transferidos por:</div>
                                            <input name="bqsaia_z@origen__1" type="hidden" class="treeValue">
                                            <input type="hidden" name="bksaiacondicion_z@origen__1" value="in">
                                            <input type="hidden" name="bqsaiaenlace_z@origen__1" value="y" />

                                            <input type="hidden" name="bksaiacondicion_z@nombre__2" value="">
                                            <input type="hidden" name="bqsaia_z@nombre__2" value="">
                                            <input type="hidden" name="bqsaiaenlace_z@nombre__2" value="y">
                                        </div>
                                        <div class="form-group form-group-default">
                                            <div class="user_tree">Elaborado por:</div>
                                            <input name="bqsaia_a@ejecutor" type="hidden" class="treeValue">
                                            <input type="hidden" name="bksaiacondicion_a@ejecutor" value="in">
                                            <input type="hidden" name="bqsaiaenlace_a@ejecutor" value="y" />
                                        </div>
                                        <div class="form-group form-group-default">
                                            <div class="user_tree">Aprobado por:</div>
                                            <input name="bqsaia_w@destino" type="hidden" class="treeValue">
                                            <input type="hidden" name="bksaiacondicion_w@destino" id="bksaiacondicion_w@destino" value="in">
                                            <input type="hidden" name="bqsaiaenlace_w@destino" value="y">

                                            <input type="hidden" name="bksaiacondicion_w@nombre" id="bksaiacondicion_w-nombre" value="">
                                            <input type="hidden" id="bqsaia_w-nombre" name="bqsaia_w@nombre" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="idbusqueda_componente" id="component" value="<?= $_REQUEST['idbusqueda_componente'] ?>">
                    <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
                    <input type="hidden" name="bqtipodato" value="date|a@fecha_x,a@fecha_y">
                    <input type="hidden" id="filtro_adicional" name="filtro_adicional" value="buzon_salida z@ AND iddocumento=z.archivo_idarchivo">
                </form>
            </div>
        </div>
    </div>
    <script src="<?= $ruta_db_superior ?>views/buzones/js/busqueda_general.js" data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html>