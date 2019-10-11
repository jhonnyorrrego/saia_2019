<?php

class ExpedienteGetDataController
{
    public static function getDataAllRowList()
    {
        return Vexpedientes::getDataAllRowList();
    }

    public static function getInfoExpediente(array $request)
    {
        if (empty($id = $request['idexpediente'])) {
            throw new Exception("Error Processing Request", 1);
        }

        return (new Vexpedientes($id))->getInfoExpediente();
    }

    public static function getDataHistoryEstadoCierre(array $request)
    {
        if (empty($id = $request['idexpediente'])) {
            throw new Exception("Error Processing Request", 1);
        }

        return ExpedienteLog::getHistoryEstadoCierre($id);
    }
}
