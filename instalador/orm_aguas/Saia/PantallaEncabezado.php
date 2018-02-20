<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaEncabezado
 *
 * @ORM\Table(name="PANTALLA_ENCABEZADO")
 * @ORM\Entity
 */
class PantallaEncabezado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDBPMNI", type="integer", nullable=true)
     */
    private $fkIdbpmni = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDBPMN_TAREA", type="integer", nullable=true)
     */
    private $fkIdbpmnTarea = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ENCABEZADO", type="string", length=255, nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="PIE", type="string", length=255, nullable=false)
     */
    private $pie;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_ENCABEZADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_ENCABEZADO_IDPANTALLA", allocationSize=1, initialValue=1)
     */
    private $idpantallaEncabezado;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDPANTALLA", type="integer", nullable=false)
     */
    private $fkIdpantalla;


}
