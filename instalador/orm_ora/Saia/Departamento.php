<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="DEPARTAMENTO", uniqueConstraints={@ORM\UniqueConstraint(name="departamento_pk", columns={"IDDEPARTAMENTO"})})
 * @ORM\Entity
 */
class Departamento
{
    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DEPARTAMENTO_NOMBRE_seq", allocationSize=1, initialValue=1)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDDEPARTAMENTO", type="integer", nullable=true)
     */
    private $iddepartamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAIS_IDPAIS", type="integer", nullable=true)
     */
    private $paisIdpais = '1';


}
