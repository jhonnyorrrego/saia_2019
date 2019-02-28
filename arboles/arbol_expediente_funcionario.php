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
require_once $ruta_db_superior . "controllers/autoload.php";

$ExpFunc = new ExpedienteFuncionario();
$ExpFunc->setOptions($_REQUEST);
$data = $ExpFunc->llenaExpediente();

header('Content-Type: application/json');
echo json_encode($data);


class ExpedienteFuncionario
{
    public $objetoJson;
    public $idfuncionario;

    private $id;
    private $estadoArchivo;

    public function __construct($id = 0)
    {
        $this->id = $id;
        $this->idfuncionario = $_SESSION['idfuncionario'];
        $this->objetoJson = [
            'key' => $id
        ];
    }
/**
 * Setea los valores que le lleguen del request
 * para utilizarlos en la clase
 *
 * @param array $data: El request
 * @return void
 * @author Andres.Agudelo <andres.agudelo@cerok.com>
 */
    public function setOptions(array $data = [])
    {
        if (!empty($data['estado_archivo'])) {
            $this->estadoArchivo = $data['estado_archivo'];
        } else {
            $this->estadoArchivo = 1;
        }
    }

    /**
     * Crea la jerarquia de los expedientes
     *
     * @param integer $id
     * @return array
     */
    public function llenaExpediente(int $id = null):array
    {
        if ($id) {
            $this->id = $id;
        }

        $subConsulta = "SELECT DISTINCT v.idexpediente FROM vpermiso_expediente v WHERE (v.estado_archivo={$this->estadoArchivo} AND v.cod_padre={$this->id} AND (v.agrupador =1 OR fk_funcionario={$this->idfuncionario}))";
        $sql = "SELECT * FROM expediente WHERE idexpediente IN ({$subConsulta})";
        $records = Expediente::findBySql($sql, true);

        $objetoJson = [];
        if ($records) {
            foreach ($records as $Expediente) {
                $cerrado = false;
                if ($Expediente->codigo_numero) {
                    $text = $Expediente->nombre . " (" . $Expediente->codigo_numero . ")";
                } else {
                    $text = $Expediente->nombre;
                }

                if ($Expediente->estado_cierre == 2) {
                    $text .= " - CERRADO";
                    $cerrado = true;
                }

                $item = [];
                $item['title'] = $text;
                $item['key'] = $Expediente->getPK();

                $item['data'] = [
                    'idexpediente' => $item['key'],
                    'fk_serie' => $Expediente->fk_serie,
                    'fk_entidad_serie' => $Expediente->fk_entidad_serie
                ];
                
                if(!$cerrado){
                    $item["lazy"] = $Expediente->hasChild();
                    if ($item["lazy"]) {
                        $item["children"] = $this->llenaExpediente($item['key']);
                    } else if ($Expediente->agrupador == 0) {
                        $item["children"] = $this->llenaTipoDocumental($Expediente);
                    }
                }
                $objetoJson[] = $item;
            }
        }
        return $objetoJson;
    }
/**
 * Muestra los tipos documentales vinculados al expedientep
 *
 * @param Expediente $Expediente :Instancia del expediente
 * @return array
 * @author Andres.Agudelo <andres.agudelo@cerok.com>
 */
    public function llenaTipoDocumental(Expediente $Expediente):array
    {
        $sql = "SELECT * FROM serie WHERE tipo=3 AND estado=1 AND cod_padre={$Expediente->fk_serie}";
        $records = Serie::findBySql($sql, true);
        $objetoJson = [];
        if ($records) {
            foreach ($records as $Serie) {
                $item = [];

                if(PermisoSerie::hasAccessUser($Expediente->fk_dependencia,$Serie->getPK(),'a')){
                    $item['checkbox'] = true;
                    $text = $Serie->nombre;
                }else{
                    $text = $Serie->nombre.' (Sin permiso)';
                    $item['checkbox'] = false;
                }
                $item['title'] = $text;
                $item['key'] =$Serie->getPK().'-'.$Expediente->getPK();
                $item['data'] = [
                    'fk_expediente' => (int)$Expediente->getPK(),
                    'fk_serie' => (int)$Serie->getPK(),
                    'fk_entidad_serie' => (int)$Expediente->fk_entidad_serie
                ];
                $objetoJson[] = $item;
            }
        }
        return $objetoJson;
    }

}
?>