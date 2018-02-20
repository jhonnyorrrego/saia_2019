<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Files
 *
 * @ORM\Table(name="FILES")
 * @ORM\Entity
 */
class Files
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FILES_ID_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NAME", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="TYPE", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="PATH", type="string", length=255, nullable=false)
     */
    private $path;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CREATED_AT", type="date", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UPDATED_AT", type="date", nullable=true)
     */
    private $updatedAt;


}

