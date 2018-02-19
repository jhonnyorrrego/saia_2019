<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * MensajeFormato
 *
 * @ORM\Table(name="MENSAJE_FORMATO")
 * @ORM\Entity
 */
class MensajeFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDMENSAJE_FORMATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="MENSAJE_FORMATO_IDMENSAJE_FORM", allocationSize=1, initialValue=1)
     */
    private $idmensajeFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO_IDFORMATO", type="integer", nullable=true)
     */
    private $formatoIdformato;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_MENSAJE", type="string", length=255, nullable=true)
     */
    private $campoMensaje;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_FORMATO", type="string", length=255, nullable=true)
     */
    private $campoFormato;


}

