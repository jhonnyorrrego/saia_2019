<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAnalisisPqrsf
 *
 * @ORM\Table(name="ft_analisis_pqrsf", indexes={@ORM\Index(name="i_ft_analisis_pqrsf_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtAnalisisPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_analisis_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAnalisisPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_pqrsf", type="integer", nullable=false)
     */
    private $ftPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1047';

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
     * @ORM\Column(name="analisis_causas", type="string", length=255, nullable=false)
     */
    private $analisisCausas;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_causas", type="integer", nullable=false)
     */
    private $itemCausas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_clasificacion_pqrsf", type="integer", nullable=false)
     */
    private $ftClasificacionPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftAnalisisPqrsf
     *
     * @return integer
     */
    public function getIdftAnalisisPqrsf()
    {
        return $this->idftAnalisisPqrsf;
    }

    /**
     * Set ftPqrsf
     *
     * @param integer $ftPqrsf
     *
     * @return FtAnalisisPqrsf
     */
    public function setFtPqrsf($ftPqrsf)
    {
        $this->ftPqrsf = $ftPqrsf;

        return $this;
    }

    /**
     * Get ftPqrsf
     *
     * @return integer
     */
    public function getFtPqrsf()
    {
        return $this->ftPqrsf;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAnalisisPqrsf
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAnalisisPqrsf
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtAnalisisPqrsf
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtAnalisisPqrsf
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return integer
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtAnalisisPqrsf
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set analisisCausas
     *
     * @param string $analisisCausas
     *
     * @return FtAnalisisPqrsf
     */
    public function setAnalisisCausas($analisisCausas)
    {
        $this->analisisCausas = $analisisCausas;

        return $this;
    }

    /**
     * Get analisisCausas
     *
     * @return string
     */
    public function getAnalisisCausas()
    {
        return $this->analisisCausas;
    }

    /**
     * Set itemCausas
     *
     * @param integer $itemCausas
     *
     * @return FtAnalisisPqrsf
     */
    public function setItemCausas($itemCausas)
    {
        $this->itemCausas = $itemCausas;

        return $this;
    }

    /**
     * Get itemCausas
     *
     * @return integer
     */
    public function getItemCausas()
    {
        return $this->itemCausas;
    }

    /**
     * Set ftClasificacionPqrsf
     *
     * @param integer $ftClasificacionPqrsf
     *
     * @return FtAnalisisPqrsf
     */
    public function setFtClasificacionPqrsf($ftClasificacionPqrsf)
    {
        $this->ftClasificacionPqrsf = $ftClasificacionPqrsf;

        return $this;
    }

    /**
     * Get ftClasificacionPqrsf
     *
     * @return integer
     */
    public function getFtClasificacionPqrsf()
    {
        return $this->ftClasificacionPqrsf;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAnalisisPqrsf
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}
