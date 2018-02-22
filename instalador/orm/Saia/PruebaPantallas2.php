<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PruebaPantallas2
 *
 * @ORM\Table(name="prueba_pantallas2")
 * @ORM\Entity
 */
class PruebaPantallas2
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idprueba_pantallas2", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpruebaPantallas2;



    /**
     * Get idpruebaPantallas2
     *
     * @return integer
     */
    public function getIdpruebaPantallas2()
    {
        return $this->idpruebaPantallas2;
    }
}
