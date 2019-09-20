<?php

use \Doctrine\DBAL\Types\Type;

trait TSerie
{
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
            ->setParameter(':idserie', $this->idserie, 'integer')
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
        $data = $QueryBuilder->execute()->fetch();;

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
}
