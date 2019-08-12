<?php
abstract class LogModel extends Model implements ILogModel
{
    use TLogModel;

    function __construct($id = null)
    {
        $this->getModelToLogRelation();
        parent::__construct($id);
    }

    /**
     * valida si un attributo fue modificado
     * con respecto a su clon
     *
     * @param string $attribute
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-05
     */
    public function attributeWasChanged($attribute)
    {
        if (!in_array($attribute, $this->getSafeAttributes())) {
            throw new Exception("El attributo {$attribute} no existe", 1);
        }

        $diff = array_diff_assoc($this->getAttributes(), $this->clone->getAttributes());

        return (object) [
            'changed' => array_key_exists($attribute, $diff),
            'oldValue' => $this->clone->$attribute,
            'newValue' => $this->$attribute
        ];
    }
}
