<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

if(isset($_REQUEST["documento_usuarios"]))

{include_once("class_documento.php");

 $datos=documento_usuarios($_REQUEST["key"],"nombres,apellidos");

 ?>

 <span style="font-family:verdana;font-size:xx-small"><br /><br /><b>Funcionarios que tiene acceso al documento</b><br /><br />

 <ul>

 <?php

 for($i=0;$i<$datos["numcampos"];$i++)

    {echo "<li>".ucwords($datos[$i]["nombres"]." ".$datos[$i]["apellidos"])."</li>";

    }

 echo "</ul></span>";   

}

else

{

?>

<html xmlns="http://www.w3.org/1999/xhtml">

 <head>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="css/flexigrid.css" />

<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/flexigrid.js"></script>

<script type="text/javascript" src="funciones_expediente.js"></script>

<script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>

<link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />    

<script type='text/javascript'>

hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';

hs.outlineType = 'rounded-white';



function abrir_popup(id,tipo)

{direccion="";

 ancho=300;

 alto=300;

 if(tipo==1)

   direccion="expediente_detalles.php?documento_usuarios=1&key=";

 else if(tipo==2)

   {direccion="expedienteview.php?key="+id+"&vista=1&ocultar_links=1";

    ancho="600";

   }

 else if(tipo==3)

   direccion="expediente_detalles.php?expediente_usuarios=1&key="+id;    

 if(direccion!="")

    hs.htmlExpand(null, {src:direccion+id, objectType: 'iframe',width: ancho, height:alto,preserveContent:false } );

}

$(document).ready(function(){

	

	$("#flex1").flexigrid

			(

			{url: 'expediente_contenido_ajax.php',

			dataType: 'json',

			colModel : [

        {display: '', name : '', width : 100, align: 'left'},

				{display: 'Nombre', name : 'nombre', width :  280, align: 'left'},

				{display: 'Fecha', name : 'fecha', width :  120, align: 'center'},

				{display: 'Transferir', name : '', width : 50, align: 'center'}

				],

      buttons : [{name: 'Transferir', onpress :validar_transferir },{separator: true}],                                                                

			sortname: "orden,nombre",

			sortorder: "desc",

			sql:<?php echo $_REQUEST["key"];?>,

			pagestat:"Registros {from} a {to} de {total}",

			procmsg: 'Procesando, por favor espere ...',

			nomsg: 'No se encontraron registros que coincidan',

			showToggleBtn: false,

			usepager: true,  

			title: 'Documentos',

			useRp: true,

			rp: 20,

			width:600,

			height: 200

			}

			);   

	

});    

</script>

</head>

<body> 

<?php

include_once("db.php");

include_once("header.php");

include_once("permisos_tabla.php");



$key=@$_REQUEST["key"];

/*function imprime_permisos($permisos)

{$valores=array();

 if(strpos($permisos,"l")!==false)

   $valores[]="Ver";

 if(strpos($permisos,"e")!==false)

   $valores[]="Eliminar";

 if(strpos($permisos,"m")!==false)

   $valores[]="Modificar";

 echo implode(", ",$valores);      

}     */

$papa=busca_filtro_tabla("","expediente","idexpediente=".@$key,"",$conn);

$limita_accion="MOSTRAR|ELIMINAR|MODIFICAR|PERMISOS|ICONO";

$arper1=array();



if($papa[0]["propietario"]==usuario_actual("funcionario_codigo"))

  $arper1=array("e","m","p","l");

else

  {
  /*$permisos=busca_filtro_tabla("","permiso_expediente_func","expediente_idexpediente=".@$key." and funcionario=".usuario_actual("funcionario_codigo"),"",$conn);

   if($permisos[0]["editar"]||$papa[0]["editar_todos"])

     $arper1[]="m";

   if($permisos[0]["eliminar"])

     $arper1[]="e";  

   if($permisos[0]["ver"]||$papa[0]["ver_todos"])

     $arper1[]="l";
     */
     
  $funcionario=busca_filtro_tabla("f.idfuncionario, dc.dependencia_iddependencia, dc.cargo_idcargo","funcionario f, dependencia_cargo dc, dependencia d, cargo c","f.funcionario_codigo=".usuario_actual("funcionario_codigo")." and f.idfuncionario=dc.funcionario_idfuncionario and dc.estado=1 and c.idcargo=dc.cargo_idcargo and c.estado=1 and dc.dependencia_iddependencia=d.iddependencia and d.estado=1","",$conn);

  $acceso_expediente_dependencia=busca_filtro_tabla("","entidad_expediente","entidad_identidad=2 and llave_entidad =".$funcionario[0]["dependencia_iddependencia"]." and estado=1 and expediente_idexpediente=".@$key,"",$conn);
  
  if($acceso_expediente_dependencia["numcampos"]){
    $arper1 = explode(",",$acceso_expediente_dependencia[0]["permiso"]);
    
  }

  $acceso_expediente_cargo=busca_filtro_tabla("","entidad_expediente","entidad_identidad=4 and llave_entidad =".$funcionario[0]["cargo_idcargo"]." and estado=1 and expediente_idexpediente=".@$key,"",$conn);
    
  if($acceso_expediente_cargo["numcampos"]){
    $arper1 = explode(",",$acceso_expediente_cargo[0]["permiso"]);
  
  }

  $acceso_expediente_funcionario=busca_filtro_tabla("","entidad_expediente","entidad_identidad=1 and llave_entidad =".$funcionario[0]["idfuncionario"]." and estado=1 and expediente_idexpediente=".@$key,"",$conn);
        
  if($acceso_expediente_funcionario["numcampos"]){
    $arper1 = explode(",",$acceso_expediente_funcionario[0]["permiso"]);
    
  }
  $arper1=array_unique($arper1);
   
}  

?>

<span class="internos"><br /><img class="imagen_internos" src="botones/comentarios/expediente.png" border="0">&nbsp;&nbsp;DESCRIPCI&Oacute;N DEL EXPEDIENTE: <?php echo(mayusculas(@$papa[0]["nombre"]));?></span><br><br>

<?php

$_SESSION["punto_retorno"]="expediente_detalles.php?key=".$key;

if(in_array("r",$arper1)){
$restringido=1;
} else{
$restringido=0;
}


echo '<table>';

echo enlace_permiso_usuario("l",array("l"),"MOSTRAR",explode("|",$limita_accion),"expediente",$key,"expedienteview.php","");
if($restringido==0){
echo enlace_permiso_usuario("m",$arper1,"MODIFICAR",explode("|",$limita_accion),"expediente",$key,"expedienteedit.php","_edit");

echo enlace_permiso_usuario("e",$arper1,"ELIMINAR",explode("|",$limita_accion),"expediente",$key,"expedientedelete.php","_delete");    
}
if(in_array("p",$arper1))

/*echo'<td><div class="textwrapper">

		<a href="permiso_expediente_funcionario.php?key='.$key.'" ><img name="permisos" src="botones/anexos/application_key.png" alt="Administrar Permisos">   </a>

		</div></td>';  */

echo'<td><div class="textwrapper">
    <a href="permiso_expediente_funcionario.php?key='.$key.'"><img name="permisos" src="botones/anexos/application_key.png" alt="Administrar Permisos"></a>
    </div></td>'; 
echo '</table>'; 
 
echo('<a href="expedienteadd.php?cod_padre='.$key.'&vista='.@$vista.'" target="expedientelist" title="Adicionar Expediente">Adicionar</a>&nbsp;&nbsp;');    

  if($papa["numcampos"] && $papa[0]["cod_padre"]){

    echo('<a href="expediente_detalles.php?key='.$papa[0]["cod_padre"].'&vista='.$vista.'" target="expedientelist" title="Subir nivel">Subir de Nivel</a>&nbsp;&nbsp;');  

  }

  else echo("Nivel superior&nbsp;&nbsp;");


  

 if(in_array("m",$arper1))

   echo('<a href="documento.buscar.php?pagina_exp='.$key.'" target="expedientelist" title="Alimenta el expediente actual con Documentos">Llenar Expediente</a>&nbsp;&nbsp;');    



if(!empty($arper1))

  {echo('<a href="#" onclick="seleccionar_todos(true)">Seleccionar Todos</a>&nbsp;&nbsp;');

   echo('<a href="#" onclick="seleccionar_todos(false)">Quitar Selecci&oacute;n Todos</a>&nbsp;&nbsp;');

  ?>

<br><br>

<div id='ventana_emergente'></div>

<form name="form1" id="form1">

<input type="hidden" id="idexpediente" name="idexpediente" value="'.$key.'">

<table id='flex1'>

</table>

</form>

</body>

<?php

 }

else

  echo "<br /><br />No tiene permiso asignado para ver el contenido del expediente.<br />";

include_once("footer.php");

}


?>