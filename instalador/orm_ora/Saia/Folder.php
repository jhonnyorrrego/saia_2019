<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Folder
 *
 * @ORM\Table(name="FOLDER")
 * @ORM\Entity
 */
class Folder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFOLDER", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FOLDER_IDFOLDER_seq", allocationSize=1, initialValue=1)
     */
    private $idfolder;

    /**
     * @var integer
     *
     * @ORM\Column(name="CAJA_IDCAJA", type="integer", nullable=true)
     */
    private $cajaIdcaja = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="TITULO", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUTOR", type="integer", nullable=true)
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="SEGURIDAD", type="string", length=255, nullable=true)
     */
    private $seguridad;


}
