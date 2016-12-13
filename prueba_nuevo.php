<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");

echo(estilo_bootstrap());

$boton = "<button class='btn btn-success' id='confirmar_cambios' >Aprobación de la Solicitud</button>";	
echo($boton.'<br><br>');
echo "<button class='btn btn-info dropdown-toggle' id='btn_editar' >Editar</button>";	


echo('<br><br><br><br>');


echo("<button class='btn btn-success' id='confirmar_cambios' style='color: #ffffff;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); background-color: #5bb75b;    background-image: linear-gradient(to bottom, #62c462, #51a351);background-repeat: repeat-x;border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);    display: inline-block;   padding: 4px 14px;    margin-bottom: 0;    font-size: 14px;    line-height: 20px;vertical-align: middle;    cursor: pointer;    border-radius: 4px;box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);'> Mi copia bootstrap </button>");
echo('<br><br><br><br>');


echo("<button class='btn btn-info dropdown-toggle' id='btn_editar' style='color: #ffffff;    background-color: #2f96b4;	text-decoration: none;	background-position: 0 -15px;	transition: background-position 0.1s linear;	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);	    background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);		background-repeat: repeat-x;		border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);		display: inline-block;    padding: 4px 14px;    margin-bottom: 0;    font-size: 14px;    line-height: 20px;	vertical-align: middle;    cursor: pointer;	    border: 1px solid #bbbbbb;		border-radius: 4px;		box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);'>  mi copia bootstrap </button>");

die();
phpinfo();
//print_r( get_html_translation_table(HTML_ENTITIES, ENT_QUOTES | ENT_HTML5) );

die();

$cadena='sub740';

$mystring = 'abc';
$findme   = 'sub';
$pos = strpos($cadena, $findme);

// El operador !== también puede ser usado. Puesto que != no funcionará como se espera
// porque la posición de 'a' es 0. La declaración (0 != false) se evalúa a 
// false.
if ($pos !== false) {
     echo "La cadena '$findme' fue encontrada en la cadena '$cadena'";
         echo " y existe en la posición $pos";
} else {
     echo "La cadena '$findme' no fue encontrada en la cadena '$cadena'";
}


die();

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
$id = @$_GET["id"];
$idcategoria=Null;
if(@$_REQUEST["idcategoria_formato"]){
	$idcategoria=$_REQUEST["idcategoria_formato"];
}
$tipo='';
if(@$_REQUEST["tipo"]){
	$tipo=$_REQUEST["tipo"];
}
$seleccionados=array();
if(@$_REQUEST["seleccionados"]){
	$seleccionados=explode(",",$_REQUEST["seleccionados"]);
}
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($idcategoria and $idcategoria<>"")
  echo("<tree id=\"0\">\n"); 
else
  echo("<tree id=\"0\">\n");
include_once("db.php");
if($idcategoria and $idcategoria<>"")
  llena_formato($idcategoria,'',$seleccionados);
else
  llena_formato("NULL",'',$seleccionados);
echo("</tree>\n");
?>
<?php

function llena_formato($id,$cod_padre,$seleccionados=Null){
global $conn,$tipo;
if($tipo!=1){
	$where=" AND estado=1 ";
}
if($id=="NULL")
  $papas=busca_filtro_tabla("*","categoria_formato","(cod_padre=0 OR cod_padre is null)".$where,"",$conn);
else if($cod_padre!=''){
	$papas=busca_filtro_tabla("*","categoria_formato","cod_padre='".$cod_padre."'".$where,"",$conn);
}
else
  $papas=busca_filtro_tabla("*","categoria_formato","idcategoria_formato=".$id.$where,"",$conn);

if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {
    $hijos = busca_filtro_tabla("count(*)","categoria_formato","cod_padre=".$papas[$i]["idcategoria_formato"],"",$conn);
	
    echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
	if($tipo!=1){
	    
    	echo("text=\"".htmlspecialchars($papas[$i]["nombre"])." \" id=\"-1\" >");
	}
	else{
		$estado='';
		if($papas[$i]["estado"]==1){
			$estado=' (Activo)';
		}
		else if($papas[$i]["estado"]==2){
			$estado=' (Inactivo)';
		}
		
		$concatenar_padre='';
		if($papas[$i]["cod_padre"]!=0 &&  $papas[$i]["cod_padre"]!=NULL){
			$concatenar_padre=','.$papas[$i]["cod_padre"];
		}
		echo("text=\"".htmlspecialchars($papas[$i]["nombre"]).$estado." \" id=\"".$papas[$i]["idcategoria_formato"]."\"");
		if(in_array($papas[$i]["idcategoria_formato"],$seleccionados)){
			echo (" checked=\"1\" >");
		}
		else{
			echo (" >");
		}
	}
    if($hijos[0][0]){
    	llena_formato('',$papas[$i]["idcategoria_formato"],$seleccionados);
    }
	if($tipo!=1)
		adicionar_formato($papas[$i]["idcategoria_formato"]);
    echo("</item>\n");
  }     
}
return;
}
function adicionar_formato($idcategoria){
	global $conn;
	$formatos=busca_filtro_tabla("","formato","","",$conn);
	$nom_cat=busca_filtro_tabla("","categoria_formato A","idcategoria_formato=".$idcategoria,"",$conn);
	/*if(strtolower($nom_cat[0]["nombre"])=='radicacion'){
		echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    	echo("text=\"".htmlspecialchars("Entrada")." \" id=\"-2\" ></item>");
	}*/
	for($i=0;$i<$formatos["numcampos"];$i++){
		$categorias_formato=explode(",",$formatos[$i]["fk_categoria_formato"]);
		if(in_array($idcategoria,$categorias_formato) && is_file("formatos/".$formatos[$i]["nombre"]."/".$formatos[$i]["ruta_adicionar"])){
			echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
    		echo("text=\"".ucwords(strtolower(htmlspecialchars($formatos[$i]["etiqueta"])))." \" id=\"".$formatos[$i]["idformato"]."\" ></item>");
		}
	}
}
?>
