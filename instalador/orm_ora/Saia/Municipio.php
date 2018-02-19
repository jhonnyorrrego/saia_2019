<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipio
 *
 * @ORM\Table(name="MUNICIPIO")
 * @ORM\Entity
 */
class Municipio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDMUNICIPIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="MUNICIPIO_IDMUNICIPIO_seq", allocationSize=1, initialValue=1)
     */
    private $idmunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPARTAMENTO_IDDEPARTAMENTO", type="integer", nullable=true)
     */
    private $departamentoIddepartamento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=255, nullable=true)
     */
    private $codigo;


}

