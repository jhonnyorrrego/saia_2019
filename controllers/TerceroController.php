<?php

class TerceroController {

    public static function consultar($identificacion, $tipo = null) {
        if(empty($tipo))  {
            return Ejecutor::findByIdentificacion($identificacion);
        }
        return Ejecutor::findByIdentificacionTipo($identificacion, $tipo);
    }

    /**
     * Crea un tecero (ejecutor) a partir de los $datos recibidos
     * @param array $datos
     * @return Ejecutor
     */
    public static function crear($datos) {
        $tercero = new Ejecutor();
        $tercero->setAttributes($datos);
        $id = $tercero->save($datos);
        $datosTercero = new DatosEjecutor();
        $datosTercero->setAttributes($datos);
        $datosTercero->ejecutor_idejecutor = $id;
        $datosTercero->save();
        $tercero->setDatosEjecutor($datosTercero);
        return $tercero;
    }

    /**
     * Actualiza el tercero (ejecutor). Crea datos del tercero porque no es posible determinar cuáles son los válidos
     * @param type $datos
     * @return \Ejecutor|boolean
     */
    public static function actualizar($datos) {
        if(empty($datos["idejecutor"])) {
            return false;
        }
        $tercero = new Ejecutor($datos["idejecutor"]);
        $tercero->consultarDatos();
        $datosTercero = new DatosEjecutor();
        $datosTercero->setAttributes($datos);
        $datosTercero->ejecutor_idejecutor = $tercero->getPK();
        $tercero->save();
        $tercero->setDatosEjecutor($datosTercero);
        $datosTercero->save();
        return $tercero;
    }

}