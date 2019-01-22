<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class Dependencia extends Model
{
    protected $iddependencia;
    protected $codigo;
    protected $nombre;
    protected $cod_padre;
    protected $tipo;
    protected $estado;
    protected $codigo_arbol;
    protected $dbAttributes;

    protected $DependenciaPadre;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)['safe' => [
            'codigo',
            'nombre',
            'cod_padre',
            'tipo',
            'estado',
            'codigo_arbol'
        ]];
    }
    /**
     * Se ejecuta despues de crear la dependencia
     * Actualiza el codigo_arbol de la dependencia
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    protected function afterCreate()
    {
        $cod_arbol = $this->iddependencia;
        $padre = $this->getCodPadre();
        if ($padre) {
            $cod_arbol = $padre->codigo_arbol . '.' . $this->iddependencia;
        }
        $this->codigo_arbol = $cod_arbol;
        $this->update();
        return true;
    }
    /**
     * retorna la etiqueta del estado de la dependencia
     *
     * @return void
     */
    public function getEstado()
    {
        $estado = array(
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        );
        return $estado[$this->estado];
    }
    /**
     * retorna la instancia de la dependencia padre
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getCodPadre()
    {
        if ($this->cod_padre) {
            if (!$this->DependenciaPadre) {
                $this->DependenciaPadre = new self($this->cod_padre);
            }
        } else {
            $this->DependenciaPadre = null;
        }
        return $this->DependenciaPadre;
    }

}
