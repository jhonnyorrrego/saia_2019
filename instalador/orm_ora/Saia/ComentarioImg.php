<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComentarioImg
 *
 * @ORM\Table(name="COMENTARIO_IMG")
 * @ORM\Entity
 */
class ComentarioImg
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCOMENTARIO_IMG", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="COMENTARIO_IMG_IDCOMENTARIO_IM", allocationSize=1, initialValue=1)
     */
    private $idcomentarioImg;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=4000, nullable=true)
     */
    private $tipo = 'PAGINA';

    /**
     * @var integer
     *
     * @ORM\Column(name="PAGINA", type="integer", nullable=true)
     */
    private $pagina = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="COMENTARIO", type="text", nullable=true)
     */
    private $comentario;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSX", type="integer", nullable=true)
     */
    private $posx = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="POSY", type="integer", nullable=true)
     */
    private $posy = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="FUNCIONARIO", type="string", length=255, nullable=true)
     */
    private $funcionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;


}
