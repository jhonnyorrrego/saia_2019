<?php

class Configuracion extends Model
{
    protected $idconfiguracion;
    protected $nombre;
    protected $valor;
    protected $tipo;
    protected $fecha;
    protected $encrypt;
    protected $acceso_root;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'nombre',
            'valor',
            'tipo',
            'fecha',
            'encrypt',
            'acceso_root'
        ];
        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * retorna el valor de la configuracion
     * validando si está encriptado
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-09
     */
    public function getValue()
    {
        if ($this->encrypt) {
            $response = CriptoController::decrypt_blowfish($this->valor);
        } else {
            $response = $this->valor;
        }

        return $response;
    }

    /**
     * Recibe una lista de nombres y devuelve un arreglo de objetos
     * @param array $nombres
     * @return Configuracion[]
     */
    public static function findByNames($names)
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select('*')
            ->from('configuracion')
            ->where('nombre in (:list)')
            ->setParameter(':list', $names, \Doctrine\DBAL\Connection::PARAM_STR_ARRAY);

        return self::findByQueryBuilder($QueryBuilder);
    }
}
