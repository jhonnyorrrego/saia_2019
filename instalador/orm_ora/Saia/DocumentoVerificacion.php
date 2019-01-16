<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoVerificacion
 *
 * @ORM\Table(name="documento_verificacion", indexes={@ORM\Index(name="i_documento_verificacion_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DocumentoVerificacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_verificacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddocumentoVerificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="verificacion", type="string", length=255, nullable=true)
     */
    private $verificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_qr", type="string", length=255, nullable=true)
     */
    private $rutaQr;


}
