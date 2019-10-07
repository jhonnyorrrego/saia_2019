<?php

use \Doctrine\DBAL\Types\Type;

trait TSerie
{
    public $classSerieDependencia;
    public $classSerie;


    /**
     * Valida si una serie quedaria huerfana si no existiera una serie
     * Util para el mover y eliminar
     *
     * @return boolean
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public function willBeOrphan(): bool
    {
        if ($this->tipo != 1) {

            $query = $this->getQueryBuilder()
                ->select('idserie')
                ->from($this->getTable())
                ->where('tipo=:tipo')
                ->andWhere('cod_padre=:cod_padre')
                ->andWhere('idserie <> :idserie')
                ->setParameters(
                    [
                        ':tipo' => $this->tipo,
                        ':cod_padre' => $this->cod_padre,
                        ':idserie' => $this->getPK()
                    ],
                    [
                        ':tipo', Type::INTEGER,
                        ':cod_padre', Type::INTEGER,
                        ':idserie', Type::INTEGER
                    ]
                );
            return $query->execute()->fetch() ? false : true;
        }

        return false;
    }

    /**
     * Retorna un array con los hijos directos de la 
     * serie
     *
     * @return array
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public function getDirectChildren(): array
    {
        $queryBuilder = $this->getQueryBuilder()
            ->select('*')
            ->from($this->getTable())
            ->where('cod_padre = :idserie')
            ->orderBy('tipo', 'ASC')
            ->setParameter(':idserie', $this->getPK(), Type::INTEGER);

        return self::findByQueryBuilder($queryBuilder);
    }

    /**
     * Retorna array con todos los hijos
     * de la serie
     *
     * @return array
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public function getAllChildren(): array
    {
        $queryBuilder = $this->getQueryBuilder()
            ->select('*')
            ->from($this->getTable())
            ->where('cod_arbol like :cod_arbol')
            ->orderBy('tipo', 'ASC')
            ->setParameter(':cod_arbol', $this->cod_arbol . '.%', Type::STRING);

        return self::findByQueryBuilder($queryBuilder);
    }

    /**
     * Actualiza el cod_arbol despues de crear la serie
     * Este metodo omite serie_log 
     * 
     * @return void
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    private function updateCodArbol()
    {
        $codArbol = $this->idserie;
        $padre = $this->getCodArbolPadre();
        if ($padre) {
            $codArbol = $padre . '.' . $this->idserie;
        }
        $this->cod_arbol = $codArbol;

        self::executeUpdate(['cod_arbol' => $codArbol], ['idserie' => $this->idserie]);
    }


    /**
     * obtiene el cod_arbol de la serie padre
     * util para no instanciar la serie padre,
     * Si desea instancia la serie padre utilizar getCodPadre()
     *
     * @return mixed
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    private function getCodArbolPadre()
    {
        $data = self::getQueryBuilder()
            ->select('sp.cod_arbol')
            ->from($this->getTable(), 's')
            ->innerJoin('s', $this->getTable(), 'sp', 's.cod_padre=sp.idserie')
            ->where('s.idserie=:idserie')
            ->setParameter(':idserie', $this->idserie, Type::INTEGER)
            ->execute()->fetch();

        return $data['cod_arbol'] ?? false;
    }

    /**
     * valida si tiene series hijas
     *
     * @param integer $tipo : utlizado en el where, tipo de la consulta
     * @return boolean
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function hasChild(int $tipo = null): bool
    {
        $QueryBuilder = $this->getQueryBuilder();

        $data = $QueryBuilder
            ->select('count(idserie) as cant')
            ->from($this->getTable())
            ->where("cod_arbol like :cod_arbol")
            ->setParameter(':cod_arbol', $this->cod_arbol . '.%');

        if (!is_null($tipo)) {
            $QueryBuilder->andWhere('tipo=:tipo')
                ->setParameter(':tipo', $tipo, Type::INTEGER);
        }

        $data = $QueryBuilder->execute()->fetch();

        return $data['cant'] ? true : false;
    }


    /**
     * retorna la instancia de la serie padre
     *
     * @return Serie|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getCodPadre()
    {
        if ($this->cod_padre) {
            if (!$this->seriePadre) {
                $this->seriePadre = new self($this->cod_padre);
            }
        } else {
            $this->seriePadre = null;
        }
        return $this->seriePadre;
    }

    /**
     * retorna las instancias o el id de serie_dependencia 
     * vinculadas a la serie
     *
     * @param int $instance : 1, retorna las instancias; 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getSerieDependenciaFk(int $instance = 1)
    {
        if ($instance) {
            $data = $this->classSerieDependencia::findAllByAttributes(
                ['fk_serie' => $this->getPK()]
            );
        } else {
            $data = $this->classSerieDependencia::findColumn(
                'idserie_dependencia',
                ['fk_serie' => $this->getPK()]
            );
        }
        return $data;
    }

    /**
     * Obtiene la etiqueta del tipo de serie
     *
     * @param integer $tipo
     * @return string
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function getLabelTipo(int $tipo): string
    {
        $array = [
            1 => 'Serie',
            2 => 'Subserie',
            3 => 'Tipo documental'
        ];
        return $array[$tipo];
    }
}
