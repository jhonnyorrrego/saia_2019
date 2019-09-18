<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "assets/librerias.php");
include_once($ruta_db_superior . "formatos/librerias/funciones_generales.php");
echo (jquery());
/*ADICIONAR*/
function limpiarString($texto)
{
    $textoLimpio = preg_replace('([^ A-Za-z0-9_-ñÑ,&;@\.\-])', '', utf8_decode($texto));
    return $textoLimpio;
}

function recibir_datos($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;

    $email = busca_filtro_tabla("email,email_contrasena", "funcionario", "funcionario_codigo=" . $_SESSION["usuario_actual"], "");
    $imap_folder = imap_open("{" . SERVIDOR_CORREO_IMAP . ":" . PUERTO_SERVIDOR_CORREO . "/imap/ssl}", $email[0]['email'], $email[0]['email_contrasena']) or die("can't connect: " . imap_last_error());
    imap_createmailbox($imap_folder, imap_utf8("{" . SERVIDOR_CORREO_IMAP . ":" . PUERTO_SERVIDOR_CORREO . "/imap/ssl}Radicados SAIA"));
    imap_subscribe($imap_folder, "{" . SERVIDOR_CORREO_IMAP . ":" . PUERTO_SERVIDOR_CORREO . "/imap/ssl}Radicados SAIA");
    imap_close($imap_folder);

    if (isset($_REQUEST["cant_reg"]) && isset($_REQUEST["idgrupo"])) {
        if ($_REQUEST["cant_reg"] > 1) {
            abrir_url("radicar_correo_masivo.php?formulario=1&idgrupo=" . $_REQUEST["idgrupo"], "_self");
            die();
        } else {
            $ok = 0;
            $datos_correo = busca_filtro_tabla(fecha_db_obtener("fecha_oficio_entrada", "Y-m-d H:i") . " as fecha,*", "dt_datos_correo", "idgrupo='" . $_REQUEST["idgrupo"] . "'", "");
            if ($datos_correo["numcampos"]) {
                $ok = 1;
                $tipo_radicado = $datos_correo[0]["buzon_email"];
                if ($tipo_radicado == "Sent") {
                    $tipo_radicado = "radicacion_salida";
                } else if ($tipo_radicado == "INBOX") { //INBOX
                    $tipo_radicado = "radicacion_entrada";
                } else {
                    $tipo_radicado = "radicacion_salida";
                }
                $anexos = $datos_correo[0]["anexos"];
                $cadena_anexos = '';
                if ($anexos) {
                    $cadena_anexos = '<tr><td class="encabezado">Anexos</td><td>';
                    $cant_anexo = explode(",", $anexos);
                    for ($i = 0; $i < count($cant_anexo); $i++) {
                        $cant_anexo2 = explode("/", $cant_anexo[$i]);
                        $nombre_anexo_temporal = array_pop($cant_anexo2);
                        $nombre_real_anexo = explode('---', $nombre_anexo_temporal);
                        $cadena_anexos .= "<li>" . $nombre_real_anexo[1] . "</li>";
                    }
                    $cadena_anexos .= "</td></tr>";
                }
            }
        }
    } else {
        notificaciones_saia("Error!, Por favor intente radicar nuevamente el email");
        abrir_url($ruta_db_superior . "index_correo.php", "_self");
        die();
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("[name='uid_correo']").val('<?php echo $datos_correo[0]["uid"]; ?>');
            $("[name='buzon_correo']").val('<?php echo $datos_correo[0]["buzon_email"]; ?>');
            $('#asunto').val('<?php echo (limpiarString($datos_correo[0]["asunto"])); ?>');
            $('#de').val('<?php echo (limpiarString($datos_correo[0]["de"])); ?>');
            $("[name='tipo_radicado']").val('<?php echo ($tipo_radicado); ?>');
            $('#para').val('<?php echo (limpiarString($datos_correo[0]["para"])); ?>');
            $('input[name=anexos]').val('<?php echo (str_replace("\\", "/", ($anexos))); ?>');
            $('#fecha_oficio_entrada').val('<?php echo $datos_correo[0]["fecha"]; ?>');
            $("#formulario_formatos").find("tr:last").prev().prev().after('<?php echo ($cadena_anexos); ?>');
        });
    </script>
    <?php
    }

    /*MOSTRAR*/
    function mostrar_fecha_oficio_entrada($idformato, $iddoc)
    {
        global $conn, $datos;
        $html = "";
        $datos = busca_filtro_tabla(fecha_db_obtener("fecha_oficio_entrada", "Y-m-d H:i:s") . " as fecha_entrada1," . fecha_db_obtener("fecha_datos", "Y-m-d H:i:s") . " AS fecha_datos1,*", "ft_correo_saia", "documento_iddocumento=" . $iddoc, "");
        if ($datos["numcampos"]) {
            $html = $datos[0]["fecha_entrada1"];
        }
        echo $html;
    }

    function mostrar_para($idformato, $iddoc)
    {
        global $datos;
        echo (htmlentities($datos[0]['para']));
    }

    function mostrar_transferencia_correo($idformato, $iddoc)
    {
        global $conn, $datos, $funcionario, $ruta_db_superior;

        if ($_REQUEST["tipo"] != 5) {
            ?>
        <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
        <script type='text/javascript'>
            hs.graphicsDir = '<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
            hs.outlineType = 'rounded-white';
        </script>
<?php
    }

    $html = "";
    $funcionario = busca_filtro_tabla("nombres,apellidos,funcionario_codigo", "vfuncionario_dc", "iddependencia_cargo=" . $datos[0]['transferencia_correo'], "");
    if ($funcionario['numcampos']) {
        $html = ucwords($funcionario[0]['nombres'] . " " . $funcionario[0]['apellidos']);
    }

    if ($datos[0]['ingresar_datos_factu'] == 1 && $funcionario[0]['funcionario_codigo'] == $_SESSION["usuario_actual"]) {
        $html .= '&nbsp;&nbsp;&nbsp;<a class="highslide" style="color: black;" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 800, height: 400,preserveContent:false} )" href="reasignar_transferido.php?iddoc=' . $iddoc . '&idformato=' . $idformato . '"><button class="btn  btn-info btn-mini">Reasignar el transferido</button></a><br/>';
    }
    echo $html;
}

