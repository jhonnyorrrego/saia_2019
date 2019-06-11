<?php
trait TLogModel
{
    protected $fieldLabels = [];
    protected $fieldValueLabels = [];
    public $logModelRelation;
    public $clone;

    /**
     * metodo para definir el modelo con el que
     * se relacionara el modelo actual y log
     */
    public function getModelToLogRelation()
    {
        $this->logModelRelation = get_called_class() . "Log";
        return $this->logModelRelation;
    }

    /**
     * evento de base de datos
     * se ejecuta despues de creat un registro
     * @return void
     */
    public function afterCreate()
    {
        return LogController::create(LogAccion::CREAR, $this->logModelRelation, $this);
    }

    /**
     * evento de base de datos
     * se ejecuta antes de modificar un registro
     * @return void
     */
    public function beforeUpdate()
    {
        $className = get_called_class();
        $this->clone = new $className($this->getPK());
        return $this->clone->getPK();
    }

    /**
     * evento de base de datos
     * se ejecuta despues de modificar un registro
     * @return void
     */
    public function afterUpdate()
    {
        return LogController::create(LogAccion::EDITAR, $this->logModelRelation, $this);
    }

    /**
     * evento de base de datos
     * se ejecuta despues de eliminar un registro
     * @return void
     */
    public function afterDelete()
    {
        return LogController::create(LogAccion::BORRAR, $this->logModelRelation, $this);
    }

    /**
     * obtiene la etiqueta de un campo
     * en caso de no existir retorna el nombre del campo
     *
     * @param string $field
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-11
     */
    public function getFieldLabel($field)
    {
        if (!array_key_exists($field, $this->fieldLabels)) {
            return $field;
        }

        return $this->fieldLabels[$field];
    }

    /**
     * obtiene la etiqueta de un valor de campo
     *
     * @param string $field
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-11
     */
    public function getValueLabel($field, $value)
    {
        if (
            !array_key_exists($field, $this->fieldValueLabels) &&
            !array_key_exists($value, $this->fieldValueLabels[$field])
        ) {
            return $value;
        }

        return $this->fieldValueLabels[$field][$value];
    }
}
