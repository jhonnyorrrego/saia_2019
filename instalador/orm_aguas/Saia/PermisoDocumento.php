<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoDocumento
 *
 * @ORM\Table(name="PERMISO_DOCUMENTO", indexes={@ORM\Index(name="i_permiso_documento_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_permiso_docu_funcionario", columns={"FUNCIONARIO"})})
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
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="PERMISOS", type="string", length=15, nullable=true)
     */
    private $permisos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';


}
