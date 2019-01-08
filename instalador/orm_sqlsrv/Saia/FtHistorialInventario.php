<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtHistorialInventario
 *
 * @ORM\Table(name="ft_historial_inventario")
 * @ORM\Entity
 */
class FtHistorialInventario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_historial_inventario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftHistorialInventario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_registro_activos_fijos", type="integer", nullable=false)
     */
    private $ftRegistroActivosFijos;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}

