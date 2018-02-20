<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaAnexos
 *
 * @ORM\Table(name="pantalla_anexos", indexes={@ORM\Index(name="i_pantalla_anex_pant_idpant", columns={"pantalla_idpantalla"}), @ORM\Index(name="i_pantalla_anexos_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class PantallaAnexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_anexos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_iddocumento", type="string", length=255, nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;


}
