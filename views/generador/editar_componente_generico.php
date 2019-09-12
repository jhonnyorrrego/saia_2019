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
include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'views/generador/librerias.php';

$componente = Model::getQueryBuilder()
    ->select("nombre", "etiqueta", "clase", "opciones_propias")
    ->from("pantalla_componente")
    ->where("idpantalla_componente = :idpantalla")
    ->setParameter("idpantalla", $_REQUEST["idpantalla_componente"], \Doctrine\DBAL\Types\Type::INTEGER)
    ->execute()->fetchAll();

$texto_titulo = $componente[0]["etiqueta"];
$nombre_componente = $componente[0]["nombre"];
$valores = array();
$idpantalla_campos = null;
if (@$_REQUEST["idpantalla_campos"]) {
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
} else {
    alerta("No es posible Editar el Campo");
}
$opciones_str = json_encode($opciones_propias, JSON_NUMERIC_CHECK);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Configuraci&oacute;n del campo
    </title>
    <style type="text/css">
        label {
            vertical-align: middle;
        }
    </style>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= moment() ?>
    <?= jqueryUi() ?>
    <?= jsPanel() ?>

    <script type="text/javascript" src="<?= $ruta_db_superior ?>node_modules/handlebars/dist/handlebars.js"></script>
    <script type="text/javascript" src="<?= $ruta_db_superior ?>node_modules/alpaca/dist/alpaca/bootstrap/alpaca.js"></script>
    <style>
        /*@font-face {
            font-family: 'Glyphicons Halflings';
            src: url(<?= $ruta_db_superior ?>'node_modules/glyphicons-only-bootstrap/fonts/glyphicons-halflings-regular.eot');
            src: url(<?= $ruta_db_superior ?>'node_modules/glyphicons-only-bootstrap/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url(<?= $ruta_db_superior ?>'node_modules/glyphicons-only-bootstrap/fonts/glyphicons-halflings-regular.woff') format('woff'), url(<?= $ruta_db_superior ?>'node_modules/glyphicons-only-bootstrap/fonts/glyphicons-halflings-regular.ttf') format('truetype'), url(<?= $ruta_db_superior ?>'node_modules/glyphicons-only-bootstrap/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular') format('svg');
        }*/


        @font-face {
            font-family: 'Glyphicons';
            font-style: normal;
            font-weight: 400;
            src: url(<?= $ruta_db_superior ?>'node_modules/glyphicons-only-bootstrap/fonts/glyphicons-halflings-regular.ttf') format('ttf');
            font-size: 232px;
        }

        #editar_pantalla_campo {

            font-family: 'Glyphicons';

        }

        #prueba {

            font-family: 'Glyphicons';

        }

        #tipo_campo {
            font-size: 30px;
        }

        .btn-complete {
            background: #48b0f7;
            color: #fff;
            position: absolute;
            right: 30px;
            bottom: 30px;

        }

        .btn-complete:hover {
            background: #2690d5;
            color: #fff;
        }

        .btn-danger {
            color: #fff;
            position: absolute;
            right: 130px;
            bottom: 30px;
            cursor: pointer;
            z-index: 1;
        }

        .form-group label:not(.error) {
            text-transform: none;
            font-weight: bold;
            color: #626262;
            font-size: 12px;
        }

        .form-control {
            font-size: 12px;
            color: #626262;
        }

        #btn-cerrar {
            position: absolute;
            right: 20px;
            top: 10px;
            color: #666;
            font-size: 150%;
            width: 20px;
            height: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        #btn-cerrar:hover {

            color: #444;

        }
    </style>
</head>

