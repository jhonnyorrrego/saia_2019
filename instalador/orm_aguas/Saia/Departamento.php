<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="departamento", indexes={@ORM\Index(name="i_departamento_pais_idpais", columns={"pais_idpais"})})
 * @ORM\Entity
 */
class Departamento
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddepartamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddepartamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="pais_idpais", type="integer", nullable=false)
     */
    private $paisIdpais = '1';


}
