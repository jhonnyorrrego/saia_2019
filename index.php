<?php
session_start();

if(isset($_SESSION['idfuncionario'])){
    header("Location: views/dashboard/dashboard.php");
}else{
    header("Location: views/login/login.php");
}

exit();
