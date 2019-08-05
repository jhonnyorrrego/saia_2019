<?php

/**
 * gestiona la recurrencia de una tarea
 *
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
class RecurrenciaTareaController
{
    protected $Tarea;
    protected $configuration;
    protected $notifications;
    protected $createdTask;

    /**
     * inicia el proceso para calcular la recurrencia
     *
     * @param Tarea $Tarea
     * @param object $configuration nueva recurrencia 
     * @param array $notifications notificaciones a vincular
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    function __construct(Tarea $Tarea, object $configuration, array $notifications)
    {
        $this->Tarea = $Tarea;
        $this->configuration = $configuration;
        $this->notifications = $notifications;
        $this->createNewTask = [];

        $this->generate();
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
        if (!$this->configuration->recurrence) {
            return true;
        }

        if ($this->configuration->unity < 0) {
            throw new Exception("La cantidad de repeticiones debe ser positiva", 1);
        }

        if ($this->isDifferentRecurrence()) {
            $this->deleteRecurrence();
            $this->generateGroup();
            $DatePeriodParams = $this->generatePeriodParams();
            $DateInterval = new DateInterval("P{$this->configuration->unity}{$DatePeriodParams->sufix}");
            $daterange = new DatePeriod(
                $DatePeriodParams->initialDateTime,
                $DateInterval,
                $DatePeriodParams->finalItem,
                DatePeriod::EXCLUDE_START_DATE
            );

            foreach ($daterange as $DateTime) {
                if (!empty($dayPosition)) {
                    $DateTime = $this->findMonthDay($DateTime);
                }

                $this->createNewTask($DateTime);
            }

            $this->bindTaskUsers();
            $this->bindTaskDocument();
        } else {
            $this->inactiveNotifications();
        }

        $this->createNotifications();
    }

    /**
     * verifica si la recurrencia a guardar es nueva
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-05
     */
    public function isDifferentRecurrence()
    {
        $RecurrenciaTarea = $this->Tarea->getRecurrence();
        return
            !$RecurrenciaTarea ||
            $RecurrenciaTarea->recurrencia != $this->configuration->recurrence ||
            $RecurrenciaTarea->periodo != $this->configuration->period ||
            $RecurrenciaTarea->unidad_tiempo != $this->configuration->unity ||
            $RecurrenciaTarea->opcion_unidad != $this->configuration->option ||
            $RecurrenciaTarea->terminar != $this->configuration->endValue;
    }

    /**
     * genera los parametros para el DatePeriod
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-05
     */
    public function generatePeriodParams()
    {
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

        return (object) [
            'initialDateTime' => $InitialDateTime,
            'sufix' => $sufix,
            'finalItem' => $finalItem
        ];
    }

    /**
     * crea el nuevo grupo para las tareas
     * de la recurrencia
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-25
     */
    public function generateGroup()
    {
        $pk = RecurrenciaTarea::newRecord([
            'recurrencia' => $this->configuration->recurrence,
            'periodo' => $this->configuration->period,
            'unidad_tiempo' => $this->configuration->unity,
            'opcion_unidad' => $this->configuration->option,
            'terminar' => $this->configuration->endValue
        ]);

        $this->Tarea->fk_recurrencia_tarea = $pk;
        return $this->Tarea->save();
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

        $this->createdTask[] = $Tarea->getPK();
    }

    /**
     * crea las notificaciones de cada tarea
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-05
     */
    public function createNotifications()
    {
        if (!$this->notifications) {
            return true;
        }

        $tasks = $this->createdTask;
        if (!in_array($this->Tarea->getPK(), $tasks)) {
            $tasks[] = $this->Tarea->getPK();
        }

        foreach ($tasks as $taskId) {
            foreach ($this->notifications as $notification) {
                TareaNotificacion::newRecord([
                    'tipo' => $notification['type'],
                    'duracion' => $notification['duration'],
                    'periodo' => $notification['period'],
                    'fk_tarea' => $taskId
                ]);
            }
        }
    }

    /**
     * inactiva las notificaciones de las tareas
     * pertenecientes a la recurrencia
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-05
     */
    public function inactiveNotifications()
    {
        $tasks = Tarea::findColumn(Tarea::getPrimaryLabel(), [
            'fk_recurrencia_tarea' => $this->Tarea->fk_recurrencia_tarea,
            'estado' => 1
        ]);

        foreach ($tasks as $taskId) {
            TareaNotificacion::executeUpdate([
                'estado' => 0
            ], [
                'fk_tarea' => $taskId
            ]);
        }

        $this->createdTask = $tasks;
    }

    /**
     * vincula los funcionarios a la nueva tarea
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-23
     */
    public function bindTaskUsers()
    {
        $users = TareaFuncionario::findAllByAttributes([
            'estado' => 1,
            'fk_tarea' => $this->Tarea->getPK()
        ]);
        foreach ($this->createdTask as $taskId) {
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
    }

    /**
     * vincula el documento de la tarea principal
     * a las nuevas tareas de la recurrencia
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-29
     */
    public function bindTaskDocument()
    {
        $DocumentoTarea = $this->Tarea->getDocument();
        if ($DocumentoTarea) {
            foreach ($this->createdTask as $taskId) {
                DocumentoTarea::newRecord([
                    'fk_tarea' => $taskId,
                    'fk_documento' => $DocumentoTarea->fk_documento
                ]);
            }
        }
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
            $Reference->format('s')
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

    /**
     * elimina las tareas de una recurrencia
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-29
     */
    public function deleteRecurrence()
    {
        if (!$this->Tarea->fk_recurrencia_tarea) {
            return true;
        }

        $tasks = Tarea::findAllByAttributes([
            'fk_recurrencia_tarea' => $this->Tarea->fk_recurrencia_tarea
        ]);

        $referenceDateTime = new DateTime($this->Tarea->fecha_final);
        foreach ($tasks as $Tarea) {
            $taskDateTime = new DateTime($Tarea->fecha_final);
            if ($referenceDateTime < $taskDateTime) {
                $Tarea->setAttributes([
                    'estado' => 0,
                    'fk_recurrencia_tarea' => 0
                ]);
                $Tarea->save();
            }
        }

        return true;
    }
}
