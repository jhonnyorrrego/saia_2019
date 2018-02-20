<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVersion
 *
 * @ORM\Table(name="documento_version", indexes={@ORM\Index(name="i_documento_version_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_documento_ve_funcionario", columns={"funcionario"})})
 * @ORM\Entity
 */
class DocumentoVersion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_version", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddocumentoVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_version", type="integer", nullable=false)
     */
    private $numeroVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="prefijo", type="string", length=255, nullable=true)
     */
    private $prefijo;

    /**
     * @var string
     *
     * @ORM\Column(name="sufijo", type="string", length=255, nullable=true)
     */
    private $sufijo;

    /**
     * @var integer
     *
     * @ORM\Column(name="carga_inicial", type="integer", nullable=false)
     */
    private $cargaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario", type="integer", nullable=false)
     */
    private $funcionario;


}
