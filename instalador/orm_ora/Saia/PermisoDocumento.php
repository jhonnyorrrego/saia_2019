<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoDocumento
 *
 * @ORM\Table(name="PERMISO_DOCUMENTO")
 * @ORM\Entity
 */
class PermisoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERMISO_DOCUMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERMISO_DOCUMENTO_IDPERMISO_DO", allocationSize=1, initialValue=1)
     */
    private $idpermisoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="PERMISOS", type="string", length=255, nullable=true)
     */
    private $permisos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;


}

