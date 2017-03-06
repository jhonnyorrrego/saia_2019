<?php
/*
<Clase>
<Nombre>llenar_ejecutor
<Parametros>
<Responsabilidades>Se encarga de hacer la busqueda de los datos del ejecutor a partir del nombre o del numero
                   de identificacion. Para asi retornarlo y de esta forma ahorrarle al usuario la digitada de los mismo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
include_once("db.php")?>
<?php

function codifica($texto)
{return(codifica_encabezado(html_entity_decode($texto)));
}

$datos_e = busca_filtro_tabla("","ejecutor,datos_ejecutor","idejecutor='".$_REQUEST["idejecutor"]."' and ejecutor_idejecutor=idejecutor","iddatos_ejecutor desc",$conn);
if($datos_e["numcampos"])
{echo codifica($datos_e[0]["cargo"])."||".codifica($datos_e[0]["telefono"])."||".codifica($datos_e[0]["empresa"])."||".codifica($datos_e[0]["direccion"])."||".codifica($datos_e[0]["email"])."||".codifica($datos_e[0]["idejecutor"])."||".codifica($datos_e[0]["iddatos_ejecutor"])."||".codifica($datos_e[0]["codigo"]);
}
else
 echo "0"; 
/*
if($_POST["opcion"]=="nombre")
{
  if($_POST["nombre"]<>"")
   $datos_e = busca_filtro_tabla("A.idejecutor,A.nombre,identificacion,iddatos_ejecutor","ejecutor A,datos_ejecutor d","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$_POST["nombre"],"iddatos_ejecutor desc",$conn);
   //$datos_e = busca_filtro_tabla("A.idejecutor,identificacion","ejecutor A","lower(A.nombre)='".strtolower((html_entity_decode(($_POST["nombre"]))))."'","",$conn);  
}
else
{
  if($_POST["identificacion"]<>"" AND is_numeric($_POST["identificacion"]))
    $datos_e = busca_filtro_tabla("A.idejecutor,A.nombre,A.identificacion,iddatos_ejecutor","ejecutor A,datos_ejecutor d","idejecutor=ejecutor_idejecutor and iddatos_ejecutor='".$_POST["identificacion"]."'","iddatos_ejecutor desc",$conn); 
    //print_r($datos_e);   
}
//print_r($datos_e); 
//if($_POST["casilla"]=="identificacion")
 //$datos = $datos_e;
//else 
 if($datos_e["numcampos"]>0)
  { 
   if($_POST["casilla"]=="nombre" || $_POST["casilla"]=="identificacion")
   { $datos["numcampos"]=1;  
     $datos[0][$_POST["casilla"]]=$datos_e[0][$_POST["casilla"]];
   }
   else
     $datos = busca_filtro_tabla("A.".$_POST["casilla"],"datos_ejecutor A","iddatos_ejecutor=".$datos_e[0]["iddatos_ejecutor"],"fecha DESC",$conn);
  } 
 //print_r($datos); 
if(@$datos["numcampos"]>0 && $datos[0][$_POST["casilla"]]<>"")
{  
    switch($_POST["casilla"])
    {
      case "cargo":
        echo "<input type=\"text\" name=\"x_cargoejecutor\" id=\"x_cargoejecutor\" size=53 value=\"".$datos[0]["cargo"]."\">";
        break;
      case "direccion":
        echo "<input type=\"text\" name=\"x_direccionejecutor\" id=\"x_direccionejecutor\" size=53 value=\"".$datos[0]["direccion"]."\">";
        break;
      case "telefono":
        echo "<input type=\"text\" name=\"x_telefonoejecutor\" id=\"x_telefonoejecutor\" value=\"".$datos[0]["telefono"]."\">";
        break;
      case "email":
        echo "<input type=\"text\" name=\"x_emailejecutor\" id=\"x_emailejecutor\" size=53 value=\"".$datos[0]["email"]."\">";
        break;  
      case "empresa":
        echo "<input type=\"text\" name=\"x_empresaejecutor\" size=\"100\" id=\"x_empresaejecutor\" value=\"".$datos[0]["empresa"]."\">";
        break;
      case "ciudad":
        echo "<input type=\"text\" name=\"x_ciudadejecutor\" id=\"x_ciudadejecutor\" value=\"".$datos[0]["ciudad"]."\">";
        break;
      case "identificacion":       
        echo "<input type=\"text\" name=\"x_nitejecutor2\" id=\"auto2\" value=\"".$datos[0]["identificacion"]."\" autocomplete=off onkeyup=\"if(Teclados(event,'2') == 1){ autocompletar('2',auto2.value);Action.disabled=true;}\" onkeydown = \"ejecutor.value=''; ParaelTab(event,'2');\" onfocus=\"document.getElementById('comple2').style.visibility='visible';\" onblur=\"llenar_formulario('identificacion');eliminarespacio(this);document.getElementById('Action').disabled=false;\">";
        break;
      case "nombre":
        echo "<input type=\"text\" size=53 name=\"x_ejecutor2\" id=\"auto1\" autocomplete=off value=\"".$datos[0]["nombre"]."\" onkeyup=\"if(Teclados(event,'1') == 1){ autocompletar('1',auto1.value);Action.disabled=true;}\" onkeydown = \"ejecutor.value=''; ParaelTab(event,'1')\" onfocus=\"document.getElementById('comple1').style.visibility='visible';\" onblur=\"llenar_formulario('nombre');eliminarespacio(this);document.getElementById('Action').disabled=false;\">";
        break;            
    }
}
else
{
    switch($_POST["casilla"])
    {
      case "cargo":
        echo "<input type=\"text\" name=\"x_cargoejecutor\" id=\"x_cargoejecutor\" size=53 value=\"\">";
        break;
      case "direccion":
        echo "<input type=\"text\" name=\"x_direccionejecutor\" id=\"x_direccionejecutor\" size=53 value=\"\">";
        break;
      case "telefono":
        echo "<input type=\"text\" name=\"x_telefonoejecutor\" id=\"x_telefonoejecutor\" value=\"\">";
        break;
      case "email":
        echo "<input type=\"text\" name=\"x_emailejecutor\" id=\"x_emailejecutor\" size=53 value=\"\">";
        break;   
      case "ciudad":
        echo "<input type=\"text\" name=\"x_ciudadejecutor\" id=\"x_ciudadejecutor\" value=\"\">";
        break;
      case "identificacion":
        echo "<input type=\"text\" name=\"x_nitejecutor2\" id=\"auto2\" autocomplete=off value=\"\" onkeyup=\"if(Teclados(event,'2') == 1){ autocompletar('2',auto2.value);Action.disabled=true;}\" onkeydown = \"ejecutor.value=''; ParaelTab(event,'2')\" onfocus=\"document.getElementById('comple2').style.visibility='visible';\" onblur=\"llenar_formulario('identificacion');eliminarespacio(this);document.getElementById('Action').disabled=false;\">";
        break;
     case "empresa":
        echo "<input type=\"text\" name=\"x_empresaejecutor\" id=\"x_empresaejecutor\" size='100' value=\"\">";
        break;    
      case "nombre":  
        echo "<input type=\"text\" size=53 name=\"x_ejecutor2\" id=\"auto1\" autocomplete=off value=\"\" onkeyup=\"if(Teclados(event,'1') == 1){ autocompletar('1',auto1.value);Action.disabled=true;}\" onkeydown = \"ejecutor.value=''; ParaelTab(event,'1')\" onfocus=\"document.getElementById('comple1').style.visibility='visible';\" onblur=\"llenar_formulario('nombre');eliminarespacio(this);document.getElementById('Action').disabled=false;\">";
        break;            
    }
}      */
?>
