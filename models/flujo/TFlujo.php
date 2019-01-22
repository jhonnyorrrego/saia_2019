<?php

trait TFlujo {

    public function clone() {
        $data = $this->getAttributes();
        $class = get_called_class();
        $obj = new $class();
        $obj->setAttributes($data);
        return $obj;
    }
}