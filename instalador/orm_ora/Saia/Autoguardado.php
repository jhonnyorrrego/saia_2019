<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autoguardado
 *
 * @ORM\Table(name="autoguardado", indexes={@ORM\Index(name="i_autoguardado_usuario", columns={"usuario"})})
 * @ORM\Entity
 */
class Autoguardado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idautoguardado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="AUTOGUARDADO_IDAUTOGUARDADO_se", allocationSize=1, initialValue=1)
     */
    private $idautoguardado;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=true)
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


}
