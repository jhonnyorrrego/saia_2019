<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoEquivalencia
 *
 * @ORM\Table(name="REEMPLAZO_EQUIVALENCIA", indexes={@ORM\Index(name="i_reemplazo_eq_llave_entida", columns={"LLAVE_ENTIDAD_ORIGEN"})})
 * @ORM\Entity
 */
class ReemplazoEquivalencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREEMPLAZO_EQUIVALENCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REEMPLAZO_EQUIVALENCIA_IDREEMP", allocationSize=1, initialValue=1)
     */
    private $idreemplazoEquivalencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD_ORIGEN", type="integer", nullable=false)
     */
    private $llaveEntidadOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD_DESTINO", type="integer", nullable=false)
     */
    private $llaveEntidadDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDREEMPLAZO_SAIA", type="integer", nullable=false)
     */
    private $fkIdreemplazoSaia;


}