<body>
    <div id="btn-cerrar">&times;</div>
    <div class="container">
        <div class="mb-4 mt-4 text-center">
            <h5>Configurar Campo</h5>
            <h6><?= $texto_titulo ?></h6>
        </div>
        <hr />
        <div id="prueba"><i class="glyphicon glyphicon-plus-sign"></i>fdlafldjl</div>
        <form id="editar_pantalla_campo" name="editar_pantalla_campo"></form>
        <div class="my-5"></div>
        <div id="res" class="alert"></div>
    </div>
    <script type="text/javascript">
        var nombre_componente = "<?= $nombre_componente ?>";
        var con_numeros = ["archivo", "moneda", "spin"];
        var opciones_form = <?= $opciones_str ?>;

        $(document).ready(function() {

            var rutaSuperior = "<?= $ruta_db_superior ?>";
            var idpantalla_campo = <?= $idpantalla_campos ?>;
            opciones_form["onSubmit"] = function(errors, values) {
                if (errors) {
                    console.log(errors);
                    $('#res').html('<p>Error al validar</p>');
                } else {
                    console.log(JSON.stringify(values.fs_valor));
                    console.log(JSON.stringify(values.fs_acciones));
                }
            };
            opciones_form["view"] = {
                "id": "jqueryui-create",
                "locale": "es_ES",
                "messages": {
                    "es_ES": {
                        "stringNotANumber": "Escriba sólo números"
                    }
                }
            };
            opciones_form["postRender"] = function() {
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
            };
            opciones_form["options"]['form'] = {
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
            $('#editar_pantalla_campo').alpaca(opciones_form);
        });

        $('#btn-cerrar').on('click', function() {

            var panel = $('.jsPanel-standard', parent.document).get(0);
            jsPanel.close(panel);

        });

        function configurarPanel() {
            var panel = $('.jsPanel-standard', parent.document).get(0);
            ////////////////////////// Cambiar el tamaño de jspanel de acuerdo al tamaño del formulario
            $('.jsPanel-standard', parent.document).height($('#editar_pantalla_campo').height() + 260);
            /////////////////////// Rectificar redimension de altura de la pantalla en caso de no hacerlo anteriormente////////////////////
            setTimeout(function() {
                $('.jsPanel-standard', parent.document).height($('#editar_pantalla_campo').height() + 260);
            }, 200);
            ///////////////////// Configurando el estilo del header ///////////////////////////////
            $('#btnCancelar', '#editar_pantalla_campo').removeClass('d-none');
            $('#btnCancelar', '#editar_pantalla_campo').addClass('d-inline');
            $('#btnGuardar', '#editar_pantalla_campo').removeClass('d-none');
            $('#btnGuardar', '#editar_pantalla_campo').addClass('d-inline');

        }
        setTimeout('configurarPanel()', 300);

        function funcion_enviar(datos, idpantalla_campo) {

            var evitar_html = ["datetime", "textarea_cke"];
            $.ajax({
                type: 'POST',
                url: "<?php echo ($ruta_db_superior); ?>views/generador/librerias.php?" + datos + "&ejecutar_campos_formato=set_pantalla_campos&tipo_retorno=1&idpantalla_campos=" + idpantalla_campo,
                data: datos,
                async: false,
                dataType: "json",
                success: function(objeto) {
                    console.log("datos: " + objeto);
                    if (objeto && objeto.exito) {
                        $('#cargando_enviar').html("Terminado ...");
                        $("#pc_" + idpantalla_campo, parent.document).find(".control-label").html("<b>" + objeto.etiqueta + "</b>");
                        if (!evitar_html.includes(nombre_componente)) {
                            $("#pc_" + idpantalla_campo, parent.document).replaceWith(objeto.codigo_html);
                        } else {
                            if (objeto.etiqueta_html == "fecha" && objeto.obligatoriedad != 0) {
                                $("#pc_" + idpantalla_campo + " span:first", parent.document).html("<b>" + objeto.etiqueta + "*</b>");
                            } else if (objeto.etiqueta_html == "fecha" && objeto.obligatoriedad == 0) {
                                $("#pc_" + idpantalla_campo + " span:first", parent.document).html("<b>" + objeto.etiqueta + "</b>");
                            } else if (objeto.etiqueta_html == "textarea_cke" && objeto.obligatoriedad != 0) {
                                $("#pc_" + idpantalla_campo + " span:first", parent.document).html("<b>" + objeto.etiqueta + "*</b>");
                            } else if (objeto.etiqueta_html == "textarea_cke" && objeto.obligatoriedad == 0) {
                                $("#pc_" + idpantalla_campo + " span:first", parent.document).html("<b>" + objeto.etiqueta + "</b>");
                            }
                        }

                    } else if (objeto && objeto.exito == 0) {
                        notificacion_saia("El nombre del campo ya existe en el formato", "error", "", 3500);
                    }

                }
            });

        }
    </script>
</body>

</html>
<?php
function obtener_valores_campo($idcampo_formato, $opciones_defecto)
{
    global $conn;
    $resp = array();

    $campo_formato = busca_filtro_tabla("nombre, etiqueta, opciones, estilo, ayuda, etiqueta_html", "campos_formato", "idcampos_formato=$idcampo_formato", "", $conn);

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