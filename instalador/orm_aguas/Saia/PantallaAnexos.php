<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaAnexos
 *
 * @ORM\Table(name="PANTALLA_ANEXOS", indexes={@ORM\Index(name="i_pantalla_anexos_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class PantallaAnexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_ANEXOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_ANEXOS_IDPANTALLA_ANE", allocationSize=1, initialValue=1)
     */
    private $idpantallaAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXO", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="string", length=255, nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="PANTALLA_IDPANTALLA", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;


}
