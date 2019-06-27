<?php
class VfuncionarioDc extends Funcionario
{
    protected $idfuncionario;
    protected $funcionario_codigo;
    protected $login;
    protected $nombres;
    protected $apellidos;
    protected $firma;
    protected $estado;
    protected $fecha_ingreso;
    protected $clave;
    protected $nit;
    protected $perfil;
    protected $debe_firmar;
    protected $mensajeria;
    protected $email;
    protected $sistema;
    protected $tipo;
    protected $ultimo_pwd;
    protected $direccion;
    protected $telefono;
    protected $cargo;
    protected $idcargo;
    protected $tipo_cargo;
    protected $estado_cargo;
    protected $dependencia;
    protected $estado_dep;
    protected $codigo;
    protected $tipo_dep;
    protected $iddependencia;
    protected $creacion_dep;
    protected $cod_padre;
    protected $extension;
    protected $ubicacion_dependencia;
    protected $logo;
    protected $iddependencia_cargo;
    protected $estado_dc;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $creacion_dc;
    protected $tipo_dc;


    /**
     * @param int $id value for idfuncionario attribute
     * @author jhon.valencia@cerok.com
     */
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
            'idfuncionario',
            'funcionario_codigo',
            'login',
            'nombres',
            'apellidos',
            'firma',
            'estado',
            'fecha_ingreso',
            'clave',
            'nit',
            'perfil',
            'debe_firmar',
            'mensajeria',
            'email',
            'sistema',
            'tipo',
            'ultimo_pwd',
            'direccion',
            'telefono',
            'cargo',
            'idcargo',
            'tipo_cargo',
            'estado_cargo',
            'dependencia',
            'estado_dep',
            'codigo',
            'tipo_dep',
            'iddependencia',
            'creacion_dep',
            'cod_padre',
            'extension',
            'ubicacion_dependencia',
            'logo',
            'iddependencia_cargo',
            'estado_dc',
            'fecha_inicial',
            'fecha_final',
            'creacion_dc',
            'tipo_dc'
        ];

        // set the date attributes on the schema
        $dateAttributes = [
            'fecha_ingreso',
            'ultimo_pwd',
            'fecha_fin_inactivo'
        ];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes,
            'primary' => 'idfuncionario'
        ];
    }

    /**
     * @return  string the complete name formatted
     * @author jhon.valencia@cerok.com
     */
    public function getName()
    {
        $name = $this->nombres . ' ' . $this->apellidos . ' - ' . $this->cargo;
        $name = trim(strtolower(html_entity_decode($name)));
        $name = ucwords($name);
        return $name;
    }

    /**
     * realiza una busqueda donde el nombre, apellidos o cargo
     * se parezcan a una palabra
     *
     * @param string $term palabra a buscar
     * @param string $field columna identificadora para la respuesta
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-09
     */
    public static function findAllByTerm($term, $field = 'idfuncionario')
    {
        $concat = StaticSql::concat([
            "nombres",
            "' '",
            "apellidos",
            "' '",
            "cargo",
        ]);
        $sql = <<<SQL
        SELECT 
            {$field},idfuncionario,nombres,apellidos,cargo
        FROM 
            vfuncionario_dc
        WHERE
            LOWER({$concat}) LIKE '%{$term}%' AND
            estado = 1 AND
            estado_dc = 1                 
SQL;

        return  self::findBySql($sql);
    }

    /**
     * retorna una instancia filtrada por el iddependencia_cargo
     *
     * @param integer $roleId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-09
     */
    public static function findByRole($roleId)
    {
        return self::findByAttributes(['iddependencia_cargo' => $roleId]);
    }

    /**
     * obtiene una instancia de funcionario basado
     * en la entidad
     *
     * @param integer $type 5 => iddependencia_cargo, 1=>funcionario_codigo
     * @param integer $id
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-17
     */
    public static function getUserFromEntity($type, $id)
    {
        if ($type == 5) {
            $response = self::findByRole($id);
        } else if ($type == 1) {
            $response = Funcionario::findByAttributes([
                'funcionario_codigo' => $id
            ]);
        } else {
            $response = null;
        }

        return $response;
    }
}
