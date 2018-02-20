<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reemplazo
 *
 * @ORM\Table(name="reemplazo", indexes={@ORM\Index(name="i_reemplazo_nuevo", columns={"nuevo"}), @ORM\Index(name="i_reemplazo_cargo_nuevo", columns={"cargo_nuevo"}), @ORM\Index(name="i_reemplazo_antiguo", columns={"antiguo"})})
 * @ORM\Entity
 */
class Reemplazo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreemplazo;

    /**
     * @var integer
     *
     * @ORM\Column(name="antiguo", type="integer", nullable=false)
     */
    private $antiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nuevo", type="integer", nullable=false)
     */
    private $nuevo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="cargo_nuevo", type="integer", nullable=false)
     */
    private $cargoNuevo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="activo", type="string", length=1, nullable=false)
     */
    private $activo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="campos_texto", type="text", nullable=true)
     */
    private $camposTexto;

    /**
     * @var string
     *
     * @ORM\Column(name="campos_numero", type="text", nullable=true)
     */
    private $camposNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_ordenamiento", type="string", length=4, nullable=true)
     */
    private $tipoOrdenamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_ordenamiento", type="string", length=255, nullable=true)
     */
    private $campoOrdenamiento;


}
