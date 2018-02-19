<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVinculados
 *
 * @ORM\Table(name="DOCUMENTO_VINCULADOS", indexes={@ORM\Index(name="documento_vinculados_destino", columns={"DOCUMENTO_DESTINO"}), @ORM\Index(name="documento_vinculados_origen", columns={"DOCUMENTO_ORIGEN"}), @ORM\Index(name="documento_vinculados_func", columns={"FUNCIONARIO_IDFUNCIONARIO"}), @ORM\Index(name="documento_vinculados_fecha", columns={"FECHA"})})
 * @ORM\Entity
 */
class DocumentoVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDOCUMENTO_VINCULADOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DOCUMENTO_VINCULADOS_IDDOCUMEN", allocationSize=1, initialValue=1)
     */
    private $iddocumentoVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_ORIGEN", type="integer", nullable=true)
     */
    private $documentoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_DESTINO", type="integer", nullable=true)
     */
    private $documentoDestino;

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
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}
