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
    protected $dbAttributes;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
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
            $yesterday = $DateTime->format('Y-m-d H:i:s');
            $initial = StaticSql::getDateFormat('fecha', 'Y-m-d H:i:s');

            self::closeOldSessions($initial, $yesterday);

            $sql = <<<SQL
            SELECT count(distinct funcionario_idfuncionario) as total
            FROM log_acceso
            WHERE
                fecha_cierre IS NULL AND
                {$initial} >= '{$yesterday}' AND
                exito = 1
SQL;
            $row = self::search($sql);
            $total = $row[0]['total'];

            $Configuracion = Configuracion::findByAttributes(['nombre' => 'usuarios_concurrentes']);

            return $Configuracion->getValue() > $total;
        } else {
            return true;
        }
    }

    /**
     * cierra las sesiones mas antiguas al dia de hoy
     *
     * @param string $initial fecha_db_obtener
     * @param string $yesterday fecha del dia de ayer Y-m-d H:i:s
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-10
     */
    public static function closeOldSessions($initial, $yesterday)
    {
        $closeDate = self::setDateFormat(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
        $sql = <<<SQL
            UPDATE log_acceso
            SET fecha_cierre = {$closeDate}
            WHERE
                {$initial} < '{$yesterday}'
SQL;
        self::query($sql);
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
