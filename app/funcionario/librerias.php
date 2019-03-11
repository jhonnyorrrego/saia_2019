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

include_once $ruta_db_superior . "controllers/autoload.php";

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
    $Funcionario->nombres = $name;
    $Funcionario->apellidos = $lastName;

	return "<a class='kenlace_saia cursor text-complete' enlace='views/funcionario/dashboard.php?key={$userId}' conector='iframe' titulo='{$Funcionario->getName()}'>{$Funcionario->getName()}</a>";
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
    $Configuracion = Configuracion::findByAttributes([
        'tipo' => 'usuario',
        'nombre' => 'login_administrador'
    ]);

    if ($Configuracion && $Configuracion->valor == $_SESSION["LOGIN" . LLAVE_SAIA]) {
        $condition = '1=1';
    } else {
        $condition = "login <> '{$Configuracion->valor}'";
    }

    return $condition;
}
 