<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosVersion
 *
 * @ORM\Table(name="anexos_version", indexes={@ORM\Index(name="i_anexos_version_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class AnexosVersion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos_version", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ANEXOS_VERSION_IDANEXOS_VERSIO", allocationSize=1, initialValue=1)
     */
    private $idanexosVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="version_numero", type="integer", nullable=false)
     */
    private $versionNumero;

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
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;


}