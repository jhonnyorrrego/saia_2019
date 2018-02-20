<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaImpresion
 *
 * @ORM\Table(name="PANTALLA_IMPRESION", indexes={@ORM\Index(name="i_pantalla_i_pdf_ctx", columns={"PDF"})})
 * @ORM\Entity
 */
class PantallaImpresion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_IMPRESION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_IMPRESION_IDPANTALLA_", allocationSize=1, initialValue=1)
     */
    private $idpantallaImpresion;

    /**
     * @var string
     *
     * @ORM\Column(name="PDF", type="text", nullable=true)
     */
    private $pdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDREGISTRO", type="integer", nullable=false)
     */
    private $idregistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDPANTALLA", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}
