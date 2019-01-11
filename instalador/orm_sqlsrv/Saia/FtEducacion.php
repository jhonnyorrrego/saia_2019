<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEducacion
 *
 * @ORM\Table(name="ft_educacion")
 * @ORM\Entity
 */
class FtEducacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_educacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftEducacion;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio_titulo", type="integer", nullable=false)
     */
    private $anioTitulo;

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
     * @ORM\Column(name="entidad_educativa", type="string", length=255, nullable=false)
     */
    private $entidadEducativa;

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
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel_estudio", type="string", length=255, nullable=false)
     */
    private $nivelEstudio;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1026';

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_obtenido", type="string", length=255, nullable=false)
     */
    private $tituloObtenido;


}

