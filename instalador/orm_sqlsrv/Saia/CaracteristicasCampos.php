<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristicasCampos
 *
 * @ORM\Table(name="caracteristicas_campos")
 * @ORM\Entity
 */
class CaracteristicasCampos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcaracteristicas_campos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcaracteristicasCampos;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_caracteristica", type="string", length=255, nullable=false)
     */
    private $tipoCaracteristica = 'validacion';

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcampos_formato", type="integer", nullable=false)
     */
    private $idcamposFormato;


}
