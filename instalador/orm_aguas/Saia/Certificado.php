<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Certificado
 *
 * @ORM\Table(name="CERTIFICADO", indexes={@ORM\Index(name="i_certificado_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class Certificado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCERTIFICADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CERTIFICADO_IDCERTIFICADO_seq", allocationSize=1, initialValue=1)
     */
    private $idcertificado;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD", type="string", length=50, nullable=false)
     */
    private $ciudad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CERTIFICADO", type="date", nullable=false)
     */
    private $fechaCertificado;

    /**
     * @var string
     *
     * @ORM\Column(name="DIRECCION", type="string", length=100, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="CONTENIDO", type="text", nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="DESPEDIDA", type="string", length=20, nullable=false)
     */
    private $despedida;

    /**
     * @var string
     *
     * @ORM\Column(name="FIRMA", type="string", length=1, nullable=false)
     */
    private $firma = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO", type="string", length=1, nullable=false)
     */
    private $encabezado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CARGO_FIRMA", type="text", nullable=true)
     */
    private $cargoFirma;


}

