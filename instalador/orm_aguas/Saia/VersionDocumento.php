<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionDocumento
 *
 * @ORM\Table(name="VERSION_DOCUMENTO", indexes={@ORM\Index(name="i_version_documento_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class VersionDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDVERSION_DOCUMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="VERSION_DOCUMENTO_IDVERSION_DO", allocationSize=1, initialValue=1)
     */
    private $idversionDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="VERSION", type="integer", nullable=true)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="PDF", type="string", length=255, nullable=true)
     */
    private $pdf;


}
