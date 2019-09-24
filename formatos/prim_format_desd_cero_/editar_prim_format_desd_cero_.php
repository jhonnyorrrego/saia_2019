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
include_once $ruta_db_superior . 'formatos/prim_format_desd_cero_/funciones.php';

$Formato = new Formato(453);

if(isset($_REQUEST['iddoc'])){
    $Documento = new Documento($_REQUEST['iddoc']);
    $ft = $Documento->getFt();
}

llama_funcion_accion(null,453 ,'ingresar','ANTERIOR');
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
                    Primer Formato desde Ceros df
                </h5>
                <form 
                    name='formulario_formatos' 
                    id='formulario_formatos' 
                    role='form' 
                    autocomplete='off' 
                    method='post' 
                    action='<?= $ruta_db_superior ?>app/documento/guardar_ft.php' 
                    enctype='multipart/form-data'>
                    <input type='hidden' name='idft_prim_format_desd_cero_' value='<?= mostrar_valor_campo('idft_prim_format_desd_cero_',453,$_REQUEST['iddoc']) ?>'>
<input type='hidden' name='documento_iddocumento' value='<?= mostrar_valor_campo('documento_iddocumento',453,$_REQUEST['iddoc']) ?>'>
<input type='hidden' name='encabezado' value='<?= mostrar_valor_campo('encabezado',453,$_REQUEST['iddoc']) ?>'>
<input type='hidden' name='firma' value='<?= mostrar_valor_campo('firma',453,$_REQUEST['iddoc']) ?>'>
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
<div class='form-group form-group-default  col-12 '  id='group_campo_texto_2132512480'>
            <label title=''>PRUEBA DE FECHA HOY</label>
            <input class='form-control ' type='text' id='campo_texto_2132512480' name='campo_texto_2132512480' value='<?= mostrar_valor_campo('campo_texto_2132512480',453,$_REQUEST['iddoc']) ?>' />
        </div>
<div class='form-group form-group-default input-group required date' id='group_datetime_440210615'>
<div class="form-input-group">
<label for='datetime_440210615' title=''>FECHA Y HORA 2<span>*</span></label>
<label id="datetime_440210615-error" class="error" for="datetime_440210615" style="display: none;"></label>
<input type="text" class="form-control"  id="datetime_440210615"  required name="datetime_440210615" />
<script type="text/javascript">
                $(function () {
                    var configuracion={"format":"YYYY-MM-DD","locale":"es","useCurrent":true};
                    $("#datetime_440210615").datetimepicker(configuracion);
                    $("#content_container").height($(window).height());
                });
            </script>
</div>
<div class='input-group-append'>
            <span class='input-group-text'><i class='fa fa-calendar'></i></span>
        </div>
</div>
<input type='hidden' name='hidden_1172466648' value='<?= mostrar_valor_campo('hidden_1172466648',453,$_REQUEST['iddoc']) ?>'>

<input type='hidden' name='campo_descripcion' value='8803'>
<input type='hidden' name='iddoc' value='<?= $_REQUEST['iddoc'] ?? null ?>'>
<input type='hidden' id='tipo_radicado' name='tipo_radicado' value='radicacion_entrada'>
<input type='hidden' name='formatId' value='453'>
<input type='hidden' name='tabla' value='ft_prim_format_desd_cero_'>
<input type='hidden' name='formato' value='prim_format_desd_cero_'>
<input type='hidden' name='token'>
<input type='hidden' name='key'>
<div class='form-group px-0 pt-3'><button class='btn btn-complete' id='continuar' >Continuar</button></div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        $(function() {
            $("[name='token']").val(localStorage.getItem('token'));
            $("[name='key']").val(localStorage.getItem('key'));

            $("#continuar").click(function() {
                $("#formulario_formatos").validate({
                    ignore: [],
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