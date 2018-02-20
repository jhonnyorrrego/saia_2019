<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="PERSONA")
 * @ORM\Entity
 */
class Persona
{
    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE1", type="string", length=100, nullable=true)
     */
    private $nombre1;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE2", type="string", length=100, nullable=true)
     */
    private $nombre2;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDO1", type="string", length=100, nullable=true)
     */
    private $apellido1;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDO2", type="string", length=100, nullable=true)
     */
    private $apellido2;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_IDENTIDAD", type="string", length=20, nullable=true)
     */
    private $documentoIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERSONA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERSONA_IDPERSONA_seq", allocationSize=1, initialValue=1)
     */
    private $idpersona;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_DOCUMENTO", type="string", length=10, nullable=true)
     */
    private $tipoDocumento;


}

