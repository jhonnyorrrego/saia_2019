<?php

class PermisoController
{
    public static $instance;
    public $login;
    public $idfuncionario;
    public $perfil;

    /**
     * setea las propiedades con los valores 
     * del usuario logueado
     *
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-14
     */
    function __construct()
    {
        $this->login = SessionController::getLogin();

        if (!$this->login) {
            SessionController::logout("Login invalido");
        }

        $Funcionario = Funcionario::findByAttributes([
            'login' => $this->login
        ]);

        if (!$Funcionario) {
            throw new Exception("Usuario invalido", 1);
        }

        $this->idfuncionario = $Funcionario->getPK();
        $this->perfil = $Funcionario->perfil;

        return true;
    }

    /**
     * verifica si un usuario tiene acceso root
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-06
     */
    function acceso_root()
    {
        return SessionController::isRoot();
    }

    /**
     * Verificar si el usuario actual tiene permiso para realizar accion sobre tabla
     *
     * @param string $tabla
     * @param integer $accion
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-14
     */
    function permiso_usuario($tabla, $accion)
    {
        if ($this->acceso_root() && $accion == 1) {
            return true;
        }

        if (!empty($tabla) && $accion && $this->login) {
            $sql = <<<SQL
                SELECT count(*) as total
                FROM funcionario,permiso,modulo
                WHERE 
                    funcionario.idfuncionario = permiso.funcionario_idfuncionario AND
                    modulo.idmodulo = permiso.modulo_idmodulo AND
                    funcionario.login='{$this->login}' AND
                    funcionario.estado = 1 AND
                    accion='{$accion}' AND
                    modulo.nombre='{$tabla}'
SQL;
            $query = StaticSql::search($sql);
            return $query[0]['total'] > 0;
        } else if (!empty($tabla)) {
            return $this->acceso_modulo_perfil($tabla);
        }

        return false;
    }

    /**
     * verifica si el usuario tiene permiso
     * sobre un modulo
     *
     * @param string $nombre
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-14
     */
    function acceso_modulo($nombre)
    {
        $sql = <<<SQL
            SELECT count(*) as total
            FROM 
                permiso a
                JOIN modulo b
                    ON a.modulo_idmodulo = b.idmodulo
            WHERE
                a.funcionario_idfuncionario = {$this->idfuncionario} AND
                b.nombre='{$nombre}'
SQL;
        $query = StaticSql::search($sql);

        return $query[0]['total'] > 0;
    }

    /**
     * verifica si el usuario logueado tiene
     * permisos sobre un modulo por perfil
     * 
     * true si es root
     *
     * @param string $nombre nombre del modulo
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-14
     */
    function acceso_modulo_perfil($nombre)
    {
        if ($this->acceso_root()) {
            return true;
        }

        $sql = <<<SQL
            SELECT count(*) AS total
            FROM
                modulo a
                JOIN permiso_perfil b
                    ON b.modulo_idmodulo = a.idmodulo
            WHERE
                b.perfil_idperfil in({$this->perfil}) AND
                a.nombre='{$nombre}'
SQL;
        $query = StaticSql::search($sql);

        return $query[0]['total'] ?
            $this->permiso_usuario($nombre, '0') : $this->acceso_modulo($nombre);
    }

    /**
     * Retorna si tiene o no permiso sobre el modulo
     * 
     * @param string $nombreModulo nombre del modulo
     * @return boolean
     * */
    public static function moduleAccess(string $nombreModulo)
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return (self::$instance)->acceso_modulo_perfil($nombreModulo);
    }
}
