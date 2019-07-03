<?php

class Caja extends Model
{

    protected $idcaja;
    protected $codigo;
    protected $estado_archivo;
    protected $seccion;
    protected $subseccion;
    protected $division;
    protected $modulo;
    protected $panel;
    protected $nivel;
    protected $fondo;
    protected $material;
    protected $seguridad;
    protected $fk_entidad_serie;
    protected $propietario;
    protected $responsable;
    protected $fecha_creacion;
    protected $estado;
    protected $fk_caja_eli;

    

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'codigo',
                'estado_archivo',
                'seccion',
                'subseccion',
                'division',
                'modulo',
                'panel',
                'nivel',
                'fondo',
                'material',
                'seguridad',
                'propietario',
                'responsable',
                'fecha_creacion',
                'estado',
                'fk_caja_eli'
            ],
            'date' => [
                'fecha_creacion'
            ]
        ];
    }
    /**
     * Valida si el funcionario es reponsable de la caja
     *
     * @return boolean
     * @author Name <email@email.com>
     */
    public function isResponsable(): bool
    {
        $userId = SessionController::getValue('idfuncionario');
        return in_array($userId, [$this->propietario, $this->responsable]);
    }
    /**
     * Retorna el nombre del propietario
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getPropietario(): string
    {
        $data = $this->getRelationFk('Funcionario', 'propietario');
        return $data ? $data->nombres . ' ' . $data->apellidos : '';
    }

    /**
     * Obtiene el icono de la caja
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getIcon(): string
    {
        return 'fa fa-dropbox';
    }

    /**
     * Retorna el nombre del funcionario responsable
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getResponsable(): string
    {
        $data = $this->getRelationFk('Funcionario', 'responsable');
        return $data ? $data->nombres . ' ' . $data->apellidos : '';
    }

    /**
     * retorna la etiqueta del campo seguridad
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getSeguridad(): string
    {
        $data = $this->keyValueField('seguridad');
        return $data[$this->seguridad] ?? '';
    }


    /**
     * retorna la etiqueta del campo material
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getMaterial(): string
    {
        $data = $this->keyValueField('material');
        return $data[$this->material] ?? '';
    }
    /**
     * retorna la etiqueta del campo estado_archivo
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEstadoArchivo(): string
    {
        $data = $this->keyValueField('estado_archivo');
        return $data[$this->estado_archivo] ?? '';
    }

    /**
     * Cuenta los documentos que existen en una caja
     *
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function countDocuments(): int
    {
        return ExpedienteDoc::countDocumentsCaja($this->idcaja);
    }


    /**
     * Cuenta los expedientes que existen dentro de una caja
     * incluye expedientes inferiores
     *
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function countAllExpediente(): int
    {
        return Expediente::countAllExpedienteCaja($this->idcaja);
    }


    /**
     * Cuenta los expedientes que existen dentro de una caja
     * NO incluye expedientes inferiores     
     * 
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function countExpediente(): int
    {
        return Expediente::countExpedienteCaja($this->idcaja);
    }

    /**
     * Crea el HTML de un campo
     *
     * @param string $campo : Nombre del campo en la DB
     * @param string $etiqHtml : Etiqueta HTML
     * @param integer $selected : ID del cual desea este checkeado/seleccionado
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function getHtmlField(string $campo, string $etiqHtml, $selected = 0): string
    {
        $html = '';
        switch ($etiqHtml) {
            case 'select':
                $data = self::keyValueField($campo);
                foreach ($data as $key => $value) {
                    if ($selected == $key) {
                        $html .= "<option value='{$key}' selected>{$value}</option>";
                    } else {
                        $html .= "<option value='{$key}'>{$value}</option>";
                    }
                }
                break;
        }
        return $html;
    }


    /**
     * Obtiene los datos de los campos key y value
     *
     * @param string $campo : nombre del campo en la db
     * @return array
     */
    public static function keyValueField(string $campo): array
    {
        $response['estado'] = [
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        ];

        $response['estado_archivo'] = [
            1 => 'Gestión',
            2 => 'Central',
            3 => 'Historico'
        ];

        $response['seguridad'] = [
            1 => 'Confidencial',
            2 => 'Publico',
            3 => 'Rutinario'
        ];

        $response['material'] = [
            1 => 'Carton',
            2 => 'Otro'
        ];

        return $response[$campo];
    }
}
