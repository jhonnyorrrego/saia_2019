<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaEsquema
 *
 * @ORM\Table(name="pantalla_esquema")
 * @ORM\Entity
 */
class PantallaEsquema
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_esquema", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaEsquema;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;


}
