<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anexos
 *
 * @ORM\Table(name="ANEXOS", indexes={@ORM\Index(name="i_anexos_campos_forma", columns={"CAMPOS_FORMATO"}), @ORM\Index(name="i_anexos_formato", columns={"FORMATO"}), @ORM\Index(name="i_anexos_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_anexos_idbinario", columns={"IDBINARIO"})})
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
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=true)
     */
    private $tipo = 'BASE';

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO", type="integer", nullable=true)
     */
    private $formato;

    /**
     * @var integer
     *
     * @ORM\Column(name="CAMPOS_FORMATO", type="integer", nullable=true)
     */
    private $camposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDBINARIO", type="integer", nullable=true)
     */
    private $idbinario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO_ANEXO", type="integer", nullable=true)
     */
    private $estadoAnexo = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ANEXO", type="date", nullable=true)
     */
    private $fechaAnexo;


}
