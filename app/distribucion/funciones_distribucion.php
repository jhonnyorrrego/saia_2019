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

/**
 *  Funcion que adiciona item en distribucion luego de registrar una correspondencia, o generar una comunicacion externa
 * @param integer $iddoc Identificacion del documento.
 * @param array $datos contiene la informacion basica para realizar la distribucion.
 * @param integer $iddistribucion  se utiliza para definir si es una distribucion nueva o modificacion de una existente.
 * @lastModification Julian Otalvaro Osorio <julian.otalvaro@cerok.com 2019-10-07
 */

function ingresar_distribucion($iddoc, $datos, $iddistribucion = 0)
{
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
    $destinos = array();
    $es_dependencia = 0;
    if ($datos['destino'][(strlen($datos['destino']) - 1)] == '#') {
        $es_dependencia = 1;
    }
    if ($es_dependencia) {
        $destinos = obtener_funcionarios_dependencia_destino($datos['destino']);
    } else {
        $destinos[] = $datos['destino'];
    }

    $distribuciones = array();

    for ($j = 0; $j < count($destinos); $j++) {

        //NUMERO DE DISTRIBUCION
        $numero_distribucion = obtener_numero_distribucion($iddoc);

        //OBTENER RUTA_DESTINO
        $idft_ruta_distribucion_destino = 0;
        if ($datos['tipo_destino'] == 1) {
            $idft_ruta_distribucion_destino = obtener_ruta_distribucion($destinos[$j]);
        }
        //OBTENER MENSAJERO_RUTA_DESTINO
        $iddependencia_cargo_mensajero_destino = 0;
        if ($idft_ruta_distribucion_destino) {
            $iddependencia_cargo_mensajero_destino = obtener_mensajero_ruta_distribucion($idft_ruta_distribucion_destino);
        }

        $Documento = new Documento($iddoc);

        $camposDistribucion = [
            'origen' => $datos['origen'],
            'tipo_origen' => $datos['tipo_origen'],
            'ruta_origen' => $idft_ruta_distribucion_origen,
            'mensajero_origen' => $iddependencia_cargo_mensajero_origen,
            'destino' => $destinos[$j],
            'tipo_destino' => $datos['tipo_destino'],
            'ruta_destino' => $idft_ruta_distribucion_destino,
            'mensajero_destino' => $iddependencia_cargo_mensajero_destino,
            'numero_distribucion' => $numero_distribucion,
            'estado_distribucion' => $estado_distribucion,
            'estado_recogida' => $estado_recogida,
            'documento_iddocumento' => $iddoc,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'sede_origen' => $Documento->ventanilla_radicacion,
            'sede_destino' => $Documento->ventanilla_radicacion,
        ];

        if ($iddistribucion) {
            $camposDistribucion = array_merge($camposDistribucion, ["iddistribucion" => $iddistribucion]);
        }
        $nuevaDistribucion = Distribucion::newRecord($camposDistribucion);
        $distribuciones[] = $nuevaDistribucion;
    }
    return $distribuciones;
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
                <td style="width:20%;"> ' . 'tipo_origen' . '</td>
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
    $cadena_mostrar = $numero . ' - ' . $array_tipo_origen[$tipo_origen];
    $enlace_documento = '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $iddocumento . '" conector="iframe" titulo="No Registro ' . $numero . '"><center><button class="btn btn-complete">' . $cadena_mostrar . '</button></center></div>';
    return $enlace_documento;
}

/**
 * Ver_numero_registro - Esta funcion retorna el numero de registro de una distribución
 *
 * @param [integer] $iddocumento
 * @param [integer] $tipo_origen
 * @param [date] $fecha
 * @return string Retorna el numero que toma en cuenta la fecha, el numero de item y el tipo de origen
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-09-26
 */
function ver_numero_registro($iddocumento, $tipo_origen, $fecha)
{
    $Documento = new Documento($iddocumento);
    $numero = $Documento->numero;
    $array_tipo_origen = array(
        1 => 'I',
        2 => 'E'
    );
    $fecha = DateController::convertDate($fecha, 'Y-m-d');
    $numeroRegistro = "{$fecha}-{$numero}-{$array_tipo_origen[$tipo_origen]}";
    return $numeroRegistro;
}

