<?php

use \Doctrine\DBAL\Types\Type;

class ExpedienteLog extends LogConnection
{
    protected $idexpediente_log;
    protected $fk_log;
    protected $fk_expediente;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    public static function getDataHistoryField(int $idexp, string $field, int $idaccion)
    {
        return self::getQueryBuilder()
            ->select('nom_funcionario_log,fecha_log,anterior,nuevo,descripcion')
            ->from('vexpedientes_log')
            ->where('fk_log_accion=:fk_log_accion')
            ->andWhere('campo=:campo')
            ->andWhere('fk_expediente=:fk_expediente')
            ->setParameters(
                [
                    ':fk_log_accion' => $idaccion,
                    ':campo' => $field,
                    ':fk_expediente' => $idexp
                ],
                [
                    ':fk_log_accion' => Type::INTEGER,
                    ':campo' => Type::STRING,
                    ':fk_expediente' => Type::INTEGER
                ]
            )
            ->orderBy('fecha_log', 'DESC')
            ->execute()->fetchAll();
    }

    public static function getHistoryEstadoCierre(int $idexp): array
    {
        $field = 'estado_cierre';
        $data = [];
        if ($QueryBuilder = self::getDataHistoryField($idexp, $field, LogAccion::EDITAR)) {

            $data = $QueryBuilder;

            $Expediente = new Expediente();
            foreach ($data as $key => $value) {
                $data[$key]['anterior'] = $Expediente->getValueLabel($field, $value['anterior']);
                $data[$key]['nuevo'] = $Expediente->getValueLabel($field, $value['nuevo']);
                $data[$key]['fecha_log'] = DateController::convertDate($value['fecha_log']);
            }
        }
        return $data;
    }
}
