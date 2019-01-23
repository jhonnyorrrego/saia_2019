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
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ANEXOS_DESPACHO_IDANEXOS_DESPA", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
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