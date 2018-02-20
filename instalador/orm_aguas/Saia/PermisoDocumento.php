<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoDocumento
 *
 * @ORM\Table(name="permiso_documento", indexes={@ORM\Index(name="i_permiso_documento_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_permiso_docu_funcionario", columns={"funcionario"})})
 * @ORM\Entity
 */
class PermisoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpermisoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario", type="integer", nullable=false)
     */
    private $funcionario = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="permisos", type="string", length=15, nullable=true)
     */
    private $permisos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';


}
