<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadSerie
 *
 * @ORM\Table(name="ENTIDAD_SERIE")
 * @ORM\Entity
 */
class EntidadSerie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENTIDAD_SERIE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENTIDAD_SERIE_IDENTIDAD_SERIE_", allocationSize=1, initialValue=1)
     */
    private $identidadSerie;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="integer", nullable=false)
     */
    private $llaveEntidad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=1, nullable=false)
     */
    private $tipo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;


}
