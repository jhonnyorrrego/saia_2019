<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAsignaVerificaDatos
 *
 * @ORM\Table(name="FT_ASIGNA_VERIFICA_DATOS", indexes={@ORM\Index(name="ft_asigna_verifica_datos_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtAsignaVerificaDatos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RECEPCION_ACUERDOS", type="integer", nullable=false)
     */
    private $ftRecepcionAcuerdos;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '4';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ASIGNACION", type="date", nullable=false)
     */
    private $fechaAsignacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO_ASIGNADO", type="string", length=255, nullable=false)
     */
    private $funcionarioAsignado;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ASIGNA_VERIFICA_DATOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ASIGNA_VERIFICA_DATOS_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftAsignaVerificaDatos;

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

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RECEP_TERRITO_ACUERDO", type="integer", nullable=false)
     */
    private $ftRecepTerritoAcuerdo;


}

