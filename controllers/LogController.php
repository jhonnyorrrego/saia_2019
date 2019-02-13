<?php

class LogController
{
    public static function create($event, $relation, $object, $userId = 0)
    {
        switch ($event) {
            case LogAccion::CREAR:
            case LogAccion::BORRAR:
                $logId = self::insertEvent($event, $userId);
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

    public static function insertEvent($event, $userId)
    {
        $userId = $userId ? $userId : $_SESSION['idfuncionario'];
        return Log::newRecord([
            'fk_funcionario' => $userId,
            'fecha' => date('Y-m-d H:i:s'),
            'fk_log_accion' => $event
        ]);
    }

    public static function updateEvent($object, $event, $userId)
    {
        $logId = self::insertEvent($event, $userId);
        foreach ($object->getAttributes() as $attribute => $value) {
            if ($object->$attribute != $object->clone->$attribute) {
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