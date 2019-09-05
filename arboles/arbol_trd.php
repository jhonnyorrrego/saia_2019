<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}
include_once $ruta_db_superior . "core/autoload.php";

$objetoJson = array("key" => 0);

$hijos = array();
$objetoJson['key'] = 0;
$hijos_dep = array();
$hijos_dep = llena_dependencia(0, $partes);

if (!empty($hijos_dep)) {
    $hijos = $hijos_dep;
}

$hijos_serie = array();
$objetoJson['children'] = $hijos;

header('Content-Type: application/json');
echo json_encode($objetoJson);

function llena_dependencia($id)
{
    $objetoJson = array();

    if ($id == 0) {

        $dataDep = Dependencia::getQueryBuilder()
            ->select('iddependencia,codigo,nombre,estado')
            ->from('dependencia')
            ->where('cod_padre=0 or cod_padre is null')
            ->orderBy('nombre', 'ASC')
            ->execute()->fetchAll();
    } else {

        $dataDep = Dependencia::getQueryBuilder()
            ->select('iddependencia,sigla,codigo,nombre,estado')
            ->from('dependencia')
            ->where('cod_padre=:id')
            ->orderBy('nombre', 'ASC')
            ->setParameter(':id', $id, 'integer')
            ->execute()->fetchAll();
    }
    if (!empty($dataDep)) {

        foreach ($dataDep as $data) {

            $hijosDep = [];
            $cantHijosDep = Dependencia::getQueryBuilder()
                ->select('count(*) as cant')
                ->from('dependencia')
                ->where('cod_padre=:id')
                ->setParameter(':id', $data['iddependencia'], 'integer')
                ->execute()->fetch();

            if ($cantHijosDep['cant']) {
                $hijosDep = llena_dependencia($data['iddependencia']);
            }

            $hijosSerie = [];
            $cantHijosSerie = DependenciaSerie::getQueryBuilder()
                ->select('count(*) as cant')
                ->from('dependencia_serie')
                ->where('estado=1 and fk_dependencia=:iddependencia')
                ->setParameter(':iddependencia', $data['iddependencia'], 'integer')
                ->execute()->fetch();

            if ($cantHijosSerie['cant']) {
                $hijosSerie = llena_serie(0, $data['iddependencia']);
            }

            $dataHijos = array_merge($hijosDep, $hijosSerie);

            $text = "{$data['nombre']} ({$data['sigla']} {$data['codigo']})";
            if ($data['estado'] == 0) {
                $text .= " - INACTIVO";
            }

            $item = [
                'key' => "{$data['iddependencia']}.0",
                'title' => $text,
                'extraClasses' => 'estilo-dependencia'
            ];

            if (!empty($dataHijos)) {
                $item['children'] = $dataHijos;
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

function llena_serie($id, $iddep)
{
    global $conn;
    $objetoJson = array();

    if ($id == 0) {

        $QueryBuilder = DependenciaSerie::getQueryBuilder();
        $data = $QueryBuilder
            ->select('*')
            ->from('dependencia_serie', 'ds')
            ->innerJoin('ds', 'serie', 's', 's.idserie=ds.fk_serie')
            ->where('ds.estado=1 and ds.fk_dependencia=:iddependencia')
            ->andWhere(
                $QueryBuilder->expr()->orX(
                    "s.cod_padre is null",
                    "s.cod_padre=0"
                )
            )
            ->orderBy('s.nombre', 'ASC')
            ->setParameter(':iddependencia', $iddep, 'integer')
            ->execute()->fetchAll();

        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die('--');
    } else {
        $data = busca_filtro_tabla("e.identidad_serie,s.*", "entidad_serie e,serie s", "e.fk_serie=s.idserie and e.fk_dependencia=" . $iddep . " and s.cod_padre=" . $id . " and s.categoria=2 and e.estado=1", "s.nombre ASC", $conn);
    }
    if ($data['numcampos']) {
        for ($i = 0; $i < $data['numcampos']; $i++) {
            $identidad_serie = $data['identidad_serie'];
            $text = $data['nombre'] . " (" . $data['codigo'] . ")";
            if ($data['estado'] == 0) {
                $text .= " - INACTIVO";
            }
            $item = array();
            $item['extraClasses'] = "estilo-serie";
            $item['title'] = $text;
            $item['key'] = $iddep . "." . $data['idserie'];

            $item['data'] = array("entidad_serie" => $identidad_serie);
            $hijos = busca_filtro_tabla("count(*) as cant", "serie", " cod_padre=" . $data['idserie'] . " and categoria=2", "", $conn);
            if ($hijos[0]['cant']) {
                $item['children'] = llena_serie($data['idserie'], $iddep);
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}

function llena_serie_sin_asignar($id)
{
    global $conn;
    $objetoJson = array();

    if ($id == 0) {
        $data = busca_filtro_tabla("", "serie", "(cod_padre=0 or cod_padre is null) and categoria=2", "nombre ASC", $conn);
    } else {
        $data = busca_filtro_tabla("", "serie", "cod_padre=" . $id . " and categoria=2", "nombre ASC", $conn);
    }
    if ($data['numcampos']) {
        for ($i = 0; $i < $data['numcampos']; $i++) {
            $text = $data['nombre'] . " (" . $data['codigo'] . ")";
            if ($data['estado'] == 0) {
                $text .= " - INACTIVO";
            }
            $item = array();
            $asig = busca_filtro_tabla("count(*) as cant", "entidad_serie", "estado=1 and fk_serie=" . $data['idserie'], "", $conn);
            $style = "estilo-serie";
            if ($asig[0]['cant'] == 0 && $data['tipo'] != 3) {
                $style = "estilo-serie-sa";
            }

            $item['extraClasses'] = $style;
            $item['title'] = $text;
            $item['key'] = "0." . $data['idserie'];

            $hijos = busca_filtro_tabla("count(*) as cant", "serie", "cod_padre=" . $data['idserie'] . " and categoria=2", "", $conn);
            if ($hijos[0]['cant']) {
                $item['children'] = llena_serie_sin_asignar($data['idserie']);
            }
            $objetoJson[] = $item;
        }
    }
    return $objetoJson;
}
