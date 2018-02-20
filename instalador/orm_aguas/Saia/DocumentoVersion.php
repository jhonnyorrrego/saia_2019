<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVersion
 *
 * @ORM\Table(name="DOCUMENTO_VERSION", indexes={@ORM\Index(name="i_documento_version_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_documento_ve_funcionario", columns={"FUNCIONARIO"})})
 * @ORM\Entity
 */
class DocumentoVersion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO_VERSION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_VERSION_IDDOCUMENTO_", allocationSize=1, initialValue=1)
     */
    private $iddocumentoVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUMERO_VERSION", type="integer", nullable=false)
     */
    private $numeroVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="PREFIJO", type="string", length=255, nullable=true)
     */
    private $prefijo;

    /**
     * @var string
     *
     * @ORM\Column(name="SUFIJO", type="string", length=255, nullable=true)
     */
    private $sufijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="CARGA_INICIAL", type="integer", nullable=false)
     */
    private $cargaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionario;


}
