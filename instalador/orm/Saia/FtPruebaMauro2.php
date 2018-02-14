<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPruebaMauro2
 *
 * @ORM\Table(name="ft_prueba_mauro2")
 * @ORM\Entity
 */
class FtPruebaMauro2
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_prueba_mauro2", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPruebaMauro2;

    /**
     * @var integer
     *
     * @ORM\Column(name="usuarios", type="integer", nullable=false)
     */
    private $usuarios;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="string", length=255, nullable=false)
     */
    private $texto;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

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
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '6';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_prueba_mauro1", type="integer", nullable=false)
     */
    private $ftPruebaMauro1;



    /**
     * Get idftPruebaMauro2
     *
     * @return integer
     */
    public function getIdftPruebaMauro2()
    {
        return $this->idftPruebaMauro2;
    }

    /**
     * Set usuarios
     *
     * @param integer $usuarios
     *
     * @return FtPruebaMauro2
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    /**
     * Get usuarios
     *
     * @return integer
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtPruebaMauro2
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
     * Set texto
     *
     * @param string $texto
     *
     * @return FtPruebaMauro2
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtPruebaMauro2
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtPruebaMauro2
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPruebaMauro2
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaMauro2
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
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtPruebaMauro2
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set ftPruebaMauro1
     *
     * @param integer $ftPruebaMauro1
     *
     * @return FtPruebaMauro2
     */
    public function setFtPruebaMauro1($ftPruebaMauro1)
    {
        $this->ftPruebaMauro1 = $ftPruebaMauro1;

        return $this;
    }

    /**
     * Get ftPruebaMauro1
     *
     * @return integer
     */
    public function getFtPruebaMauro1()
    {
        return $this->ftPruebaMauro1;
    }
}
