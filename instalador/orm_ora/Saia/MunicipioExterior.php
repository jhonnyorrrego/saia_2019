<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * MunicipioExterior
 *
 * @ORM\Table(name="MUNICIPIO_EXTERIOR")
 * @ORM\Entity
 */
class MunicipioExterior
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDMUNICIPIO_EXTERIOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="MUNICIPIO_EXTERIOR_IDMUNICIPIO", allocationSize=1, initialValue=1)
     */
    private $idmunicipioExterior;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPARTAMENTO_IDDEPARTAMENTO", type="integer", nullable=true)
     */
    private $departamentoIddepartamento = '0';


}

