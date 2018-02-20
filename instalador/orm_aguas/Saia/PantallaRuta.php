<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaRuta
 *
 * @ORM\Table(name="PANTALLA_RUTA")
 * @ORM\Entity
 */
class PantallaRuta
{
    /**
     * @var string
     *
     * @ORM\Column(name="FIRMA_EXTERNA", type="string", length=255, nullable=true)
     */
    private $firmaExterna;

    /**
     * @var string
     *
     * @ORM\Column(name="DESTINO", type="string", length=255, nullable=false)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ORIGEN", type="integer", nullable=false)
     */
    private $tipoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_DESTINO", type="integer", nullable=false)
     */
    private $tipoDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="OBLIGATORIO", type="string", length=255, nullable=false)
     */
    private $obligatorio = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIGEN", type="integer", nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_RUTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_RUTA_IDPANTALLA_RUTA_", allocationSize=1, initialValue=1)
     */
    private $idpantallaRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE_RUTA_TEMPORAL", type="string", length=255, nullable=false)
     */
    private $llaveRutaTemporal;

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;


}
