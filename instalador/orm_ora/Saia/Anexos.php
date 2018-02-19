<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anexos
 *
 * @ORM\Table(name="ANEXOS")
 * @ORM\Entity
 */
class Anexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDANEXOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ANEXOS_IDANEXOS_seq", allocationSize=1, initialValue=1)
     */
    private $idanexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=100, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=100, nullable=true)
     */
    private $tipo = 'BASE';

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDBINARIO", type="integer", nullable=true)
     */
    private $idbinario;

    /**
     * @var string
     *
     * @ORM\Column(name="FORMATO", type="string", length=255, nullable=true)
     */
    private $formato;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS_FORMATO", type="string", length=255, nullable=true)
     */
    private $camposFormato;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ANEXO", type="date", nullable=true)
     */
    private $fechaAnexo = 'SYSDATE';


}

