<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PruebaPantalla3
 *
 * @ORM\Table(name="prueba_pantalla3")
 * @ORM\Entity
 */
class PruebaPantalla3
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idprueba_pantalla3", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpruebaPantalla3;



    /**
     * Get idpruebaPantalla3
     *
     * @return integer
     */
    public function getIdpruebaPantalla3()
    {
        return $this->idpruebaPantalla3;
    }
}
