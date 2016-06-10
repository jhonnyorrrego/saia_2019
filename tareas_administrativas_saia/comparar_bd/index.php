<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
  $ruta_db_superior=$ruta="";
  while($max_salida>0)
  {
  if(is_file($ruta."db.php"))
  {
  $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
  }

include_once("db.php");
include_once($ruta_db_superior."librerias_saia.php");
usuario_actual("login");
echo(estilo_bootstrap());
?>
<html>
<div class="container">
	<div class="page-header">
       <h1>Comparaci&oacute;n Bases de Datos</h1>
    </div>
    <form method="POST" action="comparacion_bases_datos.php">
        <div class="form-group">
            <label for="inputhost1">Host 1</label>
            <input type="text" class="form-control"  name="host1" placeholder="Host">
        </div>
        <div class="form-group">
            <label for="inputuser1">Usuario 1</label>
            <input type="text" class="form-control"  name="user1" placeholder="Usuario">
        </div>
        <div class="form-group">
            <label for="inputclave1">Contraseña 1</label>
            <input type="password" class="form-control" name="clave1" placeholder="Clave">
        </div>
        <div class="form-group">
            <label for="inputinstancia1">Instancia 1</label>
            <input type="text" class="form-control"  name="instancia1" placeholder="Instancia">
        </div>
        <div class="form-group">
            <label for="inputmotor1">Motor base de datos 1</label>
            <select class="form-control" name="motor1">
            	<option value="MySql">MySQL</option>
            	<option value="Oracle">Oracle</option>
            	<option>MSSql</option>
            	<option>SqlServe</option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputpuerto1">Puerto 1</label>
            <input type="text" class="form-control"  name="puerto1" placeholder="Puerto">
        </div>
        <div class="form-group">
            <label for="inputbd1">Base de datos 1</label>
            <input type="text" class="form-control"  name="bd1" placeholder="Base de datos">
        </div>
        <div class="form-group">
            <label for="inputtablespace1">Tablespace 1</label>
            <input type="text" class="form-control"  name="tablespace1" placeholder="Tablespace">
        </div>
        <div class="form-group">
        	<label><h2>SE COMPARA CONTRA</h2></label>
        </div>
        <div class="form-group">
            <label for="inputhost2">Host 2</label>
            <input type="text" class="form-control"  name="host2" placeholder="Host">
        </div>
        <div class="form-group">
            <label for="inputuser2">Usuario 2</label>
            <input type="text" class="form-control"  name="user2" placeholder="Usuario">
        </div>
        <div class="form-group">
            <label for="inputclave2">Contraseña 2</label>
            <input type="password" class="form-control" name="clave2" placeholder="Clave">
        </div>
        <div class="form-group">
            <label for="inputinstancia2">Instancia 1</label>
            <input type="text" class="form-control"  name="instancia2" placeholder="Instancia">
        </div>
        <div class="form-group">
            <label for="inputmotor2">Motor base de datos 1</label>
            <select class="form-control" name="motor2">
            	<option value="MySql">MySQL</option>
            	<option value="Oracle">Oracle</option>
            	<option>MSSql</option>
            	<option>SqlServe</option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputpuerto2">Puerto 2</label>
            <input type="text" class="form-control"  name="puerto2" placeholder="Puerto">
        </div>
        <div class="form-group">
            <label for="inputbd2">Base de datos 2</label>
            <input type="text" class="form-control"  name="bd2" placeholder="Base de datos">
        </div>
        <div class="form-group">
            <label for="inputtablespace2">Tablespace 2</label>
            <input type="text" class="form-control"  name="tablespace2" placeholder="Tablespace">
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
</html>