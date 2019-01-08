<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosTransferencia
 *
 * @ORM\Table(name="anexos_transferencia")
 * @ORM\Entity
 */
class AnexosTransferencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos_transferencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idanexosTransferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
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

    /**
     * @var integer
     *
     * @ORM\Column(name="idbuzon_salida", type="integer", nullable=false)
     */
    private $idbuzonSalida;


}

