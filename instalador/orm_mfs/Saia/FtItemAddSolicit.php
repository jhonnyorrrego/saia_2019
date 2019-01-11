<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemAddSolicit
 *
 * @ORM\Table(name="ft_item_add_solicit")
 * @ORM\Entity
 */
class FtItemAddSolicit
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_add_solicit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemAddSolicit;

    /**
     * @var string
     *
     * @ORM\Column(name="amortizacion", type="text", length=65535, nullable=false)
     */
    private $amortizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_validacion_tramite", type="integer", nullable=false)
     */
    private $ftValidacionTramite;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="text", length=65535, nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_solicitud", type="integer", nullable=false)
     */
    private $tipoSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=false)
     */
    private $valor;


}

