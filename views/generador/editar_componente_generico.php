<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'views/generador/librerias.php';

if (!$_REQUEST["fieldId"]) {
    throw new Exception("Debe indicar el campo", 1);
}

$fieldId = $_REQUEST["fieldId"];
$PantallaComponente = new PantallaComponente($_REQUEST["idpantalla_componente"]);
$CamposFormato = new CamposFormato($fieldId);
$actions = explode(',', $CamposFormato->acciones);
$values = json_decode($CamposFormato->valor, true);
$schema = json_decode($PantallaComponente->opciones_propias, true);
$valores = [
    "fs_etiqueta" => $CamposFormato->etiqueta,
    "fs_obligatoriedad" => $CamposFormato->obligatoriedad,
    "fs_acciones" => in_array('p', $actions),
    "fs_valor" => is_array($values) ? $values : $CamposFormato->valor,
    "fs_ayuda" => $CamposFormato->ayuda
];

$schema["data"] = !empty($schema["data"]) ? array_merge_recursive($schema["data"], $valores) : $valores;
$config = obtener_valores_campo($CamposFormato, $schema);

if (!empty($config)) {
    $schema["data"] = $config;
}

$options = json_encode($schema, JSON_NUMERIC_CHECK);

function obtener_valores_campo($CamposFormato, $opciones_defecto)
{
    $response = [];

    if (in_array($CamposFormato->etiqueta_html, [
        'radio',
        'select',
        'checkbox'
    ])) {
        $options = $CamposFormato->getRadioOptions();

        foreach ($options as $CampoOpciones) {
            $response["fs_opciones"][] = [
                'llave' => $CampoOpciones->llave,
                'valor' => $CampoOpciones->valor,
                'idcampo_opciones' => $CampoOpciones->getPK()
            ];
        }
    } else {
        $opciones = json_decode($CamposFormato->opciones, true);

        if (is_array($opciones)) {
            $response["fs_opciones"] = $opciones;
        }

        if ($CamposFormato->etiqueta_html == 'arbol') {
            $response["fs_arbol"] = "arbol_seleccionV2";
        }

        $response["fs_opciones_con_decimales"] = $opciones['con_decimales'];
    }

    if (isset($opciones_defecto["data"])) {
        $response = array_merge_recursive_distinct($response, $opciones_defecto["data"]);
    }

    return $response;
}

function array_merge_recursive_distinct(array &$array1, array &$array2)
{
    $merged = $array1;
    foreach ($array2 as $key => &$value) {
        if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
            $merged[$key] = array_merge_recursive_distinct($merged[$key], $value);
        } else {
            $merged[$key] = $value;
        }
    }
    return $merged;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Configuraci&oacute;n del campo
    </title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= moment() ?>
    <?= jqueryUi() ?>
    <?= jsPanel() ?>
    <?= dateTimePicker() ?>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>node_modules/handlebars/dist/handlebars.js"></script>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>node_modules/alpaca/dist/alpaca/bootstrap/alpaca.js"></script>
    <link href="<?= $ruta_db_superior ?>assets/theme/pages/fonts/glyphicons/glyphicons.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?= $ruta_db_superior ?>views/generador/css/index.css" rel="stylesheet" />
</head>

<body>
    <div id="btn-cerrar">&times;</div>
    <div class="container">
        <div class="mb-4 mt-4 text-center">
            <h5>Configurar Campo</h5>
            <h6><?= $PantallaComponente->etiqueta ?></h6>
        </div>
        <hr />
        <form id="editar_pantalla_campo" name="editar_pantalla_campo"></form>
        <div id="res" class="alert"></div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var opciones_form = <?= $options ?>;
            var newOptions = {
                view: {
                    id: "jqueryui-create",
                    locale: "es_ES",
                    messages: {
                        es_ES: {
                            "stringNotANumber": "Escriba sólo números"
                        }
                    }
                },
                onSubmit: function(errors, values) {
                    if (errors) {
                        $('#res').html('<p>Error al validar</p>');
                    }
                },
                postRender: function() {
                    $(".alpaca-required-indicator").html("<span style='font-size:18px;color:red;'>*</span>");
                    $(".alpaca-field-radio").find("label").css("display", "block");

                    if (["archivo", "moneda", "spin"].includes("<?= $PantallaComponente->nombre ?>")) {
                        $("input[type='number'][data-min]").each(function() {
                            var valor = $(this).data("min");
                            $(this).attr("min", valor);
                        });
                        $("input[type='number'][data-max]").each(function() {
                            var valor = $(this).data("max");
                            $(this).attr("max", valor);
                        });
                    }
                }
            }

            opciones_form.options.form = {
                buttons: {
                    cancel: {
                        styles: "btn btn-danger mt-5",
                        id: "btnCancelar",
                        type: "button",
                        value: "Cancelar",
                        click: function(evt) {
                            var panel = $('.jsPanel-standard', parent.document).get(0);
                            jsPanel.close(panel);
                        }
                    },
                    submit: {
                        title: "Guardar",
                        styles: "btn btn-complete mt-5",
                        id: "btnGuardar",
                        click: function() {
                            this.refreshValidationState(true);
                            if (this.isValid(true)) {
                                var value = this.getValue();
                                funcion_enviar(value);
                                var panel = $('.jsPanel-standard', parent.document).get(0);
                                panel.setAttribute('respuesta', value.fs_etiqueta);
                                jsPanel.close(panel);
                            }
                        }
                    }
                }
            };

            $('#editar_pantalla_campo').alpaca(Object.assign({},
                opciones_form,
                newOptions
            ));

            $('#btn-cerrar').on('click', function() {
                var panel = $('.jsPanel-standard', parent.document).get(0);
                jsPanel.close(panel);
            });

            function funcion_enviar(datos) {
                datos = Object.assign({}, datos, {
                    fieldId: "<?= $fieldId ?>",
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                });

                $.ajax({
                    type: 'POST',
                    url: "<?= $ruta_db_superior ?>app/generador/modificarCampo.php",
                    data: datos,
                    async: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#cargando_enviar').html("Terminado ...");
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message
                            });
                        }

                    }
                });
            }
        });
    </script>
</body>

</html>