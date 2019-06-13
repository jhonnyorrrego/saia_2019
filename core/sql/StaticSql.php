<?php

class StaticSql
{
    private static $instance;
    /**
     * Realiza una consulta a la DB
     * retorna un array con los datos
     *
     * @param string $sql :  SQL select
     * @param int $start : utilizar si necesita limit
     * @param int $end : utilizar si necesita limit
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public static function search(string $sql, $start = 0, $end = 0): array
    {
        if (!StaticSql::$instance) {
            StaticSql::$instance = Conexion::getConnection();
        }
        return (StaticSql::$instance)->executeSelect($sql, $start, $end);
    }

    /**
     * Realiza consulta update/delete 
     * retorna true o false
     *
     * @param string $sql : SQL update/delete
     * @return boolean
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function query(string $sql): bool
    {
        return Conexion::getConnection()->Ejecutar_Sql($sql);
    }
    /**
     * Realiza insert en la DB y retorna el id insertado
     * NO aplica para insert masivos
     *
     * @param string $sql : Sql insert
     * @return integer 
     * Cuando es una insercion masiva retorna el primer id ingresado
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function insert(string $sql): int
    {
        $conection = Conexion::getConnection();
        $conection->Ejecutar_Sql($sql);
        return $conection->Ultimo_Insert();
    }

    /**
     * formatea una fecha para almacenar en la DB
     * es equivalente a fecha_db_almacenar
     * @param string $date
     * @param string $format
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function setDateFormat(string $date, string $format): string
    {
        if (!StaticSql::$instance) {
            StaticSql::$instance = Conexion::getConnection();
        }
        return (StaticSql::$instance)::fecha_db_almacenar($date, $format);
    }
    /**
     * Obtiene una fecha de la db en el formato especificado
     * es equivalente a fecha_db_obtener
     * @param string $attribute
     * @param string $format
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function getDateFormat(string $attribute, string $format): string
    {
        if (!StaticSql::$instance) {
            StaticSql::$instance = Conexion::getConnection();
        }

        return (StaticSql::$instance)::fecha_db_obtener($attribute, $format);
    }
}
