<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPantallaPrueba
 *
 * @ORM\Table(name="ft_pantalla_prueba")
 * @ORM\Entity
 */
class FtPantallaPrueba
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_pantalla_prueba", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPantallaPrueba;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencia", type="string", length=255, nullable=false)
     */
    private $dependencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime_784162306", type="datetime", nullable=false)
     */
    private $datetime784162306;

    /**
     * @var string
     *
     * @ORM\Column(name="contador_1840892752", type="string", length=255, nullable=true)
     */
    private $contador1840892752;



    /**
     * Get idftPantallaPrueba
     *
     * @return integer
     */
    public function getIdftPantallaPrueba()
    {
        return $this->idftPantallaPrueba;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPantallaPrueba
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
     * @return FtPantallaPrueba
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
     * @param string $dependencia
     *
     * @return FtPantallaPrueba
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return string
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set datetime784162306
     *
     * @param \DateTime $datetime784162306
     *
     * @return FtPantallaPrueba
     */
    public function setDatetime784162306($datetime784162306)
    {
        $this->datetime784162306 = $datetime784162306;

        return $this;
    }

    /**
     * Get datetime784162306
     *
     * @return \DateTime
     */
    public function getDatetime784162306()
    {
        return $this->datetime784162306;
    }

    /**
     * Set contador1840892752
     *
     * @param string $contador1840892752
     *
     * @return FtPantallaPrueba
     */
    public function setContador1840892752($contador1840892752)
    {
        $this->contador1840892752 = $contador1840892752;

        return $this;
    }

    /**
     * Get contador1840892752
     *
     * @return string
     */
    public function getContador1840892752()
    {
        return $this->contador1840892752;
    }
}
