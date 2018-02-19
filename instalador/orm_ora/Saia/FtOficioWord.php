<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtOficioWord
 *
 * @ORM\Table(name="FT_OFICIO_WORD", indexes={@ORM\Index(name="i_oficio_word_", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtOficioWord
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_OFICIO_WORD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_OFICIO_WORD_IDFT_OFICIO_WOR", allocationSize=1, initialValue=1)
     */
    private $idftOficioWord;

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
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '681';

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXO_CSV", type="string", length=255, nullable=true)
     */
    private $anexoCsv;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXO_WORD", type="string", length=255, nullable=false)
     */
    private $anexoWord = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_DOCUMENTO", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;


}

