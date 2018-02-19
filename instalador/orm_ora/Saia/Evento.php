<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evento
 *
 * @ORM\Table(name="EVENTO", indexes={@ORM\Index(name="llave_enlace", columns={"REGISTRO_ID"})})
 * @ORM\Entity
 */
class Evento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDEVENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="EVENTO_IDEVENTO_seq", allocationSize=1, initialValue=1)
     */
    private $idevento;

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="string", length=20, nullable=true)
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="EVENTO", type="string", length=4000, nullable=true)
     */
    private $evento = 'ADICIONAR';

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA_E", type="string", length=30, nullable=true)
     */
    private $tablaE;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="DETALLE", type="text", nullable=true)
     */
    private $detalle = 'empty_clob()';

    /**
     * @var integer
     *
     * @ORM\Column(name="REGISTRO_ID", type="integer", nullable=true)
     */
    private $registroId;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_SQL", type="text", nullable=true)
     */
    private $codigoSql = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="IP", type="string", length=255, nullable=true)
     */
    private $ip;


}
