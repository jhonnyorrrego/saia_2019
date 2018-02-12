<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RcmailSystem
 *
 * @ORM\Table(name="rcmail_system")
 * @ORM\Entity
 */
class RcmailSystem
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=16777215, nullable=true)
     */
    private $value;



    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return RcmailSystem
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
