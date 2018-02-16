<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoDocumento
 *
 * @ORM\Table(name="permiso_documento", indexes={@ORM\Index(name="doc", columns={"documento_iddocumento"}), @ORM\Index(name="func", columns={"funcionario"})})
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
    private $funcionario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="permisos", type="string", length=15, nullable=true)
     */
    private $permisos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha = 'CURRENT_TIMESTAMP';



    /**
     * Get idpermisoDocumento
     *
     * @return integer
     */
    public function getIdpermisoDocumento()
    {
        return $this->idpermisoDocumento;
    }

    /**
     * Set funcionario
     *
     * @param integer $funcionario
     *
     * @return PermisoDocumento
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return integer
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return PermisoDocumento
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set permisos
     *
     * @param string $permisos
     *
     * @return PermisoDocumento
     */
    public function setPermisos($permisos)
    {
        $this->permisos = $permisos;

        return $this;
    }

    /**
     * Get permisos
     *
     * @return string
     */
    public function getPermisos()
    {
        return $this->permisos;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PermisoDocumento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
