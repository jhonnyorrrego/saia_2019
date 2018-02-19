<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoPorVincular
 *
 * @ORM\Table(name="DOCUMENTO_POR_VINCULAR", indexes={@ORM\Index(name="documento_por_vincular_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class DocumentoPorVincular
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO_POR_VINCULAR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_POR_VINCULAR_IDDOCUM", allocationSize=1, initialValue=1)
     */
    private $iddocumentoPorVincular;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;


}