function ingresar_datos_factura($idformato, $iddoc)
{
    global $conn, $datos, $ruta_db_superior, $funcionario;

    $datos_fechas = busca_filtro_tabla(fecha_db_obtener('fecha_factura', 'Y-m-d') . " AS fecha_factura," . fecha_db_obtener('fecha_venc_fact', 'Y-m-d') . " AS fecha_venc_fact", "ft_correo_saia", "documento_iddocumento=" . $iddoc, "");

    $html = "";
    if ($datos[0]['ingresar_datos_factu'] == 1 && $funcionario[0]['funcionario_codigo'] == $_SESSION["usuario_actual"]) {
        $html .= '<br><a class="highslide" style="color: black;" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 800, height: 400,preserveContent:false} )" href="ingresar_datos_factura.php?iddoc=' . $iddoc . '&idformato=' . $idformato . '"><button class="btn  btn-warning">Ingresar Datos Factura</button></a><br/>';
    }
    if ($datos[0]['no_factura'] != '' || $datos[0]['nit_proveedor'] != '' || $datos[0]['centro_costo'] != '') {
        $html .= '<br/><table style="width: 100%;" border="1" cellspacing="0">';

        $html .= '<tr>
	        <td class="encabezado_list" style="text-align: left;width:30%">Fecha Factura</td>
	        <td style="text-align: left;">' . $datos_fechas[0]['fecha_factura'] . '</td>
        </tr>';

        if ($datos[0]['no_factura'] != '') {
            $html .= '<tr>
            <td class="encabezado_list" style="text-align: left;width:30%">No. de Factura</td>
            <td style="text-align: left;">' . $datos[0]['no_factura'] . '</td>
            </tr>';
        }

        $html .= '<tr>
	        <td class="encabezado_list" style="text-align: left;width:30%">Concepto de la Factura</td>
	        <td style="text-align: left;">' . $datos[0]['concepto_fact'] . '</td>
        </tr>';

        if ($datos[0]['nit_proveedor'] != '') {
            $proveedor = busca_filtro_tabla("nombre", "vejecutor", "iddatos_ejecutor=" . $datos[0]['nit_proveedor'], "");
            $html .= '<tr>
            <td class="encabezado_list" style="text-align: left;width:30%">Proveedor</td>
            <td style="text-align: left;">' . $proveedor[0]['nombre'] . '</td>
            </tr>';
        }

        if ($datos[0]['centro_costo'] != '') {
            $html .= '<tr>
            <td class="encabezado_list" style="text-align: left;width:30%">Centro de Costos</td>
            <td style="text-align: left;">' . $datos[0]['centro_costo'] . '</td>
            </tr>';
        }

        $html .= '<tr>
	        <td class="encabezado_list" style="text-align: left;width:30%">Valor de la Factura</td>
	        <td style="text-align: left;">' . $datos[0]['valor_factura'] . '</td>
        </tr>';

        $pago_desde = array(1 => 'Fecha factura', 2 => 'Fecha oficio entrada');

        $html .= '<tr>
	        <td class="encabezado_list" style="text-align: left;width:30%">Fecha de Pago Desde</td>
	        <td style="text-align: left;">' . $pago_desde[$datos[0]['pago_desde']] . '</td>
        </tr>';

        $html .= '<tr>
	        <td class="encabezado_list" style="text-align: left;width:30%">Cant. Dias de Pago</td>
	        <td style="text-align: left;">' . $datos[0]['cant_dias'] . '</td>
        </tr>';

        $html .= '<tr>
	        <td class="encabezado_list" style="text-align: left;width:30%">Fecha Vencimiento Factura</td>
	        <td style="text-align: left;">' . $datos_fechas[0]['fecha_venc_fact'] . '</td>
        </tr>';

        $responsable = busca_filtro_tabla('nombres,apellidos', 'funcionario', 'funcionario_codigo=' . $datos[0]['responsable_datos_fa'], '');
        $html .= '<tr>
        <td class="encabezado_list" style="text-align: left;width:30%">Fecha y Hora</td>
        <td style="text-align: left;">' . $datos[0]['fecha_datos1'] . '</td>
        </tr>';
        $html .= '<tr>
        <td class="encabezado_list" style="text-align: left;width:30%">Responsable</td>
        <td style="text-align: left;">' . $responsable[0]['nombres'] . ' ' . $responsable[0]['apellidos'] . '</td>
        </tr>';
        $html .= '</table>';
    }
    echo ($html);
}

