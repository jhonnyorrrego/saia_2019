<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= "../";
    $max_salida --;
}

include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'formatos/librerias/funciones_acciones.php';
include_once $ruta_db_superior . 'app/arbol/crear_arbol_ft.php';
include_once $ruta_db_superior . 'anexosdigitales/funciones_archivo.php';
include_once $ruta_db_superior . 'formatos/ruta_distribucion/funciones.php';

$Formato = new Formato(404);

if(isset($_REQUEST['iddoc'])){
    $Documento = new Documento($_REQUEST['iddoc']);
    $ft = $Documento->getFt();
}

llama_funcion_accion(null,404 ,'ingresar','ANTERIOR');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>SGDA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">

    <?= pace() ?>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
    <?= icons() ?>
    <?= moment() ?>
    <?= select2() ?>
    <?= validate() ?>
    <?= ckeditor() ?>
    <?= jqueryUi() ?>
    <?= fancyTree(true) ?>
    <?= dateTimePicker() ?>
    <?= dropzone() ?>
</head>

<body>
    <div class='container-fluid container-fixed-lg col-lg-8' style='overflow: auto;' id='content_container'>
        <div class='card card-default'>
            <div class='card-body'>
                <h5 class='text-black w-100 text-center'>
                    Rutas de Distribución
                </h5>
                <form 
                    name='formulario_formatos' 
                    id='formulario_formatos' 
                    role='form' 
                    autocomplete='off' 
                    method='post' 
                    action='<?= $ruta_db_superior ?>app/documento/guardar_ft.php' 
                    enctype='multipart/form-data'>
                            <?php
        $selected = isset($ft) ? $ft['dependencia'] : '';
        $query = Model::getQueryBuilder();
        $roles = $query
            ->select("dependencia as nombre, iddependencia_cargo, cargo")
            ->from("vfuncionario_dc")
            ->where("estado_dc = 1 and tipo_cargo = 1 and login = :login")
            ->andWhere(
                $query->expr()->lte('fecha_inicial', ':initialDate'),
                $query->expr()->gte('fecha_final', ':finalDate')
            )->setParameter(":login", SessionController::getLogin())
            ->setParameter(':initialDate', new DateTime(), \Doctrine\DBAL\Types\Type::DATETIME)
            ->setParameter(':finalDate', new DateTime(), \Doctrine\DBAL\Types\Type::DATETIME)
            ->execute()->fetchAll();
    
        $total = count($roles);

        echo "<div class='form-group' id='group_dependencie'>";
    
        if ($total > 1) {
            echo "<select class='full-width' name='dependencia' id='dependencia' required>";
            foreach ($roles as $row) {
                echo "<option value='{$row["iddependencia_cargo"]}'>
                    {$row["nombre"]} - ({$row["cargo"]})
                </option>";
            }
    
            echo "</select>
                <script>
                    $('#dependencia').select2();
                    $('#dependencia').val({$selected});
                    $('#dependencia').trigger('change');
                </script>
            ";
        } else if ($total == 1) {
            echo "<input class='required' type='hidden' value='{$roles[0]['iddependencia_cargo']}' id='dependencia' name='dependencia'>
                <label class ='form-control'>{$roles[0]["nombre"]} - ({$roles[0]["cargo"]})</label>";
        } else {
            throw new Exception("Error al buscar la dependencia", 1);
        }
        
        echo "</div>";
        ?>
