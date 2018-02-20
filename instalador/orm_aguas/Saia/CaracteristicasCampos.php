<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristicasCampos
 *
 * @ORM\Table(name="CARACTERISTICAS_CAMPOS")
 * @ORM\Entity
 */
class CaracteristicasCampos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCARACTERISTICAS_CAMPOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CARACTERISTICAS_CAMPOS_IDCARAC", allocationSize=1, initialValue=1)
     */
    private $idcaracteristicasCampos;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_CARACTERISTICA", type="string", length=255, nullable=false)
     */
    private $tipoCaracteristica = 'validacion';

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDCAMPOS_FORMATO", type="integer", nullable=false)
     */
    private $idcamposFormato;


}
