<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoLimite
 *
 * @ORM\Table(name="documento_limite", indexes={@ORM\Index(name="i_documento_limite_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoLimite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_limite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddocumentoLimite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cambio", type="date", nullable=false)
     */
    private $fechaCambio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=false)
     */
    private $fechaLimite;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=false)
     */
    private $observaciones;


}
