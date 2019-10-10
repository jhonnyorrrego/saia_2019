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
    $ft_despacho_ingresados = Model::getQueryBuilder()
        ->select('iddestino_radicacion', 'serie_idserie', 'idft_despacho_ingresados', 'ventanilla')
        ->from('ft_despacho_ingresados')
        ->where("documento_iddocumento=:iddoc")
        ->setParameter(':iddoc', $iddoc, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()
        ->fetchAll();

    $iddestino_radicacion = explode(",", $ft_despacho_ingresados[0]['iddestino_radicacion']);
    foreach ($iddestino_radicacion as $iddestino) {

        $Distribucion = new Distribucion($iddestino);

        if (($Distribucion->entre_sedes == 0) || ($iddestino == $Distribucion->entre_sedes)) {
            $nuevoItemDespacho = Model::getQueryBuilder()
                ->insert('ft_item_despacho_ingres')
                ->values(
                    array(
                        'ft_destino_radicacio' => ':destino',
                        'ft_despacho_ingresados' => ':planilla',
                        'serie_idserie' => ':idserie',
                    )
                )
                ->setParameter(':destino', $iddestino, \Doctrine\DBAL\Types\Type::INTEGER)
                ->setParameter(':planilla', $ft_despacho_ingresados[0]['idft_despacho_ingresados'], \Doctrine\DBAL\Types\Type::INTEGER)
                ->setParameter(':idserie', $ft_despacho_ingresados[0]['serie_idserie'], \Doctrine\DBAL\Types\Type::INTEGER)
                ->execute();
        } else {
            $distribucionPadre = Model::getQueryBuilder()
                ->select('iddistribucion')
                ->from('distribucion')
                ->where('documento_iddocumento=:iddoc')
                ->andWhere('iddistribucion = :entre_sedes')
                ->setParameter(':iddoc', $Distribucion->documento_iddocumento, \Doctrine\DBAL\Types\Type::INTEGER)
                ->setParameter(':entre_sedes', $Distribucion->entre_sedes, \Doctrine\DBAL\Types\Type::INTEGER)
                ->execute()
                ->fetchAll();

            $nuevoItemDespacho = Model::getQueryBuilder()
                ->insert('ft_item_despacho_ingres')
                ->values(
                    array(
                        'ft_destino_radicacio' => ':destino',
                        'ft_despacho_ingresados' => ':planilla',
                        'serie_idserie' => ':idserie',
                    )
                )
                ->setParameter(':destino', $distribucionPadre[0]['iddistribucion'], \Doctrine\DBAL\Types\Type::INTEGER)
                ->setParameter(':planilla', $ft_despacho_ingresados[0]['idft_despacho_ingresados'], \Doctrine\DBAL\Types\Type::INTEGER)
                ->setParameter(':idserie', $ft_despacho_ingresados[0]['serie_idserie'], \Doctrine\DBAL\Types\Type::INTEGER)
                ->execute();
        }

        $idFtItem = Model::getQueryBuilder()
            ->select('idft_item_despacho_ingres')
            ->from('ft_item_despacho_ingres')
            ->where('ft_destino_radicacio=:destino')
            ->andWhere('ft_despacho_ingresados = :planilla')
            ->andWhere('serie_idserie = :idserie')
            ->setParameter(':destino', $iddestino, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':planilla', $ft_despacho_ingresados[0]['idft_despacho_ingresados'], \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':idserie', $ft_despacho_ingresados[0]['serie_idserie'], \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute()
            ->fetchAll();

        $nuevoItemRecep = Model::getQueryBuilder()
            ->insert('dt_recep_despacho')
            ->values(
                array(
                    'iddistribucion' => ':idDistribucion',
                    'ft_item_despacho_ingres' => ':nuevoItemDespacho',
                    'idfuncionario' => ':idFuncionario',
                )
            )
            ->setParameter(':idDistribucion', $iddestino, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':nuevoItemDespacho', $idFtItem[0]['idft_item_despacho_ingres'], \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':idFuncionario', SessionController::getValue('idfuncionario'), \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute();

        $nuevoItemDespacho = Model::getQueryBuilder()
            ->insert('dt_ventanilla_doc')
            ->values(
                array(
                    'documento_iddocumento' => ':idDocumento',
                    'idcf_ventanilla' => ':idcf_ventanilla',
                    'idfuncionario' => ':idFuncionario',
                )
            )
            ->setParameter(':idDocumento', $Distribucion->documento_iddocumento, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':idcf_ventanilla', $ft_despacho_ingresados[0]['ventanilla'], \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':idFuncionario', SessionController::getValue('idfuncionario'), \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute();
        $Distribucion->estado_distribucion = 2;
        $Distribucion->save();
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
    $resultado = 'Matutino';

    $query = Model::getQueryBuilder();
    $planilla = $query
        ->select('tipo_recorrido')
        ->from('ft_despacho_ingresados')
        ->where('documento_iddocumento = :iddoc')
        ->setParameter(':iddoc', $iddoc, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    if ($planilla[0]['tipo_recorrido'] == 2) {
        $resultado = 'Vespertino';
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
    proceso_entre_sedes();

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

function proceso_entre_sedes()
{
    $iddestino_radicacion = explode(',', $_REQUEST['iddestino_radicacion']);
    $Distribucion = new Distribucion($iddestino_radicacion[0]);

    if ($Distribucion->entre_sedes > 0) {
        foreach ($iddestino_radicacion as $iddestino) {
            $Distribucion = new Distribucion($iddestino);
            $camposDistribucion = [
                'origen' => $Distribucion->origen,
                'tipo_origen' => 1,
                'ruta_origen' => $Distribucion->ruta_origen,
                'mensajero_origen' => $Distribucion->mensajero_destino,
                'destino' => $Distribucion->destino,
                'tipo_destino' => $Distribucion->tipo_destino,
                'ruta_destino' => $Distribucion->ruta_destino,
                'mensajero_destino' => $Distribucion->mensajero_destino,
                'numero_distribucion' => $Distribucion->numero_distribucion,
                'estado_distribucion' => 0,
                'estado_recogida' => $Distribucion->estado_recogida,
                'documento_iddocumento' => $Distribucion->documento_iddocumento,
                'fecha_creacion' => $Distribucion->fecha_creacion,
                'sede_origen' => $Distribucion->sede_origen,
                'sede_destino' => $Distribucion->sede_destino,
                'entre_sedes' => $Distribucion->entre_sedes
            ];

            $nuevoItemDistribucion = Distribucion::newRecord($camposDistribucion);
        }
    }
}

/** Funcion para crear un hidden en el adicionar de la planilla de distribucion con el id de la sede destino.
 *  si no se encuentra la opcion entre sedes el valor por defecto sera 0
 * @param void
 * @return string Un html con el componente hidden para guardar el valor del REQUEST.
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-07
 */

function sede_origen()
{
    echo "<input type='hidden' name='sede_origen' value='{$_REQUEST['sede_origen']}'>";
}

function sede_destino()
{
    echo "<input type='hidden' name='sede_destino' value='{$_REQUEST['sede_destino']}'>";
}

/** Funcion que muestra la sede destino en el mostrar de la planilla de distribucion solo si esta tiene la opcion entre sedes
 * @param $idformato Identificador del formato
 * @param $iddoc Identificador del documento
 * @return string Un html con el titulo 'Sede destino: ' y el nombre de la sede destino.
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-07
 */

function mostrar_destino_entre_sedes($idformato, $iddoc)
{
    $query = Model::getQueryBuilder();
    $planilla = $query
        ->select('sede_origen', 'sede_destino')
        ->from('ft_despacho_ingresados')
        ->where('documento_iddocumento = :iddoc')
        ->setParameter(':iddoc', $iddoc, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    $query = Model::getQueryBuilder();
    $nombreSedeOrigen = $query
        ->select('nombre', 'idcf_ventanilla')
        ->from('cf_ventanilla')
        ->where('estado=1')
        ->andWhere('idcf_ventanilla = :idSede')
        ->setParameter(':idSede', $planilla[0]['sede_origen'], \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    $query = Model::getQueryBuilder();
    $nombreSedeDestino = $query
        ->select('nombre', 'idcf_ventanilla')
        ->from('cf_ventanilla')
        ->where('estado=1')
        ->andWhere('idcf_ventanilla = :idSede')
        ->setParameter(':idSede', $planilla[0]['sede_destino'], \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    $retorno = "<b>Sede origen: </b> {$nombreSedeOrigen[0]['nombre']} ";
    if ($planilla[0]['sede_destino'] != 0) {
        $retorno .= "| <b>Sede destino:</b> {$nombreSedeDestino[0]['nombre']}";
    }

    echo $retorno;
}
