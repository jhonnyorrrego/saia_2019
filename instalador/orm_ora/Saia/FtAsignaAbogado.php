<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAsignaAbogado
 *
 * @ORM\Table(name="FT_ASIGNA_ABOGADO", indexes={@ORM\Index(name="i_asigna_aboga", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtAsignaAbogado
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ASIGNACION", type="date", nullable=false)
     */
    private $fechaAsignacion = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="ABOGADO_ASIGNADO", type="integer", nullable=false)
     */
    private $abogadoAsignado;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_REPORTE_PROCESO_ATIPI", type="integer", nullable=false)
     */
    private $ftReporteProcesoAtipi;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '741';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ASIGNA_ABOGADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ASIGNA_ABOGADO_IDFT_ASIGNA_", allocationSize=1, initialValue=1)
     */
    private $idftAsignaAbogado;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma = '1';


}

