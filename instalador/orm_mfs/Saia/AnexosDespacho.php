<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosDespacho
 *
 * @ORM\Table(name="anexos_despacho", indexes={@ORM\Index(name="i_anexos_despacho_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class AnexosDespacho
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos_despacho", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idanexosDespacho;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idsalidas", type="integer", nullable=false)
     */
    private $fkIdsalidas;


}
