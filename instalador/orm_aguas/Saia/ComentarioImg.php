<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComentarioImg
 *
 * @ORM\Table(name="COMENTARIO_IMG", indexes={@ORM\Index(name="i_comentario_tipo_ctx", columns={"TIPO"}), @ORM\Index(name="i_comentario_i_pagina", columns={"PAGINA"}), @ORM\Index(name="i_comentario_img_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class ComentarioImg
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCOMENTARIO_IMG", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="COMENTARIO_IMG_IDCOMENTARIO_IM", allocationSize=1, initialValue=1)
     */
    private $idcomentarioImg;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=4000, nullable=false)
     */
    private $tipo = 'PAGINA';

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINA", type="integer", nullable=false)
     */
    private $pagina = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="COMENTARIO", type="text", nullable=false)
     */
    private $comentario = 'empty_clob()';

    /**
     * @var integer
     *
     * @ORM\Column(name="POSX", type="integer", nullable=false)
     */
    private $posx = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="POSY", type="integer", nullable=false)
     */
    private $posy = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;


}
