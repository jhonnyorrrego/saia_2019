<?php
include_once("db.php");
/*
<Clase>
<Nombre>cargainicial
<Parametros>$id0: identificador del primer select
            $id1: identificador del segundo select
            $torigen: Tabla para realizar la busqueda del primer select
            $tdestino: Tabla para realizar la busqueda del segundo select
            $campo0: Campo a listar del primer select
            $campo1: Campo a listar del segundo select
            $contenedor: div donde se van a desplegar los otras selects
            $enlace: campo que sirve como filtro para elegir los elementos del segundo select
            $worigen: where del primer select
            $wdestino: where del segundo select
            $def0: registro por defecto del primer select
<Responsabilidades>Se encarga de los selects dependientes, invocando las funciones de ajax para generarlos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function cargainicial($id0,$id1,$torigen,$tdestino,$campo0,$campo1,$contenedor,$enlace,$worigen,$wdestino,$def0)
{ 
$tipo=0;
global $conn;
	$coneccion=$conn;   
	$sql="SELECT DISTINCT id".$torigen." ,$campo0 FROM $torigen";
	if($worigen)
	  $sql.=" WHERE $worigen ";
	$consulta=phpmkr_query($sql,$conn);  
	//echo $sql;
	// Voy imprimiendo el primer select compuesto por los paises
	$tem_select="<select class='combo' id='".$id0."' name='".$id0;
  if($tipo==1)
    $tem_select.="[]' multiple ";
  else 
    $tem_select.="'";	 
   if($torigen!=$tdestino)
    $tem_select.= " onChange='cargaContenido(\"".$id0."\",\"".$id1."\",\"".$tdestino."\",\"".$campo1."\",\"".$contenedor."\",\"".$enlace."\",\"".$wdestino."\")'>";
   else $tem_select.=">";
   $tem_select.="<option value=''>Por Favor Seleccione...</option>";
	while($registro=phpmkr_fetch_array($consulta))
	{
		$tem_select.="<option value='".$registro[0]."'";
    if($registro[0]==$def0)
    $tem_select.=" checked ";
    $tem_select.= ">".$registro[1]."</option>";
	}
	$tem_select.="</select>";
	//return($sql);
	return($tem_select);
}
?>
<script language="javascript" type="text/javascript">
function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}
function cargaContenido(id0,id1,tabla,campo,contenedor,enlace,wdestino)
{ alert(id0);
	var valor=document.getElementById(id0).options[document.getElementById(id0).selectedIndex].value;
	if(valor==0)
	{
		// Si el usuario eligio la opcion "Elige", no voy al servidor y pongo todo por defecto
		combo=document.getElementById(id1);
		combo.length=0;
		var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; 
    nuevaOpcion.innerHTML="Por Favor seleccione...";
		combo.appendChild(nuevaOpcion);	combo.disabled=true;
	}
	else
	{
		ajax=nuevoAjax();
		ajax.open("GET", "select_dependientes_proceso.php?seleccionado="+valor+"&tabla="+tabla+"&campo="+campo+"&id1="+id1+"&enlace="+enlace+"&condicion="+wdestino, true);
		ajax.onreadystatechange=function() 
		{ 
			if (ajax.readyState==1&&document.getElementById(id1))
			{
				// Mientras carga elimino la opcion "Elige pais" y pongo una que dice "Cargando"
				combo=document.getElementById(id1);
				combo.length=0;
				var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
				combo.appendChild(nuevaOpcion); combo.disabled=true;	
			}
			if (ajax.readyState==4)
			{ 
				document.getElementById(contenedor).innerHTML=ajax.responseText;
			} 
		}
		ajax.send(null);
	}
}
</script>
<?php
/*
<Clase>
<Nombre>
<Parametros>
<Responsabilidades>Recibe los parametros y los evalua, generando el codigo para el select dependiente
                   en caso que sea necesario invoca de nuevo la funcion que generaria un tercer select
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
if(isset($_GET["seleccionado"]))
  $valor=$_GET["seleccionado"];
else $valor=0;
if(isset($_GET["campo"]))
  $campo=$_GET["campo"];
else $campo="No Definido";  
if(isset($_GET["id1"]))  
  $id1=$_GET["id1"];
else $id1=$campo;
if(isset($_GET["tabla"]))
  $tabla=$_GET["tabla"];
else $tabla = "pantalla";
if(isset($_GET["enlace"]))
  $enlace=$_GET["enlace"];
else $enlace=" 1 ";
if(isset($_GET["condicion"]))  
  $condicion=$_GET["condicion"];
else $condicion= "1=0";  
if(isset($_GET["atributo"]))  
  $atributo=$_GET["atributo"];
else $atributo= "0";  
global $conn;
  $coneccion=$conn;

if($tabla=="serie3")
 $tabla="serie";  
if($tabla=="funcionario")
{
  $sql="select distinct A.funcionario_codigo, A.nombres, A.apellidos, A.perfil, B.nombre FROM funcionario A, cargo B, dependencia_cargo C WHERE C.dependencia_iddependencia=".$valor." AND C.cargo_idcargo=B.idcargo AND C.funcionario_idfuncionario = A.idfuncionario AND A.estado=1 ORDER BY A.nombres";
  $res = phpmkr_query($sql,$coneccion);  
  echo ("<select class='combo' id='".$id1."' name='".$id1."'>");
  while($registro=phpmkr_fetch_array($res))
	{
		// Paso a HTML acentors y � para su correcta visualizacion
		//$registro[1]=($registro[1]);
		// Imprimo las opciones del select
		//se evalua perfil del funcionario y dependiendo de este se listan los funcionario que esten por debajo de el
		$perfil = $_GET["perfil"];    	   
      if($perfil < $registro[3])		 
    	{	echo "<option value='".$registro[0]."'";
    		if($registro[0]==$atributo)
    		 echo " checked ";
        echo ">".delimita($registro[1]." ".$registro[2]." &nbsp;&nbsp;(".$registro[4].")",100)."</option>";
    		//print($tabla);
      }		
	}			
	echo "</select>";
}elseif($tabla=="serie2") //este caso es para los tres selects dependientes de las series documentales
 {      
    //$prueba=cargainicial("x_subserie","x_serie","serie","serie3","nombre","nombre","fila_5","cod_padre","cod_padre=$valor","1=0",1);
    $prueba=cargainicial("x_subserie","x_serie","serie","serie3","nombre","nombre","fila_5","cod_padre","cod_padre=$valor","",1);    
    echo $prueba;
}
elseif($valor=='otro')
 {
  echo "<div><input type='hidden' name='x_municipio_idmunicipio' value='otro'>";
  echo "<input type='text' name='x_municipio_ext' size='34'></div>";
 }
else
{  
	if($condicion)
  // Genero la consulta trayendo todos los estados que correspondan al codigo de pais elegido
	$sql="SELECT id$tabla , $campo FROM $tabla WHERE $enlace ='".$valor."' AND '$condicion' ORDER BY $campo";
	else
	$sql="SELECT id$tabla , $campo FROM $tabla WHERE $enlace ='".$valor."' ORDER BY $campo";	
	$consulta=phpmkr_query($sql,$coneccion);
//	phpmkr_db_close($coneccion);
 // print($sql);
	// Comienzo a imprimir el select
  $select="";	$aux=0;
	$select= ("<select class='combo' id='".$id1."' name='".$id1."'>");  
	while($registro=phpmkr_fetch_array($consulta))
  	{ $aux=1;	
		// Paso a HTML acentors y � para su correcta visualizacion
		$registro[1]=$registro[1];
		// Imprimo las opciones del select
		$select.= "<option value='".$registro[0]."'";
		if($registro[0]==$atributo)
		 $select.= " checked ";
    $select.= ">".delimita($registro[1],100)."</option>";
		//print($tabla);
		}
	if($tabla=="serie" && $aux==0)
    $select= "<input type='hidden' name='x_serie' value='$valor'>";			
	$select.= "</select>";
	echo $select;
}
?>
