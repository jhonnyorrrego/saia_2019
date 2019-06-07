<?php

class LogController
{
    /**
     * crea el log sobre la accion ejecutada
     *
     * @param integer $event constante del modelo LogAccion
     * @param string $relation modelo en el que se 
     *      guardara la relacion con log ej: AnexoLog
     * @param object $object objeto que tendra la mutacion
     * @param integer $userId identificador del funcionario responsable
     * @return boolean
     */
    public static function create($event, $relation, $object, $userId = 0)
    {
        switch ($event) {
            case LogAccion::CREAR:
            case LogAccion::BORRAR:
            case LogAccion::VERSIONAR:
                $logId = self::simpleEvent($event, $userId);
                break;
            case LogAccion::EDITAR:
                $logId = self::updateEvent($object, $event, $userId);
                break;
        }

        if ($logId) {
            $pkRelation = $relation::newLogRelation($logId, $object->getPK());
        }

        return $pkRelation > 0;
    }

    /**
     * crea el registro en log sobre la mutacion
     *
     * @param integer $event constante del modelo LogAccion
     * @param integer $userId identificador del funcionario responsable
     *      default $_SESSION[idfuncionario]
     * @return integer nuevo idlog
     */
    public static function simpleEvent($event, $userId)
    {
        $userId = $userId ? $userId : SessionController::getValue('idfuncionario');;
        return Log::newRecord([
            'fk_funcionario' => $userId,
            'fecha' => date('Y-m-d H:i:s'),
            'fk_log_accion' => $event
        ]);
    }

    /**
     * crea los registros de log_historial
     * cuando el evento es una modificacion
     *
     * @param object $object objeto que tendra la mutacion
     * @param integer $event constante del modelo LogAccion
     * @param integer $userId identificador del funcionario responsable
     * @return integer idlog relacionado con las modificaciones
     */
    public static function updateEvent($object, $event, $userId)
    {
        $logId = self::simpleEvent($event, $userId);
        foreach ($object->getAttributes() as $attribute => $value) {
            if (
                !is_null($object->$attribute)
                && $object->$attribute != $object->clone->$attribute
            ) {
                LogHistorial::newRecord([
                    'fk_log' => $logId,
                    'campo' => $attribute,
                    'anterior' => $object->clone->$attribute,
                    'nuevo' => $object->$attribute
                ]);
            }
        }

        return $logId;
    }
}
