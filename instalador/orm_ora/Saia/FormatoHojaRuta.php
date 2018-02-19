<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormatoHojaRuta
 *
 * @ORM\Table(name="FORMATO_HOJA_RUTA")
 * @ORM\Entity
 */
class FormatoHojaRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFORMATO_HOJA_RUTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FORMATO_HOJA_RUTA_IDFORMATO_HO", allocationSize=1, initialValue=1)
     */
    private $idformatoHojaRuta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIGEN", type="integer", nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="DESTINO", type="integer", nullable=false)
     */
    private $destino;


}

