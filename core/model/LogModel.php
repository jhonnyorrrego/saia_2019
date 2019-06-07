<?php
abstract class LogModel extends Model implements ILogModel
{
    use TLogModel;

    function __construct($id = null)
    {
        $this->setModelToLogRelation();
        parent::__construct($id);
    }
}
