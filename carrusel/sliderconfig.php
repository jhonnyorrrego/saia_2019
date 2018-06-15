<?php
include_once("../db.php");
include_once("../header.php");

include_once($ruta_db_superior . "librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("id");
desencriptar_sqli('form_info');

echo(estilo_bootstrap());
echo(librerias_jquery('1.7'));
echo(librerias_kaiten());


?>
<div class="container">
		<h5>CONFIGURACI&Oacute;N DE CARRUSEL Y CONTENIDOS RELACIONADOS</h5>
		<br/>
		

		

<?php


if(!isset($_REQUEST["accion"]))
{	$carrusel=busca_filtro_tabla("carrusel.*,".fecha_db_obtener('fecha_inicio','Y-m-d')." as fecha_inicio,".fecha_db_obtener('fecha_fin','Y-m-d')." as fecha_fin","carrusel","","nombre",$conn);
?>

		<ul class="nav nav-tabs">
		 <li class="active" ><a href='sliderconfig.php'>Inicio</a ></li>
		  <li ><a href='sliderconfig.php?accion=adicionar'>Adicionar Carrusel</a ></li>
		   <li><a href='contenidoconfig.php?accion=adicionar'>Adicionar Contenido</a ></li>
		</ul>		
		<br/>


<!--a href='sliderconfig.php?accion=adicionar'>Adicionar Carrusel</a -->&nbsp;&nbsp;

<!-- div class="kenlace_saia" style="cursor:pointer" titulo="Adicionar Carrusel" title="Adicionar Carrusel" enlace="sliderconfig.php?accion=adicionar" conector="iframe">Adicionar Carrusel</div -->




<!--a href='contenidoconfig.php?accion=adicionar'>Adicionar Contenido</a -->





<!--&nbsp;&nbsp;<a target="_blank" href='mostrar_todos.php'>Mostrar Vigentes</a--><br /><br />
<?php
if(!$carrusel["numcampos"])
  echo "No se encontraron registros.";
else
  {echo "<table width='100%'  class='table table-bordered table-striped'>
         <tr ><td colspan=3 style='text-align: center; background-color:#57B0DE; color: #ffffff;'>OPCIONES</td>
         <td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>NOMBRE</td>
         <td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>FECHA DE PUBLICACION</td>
         <td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>FECHA DE CADUCIDAD</td>
         <td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>CONTENIDOS</td></tr>";
   for($i=0;$i<$carrusel["numcampos"];$i++)
      {
      	$contenidos=busca_filtro_tabla("","contenidos_carrusel","carrusel_idcarrusel=".$carrusel[$i]["idcarrusel"]." and '".date("Y-m-d")."'<=".fecha_db_obtener("fecha_fin","Y-m-d")." and '".date("Y-m-d")."'>=".fecha_db_obtener("fecha_inicio","Y-m-d"),"orden",$conn);
      	echo "<tr><td>
             <a href='sliderconfig.php?accion=editar&id=".$carrusel[$i]["idcarrusel"]."'>Editar
             </a></td>
             <td>
             <a href='#' onclick='if(confirm(\"Desea borrar el carrusel y todos sus contenidos?\")) window.location=\"sliderconfig.php?accion=eliminar&id=".$carrusel[$i]["idcarrusel"]."\"'>Eliminar
             </a></td>";
             if($contenidos['numcampos']){
			 	echo("<td>
			 			<a target='_blank' href='mostrar_todos.php?idcarrusel=".$carrusel[$i]["idcarrusel"]."'>Ver</a>
			 		</td>");
			 }else{
			 	echo("<td></td>");
			 }
       echo "<td>".$carrusel[$i]["nombre"]."</td>";
       echo "<td>".$carrusel[$i]["fecha_inicio"]."</td>";
       echo "<td>".$carrusel[$i]["fecha_fin"]."</td>";
       echo "<td><table width=100% class='table table-bordered table-striped'><tr><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>NOMBRE</td><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>F. INICIO</td><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>F. FINAL</td><td colspan=2 style='text-align: center; background-color:#57B0DE; color: #ffffff;'>OPCIONES</td></tr>";
       $contenidos=busca_filtro_tabla("contenidos_carrusel.*,".fecha_db_obtener('fecha_inicio','Y-m-d')." as fecha_inicio,".fecha_db_obtener('fecha_fin','Y-m-d')." as fecha_fin","contenidos_carrusel","carrusel_idcarrusel=".$carrusel[$i]["idcarrusel"],"orden",$conn);
       for($j=0;$j<$contenidos["numcampos"];$j++)
         echo "<tr><td>".$contenidos[$j]["nombre"]."</td><td>".$contenidos[$j]["fecha_inicio"]."</td><td>".$contenidos[$j]["fecha_fin"]."</td><td><a href='contenidoconfig.php?accion=editar&id=".$contenidos[$j]["idcontenidos_carrusel"]."'>Editar</a></td><td><a href='contenidoconfig.php?accion=eliminar&id=".$contenidos[$j]["idcontenidos_carrusel"]."'>Eliminar</a></td></tr>";
       echo "</table></td></tr>";
      } 
   echo "</table>";
  }  
}
elseif($_REQUEST["accion"]=="adicionar" || $_REQUEST["accion"]=="editar")
  {if(isset($_REQUEST["id"])&&$_REQUEST["id"])
     $carrusel=busca_filtro_tabla("carrusel.*,".fecha_db_obtener('fecha_inicio','Y-m-d')." as fecha_inicio,".fecha_db_obtener('fecha_fin','Y-m-d')." as fecha_fin","carrusel","idcarrusel=".$_REQUEST["id"],"",$conn);
   else
     $carrusel[0]=array("autoplay"=>"1","delay"=>"3000","easing"=>"easeInOutExpo","animationtime"=>"600");
  
   include_once("../calendario/calendario.php");
   ?>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.js"></script>
    <style>
    	.error{
    		color:red;
    	}
    </style>
    <script type='text/javascript'>
      $().ready(function() {
    	$('#form1').validate({
    		submitHandler: function(form) {
				<?php encriptar_sqli("form1",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
    	});
    });
    </script>
    
		<ul class="nav nav-tabs">
		
			 <li ><a href='sliderconfig.php'>Inicio</a ></li>
		<?php if($_REQUEST["accion"]=='adicionar'){ ?>
					
				 <li class="active"><a href='sliderconfig.php?accion=adicionar'>Adicionar Carrusel</a ></li>
				 <li><a href='contenidoconfig.php?accion=adicionar'>Adicionar Contenido</a ></li>
		<?php }else{ ?>	
				
				  <li ><a href='sliderconfig.php?accion=adicionar'>Adicionar Carrusel</a ></li>
			      <li><a href='contenidoconfig.php?accion=adicionar'>Adicionar Contenido</a ></li>
			      <li class="active"><a href='#'>Editar Carrusel</a ></li>
		<?php } ?>			
			
		</ul>		
		<br/>    
 		
   <?php    
   echo "<br /><fieldset><legend>".ucwords($_REQUEST["accion"]." carrusel")."</legend></fieldset>     <br /><br /><form name='form1' id='form1' method='post'><table class='table table-bordered table-striped'>";
   echo "<tr><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>Nombre*</td><td><input class='required'  type='text' name='nombre' value='".@$carrusel[0]["nombre"]."'></td></tr>";

   echo "<tr><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>Fecha de publicaci&oacute;n*</td><td>".'<input type="text" readonly="true" name="fecha_inicio"  class="required dateISO"  id="fecha_inicio" value="'.@$carrusel[0]["fecha_inicio"].'">';
   selector_fecha("fecha_inicio","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR");
   echo "</td></tr>";
   echo "<tr><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>Fecha caducidad*</td><td>";
   echo '<input type="text" readonly="true" name="fecha_fin"  class="required dateISO"  id="fecha_fin" value="'.@$carrusel[0]["fecha_fin"].'">';
   selector_fecha("fecha_fin","form1","Y-m-d",date("m"),date("Y"),"default.css","../","AD:VALOR");
   echo "</td></tr>";
   echo "<tr><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>Efecto*</td><td>";
	 $easing0="";
	 $easing1="";
	 $easing2="";
	 $easing3="";
	 $easing4="";
	 $easing5="";
	 $easing6="";
	 $easing7="";
	 $default_easing="";
	 if($carrusel[0]["easing"]==0)$easing0="checked";
	 else if($carrusel[0]["easing"]==1)$easing1="checked";
	 else if($carrusel[0]["easing"]==2)$easing2="checked";
	 else if($carrusel[0]["easing"]==3)$easing3="checked";
	 else if($carrusel[0]["easing"]==4)$easing4="checked";
	 else if($carrusel[0]["easing"]==5)$easing5="checked";
	 else if($carrusel[0]["easing"]==6)$easing6="checked";
	 else if($carrusel[0]["easing"]==7)$easing7="checked";
	 else $default_easing="checked";
	 
   echo "<input type='radio' name='easing' value='0' ".$easing0.">Ninguno<br />";
   echo "<input type='radio' name='easing' value='1' ".$easing1." ".$default_easing.">Efecto de fundido<br />";
   echo "<input type='radio' name='easing' value='2' ".$easing2.">Deslice desde arriba<br />";
   echo "<input type='radio' name='easing' value='3' ".$easing3.">Deslice desde la derecha<br />";
   echo "<input type='radio' name='easing' value='4' ".$easing4.">Deslice desde abajo<br />";
   echo "<input type='radio' name='easing' value='5' ".$easing5.">Deslice desde la izquierda<br />";
	 echo "<input type='radio' name='easing' value='6' ".$easing6.">Carrusel de derecha a izquierda<br />";
	 echo "<input type='radio' name='easing' value='7' ".$easing7.">Carrusel de izquierda a derecha";
   echo "</td></tr>";
	 $autoplay1="";
	 $autoplay0="";
	 $default_autoplay="";
	 if($carrusel[0]["autoplay"]==1)$autoplay1="checked";
	 else if($carrusel[0]["autoplay"]==0)$autoplay0="checked";
	 else $default_autoplay="checked";
   echo "<tr><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>Reproducci&oacute;n Autom&aacute;tica*</td>
   <td><input type='radio' name='autoplay' value='1' ".$autoplay1." ".$default_autoplay.">Si
   <input type='radio' name='autoplay' value='0' ".$autoplay0.">No
   </td></tr>";
   echo "<tr><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>Tiempo entre Paginas*</td><td><input class='required'  type='text' name='delay' value='".@$carrusel[0]["delay"]."'></td></tr>";

   echo "<tr><td style='text-align: center; background-color:#57B0DE; color: #ffffff;'>Tiempo de animaci&oacute;n*</td><td><input class='required'  type='text' name='animationtime' value='".@$carrusel[0]["animationtime"]."'></td></tr>";

   echo "<tr><td><input class='btn btn-primary' type='submit' value='Continuar'>
   <input type='hidden' name='id' value='".@$carrusel[0]["idcarrusel"]."'>
   <input type='hidden' name='accion' value='guardar_".@$_REQUEST["accion"]."'>
   </td></tr>";
   echo "</table></form>";
}
elseif($_REQUEST["accion"]=="guardar_adicionar")
{$campos=array("autoplay","delay","easing","animationtime","nombre");
 $nombres[]="fecha_inicio";
 $nombres[]="fecha_fin";
 $valores[]=fecha_db_almacenar($_REQUEST["fecha_inicio"],"Y-m-d");
 $valores[]=fecha_db_almacenar($_REQUEST["fecha_fin"],"Y-m-d");
 foreach($campos as $fila)
   {$valores[]="'".$_REQUEST[$fila]."'";
    $nombres[]=$fila;
   }
 $sql1="insert into carrusel(".implode(",",$nombres).") values(".implode(",",$valores).")";
 //die($sql1);
 phpmkr_query($sql1,$conn);
 header("location: sliderconfig.php");
}
elseif($_REQUEST["accion"]=="guardar_editar")
{$campos=array("autoplay","delay","easing","animationtime","nombre");
 $valores[]="fecha_inicio=".fecha_db_almacenar($_REQUEST["fecha_inicio"],"Y-m-d");
 $valores[]="fecha_fin=".fecha_db_almacenar($_REQUEST["fecha_fin"],"Y-m-d");
 foreach($campos as $fila)
   {$valores[]=$fila."='".$_REQUEST[$fila]."'";
   }
 $sql="update carrusel set ".implode(",",$valores)." where idcarrusel=".$_REQUEST["id"];
 //die($sql);
 phpmkr_query($sql,$conn);
 header("location: sliderconfig.php");
}
elseif($_REQUEST["accion"]=="eliminar")
{$sql="delete from contenidos_carrusel where carrusel_idcarrusel=".$_REQUEST["id"];
 phpmkr_query($sql,$conn);
 $sql="delete from carrusel where idcarrusel=".$_REQUEST["id"];
 phpmkr_query($sql,$conn);
 header("location: sliderconfig.php");
}
function botones($nombre,$valor)
{$texto="<input type='radio' name='$nombre' value='true' ";
 if($valor=="true")
   $texto.=" checked ";
 $texto.= ">Si&nbsp;&nbsp;<input name='$nombre' type='radio' value='false' ";
 if($valor=="false")
   $texto.= " checked ";
 $texto.= ">No";
 return($texto);   
}
include_once("../footer.php");
?>
</DIV>	