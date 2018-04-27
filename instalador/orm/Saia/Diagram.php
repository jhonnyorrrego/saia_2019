<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagram
 *
 * @ORM\Table(name="diagram", uniqueConstraints={@ORM\UniqueConstraint(name="uniqueHash", columns={"hash"})}, indexes={@ORM\Index(name="diagram_pk", columns={"id"})})
 * @ORM\Entity
 */
class Diagram
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=6, nullable=false)
     */
    private $hash;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publico", type="integer", nullable=true)
     */
    private $publico = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdDate", type="datetime", nullable=false)
     */
    private $createddate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastUpdate", type="datetime", nullable=false)
     */
    private $lastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="tamano", type="integer", nullable=true)
     */
    private $tamano;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return Diagram
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Diagram
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Diagram
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set publico
     *
     * @param boolean $publico
     *
     * @return Diagram
     */
    public function setPublico($publico)
    {
        $this->publico = $publico;

        return $this;
    }

    /**
     * Get publico
     *
     * @return boolean
     */
    public function getPublico()
    {
        return $this->publico;
    }

    /**
     * Set createddate
     *
     * @param \DateTime $createddate
     *
     * @return Diagram
     */
    public function setCreateddate($createddate)
    {
        $this->createddate = $createddate;

        return $this;
    }

    /**
     * Get createddate
     *
     * @return \DateTime
     */
    public function getCreateddate()
    {
        return $this->createddate;
    }

    /**
     * Set lastupdate
     *
     * @param \DateTime $lastupdate
     *
     * @return Diagram
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

    /**
     * Set tamano
     *
     * @param integer $tamano
     *
     * @return Diagram
     */
    public function setTamano($tamano)
    {
        $this->tamano = $tamano;

        return $this;
    }

    /**
     * Get tamano
     *
     * @return integer
     */
    public function getTamano()
    {
        return $this->tamano;
    }
}
