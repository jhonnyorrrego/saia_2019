<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaInclude
 *
 * @ORM\Table(name="PANTALLA_INCLUDE")
 * @ORM\Entity
 */
class PantallaInclude
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_INCLUDE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_INCLUDE_IDPANTALLA_IN", allocationSize=1, initialValue=1)
     */
    private $idpantallaInclude;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_INCLUIR", type="string", length=255, nullable=true)
     */
    private $lugarIncluir = 'footer';

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_INCLUDE", type="string", length=255, nullable=true)
     */
    private $accionesInclude = 'a,e,m';

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDPANTALLA_LIBRERIA", type="integer", nullable=false)
     */
    private $fkIdpantallaLibreria;


}
