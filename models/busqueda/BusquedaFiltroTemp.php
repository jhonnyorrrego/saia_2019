<?php

class BusquedaFiltroTemp extends Model
{
    protected $idbusqueda_filtro_temp;
    protected $fk_busqueda_componente;
    protected $funcionario_idfuncionario;
    protected $fecha;
    protected $detalle;

    

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_busqueda_componente',
                'funcionario_idfuncionario',
                'fecha',
                'detalle'
            ],
            'date'=>'fecha'
        ];
    }
   

}