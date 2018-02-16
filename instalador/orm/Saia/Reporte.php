<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reporte
 *
 * @ORM\Table(name="reporte")
 * @ORM\Entity
 */
class Reporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreporte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreporte;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var string
     *
     * @ORM\Column(name="sql_reporte", type="string", length=3000, nullable=false)
     */
    private $sqlReporte;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_archivo", type="string", length=255, nullable=true)
     */
    private $nombreArchivo = 'reporte';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="mascaras", type="string", length=3000, nullable=true)
     */
    private $mascaras;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="campos_texto", type="string", length=2000, nullable=true)
     */
    private $camposTexto;

    /**
     * @var string
     *
     * @ORM\Column(name="campos_numero", type="string", length=2000, nullable=true)
     */
    private $camposNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_ordenamiento", type="string", length=4, nullable=true)
     */
    private $tipoOrdenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_ordenamiento", type="string", length=255, nullable=true)
     */
    private $campoOrdenamiento;



    /**
     * Get idreporte
     *
     * @return integer
     */
    public function getIdreporte()
    {
        return $this->idreporte;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Reporte
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set sqlReporte
     *
     * @param string $sqlReporte
     *
     * @return Reporte
     */
    public function setSqlReporte($sqlReporte)
    {
        $this->sqlReporte = $sqlReporte;

        return $this;
    }

    /**
     * Get sqlReporte
     *
     * @return string
     */
    public function getSqlReporte()
    {
        return $this->sqlReporte;
    }

    /**
     * Set nombreArchivo
     *
     * @param string $nombreArchivo
     *
     * @return Reporte
     */
    public function setNombreArchivo($nombreArchivo)
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    /**
     * Get nombreArchivo
     *
     * @return string
     */
    public function getNombreArchivo()
    {
        return $this->nombreArchivo;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Reporte
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set mascaras
     *
     * @param string $mascaras
     *
     * @return Reporte
     */
    public function setMascaras($mascaras)
    {
        $this->mascaras = $mascaras;

        return $this;
    }

    /**
     * Get mascaras
     *
     * @return string
     */
    public function getMascaras()
    {
        return $this->mascaras;
    }

    /**
     * Set moduloIdmodulo
     *
     * @param integer $moduloIdmodulo
     *
     * @return Reporte
     */
    public function setModuloIdmodulo($moduloIdmodulo)
    {
        $this->moduloIdmodulo = $moduloIdmodulo;

        return $this;
    }

    /**
     * Get moduloIdmodulo
     *
     * @return integer
     */
    public function getModuloIdmodulo()
    {
        return $this->moduloIdmodulo;
    }

    /**
     * Set camposTexto
     *
     * @param string $camposTexto
     *
     * @return Reporte
     */
    public function setCamposTexto($camposTexto)
    {
        $this->camposTexto = $camposTexto;

        return $this;
    }

    /**
     * Get camposTexto
     *
     * @return string
     */
    public function getCamposTexto()
    {
        return $this->camposTexto;
    }

    /**
     * Set camposNumero
     *
     * @param string $camposNumero
     *
     * @return Reporte
     */
    public function setCamposNumero($camposNumero)
    {
        $this->camposNumero = $camposNumero;

        return $this;
    }

    /**
     * Get camposNumero
     *
     * @return string
     */
    public function getCamposNumero()
    {
        return $this->camposNumero;
    }

    /**
     * Set tipoOrdenamiento
     *
     * @param string $tipoOrdenamiento
     *
     * @return Reporte
     */
    public function setTipoOrdenamiento($tipoOrdenamiento)
    {
        $this->tipoOrdenamiento = $tipoOrdenamiento;

        return $this;
    }

    /**
     * Get tipoOrdenamiento
     *
     * @return string
     */
    public function getTipoOrdenamiento()
    {
        return $this->tipoOrdenamiento;
    }

    /**
     * Set campoOrdenamiento
     *
     * @param string $campoOrdenamiento
     *
     * @return Reporte
     */
    public function setCampoOrdenamiento($campoOrdenamiento)
    {
        $this->campoOrdenamiento = $campoOrdenamiento;

        return $this;
    }

    /**
     * Get campoOrdenamiento
     *
     * @return string
     */
    public function getCampoOrdenamiento()
    {
        return $this->campoOrdenamiento;
    }
}
