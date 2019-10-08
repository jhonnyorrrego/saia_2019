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

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $data = (object) $_REQUEST;

    if (!$data->idformato) {
        $data->nombre = trim($data->nombre);
        $data->nombre_tabla = "ft_" . $data->nombre;
        $data->ruta_mostrar = "mostrar_{$data->nombre}.php";
        $data->ruta_buscar = "mostrar_{$data->nombre}.php";
        $data->ruta_editar = "editar_{$data->nombre}.php";
        $data->ruta_adicionar = "adicionar_{$data->nombre}.php";
        $data->contador_idcontador = $data->contador_idcontador ?
            $data->contador_idcontador : crear_contador($data->nombre);
    } else {
        unset($data->nombre);
    }

    if ($data->fk_categoria_formato && is_array($data->fk_categoria_formato)) {
        $data->fk_categoria_formato = implode(',', $data->fk_categoria_formato);
    }

    if ($data->banderas && is_array($data->banderas)) {
        $data->banderas = implode(',', $data->banderas);
    }

    if ($data->funcion_predeterminada) {
        if ($data->funcion_predeterminada && is_array($data->funcion_predeterminada)) {
            $data->funcion_predeterminada = implode(',', $data->funcion_predeterminada);
        }
    } else {
        $data->funcion_predeterminada = 0;
    }

    if ($data->paginar) {
        $data->paginar = 1;
    } else {
        $data->paginar = 0;
    }

    if ($data->mostrar_pdf) {
        $data->mostrar_pdf = 1;
    } else {
        $data->mostrar_pdf = 0;
    }

    if ($data->tipo_edicion) {
        $data->tipo_edicion = 1;
    } else {
        $data->tipo_edicion = 0;
    }

    $data->fecha = $data->fecha ?? date('Y-m-d H:i:s');
    $data->mostrar_pdf = $data->mostrar_pdf ?? 0;
    $data->cod_padre = $data->cod_padre ? $data->cod_padre : 0;
    $data->detalle = $data->cod_padre ? 1 : 0;
    $data->firma_digital = $data->firma_digital ? (int) $data->firma_digital : 0;
    $data->mostrar_tipodoc_pdf = $data->mostrar_tipodoc_pdf ? $data->mostrar_tipodoc_pdf : 0;

    /*
     * Se valida que si el tiempo que llega es menor 
     * de 3000 milisegundos se multiplica
     * el valor por 60000 ya que se esta ingresando en minutos
     */
    if ($data->tiempo_autoguardado < 3000) {
        $data->tiempo_autoguardado = $data->tiempo_autoguardado * 60000;
    }

    $data->funcionario_idfuncionario = SessionController::getValue('usuario_actual');
    $data->margenes = sprintf(
        "%s,%s,%s,%s",
        $data->mizq * 10,
        $data->mder * 10,
        $data->msup * 10,
        $data->minf * 10
    );

    $GenerarFormatoController = new GenerarFormatoController($data->idformato);
    $GenerarFormatoController->refreshFormat(get_object_vars($data));
    $moduleId = $GenerarFormatoController->getModule()->getPK();
    $formatId = $GenerarFormatoController->findFormat()->getPK();

    PermisoPerfil::executeDelete([
        'modulo_idmodulo' => $moduleId
    ]);

    foreach ($_REQUEST['permisosPerfil'] as $profileId) {
        PermisoPerfil::newRecord([
            'modulo_idmodulo' => $moduleId,
            'perfil_idperfil' => $profileId
        ]);
    }

    $Response->data->formatId = $formatId;
    $Response->message = "EL formato se guardó con éxito";
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

/**
 * crea el contador del formato en caso de no existir
 *
 * @param string $name
 * @return integer
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-09-02
 */
function createCounter($name)
{
    $Contador = Contador::findByAttributes([
        'nombre' => $name
    ]);

    if (!$Contador) {
        $counterId = Contador::newRecord([
            'nombre' => $name
        ]);
    } else {
        $counterId = $Contador->getPK();
    }

    return $counterId;
}
