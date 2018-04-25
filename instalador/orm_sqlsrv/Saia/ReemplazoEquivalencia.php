<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoEquivalencia
 *
 * @ORM\Table(name="reemplazo_equivalencia", indexes={@ORM\Index(name="i_reemplazo_equivalen_llave_enti", columns={"llave_entidad_destino"})})
 * @ORM\Entity
 */
class ReemplazoEquivalencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_equivalencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreemplazoEquivalencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad_origen", type="integer", nullable=false)
     */
    private $llaveEntidadOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad_destino", type="integer", nullable=false)
     */
    private $llaveEntidadDestino;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idreemplazo_saia", type="integer", nullable=false)
     */
    private $fkIdreemplazoSaia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin_rol", type="date", nullable=true)
     */
    private $fechaFinRol;


}
