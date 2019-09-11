<?php

class Connection
{
    /**
     * almacena la coneccion con la bd
     *
     * @var void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-30
     */
    public static $connection;

    /**
     * crea la coneccion con la base de datos
     *
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-30
     */
    private function __construct()
    {
        $Configuration = new \Doctrine\DBAL\Configuration();
        $connectionParams = $this->getParams();
        self::$connection = \Doctrine\DBAL\DriverManager::getConnection(
            $connectionParams,
            $Configuration
        );
    }

    /**
     * obtiene una instancia de la coneccion
     *
     * @return Doctrine\DBAL\Connection
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-30
     */
    public static function getInstance($newInstance = false)
    {
        if (!self::$connection || $newInstance) {
            new self;
        }

        return self::$connection;
    }

    /**
     * obtiene la configuracion del driverManager
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-30
     */
    private function getParams()
    {
        return [
            'dbname' => DB,
            'user' => USER,
            'password' => PASS,
            'host' => HOST,
            'driver' => $this->getDriver(),
            'port' => PORT,
            'charset' => 'utf8'
        ];
    }

    /**
     * obtiene el driver para la configuracion
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-30
     */
    private function getDriver()
    {
        $drivers = [
            "MySql" => "pdo_mysql",
            "Oracle" => "oci8",
            "SqlServer" => "pdo_sqlsrv",
            "MSSql" => "sqlsrv",
            "Postgres" => "pdo_pgsql"
        ];

        return $drivers[MOTOR];
    }
}
