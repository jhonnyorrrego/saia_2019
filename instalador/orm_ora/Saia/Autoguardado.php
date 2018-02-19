<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Autoguardado
 *
 * @ORM\Table(name="AUTOGUARDADO")
 * @ORM\Entity
 */
class Autoguardado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDAUTOGUARDADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="AUTOGUARDADO_IDAUTOGUARDADO_se", allocationSize=1, initialValue=1)
     */
    private $idautoguardado;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENIDO", type="text", nullable=true)
     */
    private $contenido = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="FORMATO", type="string", length=255, nullable=true)
     */
    private $formato;

    /**
     * @var string
     *
     * @ORM\Column(name="USUARIO", type="string", length=255, nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO", type="string", length=255, nullable=true)
     */
    private $campo;


}
