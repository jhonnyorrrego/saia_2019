<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaAccion
 *
 * @ORM\Table(name="PANTALLA_ACCION")
 * @ORM\Entity
 */
class PantallaAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_ACCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_ACCION_IDPANTALLA_ACC", allocationSize=1, initialValue=1)
     */
    private $idpantallaAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_ACCION", type="integer", nullable=false)
     */
    private $tipoAccion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDPANTALLA", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}
