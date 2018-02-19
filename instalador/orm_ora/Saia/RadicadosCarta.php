<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * RadicadosCarta
 *
 * @ORM\Table(name="RADICADOS_CARTA")
 * @ORM\Entity
 */
class RadicadosCarta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDRADICADOS_CARTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="RADICADOS_CARTA_IDRADICADOS_CA", allocationSize=1, initialValue=1)
     */
    private $idradicadosCarta;

    /**
     * @var integer
     *
     * @ORM\Column(name="DESTINO", type="integer", nullable=false)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="RADICADO", type="integer", nullable=false)
     */
    private $radicado;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;


}

