<?php

trait TEvent {

    function beforeCreate() {
        return true;
    }

    function afterCreate() {
        return true;
    }

    function beforeUpdate() {
        return true;
    }

    function afterUpdate() {
        return true;
    }

    function beforeDelete() {
        return true;
    }

    function afterDelete() {
        return true;
    }
}