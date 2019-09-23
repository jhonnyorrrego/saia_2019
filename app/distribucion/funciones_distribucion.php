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

include_once $ruta_db_superior . "core/autoload.php";

/**
 * En el valor de $campo_origen va el nombre del campo del formulario que se va a gestionar como origen. Nota(el campo del formulario solo puede tener un iddependencia_cargo o un iddatos_ejecutor)
 * cuando el $campo_origen corresponde a un iddependencia_cargo se debe colocar en el $tipo_origen el valor (1)
 * cuando el $campo_origen corresponde a un iddatos_ejecutor se debe colocar en el $tipo_origen el valor (2)
 * En el valor de $campo_destino va el nombre del campo del formulario que se va a gestionar como destino. Nota(el campo del formulario puede tener uno o varios iddependencia_cargo separado por comas, uno o varios iddatos_ejecutor separado por coma o una iddependencia con (#iddependencia)
 * cuando el $campo_destino corresponde a un iddependencia_cargo o iddependencia se debe colocar en el $tipo_destino el valor (1)
 * cuando el $campo_destino corresponde a un iddatos_ejecutor se debe colocar en el $tipo_destino el valor (2)
 * El $estado_distribucion determina el buzon en donde esta el tramite 0,Pediente o entrega interna a ventanilla; 1,Por Distribuir; 2,En distribucion; 3,Finalizado
 * El $estado_recogida corresponde a si se necesita una acción de recogida en este caso se debe enviar el valor (1) para cuando es si y el valor de (0) cuando es no
 * @param $iddoc (int) identificador de documento
 * @param $campo_origen (string) nombre del campo que contiene el usuario origen
 * @param $tipo_origen (int) identificador del tipo de solicitud de origen (1-Externo, 2-Interno)
 * @param $campo_destino (string) nombre del campo que contiene el usuario destino
 * @param $tipo_destino (int) identificador del tipo de solicitud de destino (1-Externo, 2-Interno)
 * @param $estado_distribucion (int) Establece si si se necesita Entrega (1-si, 3-no)
 * @param $estado_recogida (int) Establece si se necesita recogida (1-si, 0-no)
 */
function pre_ingresar_distribucion($iddoc, $campo_origen, $tipo_origen, $campo_destino, $tipo_destino, $estado_distribucion = 1, $estado_recogida = 0)
{
    $datos_plantilla = busca_filtro_tabla("b.nombre_tabla", "documento a,formato b", "lower(a.plantilla)=lower(b.nombre) AND a.iddocumento=" . $iddoc, "");
    $nombre_tabla = $datos_plantilla[0]['nombre_tabla'];
    $datos_documento = busca_filtro_tabla($campo_origen . "," . $campo_destino, $nombre_tabla, "documento_iddocumento=" . $iddoc, "");
    if ($datos_documento['numcampos']) {

        $lista_destinos = explode(',', $datos_documento[0][$campo_destino]);
        for ($i = 0; $i < count($lista_destinos); $i++) {
            $datos_distribucion = array();
            $datos_distribucion['origen'] = $datos_documento[0][$campo_origen];
            $datos_distribucion['tipo_origen'] = $tipo_origen;
            $datos_distribucion['destino'] = $lista_destinos[$i];
            $datos_distribucion['tipo_destino'] = $tipo_destino;
            $datos_distribucion['estado_distribucion'] = $estado_distribucion;
            $datos_distribucion['estado_recogida'] = $estado_recogida;

            $ingresar = ingresar_distribucion($iddoc, $datos_distribucion);
        }
    }
}

