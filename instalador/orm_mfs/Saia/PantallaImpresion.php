<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaImpresion
 *
 * @ORM\Table(name="pantalla_impresion", indexes={@ORM\Index(name="fk_pantalla_impresion_pantalla1_idx", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaImpresion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_impresion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaImpresion;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="text", length=65535, nullable=true)
     */
    private $pdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="idregistro", type="integer", nullable=false)
     */
    private $idregistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}

