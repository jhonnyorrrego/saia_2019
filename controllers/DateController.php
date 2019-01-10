<?php
class DateController {

    /**
     * change date format
     *
     * @param string $date value to change
     * @param string $dateFormat actual date format
     * @param string $newFormat new format for $date
     * @return void
     */
    public static function convertDate($date, $dateFormat, $newFormat){
        $DateTime = DateTime::createFromFormat($dateFormat, $date);
        return $DateTime->format($newFormat);
    }
}
