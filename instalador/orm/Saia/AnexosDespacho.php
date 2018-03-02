<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosDespacho
 *
 * @ORM\Table(name="anexos_despacho", indexes={@ORM\Index(name="i_anexos_despacho_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class AnexosDespacho
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos_despacho", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idanexosDespacho;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idsalidas", type="integer", nullable=false)
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