function ingresar_distribucion($iddoc, $datos, $iddistribucion = 0)
{
    global $conn, $ruta_db_superior;
    /*
     * $iddoc = iddocumento de la tabla documento
     * $datos
     * ['origen']       ---> iddependencia_cargo ó iddatos_ejecutor
     * ['tipo_origen']  ---> 1,funcionario; 2,ejecutor
     * ['destino']	    ---> iddependencia_cargo ó dependencia#, ó iddatos_ejecutor
     * ['tipo_destino'] ---> 1,funcionario;2,ejecutor
     * ['estado_distribucion']  ---> 0,Pediente; 1,Por Distribuir; 2,En distribucion; 3,Finalizado
     * ['estado_recogida'] ---> 0, No; 1, Si
     * $iddistribucion = si se desea ingresar la distribucion que una llave especifica, se usa para migrar viejas distribuciones a la nueva distribucion
     */

    //--------------------------------------------------------
    //OBTENER RUTA_ORIGEN
    $idft_ruta_distribucion_origen = 0;
    if ($datos['tipo_origen'] == 1) {
        $idft_ruta_distribucion_origen = obtener_ruta_distribucion($datos['origen']);
    }
    //OBTENER MENSAJERO_RUTA_ORIGEN
    $iddependencia_cargo_mensajero_origen = 0;
    if ($idft_ruta_distribucion_origen) {
        $iddependencia_cargo_mensajero_origen = obtener_mensajero_ruta_distribucion($idft_ruta_distribucion_origen);
    }

    //---------------------------------------------------------------
    //ESTADO RECOGIDA
    $estado_recogida = 0;
    //Si el origen es externo es decir iddatos_ejecutor
    if ($datos['tipo_origen'] == 2) {
        $estado_recogida = 1;
    }

    //Si no se requiere recogida se almacena 1 para simular que ya fue realizada
    if (@$datos['estado_recogida']) {
        $estado_recogida = 1;
    }

    //ESTADO_DISTRIBUCION
    $estado_distribucion = 0;
    if (@$datos['estado_distribucion']) {
        $estado_distribucion = $datos['estado_distribucion'];
    }

    //--------------------------------------------------------
    //ORGANIZAR DESTINOS DEPENDENCIA - ROLES
    $array_destinos = array();
    $es_dependencia = 0;
    if ($datos['destino'][(strlen($datos['destino']) - 1)] == '#') {
        $es_dependencia = 1;
    }
    if ($es_dependencia) {
        $array_destinos = obtener_funcionarios_dependencia_destino($datos['destino']);
    } else {
        $array_destinos[] = $datos['destino'];
    }

    $array_iddistribucion = array();
    for ($j = 0; $j < count($array_destinos); $j++) {

        //NUMERO DE DISTRIBUCION
        $numero_distribucion = obtener_numero_distribucion($iddoc);

        //OBTENER RUTA_DESTINO
        $idft_ruta_distribucion_destino = 0;
        if ($datos['tipo_destino'] == 1) {
            $idft_ruta_distribucion_destino = obtener_ruta_distribucion($array_destinos[$j]);
        }
        //OBTENER MENSAJERO_RUTA_DESTINO
        $iddependencia_cargo_mensajero_destino = 0;
        if ($idft_ruta_distribucion_destino) {
            $iddependencia_cargo_mensajero_destino = obtener_mensajero_ruta_distribucion($idft_ruta_distribucion_destino);
        }

        $nuevaDistribucion = $Distribucion = new Distribucion();
        $camposDistribucion = [
            'origen' => $datos['origen'],
            'tipo_origen' => $datos['tipo_origen'],
            'ruta_origen' => $idft_ruta_distribucion_origen,
            'mensajero_origen' => $iddependencia_cargo_mensajero_origen,
            'destino' => $array_destinos[$j],
            'tipo_destino' => $datos['tipo_destino'],
            'ruta_destino' => $idft_ruta_distribucion_destino,
            'mensajero_destino' => $iddependencia_cargo_mensajero_destino,
            'numero_distribucion' => $numero_distribucion,
            'estado_distribucion' => $estado_distribucion,
            'estado_recogida' => $estado_recogida,
            'documento_iddocumento' => $iddoc,
            'fecha_creacion' => date('Y-m-d H:i:s')

        ];

        if ($iddistribucion) {
            $camposDistribucion = array_merge($camposDistribucion, ["iddistribucion" => $iddistribucion]);
        }

        $Distribucion->newRecord($camposDistribucion);

        $array_iddistribucion[] = $nuevaDistribucion;
    }
    return $array_iddistribucion;
}

