<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtActaEntregaCertifi
 *
 * @ORM\Table(name="FT_ACTA_ENTREGA_CERTIFI", indexes={@ORM\Index(name="ft_acta_entrega_certifi_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_acta_entrega", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_notifica_resolucion", columns={"FT_NOTIFICA_RESOLUCION"})})
 * @ORM\Entity
 */
class FtActaEntregaCertifi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_NOTIFICA_RESOLUCION", type="integer", nullable=false)
     */
    private $ftNotificaResolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '327';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ACTA_ENTREGA", type="date", nullable=false)
     */
    private $fechaActaEntrega = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="ACTA_ENTREGA_FIRMADA", type="string", length=255, nullable=true)
     */
    private $actaEntregaFirmada;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ACTA_ENTREGA_CERTIFI", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ACTA_ENTREGA_CERTIFI_IDFT_A", allocationSize=1, initialValue=1)
     */
    private $idftActaEntregaCertifi;

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
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

