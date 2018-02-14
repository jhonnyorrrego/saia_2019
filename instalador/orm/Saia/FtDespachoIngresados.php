<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDespachoIngresados
 *
 * @ORM\Table(name="ft_despacho_ingresados", indexes={@ORM\Index(name="i_ft_despacho_ingresados_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtDespachoIngresados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_despacho_ingresados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDespachoIngresados;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1215';

    /**
     * @var integer
     *
     * @ORM\Column(name="mensajero", type="integer", nullable=false)
     */
    private $mensajero;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_entrega", type="string", length=255, nullable=true)
     */
    private $fechaEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="iddestino_radicacion", type="string", length=255, nullable=false)
     */
    private $iddestinoRadicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="docs_seleccionados", type="string", length=255, nullable=true)
     */
    private $docsSeleccionados;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_recorrido", type="integer", nullable=false)
     */
    private $tipoRecorrido;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_mensajero", type="string", length=255, nullable=true)
     */
    private $tipoMensajero = '0';



    /**
     * Get idftDespachoIngresados
     *
     * @return integer
     */
    public function getIdftDespachoIngresados()
    {
        return $this->idftDespachoIngresados;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDespachoIngresados
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set mensajero
     *
     * @param integer $mensajero
     *
     * @return FtDespachoIngresados
     */
    public function setMensajero($mensajero)
    {
        $this->mensajero = $mensajero;

        return $this;
    }

    /**
     * Get mensajero
     *
     * @return integer
     */
    public function getMensajero()
    {
        return $this->mensajero;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDespachoIngresados
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtDespachoIngresados
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtDespachoIngresados
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return integer
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtDespachoIngresados
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set fechaEntrega
     *
     * @param string $fechaEntrega
     *
     * @return FtDespachoIngresados
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return string
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtDespachoIngresados
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set iddestinoRadicacion
     *
     * @param string $iddestinoRadicacion
     *
     * @return FtDespachoIngresados
     */
    public function setIddestinoRadicacion($iddestinoRadicacion)
    {
        $this->iddestinoRadicacion = $iddestinoRadicacion;

        return $this;
    }

    /**
     * Get iddestinoRadicacion
     *
     * @return string
     */
    public function getIddestinoRadicacion()
    {
        return $this->iddestinoRadicacion;
    }

    /**
     * Set anexo
     *
     * @param string $anexo
     *
     * @return FtDespachoIngresados
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;

        return $this;
    }

    /**
     * Get anexo
     *
     * @return string
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * Set docsSeleccionados
     *
     * @param string $docsSeleccionados
     *
     * @return FtDespachoIngresados
     */
    public function setDocsSeleccionados($docsSeleccionados)
    {
        $this->docsSeleccionados = $docsSeleccionados;

        return $this;
    }

    /**
     * Get docsSeleccionados
     *
     * @return string
     */
    public function getDocsSeleccionados()
    {
        return $this->docsSeleccionados;
    }

    /**
     * Set tipoRecorrido
     *
     * @param integer $tipoRecorrido
     *
     * @return FtDespachoIngresados
     */
    public function setTipoRecorrido($tipoRecorrido)
    {
        $this->tipoRecorrido = $tipoRecorrido;

        return $this;
    }

    /**
     * Get tipoRecorrido
     *
     * @return integer
     */
    public function getTipoRecorrido()
    {
        return $this->tipoRecorrido;
    }

    /**
     * Set tipoMensajero
     *
     * @param string $tipoMensajero
     *
     * @return FtDespachoIngresados
     */
    public function setTipoMensajero($tipoMensajero)
    {
        $this->tipoMensajero = $tipoMensajero;

        return $this;
    }

    /**
     * Get tipoMensajero
     *
     * @return string
     */
    public function getTipoMensajero()
    {
        return $this->tipoMensajero;
    }
}
