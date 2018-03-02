<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesBusqueda
 *
 * @ORM\Table(name="funciones_busqueda")
 * @ORM\Entity
 */
class FuncionesBusqueda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_busqueda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfuncionesBusqueda;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="busquedas_idbusqueda", type="integer", nullable=false)
     */
    private $busquedasIdbusqueda = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="pagina", type="string", length=255, nullable=false)
     */
    private $pagina = '';

    /**
     * @var string
     *
     * @ORM\Column(name="parametros", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo = 'link';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;



    /**
     * Get idfuncionesBusqueda
     *
     * @return integer
     */
    public function getIdfuncionesBusqueda()
    {
        return $this->idfuncionesBusqueda;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return FuncionesBusqueda
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set busquedasIdbusqueda
     *
     * @param integer $busquedasIdbusqueda
     *
     * @return FuncionesBusqueda
     */
    public function setBusquedasIdbusqueda($busquedasIdbusqueda)
    {
        $this->busquedasIdbusqueda = $busquedasIdbusqueda;

        return $this;
    }

    /**
     * Get busquedasIdbusqueda
     *
     * @return integer
     */
    public function getBusquedasIdbusqueda()
    {
        return $this->busquedasIdbusqueda;
    }

    /**
     * Set pagina
     *
     * @param string $pagina
     *
     * @return FuncionesBusqueda
     */
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;

        return $this;
    }

    /**
     * Get pagina
     *
     * @return string
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Set parametros
     *
     * @param string $parametros
     *
     * @return FuncionesBusqueda
     */
    public function setParametros($parametros)
    {
        $this->parametros = $parametros;

        return $this;
    }

    /**
     * Get parametros
     *
     * @return string
     */
    public function getParametros()
    {
        return $this->parametros;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FuncionesBusqueda
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return FuncionesBusqueda
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }
}
