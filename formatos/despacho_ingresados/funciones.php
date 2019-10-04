<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}
include_once($ruta_db_superior . "core/autoload.php");
include_once($ruta_db_superior . "assets/librerias.php");

function campos_ocultos_entrega($idformato, $iddoc)
{
    $valores = trim($_REQUEST['iddistribucion'], ',');
    $vector_mensajero = explode('-', $_REQUEST['mensajero']);
    $mensajero = trim($vector_mensajero[0], ',');
    $tipo_mensajero = $vector_mensajero[1];
    $hoy = date("Y-m-d");
    $ventanillas = Model::getQueryBuilder()
        ->select('idcf_ventanilla', 'nombre')
        ->from('cf_ventanilla')
        ->where('estado=1')
        ->orderBy('idcf_ventanilla', 'ASC')
        ->execute()->fetchAll();
    $countVentanillas = count($ventanillas);
    $opciones_ventanilla = "";
    for ($i = 0; $i < $countVentanillas; $i++) {
        $opciones_ventanilla .= "<option value=" . $ventanillas[$i]['idcf_ventanilla'] . ">" . $ventanillas[$i]['nombre'] . "</option>";
    }
    ?>

    <script>
        $(document).ready(function() {
            var valores = '<?php echo $valores; ?>';
            var mensajero = '<?php echo $mensajero; ?>';
            if (valores == '' || valores == 0 || mensajero == '' || mensajero == 0) {
                alerta("Por favor seleccione documentos y mensajero");
            } else {
                $("input[name=idft_ruta_dist]").val('<?php echo $_REQUEST['idruta_dist']; ?>');
                $("input[name=iddestino_radicacion]").val('<?php echo $valores; ?>');
                $("input[name=mensajero]").val('<?php echo $mensajero; ?>');
                $("input[name=tipo_mensajero]").val('<?php echo $tipo_mensajero; ?>');
                $("input[name=fecha_entrega]").val('<?php echo $hoy; ?>');
            }
        });
        $("#ventanilla").empty().html("<?php echo ($opciones_ventanilla); ?>");
        $("#formulario_formatos").validate({
            submitHandler: function(form) {
                var seguro = confirm("Esta seguro que desea crear la entrega?");
                if (seguro) {
                    form.submit();
                } else {
                    $('input[type=button]').hide();
                    $("#continuar").show();
                    return false;
                }
            }
        });
    </script>
<?php
}

