<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDependenciasRuta
 *
 * @ORM\Table(name="ft_dependencias_ruta")
 * @ORM\Entity
 */
class FtDependenciasRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_dependencias_ruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDependenciasRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_dependen", type="text", length=65535, nullable=true)
     */
    private $descripcionDependen;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_ruta_distribucion", type="integer", nullable=false)
     */
    private $ftRutaDistribucion;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencia_asignada", type="string", length=255, nullable=false)
     */
    private $dependenciaAsignada;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_item_dependenc", type="date", nullable=false)
     */
    private $fechaItemDependenc;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_dependencia", type="integer", nullable=false)
     */
    private $estadoDependencia = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_dependencia", type="integer", nullable=true)
     */
    private $ordenDependencia;


}

