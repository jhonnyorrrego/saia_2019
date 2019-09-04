<?php
class SqlMysql extends Sql
{
    /**
     * asigna el limite a un sql
     *
     * @param string $sql
     * @param integer $offset
     * @param integer $limit
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function addLimit($sql, $offset, $limit)
    {
        if ($limit) {
            $sql .= " LIMIT $offset,$limit";
        }

        return $sql;
    }

    static function fecha_db_almacenar($fecha, $formato = null)
    {
        if (is_object($fecha)) {
            $fecha = $fecha->format($formato);
        }

        if (!$fecha || $fecha == "") {
            $fecha = date($formato);
        }
        if (!$formato)
            $formato = "Y-m-d"; // formato por defecto php

        $mystring = $fecha;
        $findme = 'DATE_FORMAT';
        $pos = strpos($mystring, $findme);
        if ($pos === false) {
            $reemplazos = array(
                'd' => '%d',
                'm' => '%m',
                'y' => '%y',
                'Y' => '%Y',
                'h' => '%H',
                'H' => '%H',
                'i' => '%i',
                's' => '%s',
                'M' => '%b',
                'yyyy' => '%Y'
            );
            $resfecha = $formato;
            foreach ($reemplazos as $ph => $mot) {
                $resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
            }

            $fsql = "DATE_FORMAT('$fecha','$resfecha')";
        } else {
            $fsql = $fecha;
        }
        return $fsql;
    }

    static function fecha_db_obtener($campo, $formato = null)
    {
        if (!$formato)
            $formato = "Y-m-d";

        $reemplazos = array(
            'd' => '%d',
            'm' => '%m',
            'y' => '%y',
            'Y' => '%Y',
            'h' => '%h',
            'H' => '%H',
            'i' => '%i',
            's' => '%s',
            'M' => '%b',
            'yyyy' => '%Y'
        );
        $resfecha = $formato;
        foreach ($reemplazos as $ph => $mot) {
            $resfecha = preg_replace('/' . $ph . '/', "$mot", $resfecha);
        }
        $fsql = "DATE_FORMAT($campo,'$resfecha')";
        return $fsql;
    }


    public function concatenar_cadena($arreglo_cadena)
    {
        $cadena_final = '';
        $i = 0;
        if (@$arreglo_cadena[($i + 1)] == "") {
            return ($arreglo_cadena[0]);
        }
        $cant = count($arreglo_cadena);
        for ($i = 0; $i < $cant; $i++) {
            if ($i > 0) {
                $cadena_final .= ",";
            }
            $cadena_final .= "CONCAT(" . $arreglo_cadena[$i];
            if (@$arreglo_cadena[($i + 2)] == "") {
                $cadena_final .= "," . $arreglo_cadena[($i + 1)];
                $i++;
            }
        }
        for (; $i > 1; $i--) {
            $cadena_final .= ')';
        }
        return ($cadena_final);
    }
}
