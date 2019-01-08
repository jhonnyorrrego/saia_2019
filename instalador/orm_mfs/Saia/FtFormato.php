<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFormato
 *
 * @ORM\Table(name="ft_formato")
 * @ORM\Entity
 */
class FtFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_proceso", type="integer", nullable=false)
     */
    private $ftProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="secretarias", type="string", length=255, nullable=true)
     */
    private $secretarias;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie = '1052';

    /**
     * @var integer
     *
     * @ORM\Column(name="origen_documento", type="integer", nullable=false)
     */
    private $origenDocumento = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_fisicos", type="string", length=255, nullable=true)
     */
    private $anexosFisicos;


}

