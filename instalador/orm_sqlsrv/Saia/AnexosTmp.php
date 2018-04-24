<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnexosTmp
 *
 * @ORM\Table(name="anexos_tmp")
 * @ORM\Entity
 */
class AnexosTmp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idanexos_tmp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idanexosTmp;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=false)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20, nullable=true)
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_anexo", type="datetime", nullable=true)
     */
    private $fechaAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="idformato", type="integer", nullable=true)
     */
    private $idformato;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcampos_formato", type="integer", nullable=true)
     */
    private $idcamposFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;


}
