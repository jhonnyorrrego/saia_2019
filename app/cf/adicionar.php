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

$Response = (object) array(
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

            $datosBusqueda = GenerarFormatoController::getFieldsFromTable($_REQUEST["table"]);

            $fields = array();
            $dateFields = array();

            foreach ($datosBusqueda as $key => $value) {
                $column = $value->getName();
                $type = $value->getType()->getName();

                if (in_array(strtolower($column), array_keys($_REQUEST))) {
                    if (strpos(strtolower($type), 'date') === true) {
                        $dateFields[] = $column;
                        $_REQUEST[$column] = DateController::convertDate($_REQUEST[$key], "Y-m-d", "Y-m-d");
                    } else if ($type == \Doctrine\DBAL\Types\Type::STRING) {
                        $_REQUEST[$column] = "" . $_REQUEST[$column] . "";
                        $fields[] = $column;
                    } else {
                        $fields[] = $column;
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
            if (!empty($id)) {
                $updateFields = [];
                $params = [];

                $query = Model::getQueryBuilder();
                $sql = $query->update($table);

                for ($i = 0; $i < count($columns); $i++) {
                    $sql = $query->set($columns[$i], '?');
                }

                $sql = $query->where("id" . $table . " = " . $id);

                for ($i = 0; $i < count($columns); $i++) {
                    $sql = $query->setParameter($i, $values[$i]);
                }

                $sql = $query->execute();
                $Response->message = "Datos actualizados";
                $Response->success = 1;
            } else {
                $valuesInsert = [];
                $params = [];
                for ($i = 0; $i < count($columns); $i++) {
                    $valuesInsert[] = [$columns[$i] => '?'];
                }
                $query = Model::getQueryBuilder();
                $sql = $query->insert($table);

                for ($i = 0; $i < count($columns); $i++) {
                    $sql = $query->setValue($columns[$i], '?');
                }

                for ($i = 0; $i < count($columns); $i++) {
                    $sql = $query->setParameter($i, $values[$i]);
                }

                if ($sql->execute()) {
                    $Response->message = "Registro creado";
                    $Response->success = 1;
                } else {
                    $Response->message = "No fue posible crear el registro";
                }
            }
        } else {
            $Response->message = "No se ha definido la tabla";
        }
    } else {
        $Response->message = "Debe iniciar sesion";
    }
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}
echo json_encode($Response);
