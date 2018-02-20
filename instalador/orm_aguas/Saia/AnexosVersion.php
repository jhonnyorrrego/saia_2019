<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosVersion
 *
 * @ORM\Table(name="ANEXOS_VERSION", indexes={@ORM\Index(name="i_anexos_version_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class AnexosVersion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDANEXOS_VERSION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ANEXOS_VERSION_IDANEXOS_VERSIO", allocationSize=1, initialValue=1)
     */
    private $idanexosVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="VERSION_NUMERO", type="integer", nullable=false)
     */
    private $versionNumero;

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
     * @ORM\Column(name="TIPO", type="string", length=255, nullable=false)
     */
    private $tipo;


}
