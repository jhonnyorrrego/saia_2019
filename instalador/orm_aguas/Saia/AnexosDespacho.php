<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosDespacho
 *
 * @ORM\Table(name="ANEXOS_DESPACHO", indexes={@ORM\Index(name="i_anexos_despacho_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class AnexosDespacho
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDANEXOS_DESPACHO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ANEXOS_DESPACHO_IDANEXOS_DESPA", allocationSize=1, initialValue=1)
     */
    private $idanexosDespacho;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDSALIDAS", type="integer", nullable=false)
     */
    private $fkIdsalidas;


}
