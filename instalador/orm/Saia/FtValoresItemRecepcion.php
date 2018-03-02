<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtValoresItemRecepcion
 *
 * @ORM\Table(name="ft_valores_item_recepcion")
 * @ORM\Entity
 */
class FtValoresItemRecepcion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_valores_item_recepcion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftValoresItemRecepcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_recepcion_cotizacion", type="integer", nullable=false)
     */
    private $ftRecepcionCotizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_idft_item", type="string", length=255, nullable=true)
     */
    private $fkIdftItem;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;



    /**
     * Get idftValoresItemRecepcion
     *
     * @return integer
     */
    public function getIdftValoresItemRecepcion()
    {
        return $this->idftValoresItemRecepcion;
    }

    /**
     * Set ftRecepcionCotizacion
     *
     * @param integer $ftRecepcionCotizacion
     *
     * @return FtValoresItemRecepcion
     */
    public function setFtRecepcionCotizacion($ftRecepcionCotizacion)
    {
        $this->ftRecepcionCotizacion = $ftRecepcionCotizacion;

        return $this;
    }

    /**
     * Get ftRecepcionCotizacion
     *
     * @return integer
     */
    public function getFtRecepcionCotizacion()
    {
        return $this->ftRecepcionCotizacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtValoresItemRecepcion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fkIdftItem
     *
     * @param string $fkIdftItem
     *
     * @return FtValoresItemRecepcion
     */
    public function setFkIdftItem($fkIdftItem)
    {
        $this->fkIdftItem = $fkIdftItem;

        return $this;
    }

    /**
     * Get fkIdftItem
     *
     * @return string
     */
    public function getFkIdftItem()
    {
        return $this->fkIdftItem;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return FtValoresItemRecepcion
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }
}
