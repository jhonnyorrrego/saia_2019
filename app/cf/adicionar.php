<?php

$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}
include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
        
        unset($_REQUEST['key']);
        if (!empty($_REQUEST["table"])) {

            $id = $_REQUEST["id"];
            $table = $_REQUEST["table"];
            $datosBusqueda = StaticSql::search("describe " . $_REQUEST["table"]);
            $fields = array();
            $dateFields = array();

            for($i = 0; $i <= count($datosBusqueda); $i++){
                if(in_array(strtolower($datosBusqueda[$i]["Field"]),array_keys($_REQUEST))){
                    if(strpos(strtolower($datosBusqueda[$i]["Type"]),'date') === false){
                        if(strpos(strtolower($datosBusqueda[$i]["Type"]),'int') === false){
                            $_REQUEST[$datosBusqueda[$i]["Field"]] = "'" . $_REQUEST[$datosBusqueda[$i]["Field"]] . "'";
                        }
                        $fields[] = $datosBusqueda[$i]["Field"];
                    }else{
                        $dateFields[] = $datosBusqueda[$i]["Field"];
                        $_REQUEST[$datosBusqueda[$i]["Field"]] = StaticSql::setDateFormat($_REQUEST[$key],"Y-m-d");
                    } 
                }
            }
            
            foreach (array_keys($_REQUEST) as $key) {
                if (in_array($key, $fields) === false) {
                    if (in_array($key, $dateFields) === false) {
                        unset($_REQUEST[$key]);
                    }
                }
            }

            $columns = array_keys($_REQUEST);
            $values = array_values($_REQUEST);

            if(!empty($id)) {
                $updateFields = array();
                for ($i=0; $i < count($columns); $i ++) {
                    $updateFields[] = $columns[$i] . " = " . $values[$i];
                }
                $sql = "Update " . $table . " set " . implode(',',$updateFields). " where id" . $table . " = " . $id  ;
                StaticSql::query($sql);
                $Response->message = "Datos actualizados";
                $Response->success = 1;
            } else {                     
                $sql = "INSERT INTO " .$table . " (" . implode(',',$columns) . ") VALUES (" . implode(',',$values) . ")";
                if (StaticSql::insert($sql)){
                    $Response->message = "Registro creado";
                    $Response->success = 1;
                }else{
                    $Response->message = "No fue posible crear el registro";
                }           
            }
        }else{
            $Response->message = "No se ha definido la tabla";
        }
    } else {
        $Response->message = "Debe iniciar sesion";
    }

} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}
echo json_encode($Response);