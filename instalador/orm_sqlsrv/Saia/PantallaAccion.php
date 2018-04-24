<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaAccion
 *
 * @ORM\Table(name="pantalla_accion", indexes={@ORM\Index(name="fk_pantalla_accion_pantalla1_idx", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaAccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_accion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_accion", type="integer", nullable=false)
     */
    private $tipoAccion = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}
