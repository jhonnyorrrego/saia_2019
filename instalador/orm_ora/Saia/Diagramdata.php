<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagramdata
 *
 * @ORM\Table(name="diagramdata")
 * @ORM\Entity
 */
class Diagramdata
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $diagramid;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var integer
     */
    private $filesize;

    /**
     * @var \DateTime
     */
    private $lastupdate;


    /**
     * Set type
     *
     * @param string $type
     *
     * @return Diagramdata
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set diagramid
     *
     * @param integer $diagramid
     *
     * @return Diagramdata
     */
    public function setDiagramid($diagramid)
    {
        $this->diagramid = $diagramid;

        return $this;
    }

    /**
     * Get diagramid
     *
     * @return integer
     */
    public function getDiagramid()
    {
        return $this->diagramid;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Diagramdata
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filesize
     *
     * @param integer $filesize
     *
     * @return Diagramdata
     */
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * Get filesize
     *
     * @return integer
     */
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * Set lastupdate
     *
     * @param \DateTime $lastupdate
     *
     * @return Diagramdata
     */
    public function setLastupdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }

    /**
     * Get lastupdate
     *
     * @return \DateTime
     */
    public function getLastupdate()
    {
        return $this->lastupdate;
    }
}