function obtener_ruta_distribucion($iddependencia_cargo)
{
    $DependenciaCargo = VfuncionarioDc::findByAttributes([
        'iddependencia_cargo' => $iddependencia_cargo
    ]);

    $retorno = 0;
    $rutaDistribucion = Model::getQueryBuilder()
        ->select('a.idft_ruta_distribucion')
        ->from('ft_ruta_distribucion', 'a')
        ->innerJoin('a', 'documento', 'b', 'a.documento_iddocumento=b.iddocumento')
        ->innerjoin('a', 'ft_dependencias_ruta', 'c', 'a.idft_ruta_distribucion=c.ft_ruta_distribucion')
        ->where("b.estado='APROBADO' and c.estado_dependencia=1")
        ->andWhere('c.dependencia_asignada = :dependencia')
        ->setParameter(':dependencia', $DependenciaCargo->iddependencia, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()
        ->fetchAll();

    if ($rutaDistribucion) {
        $retorno = $rutaDistribucion[0]['idft_ruta_distribucion'];
    }
    return $retorno;
}

function obtener_mensajero_ruta_distribucion($idft_ruta_distribucion)
{
    $retorno = 0;
    $mensajeroDistribucion = Model::getQueryBuilder()
        ->select('c.mensajero_ruta')
        ->from('ft_ruta_distribucion', 'a')
        ->innerJoin('a', 'documento', 'b', 'a.documento_iddocumento=b.iddocumento')
        ->innerjoin('a', 'ft_funcionarios_ruta', 'c', 'a.idft_ruta_distribucion=c.ft_ruta_distribucion')
        ->where("b.estado='APROBADO' and c.estado_mensajero=1")
        ->andWhere('a.idft_ruta_distribucion = :idruta')
        ->setParameter(':idruta', $idft_ruta_distribucion, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()
        ->fetchAll();

    if ($mensajeroDistribucion) {
        $retorno = $mensajeroDistribucion[0]['mensajero_ruta'];
    }
    return $retorno;
}

function obtener_numero_distribucion($iddoc)
{
    $numero_radicado = busca_filtro_tabla("numero,estado", "documento", "iddocumento=" . $iddoc, "");
    $distribuciones_iddoc = busca_filtro_tabla("iddistribucion", "distribucion", "documento_iddocumento=" . $iddoc, "");
    $numero_distribucion = $numero_radicado[0]['numero'] . '.' . ($distribuciones_iddoc['numcampos'] + 1);
    return $numero_distribucion;
}

function obtener_funcionarios_dependencia_destino($iddependencia)
{
    $array_funcionarios = array();
    $dependencia = str_replace("#", "", $iddependencia);
    $dependencia .= "," . buscar_dependencias_hijas_distribucion($dependencia);
    $dependencia = trim($dependencia, ',');
    $busca_funcionarios = busca_filtro_tabla("iddependencia_cargo", "vfuncionario_dc", "tipo_cargo=1 AND estado=1 AND estado_dc=1 AND estado_dep=1 AND iddependencia IN(" . $dependencia . ")", "");
    for ($j = 0; $j < $busca_funcionarios['numcampos']; $j++) {
        $array_funcionarios[] = $busca_funcionarios[$j]['iddependencia_cargo'];
    }
    return $array_funcionarios;
}

function buscar_dependencias_hijas_distribucion($iddependencia)
{
    $lista_hijas = '';
    $busca_hijas = busca_filtro_tabla("iddependencia", "dependencia", "cod_padre=" . $iddependencia, "");
    if ($busca_hijas['numcampos']) {
        for ($i = 0; $i < $busca_hijas['numcampos']; $i++) {
            $lista_hijas .= $busca_hijas[$i]['iddependencia'] . ",";
            $lista_hijas .= buscar_dependencias_hijas_distribucion($busca_hijas[$i]['iddependencia']);
        }
    }
    return $lista_hijas;
}


function accionFinalizarDistribucion($iddoc)
{
    $distribuciones = busca_filtro_tabla("iddistribucion", "distribucion", "documento_iddocumento=" . $iddoc, "");
    $retorno = false;
    for ($i = 0; $i < $distribuciones["numcampos"]; $i++) {
        if (generar_enlace_finalizar_distribucion($distribuciones[$i]['iddistribucion'])) {
            $retorno = true;
            break;
        }
    }
    return $retorno;
}

function mostrar_listado_distribucion_documento($idformato, $iddoc, $retorno = 0)
{
    global $conn, $ruta_db_superior;
    $distribuciones = busca_filtro_tabla("numero_distribucion,tipo_origen,origen,tipo_destino,destino,estado_distribucion,iddistribucion", "distribucion", "documento_iddocumento=" . $iddoc, "");
    $tabla = '';
    if ($distribuciones['numcampos']) {
        $tabla = '
            <div class="row">
            <div class="col-md-12">
            <table border="0" style="width:100%;border-collapse: collapse;">
                <tr>
                    <td style="width:15%;"><b class="hint-text">NO. ITEM</b></td>
                    <td style="width:20%;"><b class="hint-text">TIPO DE ORIGEN</b></td>
                    <td style="width:20%;"><b class="hint-text">ENTREGA F&Iacute;SICA</b></td>
                    <td style="width:20%;"><b class="hint-text">ORIGEN</b></td>
                    <td style="width:25%;"><b class="hint-text">DESTINO</b></td> 
                </tr> 
                <tr> 
                    <td colspan=5 style="width:100%;" > <hr /></td>
                </tr>
            ';

        for ($i = 0; $i < $distribuciones['numcampos']; $i++) {
            $enlace_finalizar_distribucion = generar_enlace_finalizar_distribucion($distribuciones[$i]['iddistribucion']);

            $tabla .= '
                <tr>
                <td style="width:15%;"> ' . $distribuciones[$i]['numero_distribucion'] . ' </td>
                <td style="width:20%;"> ' . mostrar_valor_campo('tipo_origen', $idformato, $iddoc, 1) . '</td>
				<td style="width:20%" id="estado_item_' . $distribuciones[$i]['iddistribucion'] . '">' . ver_estado_distribucion($distribuciones[$i]['estado_distribucion']) . ' </td>	
				<td style="width:20%;"> 
					' . retornar_origen_destino_distribucion($distribuciones[$i]['tipo_origen'], $distribuciones[$i]['origen']) . ' 
					<br>
					' . retornar_ubicacion_origen_destino_distribucion($distribuciones[$i]['tipo_origen'], $distribuciones[$i]['origen']) . '
				</td>
				<td style="width:25%;"> 
					' . retornar_origen_destino_distribucion($distribuciones[$i]['tipo_destino'], $distribuciones[$i]['destino']) . ' 
					<br>
					' . retornar_ubicacion_origen_destino_distribucion($distribuciones[$i]['tipo_destino'], $distribuciones[$i]['destino']) . '
				</td>
            </tr>
            <tr>
                    <td colspan=5 style="width:100%;" > <hr /></td>
                </tr>';
        }

        $tabla .= '</table></div></div>';
        $tabla .= generar_enlace_finalizar_distribucion(0, 1);
    }
    if ($retorno) {
        return $tabla;
    } else {
        echo $tabla;
    }
}

function generar_enlace_finalizar_distribucion($iddistribucion, $js = 0)
{
    global $conn, $ruta_db_superior;
    $html = '';
    if (!$js && $iddistribucion) {

        //ROLES USUARIO _ACTUAL
        $funcionario_codigo_usuario_actual = $_SESSION["usuario_actual"];
        $busca_roles_usuario_actual = busca_filtro_tabla("iddependencia_cargo", "vfuncionario_dc", "estado_dc=1 AND funcionario_codigo=" . $funcionario_codigo_usuario_actual, "");
        $vector_roles_usuario_actual = extrae_campo($busca_roles_usuario_actual, 'iddependencia_cargo', "U");

        $distribucion = busca_filtro_tabla("tipo_origen,estado_recogida,origen,tipo_destino,destino,estado_distribucion", "distribucion", "iddistribucion=" . $iddistribucion, "");
        $diligencia = mostrar_diligencia_distribucion($distribucion[0]['tipo_origen'], $distribucion[0]['estado_recogida']);

        $retornar_enlace = 0;
        switch ($diligencia) {
            case 'RECOGIDA':
                if (in_array($distribucion[0]['destino'], $vector_roles_usuario_actual)) {
                    $retornar_enlace = 1;
                }
                break;
            case 'ENTREGA':
                if ($distribucion[0]['tipo_destino'] == 1 && in_array($distribucion[0]['destino'], $vector_roles_usuario_actual)) {
                    $retornar_enlace = 1;
                }
                break;
        }

        if ($retornar_enlace && $distribucion[0]['estado_distribucion'] != 3) {
            return true;
        }
    }
    return $html;
}

//---------------------------------------------------------------------------------------------
//REPORTE DE DISTRIBUCION

function ver_documento_distribucion($iddocumento, $tipo_origen)
{
    $Documento = new Documento($iddocumento);
    $numero = $Documento->numero;
    $array_tipo_origen = array(
        1 => 'I',
        2 => 'E'
    );
    $cadena_mostrar = $numero . '_' . $array_tipo_origen[$tipo_origen];
    $enlace_documento = '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $iddocumento . '" conector="iframe" titulo="No Registro ' . $numero . '"><center><button class="btn btn-complete">' . $cadena_mostrar . '</button></center></div>';
    return $enlace_documento;
}

function ver_documento_planilla($iddocumento, $numero)
{
    return '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $iddocumento . '" conector="iframe" titulo="No Registro ' . $numero . '"><center><button class="btn btn-complete">' . $numero . '</button></center></div>';
}
function ver_estado_distribucion($estado_distribucion)
{ //Estado
    $array_estado_distribucion = array(
        'estado_distribucion' => 'Pendiente',
        0 => 'Pendiente',
        1 => 'Pendiente por distribuir',
        2 => 'En distribuci&oacute;n',
        3 => 'Confirmado'
    );
    return $array_estado_distribucion[$estado_distribucion];
}

function mostrar_diligencia_distribucion($tipo_origen, $estado_recogida)
{ //Diligencia
    if ($estado_recogida == 'estado_recogida') {
        $estado_recogida = 0;
    }
    $diligencia = 'ENTREGA';
    if ($tipo_origen == 1 && !$estado_recogida) {
        $diligencia = 'RECOGIDA';
    }
    return $diligencia;
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

function mostrar_nombre_ruta_distribucion($tipo_origen, $estado_recogida, $ruta_origen, $ruta_destino, $tipo_destino, $iddistribucion, $origen)
{ //Ruta

    if ($estado_recogida == 'estado_recogida') {
        $estado_recogida = 0;
    }
    if ($ruta_origen == 'ruta_origen') {
        $ruta_origen = 0;
    }
    if ($ruta_destino == 'ruta_destino') {
        $ruta_destino = 0;
    }

    $idft_ruta_distribucion = $ruta_destino;
    //ENTREGA
    if ($tipo_origen == 1 && !$estado_recogida) { //RECOGIDA
        $idft_ruta_distribucion = $ruta_origen;
    }

    $nombre_ruta_distribucion = 'Sin definir';
    if ($idft_ruta_distribucion) {
        $ruta_distribucion = busca_filtro_tabla("nombre_ruta", "ft_ruta_distribucion", "idft_ruta_distribucion=" . $idft_ruta_distribucion, "");
        if ($ruta_distribucion['numcampos']) {
            $nombre_ruta_distribucion = $ruta_distribucion[0]['nombre_ruta'] . '<input type="hidden" id="idruta_dist_' . $iddistribucion . '" value="' . $idft_ruta_distribucion . '"/>';
        }
    }

    if ($tipo_destino == 2 && $estado_recogida) { //DESTINO EXTERNO, NO TIENE RUTA SE PREDETERMINA NOMBRE
        $nombre_ruta_distribucion = 'Distribuci&oacute;n Externa';
    }

    if ($tipo_destino == 1 && $origen) {
        $rutaDistribucion = Model::getQueryBuilder()
            ->select('a.idft_ruta_distribucion')
            ->from('ft_ruta_distribucion', 'a')
            ->innerJoin('a', 'documento', 'b', 'a.documento_iddocumento=b.iddocumento')
            ->innerjoin('a', 'ft_dependencias_ruta', 'c', 'a.idft_ruta_distribucion=c.ft_ruta_distribucion')
            ->where("b.estado='APROBADO' and c.estado_dependencia=1")
            ->andWhere('c.dependencia_asignada = :dependencia')
            ->setParameter(':dependencia', $DependenciaCargo->iddependencia, \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute()
            ->fetchAll();
    }

    return $nombre_ruta_distribucion . "<select id='opciones_acciones_distribucion2' class='[data-init-plugin='select2'] pull-left btn btn-xs'><option>123</option></select>";
}

function select_mensajeros_ruta_distribucion($iddistribucion)
{ //Mensajero
    $datos_distribucion = busca_filtro_tabla("iddistribucion,tipo_origen,tipo_destino,estado_recogida,ruta_origen,ruta_destino,mensajero_origen,mensajero_destino,mensajero_empresad", "distribucion", "iddistribucion=" . $iddistribucion, "");
    $diligencia = mostrar_diligencia_distribucion($datos_distribucion[0]['tipo_origen'], $datos_distribucion[0]['estado_recogida']);

    switch ($diligencia) {
        case 'RECOGIDA':
            $select_mensajeros = generar_select_mensajeros_distribucion($datos_distribucion[0]['tipo_origen'], $datos_distribucion[0]['tipo_destino'], $datos_distribucion[0]['mensajero_origen'], $datos_distribucion[0]['mensajero_destino'], 0, $iddistribucion, $diligencia);
            break;
        case 'ENTREGA':
            $select_mensajeros = generar_select_mensajeros_distribucion($datos_distribucion[0]['tipo_origen'], $datos_distribucion[0]['tipo_destino'], $datos_distribucion[0]['ruta_destino'], $datos_distribucion[0]['mensajero_destino'], $datos_distribucion[0]['mensajero_empresad'], $iddistribucion, $diligencia);
            break;
    } //fin switch

    return $select_mensajeros;
}

function generar_select_mensajeros_distribucion($tipo_origen, $tipo_destino, $mensajero_origen, $mensajero_destino, $empresa_transportadora, $iddistribucion, $diligencia)
{
    $html = '';
    if ($tipo_origen == 1) { //internos
        if ($diligencia == 'RECOGIDA') {
            if ($mensajero_origen) {
                $datos_mensajero = busca_filtro_tabla("b.nombres,b.apellidos,b.iddependencia_cargo", "distribucion a, vfuncionario_dc b", "a.mensajero_origen=b.iddependencia_cargo and a.iddistribucion=" . $iddistribucion, "");
                $nombre_mensajero = $datos_mensajero[0]['nombres'] . ' ' . $datos_mensajero[0]['apellidos'];
                $html .= '<label id="select_mensajeros_ditribucion_' . $iddistribucion . '" valor="' . $datos_mensajero[0]['iddependencia_cargo'] . '-i">' . $nombre_mensajero . '</label>';
            } else {
                $html .= '<label  id="select_mensajeros_ditribucion_' . $iddistribucion . '"> No tiene mensajero asignado</label>';
            }
        } elseif ($diligencia == 'ENTREGA') {
            if ($mensajero_destino && $tipo_destino == 2) {
                $datos_mensajero = busca_filtro_tabla("b.nombres,b.apellidos,b.iddependencia_cargo", "distribucion a, vfuncionario_dc b", "a.mensajero_destino=b.iddependencia_cargo and a.iddistribucion=" . $iddistribucion, "");
                $nombre_mensajero = $datos_mensajero[0]['nombres'] . ' ' . $datos_mensajero[0]['apellidos'];
                $html .= '<label id="select_mensajeros_ditribucion_' . $iddistribucion . '" valor="' . $datos_mensajero[0]['iddependencia_cargo'] . '-i">' . $nombre_mensajero . '</label>';
            } elseif ($empresa_transportadora && $tipo_destino == 1) {
                $empresas_transportadoras = busca_filtro_tabla("idcf_empresa_trans as id,nombre", "cf_empresa_trans", "estado=1 and idcf_empresa_trans=" . $mensajero_destino, "");
                $html = '<label id="select_mensajeros_ditribucion_' . $iddistribucion . '" valor="' . $mensajero_destino . '-e">' . $empresas_transportadoras[0]['nombre'] . '-e</label>';
            } else {
                $html .= '<label  id="select_mensajeros_ditribucion_' . $iddistribucion . '"> No tiene mensajero asignado</label>';
            }
        }
    } else { //externos
        if ($empresa_transportadora) {
            $empresas_transportadoras = busca_filtro_tabla("idcf_empresa_trans as id,nombre", "cf_empresa_trans", "estado=1 and idcf_empresa_trans=" . $mensajero_destino, "");
            $html = '<label id="select_mensajeros_ditribucion_' . $iddistribucion . '" valor="' . $mensajero_destino . '-e">' . $empresas_transportadoras[0]['nombre'] . '-e</label>';
        } elseif ($mensajero_destino) {

            $mensajeros_externos = Model::getQueryBuilder()
                ->select(["iddependencia_cargo as id", "CONCAT(nombres, CONCAT(' ', apellidos)) as nombre", "cargo"])
                ->from("vfuncionario_dc")
                ->where("iddependencia_cargo = :iddep")
                ->setParameter(':iddep', $mensajero_destino)
                ->execute()->fetchAll();

            if ($mensajeros_externos[0]['cargo'] == "Mensajero") {
                $tipo_mensajero = "i";
            } else {
                $tipo_mensajero = "e";
            }
            $html = '<label  id="select_mensajeros_ditribucion_' . $iddistribucion . '" valor="' . $mensajero_destino . "-" . $tipo_mensajero . '">' . $mensajeros_externos[0]['nombre'] . '-' . $tipo_mensajero . '</label>';
        } else { //si no tiene ruta de distribucion y es tipo=1 (interno) el select sale vacio
            $html .= '<label  id="select_mensajeros_ditribucion_' . $iddistribucion . '"> No tiene mensajero asignado</label>';
        }
    } //FIN: externos

    return $html;
}
function filtro_planilla_distribucion()
{
    if ($_REQUEST['variable_busqueda']) {
        $variables = explode("|", $_REQUEST['variable_busqueda']);
        $sql = "iddocumento=" . $variables[1];
        return $sql;
    } else {
        return '1=1';
    }
}
function mostrar_planilla_diligencia_distribucion($iddistribucion)
{ //Planilla Asociada
    $planillas = busca_filtro_tabla("b.iddocumento,b.numero", "ft_despacho_ingresados a, documento b, ft_item_despacho_ingres c", "a.idft_despacho_ingresados=c.ft_despacho_ingresados AND a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND c.ft_destino_radicacio=" . $iddistribucion, "");
    $html = "No tiene planilla asociada";
    //Pendiente
    //el componente 379 tiene busqueda de planillas
    if ($planillas['numcampos']) {
        $html = '';
        for ($i = 0; $i < $planillas['numcampos']; $i++) {
            $html .= '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $planillas[$i]['iddocumento'] . '" conector="iframe" titulo="No Registro ' . $planillas[$i]['numero'] . '"><center><button class="btn btn-complete">' . $planillas[$i]['numero'] . '</button></center></div>';
        }
    }
    return $html;
}

function generar_check_accion_distribucion($iddistribucion)
{

    $checkbox = '<input type="checkbox" class="accion_distribucion" value="' . $iddistribucion . '">';
    return $checkbox;
}

function mostrar_origen_distribucion($tipo_origen, $origen)
{
    $nombre_origen = retornar_origen_destino_distribucion($tipo_origen, $origen);
    $nombre_origen .= '<br>';
    $nombre_origen .= retornar_ubicacion_origen_destino_distribucion($tipo_origen, $origen);
    return $nombre_origen;
}

function mostrar_destino_distribucion($tipo_destino, $destino)
{
    $nombre_destino = retornar_origen_destino_distribucion($tipo_destino, $destino);
    $nombre_destino .= '<br>';
    $nombre_destino .= retornar_ubicacion_origen_destino_distribucion($tipo_destino, $destino);
    return $nombre_destino;
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

function condicion_adicional_distribucion()
{
    $condicion_adicional = "";
    $funcionario_codigo_usuario_actual = usuario_actual('funcionario_codigo');
    $es_mensajero = busca_filtro_tabla("iddependencia_cargo", "vfuncionario_dc", "lower(cargo)='mensajero' AND funcionario_codigo='" . $funcionario_codigo_usuario_actual . "' AND estado_dc=1", "");
    $administrador_mensajeria = validar_administrador_mensajeria();
    //CONDICION VENTANILLA
    $conector_mensajero = ' AND ';
    $conector_final_mensajero = '';
    if (!$administrador_mensajeria) {
        $ventanilla_radicacion = usuario_actual('ventanilla_radicacion');
        if ($ventanilla_radicacion) {
            if ($es_mensajero['numcampos']) {
                $condicion_adicional .= " AND ( ( b.ventanilla_radicacion=" . $ventanilla_radicacion . " ) OR ";
                $conector_mensajero = '';
                $conector_final_mensajero = ' )';
            } else {
                $condicion_adicional .= " AND ( b.ventanilla_radicacion=" . $ventanilla_radicacion . " ) ";
            }
        } else if ($es_mensajero['numcampos']) { } else {
            $condicion_adicional .= " AND ( 1=2 ) ";
            //la consulta sale vacia si no pertenece a dependencia ventanilla
        }
    }

    //FIN CONDICION VENTANILLA
    //FILTRO MENSAJERO
    if (!$administrador_mensajeria && $es_mensajero['numcampos']) { //si no es un administrador filtramos como si fuera un mensajero
        if ($es_mensajero['numcampos']) { //si es mensajero
            $lista_roles_funcionarios = '';
            for ($i = 0; $i < $es_mensajero['numcampos']; $i++) {
                $lista_roles_funcionarios .= $es_mensajero[$i]['iddependencia_cargo'];
                if (($i + 1) != $es_mensajero['numcampos']) {
                    $lista_roles_funcionarios .= ',';
                }
            } //fin for rol funcionario mensajero

            $condicion_adicional .= $conector_mensajero . "  ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.mensajero_origen IN(" . $lista_roles_funcionarios . ") ) OR  ( (a.mensajero_empresad=0 OR a.mensajero_empresad IS NULL) AND a.mensajero_destino IN(" . $lista_roles_funcionarios . ") AND a.estado_recogida=1  ) ) " . $conector_final_mensajero;
        } //fin $es_mensajero mensajero
    } // FIN: si no es un administrador filtramos como si fuera un mensajero
    //FIN FILTRO MENSAJERO

    if (@$_REQUEST['variable_busqueda']) {
        $vector_variable_busqueda = explode('|', $_REQUEST['variable_busqueda']);
        //FILTRO POR VENTANILLA DE RADICACION
        if ($vector_variable_busqueda[0] == 'filtro_ventanilla_radicacion' && $vector_variable_busqueda[1]) {
            $condicion_adicional .= " AND ( b.ventanilla_radicacion=" . $vector_variable_busqueda[1] . " )";
        } //fin if $vector_variable_busqueda[0]=='filtro_ventanilla_radicacion'
        //FILTRO POR RUTA DE DISTRIBUCION
        if ($vector_variable_busqueda[0] == 'idft_ruta_distribucion' && $vector_variable_busqueda[1]) {

            //CONDICION RUTA ORIGEN
            $condicion_adicional .= " AND ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.ruta_origen=" . $vector_variable_busqueda[1] . ")";

            //CONDICION RUTA DESTINO
            $condicion_adicional .= " OR ( a.tipo_destino=1 AND a.ruta_destino=" . $vector_variable_busqueda[1] . " AND a.estado_recogida=1  ) )";
        } //fin if $vector_variable_busqueda[0]=='idft_ruta_distribucion'
        //FILTRO POR MENSAJERO
        if ($vector_variable_busqueda[0] == 'filtro_mensajero_distribucion' && $vector_variable_busqueda[1]) {

            $mensajero_tipo = explode('-', $vector_variable_busqueda[1]);

            if ($mensajero_tipo[1] == 'i') {
                //CONDICION mensajero origen
                $condicion_adicional .= " AND ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.mensajero_origen=" . $mensajero_tipo[0] . ") OR ";
            } else {
                $condicion_adicional .= "  AND ( ";
            }
            //CONDICION mensajero destino
            $coondicion_tipo_mensajero_destino = 0;
            if ($mensajero_tipo[1] == 'e') {
                $coondicion_tipo_mensajero_destino = 1;
            }
            $condicion_adicional .= "  (a.mensajero_empresad=" . $coondicion_tipo_mensajero_destino . " AND a.mensajero_destino=" . $mensajero_tipo[0] . " AND a.estado_recogida=1  ) )";
        } //fin if $vector_variable_busqueda[0]=='filtro_mensajero_distribucion'
        //FILTRO POR TIPO ORIGEN filtro_tipo_origen
        if ($vector_variable_busqueda[0] == 'filtro_tipo_origen' && $vector_variable_busqueda[1]) {
            switch ($vector_variable_busqueda[1]) {
                case 1:
                    //Externo
                    $condicion_adicional .= " AND a.tipo_origen = 1 ";
                    break;
                case 2:
                    //Interno
                    $condicion_adicional .= " AND a.tipo_origen = 2 ";
                    break;
                case 3:
                    //Mostrar Todos
                    $condicion_adicional .= "";
                    break;
            }
        }
        //FIN FILTRO POR TIPO ORIGEN
    } //fin if $_REQUEST['variable_busqueda']
    return $condicion_adicional;
}

//---------------------------------------------------------------------------------------------
//RUTAS DE DISTRIBUCION

function actualizar_dependencia_ruta_distribucion($idft_ruta_distribucion, $iddependencia, $estado)
{
    /*
     * $estado = 1 -> activo ; 2-> inactivo
     */
    $busca_distribuciones_origen = busca_filtro_tabla("a.iddistribucion", "distribucion a, documento b, vfuncionario_dc c", "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_origen=1 AND a.estado_recogida=0 AND c.iddependencia_cargo=a.origen AND c.iddependencia=" . $iddependencia, "");
    $busca_distribuciones_destino = busca_filtro_tabla("a.iddistribucion", "distribucion a, documento b, vfuncionario_dc c", "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_destino=1 AND c.iddependencia_cargo=a.destino AND c.iddependencia=" . $iddependencia, "");
    //ASIGNO O RETIRO RUTA DE DISTRIBUCION, SEGUN SI ACTIVAN O INACTIVAN UNA DEPENDENCIA EN UNA RUTA DE DISTRIBUCION.
    if ($estado == 1) { //ASIGNO RUTA DE DISTRIBUCION A LAS DISTRIBUCIONES
        //ACTUALIZACION_ORIGEN (RECOGIDA)
        for ($i = 0; $i < $busca_distribuciones_origen['numcampos']; $i++) {
            $iddistribucion = $busca_distribuciones_origen[$i]['iddistribucion'];
            $upro = " UPDATE distribucion SET mensajero_origen=0,ruta_origen=" . $idft_ruta_distribucion . " WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($upro);
        }
        //ACTUALIZACION_DESTINO (ENTREGA)
        for ($i = 0; $i < $busca_distribuciones_destino['numcampos']; $i++) {
            $iddistribucion = $busca_distribuciones_destino[$i]['iddistribucion'];
            $uprd = " UPDATE distribucion SET mensajero_destino=0,ruta_destino=" . $idft_ruta_distribucion . " WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($uprd);
        }
    } //fin if $estado==1
    if ($estado == 2) { //RETIRO RUTA DE DISTRIBUCION A LAS DISTRIBUCIONES
        //ACTUALIZACION_ORIGEN (RECOGIDA)
        for ($i = 0; $i < $busca_distribuciones_origen['numcampos']; $i++) {
            $iddistribucion = $busca_distribuciones_origen[$i]['iddistribucion'];
            $upro = " UPDATE distribucion SET mensajero_origen=0,ruta_origen=0 WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($upro);
        }
        //ACTUALIZACION_DESTINO (ENTREGA)
        for ($i = 0; $i < $busca_distribuciones_destino['numcampos']; $i++) {
            $iddistribucion = $busca_distribuciones_destino[$i]['iddistribucion'];
            $uprd = " UPDATE distribucion SET mensajero_destino=0,ruta_destino=0 WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($uprd);
        }
    } //fin if $estado==2
}

//fin function actualizar_dependencia_ruta_distribucion()

function actualizar_mensajero_ruta_distribucion($idft_ruta_distribucion, $iddependencia_cargo_mensajero, $estado)
{
    if ($estado == 2) { //SI INACTIVAN EL MENSAJERO, LO RETIRO DE LAS DISTRIBUCIONES
        //ACTUALIZACION_ORIGEN (RECOGIDA)
        $busca_distribuciones_mensajero_origen = busca_filtro_tabla("a.iddistribucion", "distribucion a, documento b", "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_origen=1 AND a.estado_recogida=0 AND mensajero_origen=" . $iddependencia_cargo_mensajero . " AND a.ruta_origen=" . $idft_ruta_distribucion, "");
        for ($i = 0; $i < $busca_distribuciones_mensajero_origen['numcampos']; $i++) {
            $iddistribucion = $busca_distribuciones_mensajero_origen[$i]['iddistribucion'];
            $upro = " UPDATE distribucion SET mensajero_origen=0 WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($upro);
        }
        //ACTUALIZACION_DESTINO (ENTREGA)
        $busca_distribuciones_mensajero_destino = busca_filtro_tabla("a.iddistribucion", "distribucion a, documento b", "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_destino=1 AND mensajero_destino=" . $iddependencia_cargo_mensajero . " AND a.ruta_destino=" . $idft_ruta_distribucion, "");

        for ($i = 0; $i < $busca_distribuciones_mensajero_destino['numcampos']; $i++) {
            $iddistribucion = $busca_distribuciones_mensajero_destino[$i]['iddistribucion'];
            $uprd = " UPDATE distribucion SET mensajero_destino=0 WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($uprd);
        }
    } //fin if $estado==2

    if ($estado == 3) { //ASIGNA UN MENSAJERO A LAS DISTRIBUCIONES QUE NO TIENEN MENSAJERO ASIGNADO
        //ACTUALIZACION_ORIGEN (RECOGIDA)
        $busca_distribuciones_mensajero_origen = busca_filtro_tabla("a.iddistribucion", "distribucion a, documento b", "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_origen=1 AND a.estado_recogida=0 AND a.mensajero_origen=0 AND a.ruta_origen=" . $idft_ruta_distribucion, "");
        for ($i = 0; $i < $busca_distribuciones_mensajero_origen['numcampos']; $i++) {
            $iddistribucion = $busca_distribuciones_mensajero_origen[$i]['iddistribucion'];
            $upro = " UPDATE distribucion SET mensajero_origen=" . $iddependencia_cargo_mensajero . " WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($upro);
        }
        //ACTUALIZACION_DESTINO (ENTREGA)
        $busca_distribuciones_mensajero_destino = busca_filtro_tabla("a.iddistribucion", "distribucion a, documento b", "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion<>3 AND a.tipo_destino=1 AND a.mensajero_destino=0 AND a.ruta_destino=" . $idft_ruta_distribucion, "");

        for ($i = 0; $i < $busca_distribuciones_mensajero_destino['numcampos']; $i++) {
            $iddistribucion = $busca_distribuciones_mensajero_destino[$i]['iddistribucion'];
            $uprd = " UPDATE distribucion SET mensajero_destino=" . $iddependencia_cargo_mensajero . " WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($uprd);
        }
    } //fin if $estado==3
}

//fin function actualizar_mensajero_ruta_distribucion()

function validar_administrador_mensajeria($funcionario_codigo = 0)
{
    $funcionario_codigo_usuario_actual = $funcionario_codigo;
    if (!$funcionario_codigo_usuario_actual) {
        $funcionario_codigo_usuario_actual = usuario_actual('funcionario_codigo');
    }
    $cargo_administrador_mensajeria = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", " lower(cargo) LIKE 'administrador%de%mensajer%a' AND estado_dc=1 AND funcionario_codigo=" . $funcionario_codigo_usuario_actual, "");
    $administrador_mensajeria = 0;
    if ($cargo_administrador_mensajeria['numcampos']) {
        $administrador_mensajeria = 1;
    }
    return $administrador_mensajeria;
}

function condicion_por_ingresar_ventanilla_distribucion()
{
    global $conn, $ruta_db_superior;
    include_once($ruta_db_superior . "app/distribucion/funciones_distribucion.php");
    $administrador_mensajeria = validar_administrador_mensajeria();
    $ventanilla_radicacion_usuario_actual = usuario_actual('ventanilla_radicacion');

    $condicion_adicional = "";
    if (!$administrador_mensajeria) {
        $condicion_adicional .= " ";
        if ($ventanilla_radicacion_usuario_actual) {
            $condicion_adicional .= " AND ( a.ventanilla_radicacion=" . $ventanilla_radicacion_usuario_actual . " )";
        } else {
            $condicion_adicional .= " AND (1=1)";
        }
    }
    return $condicion_adicional;
}

function obtener_radicado($idDocumento)
{
    $Documento = new Documento($idDocumento);
    $radicado = $Documento->numero;
    $enlace_documento = '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $idDocumento . '" conector="iframe" titulo="No Registro ' . $radicado . '"><center><button class="btn btn-complete">' . $radicado . '</button></center></div>';
    return $enlace_documento;
}