/*POSTERIOR ADICIONAR*/
function guardar_anexos($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;
    require_once($ruta_db_superior . "anexosdigitales/funciones_archivo.php");
    $datos = busca_filtro_tabla("anexos,numero", "ft_correo_saia,documento", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "");
    $vector = explode(",", $datos[0]['anexos']);
    for ($i = 0; $i < count($vector); $i++) {
        $ruta_real = $ruta_db_superior . "roundcubemail/" . $vector[$i];
        if (file_exists($ruta_real)) {
            $dir_anexos = selecciona_ruta_anexos2($iddoc, "archivos");
            $archivo = uniqid() . "_" . basename($ruta_real);

            $almacenamiento = new SaiaStorage("archivos");
            $resultado = $almacenamiento->copiar_contenido_externo($ruta_real, $dir_anexos . $archivo);
            if ($resultado) {
                $dir_anexos_1 = array(
                    "servidor" => $almacenamiento->get_ruta_servidor(),
                    "ruta" => $dir_anexos . $archivo
                );
                $datos_anexo = pathinfo($ruta_real);
                $consulta_campos_formato = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre='anexos' and formato_idformato=" . $idformato, "");
                $sql = "INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,fecha_anexo,formato,campos_formato) values(" . $iddoc . ",'" . json_encode($dir_anexos_1) . "','" . $datos_anexo["extension"] . "','" . $archivo . "'" . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'" . $idformato . "','" . $consulta_campos_formato[0]['idcampos_formato'] . "')";
                phpmkr_query($sql) or die("Error al registrar el anexo");
                $idanexo = phpmkr_insert_id();
                if ($idanexo) {
                    $sql1 = "insert into permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_total)values('" . $idanexo . "', '" . $_SESSION["idfuncionario"] . "', 'lem', 'l')";
                    phpmkr_query($sql1) or die("Error al registrar los permisos del anexo");
                }
            }
        }
    }
    return;
}

