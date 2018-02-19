<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEntornoFamiliar
 *
 * @ORM\Table(name="FT_ENTORNO_FAMILIAR", indexes={@ORM\Index(name="ft_entorno_familiar_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_entorno_fami", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtEntornoFamiliar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '85';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ENTORNO_FAMILIAR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ENTORNO_FAMILIAR_IDFT_ENTOR", allocationSize=1, initialValue=1)
     */
    private $idftEntornoFamiliar;

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
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XXIV_VIVIACON", type="integer", nullable=false)
     */
    private $preXxivViviacon;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XXV_INGRESOS", type="integer", nullable=false)
     */
    private $preXxvIngresos;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XXVI_VICTIMA", type="integer", nullable=false)
     */
    private $preXxviVictima;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXVII_CAMPOITEM", type="string", length=255, nullable=true)
     */
    private $preXxviiCampoitem;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XXIV_VIVIACON", type="string", length=255, nullable=true)
     */
    private $otroPreXxivViviacon;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_PRUEBA_ITEM", type="string", length=255, nullable=true)
     */
    private $campoPruebaItem;

    /**
     * @var string
     *
     * @ORM\Column(name="CAMPO_ITEM", type="string", length=255, nullable=true)
     */
    private $campoItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

