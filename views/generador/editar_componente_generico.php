<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'views/generador/librerias.php';

if (!$_REQUEST["idpantalla_campos"]) {
    throw new Exception("Debe indicar el campo", 1);
}

$componente = Model::getQueryBuilder()
    ->select("nombre", "etiqueta", "clase", "opciones_propias")
    ->from("pantalla_componente")
    ->where("idpantalla_componente = :idpantalla")
    ->setParameter("idpantalla", $_REQUEST["idpantalla_componente"], \Doctrine\DBAL\Types\Type::INTEGER)
    ->execute()->fetchAll();

$texto_titulo = $componente[0]["etiqueta"];
$nombre_componente = $componente[0]["nombre"];
$valores = [];
$idpantalla_campos = null;

$idpantalla_campos = $_REQUEST["idpantalla_campos"];
$pantalla_campos = get_pantalla_campos($_REQUEST["idpantalla_campos"], 0);

$valores["fs_etiqueta"] = $pantalla_campos[0]["etiqueta"];

$valores["fs_obligatoriedad"] = false;
if ($pantalla_campos[0]["obligatoriedad"]) {
    $valores["fs_obligatoriedad"] = true;
}
$valores["fs_acciones"] = false;

if (preg_match("/p/", $pantalla_campos[0]["acciones"])) {
    $valores["fs_acciones"] = true;
}

$opciones = json_decode($pantalla_campos[0]["valor"], true);
if (json_last_error() === JSON_ERROR_NONE) {
    $valores["fs_valor"] = $opciones;
} else {
    $valores["fs_valor"] = $pantalla_campos[0]["valor"];
}

$opciones_propias = json_decode($pantalla_campos[0]["opciones_propias"], true);

if (json_last_error() === JSON_ERROR_NONE) {
    $val_default = array();
    if (isset($opciones_propias["data"]) && is_array($valores)) {
        $val_default = $opciones_propias["data"];
        $resultado = array_merge_recursive($val_default, $valores);
        $opciones_propias["data"] = $resultado;
    } else if (is_array($valores)) {
        $opciones_propias["data"] = $valores;
    }
}
$config_campo = obtener_valores_campo($idpantalla_campos, $opciones_propias);
if (!empty($config_campo)) {
    $opciones_propias["data"] = $config_campo;
}

$opciones_str = json_encode($opciones_propias, JSON_NUMERIC_CHECK);

