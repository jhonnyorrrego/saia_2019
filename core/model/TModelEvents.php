<?php

trait TModelEvents
{
    /**
     * evento de base de datos
     * se ejecuta antes de crear un nuevo registro
     * @return void
     */
    protected function beforeCreate()
    {
        return true;
    }

    /**
     * evento de base de datos
     * se ejecuta despues de crear un nuevo registro
     * @return void
     */
    protected function afterCreate()
    {
        return true;
    }

    /**
     * evento de base de datos
     * se ejecuta antes de modificar un registro
     * @return void
     */
    protected function beforeUpdate()
    {
        return true;
    }

    /**
     * evento de base de datos
     * se ejecuta despues de modificar un registro
     * @return void
     */
    protected function afterUpdate()
    {
        return true;
    }

    /**
     * evento de base de datos
     * se ejecuta antes de eliminar un registro
     * @return void
     */
    protected function beforeDelete()
    {
        return true;
    }

    /**
     * evento de base de datos
     * se ejecuta despues de eliminar un registro
     * @return void
     */
    protected function afterDelete()
    {
        return true;
    }
}
