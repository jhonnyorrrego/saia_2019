<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagina
 *
 * @ORM\Table(name="PAGINA")
 * @ORM\Entity
 */
class Pagina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CONSECUTIVO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PAGINA_CONSECUTIVO_seq", allocationSize=1, initialValue=1)
     */
    private $consecutivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_DOCUMENTO", type="integer", nullable=true)
     */
    private $idDocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINA", type="integer", nullable=true)
     */
    private $pagina = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDBINARIO_MIN", type="integer", nullable=true)
     */
    private $idbinarioMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDBINARIO_PAG", type="integer", nullable=true)
     */
    private $idbinarioPag;


}
