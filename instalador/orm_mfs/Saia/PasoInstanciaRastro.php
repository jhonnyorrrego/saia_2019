<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoInstanciaRastro
 *
 * @ORM\Table(name="paso_instancia_rastro")
 * @ORM\Entity
 */
class PasoInstanciaRastro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_instancia_rastro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpasoInstanciaRastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="instancia_idpaso_instancia", type="integer", nullable=false)
     */
    private $instanciaIdpasoInstancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_original", type="integer", nullable=false)
     */
    private $estadoOriginal;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_final", type="integer", nullable=false)
     */
    private $estadoFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cambio", type="datetime", nullable=false)
     */
    private $fechaCambio;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_idpaso_documento", type="integer", nullable=false)
     */
    private $documentoIdpasoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="inst_idpaso_inst", type="integer", nullable=false)
     */
    private $instIdpasoInst;


}

