<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemEndeudamiento
 *
 * @ORM\Table(name="ft_item_endeudamiento")
 * @ORM\Entity
 */
class FtItemEndeudamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_endeudamiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemEndeudamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="cuota_credito", type="integer", nullable=false)
     */
    private $cuotaCredito;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad", type="integer", nullable=false)
     */
    private $entidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_validacion_tramite", type="integer", nullable=false)
     */
    private $ftValidacionTramite;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_prestamos", type="integer", nullable=false)
     */
    private $numPrestamos;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_endeuda", type="string", length=255, nullable=false)
     */
    private $valorEndeuda;


}

