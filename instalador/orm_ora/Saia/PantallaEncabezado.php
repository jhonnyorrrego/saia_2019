<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaEncabezado
 *
 * @ORM\Table(name="pantalla_encabezado", indexes={@ORM\Index(name="i_pantalla_encab_fk_pant", columns={"fk_idpantalla"})})
 * @ORM\Entity
 */
class PantallaEncabezado
{
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
     * @ORM\Column(name="idpantalla_encabezado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_ENCABEZADO_IDPANTALLA", allocationSize=1, initialValue=1)
     */
    private $idpantallaEncabezado;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}
