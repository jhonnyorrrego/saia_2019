<?php

namespace Saia;

/**
 * AnexosDespacho
 */
class AnexosDespacho
{
    /**
     * @var integer
     */
    private $idanexosDespacho;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var integer
     */
    private $fkIdsalidas;


    /**
     * Get idanexosDespacho
     *
     * @return integer
     */
    public function getIdanexosDespacho()
    {
        return $this->idanexosDespacho;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return AnexosDespacho
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
     * Set ruta
     *
     * @param string $ruta
     *
     * @return AnexosDespacho
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return AnexosDespacho
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return AnexosDespacho
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set fkIdsalidas
     *
     * @param integer $fkIdsalidas
     *
     * @return AnexosDespacho
     */
    public function setFkIdsalidas($fkIdsalidas)
    {
        $this->fkIdsalidas = $fkIdsalidas;

        return $this;
    }

    /**
     * Get fkIdsalidas
     *
     * @return integer
     */
    public function getFkIdsalidas()
    {
        return $this->fkIdsalidas;
    }
}

