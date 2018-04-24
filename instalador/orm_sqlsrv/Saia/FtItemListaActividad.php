<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemListaActividad
 *
 * @ORM\Table(name="ft_item_lista_actividad")
 * @ORM\Entity
 */
class FtItemListaActividad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_lista_actividad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemListaActividad;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcf_verificacion", type="integer", nullable=false)
     */
    private $idcfVerificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_lista_verifica_perso", type="integer", nullable=false)
     */
    private $ftListaVerificaPerso;

    /**
     * @var integer
     *
     * @ORM\Column(name="aplica", type="integer", nullable=true)
     */
    private $aplica;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}

