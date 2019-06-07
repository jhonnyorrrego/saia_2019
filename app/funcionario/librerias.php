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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . 'pantallas/documento/librerias.php';

/**
 * las funciones indicadas posteriormente son
 * usadas para el reporte de funcionarios
 * 
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */

/**
 * consulta los nombre del perfil
 *
 * @param string $perfil  campo perfil de funcionario
 * @return string
 */
function get_profile($perfil)
{
    $Funcionario = new Funcionario();
    $Funcionario->perfil = $perfil;
    $profileList = $Funcionario->getProfiles();

    $list = [];
    foreach ($profileList as $key => $Perfil) {
        $list[] = $Perfil->nombre;
    }

    return implode(',', $list);
}

/**
 * formatea el nombre del funcionario
 *
 * @param string $name
 * @param string $lastName
 * @return string
 */
function get_name($userId, $name, $lastName)
{
    $Funcionario = new Funcionario();
    $Funcionario->nombres = htmlentities($name);
    $Funcionario->apellidos = htmlentities($lastName);

    return $Funcionario->getName();
}

/**
 * calcula el estado del funcionario
 *
 * @param int $state
 * @return string
 */
function get_state($state)
{
    $Funcionario = new Funcionario();
    $Funcionario->estado = $state;

    return $Funcionario->getState();
}

/**
 * agrega filtro para busquedas de funcionarios
 * omite el administrador si es un usuario corriente
 * 
 * @return string
 */
function user_condition()
{
    return !SessionController::isRoot() ? Funcionario::excludeCondition() : '1=1';
}

/**
 * muestra la imagen del funcionario
 *
 * @param string $imgRoute
 * @param integer $userId
 * @param string $name
 * @param string $lastName
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-04-01
 */
function get_image($imgRoute, $userId, $name, $lastName)
{
    $Funcionario = new Funcionario();
    $Funcionario->setAttributes([
        'nombres' => $name,
        'apellidos' => $lastName,
        'foto_recorte' => $imgRoute
    ]);
    $Funcionario->setPK($userId);

    return roundedImage($Funcionario->getImage('foto_recorte'));
}

/**
 * retorna el dropdown de opciones
 *
 * @param integer $userId
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-04-01
 */
function options_button($userId)
{
    return <<<HTML
        <div class="dropdown">
            <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="#" class="dropdown-item new_action" data-type="edit" data-id="{$userId}">
                    <i class="fa fa-edit"></i> Editar
                </a>
                <a href="#" class="dropdown-item new_action" data-type="add_role" data-id="{$userId}">
                    <i class="fa fa-users"></i> Roles
                </a>
                <a href="#" class="dropdown-item new_action" data-type="add_function" data-id="{$userId}">
                    <i class="fa fa-cogs"></i> Funciones
                </a>
            </div>
        </div>
HTML;
}

/**
 * boton para cerrar la sesion desde el reporte
 * de usuarios concurrentes
 *
 * @param string $login
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function close_session_button($login)
{
    return "<button class='btn btn-danger close_session' data-login='{$login}'>Cerrar</button>";
}
