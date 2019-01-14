<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtActividadesContrato
 *
 * @ORM\Table(name="ft_actividades_contrato")
 * @ORM\Entity
 */
class FtActividadesContrato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_actividades_contrato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftActividadesContrato;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

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
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="etapa", type="string", length=255, nullable=false)
     */
    private $etapa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion_tarea", type="date", nullable=false)
     */
    private $fechaCreacionTarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_limite", type="date", nullable=false)
     */
    private $fechaLimite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_real", type="date", nullable=false)
     */
    private $fechaReal;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_identifica_contrato", type="integer", nullable=false)
     */
    private $ftIdentificaContrato;

    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado", type="integer", nullable=true)
     */
    private $idtareasListado;

    /**
     * @var string
     *
     * @ORM\Column(name="plazo_maximo", type="string", length=255, nullable=false)
     */
    private $plazoMaximo;

    /**
     * @var integer
     *
     * @ORM\Column(name="requiere_recordatori", type="integer", nullable=false)
     */
    private $requiereRecordatori;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_activida", type="string", length=255, nullable=false)
     */
    private $responsableActivida;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2629';

    /**
     * @var string
     *
     * @ORM\Column(name="supervisor_actividad", type="string", length=255, nullable=true)
     */
    private $supervisorActividad;


}

