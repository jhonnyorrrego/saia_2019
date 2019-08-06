<?php

class TRDVersionController
{
    protected $dependencies;
    protected $series;
    protected $subSeries;
    protected $documentaryTypes;
    protected $trdData;
    protected $clasificationData;

    function __construct()
    {
        $this->dependencies = [];
        $this->series = [];
        $this->subSeries = [];
        $this->documentaryTypes = [];

        $this->generateVersion();
    }

    /**
     * genera la tabla de retencion documental y
     * clasificacion documental
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function generateVersion()
    {
        $this->findDependencies();

        foreach ($this->dependencies as $Dependencia) {
            $this->findSeries($Dependencia->getPK());

            foreach ($this->series as $Serie) {
                $this->findSubSeries($Dependencia->getPK(), $Serie->getPK());

                if ($this->subSeries) {
                    foreach ($this->subSeries as $subSerie) {
                        $this->findDocumentaryTypes($subSerie->getPK());

                        foreach ($this->documentaryTypes as $documentaryType) {
                            $this->generateRow(
                                $Dependencia,
                                $Serie,
                                $subSerie,
                                $documentaryType
                            );
                        }
                    }
                } else {
                    $this->findDocumentaryTypes($Serie->getPK());
                    foreach ($this->documentaryTypes as $documentaryType) {
                        self::generateRow(
                            $Dependencia,
                            $Serie,
                            null,
                            $documentaryType
                        );
                    }
                }
            }
        }
    }

    /**
     * busca las dependencias
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-06
     */
    public function findDependencies()
    {
        $this->dependencies = Dependencia::findAllByAttributes([], [
            'codigo',
            'sigla',
            Dependencia::getPrimaryLabel()
        ], 'codigo asc');
    }

    /**
     * busca las series activas que estan
     * vinculadas a una dependencia
     *
     * @param integer $dependencieId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-06
     */
    public function findSeries($dependencieId)
    {
        $sql = <<<SQL
            SELECT
                a.idserie,
                a.nombre,
                a.codigo,
                a.retencion_gestion,
                a.retencion_central,
                a.procedimiento,               
                a.dis_eliminacion,
                a.dis_conservacion,
                a.dis_seleccion,
                a.dis_microfilma
            FROM 
                serie a
                JOIN dependencia_serie b
                    ON b.fk_serie = a.idserie
            WHERE
                b.estado = 1 AND
                b.fk_dependencia = {$dependencieId} AND
                a.tipo = 1 AND 
                a.estado = 1
SQL;

        $this->series = Serie::findBySql($sql);
    }

    /**
     * busca las subseries activas que estan
     * vinculadas a una serie
     *
     * @param integer $dependencieId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-06
     */
    public function findSubSeries($dependencieId, $serieId)
    {
        $sql = <<<SQL
            SELECT
                a.idserie,
                a.nombre,
                a.codigo,
                a.retencion_gestion,
                a.retencion_central,
                a.procedimiento,                
                a.dis_eliminacion,
                a.dis_conservacion,
                a.dis_seleccion,
                a.dis_microfilma
            FROM 
                serie a
                JOIN dependencia_serie b
                    ON b.fk_serie = a.idserie
            WHERE
                b.estado = 1 AND
                b.fk_dependencia = {$dependencieId} AND
                a.tipo = 2 AND 
                a.estado = 1 AND
                a.cod_padre = {$serieId}
SQL;

        $this->subSeries = Serie::findBySql($sql);
    }

    /**
     * busca los tipos documentales de una serie
     *
     * @param integer $serieId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-06
     */
    public function findDocumentaryTypes($serieId)
    {
        $sql = <<<SQL
        SELECT
            a.idserie,
            a.nombre,
            a.sop_papel,
            a.sop_electronico
        FROM 
            serie a
        WHERE
            a.tipo = 3 AND 
            a.estado = 1 AND
            a.cod_padre = {$serieId}
SQL;
        $this->documentaryTypes = Serie::findBySql($sql);
    }

    /**
     * genera los registros para el json de
     * trd y clasificacion documental
     *
     * @param Dependencia $Dependencia
     * @param Serie $Serie
     * @param Serie $subSerie
     * @param Serie $documentaryType
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-06
     */
    public function generateRow(
        Dependencia $Dependencia,
        Serie $Serie,
        Serie $subSerie = null,
        Serie $documentaryType
    ) {
        $reference = $subSerie ? $subSerie : $Serie;

        $this->trdData[] = [
            'dependencia' => $Dependencia->codigo,
            'serie' => $Serie->codigo,
            'subSerie' => $subSerie ? $subSerie->codigo : '',
            'serieDocumental' => $Serie->nombre,
            'subSerieDocumental' => $subSerie ? $subSerie->nombre : '',
            'tipoDocumental' => $documentaryType->nombre,
            'gestion' => $reference->retencion_gestion,
            'central' => $reference->retencion_central,
            'p' => $documentaryType->sop_papel ? 'P' : '',
            'el' => $documentaryType->sop_electronico ? 'EL' : '',
            'e' => $reference->dis_eliminacion ? 'E' : '',
            's' => $reference->dis_seleccion ? 'S' : '',
            'ct' => $reference->dis_conservacion ? 'CT' : '',
            'md' => $reference->dis_microfilma ? 'M/D' : '',
            'procedimiento' => $reference->procedimiento
        ];
        $this->clasificationData[] = [
            'No' => count($this->clasificationData),
            'SiglaDependencia' => $Dependencia->sigla,
            'codigoDependencia' => $Dependencia->codigo,
            'CodigoSerie' => $Serie->codigo,
            'serieDocumental' => $Serie->nombre,
            'subSerie' => $subSerie ? $subSerie->codigo : '',
            'subSerieDocumental' => $subSerie ? $subSerie->nombre : ''
        ];
    }

    /**
     * obtiene la informacion de la tabla
     * de retencion codificada
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-06
     */
    public function getTrdData()
    {
        return json_encode($this->trdData);
    }

    /**
     * obtiene la informacion de la tabla de
     * clasificacion documental codificada
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-06
     */
    public function getClasificationData()
    {
        return json_encode($this->clasificationData);
    }
}
