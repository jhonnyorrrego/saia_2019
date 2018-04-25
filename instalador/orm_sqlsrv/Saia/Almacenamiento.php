<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Almacenamiento
 *
 * @ORM\Table(name="almacenamiento", indexes={@ORM\Index(name="i_almacenamiento_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Almacenamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idalmacenamiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idalmacenamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="folder_idfolder", type="integer", nullable=false)
     */
    private $folderIdfolder = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="soporte", type="string", length=255, nullable=true)
     */
    private $soporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_folios", type="integer", nullable=true)
     */
    private $numFolios;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="deterioro", type="string", length=255, nullable=true)
     */
    private $deterioro;

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=false)
     */
    private $responsable = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registro_entrada", type="datetime", nullable=false)
     */
    private $registroEntrada;



    /**
     * Get idalmacenamiento
     *
     * @return integer
     */
    public function getIdalmacenamiento()
    {
        return $this->idalmacenamiento;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return Almacenamiento
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
     * Set folderIdfolder
     *
     * @param integer $folderIdfolder
     *
     * @return Almacenamiento
     */
    public function setFolderIdfolder($folderIdfolder)
    {
        $this->folderIdfolder = $folderIdfolder;

        return $this;
    }

    /**
     * Get folderIdfolder
     *
     * @return integer
     */
    public function getFolderIdfolder()
    {
        return $this->folderIdfolder;
    }

    /**
     * Set soporte
     *
     * @param string $soporte
     *
     * @return Almacenamiento
     */
    public function setSoporte($soporte)
    {
        $this->soporte = $soporte;

        return $this;
    }

    /**
     * Get soporte
     *
     * @return string
     */
    public function getSoporte()
    {
        return $this->soporte;
    }

    /**
     * Set numFolios
     *
     * @param integer $numFolios
     *
     * @return Almacenamiento
     */
    public function setNumFolios($numFolios)
    {
        $this->numFolios = $numFolios;

        return $this;
    }

    /**
     * Get numFolios
     *
     * @return integer
     */
    public function getNumFolios()
    {
        return $this->numFolios;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return Almacenamiento
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set deterioro
     *
     * @param string $deterioro
     *
     * @return Almacenamiento
     */
    public function setDeterioro($deterioro)
    {
        $this->deterioro = $deterioro;

        return $this;
    }

    /**
     * Get deterioro
     *
     * @return string
     */
    public function getDeterioro()
    {
        return $this->deterioro;
    }

    /**
     * Set responsable
     *
     * @param integer $responsable
     *
     * @return Almacenamiento
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return integer
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set registroEntrada
     *
     * @param \DateTime $registroEntrada
     *
     * @return Almacenamiento
     */
    public function setRegistroEntrada($registroEntrada)
    {
        $this->registroEntrada = $registroEntrada;

        return $this;
    }

    /**
     * Get registroEntrada
     *
     * @return \DateTime
     */
    public function getRegistroEntrada()
    {
        return $this->registroEntrada;
    }
}
