<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Certificado
 *
 * @ORM\Table(name="certificado", indexes={@ORM\Index(name="i_certificado_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Certificado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcertificado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="CERTIFICADO_IDCERTIFICADO_seq", allocationSize=1, initialValue=1)
     */
    private $idcertificado;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=50, nullable=false)
     */
    private $ciudad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_certificado", type="date", nullable=false)
     */
    private $fechaCertificado;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=100, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="despedida", type="string", length=20, nullable=false)
     */
    private $despedida;

    /**
     * @var string
     *
     * @ORM\Column(name="firma", type="string", length=1, nullable=false)
     */
    private $firma = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado", type="string", length=1, nullable=false)
     */
    private $encabezado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_firma", type="text", nullable=true)
     */
    private $cargoFirma;


}

