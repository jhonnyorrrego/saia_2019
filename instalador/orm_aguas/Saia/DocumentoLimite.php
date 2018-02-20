<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoLimite
 *
 * @ORM\Table(name="DOCUMENTO_LIMITE", indexes={@ORM\Index(name="i_documento_limite_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class DocumentoLimite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO_LIMITE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_LIMITE_IDDOCUMENTO_L", allocationSize=1, initialValue=1)
     */
    private $iddocumentoLimite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CAMBIO", type="date", nullable=false)
     */
    private $fechaCambio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_LIMITE", type="date", nullable=false)
     */
    private $fechaLimite;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=false)
     */
    private $observaciones;


}
