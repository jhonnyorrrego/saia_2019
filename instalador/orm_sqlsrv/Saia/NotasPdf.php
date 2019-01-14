<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotasPdf
 *
 * @ORM\Table(name="notas_pdf")
 * @ORM\Entity
 */
class NotasPdf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_notas_pdf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNotasPdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento", type="integer", nullable=false)
     */
    private $iddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255, nullable=false)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="x", type="string", length=255, nullable=false)
     */
    private $x;

    /**
     * @var string
     *
     * @ORM\Column(name="y", type="string", length=255, nullable=false)
     */
    private $y;

    /**
     * @var string
     *
     * @ORM\Column(name="ancho", type="string", length=255, nullable=false)
     */
    private $ancho;

    /**
     * @var string
     *
     * @ORM\Column(name="alto", type="string", length=255, nullable=false)
     */
    private $alto;

    /**
     * @var string
     *
     * @ORM\Column(name="pagina", type="string", length=255, nullable=false)
     */
    private $pagina;

    /**
     * @var string
     *
     * @ORM\Column(name="uid", type="string", length=255, nullable=false)
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=11, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_notas", type="datetime", nullable=false)
     */
    private $fechaNotas;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_padre", type="string", length=255, nullable=true)
     */
    private $codPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_archivo", type="string", length=255, nullable=false)
     */
    private $tipoArchivo;


}

