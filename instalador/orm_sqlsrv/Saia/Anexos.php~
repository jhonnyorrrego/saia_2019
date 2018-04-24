<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anexos
 *
 * @ORM\Table(name="anexos", indexes={@ORM\Index(name="documento_iddocumento", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Anexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idanexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo = 'BASE';

    /**
     * @var string
     *
     * @ORM\Column(name="formato", type="string", length=255, nullable=true)
     */
    private $formato;

    /**
     * @var string
     *
     * @ORM\Column(name="campos_formato", type="string", length=255, nullable=true)
     */
    private $camposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="idbinario", type="integer", nullable=true)
     */
    private $idbinario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_anexo", type="datetime", nullable=true)
     */
    private $fechaAnexo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;


}

