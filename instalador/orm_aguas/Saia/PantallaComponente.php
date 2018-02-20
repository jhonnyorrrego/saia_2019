<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaComponente
 *
 * @ORM\Table(name="PANTALLA_COMPONENTE", indexes={@ORM\Index(name="i_pantalla_c_opciones_ctx", columns={"OPCIONES"}), @ORM\Index(name="i_pantalla_c_librerias_ctx", columns={"LIBRERIAS"})})
 * @ORM\Entity
 */
class PantallaComponente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_COMPONENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_COMPONENTE_IDPANTALLA", allocationSize=1, initialValue=1)
     */
    private $idpantallaComponente;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="CLASE", type="string", length=255, nullable=false)
     */
    private $clase;

    /**
     * @var string
     *
     * @ORM\Column(name="COMPONENTE", type="text", nullable=false)
     */
    private $componente;

    /**
     * @var string
     *
     * @ORM\Column(name="OPCIONES", type="text", nullable=false)
     */
    private $opciones;

    /**
     * @var string
     *
     * @ORM\Column(name="PROCESAR", type="string", length=255, nullable=true)
     */
    private $procesar;

    /**
     * @var string
     *
     * @ORM\Column(name="CATEGORIA", type="string", length=255, nullable=false)
     */
    private $categoria = 'I';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="LIBRERIAS", type="text", nullable=true)
     */
    private $librerias;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_COMPONENTE", type="integer", nullable=false)
     */
    private $tipoComponente = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ELIMINAR", type="string", length=255, nullable=false)
     */
    private $eliminar;


}
