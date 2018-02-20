<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anexos
 *
 * @ORM\Table(name="anexos", indexes={@ORM\Index(name="i_anexos_campos_forma", columns={"campos_formato"}), @ORM\Index(name="i_anexos_formato", columns={"formato"}), @ORM\Index(name="i_anexos_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_anexos_idbinario", columns={"idbinario"})})
 * @ORM\Entity
 */
class Anexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ANEXOS_IDANEXOS_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo = 'BASE';

    /**
     * @var integer
     *
     * @ORM\Column(name="formato", type="integer", nullable=true)
     */
    private $formato;

    /**
     * @var integer
     *
     * @ORM\Column(name="campos_formato", type="integer", nullable=true)
     */
    private $camposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="idbinario", type="integer", nullable=true)
     */
    private $idbinario;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_anexo", type="integer", nullable=true)
     */
    private $estadoAnexo = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_anexo", type="date", nullable=true)
     */
    private $fechaAnexo;


}
