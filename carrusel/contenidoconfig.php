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
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_cripto.php";
include_once("../calendario/calendario.php");
echo estilo_bootstrap();
?>
<?= dropzone() ?>
<div class="container" style="overflow-y:auto; height:100%">
    <h6>CONFIGURACI&Oacute;N DE CARRUSEL Y CONTENIDOS RELACIONADOS</h6>
    <?php
    $campos = array(
        "nombre",
        "carrusel_idcarrusel",
        "orden",
        "align",
        "preview"
    );

    $datos = array();
    if (!empty($_REQUEST["fecha_inicio"]) && !empty($_REQUEST["fecha_fin"])) {
        $datos["fecha_inicio"] = fecha_db_almacenar($_REQUEST["fecha_inicio"], "Y-m-d");
        $datos["fecha_fin"] = fecha_db_almacenar($_REQUEST["fecha_fin"], "Y-m-d");
    }

    $accion = $_REQUEST["accion"];
    foreach ($campos as $fila) {
        $datos[$fila] = "'" . $_REQUEST[$fila] . "'";
    }

    switch ($accion) {
        case "adicionar":
        case "editar":
            pintar_formulario($accion);
            break;
        case "guardar_adicionar":
            guardar_adicionar($accion, $datos);
            break;
        case "guardar_editar":
            guardar_editar($accion, $datos);
            break;
        case "eliminar":
            $sql = "delete from contenidos_carrusel where idcontenidos_carrusel=" . $_REQUEST["id"];
            phpmkr_query($sql, $conn);
            redirecciona($ruta_db_superior . "carrusel/sliderconfig.php");
            break;
    }

    /**
     * @param accion
     */

    function pintar_formulario($accion)
    {
        global $ruta_db_superior, $conn;
        if (isset($_REQUEST["id"]) && $_REQUEST["id"]) {
            $contenido = busca_filtro_tabla("contenidos_carrusel.*," . fecha_db_obtener('fecha_inicio', 'Y-m-d') . " as fecha_inicio," . fecha_db_obtener('fecha_fin', 'Y-m-d') . " as fecha_fin", "contenidos_carrusel", "idcontenidos_carrusel=" . $_REQUEST["id"], "", $conn);
        }
        ?>
            <script type="text/javascript" src="../js/jquery.js"></script>
            <script type="text/javascript" src="../js/jquery.validate.js"></script>
            <style>
                .error {
                    color: red;
                }
            </style>

            <script type='text/javascript'>
                $().ready(function() {
                    $('#form1').validate({
                        submitHandler: function(form) {
                            form.submit();

                        }
                    });

                });
                opciones = [
                    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'],
                    ['Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
                    ['Image', 'Flash', 'Table', 'HorizontalRule'],
                    ['Link', 'Unlink'],
                    ['TextColor', 'BGColor'],
                    ['Source'],
                    '/',
                    ['Font', 'FontSize'],
                    ['Bold', 'Italic', 'Underline', 'Strike'],
                    ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
                    ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote']
                ];
            </script>
            <ul class="nav nav-tabs">
                <li><a href='sliderconfig.php'>Inicio</a></li>
                <?php if ($accion == 'adicionar') { ?>

                    <li><a href='sliderconfig.php?accion=adicionar'>Adicionar Carrusel</a></li>
                    <li class="active"><a href='contenidoconfig.php?accion=adicionar'>Adicionar Contenido</a></li>
                <?php
                    } else { ?>

                    <li><a href='sliderconfig.php?accion=adicionar'>Adicionar Carrusel</a></li>
                    <li><a href='contenidoconfig.php?accion=adicionar'>Adicionar Contenido</a></li>
                    <li class="active"><a href='#'>Editar Contenido</a></li>
                <?php
                    } ?>

            </ul>
            <?php
                echo "<fieldset><legend>" . ucwords($accion . " contenido") . "</legend></fieldset><form action='contenidoconfig.php' name='form1' method='post' id='form1' enctype='multipart/form-data'><table class='table table-bordered table-striped'>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>NOMBRE*</td><td><input class='required'  type='text' name='nombre' value='" . @$contenido[0]["nombre"] . "'></td></tr>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>CARRUSEL*</td><td><select class='required'  type='text' name='carrusel_idcarrusel'>";
                $carrusel = busca_filtro_tabla("idcarrusel,nombre", "carrusel", "", "nombre", $conn);
                for ($i = 0; $i < $carrusel["numcampos"]; $i++) {
                    echo "<option value='" . $carrusel[$i]["idcarrusel"] . "' ";
                    if ($carrusel[$i]["idcarrusel"] == @$contenido[0]["carrusel_idcarrusel"]) {
                        echo " selected ";
                    }
                    echo ">" . $carrusel[$i]["nombre"] . "</option>";
                }
                echo "</select></td></tr>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>FECHA DE PUBLICACI&Oacute;N*</td><td>" . '<input type="text" readonly="true" name="fecha_inicio"  class="required dateISO"  id="fecha_inicio" value="' . @$contenido[0]["fecha_inicio"] . '">';
                selector_fecha("fecha_inicio", "form1", "Y-m-d", date("m"), date("Y"), "default.css", "../", "AD:VALOR");
                echo "</td></tr>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>FECHA CADUCIDAD*</td><td>";
                echo '<input type="text" readonly="true" name="fecha_fin"  class="required dateISO"  id="fecha_fin" value="' . @$contenido[0]["fecha_fin"] . '">';
                selector_fecha("fecha_fin", "form1", "Y-m-d", date("m"), date("Y"), "default.css", "../", "AD:VALOR");
                echo "</td></tr>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>CONTENIDO*</td><td><textarea class='required tiny_avanzado2' name='contenido' id='contenido'>" . stripslashes(@$contenido[0]["contenido"]) . "</textarea></td></tr>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>PREVISUALIZAR</td><td><textarea name='preview' id='preview' class=''>" . stripslashes(codifica_encabezado(html_entity_decode(@$contenido[0]["preview"]))) . "</textarea></td></tr>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;'>IMAGEN</td><td>";
                if ($contenido[0]["imagen"] != "") {
                    echo "<a href='" . $ruta_db_superior . 'filesystem/mostrar_binario.php?ruta=' . base64_encode($contenido[0]["imagen"]) . "' target='_blank'>Ver Imagen Actual</a><br />Borrar Imagen<input type='checkbox' value='1' name='borrar_imagen'><br />Subir nueva";
                }
                echo '<div id="dz_carrusel"><div class="dz-message"><span>Arrastre aquí los archivos adjuntos</span></div></div>';
                echo "</td></tr>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;' width=20%>ALINEACION DE LA IMAGEN</td><td>";
                $opciones = array(
                    "left" => "Izquierda",
                    "right" => "Derecha"
                );
                foreach ($opciones as $valor => $nombre) {
                    echo "<input type='radio' name='align' value='$valor' ";
                    if ($valor == @$contenido[0]["align"]) {
                        echo " checked ";
                    }
                    echo ">$nombre&nbsp;&nbsp;";
                }
                echo "</td></tr>";
                echo "<tr><td  style='text-align: center; background-color:#57B0DE; color: #ffffff;' width=20%>Orden*</td><td><input class='required'  type='number' min=0 name='orden' id='orden' value='" . @$contenido[0]["orden"] . "'></td></tr>";
                echo "<tr><td><input class='btn btn-primary' type='submit' value='Continuar'>
   <input type='hidden' name='id' value='" . @$contenido[0]["idcontenidos_carrusel"] . "'>
   <input type='hidden' name='accion' value='guardar_" . @$accion . "'>
   <input type='hidden' id='form_uuid' name='form_uuid' value='" . uniqid() . "-" . uniqid() . "'>
   </td></tr>";
                echo "</table></form>";
                ?>
            <script type="text/javascript">
                var upload_url = '<?php echo $ruta_db_superior; ?>app/temporal/cargar_archivos_anexos.php';
                var form_uuid = $('#form_uuid').val();
                var lista_archivos = [];
                Dropzone.autoDiscover = false;
                var dz = new Dropzone("#dz_carrusel", {
                    url: upload_url,
                    maxFiles: 1,
                    acceptedFiles: ".jpg",
                    paramName: "imagen",
                    addRemoveLinks: true,
                    dictRemoveFile: 'Quitar archivo',
                    dictMaxFilesExceeded: 'No puede subir mas archivos',
                    dictResponseError: 'El servidor respondió con código {{statusCode}}',
                    uploadMultiple: false,
                    params: {
                        Adicionar: 5,
                        uuid: form_uuid,
                        nombre_campo: "imagen",
                    },
                    success: function(file, response) {
                        for (var key in response) {
                            if (Array.isArray(response[key])) {
                                for (var i = 0; i < response[key].length; i++) {
                                    archivo = response[key][i];
                                    if (archivo.original_name == file.upload.filename) {
                                        lista_archivos[file.upload.uuid] = archivo.id;
                                    }
                                }
                            } else {
                                if (response[key].original_name == file.upload.filename) {
                                    lista_archivos[file.upload.uuid] = response[key].id;
                                }
                            }
                        }
                    },
                    removedfile: function(file) {
                        if (lista_archivos && lista_archivos[file.upload.uuid]) {
                            $.ajax({
                                url: upload_url,
                                type: 'POST',
                                data: {
                                    accion: 'eliminar_temporal',
                                    archivo: lista_archivos[file.upload.uuid]
                                }
                            });
                        }
                        if (file.previewElement != null && file.previewElement.parentNode != null) {
                            file.previewElement.parentNode.removeChild(file.previewElement);
                        }
                        return this._updateMaxFilesReachedClass();
                    },

                });
                $("#dz_carrusel").addClass('dropzone');
            </script>
        <?php

        }

        function guardar_adicionar($accion, $datos)
        {
            global $ruta_db_superior, $conn;


            $sql1 = "insert into contenidos_carrusel(" . implode(",", array_keys($datos)) . ") values(" . implode(",", array_values($datos)) . ")";
            phpmkr_query($sql1, $conn);
            $id = phpmkr_insert_id();
            guardar_lob("contenido", "contenidos_carrusel", "idcontenidos_carrusel=" . $id, $_REQUEST["contenido"], "texto", $conn);

            guardar_archivos($id, $_REQUEST["form_uuid"]);
            redirecciona($ruta_db_superior . "carrusel/sliderconfig.php");
        }


        function guardar_editar($accion, $datos)
        {
            global $ruta_db_superior, $conn;

            $fields = array();
            foreach ($datos as $field => $val) {
                $fields[] = "$field = $val";
            }

            $id = $_REQUEST["id"];
            $sql1 = "update contenidos_carrusel set " . implode(",", $fields) . " where idcontenidos_carrusel=" . $id;

            phpmkr_query($sql1, $conn);
            guardar_lob("contenido", "contenidos_carrusel", "idcontenidos_carrusel=" . $id, $_REQUEST["contenido"], "texto", $conn);

            if ($accion == "guardar_editar" && @$_REQUEST["borrar_imagen"]) {
                $contenido = busca_filtro_tabla("imagen", "contenidos_carrusel", "idcontenidos_carrusel=$id", "", $conn);
                if (MOTOR == "MySql") {
                    phpmkr_query("update contenidos_carrusel set imagen=null where idcontenidos_carrusel=$id");
                } else if (MOTOR == "Oracle") {
                    phpmkr_query("update contenidos_carrusel set imagen=empty_blob() where idcontenidos_carrusel=$id");
                }
                @unlink($ruta_db_superior . $contenido[0]["imagen"]);
            }

            guardar_archivos($id, $_REQUEST["form_uuid"]);
            redirecciona($ruta_db_superior . "carrusel/sliderconfig.php");
        }


        /**
         * @param id
         */

        function guardar_archivos($id, $form_uuid)
        {
            global $ruta_db_superior, $conn;

            $archivos = busca_filtro_tabla("", "anexos_tmp", "uuid = '$form_uuid'", "", $conn);
            for ($j = 0; $j < $archivos["numcampos"]; $j++) {
                $ruta_temporal = $ruta_db_superior . $archivos[$j]["ruta"];

                if (file_exists($ruta_temporal)) {

                    require_once $ruta_db_superior . 'filesystem/StorageUtils.php';
                    require_once $ruta_db_superior . 'filesystem/SaiaStorage.php';

                    $datos_anexo = pathinfo($ruta_temporal);
                    $extension = $datos_anexo["extension"];

                    $aleatorio = uniqid();
                    $tipo_almacenamiento = new SaiaStorage("imagenes");
                    $imagen_reducida = RUTA_CARRUSEL_IMAGENES . $aleatorio . "." . $extension;
                    $resultado = $tipo_almacenamiento->almacenar_recurso($imagen_reducida, $ruta_temporal, false);

                    $ruta_anexos = array(
                        "servidor" => $tipo_almacenamiento->get_ruta_servidor(),
                        "ruta" => $imagen_reducida
                    );
                    if ($tipo_almacenamiento->get_filesystem()->has($imagen_reducida)) {
                        $ruta_anexos = json_encode($ruta_anexos);
                        $sql1 = "update contenidos_carrusel set imagen='" . $ruta_anexos . "' where idcontenidos_carrusel=" . $id;
                        phpmkr_query($sql1, $conn);

                        @unlink($ruta_temporal);
                        unlink("$ruta_temporal.lock");
                        //Eliminar los pendientes de la tabla temporal
                        $sql2 = "DELETE FROM anexos_tmp WHERE idanexos_tmp = " . $archivos[$j]["idanexos_tmp"];
                        phpmkr_query($sql2) or die($sql2);
                    }
                }
            }
        }
        ?>
</div>