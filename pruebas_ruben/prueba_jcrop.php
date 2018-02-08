<?php
try{
    rename("../_define.php","../define.php");
}catch(Exception $e){
    file_put_contents("error.txt");
}
?>