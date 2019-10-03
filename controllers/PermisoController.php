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
     * Verificar si el usuario actual tiene permiso
     * sobre un modulo
     *
     * @param string $module
     * @param integer $accion
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-14
     */
    function permiso_usuario($module, $accion)
    {
        if ($this->acceso_root() && $accion == 1) {
            return true;
        }

        if (!empty($tabla) && !is_null($accion) && $this->login) {
            $total = Model::getQueryBuilder()
                ->select('count(*) as total')
                ->from('funcionario', 'a')
                ->join('a', 'permiso', 'b', 'a.idfuncionario = b.funcionario_idfuncionario')
                ->join('b', 'modulo', 'c', 'c.idmodulo = b.modulo_idmodulo')
                ->where('a.login = :login')
                ->andWhere('a.estado = 1')
                ->andWhere('b.accion = :action')
                ->andWhere('c.nombre = :module')
                ->setParameter(':login', $this->login)
                ->setParameter(':action', $accion)
                ->setParameter(':module', $module)
                ->execute()->fetch();

            return $total['total'] > 0;
        } else if (!empty($module)) {
            return $this->acceso_modulo_perfil($module);
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
        $total = Model::getQueryBuilder()
            ->select('count(*) as total')
            ->from('permiso', 'a')
            ->join('a', 'modulo', 'b', 'a.modulo_idmodulo = b.idmodulo')
            ->where('a.funcionario_idfuncionario = :userId')
            ->andWhere('b.nombre = :module')
            ->setParameter(':userId', $this->idfuncionario, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':module', $nombre)
            ->execute()->fetch();

        return $total['total'] > 0;
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

        $profiles = explode(',', $this->perfil);
        $total = Model::getQueryBuilder()
            ->select('count(*) as total')
            ->from('modulo', 'a')
            ->join('a', 'permiso_perfil', 'b', 'b.modulo_idmodulo = a.idmodulo')
            ->where('b.perfil_idperfil in (:profileList)')
            ->andWhere('a.nombre = :module')
            ->setParameter(':profileList', $profiles, \Doctrine\DBAL\Connection::PARAM_STR_ARRAY)
            ->setParameter(':module', $nombre)
            ->execute()->fetch();

        return $total['total'] ?
            !$this->permiso_usuario($nombre, '0') : $this->acceso_modulo($nombre);
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