<div class='form-group form-group-default input-group required date' id='group_fecha_ruta_distribuc'>
<div class="form-input-group">
<label for='fecha_ruta_distribuc' title=''>FECHA Y HORA</label>
<label id="fecha_ruta_distribuc-error" class="error" for="fecha_ruta_distribuc" style="display: none;"></label>
<input type="text" class="form-control"  id="fecha_ruta_distribuc"  required name="fecha_ruta_distribuc" />
<script type='text/javascript'>
            $(function () {
                var configuracion={"defaultDate":"2019-10-05","format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                $('#fecha_ruta_distribuc').datetimepicker(configuracion);
                $('#content_container').height($(window).height());
            });
        </script>
</div>
<div class='input-group-append'>
            <span class='input-group-text'><i class='fa fa-calendar'></i></span>
        </div>
</div>
<div class='form-group form-group-default required col-12 '  id='group_nombre_ruta'>
            <label title=''>NOMBRE DE LA RUTA</label>
            <input class='form-control required' type='text' id='nombre_ruta' name='nombre_ruta' value='' />
        </div>

        <div class='form-group form-group-default form-group-default-select2 required' id='group_asignar_mensajeros'>
            <label title=''>MENSAJEROS DE LA RUTA</label>
            <div class='form-group'>
            <select name='asignar_mensajeros' id='asignar_mensajeros' required>
            <option value=''>Por favor seleccione...</option>
        <option value='15'>
                1
            </option></select>
                <script>
                $(document).ready(function() {
                    $('#asignar_mensajeros').select2();
                    $('#asignar_mensajeros').addClass('full-width');
                });
                </script>
            </div>
        </div>
<div class="form-group required" id="group_asignar_dependencias">
                                    <label title="">DEPENDENCIAS DE LA RUTA</label><?php $origen_4998 = array(
                                "url" => "app/arbol/arbol_dependencia.php",
                                "ruta_db_superior" => $ruta_db_superior,);$origen_4998["params"]["checkbox"]="radio";$opciones_arbol_4998 = array(
                                "keyboard" => true,"selectMode" => 1,"seleccionarClick" => 1,"obligatorio" => 1,
                            );
                            $extensiones_4998 = array(
                                "filter" => array()
                            );
                            $arbol_4998 = new ArbolFt("asignar_dependencias", $origen_4998, $opciones_arbol_4998, $extensiones_4998);
                            echo $arbol_4998->generar_html();?></div>
<input type='hidden' name='serie_idserie' value='1'>
<input type='hidden' name='estado_documento' value=''>
<input type='hidden' name='firma' value='1'>
<div class='form-group form-group-default  col-12 '  id='group_descripcion_ruta'>
            <label title=''>DESCRIPCIóN RUTA</label>
            <input class='form-control ' type='text' id='descripcion_ruta' name='descripcion_ruta' value='' />
        </div>
<input type='hidden' name='encabezado' value='1'>
<input type='hidden' name='documento_iddocumento' value=''>
<input type='hidden' name='idft_ruta_distribucion' value=''>

<input type='hidden' name='campo_descripcion' value='4987'>
<input type='hidden' name='iddoc' value='<?= $_REQUEST['iddoc'] ?? null ?>'>
<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='radicacion_salida'>
<input type='hidden' name='formatId' value='404'>
<input type='hidden' name='tabla' value='ft_ruta_distribucion'>
<input type='hidden' name='formato' value='ruta_distribucion'>
<input type='hidden' name='token'>
<input type='hidden' name='key'>
<div class='form-group px-0 pt-3'><button class='btn btn-complete' id='continuar' >Continuar</button></div>
                </form>
            </div>
        </div>
    </div>
    <?php fecha_formato(404,$_REQUEST['iddoc'] ?? null) ?>
<?php add_edit_ruta_dist(404,$_REQUEST['iddoc'] ?? null) ?>

    <script>
        $(function() {
            $("[name='token']").val(localStorage.getItem('token'));
            $("[name='key']").val(localStorage.getItem('key'));

            $("#continuar").click(function() {
                $("#formulario_formatos").validate({
                    ignore: [],
                    errorPlacement: function (error, element) {
                        let node = element[0];

                        if (
                            node.tagName == 'SELECT' &&
                            node.className.indexOf('select2') !== false
                        ) {
                            error.addClass('pl-3');
                            element.next().append(error);
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler: function(form) {
                        $("#continuar").hide();
                        $("#continuar").after(
                            $('<button>', {
                                class: 'btn btn-success',
                                disabled: true,
                                id: 'boton_enviando',
                                text: 'Enviando...'
                            })
                        );
                        form.submit();
                    },
                    invalidHandler: function() {
                        $("#continuar").show();
                        $("#boton_enviando").remove();
                    }
                });
            });
        });
    </script>
</body>
</html>