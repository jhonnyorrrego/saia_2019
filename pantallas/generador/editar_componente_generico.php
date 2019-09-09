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
include_once($ruta_db_superior . "assets/librerias.php");

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . "pantallas/generador/librerias.php";

$componente = busca_filtro_tabla("nombre, etiqueta, clase, opciones_propias", "pantalla_componente", "idpantalla_componente=" . $_REQUEST["idpantalla_componente"], "", $conn);
$texto_titulo = $componente[0]["etiqueta"];
$nombre_componente = $componente[0]["nombre"];
$valores = array();
$idpantalla_campos = null;
if (@$_REQUEST["idpantalla_campos"]) {
    $idpantalla_campos = $_REQUEST["idpantalla_campos"];
    $pantalla_campos = get_pantalla_campos($_REQUEST["idpantalla_campos"], 0);

    $valores["fs_nombre"] = $pantalla_campos[0]["nombre"];
    $valores["fs_etiqueta"] = html_entity_decode($pantalla_campos[0]["etiqueta"]);

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

    //V1. $opciones_propias = json_decode(mb_convert_encoding($pantalla_campos[0]["opciones_propias"], 'UTF-8', 'UTF-8'), true);
    //V2. $opciones_propias = json_decode(utf8_encode($pantalla_campos[0]["opciones_propias"]), true);
    $opciones_propias = json_decode(html_entity_decode($pantalla_campos[0]["opciones_propias"]), true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $val_default = array();
        if (isset($opciones_propias["data"]) && is_array($valores)) {
            $val_default = $opciones_propias["data"];
            $resultado = array_merge_recursive($val_default, $valores);
            $opciones_propias["data"] = $resultado;
        } else if (is_array($valores)) {
            $opciones_propias["data"] = $valores;
        }
    } else {
        //print_r(json_last_error_msg());
        //die();
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
    <meta charset="utf-8" />
    <title>Configuraci&oacute;n del campo
        <?= $texto_titulo ?>
    </title>

    <style type="text/css">
        label {
            vertical-align: middle;
        }
    </style>
    <!-- handlebars -->

    <script type="text/javascript" src="<?= $ruta_db_superior ?>node_modules/handlebars/dist/handlebars.js"></script>
    <!-- alpaca -->
    <!-- <script type="text/javascript" src="<?= $ruta_db_superior ?>assets/theme/assets/js/alpaca.min.js"></script> -->

    <script type="text/javascript" src="<?= $ruta_db_superior ?>node_modules/alpaca/dist/alpaca/bootstrap/alpaca.min.js"></script>

    <script type="text/javascript" src="<?= $ruta_db_superior ?>views/generador/js/editar_componente_generico.js"></script>

    <link href="<?= $ruta_db_superior ?>node_modules/alpaca/dist/alpaca/web/alpaca.min.css" rel="stylesheet" type="text/css" />

    <style>
        #tipo_campo {
            font-size: 30px;
        }

        .btn-complete {
            background: #48b0f7;
            color: #fff;
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
    </style>


</head>

<body>
    <h5 id="tipo_formato"><?= html_entity_decode(utf8_encode($texto_titulo)) ?></h5>
    <hr />
    <div class="container">
        <form id="editar_pantalla_campo" name="editar_pantalla_campo"></form>
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

            if (!opciones_form.hasOwnProperty("options")) {
                console.log(opciones_form);
            } else {
                opciones_form["options"]["fields"]["fs_etiqueta"] = {
                    events: {
                        change: function(evt) {
                            var value = $(evt.target).val();
                            if (value) {
                                value = normalizar(value);
                                $("[name='fs_nombre']").val(value);
                            }
                        }
                    }
                };
            }

            /*opciones_form["params"] = {
                "fieldHtmlClass": "input-small"
            };*/

            //console.log(opciones_form);

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
                    submit: {
                        "title": "Guardar",
                        "styles": "btn btn-complete d-none",
                        "id": "btnGuardar",
                        "click": function() {
                            this.refreshValidationState(true);
                            if (this.isValid(true)) {
                                var value = this.getValue();
                                funcion_enviar(value, idpantalla_campo);
                                top.successModalEvent(value);
                            }
                        }
                    },
                }
            };

            $('#btnGuardar').hide();
            $('#btnGuardar').css('display', 'none');
            $('#btnGuardar').css('visibility', 'hidden');

            $("#btn_success").click(function() {


                $("#btnGuardar").trigger("click");

            });

            console.log(opciones_form);

            $('#editar_pantalla_campo').alpaca(opciones_form);


        });

        function funcion_enviar(datos, idpantalla_campo) {

            // datos["ejecutar_campos_formato"] = "set_pantalla_campos";
            ///datos["tipo_retorno"] = 1;
            //datos["idpantalla_campos"] = idpantalla_campo;

            var evitar_html = ["datetime", "textarea_cke"];

            $.ajax({
                type: 'POST',
                url: "<?php echo ($ruta_db_superior); ?>pantallas/generador/librerias.php?" + datos + "&ejecutar_campos_formato=set_pantalla_campos&tipo_retorno=1&idpantalla_campos=" + idpantalla_campo,
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


        $opciones = json_decode(html_entity_decode($campo_formato[0]["opciones"]), true);

        //$opciones_propias = json_decode(utf8_encode($pantalla_campos[0]["opciones_propias"]), true);
        if (json_last_error() === JSON_ERROR_NONE && !empty($opciones)) {
            $resp["fs_opciones"] = $opciones;
        }
        $estilo = json_decode(mb_convert_encoding($campo_formato[0]["estilo"], 'UTF-8', 'UTF-8'), true);
        //$opciones_propias = json_decode(utf8_encode($pantalla_campos[0]["opciones_propias"]), true);
        if (json_last_error() === JSON_ERROR_NONE && !empty($estilo)) {
            $resp["fs_estilo"] = $estilo;
        }

        $resp["fs_ayuda"] = html_entity_decode($campo_formato[0]["ayuda"]);



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

        $resp["fs_nombre"] = $campo_formato[0]["nombre"];
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