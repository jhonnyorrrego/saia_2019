<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "assets/librerias.php");
include_once($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior . "calendario/calendario.php");
echo (librerias_html5());
echo (jquery());
echo (bootstrap());
echo (librerias_validar_formulario('11'));

$iddoc = @$_REQUEST['iddoc'];
$idformato = @$_REQUEST['idformato'];

if (@$_REQUEST['continuar']) {

    $update = array();
    if ($_REQUEST['continuar'] == 'Guardar') {
        $update[] = "ingresar_datos_factu=2";
    }

    $array_anexos = array();

    foreach ($_FILES["adjunto_imagen"]["name"] as $key => $value) {
        if ($_FILES["adjunto_imagen"]["tmp_name"][$key]) {
            $tmpfile  = $_FILES["adjunto_imagen"]["tmp_name"][$key];   // temp filename      
            $filename = $_FILES["adjunto_imagen"]["name"][$key];      // Original filename
            $handle   = fopen($tmpfile, "r");                  // Open the temp file
            $contents = fread($handle, filesize($tmpfile));  // Read the temp file
            fclose($handle);                                 // Close the temp file
            $decodeContent = base64_encode($contents);
            $array_anexos[$key] = array(
                "filename"  => $filename,
                "content"   => $decodeContent,
                "extencion" => $_FILES["adjunto_imagen"]["type"][$key]
            );
        }
    }
    $info = busca_filtro_tabla("d.numero,d.estado," . fecha_db_obtener("d.fecha", "Y-m") . " as fecha,d.ejecutor,d.pdf, ft.*", "ft_correo_saia ft,documento d", " ft.documento_iddocumento=d.iddocumento and d.iddocumento=" . $iddoc, "");
    $datos_anexo = array();
    $datos_anexo['funcionario_codigo'] = $info[0]['ejecutor'];
    $datos_anexo['iddocumento'] = $iddoc;
    $datos_anexo["fecha"] = $info[0]['fecha'];
    $datos_anexo["estado"] = $info[0]['estado'];
    $datos_anexo["idformato"] = $idformato;
    $idcampos_format = busca_filtro_tabla('idcampos_formato', 'campos_formato', 'nombre like "adjunto_imagen" AND formato_idformato=' . $idformato, '');
    $datos_anexo["idcampos_formato"] = $idcampos_format[0]['idcampos_formato'];
    cargar_anexos_documento_web($datos_anexo, $array_anexos);

    unset($_REQUEST['continuar']);
    unset($_REQUEST['iddoc']);
    unset($_REQUEST['idformato']);
    unset($_REQUEST['adjunto_imagen']);

    foreach ($_REQUEST as $key => $value) {
        $update[] = $key . "='" . $value . "'";
    }

    $consulta_update = "UPDATE ft_correo_saia SET " . implode(',', $update) . ",fecha_datos=" . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",responsable_datos_fa='" . usuario_actual('funcionario_codigo') . "' WHERE documento_iddocumento=" . $iddoc;
    phpmkr_query($consulta_update);
    echo ('<script>window.parent.hs.close();setTimeout(function(){ window.parent.location.reload(); }, 50);</script>');
} else {
    $datos = busca_filtro_tabla('no_factura,nit_proveedor,centro_costo,adjunto_imagen,ingresar_datos_factu,responsable_datos_fa,' . fecha_db_obtener('fecha_datos', 'Y-m-d') . ' AS fecha_datos,' . fecha_db_obtener('fecha_oficio_entrada', 'Y-m-d') . ' AS fecha_oficio_entrada,' . fecha_db_obtener('fecha_factura', 'Y-m-d') . ' AS fecha_factura,cant_dias,' . fecha_db_obtener('fecha_venc_fact', 'Y-m-d') . ' AS fecha_venc_fact,concepto_fact,valor_factura,pago_desde', 'ft_correo_saia', 'documento_iddocumento=' . $iddoc, '');

    $formato_remitente = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre LIKE 'nit_proveedor' AND formato_idformato=" . $idformato, "");

    $pago_desde = array(1 => '', 2 => '');

    $pago_desde[$datos[0]['pago_desde']] = 'checked';
    ?>
    <html>

    <head>
        <title>Ingresar Datos Factura</title>
    </head>

    <body>
        <form action="" method="post" id="formulario_formatos" name="formulario_formatos" enctype="multipart/form-data">
            <table style="width: 100%;" border="0">
                <tr>
                    <td colspan="2" style="text-align: center; font-size: 12px;" class="encabezado_list">Ingresar Datos Factura</td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Fecha Oficio Entrada</td>
                    <td style="font-size: 12px;"><input type="text" name="fecha_oficio_entrada" id="fecha_oficio_entrada" readonly="true" style="width: 100px;" value="<?php echo ($datos[0]['fecha_oficio_entrada']) ?>" /></td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Fecha Factura*</td>
                    <td style="font-size: 12px;">
                        <input type="text" name="fecha_factura" id="fecha_factura" class="required dateISO" readonly="true" style="width: 100px;" value="<?php echo ($datos[0]['fecha_factura']) ?>" /><?php selector_fecha("fecha_factura", "formulario_formatos", "Y-m-d", date("m"), date("Y"), "default.css", $ruta_db_superior, "AD:VALOR"); ?>
                        <label for="fecha_factura" class="error" style="display: none">Campo obligatorio.</label>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">No. de Factura</td>
                    <td style="font-size: 12px;"><input type="text" name="no_factura" id="no_factura" style="width: 70%;" value="<?php echo ($datos[0]['no_factura']) ?>" /></td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Concepto de la Factura</td>
                    <td style="font-size: 12px;"><textarea style="width: 70%;" name="concepto_fact" id="concepto_fact"><?php echo ($datos[0]['concepto_fact']) ?></textarea></td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Proveedor</td>
                    <td style="font-size: 12px;">
                        <input type="hidden" name="nit_proveedor" id="nit_proveedor" style="width: 70%;" value="<?php echo ($datos[0]['nit_proveedor']) ?>" /><?php componente_ejecutor($formato_remitente[0]['idcampos_formato'], $iddoc); ?>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Centro de Costos</td>
                    <td style="font-size: 12px;"><input type="text" name="centro_costo" id="centro_costo" style="width: 70%;" value="<?php echo ($datos[0]['centro_costo']) ?>" /></td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Valor de la Factura</td>
                    <td style="font-size: 12px;"><input type="text" name="valor_factura" id="valor_factura" style="width: 70%;" value="<?php echo ($datos[0]['valor_factura']) ?>" /></td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Fecha de Pago Desde*</td>
                    <td style="font-size: 12px; padding-bottom: 10px;">
                        <input type="radio" class="required" name="pago_desde" id="pago_desde0" value="1" <?php echo $pago_desde[1] ?> />Fecha factura
                        <input type="radio" name="pago_desde" id="pago_desde1" value="2" <?php echo $pago_desde[2] ?> />Fecha oficio entrada<br>
                        <label for="pago_desde" class="error" style="display: none;">Campo obligatorio.</label>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Cant. Dias de Pago*</td>
                    <td style="font-size: 12px;"><input type="text" class="required" name="cant_dias" id="cant_dias" style="width: 70px;" value="<?php echo ($datos[0]['cant_dias']) ?>" /></td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Fecha Vencimiento Factura*</td>
                    <td style="font-size: 12px;"><input type="text" class="required" name="fecha_venc_fact" id="fecha_venc_fact" readonly="true" style="width: 100px;" value="<?php echo ($datos[0]['fecha_venc_fact']) ?>" /></td>
                </tr>
                <tr>
                    <td class="encabezado_list" style="width: 20%; font-size: 12px;">Adjunto</td>
                    <td style="font-size: 12px;"><input type="file" name="adjunto_imagen[]" id="adjunto_imagen" style="width: 70%;"/ multiple></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; font-size: 10px;"><br>
                        <input type="hidden" name="iddoc" value="<?php echo ($iddoc); ?>" />
                        <input type="hidden" name="idformato" value="<?php echo ($idformato); ?>" />
                        <input class="btn btn-info" type="submit" id="continuar" name="continuar" value="Guardar">
                        <input class="btn btn-warning" type="submit" id="continuar" name="continuar" value="Siguiente">
                    </td>
                </tr>
            </table>
        </form>
        <script>
            $('#formulario_formatos').validate({
                submitHandler: function(form) {
                    calcular_dias();
                    form.submit();
                }
            });
            $(document).ready(function() {
                $('#cant_dias').keyup(function() {
                    var valor = $(this).val();
                    valor = valor.replace(/[^0-9]/g, '');
                    $(this).val(valor);
                });

                $("[name='pago_desde']").click(function() {
                    calcular_dias();
                });
            });

            function calcular_dias() {
                var desde = $('input:radio[name=pago_desde]:checked').val();

                if (desde == 1) {
                    var fecha = $('#fecha_factura').val();
                } else {
                    var fecha = $('#fecha_oficio_entrada').val();
                };
                var dias = $('#cant_dias').val();
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "calcular_fecha.php",
                    data: {
                        fecha: fecha,
                        dias: dias
                    },
                    success: function(datos) {
                        $("#fecha_venc_fact").val(datos.fecha_venc);
                    }
                });
            }
        </script>
    </body>

    </html>
<?php
}
?>