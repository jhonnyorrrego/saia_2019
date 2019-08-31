<?php
class LogAcceso extends Model
{
    protected $idlog_acceso;
    protected $login;
    protected $iplocal;
    protected $ipremota;
    protected $exito;
    protected $fecha;
    protected $fecha_cierre;
    protected $funcionario_idfuncionario;
    protected $idsesion_php;
    protected $token;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'login',
                'iplocal',
                'ipremota',
                'exito',
                'fecha',
                'fecha_cierre',
                'funcionario_idfuncionario',
                'idsesion_php',
                'token'
            ],
            'date' => ['fecha', 'fecha_cierre']
        ];
    }

    public static function canAccess()
    {
        $Configuracion = Configuracion::findByAttributes(['nombre' => 'habilita_usuarios_concurrentes']);

        if ($Configuracion->getValue()) {
            $DateTime = new DateTime();
            $DateTime->sub(new DateInterval('P1D'));

            self::closeOldSessions($DateTime);

            $data = self::getQueryBuilder()
                ->select('count(funcionario_idfuncionario) as total')
                ->from(self::getTableName())
                ->where('fecha_cierre is null')
                ->andWhere('fecha >= :yesterday')
                ->andWhere('exito = 1')
                ->groupBy('funcionario_idfuncionario')
                ->setParameter(':yesterday', $DateTime, 'datetime')
                ->execute()->fetch();

            $total = $data['total'];
            $Configuracion = Configuracion::findByAttributes(['nombre' => 'usuarios_concurrentes']);

            return $Configuracion->getValue() > $total;
        } else {
            return true;
        }
    }

    /**
     * cierra las sesiones mas antiguas al dia de hoy
     *
     * @param object $yesterday DateTime
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-31
     */
    public static function closeOldSessions($yesterday)
    {
        self::getQueryBuilder()
            ->update(self::getTableName())
            ->set('fecha_cierre', ':fecha_cierre')
            ->where('fecha < :yesterday')
            ->andWhere('fecha_cierre is null')
            ->setParameter(':fecha_cierre', new DateTime(), 'datetime')
            ->setParameter(':yesterday', $yesterday, 'datetime')
            ->execute();
    }

    /**
     * verifica si la sesion está activa 
     * en logacceso con el token
     *
     * @param string $token
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-10
     */
    public static function checkActiveToken($token)
    {
        $sql = <<<SQL
        SELECT count(*) access
        FROM log_acceso
        WHERE
            fecha_cierre IS NULL AND
            token = '{$token}'
SQL;
        $row = StaticSql::search($sql);
        return $row[0]['access'] > 0;
    }
}
