<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionAnexos
 *
 * @ORM\Table(name="VERSION_ANEXOS", indexes={@ORM\Index(name="i_version_anexos_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class VersionAnexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDVERSION_ANEXOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="VERSION_ANEXOS_IDVERSION_ANEXO", allocationSize=1, initialValue=1)
     */
    private $idversionAnexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDVERSION_DOCUMENTO", type="integer", nullable=true)
     */
    private $fkIdversionDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANEXOS_IDANEXOS", type="integer", nullable=true)
     */
    private $anexosIdanexos;


}
