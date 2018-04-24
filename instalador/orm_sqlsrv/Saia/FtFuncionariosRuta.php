<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFuncionariosRuta
 *
 * @ORM\Table(name="ft_funcionarios_ruta")
 * @ORM\Entity
 */
class FtFuncionariosRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_funcionarios_ruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFuncionariosRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="mensajero_ruta", type="string", length=255, nullable=false)
     */
    private $mensajeroRuta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_ruta_distribucion", type="integer", nullable=false)
     */
    private $ftRutaDistribucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mensajero", type="date", nullable=false)
     */
    private $fechaMensajero;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_mensajero", type="integer", nullable=false)
     */
    private $estadoMensajero = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}
