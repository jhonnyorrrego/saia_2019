<?php

use \Doctrine\DBAL\Types\Type;

class TRDVersionController
{
    protected $dependencies;
    protected $series;
    protected $subSeries;
    protected $documentaryTypes;
    protected $trdData;
    protected $clasificationData;
    protected $idSerieVersion;

    function __construct($idSerieVersion)
    {
        $this->dependencies = [];
        $this->series = [];
        $this->subSeries = [];
        $this->documentaryTypes = [];
        $this->idSerieVersion = $idSerieVersion;

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
        $this->dependencies = Dependencia::findAllByAttributes([], [], 'codigo asc');
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
        $QueryBuilder = Model::getQueryBuilder()
            ->select(
                'a.idserie,
                a.nombre,
                a.codigo,
                a.retencion_gestion,
                a.retencion_central,
                a.procedimiento,               
                a.dis_eliminacion,
                a.dis_conservacion,
                a.dis_seleccion,
                a.dis_microfilma'
            )
            ->from('serie', 'a')
            ->innerJoin('a', 'dependencia_serie', 'b', 'b.fk_serie = a.idserie')
            ->where('a.tipo = 1')
            ->andWhere('b.fk_dependencia = :iddependencia')
            ->andWhere('a.fk_serie_version = :idserie_version')
            ->setParameter(':iddependencia', $dependencieId, Type::INTEGER)
            ->setParameter(':idserie_version', $this->idSerieVersion, Type::INTEGER);

        $this->series = Serie::findByQueryBuilder($QueryBuilder);
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
        $QueryBuilder = Model::getQueryBuilder()
            ->select(
                'a.idserie,
                a.nombre,
                a.codigo,
                a.retencion_gestion,
                a.retencion_central,
                a.procedimiento,                
                a.dis_eliminacion,
                a.dis_conservacion,
                a.dis_seleccion,
                a.dis_microfilma'
            )
            ->from('serie', 'a')
            ->innerJoin('a', 'dependencia_serie', 'b', 'b.fk_serie = a.idserie')
            ->where('a.tipo = 2')
            ->andWhere('b.fk_dependencia =:iddependencia')
            ->andWhere('a.cod_padre =:idserie')
            ->andWhere('a.fk_serie_version=:idserie_version')
            ->setParameter(':iddependencia', $dependencieId, Type::INTEGER)
            ->setParameter(':idserie', $serieId, Type::INTEGER)
            ->setParameter(':idserie_version', $this->idSerieVersion, Type::INTEGER);

        $this->subSeries = Serie::findByQueryBuilder($QueryBuilder);
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
        $QueryBuilder = Model::getQueryBuilder()
            ->select(
                'a.idserie,
                a.nombre,
                a.sop_papel,
                a.sop_electronico'
            )
            ->from('serie', 'a')
            ->where('a.tipo = 3')
            ->andWhere('a.cod_padre =:idserie')
            ->andWhere('a.fk_serie_version=:idserie_version')
            ->setParameter(':idserie', $serieId, Type::INTEGER)
            ->setParameter(':idserie_version', $this->idSerieVersion, Type::INTEGER);

        $this->documentaryTypes = Serie::findByQueryBuilder($QueryBuilder);
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
            'iddependencia' => $Dependencia->getPK(),
            'idserie' => $Serie->getPK(),
            'idsubserie' => $subSerie ? $subSerie->getPK() : '',
            'idtipo' => $documentaryType->getPK(),
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
            'iddependencia' => $Dependencia->getPK(),
            'idserie' => $Serie->getPK(),
            'idsubserie' => $subSerie ? $subSerie->getPK() : '',
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
     * @return string
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
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-06
     */
    public function getClasificationData()
    {
        return json_encode($this->clasificationData);
    }

    /**
     * Guarda en un archivo temporal los datos
     * utilizado para el cache
     *
     * @return void
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public function saveCache()
    {
        $rutaClasi = self::getRouteFileTemporal('json_clasificacion');
        file_put_contents($rutaClasi, $this->getClasificationData());

        $rutaTrd = self::getRouteFileTemporal('json_trd');
        file_put_contents($rutaTrd, $this->getTrdData());
    }

    /**
     * obtiene la ubicacion fisica de los archivos 
     * temporales generados
     *
     * @param string $field : json_trd, json_clasificacion
     * @return string
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function getRouteFileTemporal($field)
    {
        global $ruta_db_superior;

        $dir = $ruta_db_superior . TemporalController::$saiaDir;

        if (!file_exists($dir)) {
            if (!mkdir($dir, PERMISOS_CARPETAS, TRUE)) {
                return false;
            }
        }

        if ($field == 'json_clasificacion') {
            $fileName = "/currentVersionClasificacion.txt";
        } else {
            $fileName = "/currentVersionTRD.txt";
        }
        return $dir . $fileName;
    }
    /**
     * Elimina los archivos temporales 
     * 
     *
     * @return void
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function removeTemporalFile()
    {
        $rutaClasi = self::getRouteFileTemporal('json_clasificacion');
        unlink($rutaClasi);

        $rutaTrd = self::getRouteFileTemporal('json_trd');
        unlink($rutaTrd);
    }
}
