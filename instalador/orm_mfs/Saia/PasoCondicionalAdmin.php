<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoCondicionalAdmin
 *
 * @ORM\Table(name="paso_condicional_admin")
 * @ORM\Entity
 */
class PasoCondicionalAdmin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_condicional_admin", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoCondicionalAdmin;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_paso_condicional", type="integer", nullable=false)
     */
    private $fkPasoCondicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_campos_formato", type="integer", nullable=false)
     */
    private $fkCamposFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="comparacion", type="string", length=255, nullable=false)
     */
    private $comparacion;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="habilitar_pasos_si", type="string", length=255, nullable=false)
     */
    private $habilitarPasosSi;

    /**
     * @var string
     *
     * @ORM\Column(name="habilitar_pasos_no", type="string", length=255, nullable=false)
     */
    private $habilitarPasosNo;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;


}

