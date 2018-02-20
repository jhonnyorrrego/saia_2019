<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nombres
 *
 * @ORM\Table(name="NOMBRES", indexes={@ORM\Index(name="i_nombres_tipo_ctx", columns={"TIPO"})})
 * @ORM\Entity
 */
class Nombres
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDNOMBRE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="NOMBRES_IDNOMBRE_seq", allocationSize=1, initialValue=1)
     */
    private $idnombre;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=100, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=4000, nullable=false)
     */
    private $tipo = 'N';


}

