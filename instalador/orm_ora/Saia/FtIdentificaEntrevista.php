<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtIdentificaEntrevista
 *
 * @ORM\Table(name="FT_IDENTIFICA_ENTREVISTA", indexes={@ORM\Index(name="ft_identifica_entrevista_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_identifica_e", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtIdentificaEntrevista
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '24';

    /**
     * @var integer
     *
     * @ORM\Column(name="PREGUNTA_1", type="integer", nullable=false)
     */
    private $pregunta1;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_IDENTIFICA_ENTREVISTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_IDENTIFICA_ENTREVISTA_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftIdentificaEntrevista;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_1", type="string", length=255, nullable=true)
     */
    private $otroPregunta1;

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
     * @var \DateTime
     *
     * @ORM\Column(name="PREGUNTA_2", type="date", nullable=false)
     */
    private $pregunta2 = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_3", type="string", length=255, nullable=false)
     */
    private $pregunta3;

    /**
     * @var integer
     *
     * @ORM\Column(name="PREGUNTA_4", type="integer", nullable=false)
     */
    private $pregunta4;

    /**
     * @var integer
     *
     * @ORM\Column(name="PREGUNTA_5", type="integer", nullable=false)
     */
    private $pregunta5;

    /**
     * @var integer
     *
     * @ORM\Column(name="PREGUNTA_6", type="integer", nullable=true)
     */
    private $pregunta6;

    /**
     * @var string
     *
     * @ORM\Column(name="PREGUNTA_7", type="string", length=255, nullable=false)
     */
    private $pregunta7;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_4", type="string", length=255, nullable=true)
     */
    private $otroPregunta4;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PREGUNTA_5", type="string", length=255, nullable=true)
     */
    private $otroPregunta5;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

