<?php
use Stringy\Stringy;

trait TLogConnection
{
    private static function getParentRelationName()
    {
        $Stringy = new Stringy(get_called_class());
        $name = (string)$Stringy->underscored();
        $name = str_replace('_log', '', $name);
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