function get_pantalla_campos($idpantalla_campos, $tipo_retorno = 1)
{

    $pantalla_campos = busca_filtro_tabla("A.*,B.nombre AS nombre_componente,B.etiqueta AS etiqueta_componente,B.componente,B.opciones,B.categoria,B.procesar,B.estado AS componente_estado,B.idpantalla_componente, B.eliminar, B.opciones_propias, C.nombre AS pantalla,A.idcampos_formato AS idpantalla_campos,B.etiqueta_html AS etiqueta_html_componente", "campos_formato A,pantalla_componente B, formato C", "A.formato_idformato=C.idformato AND A.idcampos_formato=" . $idpantalla_campos . " AND A.etiqueta_html=B.etiqueta_html", "");

    $pantalla_campos["exito"] = 0;
    if ($pantalla_campos["numcampos"]) {
        $pantalla_campos["exito"] = 1;
    }
    if ($tipo_retorno == 1) {
        echo (json_encode($pantalla_campos));
    } else {
        return ($pantalla_campos);
    }
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
            <h6><?= $texto_titulo ?></h6>
        </div>
        <hr />
        <form id="editar_pantalla_campo" name="editar_pantalla_campo"></form>
        <div id="res" class="alert"></div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var nombre_componente = "<?= $nombre_componente ?>";
            var con_numeros = ["archivo", "moneda", "spin"];
            var opciones_form = <?= $opciones_str ?>;
            var rutaSuperior = "<?= $ruta_db_superior ?>";
            var idpantalla_campo = <?= $idpantalla_campos ?>;
            var newOptions = {
                onSubmit: function(errors, values) {
                    if (errors) {
                        $('#res').html('<p>Error al validar</p>');
                    }
                },
                "view": {
                    "id": "jqueryui-create",
                    "locale": "es_ES",
                    "messages": {
                        "es_ES": {
                            "stringNotANumber": "Escriba sólo números"
                        }
                    }
                },
                "postRender": function() {
                    $(".alpaca-required-indicator").html("<span style='font-size:18px;color:red;'>*</span>");
                    $(".alpaca-field-radio").find("label").css("display", "block");
                    if (con_numeros.includes(nombre_componente)) {
                        $("input[type='number'][data-min]").each(function() {
                            var valor = $(this).data("min");
                            $(this).attr("min", valor);
                        });
                        $("input[type='number'][data-max]").each(function() {
                            var valor = $(this).data("max");
                            $(this).attr("max", valor);
                        });
                    }

                    configurarPanel();
                }
            }

            opciones_form.options.form = {
                buttons: {
                    cancel: {
                        "styles": "btn btn-danger d-none",
                        "id": "btnCancelar",
                        "type": "button",
                        "value": "Cancelar",
                        "click": function(evt) {
                            var panel = $('.jsPanel-standard', parent.document).get(0);
                            jsPanel.close(panel);
                        }
                    },
                    submit: {
                        "title": "Guardar",
                        "styles": "btn btn-complete d-none",
                        "id": "btnGuardar",
                        "click": function() {
                            this.refreshValidationState(true);
                            if (this.isValid(true)) {
                                var value = this.getValue();
                                funcion_enviar(value, idpantalla_campo);
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

            $(document)
                .off('click', '.alpaca-array-actionbar-action,.alpaca-array-toolbar-action')
                .on('click', '.alpaca-array-actionbar-action,.alpaca-array-toolbar-action', function() {
                    var margen = 0.9;
                    if ($(this).attr('data-alpaca-array-actionbar-action') == 'remove') {
                        margen = 0.98;
                    }
                    if ($('.jsPanel-standard', parent.document).height() < (window.screen.height * margen)) {
                        configurarPanel();
                    }
                });

            function configurarPanel() {
                var panel = $('.jsPanel-standard', parent.document).get(0);
                ////////////////////////// Cambiar el tamaño de jspanel de acuerdo al tamaño del formulario
                $('.jsPanel-standard', parent.document).height($('#editar_pantalla_campo').height() + 184);
                /////////////////////// Rectificar redimension de altura de la pantalla en caso de no hacerlo anteriormente////////////////////
                setTimeout(function() {
                    $('.jsPanel-standard', parent.document).height($('#editar_pantalla_campo').height() + 184);
                }, 200);
                ///////////////////// Configurando el estilo del header ///////////////////////////////
                $('#btnCancelar', '#editar_pantalla_campo').removeClass('d-none');
                $('#btnCancelar', '#editar_pantalla_campo').addClass('d-inline');
                $('#btnGuardar', '#editar_pantalla_campo').removeClass('d-none');
                $('#btnGuardar', '#editar_pantalla_campo').addClass('d-inline');
            }

            function funcion_enviar(datos, idpantalla_campo) {
                var evitar_html = ["datetime", "textarea_cke"];

                $.ajax({
                    type: 'POST',
                    url: "<?php echo ($ruta_db_superior); ?>app/generador/modificarCampo.php?" + datos + "&funcion=set_pantalla_campos&tipo_retorno=1&idpantalla_campos=" + idpantalla_campo + "&key=" + localStorage.getItem('key') + "&token=" + localStorage.getItem('token'),
                    data: datos,
                    async: false,
                    dataType: "json",
                    success: function(objeto) {
                        if (objeto && objeto.exito) {
                            $('#cargando_enviar').html("Terminado ...");

                        } else if (objeto && objeto.exito == 0) {
                            top.notification({
                                type: 'error',
                                message: 'El nombre del campo ya existe en el formato'
                            });
                        }

                    }
                });
            }
        });
    </script>
</body>

</html>
<?php
function obtener_valores_campo($idcampo_formato, $opciones_defecto)
{

    $resp = array();

    $campo_formato = busca_filtro_tabla("nombre, etiqueta, opciones, estilo, ayuda, etiqueta_html", "campos_formato", "idcampos_formato=$idcampo_formato", "");

    if ($campo_formato["numcampos"]) {


        $opciones = json_decode($campo_formato[0]["opciones"], true);

        //$opciones_propias = json_decode(utf8_encode($pantalla_campos[0]["opciones_propias"]), true);
        if (json_last_error() === JSON_ERROR_NONE && !empty($opciones)) {
            $resp["fs_opciones"] = $opciones;
        }
        $estilo = json_decode(mb_convert_encoding($campo_formato[0]["estilo"], 'UTF-8', 'UTF-8'), true);
        //$opciones_propias = json_decode(utf8_encode($pantalla_campos[0]["opciones_propias"]), true);
        if (json_last_error() === JSON_ERROR_NONE && !empty($estilo)) {
            $resp["fs_estilo"] = $estilo;
        }

        $resp["fs_ayuda"] = $campo_formato[0]["ayuda"];



        if ($campo_formato[0]["obligatoriedad"]) {
            $resp["fs_obligatoriedad"] = true;
        } else {
            $resp["fs_obligatoriedad"] = false;
        }

        $resp["fs_acciones"] = false;

        if (preg_match("/p/", $campo_formato[0]["acciones"])) {
            $resp["fs_acciones"] = false;
        }
        if ($campo_formato[0]['etiqueta_html'] == 'arbol') {
            $resp["fs_arbol"] = "arbol_seleccionV2";
        }

        $resp["fs_etiqueta"] = $campo_formato[0]["etiqueta"];
        $resp["fs_opciones_con_decimales"] = false;
        if ($campo_formato[0]["opciones"]) {
            $opciones = json_decode($campo_formato[0]["opciones"], true);
            if ($opciones['con_decimales'] == true) {
                $resp["fs_opciones_con_decimales"] = true;
            }
        }
    }

    if (isset($opciones_defecto["data"])) {
        $resp = array_merge_recursive_distinct($resp, $opciones_defecto["data"]);
    }


    return $resp;
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