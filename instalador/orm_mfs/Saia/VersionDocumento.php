<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionDocumento
 *
 * @ORM\Table(name="version_documento")
 * @ORM\Entity
 */
class VersionDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idversion_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
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
     * @ORM\Column(name="pdf", type="string", length=600, nullable=true)
     */
    private $pdf;


}
