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
    private $comentario;

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
    private $funcionario = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;



    /**
     * Get idcomentarioImg
     *
     * @return integer
     */
    public function getIdcomentarioImg()
    {
        return $this->idcomentarioImg;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return ComentarioImg
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return ComentarioImg
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set pagina
     *
     * @param integer $pagina
     *
     * @return ComentarioImg
     */
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;

        return $this;
    }

    /**
     * Get pagina
     *
     * @return integer
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return ComentarioImg
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set posx
     *
     * @param integer $posx
     *
     * @return ComentarioImg
     */
    public function setPosx($posx)
    {
        $this->posx = $posx;

        return $this;
    }

    /**
     * Get posx
     *
     * @return integer
     */
    public function getPosx()
    {
        return $this->posx;
    }

    /**
     * Set posy
     *
     * @param integer $posy
     *
     * @return ComentarioImg
     */
    public function setPosy($posy)
    {
        $this->posy = $posy;

        return $this;
    }

    /**
     * Get posy
     *
     * @return integer
     */
    public function getPosy()
    {
        return $this->posy;
    }

    /**
     * Set funcionario
     *
     * @param string $funcionario
     *
     * @return ComentarioImg
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return string
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return ComentarioImg
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
