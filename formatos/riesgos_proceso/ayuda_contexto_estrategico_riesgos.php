<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior.'librerias_saia.php');

echo(estilo_bootstrap());
?>



        	<div class="highslide-maincontent">
          <p style="text-align:right"><b>¿QU&Eacute; ES EL CONTEXTO EXTRAT&Eacute;GICO?</b></p>
          <p style="text-align:justify">Son las condiciones internas y del entorno, que pueden generar eventos que originan oportunidades o afectan negativamente el cumplimiento de la misi&oacute;n y objetivos de una instituci&oacute;n.</p>
          <p style="text-align:justify">Las situaciones del entorno o externas pueden ser de car&aacute;cter social, cultural, econ&oacute;mico, tecnol&oacute;gico, pol&iacute;tico y legal, bien sean internacional, nacional o regional seg&uacute;n sea el caso de an&aacute;lisis.</p>
          <p style="text-align:justify">Las situaciones internas est&aacute;n relacionadas con la estructura, cultura organizacional, el modelo de operaci&oacute;n, el cumplimiento de los planes y programas, los sistemas de informaci&oacute;n, los procesos y procedimientos y los recursos humanos y econ&oacute;micos con los que cuenta una entidad.</p>
          <table style="width:100%;font-size:12pt;border-collapse:collapse" border="1px">
          	<tr>
          		<td style="font-size:10pt;text-align:center;background:#D0D1D3" colspan="2"><b>EJEMPLO DE FACTORES INTERNOS Y EXTERNOS DE RIESGO</b></td>
          	</tr>
          	<tr style="background:#E6E6E7">
          		<td style="font-size:10pt;text-align:center"><b>FACTORES EXTERNOS</b></td>
          		<td style="font-size:10pt;text-align:center"><b>FACTORES INTERNOS</b></td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Econ&oacute;micos:</b> disponibilidad de capital, emisi&oacute;n de deuda o no pago de la misma, liquidez, mercados financieros, desempleo, competencia.</td>
          		<td style="font-size:10pt;text-align:justify"><b>Infraestructura:</b> disponibilidad de activos, capacidad de los activos, acceso al capital.</td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Medioambientales:</b> emisiones y residuos, energ&iacute;, cat&aacute;strofes naturales, desarrollo sostenible.</td>
          		<td style="font-size:10pt;text-align:justify"><b>Personal:</b> capacidad del persona, salud, seguridad.</td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Pol&iacute;ticos:</b> cambios de gobierno, legislaci&oacute;n, pol&iacute;ticas p&uacute;blicas, regulaci&oacute;n.</td>
          		<td style="font-size:10pt;text-align:justify"><b>Procesos:</b> capacidad, dise&ntilde;o, ejecuci&oacute;n, proveedores, entradas, salidas, conocimiento.</td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Sociales:</b> demograf&iacute;a, responsabilidad social, terrorismo.</td>
          		<td style="font-size:10pt;text-align:justify" rowspan="2"><b>Tecnolog&iacute;a:</b> integridad de datos, disponibilidad de datos y sistemas, desarrollo, producci&oacute;n, mantenimiento.</td>
          	</tr>
          	<tr>
          		<td style="font-size:10pt;text-align:justify"><b>Tecnol&oacute;gicos:</b> interrupciones, comercio electr&oacute;nico, datos externos, tecnolog&iacute;a emergente.</td>
          	</tr>
          </table>
          </div>