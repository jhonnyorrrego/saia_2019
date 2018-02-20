<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reemplazo
 *
 * @ORM\Table(name="REEMPLAZO", indexes={@ORM\Index(name="i_reemplazo_nuevo", columns={"NUEVO"}), @ORM\Index(name="i_reemplazo_cargo_nuevo", columns={"CARGO_NUEVO"}), @ORM\Index(name="i_reemplazo_antiguo", columns={"ANTIGUO"})})
 * @ORM\Entity
 */
class Reemplazo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREEMPLAZO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REEMPLAZO_IDREEMPLAZO_seq", allocationSize=1, initialValue=1)
     */
    private $idreemplazo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANTIGUO", type="integer", nullable=false)
     */
    private $antiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="NUEVO", type="integer", nullable=false)
     */
    private $nuevo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIO", type="date", nullable=false)
     */
    private $fechaInicio = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FIN", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="CARGO_NUEVO", type="integer", nullable=false)
     */
    private $cargoNuevo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVO", type="string", length=1, nullable=false)
     */
    private $activo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS_TEXTO", type="text", nullable=true)
     */
    private $camposTexto;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPOS_NUMERO", type="text", nullable=true)
     */
    private $camposNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ORDENAMIENTO", type="string", length=4, nullable=true)
     */
    private $tipoOrdenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_ORDENAMIENTO", type="string", length=255, nullable=true)
     */
    private $campoOrdenamiento;


}
