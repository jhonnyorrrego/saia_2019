<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtOficioWord
 *
 * @ORM\Table(name="ft_oficio_word", indexes={@ORM\Index(name="i_ft_oficio_word_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtOficioWord
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_oficio_word", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftOficioWord;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1332';

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_word", type="string", length=255, nullable=false)
     */
    private $anexoWord;

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
     * @ORM\Column(name="anexo_csv", type="string", length=255, nullable=true)
     */
    private $anexoCsv;


}

