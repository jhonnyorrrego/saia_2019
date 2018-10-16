<?php
session_start();

$data = isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key'];
echo json_encode(array(
        'data' => $data,
        'success' => 1,
    )
);
