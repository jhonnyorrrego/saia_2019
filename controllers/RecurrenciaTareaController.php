<?php

class RecurrenciaTareaController
{
    protected $Tarea;
    protected $TareaFuncionario;
    protected $configuration;

    function __construct(Tarea $Tarea, object $configuration)
    {
        $this->Tarea = $Tarea;
        $this->configuration = $configuration;
    }

    /**
     * calcula los periodos en base a la configuracion
     * para generar las nuevas tareas
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-23
     */
    public function generate()
    {
        if (!$this->configuration->unity && !$this->configuration->period) {
            throw new Exception("consultar y eliminar tareas del mismo grupo", 1);

            $this->Tarea->fk_recurrencia_tarea = 0;
            $this->Tarea->save();

            return true;
        }

        if ($this->configuration->unity < 0) {
            throw new Exception("La cantidad de repeticiones debe ser positiva", 1);
        }

        $date = $this->Tarea->fecha_final;
        $InitialDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);

        switch ($this->configuration->period) {
            case RecurrenciaTarea::PERIODO_DIA:
                $sufix = 'D';
                break;
            case RecurrenciaTarea::PERIODO_SEMANA:
                $InitialDateTime = $this->getWeekInitialDate($InitialDateTime);
                $sufix = 'W';
                break;
            case RecurrenciaTarea::PERIODO_MES:
                $dayPosition = !(int) $this->configuration->option;
                if ($dayPosition) {
                    $InitialDateTime = $InitialDateTime->setDate(
                        $InitialDateTime->format('Y'),
                        $InitialDateTime->format('m'),
                        1
                    );
                }
                $sufix = 'M';
                break;
            case RecurrenciaTarea::PERIODO_ANHO:
                $sufix = 'Y';
                break;
            default:
                throw new Exception("periodo indefinido", 1);
                break;
        }


        if ($this->configuration->endType == RecurrenciaTarea::TERMINAR_FECHA) {
            $FinalDateTime = new DateTime($this->configuration->endValue);
            $FinalDateTime->setTime(23, 59, 59);
            $finalItem = $FinalDateTime;
        } else if ($this->configuration->endType == RecurrenciaTarea::TERMINAR_ITERACIONES) {
            $finalItem = $this->configuration->endValue;
        } else {
            throw new Exception("Error Processing Request", 1);
        }

        $DateInterval = new DateInterval("P{$this->configuration->unity}{$sufix}");
        $daterange = new DatePeriod(
            $InitialDateTime,
            $DateInterval,
            $finalItem,
            DatePeriod::EXCLUDE_START_DATE
        );
        foreach ($daterange as $DateTime) {
            if (!empty($dayPosition)) {
                $DateTime = $this->findMonthDay($DateTime);
            }

            $this->createNewTask($DateTime);
        };
    }

    /**
     * clona la tarea inicial
     *
     * @param object $DateTime
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-23
     */
    public function createNewTask($DateTime)
    {
        $Interval = new DateInterval('PT30M');
        $Tarea = $this->Tarea->clone();
        $Tarea->fecha_final = $DateTime->format('Y-m-d H:i:s');
        $Tarea->fecha_inicial = $DateTime->sub($Interval)->format('Y-m-d H:i:s');

        if (!$Tarea->save()) {
            throw new Exception("Error al guardar la tarea", 1);
        }

        $this->setTaskUsers($Tarea->getPK());
    }

    /**
     * vincula los funcionarios a la nueva tarea
     *
     * @param integer $taskId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-23
     */
    public function setTaskUsers($taskId)
    {
        $users = $this->getUsers();

        foreach ($users as $TareaFuncionario) {
            if ($TareaFuncionario->tipo == TareaFuncionario::TIPO_CREADOR) {
                continue;
            }

            $TareaFuncionario = $TareaFuncionario->clone();
            $TareaFuncionario->fk_tarea = $taskId;

            if (!$TareaFuncionario->save()) {
                throw new Exception("Error al asignar los funcionarios", 1);
            }
        }

        TareaFuncionario::assignUser(
            $taskId,
            [SessionController::getValue('idfuncionario')],
            TareaFuncionario::TIPO_CREADOR
        );
    }

    /**
     * obtiene los funcionarios vinculados a la tarea
     *
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-24
     */
    public function getUsers()
    {
        if (!$this->TareaFuncionario) {
            $this->TareaFuncionario = TareaFuncionario::findAllByAttributes([
                'estado' => 1,
                'fk_tarea' => $this->Tarea->getPK()
            ]);
        }

        return $this->TareaFuncionario;
    }

    /**
     * calcula la nueva fecha inicial basado
     * en el dia de la semana indicado
     *
     * @param object $DateTime
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-24
     */
    public function getWeekInitialDate($DateTime)
    {
        $initialDay = $DateTime->format('N');
        $finalDay = $this->configuration->option;

        if ($initialDay > $finalDay) {
            $adition = ((7 * $this->configuration->unity) - $initialDay) + $finalDay;
        } else {
            $adition = $finalDay - $initialDay;
        }

        $DateInterval = new DateInterval("P{$adition}D");
        $DateTime->add($DateInterval);
        $this->updateTask($DateTime);

        return $DateTime;
    }

    /**
     * busca la fecha de un x dia de la semana
     * ej: el cuarto jueves del mes
     *
     * @param object $DateTime
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-25
     */
    public function findMonthDay($DateTime)
    {
        $Reference = clone $DateTime;
        $data = json_decode($this->configuration->option);
        $days = ["", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        $name = $days[$data->day];
        $DateTime->modify("{$data->position} {$name} of this month");
        $DateTime->setTime(
            $Reference->format('H'),
            $Reference->format('i'),
            $Reference->format('s'),
        );
        return $DateTime;
    }

    /**
     * actualiza las fechas de la tarea
     *
     * @param object $DateTime
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-24
     */
    public function updateTask($DateTime)
    {
        $Interval = new DateInterval('PT30M');
        $this->Tarea->fecha_final = $DateTime->format('Y-m-d H:i:s');
        $this->Tarea->fecha_inicial = $DateTime->sub($Interval)->format('Y-m-d H:i:s');

        if (!$this->Tarea->save()) {
            throw new Exception("Error al mover la tarea", 1);
        }
    }
}