function mensajero_entrega_interna($idformato, $iddoc)
{
    $documentos2 = Model::getQueryBuilder()
        ->select('*')
        ->from('ft_despacho_ingresados')
        ->where('documento_iddocumento= :documento')
        ->setParameter(':documento', $iddoc, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    if ($documentos2[0]['tipo_mensajero'] == 'e') {
        $empresa_transportadora = Model::getQueryBuilder()
            ->select('nombre')
            ->from('cf_empresa_trans')
            ->where('idcf_empresa_trans = :mensajero')
            ->setParameter(':mensajero', $documentos2[0]['mensajero'], \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute()->fetchAll();
        $cadena_nombre = $empresa_transportadora[0]['nombre'];
    } else {
        $Funcionario = new Funcionario($documentos2[0]['mensajero']);
        $cadena_nombre = $Funcionario->nombres . ' ' . $Funcionario->apellidos;
    }
    //print_r($cadena_nombre);
    echo (ucwords(strtolower($cadena_nombre)));
}

function ruta_entrega_interna($idformato, $iddoc)
{
    $datos = Model::getQueryBuilder()
        ->select('idft_ruta_dist')
        ->from('ft_despacho_ingresados')
        ->where('documento_iddocumento = :documento')
        ->setParameter(':documento', $iddoc, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    if ($datos && $datos[0]["idft_ruta_dist"] != "") {
        $ruta = Model::getQueryBuilder()
            ->select('nombre_ruta')
            ->from('ft_ruta_distribucion')
            ->where('idft_ruta_distribucion in (:ruta)')
            ->setParameter(':ruta', $datos[0]["idft_ruta_dist"], \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
            ->execute()->fetchAll();

        if ($ruta) {
            $nomb = extrae_campo($ruta, "nombre_ruta");
            echo ("<br/>" . implode(", ", $nomb));
        }
    }
}

function mostrar_seleccionados_entrega($idformato, $iddoc)
{
    global $conn, $ruta_db_superior, $registros;
    $texto = '';
    $items_seleccionados = busca_filtro_tabla("idft_despacho_ingresados", "ft_despacho_ingresados", "documento_iddocumento=" . $iddoc, "", $conn);
    $items = busca_filtro_tabla("ft_destino_radicacio", "ft_item_despacho_ingres", "ft_despacho_ingresados=" . $items_seleccionados[0]['idft_despacho_ingresados'], "", $conn);
    $cadena_items_seleccionados = '';
    for ($i = 0; $i < $items['numcampos']; $i++) {
        $cadena_items_seleccionados .= $items[$i]['ft_destino_radicacio'];
        if (($i + 1) != $items['numcampos']) {
            $cadena_items_seleccionados .= ',';
        }
    }
    $registros = busca_filtro_tabla("a.fecha_creacion,b.descripcion,a.tipo_origen,a.estado_recogida,a.numero_distribucion,a.origen,a.tipo_origen,a.destino,a.tipo_destino", "distribucion a,documento b", "a.documento_iddocumento=b.iddocumento AND a.iddistribucion in(" . $cadena_items_seleccionados . ")", "", $conn);
    $texto .= reporte_entradas2($idformato, $iddoc);
    echo ($texto);
}

//------------------------------Posterior aprobar------------------------------------//
function generar_pdf_entrega($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;
    $seleccionado = busca_filtro_tabla("iddestino_radicacion,idft_despacho_ingresados,serie_idserie,ventanilla", "ft_despacho_ingresados", "documento_iddocumento=" . $iddoc, "", $conn);
    $iddestino_radicacion = explode(",", $seleccionado[0]['iddestino_radicacion']);
    $cont = count($iddestino_radicacion);
    for ($i = 0; $i < $cont; $i++) {
        $insert = "INSERT INTO ft_item_despacho_ingres(ft_destino_radicacio,ft_despacho_ingresados,serie_idserie) VALUES ('" . $iddestino_radicacion[$i] . "', '" . $seleccionado[0]['idft_despacho_ingresados'] . "'," . $seleccionado[0]['serie_idserie'] . ")";
        phpmkr_query($insert);
        $busca_item_actual = busca_filtro_tabla("idft_item_despacho_ingres", "ft_item_despacho_ingres", "ft_destino_radicacio=" . $iddestino_radicacion[$i] . " and ft_despacho_ingresados=" . $seleccionado[0]['idft_despacho_ingresados'], "", $conn);
        $insert = "INSERT INTO dt_recep_despacho(iddistribucion,ft_item_despacho_ingres,idfuncionario) VALUES ('" . $iddestino_radicacion[$i] . "', '" . $busca_item_actual[0]['idft_item_despacho_ingres'] . "'," . SessionController::getValue('idfuncionario') . ")";
        phpmkr_query($insert);

        $distribucion = busca_filtro_tabla("documento_iddocumento", "distribucion", "iddistribucion=" . $iddestino_radicacion[$i], "", $conn);
        $insert = "INSERT INTO dt_ventanilla_doc(documento_iddocumento,idcf_ventanilla,idfuncionario) VALUES ('" . $distribucion[0]['documento_iddocumento'] . "', '" . $seleccionado[$i]['ventanilla'] . "'," . SessionController::getValue('idfuncionario') . ")";
        phpmkr_query($insert);

        $update = "UPDATE distribucion SET estado_distribucion=2 WHERE iddistribucion=" . $iddestino_radicacion[$i];
        phpmkr_query($update);
    }
}

function reporte_entradas2($idformato, $iddoc)
{
    global $registros, $ruta_db_superior;

    include_once($ruta_db_superior . "distribucion/funciones_distribucion.php");

    $texto = '<table style="width:100%;border-collapse:collapse;" border="1">';
    $texto .= '<thead><tr>';
    $texto .= '<td style="text-align:center;"><b>FECHA DE RECIBO</b></td>';
    $texto .= '<td style="text-align:center;"><b>N°. ITEM</b></td>';
    $texto .= '<td style="text-align:center;"><b>TIPO</b></td>';
    $texto .= '<td style="text-align:center;"><b>ORIGEN</b></td>';
    $texto .= '<td style="text-align:center;"><b>DESTINO</b></td>';
    $texto .= '<td style="text-align:center;"><b>ASUNTO</b></td>';
    $texto .= '<td style="text-align:center;"><b>FIRMA DE QUIEN RECIBE</b></td>';
    $texto .= '<td style="text-align:center;"><b>OBSERVACIONES</b></td>';
    $texto .= '</tr></thead>';

    for ($i = 0; $i < $registros["numcampos"]; $i++) {
        $texto .= '<tr>';
        $texto .= '<td style="height:100px;text-align:center;"><p>' . DateController::convertDate($registros[$i]["fecha_creacion"], 'h:s a') . '</p><p>' . DateController::convertDate($registros[$i]["fecha_creacion"], 'd-m-y') . '</p></td>';
        $texto .= '<td style="text-align:center;">' . $registros[$i]["numero_distribucion"] . '</td>';
        $texto .= '<td style="text-align:center;">' . mostrar_tipo_radicado_distribucion($registros[$i]["tipo_origen"]) . '</td>';
        $texto .= '<td style="text-align:left;">' . retornar_origen_destino_distribucion($registros[$i]['tipo_origen'], $registros[$i]['origen']) . '<br>' . retornar_ubicacion_origen_destino_distribucion($registros[$i]['tipo_origen'], $registros[$i]['origen']) . '</td>';
        $texto .= '<td style="text-align:left;">' . retornar_origen_destino_distribucion($registros[$i]['tipo_destino'], $registros[$i]['destino']) . '<br>' . retornar_ubicacion_origen_destino_distribucion($registros[$i]['tipo_destino'], $registros[$i]['destino']) . '</td>';
        $texto .= '<td style="text-align:left;">' . $registros[$i]["descripcion"] . '</td>';
        $texto .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
        $texto .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
        $texto .= '</tr>';
    }
    $texto .= '</table>';
    echo ($texto);
}

function mostrar_tipo_radicado_distribucion($tipo_origen)
{
    //1 fun 2 eje
    $array_tipo_radicado = array(
        1 => 'I',
        2 => 'E'
    );
    return $array_tipo_radicado[$tipo_origen];
}

function retornar_origen_destino_distribucion($tipo, $valor)
{
    if ($tipo == 1) { //iddependencia_cargo
        $datos = busca_filtro_tabla("nombres,apellidos,login", "vfuncionario_dc", "iddependencia_cargo=" . $valor, "");
        $nombre = $datos[0]['nombres'] . ' ' . $datos[0]['apellidos'] . ' (' . $datos[0]['login'] . ')';
    } else { //iddatos_ejecutor
        $datos = busca_filtro_tabla("nombre", "ejecutor a, datos_ejecutor b", "a.idejecutor=b.ejecutor_idejecutor AND b.iddatos_ejecutor=" . $valor, "");
        $nombre = $datos[0]['nombre'];
    }
    return $nombre;
}

function retornar_ubicacion_origen_destino_distribucion($tipo, $valor)
{
    $ubicacion = '';
    if ($tipo == 1) { //iddependencia_cargo
        $datos = busca_filtro_tabla("cargo,dependencia", "vfuncionario_dc", "iddependencia_cargo=" . $valor, "");
        $ubicacion = $datos[0]['dependencia'] . '<br> ' . $datos[0]['cargo'] . '';
    } else { //iddatos_ejecutor
        $datos = busca_filtro_tabla("direccion,cargo,c.nombre", "ejecutor a, datos_ejecutor b, municipio c", "c.idmunicipio=b.ciudad AND a.idejecutor=b.ejecutor_idejecutor AND b.iddatos_ejecutor=" . $valor, "");
        $ubicacion = $datos[0]['direccion'] . '<br/> ' . $datos[0]['nombre'];
    }
    return $ubicacion;
}

function obtener_tipo_recorrido($idformato, $iddoc)
{
    $resultado = "Matutino";
    if ('2' == 2) {
        $resultado = "Vespertina";
    }
    echo $resultado;
}

/**
 * Esta funcion refrezca la tabla del reporte de distribución 'Pendientes' cuando se genera planilla, de este modo los items cambian de estado a 'En distribución' y no pueden quedar en el mismo listado 
 * de pendientes
 * @return void
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-3
 * @lastModification jhon sebastian valencia <jhon.valencia@cerok.com> 2019-10-3
 */
function post_generar_planilla()
{
    echo jquery();
    echo <<<HTML
    <script>
        let panelIdentificator = $(".k-focus", parent.document).attr("id");
        let panelPosition = parseInt(panelIdentificator.replace('kp', '')) - 1; 
        let beforePanel = $("#kp" + panelPosition, parent.document);
        let frameWindow = beforePanel.find('iframe')[0].contentWindow;
        
        frameWindow.removeSelections()
        frameWindow.refreshGrid();        
    </script>
HTML;
}
