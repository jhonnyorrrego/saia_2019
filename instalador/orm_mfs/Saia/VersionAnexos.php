<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionAnexos
 *
 * @ORM\Table(name="version_anexos")
 * @ORM\Entity
 */
class VersionAnexos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idversion_anexos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idversionAnexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=true)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idversion_documento", type="integer", nullable=true)
     */
    private $fkIdversionDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_idanexos", type="integer", nullable=true)
     */
    private $anexosIdanexos;


}
