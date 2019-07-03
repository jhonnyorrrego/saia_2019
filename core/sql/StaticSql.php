<?php

class StaticSql
{
    /**
     * instancia de sql segun el motor
     *
     * @var object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    private static $instance;

    /**
     * obtiene la instancia de sql, en caso de no
     * existir la genera
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-19
     */
    public static function getInstance($newInstance = false)
    {
        if (!StaticSql::$instance || $newInstance) {
            StaticSql::$instance = Sql::getInstance();
        }
        return StaticSql::$instance;
    }



    /**
     * ejecuta una consulta
     *
     * @param string $sql
     * @param int $start limite inferior
     * @param int $end : limite superior
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     */

    public static function search(string $sql, $start = 0, $end = 0): array
    {
        return StaticSql::getInstance()->executeSelect($sql, $start, $end);
    }

    /**
     * Realiza consulta update/delete 
     * retorna true o false
     *
     * @param string $sql : SQL update/delete
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     */
    public static function query(string $sql): bool
    {
        return StaticSql::getInstance(true)->Ejecutar_Sql($sql);
    }

    /**
     * Realiza insert en la DB y retorna el id insertado
     * NO aplica para insert masivos
     *
     * @param string $sql : Sql insert
     * @return integer 
     * Cuando es una insercion masiva retorna el primer id ingresado
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     */
    public static function insert(string $sql): int
    {
        $SqlInstance = StaticSql::getInstance(true);
        $SqlInstance->Ejecutar_Sql($sql);
        return $SqlInstance->Ultimo_Insert();
    }

    /**
     * formatea una fecha para almacenar en la DB
     * es equivalente a fecha_db_almacenar
     * @param string $date
     * @param string $format
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     */
    public static function setDateFormat(string $date, string $format): string
    {
        $instance = StaticSql::getInstance();
        return $instance::fecha_db_almacenar($date, $format);
    }

    /**
     * Obtiene una fecha de la db en el formato especificado
     * es equivalente a fecha_db_obtener
     * @param string $attribute
     * @param string $format
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     */
    public static function getDateFormat(string $attribute, string $format): string
    {
        $instance = StaticSql::getInstance();
        return $instance::fecha_db_obtener($attribute, $format);
    }

    /**
     * concatena un conjunto de datos
     *
     * @param array $data
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-12
     */
    public static function concat(array $data): string
    {
        $instance = StaticSql::getInstance();
        return $instance::concatenar_cadena($data);
    }
}
