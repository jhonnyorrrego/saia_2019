<?php
session_start();

if(isset($_SESSION['idfuncionario'], $_SESSION['idsesion_php'])){
    header("Location: views/dashboard/dashboard.php");
}else{
    header("Location: views/login/login.php");
}

exit();
