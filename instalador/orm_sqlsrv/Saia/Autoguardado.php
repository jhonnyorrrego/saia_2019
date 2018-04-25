<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autoguardado
 *
 * @ORM\Table(name="autoguardado")
 * @ORM\Entity
 */
class Autoguardado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idautoguardado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idautoguardado;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="formato", type="string", length=255, nullable=false)
     */
    private $formato;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuario", type="integer", nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="campo", type="string", length=255, nullable=true)
     */
    private $campo;



    /**
     * Get idautoguardado
     *
     * @return integer
     */
    public function getIdautoguardado()
    {
        return $this->idautoguardado;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return Autoguardado
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set formato
     *
     * @param string $formato
     *
     * @return Autoguardado
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;

        return $this;
    }

    /**
     * Get formato
     *
     * @return string
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return Autoguardado
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return integer
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set campo
     *
     * @param string $campo
     *
     * @return Autoguardado
     */
    public function setCampo($campo)
    {
        $this->campo = $campo;

        return $this;
    }

    /**
     * Get campo
     *
     * @return string
     */
    public function getCampo()
    {
        return $this->campo;
    }
}
