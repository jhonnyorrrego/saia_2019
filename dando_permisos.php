<?php 

//formulario();
function formulario(){
    echo "<form method='post' action='dando_permisos.php'><table>
              <tr><td>Se deben seguir los siguientes pasos:<br><br>1. Generar un archivo con informacion dentro a la carpeta raizsaia/formatos/miarchivo.txt<br>
              2. Se asignan los permisos 777<br>3. Luego se mueve el archivo a raizsaia/prueba/nuevo.txt<br><br>
              Nota:<br>1. Se debe tener en cuenta que esto se debe hacer en secuencia, es decir, primero se ejecuta el 1 luego el 2
              y finalmente el 3<br>2. En caso de que ningun paso suceda es problemas del servidor<br><br></td></tr>
              <tr><td><select name='valor'><option>-SELECCIONE-</option>
              <option value='1'>1. Crear archivo</option>
              <option value='2'>2. Dar permisos 777</option>
              <option value='3'>3. Mover el archivo</option>
              </select></td></tr>
              <tr><td><input type='submit' value='CONTINUAR'></td></tr>
          </table></form>";
}

if($_POST["valor"] != ""){
    opciones($_POST["valor"]);
}


function opciones($valor){
    switch($valor){
      case '1' :
        crear_archivo("contenido"); 
        break;
      case '2' :
        dar_permisos(0777);
        break;
      case '3' :
        moviendo_archivo("workflow/diagram/miarchivo.txt","workflow/diagrams/nuevo.txt");
    }
}


function crear_archivo($contenido){
    $fp = fopen("workflow/diagram/miarchivo.txt","a");
    fwrite($fp,$contenido);
    fclose($fp);
}
function dar_permisos($permiso){
    chmod("workflow/diagram/miarchivo.txt",$permiso);
}
function moviendo_archivo($origen,$destino){
    rename($origen,$destino);
}

$ruta = '/';
$a = chmod($ruta,0777);
echo $a;

?>