/*POSTERIOR APROBAR*/
function post_aprob_correo_saia($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;
    $datos = busca_filtro_tabla("uid_correo,buzon_correo,transferencia_correo,numero", "ft_correo_saia,documento", "documento_iddocumento = iddocumento and documento_iddocumento=" . $iddoc, "");
    if ($datos["numcampos"]) {
        notificaciones_saia("El documento ha sido radicado con el numero " . $datos[0]["numero"], "success");
        $email = busca_filtro_tabla("email,email_contrasena", "funcionario", "funcionario_codigo=" . $_SESSION["usuario_actual"], "");

        $imapStream = imap_open("{" . SERVIDOR_CORREO_IMAP . ":" . PUERTO_SERVIDOR_CORREO . "/imap/ssl}" . $datos[0]["buzon_correo"], $email[0]['email'], $email[0]['email_contrasena']) or die("can't connect: " . imap_last_error());
        echo $move = imap_mail_move($imapStream, $datos[0]["uid_correo"], 'Radicados SAIA', CP_UID);
        imap_close($imapStream, CL_EXPUNGE);
        if ($datos[0]["buzon_correo"] == "Sent") {
            if (!$_REQUEST["no_redirecciona"]) {
                despachar_documento($iddoc);
            }
        }
        transferencia_automatica($idformato, $iddoc, $datos[0]["transferencia_correo"], 1);
        transferencia_automatica($idformato, $iddoc, "copia_correo", 2, 'COPIA');

        if (!$_REQUEST["no_redirecciona"]) {
            //notificaciones_saia("El documento ha sido radicado con el numero " . $datos[0]["numero"], "success");
            abrir_url($ruta_db_superior . "index_correo.php", "_self");
        }
    }
}

function despachar_documento($iddoc)
{
    $_REQUEST["x_empresa0"] = usuario_actual("nombres") . " " . usuario_actual("apellidos");
    $_REQUEST["x_responsable0"] = usuario_actual("nombres") . " " . usuario_actual("apellidos");
    $notificacion = false;
    $envio = busca_filtro_tabla("valor", "configuracion", "nombre='correo_despacho'", "");
    if ($envio["numcampos"] > 0 && $envio[0]["valor"] == 1)
        $notificacion = true;
    $destinos = explode(",", $iddoc);
    $empresa = @$_REQUEST["x_empresa0"];
    $guia = 0;
    $responsable = (htmlspecialchars_decode(html_entity_decode((trim($_REQUEST["x_responsable0"])))));
    $lresponsable = busca_filtro_tabla("A.*", "ejecutor A", "A.nombre LIKE '" . $responsable . "'", "");
    if ($lresponsable["numcampos"]) {
        $idresponsable = $lresponsable[0]["idejecutor"];
    } else if ($responsable <> "") {
        $sql = "INSERT INTO ejecutor(nombre) VALUES('" . $responsable . "')";
        phpmkr_query($sql);
        $idresponsable = phpmkr_insert_id();
    }
    $lempresa = busca_filtro_tabla("A.*", "ejecutor A", "A.nombre LIKE'" . $empresa . "'", "");
    if ($lempresa["numcampos"]) {
        $idempresa = $lempresa[0]["idejecutor"];
    } else if ($empresa <> "") {
        $sql = "INSERT INTO ejecutor(nombre) VALUES('" . $empresa . "')";
        phpmkr_query($sql);
        $idempresa = phpmkr_insert_id();
    }
    if ($idresponsable <> "") {
        $datos["origen"] = $_SESSION["usuario_actual"];
        $enviado = usuario_actual("login");
        for ($i = 0; $i < count($destinos); $i++) {
            $ejecutores = array();
            $ejecutor["numcampos"] = 0;
            $ejecutor = busca_filtro_tabla("ejecutor", "documento", "iddocumento=" . $destinos[$i], "");
            if ($ejecutor["numcampos"]) {
                array_push($ejecutores, $ejecutor[0]["ejecutor"]);
                $ejecutores = array_unique($ejecutores);
            }
            if ($idempresa == "")
                $valores = "'" . $guia . "','" . $destinos[$i] . "',NULL,'$idresponsable'";
            elseif ($idresponsable == "")
                $valores = "'" . $guia . "','" . $destinos[$i] . "','" . $idempresa . "',NULL";
            else
                $valores = "'" . $guia . "','" . $destinos[$i] . "','" . $idempresa . "','$idresponsable'";

            $valores .= "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s");
            $sql = "INSERT INTO salidas(numero_guia,documento_iddocumento,empresa,responsable,fecha_despacho,tipo_despacho) VALUES (" . $valores . ",'1')";
            phpmkr_query($sql);

            $sql = "update documento set estado='GESTION',tipo_despacho='1' where iddocumento=" . $destinos[$i];
            phpmkr_query($sql);

            $datos["archivo_idarchivo"] = $destinos[$i];
            $datos["tipo_destino"] = 1;
            $datos["tipo"] = "";
            $datos["nombre"] = "DISTRIBUCION";
            $otros["notas"] = "Se despacho el documento por correo electronico";
            transferir_archivo_prueba($datos, $ejecutores, $otros);
        }
    } else {
        alerta("No se puede realizar el despacho");
    }
}

?>