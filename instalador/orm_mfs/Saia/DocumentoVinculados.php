<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVinculados
 *
 * @ORM\Table(name="documento_vinculados")
 * @ORM\Entity
 */
class DocumentoVinculados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_vinculados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
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
     * @ORM\Column(name="observaciones", type="text", length=16777215, nullable=true)
     */
    private $observaciones;


}

