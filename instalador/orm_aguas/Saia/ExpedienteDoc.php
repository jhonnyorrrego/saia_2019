<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedienteDoc
 *
 * @ORM\Table(name="expediente_doc", indexes={@ORM\Index(name="i_expediente_doc_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class ExpedienteDoc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idexpediente_doc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idexpedienteDoc;

    /**
     * @var integer
     *
     * @ORM\Column(name="expediente_idexpediente", type="integer", nullable=false)
     */
    private $expedienteIdexpediente = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';


}
