<?php

class StaticSql
{
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
        $sql = Sql::getInstance()->addLimit($sql, $start, $end);
        return Connection::getInstance()->fetchAll($sql);
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
        return Connection::getInstance(true)->query($sql) !== false;
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
        $Connection = Connection::getInstance(true);
        $Connection->query($sql);
        return $Connection->lastInsertId();
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
        $instance = Sql::getInstance();
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
        $instance = Sql::getInstance();
        return $instance::concatenar_cadena($data);
    }
}
