<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="DEPARTAMENTO", indexes={@ORM\Index(name="i_departamento_pais_idpais", columns={"PAIS_IDPAIS"})})
 * @ORM\Entity
 */
class Departamento
{
    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDDEPARTAMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DEPARTAMENTO_IDDEPARTAMENTO_se", allocationSize=1, initialValue=1)
     */
    private $iddepartamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAIS_IDPAIS", type="integer", nullable=false)
     */
    private $paisIdpais = '1';


}
