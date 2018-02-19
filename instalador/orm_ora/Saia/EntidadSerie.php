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
     * @var string
     *
     * @ORM\Column(name="IDENTIDAD_SERIE", type="decimal", precision=11, scale=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENTIDAD_SERIE_IDENTIDAD_SERIE_", allocationSize=1, initialValue=1)
     */
    private $identidadSerie;

    /**
     * @var string
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="decimal", precision=11, scale=3, nullable=true)
     */
    private $entidadIdentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="decimal", precision=11, scale=3, nullable=true)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="decimal", precision=11, scale=3, nullable=true)
     */
    private $llaveEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=1, nullable=true)
     */
    private $tipo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';


}

