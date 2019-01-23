<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTransferenciaDoc
 *
 * @ORM\Table(name="ft_transferencia_doc")
 * @ORM\Entity
 */
class FtTransferenciaDoc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_transferencia_doc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftTransferenciaDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1196';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="expediente_vinculado", type="string", length=255, nullable=false)
     */
    private $expedienteVinculado;

    /**
     * @var string
     *
     * @ORM\Column(name="oficina_productora", type="string", length=255, nullable=false)
     */
    private $oficinaProductora;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="entregado_por", type="string", length=255, nullable=false)
     */
    private $entregadoPor;

    /**
     * @var string
     *
     * @ORM\Column(name="recibido_por", type="string", length=255, nullable=false)
     */
    private $recibidoPor;

    /**
     * @var integer
     *
     * @ORM\Column(name="transferir_a", type="integer", nullable=false)
     */
    private $transferirA;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';


}