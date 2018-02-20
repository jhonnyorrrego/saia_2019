<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComentarioImg
 *
 * @ORM\Table(name="comentario_img", indexes={@ORM\Index(name="i_comentario_i_pagina", columns={"pagina"}), @ORM\Index(name="i_comentario_img_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class ComentarioImg
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcomentario_img", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcomentarioImg;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=4000, nullable=false)
     */
    private $tipo = 'PAGINA';

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina", type="integer", nullable=false)
     */
    private $pagina = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", nullable=false)
     */
    private $comentario = 'empty_clob()';

    /**
     * @var integer
     *
     * @ORM\Column(name="posx", type="integer", nullable=false)
     */
    private $posx = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="posy", type="integer", nullable=false)
     */
    private $posy = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;


}
