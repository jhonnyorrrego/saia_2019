<?php
class DateController
{

    /**
     * change date format
     *
     * @param string $date value to change
     * @param string $dateFormat actual date format
     * @param string $newFormat new format for $date
     * @return void
     */
    public static function convertDate(
        $date,
        $dateFormat = 'Y-m-d H:i:s',
        $newFormat = 'd/m/Y H:i a'
    ) {
        $DateTime = DateTime::createFromFormat($dateFormat, $date);
        return $DateTime->format($newFormat);
    }

    /**
     * retorna la cantidad de dias habiles entre 2 fecha
     *
     * @param Object $Fecha_inicial Objeto de la clase DateTime
     * @param Object $Fecha_final Objeto de la clase DateTime
     *
     * @return int
     *
     */
    public static function dias_habiles_entre_fechas($Fecha_inicial, $Fecha_final)
    {
        

        if (!is_object($Fecha_inicial) || !is_object($Fecha_final)) {
            $dias_restantes = 0;
        } else {
            $Fecha_inicial->setTime(0, 0, 0);
            $Fecha_final->setTime(0, 0, 0);

            $diferencia = $Fecha_final->diff($Fecha_inicial);

            if ($diferencia->invert) {
                $fecha_inicial = $Fecha_inicial->format('Y-m-d');
                $fecha_final = $Fecha_final->format('Y-m-d');

                $signo = "1";
            } else {
                $fecha_inicial = $Fecha_final->format('Y-m-d');
                $fecha_final = $Fecha_inicial->format('Y-m-d');

                $signo = "-1";
            }

            $busca_festivos = busca_filtro_tabla("idasignacion", "asignacion", "documento_iddocumento='-1'  AND fecha_inicial < " . fecha_db_almacenar($fecha_final, 'Y-m-d') . " AND fecha_final > " . fecha_db_almacenar($fecha_inicial, 'Y-m-d'), "");
            $numero_festivos = $busca_festivos['numcampos'];

            $dias_restantes = ($diferencia->days - $numero_festivos) * $signo;
        }

        return $dias_restantes;
    }
}
