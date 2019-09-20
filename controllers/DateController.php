<?php
class DateController
{
    /**
     * formato por defecto para mostrar una fecha
     */
    const DEFAULT_FORMAT = 'd/m/Y H:i a';

    /**
     * almacena el formato de fecha de los tipos
     * datetime basado en el motor de db
     */
    public static $defaultDateTimeFormat;

    /**
     * obtiene el formato por defecto de los
     * tipos datetime segun el motor
     *
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @return string
     */
    public static function getDefaultDateTimeFormat()
    {
        if (!self::$defaultDateTimeFormat) {
            self::$defaultDateTimeFormat = Connection::getInstance()
                ->getDatabasePlatform()->getDateTimeFormatString();
        }

        return self::$defaultDateTimeFormat;
    }

    /**
     * change date format
     *
     * @param string $date value to change
     * @param string $newFormat new format for $date
     * @param string $dateFormat actual date format
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @return void
     */
    public static function convertDate(
        $date,
        $newFormat = null,
        $dateFormat = null
    ) {
        $newFormat = $newFormat ?? self::DEFAULT_FORMAT;

        if (is_string($date)) {
            $dateFormat = $dateFormat ?? self::getDefaultDateTimeFormat();
            $DateTime = DateTime::createFromFormat($dateFormat, $date);
        } else if ($date instanceof DateTime) {
            $DateTime = $date;
        }

        return $DateTime ? $DateTime->format($newFormat) : null;
    }

    /**
     * retorna la cantidad de dias habiles entre 2 fecha
     *
     * @param Object $InitialDate Objeto de la clase DateTime
     * @param Object $FinalDate Objeto de la clase DateTime
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @return int
     *
     */
    public static function dias_habiles_entre_fechas(DateTime $InitialDate, DateTime $FinalDate)
    {
        $InitialDate->setTime(0, 0, 0);
        $FinalDate->setTime(0, 0, 0);

        $diff = $FinalDate->diff($InitialDate);

        if ($diff->invert) {
            $sign = "1";
        } else {
            $temporal = $InitialDate;
            $InitialDate = $FinalDate;
            $FinalDate = $temporal;
            $sign = "-1";
        }

        $query = Model::getQueryBuilder()
            ->select("count(*) as total")
            ->from("asignacion")
            ->where("documento_iddocumento='-1'")
            ->andWhere("fecha_inicial < :initialDate")
            ->andWhere("fecha_final > :finalDate")
            ->setParameter('initialDate', $InitialDate, \Doctrine\DBAL\Types\Type::DATETIME)
            ->setParameter('finalDate', $FinalDate, \Doctrine\DBAL\Types\Type::DATETIME)
            ->execute()->fetch();

        return ($diff->days - $query['total']) * $sign;
    }
}
