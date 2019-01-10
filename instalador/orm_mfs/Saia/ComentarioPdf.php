<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComentarioPdf
 *
 * @ORM\Table(name="comentario_pdf")
 * @ORM\Entity
 */
class ComentarioPdf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcomentario_pdf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcomentarioPdf;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", length=65535, nullable=false)
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="iddocumento", type="string", length=255, nullable=false)
     */
    private $iddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ft_notas_pdf", type="string", length=255, nullable=false)
     */
    private $ftNotasPdf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_comentario", type="datetime", nullable=false)
     */
    private $fechaComentario;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=11, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_archivo", type="string", length=255, nullable=false)
     */
    private $tipoArchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=true)
     */
    private $funcionario;


}

