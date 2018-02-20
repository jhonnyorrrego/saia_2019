<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoEquivalencia
 *
 * @ORM\Table(name="reemplazo_equivalencia", indexes={@ORM\Index(name="i_reemplazo_eq_llave_entida", columns={"llave_entidad_origen"})})
 * @ORM\Entity
 */
class ReemplazoEquivalencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_equivalencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
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


}
