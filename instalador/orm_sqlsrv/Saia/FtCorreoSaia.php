<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCorreoSaia
 *
 * @ORM\Table(name="ft_correo_saia", indexes={@ORM\Index(name="i_ft_correo_saia_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtCorreoSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_correo_saia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCorreoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1210';

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="de", type="string", length=255, nullable=false)
     */
    private $de;

    /**
     * @var string
     *
     * @ORM\Column(name="para", type="text", length=65535, nullable=false)
     */
    private $para;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="text", length=65535, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_oficio_entrada", type="datetime", nullable=false)
     */
    private $fechaOficioEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=255, nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=255, nullable=true)
     */
    private $comentario;

    /**
     * @var integer
     *
     * @ORM\Column(name="transferencia_correo", type="integer", nullable=true)
     */
    private $transferenciaCorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="copia_correo", type="string", length=255, nullable=true)
     */
    private $copiaCorreo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';


}
