<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionDocumento
 *
 * @ORM\Table(name="version_documento", indexes={@ORM\Index(name="i_version_documento_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class VersionDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idversion_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idversionDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=true)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="pdf", type="string", length=255, nullable=true)
     */
    private $pdf;


}
