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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."header.php");
?>
<br><br><b>VERSIONES DEL DOCUMENTO</b><br /><br />
<?php
/*<Clase>
<Nombre></Nombre>
<Parametros>$_REQUEST["key"]: id del documento</Parametros>
<Responsabilidades>Imprime una tabla con los datos de cada version creada del documento y un link para descargar los archivos<Responsabilidades>
<Notas></Notas>
<Excepciones></Excepciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>  */
$versiones=busca_filtro_tabla("","documento_version","documento_iddocumento=".$_REQUEST["key"],"",$conn);
if($versiones["numcampos"])
{
echo "<table border=1 style='border-collapse:collapse' width='50%'><tr class='encabezado_list'><td>Version</td><td>Funcionario</td><td>Fecha</td><td>Archivos</td></tr>";
for($i=0;$i<$versiones["numcampos"];$i++)
  {if(is_file("../../versiones/".$_REQUEST["key"]."/archivos_version".$versiones[$i]["version"].".zip"))
     {$func=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$versiones[$i]["funcionario"],"",$conn);
      echo "<tr >
          <td>".$versiones[$i]["version"]."</td>
          <td>".ucwords($func[0]["nombres"]." ".$func[0]["apellidos"])."</td>
          <td>".$versiones[$i]["fecha"]."</td>
          <td><a href='../../versiones/".$_REQUEST["key"]."/archivos_version".$versiones[$i]["version"].".zip?rnd=".rand(0,100)."'>Descargar</a></td>
          </tr>";
     }     
  }
echo "</table>";  
}
include_once($ruta_db_superior."footer.php");
?>