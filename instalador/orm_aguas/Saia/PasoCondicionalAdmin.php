<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoCondicionalAdmin
 *
 * @ORM\Table(name="PASO_CONDICIONAL_ADMIN")
 * @ORM\Entity
 */
class PasoCondicionalAdmin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPASO_CONDICIONAL_ADMIN", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PASO_CONDICIONAL_ADMIN_IDPASO_", allocationSize=1, initialValue=1)
     */
    private $idpasoCondicionalAdmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_PASO_CONDICIONAL", type="integer", nullable=false)
     */
    private $fkPasoCondicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_CAMPOS_FORMATO", type="integer", nullable=false)
     */
    private $fkCamposFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="COMPARACION", type="string", length=255, nullable=false)
     */
    private $comparacion;

    /**
     * @var string
     *
     * @ORM\Column(name="VALOR", type="string", length=255, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="HABILITAR_PASOS_SI", type="string", length=255, nullable=false)
     */
    private $habilitarPasosSi;

    /**
     * @var string
     *
     * @ORM\Column(name="HABILITAR_PASOS_NO", type="string", length=255, nullable=true)
     */
    private $habilitarPasosNo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;


}
