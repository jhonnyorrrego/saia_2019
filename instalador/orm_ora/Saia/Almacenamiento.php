<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Almacenamiento
 *
 * @ORM\Table(name="almacenamiento", indexes={@ORM\Index(name="i_almacenamien_responsable", columns={"responsable"}), @ORM\Index(name="i_almacenamiento_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Almacenamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idalmacenamiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ALMACENAMIENTO_IDALMACENAMIENT", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="registro_entrada", type="date", nullable=false)
     */
    private $registroEntrada = 'SYSDATE';


}
