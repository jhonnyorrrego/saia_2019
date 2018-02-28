<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEvolucionTratamiento
 *
 * @ORM\Table(name="ft_evolucion_tratamiento", indexes={@ORM\Index(name="i_evolucion_tratamien_diagnostic", columns={"ft_diagnostico_tratamiento"}), @ORM\Index(name="i_evolucion_tratamien_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtEvolucionTratamiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_evolucion_tratamiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftEvolucionTratamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_diagnostico_tratamiento", type="integer", nullable=false)
     */
    private $ftDiagnosticoTratamiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_evolucion", type="datetime", nullable=false)
     */
    private $fechaEvolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="procedimiento_evolucion", type="text", length=65535, nullable=false)
     */
    private $procedimientoEvolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_paciente", type="string", length=255, nullable=true)
     */
    private $firmaPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="firma_profesional", type="string", length=255, nullable=true)
     */
    private $firmaProfesional;

    /**
     * @var integer
     *
     * @ORM\Column(name="abono_evoluciones", type="integer", nullable=true)
     */
    private $abonoEvoluciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;



    /**
     * Get idftEvolucionTratamiento
     *
     * @return integer
     */
    public function getIdftEvolucionTratamiento()
    {
        return $this->idftEvolucionTratamiento;
    }

    /**
     * Set ftDiagnosticoTratamiento
     *
     * @param integer $ftDiagnosticoTratamiento
     *
     * @return FtEvolucionTratamiento
     */
    public function setFtDiagnosticoTratamiento($ftDiagnosticoTratamiento)
    {
        $this->ftDiagnosticoTratamiento = $ftDiagnosticoTratamiento;

        return $this;
    }

    /**
     * Get ftDiagnosticoTratamiento
     *
     * @return integer
     */
    public function getFtDiagnosticoTratamiento()
    {
        return $this->ftDiagnosticoTratamiento;
    }

    /**
     * Set fechaEvolucion
     *
     * @param \DateTime $fechaEvolucion
     *
     * @return FtEvolucionTratamiento
     */
    public function setFechaEvolucion($fechaEvolucion)
    {
        $this->fechaEvolucion = $fechaEvolucion;

        return $this;
    }

    /**
     * Get fechaEvolucion
     *
     * @return \DateTime
     */
    public function getFechaEvolucion()
    {
        return $this->fechaEvolucion;
    }

    /**
     * Set procedimientoEvolucion
     *
     * @param string $procedimientoEvolucion
     *
     * @return FtEvolucionTratamiento
     */
    public function setProcedimientoEvolucion($procedimientoEvolucion)
    {
        $this->procedimientoEvolucion = $procedimientoEvolucion;

        return $this;
    }

    /**
     * Get procedimientoEvolucion
     *
     * @return string
     */
    public function getProcedimientoEvolucion()
    {
        return $this->procedimientoEvolucion;
    }

    /**
     * Set firmaPaciente
     *
     * @param string $firmaPaciente
     *
     * @return FtEvolucionTratamiento
     */
    public function setFirmaPaciente($firmaPaciente)
    {
        $this->firmaPaciente = $firmaPaciente;

        return $this;
    }

    /**
     * Get firmaPaciente
     *
     * @return string
     */
    public function getFirmaPaciente()
    {
        return $this->firmaPaciente;
    }

    /**
     * Set firmaProfesional
     *
     * @param string $firmaProfesional
     *
     * @return FtEvolucionTratamiento
     */
    public function setFirmaProfesional($firmaProfesional)
    {
        $this->firmaProfesional = $firmaProfesional;

        return $this;
    }

    /**
     * Get firmaProfesional
     *
     * @return string
     */
    public function getFirmaProfesional()
    {
        return $this->firmaProfesional;
    }

    /**
     * Set abonoEvoluciones
     *
     * @param integer $abonoEvoluciones
     *
     * @return FtEvolucionTratamiento
     */
    public function setAbonoEvoluciones($abonoEvoluciones)
    {
        $this->abonoEvoluciones = $abonoEvoluciones;

        return $this;
    }

    /**
     * Get abonoEvoluciones
     *
     * @return integer
     */
    public function getAbonoEvoluciones()
    {
        return $this->abonoEvoluciones;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtEvolucionTratamiento
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
}
