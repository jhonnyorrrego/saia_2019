<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVinculados
 *
 * @ORM\Table(name="documento_vinculados", indexes={@ORM\Index(name="i_documento_vi_funcionario_", columns={"funcionario_idfuncionario"}), @ORM\Index(name="i_documento_vi_documento_de", columns={"documento_destino"}), @ORM\Index(name="i_documento_vi_documento_or", columns={"documento_origen"})})
 * @ORM\Entity
 */
class DocumentoVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_vinculados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddocumentoVinculados;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_origen", type="integer", nullable=false)
     */
    private $documentoOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_destino", type="integer", nullable=false)
     */
    private $documentoDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;


}
