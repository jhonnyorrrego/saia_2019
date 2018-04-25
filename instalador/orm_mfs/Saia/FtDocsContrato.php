<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDocsContrato
 *
 * @ORM\Table(name="ft_docs_contrato")
 * @ORM\Entity
 */
class FtDocsContrato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_docs_contrato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDocsContrato;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_docs", type="blob", length=65535, nullable=false)
     */
    private $anexoDocs;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_doc", type="text", length=65535, nullable=false)
     */
    private $descripcionDoc;

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
     * @ORM\Column(name="estado_docs", type="string", length=255, nullable=true)
     */
    private $estadoDocs = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_docs", type="date", nullable=false)
     */
    private $fechaDocs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inactivo", type="datetime", nullable=true)
     */
    private $fechaInactivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_identifica_contrato", type="integer", nullable=false)
     */
    private $ftIdentificaContrato;

    /**
     * @var string
     *
     * @ORM\Column(name="func_inactivo", type="string", length=255, nullable=true)
     */
    private $funcInactivo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_documento", type="string", length=255, nullable=false)
     */
    private $nombreDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1355';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_documento", type="string", length=255, nullable=false)
     */
    private $tipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="vencimiento", type="string", length=255, nullable=false)
     */
    private $vencimiento = '0';


}

