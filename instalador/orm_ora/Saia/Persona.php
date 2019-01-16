<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity
 */
class Persona
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre1", type="string", length=100, nullable=true)
     */
    private $nombre1;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre2", type="string", length=100, nullable=true)
     */
    private $nombre2;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido1", type="string", length=100, nullable=true)
     */
    private $apellido1;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido2", type="string", length=100, nullable=true)
     */
    private $apellido2;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_identidad", type="string", length=20, nullable=true)
     */
    private $documentoIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="idpersona", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="PERSONA_IDPERSONA_seq", allocationSize=1, initialValue=1)
     */
    private $idpersona;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_documento", type="string", length=10, nullable=true)
     */
    private $tipoDocumento;


}

