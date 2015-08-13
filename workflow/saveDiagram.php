<?php
/* This page is used for both logged users and outsiders to */
require_once('common/settings.php');



if (!isset($_SESSION)) {
    session_start();
}

require_once('common/rememberme.php');

//guardian
#require_once dirname(__FILE__).'/common/guardian.php';
//TODO: use guardian instead
if (!isset($_SESSION['userId'])) {
    echo "Sic";
    exit();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>      
        <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
        <link href="./assets/css/style.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript">
            /**Trims a string
             *@param {String} str - the string to trim
             *@return {String} the trimmed string
             **/
            function trim(str){
                var res = str.replace(/^\s+/, '');
                res = res.replace(/\s+$/, '');
                
                return res;
            }
            
            function validateForm(){
                var title = document.getElementById('title');

                if(trim(title.value).length == 0){
                    alert('El nombre no puede ser vacio');
                    return false;
                }
                else{
                    document.getElementById('formulario_flujo').submit();
                    return true;
                }
                
            }
        </script>
    </head>
    <body  style="background-color: transparent; position:absolute">
<?php 
include_once("../formatos/librerias/estilo_formulario.php");
require_once('common/messages.php'); 
?>
<form style="position: relative; height: 270px;" action="./common/controller.php" method="post" id="formulario_flujo">
    <input type="hidden" name="action" value="firstSaveExe"/>
        <table width="80%" style="font-family:arial">
            <tr>
                <td class="encabezado"><b>Nombre</b></td>
                <td  bgcolor="#F5F5F5"> <input class="formField" type="text" name="title" id="title" size="40"/></td>
            </tr>
            <tr>
              <td class="encabezado">    
                <b>Descripcion (Opcional)</b>
              </td>
              <td  bgcolor="#F5F5F5">
                <textarea name="description" style="left: 0; right: 0; width: 253px; height: 75px;" class="formField"></textarea> 
                <input type="hidden" name="publico" value="true">
              </td>
            </tr>
            <tr>
              <td colspan="2"  bgcolor="#F5F5F5">
                  <input onclick="return validateForm();" type="button"  value="Guardar"/>
              </td>
            </tr>
        </table>
</form>
</body>
</html>

