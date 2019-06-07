<?php
trait TLogConnection
{
    private static function getParentRelationName()
    {
        $name = strtolower(get_called_class());
        $name = str_replace('log', '', $name);
        return 'fk_' . $name;
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_log',
                self::getParentRelationName()
            ],
            'date' => []
        ];
    }

    public static function newLogRelation($logId, $relationId)
    {
        return self::newRecord([
            self::getParentRelationName() => $relationId,
            'fk_log' => $logId
        ]);
    }
}
