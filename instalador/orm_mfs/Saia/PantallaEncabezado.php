<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaEncabezado
 *
 * @ORM\Table(name="pantalla_encabezado", indexes={@ORM\Index(name="fk_pantalla_encabezado_pantalla1_idx", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaEncabezado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_encabezado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaEncabezado;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idbpmni", type="integer", nullable=true)
     */
    private $fkIdbpmni = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idbpmn_tarea", type="integer", nullable=true)
     */
    private $fkIdbpmnTarea = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado", type="string", length=255, nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="pie", type="string", length=255, nullable=false)
     */
    private $pie;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}

