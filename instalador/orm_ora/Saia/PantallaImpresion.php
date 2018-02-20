<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaImpresion
 *
 * @ORM\Table(name="pantalla_impresion", indexes={@ORM\Index(name="i_pant_impr_fk_idpantalla", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaImpresion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_impresion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaImpresion;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="text", nullable=true)
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
