<?php
abstract class LogModel extends Model implements ILogModel
{
    use TLogModel;

    function __construct($id = null)
    {
        $this->getModelToLogRelation();
        parent::__construct($id);
    }
}
