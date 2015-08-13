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

if (@$sExport == "") { ?>
	</td>
</tr>
</table>
<?php } 

if(!isset($_SESSION["LOGIN".LLAVE_SAIA]) && basename($_SERVER["PHP_SELF"])<>"login.php")
   salir("La sesión ha expirado, por favor ingrese de nuevo.");
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/title2note.js"></script>
<?php //include("fin_cargando.php");?>
</div>
</body>
</html>
