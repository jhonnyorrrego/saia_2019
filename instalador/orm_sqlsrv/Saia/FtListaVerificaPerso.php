<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtListaVerificaPerso
 *
 * @ORM\Table(name="ft_lista_verifica_perso")
 * @ORM\Entity
 */
class FtListaVerificaPerso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_lista_verifica_perso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftListaVerificaPerso;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos_usuario_sol", type="string", length=255, nullable=false)
     */
    private $apellidosUsuarioSol;

    /**
     * @var integer
     *
     * @ORM\Column(name="creacion_usuario", type="integer", nullable=false)
     */
    private $creacionUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_finalizacion", type="date", nullable=false)
     */
    private $fechaFinalizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=false)
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_personal", type="integer", nullable=false)
     */
    private $ftSolicitudPersonal;

    /**
     * @var string
     *
     * @ORM\Column(name="login_usuario_sol", type="string", length=255, nullable=false)
     */
    private $loginUsuarioSol;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres_usuario_sol", type="string", length=255, nullable=false)
     */
    private $nombresUsuarioSol;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_identificacion", type="string", length=255, nullable=false)
     */
    private $numeroIdentificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1194';


}

