<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Almacenamiento
 *
 * @ORM\Table(name="ALMACENAMIENTO")
 * @ORM\Entity
 */
class Almacenamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDALMACENAMIENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ALMACENAMIENTO_IDALMACENAMIENT", allocationSize=1, initialValue=1)
     */
    private $idalmacenamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FOLDER_IDFOLDER", type="integer", nullable=true)
     */
    private $folderIdfolder = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="SOPORTE", type="string", length=255, nullable=true)
     */
    private $soporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUM_FOLIOS", type="integer", nullable=true)
     */
    private $numFolios;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="DETERIORO", type="string", length=255, nullable=true)
     */
    private $deterioro;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESPONSABLE", type="integer", nullable=true)
     */
    private $responsable = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="REGISTRO_ENTRADA", type="date", nullable=true)
     */
    private $registroEntrada = 'TO_DATE(\'01-01-70 00:00:00\', \'dd-mm-yy hh24:mi:ss\')';


}

