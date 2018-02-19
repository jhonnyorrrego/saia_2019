<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteDoc
 *
 * @ORM\Table(name="EXPEDIENTE_DOC")
 * @ORM\Entity
 */
class ExpedienteDoc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDEXPEDIENTE_DOC", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="EXPEDIENTE_DOC_IDEXPEDIENTE_DO", allocationSize=1, initialValue=1)
     */
    private $idexpedienteDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXPEDIENTE_IDEXPEDIENTE", type="integer", nullable=true)
     */
    private $expedienteIdexpediente = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';


}
