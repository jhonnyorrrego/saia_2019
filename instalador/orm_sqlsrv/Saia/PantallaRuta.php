<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaRuta
 *
 * @ORM\Table(name="pantalla_ruta", indexes={@ORM\Index(name="fk_pantalla_ruta_pantalla1_idx", columns={"pantalla_idpantalla"})})
 * @ORM\Entity
 */
class PantallaRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_ruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_externa", type="string", length=255, nullable=true)
     */
    private $firmaExterna;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=255, nullable=false)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=false)
     */
    private $tipoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=false)
     */
    private $tipoDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="obligatorio", type="string", length=255, nullable=false)
     */
    private $obligatorio = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="origen", type="integer", nullable=false)
     */
    private $origen;

    /**
     * @var string
     *
     * @ORM\Column(name="llave_ruta_temporal", type="string", length=255, nullable=false)
     */
    private $llaveRutaTemporal;

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;


}
