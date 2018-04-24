<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evento
 *
 * @ORM\Table(name="evento", indexes={@ORM\Index(name="realiza", columns={"funcionario_codigo"})})
 * @ORM\Entity
 */
class Evento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idevento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevento;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario_codigo", type="string", length=20, nullable=false)
     */
    private $funcionarioCodigo = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="evento", type="string", nullable=false)
     */
    private $evento = 'ADICIONAR';

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_e", type="string", length=30, nullable=false)
     */
    private $tablaE;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="registro_id", type="integer", nullable=false)
     */
    private $registroId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", length=65535, nullable=false)
     */
    private $detalle;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_sql", type="text", length=65535, nullable=false)
     */
    private $codigoSql;


}
