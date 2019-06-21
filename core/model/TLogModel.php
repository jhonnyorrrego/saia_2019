<?php
trait TLogModel
{
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
}
