<?php

interface ILogModel
{
    /**
     * evento de base de datos
     * se ejecuta despues de creat un registro
     * @return void
     */
    public function afterCreate();

    /**
     * evento de base de datos
     * se ejecuta antes de modificar un registro
     * @return void
     */
    public function beforeUpdate();

    /**
     * evento de base de datos
     * se ejecuta despues de modificar un registro
     * @return void
     */
    public function afterUpdate();

    /**
     * evento de base de datos
     * se ejecuta despues de eliminar un registro
     * @return void
     */
    public function afterDelete();

    /**
     * metodo para definir el modelo con el que
     * se relacionara el modelo actual y log ej. AnexoLog
     */
    public function setModelToLogRelation();
}
