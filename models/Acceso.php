<?php

class Acceso extends Model
{
    const TIPO_ANEXO = 1;
    const TIPO_ANEXOS = 2;
    const TIPO_DOCUMENTO = 3;

    const ACCION_VER = 1;
    const ACCION_EDITAR = 2;
    const ACCION_ELIMINAR = 3;
    const ACCION_VER_PUBLICO = 4;

    protected $idacceso;
    protected $tipo_relacion;
    protected $id_relacion;
    protected $fk_funcionario;
    protected $accion;
    protected $fecha;
    protected $estado;
    protected $dbAttributes;

    //relation
    protected $User;

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
            'tipo_relacion',
            'id_relacion',
            'fk_funcionario',
            'accion',
            'fecha',
            'estado'
        ];
        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    public function afterCreate()
    {
        return $this->checkNewDocumentManager();
    }

    /**
     * verfica si fue un cambio de responsable
     * sobre un documento y asigna la nueva configuracion
     * de alerta en caso de que el documento no tenga ruta
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-24
     */
    public function checkNewDocumentManager()
    {
        if (
            $this->tipo_relacion == self::TIPO_DOCUMENTO &&
            $this->accion == self::ACCION_ELIMINAR
        ) {
            DocumentoAlertaRuta::executeUpdate([
                'estado' => 0,
                'fecha_modificacion' => date('Y-m-d H:i:s')
            ], [
                'fk_documento' => $this->id_relacion,
                'estado' => 1
            ]);

            DocumentoAlertaRuta::newRecord([
                'fk_documento' => $this->id_relacion,
                'fk_funcionario' => $this->fk_funcionario
            ]);
        }

        return true;
    }


    /**
     * obtiene una instancia del funcionario relacionado
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-09
     */
    public function getUser()
    {
        if (!$this->User) {
            $this->User = $this->getRelationFk('Funcionario');
        }

        return $this->User;
    }

    /**
     * verifica si un usuario es el responsable de
     *
     * @param integer $type tipo de relacion . TIPO_DOCUMENTO
     * @param integer $typeId identificador  . iddocumento
     * @param integer $userId idusuario a validar
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-14
     */
    public static function isManager($type, $typeId, $userId)
    {
        return Acceso::countRecords([
            'tipo_relacion' => $type,
            'id_relacion' => $typeId,
            'estado' => 1,
            'accion' => Acceso::ACCION_ELIMINAR,
            'fk_funcionario' => $userId
        ]) > 0;
    }
}