function ver_documento_planilla($iddocumento)
{
    $Documento = new Documento($iddocumento);
    return '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $iddocumento . '" conector="iframe" titulo="No Registro ' . $Documento->numero . '"><center><button class="btn btn-complete">' . $Documento->numero . '</button></center></div>';
}
function ver_estado_distribucion($estado_distribucion)
{ //Estado
    $array_estado_distribucion = array(
        'estado_distribucion' => 'Pendiente',
        0 => 'Por recepcionar',
        1 => 'Pendiente por distribuir',
        2 => 'En distribuci&oacute;n',
        3 => 'Finalizado'
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

/**
 * Esta funcion crea los select para el reporte por distribuir de los items de acuerdo a la dependencia del destino
 *
 * @param [integer] $iddistribucion Identificador de la ruta de distribucion
 * @return string Este contiene un select con las opciones de las rutas de distribución de acuerdo a la dependencia del destino
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-09-25
 */
function mostrar_nombre_ruta_distribucion($iddistribucion)
{
    $rutasDistribucion = obtenerRuta($iddistribucion);
    $opciones = "<select id='ruta{$iddistribucion}' class='selRuta' data-id='{$iddistribucion}' style='width:150px'>";
    foreach ($rutasDistribucion as $ruta) {
        $opciones .= "<option value='{$ruta["idft_ruta_distribucion"]}'>{$ruta['nombre_ruta']}</option>";
    }
    $opciones .= "</select> <script> $('#ruta{$iddistribucion}').select2();</script>";

    $Distribucion = new Distribucion($iddistribucion);
    if ($Distribucion->sede_origen != $Distribucion->sede_destino) {
        $opciones = '(Entre sedes)';
    }
    return $opciones;
}
/**
 * Esta funcion busca las rutas que se encuentran en la dependencia del destino
 *
 * @param [integer] $iddistribucion Identificador de la ruta de distribucion
 * @return array Este contiene un array con las rutas de distribución de acuerdo a la dependencia del destino
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-09-25
 */
function obtenerRuta($iddistribucion)
{
    $Distribucion = new Distribucion($iddistribucion);
    $destino = $Distribucion->destino;
    $query = Model::getQueryBuilder();
    $roles = $query
        ->select("iddependencia")
        ->from("vfuncionario_dc")
        ->where("estado_dc = 1 and tipo_cargo = 1 and iddependencia_cargo = :destino")
        ->setParameter(":destino", $destino, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();
    $query = Model::getQueryBuilder();
    $rutasDistribucion = $query
        ->select("idft_ruta_distribucion", "nombre_ruta")
        ->from("ft_ruta_distribucion")
        ->where("asignar_dependencias= :dependencia")
        ->setParameter(":dependencia", $roles[0]['iddependencia'], \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();
    return $rutasDistribucion;
}

/**
 * Esta función crea un select en la columna mensajeros del reporte por distribuir 
 *
 * @param [integer] $iddistribucion
 * @return string Este contiene un select con sus respectivas opciones de acuerdo a la ruta de distribución
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-09-25
 */
function select_mensajeros_ruta_distribucion($iddistribucion)
{
    $Distribucion = new Distribucion($iddistribucion);

    $rutasDistribucion = obtenerRuta($iddistribucion);
    $ruta = $rutasDistribucion[0]['idft_ruta_distribucion'];
    $html = "<select id='selMensajeros{$iddistribucion}' class='selMensajeros' style='width:150px' >";
    $query = Model::getQueryBuilder();
    $mensajeros = $query
        ->select("mensajero_ruta")
        ->from("ft_funcionarios_ruta")
        ->where("estado_mensajero= 1")
        ->andWhere("ft_ruta_distribucion = :ruta")
        ->setParameter(":ruta", $ruta, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    if ($Distribucion->sede_origen == $Distribucion->sede_destino) {
        foreach ($mensajeros as $key => $ruta) {
            $VfuncionarioDc = new VfuncionarioDc($mensajeros[$key]["mensajero_ruta"]);
            $html .= "<option value='{$VfuncionarioDc->getPK()}'>{$VfuncionarioDc->nombres} {$VfuncionarioDc->apellidos}</option>";
        }
    }

    if ($Distribucion->sede_origen != $Distribucion->sede_destino) {
        $VfuncionarioDc = new VfuncionarioDc($Distribucion->mensajero_destino);
        $html .= "<option value='{$VfuncionarioDc->getPK()}'>{$VfuncionarioDc->nombres} {$VfuncionarioDc->apellidos}</option>";
    }

    $html .= "</select><script> $('#selMensajeros{$iddistribucion}').select2();</script>";
    if ($Distribucion->sede_origen != $Distribucion->sede_destino) {
        $html .= "<script> $('#selMensajeros{$iddistribucion}').attr('disabled','disabled');</script>";
    }
    return $html;
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
                ->setParameter(':iddep', $mensajero_destino, \Doctrine\DBAL\Types\Type::INTEGER)
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
/**
 * Esta funcion muestra las planillas que estan asociadas a la distribucion en los reportes de distribucion pendientes, en distribucion y finalizados
 *
 * @param [integer] $iddistribucion
 * @return string Con html que muestra con botones las planillas que estan asociadas al documento.
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-10
 */
function mostrar_planilla_diligencia_distribucion($iddistribucion)
{ //Planilla Asociada
    $ft_destapacho_ingresados = Model::getQueryBuilder()
        ->select('b.iddocumento', 'b.numero')
        ->from('ft_despacho_ingresados', 'a')
        ->innerJoin('a', 'documento', 'b', 'a.documento_iddocumento=b.iddocumento')
        ->innerJoin('a', 'ft_item_despacho_ingres', 'c', 'a.idft_despacho_ingresados=c.ft_despacho_ingresados')
        ->where('lower(b.estado)="aprobado"')
        ->andWhere('c.ft_destino_radicacio = :iddist')
        ->setParameter(':iddist', $iddistribucion, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    $html = "No tiene planilla asociada";
    //Pendiente
    //el componente 379 tiene busqueda de planillas
    $Distribucion = new Distribucion($iddistribucion);
    if (($iddistribucion == $Distribucion->entre_sedes) || ($Distribucion->entre_sedes == 0)) {
        if ($ft_destapacho_ingresados) {
            $html = '';
            foreach ($ft_destapacho_ingresados as $planilla) {
                $html .= '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $planilla['iddocumento'] . '" conector="iframe" titulo="No Registro ' . $planilla['numero'] . '"><center><button class="btn btn-complete">' . $planilla['numero'] . '</button></center></div>';
            }
        }
    } else {
        $registros_planillas = Model::getQueryBuilder()
            ->select('b.iddocumento', 'b.numero')
            ->from('ft_despacho_ingresados', 'a')
            ->innerJoin('a', 'documento', 'b', 'a.documento_iddocumento=b.iddocumento')
            ->innerJoin('a', 'ft_item_despacho_ingres', 'c', 'a.idft_despacho_ingresados=c.ft_despacho_ingresados')
            ->where('lower(b.estado)="aprobado"')
            ->andWhere('c.ft_destino_radicacio = :iddist')
            ->setParameter(':iddist', $Distribucion->entre_sedes, \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute()->fetchAll();
        $html = '';
        foreach ($registros_planillas as $planilla) {
            $html .= '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $planilla['iddocumento'] . '" conector="iframe" titulo="No Registro ' . $planilla['numero'] . '"><center><button class="btn btn-complete">' . $planilla['numero'] . '</button></center></div>';
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

function condicionGeneralDistribucion()
{
    $condicionAdicional = "";
    $userCode = SessionController::getValue('usuario_actual');

    $esMensajero = Model::getQueryBuilder()
        ->select('iddependencia_cargo')
        ->from(VfuncionarioDc::getTableName())
        ->where('estado_dc = 1')
        ->andWhere('funcionario_codigo = :userCode')
        ->andWhere('LOWER(cargo) = :position')
        ->setParameter('position', 'mensajero')
        ->setParameter('userCode', $userCode, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    $administrador_mensajeria = validar_administrador_mensajeria();
    //CONDICION VENTANILLA
    $conector_mensajero = ' AND ';
    $conectorFinalMensajero = '';

    if (!$administrador_mensajeria) {
        $ventanillaRadicacion = usuario_actual('ventanilla_radicacion');
        if ($ventanillaRadicacion) {
            if ($esMensajero[0]) {
                $condicionAdicional .= " AND ( ( a.sede_origen=" . $ventanillaRadicacion . " ) OR ";
                $conector_mensajero = '';
                $conectorFinalMensajero = ' )';
            } else {
                $condicionAdicional .= " AND ( a.sede_origen=" . $ventanillaRadicacion . " OR a.sede_destino=" . $ventanillaRadicacion . " ) ";
            }
        } else if ($esMensajero[0]) { } else {
            $condicionAdicional .= " AND ( 1=2 ) ";
            //la consulta sale vacia si no pertenece a dependencia ventanilla
        }
    }

    //FIN CONDICION VENTANILLA
    //FILTRO MENSAJERO
    if (!$administrador_mensajeria && $esMensajero) { //si no es un administrador filtramos como si fuera un mensajero
        if ($esMensajero[0]) {
            //si es mensajero
            $listaRolesFuncionarios = '';

            foreach ($esMensajero as $mensajero) {
                $listaRolesFuncionarios .= "{$mensajero['iddependencia_cargo']},";
            }

            $listaRolesFuncionarios = substr($listaRolesFuncionarios, 0, -1);
            //fin for rol funcionario mensajero

            $condicionAdicional .= $conector_mensajero . "  ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.mensajero_origen IN(" . $listaRolesFuncionarios . ") ) OR  ( (a.mensajero_empresad=0 OR a.mensajero_empresad IS NULL) AND a.mensajero_destino IN(" . $listaRolesFuncionarios . ") AND a.estado_recogida=1  ) ) " . $conectorFinalMensajero;
        } //fin $es_mensajero mensajero
    } // FIN: si no es un administrador filtramos como si fuera un mensajero
    //FIN FILTRO MENSAJERO

    if (@$_REQUEST['variable_busqueda']) {
        $vectorVariableBusqueda = explode('|', $_REQUEST['variable_busqueda']);
        //FILTRO POR VENTANILLA DE RADICACION
        if ($vectorVariableBusqueda[0] == 'filtro_ventanilla_radicacion' && $vectorVariableBusqueda[1]) {
            $condicionAdicional .= " AND ( b.ventanilla_radicacion=" . $vectorVariableBusqueda[1] . " )";
        } //fin if $vectorVariableBusqueda[0]=='filtro_ventanillaRadicacion'
        //FILTRO POR RUTA DE DISTRIBUCION
        if ($vectorVariableBusqueda[0] == 'idft_ruta_distribucion' && $vectorVariableBusqueda[1]) {

            //CONDICION RUTA ORIGEN
            $condicionAdicional .= " AND ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.ruta_origen=" . $vectorVariableBusqueda[1] . ")";

            //CONDICION RUTA DESTINO
            $condicionAdicional .= " OR ( a.tipo_destino=1 AND a.ruta_destino=" . $vectorVariableBusqueda[1] . " AND a.estado_recogida=1  ) )";
        } //fin if $vectorVariableBusqueda[0]=='idft_ruta_distribucion'
        //FILTRO POR MENSAJERO
        if ($vectorVariableBusqueda[0] == 'filtro_mensajero_distribucion' && $vectorVariableBusqueda[1]) {

            $mensajeroTipo = explode('-', $vectorVariableBusqueda[1]);

            if ($mensajeroTipo[1] == 'i') {
                //CONDICION mensajero origen
                $condicionAdicional .= " AND ( (a.tipo_origen=1 AND a.estado_recogida<>1 AND a.mensajero_origen=" . $mensajeroTipo[0] . ") OR ";
            } else {
                $condicionAdicional .= "  AND ( ";
            }
            //CONDICION mensajero destino
            $condicionTipoMensajeroDestino = 0;
            if ($mensajeroTipo[1] == 'e') {
                $condicionTipoMensajeroDestino = 1;
            }
            $condicionAdicional .= "  (a.mensajero_empresad=" . $condicionTipoMensajeroDestino . " AND a.mensajero_destino=" . $mensajeroTipo[0] . " AND a.estado_recogida=1  ) )";
        } //fin if $vectorVariableBusqueda[0]=='filtro_mensajero_distribucion'
        //FILTRO POR TIPO ORIGEN filtro_tipo_origen
        if ($vectorVariableBusqueda[0] == 'filtro_tipo_origen' && $vectorVariableBusqueda[1]) {
            switch ($vectorVariableBusqueda[1]) {
                case 1:
                    //Externo
                    $condicionAdicional .= " AND a.tipo_origen = 1 ";
                    break;
                case 2:
                    //Interno
                    $condicionAdicional .= " AND a.tipo_origen = 2 ";
                    break;
                case 3:
                    //Mostrar Todos
                    $condicionAdicional .= "";
                    break;
            }
        }
        //FIN FILTRO POR TIPO ORIGEN
    } //fin if $_REQUEST['variable_busqueda']
    return $condicionAdicional;
}

function condicion_adicional_pendientes($estado_distribucion)
{
    $condicionAdicional = condicionGeneralDistribucion();
    $condicionAdicional = '';
    $userCode = SessionController::getValue('usuario_actual');

    $gestorMensajeria = Model::getQueryBuilder()
        ->select('idcf_ventanilla', 'nombre')
        ->from('cf_ventanilla')
        ->where('idfuncionario=:funcionario')
        ->setParameter(':funcionario', $userCode, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()
        ->fetchAll();

    if ($gestorMensajeria) {
        $condicionAdicional .= 'AND (';
        $count = 0;
        foreach ($gestorMensajeria as $i => $gestor) {
            if ($i != 0) {
                $condicionAdicional .= ' OR ';
            }

            $condicionAdicional .= '((a.sede_destino = ' . $gestor['idcf_ventanilla'] . ' AND a.estado_distribucion=0) OR (a.sede_origen = ' . $gestor['idcf_ventanilla'] . ' AND a.estado_distribucion=1) )';
        }
        $condicionAdicional .= ')';
    } else {
        $condicionAdicional .= 'AND  1 = 2 ';
    }

    return $condicionAdicional;
}


function condicion_adicional_endistribucion()
{
    $condicionAdicional = condicionGeneralDistribucion();
    $condicionAdicional = '';
    $userCode = SessionController::getValue('usuario_actual');
    $gestorMensajeria = Model::getQueryBuilder()
        ->select('idcf_ventanilla', 'nombre')
        ->from('cf_ventanilla')
        ->where('idfuncionario=:funcionario')
        ->setParameter(':funcionario', $userCode, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()
        ->fetchAll();
    if ($gestorMensajeria) {
        $condicionAdicional .= 'AND (';
        foreach ($gestorMensajeria as $i => $gestor) {
            if ($i != 0) {
                $condicionAdicional .= ' OR ';
            }

            $condicionAdicional .= 'a.sede_origen = ' . $gestor['idcf_ventanilla'];
        }
        $condicionAdicional .= ')';
    } else {
        $condicionAdicional .= 'AND  1 = 2 ';
    }
    return $condicionAdicional;
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
        $funcionario_codigo_usuario_actual = SessionController::getValue('usuario_actual');
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
    global $ruta_db_superior;
    include_once($ruta_db_superior . "app/distribucion/funciones_distribucion.php");
    $administrador_mensajeria = validar_administrador_mensajeria();
    $ventanillaRadicacionUsuarioActual = usuario_actual('ventanilla_radicacion');

    $condicionAdicional = "";
    if (!$administrador_mensajeria) {
        $condicionAdicional .= " ";
        if ($ventanillaRadicacionUsuarioActual) {
            $condicionAdicional .= " AND ( a.ventanilla_radicacion=" . $ventanillaRadicacionUsuarioActual . " )";
        } else {
            $condicionAdicional .= " AND (1=1)";
        }
    }
    return $condicionAdicional;
}

function obtener_radicado($idDocumento)
{
    $Documento = new Documento($idDocumento);
    $radicado = $Documento->numero;
    $enlace_documento = '<div class="kenlace_saia" enlace="views/documento/index_acordeon.php?documentId=' . $idDocumento . '" conector="iframe" titulo="No Registro ' . $radicado . '"><center><button class="btn btn-complete">' . $radicado . '</button></center></div>';
    return $enlace_documento;
}

/**
 * Retorna la fecha en el reporte de distribución formateado
 *
 * @param [date] $fecha
 * @return date retorna la fecha sin hora
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-09-26
 */
function fecha_distribucion($fecha)
{
    return DateController::convertDate($fecha, 'Y-m-d');
}

/**
 * Retorna la sede de origen del documento en el reporte de distribución 
 *
 * @param [integer] $iddistribucion
 * @return string retorna el nombre de la sede de origen
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-09-27
 */

function obtener_sede_origen($iddistribucion)
{
    $Distribucion = new Distribucion($iddistribucion);
    $sedeOrigen = $Distribucion->sede_origen;
    $query = Model::getQueryBuilder();
    $nombreSedeOrigen = $query
        ->select('idcf_ventanilla', 'nombre')
        ->from('cf_ventanilla')
        ->where('estado=1')
        ->andWhere('idcf_ventanilla = :idSede')
        ->setParameter(':idSede', $sedeOrigen, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    return "<div id='sedeOrigen{$iddistribucion}' data-idsede='{$nombreSedeOrigen[0]['idcf_ventanilla']}'> {$nombreSedeOrigen[0]['nombre']} </div>";
}

/**
 * Retorna la sede de destino del documento en el reporte de distribución 
 *
 * @param [integer] $iddistribucion
 * @return string retorno Nos entrega el nombre de la sede de destino dentro de un div que contiene un data-param con el id de la sede para enviar al adicionar generar planilla
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-09-27
 */
function obtener_sede_destino($iddistribucion)
{
    $Distribucion = new Distribucion($iddistribucion);
    $sedeDestino = $Distribucion->sede_destino;

    $query = Model::getQueryBuilder();
    $nombreSedeDestino = $query
        ->select('nombre', 'idcf_ventanilla')
        ->from('cf_ventanilla')
        ->where('estado=1')
        ->andWhere('idcf_ventanilla = :idSede')
        ->setParameter(':idSede', $sedeDestino, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    $retorno = "<div id='sedeDestino{$iddistribucion}' data-idsede='{$nombreSedeDestino[0]['idcf_ventanilla']}' > {$nombreSedeDestino[0]['nombre']} </div>";
    return $retorno;
}
/**
 * Esta funcion obtiene el asunto desde  ft_radicacion_entrada para que el asunto llegue limpio sin 'ASUNTO:' ya que para el reporte de distribución es redundante incluirlo.
 *
 * @param [integer] $iddoc Id del documento
 * @return string Retorna el texto que contiene el asunto del documento. este se encuentra en descripcion  en las tablas ft_radicacion_entrada y documento.
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-01
 */
function obtener_asunto($iddoc)
{
    $query = Model::getQueryBuilder();
    $ft_radicacion_entrada = $query
        ->select('descripcion')
        ->from('ft_radicacion_entrada')
        ->where('documento_iddocumento = :doc')
        ->setParameter(':doc', $iddoc, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();
    return $ft_radicacion_entrada[0]['descripcion'];
}

/**
 * Esta funcion retorna el nombre de la ventanilla donde se radica un documento
 *
 * @param [integer] $iddoc Identificador del documento
 * @return string $nombreVentanilla este contiene el nombre de la ventanilla.
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-4
 */
function obtener_ventanilla($iddoc)
{
    $nombreVentanilla = '';
    $Documento = new Documento($iddoc);
    $ventanilla = $Documento->ventanilla_radicacion;

    $query = Model::getQueryBuilder();
    $cf_ventanilla = $query
        ->select('nombre')
        ->from('cf_ventanilla')
        ->where('estado=1')
        ->andWhere('idcf_ventanilla = :idSede')
        ->setParameter(':idSede', $ventanilla, \Doctrine\DBAL\Types\Type::INTEGER)
        ->execute()->fetchAll();

    $nombreVentanilla = $cf_ventanilla[0]['nombre'];

    return $nombreVentanilla;
}

/**
 * Esta funcion retorna el nombre y apellido del mensajero, se requiere el idfuncionario
 *
 * @param [integer] $idMensajero
 * @return string retorna los nombres y apellidos del Mensajero
 * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-04 
 */
function obtener_mensajero($idMensajero)
{
    $VfuncionarioDc = new VfuncionarioDc($idMensajero);
    $nombreMensajero = "{$VfuncionarioDc->nombres} {$VfuncionarioDc->apellidos}";
    return $nombreMensajero;
}

/**
 * Retorna el nombre de recorrido en una planilla de distribucion (Matutino, Vespertina)

 * @param [integer] $idft_despacho_ingresados
 * @return string Retorna el nombre del recorrido de la planilla de distribucion
 * * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-04 
 */

function obtener_tipo_recorrido($iddoc)
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
    return $resultado;
}
/**
 * Esta funcion obtiene las distribuciones que se encuentran en la planilla de distribucion
 * NOTA : SE DEJA EN ESPERA, HASTA DEFINIR CON LUZ MOLINA COMO SE DEBE VISUALIZAR.

 * @param [integer] $idft_despacho_ingresados
 * @return string los numeros de radicados de sus distribuciones.
 * * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
 * @date 2019-10-04 
 */

function obtener_distribucion($iddoc)
{
    return '*';
}
