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
     * verifica si el usuario tiene permiso
     * sobre un modulo
     *
     * @param string $nombre
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-14
     */
    function userModuleAccess($nombre)
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
    function profileModuleAccess($nombre)
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

        return !$total['total'] ? $this->userModuleAccess($nombre) : true;
    }

    /**
     * Retorna si tiene o no permiso sobre el modulo
     * 
     * @param string $module nombre del modulo
     * @return boolean
     * */
    public static function moduleAccess(string $module)
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return (self::$instance)->profileModuleAccess($module);
    }
}
