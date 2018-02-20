<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaEsquema
 *
 * @ORM\Table(name="PANTALLA_ESQUEMA")
 * @ORM\Entity
 */
class PantallaEsquema
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_ESQUEMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_ESQUEMA_IDPANTALLA_ES", allocationSize=1, initialValue=1)
     */
    private $idpantallaEsquema;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=false)
     */
    private $ruta;


}
