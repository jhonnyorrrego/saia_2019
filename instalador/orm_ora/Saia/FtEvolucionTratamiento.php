<?php

namespace Saia;

/**
 * FtEvolucionTratamiento
 */
class FtEvolucionTratamiento
{
    /**
     * @var integer
     */
    private $idftEvolucionTratamiento;

    /**
     * @var integer
     */
    private $ftDiagnosticoTratamiento;

    /**
     * @var \DateTime
     */
    private $fechaEvolucion;

    /**
     * @var string
     */
    private $procedimientoEvolucion;

    /**
     * @var string
     */
    private $firmaPaciente;

    /**
     * @var string
     */
    private $firmaProfesional;

    /**
     * @var integer
     */
    private $abonoEvoluciones;

    /**
     * @var integer
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

