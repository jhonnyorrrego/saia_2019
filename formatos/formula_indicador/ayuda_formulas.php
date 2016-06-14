<?php
include_once("../librerias/estilo_formulario.php");
?>
<b>CREACI&Oacute;N DE F&Oacute;RMULAS</b><br><br>
<b>Signos permitidos</b><br>
<table>
<tr><td>Multiplicaci&oacute;n</td><td>*</td></tr>
<tr><td>Divisi&oacute;n</td><td>/</td></tr>
<tr><td>Suma</td><td>+</td></tr>
<tr><td>Resta</td><td>-</td></tr>
</table>
<br><b>Nombres de variables</b>
<ul>
<li>Los nombres de variables deben empezar siempre por una letra
</li>
<li>pueden contener guion bajo(_)
</li>
<li>
si se va a utilizar un numero <b>NO</b> debe ir al principio de la palabra, ya que esto causaria errores en el resultado
</li>
</ul>
<br><b>Reglas generales</b>
<ul>
<li>Se pueden usar los parentesis para crear agrupaciones en la f&oacute;rmula
</li>
<li>No se deben usar espacios en blanco
</li>
<li>No se deben usar otros caracteres como =,?,~,#,%,!,etc
</li>
<li>No se deben usar la letra x como simbolo para la multiplicaci&oacute;n
</li>
</ul>
<br><b>Ejemplos</b>
<ul>
<li>(a+b*c)-(512/prueba_variable2)  <font color ="green">CORRECTO</font>
</li>
<li>(a+b*c)-(512/prueba variable2)  <font color ="RED">INCORRECTO</font>
</li>
<li>(a+bxc)-(512/prueba_variable2)  <font color ="GREEN">CORRECTO SI LA VARIABLE SE LLAMARA BXC</font>  <font color ="RED">INCORRECTO SI LA X ES SIMBOLO DE MULTIPLICACION</font>
</li>
<li>(a+b*c)-(512/15prueba_variable)  <font color ="red">INCORRECTO. AUNQUE EL LINK DE VALIDACION NO SAQUE ERROR, SI EL VALOR DE prueba_variable FUERA 2 LA FORMULA QUEDARIA (A+B*C)-(512/152) PRODUCIENDO UN RESULTADO INCORRECTO</font>
</li>
</ul>