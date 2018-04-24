<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoPorVincular
 *
 * @ORM\Table(name="documento_por_vincular", indexes={@ORM\Index(name="i_documento_por_vincular_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoPorVincular
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_por_vincular", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddocumentoPorVincular;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;


}
