<script type="text/javascript" src="../librerias/funciones_formatos.js"></script>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php
include_once ("../../db.php");
include_once("../../pantallas/lib/librerias_cripto.php");
if (isset($_REQUEST["form_info"]) && $_REQUEST["form_info"]!="") {
	desencriptar_sqli('form_info');
}

if(isset($_REQUEST["accion"]))
  {$_REQUEST["accion"]();     
}

function editar()
  {global $conn;
	$lista_campos = listar_campos_tabla();
	for ($i = 0; $i < count($lista_campos); $i++)
		$lista_campos[$i] = strtolower($lista_campos[$i]);
	$update = array();
	$campos = array();
   foreach($_REQUEST as $key=>$valor)
      {
        if(in_array(strtolower($key),$lista_campos))
          {
			$update[] = $key . "='" . (($valor)) . "'";
			$campos[] = $key;
		}
	}
	$sql = "update " . $_REQUEST["tabla"] . " set " . implode(",", $update) . " where id" . $_REQUEST["tabla"] . "=" . $_REQUEST["item"];
	phpmkr_query($sql, $conn);

	$formato = busca_filtro_tabla("", "formato", "nombre='" . $_REQUEST["formato"] . "'", "", $conn);
	$padre = busca_filtro_tabla("", "formato", "idformato='" . $formato[0]["cod_padre"] . "'", "", $conn);
	$doc_padre = busca_filtro_tabla("documento_iddocumento", $formato[0]["nombre_tabla"] . "," . $padre[0]["nombre_tabla"], "id" . $padre[0]["nombre_tabla"] . "=" . $padre[0]["nombre_tabla"] . " and id" . $formato[0]["nombre_tabla"] . "=" . $_REQUEST["item"], "", $conn);

	redirecciona("../" . $padre[0]["nombre"] . "/" . $padre[0]["ruta_mostrar"] . "?idformato=" . $padre[0]["idformato"] . "&iddoc=" . $doc_padre[0][0]);
}
function eliminar_item()
  {global $conn;
	//phpmkr_query("delete from ".$_REQUEST["tabla"]." where id".$_REQUEST["tabla"]."=".$_REQUEST["id"]);
	//nueva linea
	phpmkr_query("delete from " . $_REQUEST["tabla"] . " where id" . $_REQUEST["tabla"] . "=" . $_REQUEST["id"]);
	//alerta("Registro eliminado.");
	$fpadre = busca_filtro_tabla("ruta_mostrar,nombre,idformato,nombre_tabla,cod_padre", "formato", "idformato=(select cod_padre from formato where idformato='" . $_REQUEST["formato"] . "')", "", $conn);
	$idpadre = busca_filtro_tabla("documento_iddocumento", $fpadre[0]["nombre_tabla"], "documento_iddocumento=" . $_REQUEST["idpadre"], "", $conn);
	$superior = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $fpadre[0]["cod_padre"], "", $conn);
	if ($superior["numcampos"])
		echo "<script>
             var direccion = new String(window.parent.frames[0].location);
             param=direccion.split('&');
             direccion=param[0]+'&'+param[1]+'&seleccionar=" . $fpadre[0]["idformato"] . "-" . $superior[0][0] . "-" . $fpadre[0]["nombre_tabla"] . "-" . $idpadre[0][0] . "';
             window.parent.frames[0].location=direccion;
             </script>";
	else
		echo "<script>
             var direccion = new String(window.parent.frames[0].location);
             param=direccion.split('&');
             direccion=param[0]+'&'+param[1];
             window.parent.frames[0].location=direccion;
             </script>";
}
function guardar_item()
  {global $conn;
	$lista_campos = listar_campos_tabla();
	for ($i = 0; $i < count($lista_campos); $i++)
		$lista_campos[$i] = strtolower($lista_campos[$i]);

	$formato = busca_filtro_tabla("", "formato", "nombre='" . $_REQUEST["formato"] . "'", "", $conn);
   foreach($_REQUEST as $key=>$valor)
      {
        if(in_array(strtolower($key),$lista_campos)&&$key<>"id".$_REQUEST["tabla"])
          {
			$campos[] = $key;
			$tipo = busca_filtro_tabla("tipo_dato,etiqueta_html", "campos_formato A", "lower(A.nombre)='" . strtolower($key) . "' and formato_idformato='" . $formato[0]["idformato"] . "'", "", $conn);
			if (strtolower($tipo[0]["tipo_dato"]) == 'date') {
				if ($valor != '0000-00-00 00:00')
					$valores[] = ((fecha_db_almacenar($valor, 'Y-m-d')));
				else
					$valores[] = "''";
           }           
					 else if(strtolower($tipo[0]["tipo_dato"])=='datetime'){
				if ($valor != '0000-00-00 00:00')
           				$valores[]=((fecha_db_almacenar($valor,'Y-m-d H:i:s')));//Y-m-d H:i:s
				else
					$valores[] = "''";
           }
           else if(strtolower($tipo[0]["etiqueta_html"])=='checkbox'){
				$valores[] = "'" . implode(",", $valor) . "'";
           }
           else {
				$valores[] = "'" . ((str_replace("'", "&#39;", $valor))) . "'";
			}
		}
	}
	//$sql="insert into ".$_REQUEST["tabla"]."(".implode(",",$campos).") values(".implode(",",$valores).")";
	//nueva linea
	$sql = "insert into " . $_REQUEST["tabla"] . "(" . implode(",", $campos) . ") values(" . implode(",", $valores) . ")";
	phpmkr_query($sql, $conn);
	$insertado = phpmkr_insert_id();
	phpmkr_error();
   if($insertado>0)
     {//alerta("Registro insertado.");
		if ($_REQUEST["tabla"] == "ft_informacion_dano") {
			include_once ("../informacion_dano/funciones.php");
			redireccionar_papa($insertado);
			die();
		}
		$formato = busca_filtro_tabla("idformato,nombre,ruta_mostrar,ruta_adicionar", "formato", "nombre like '" . $_REQUEST["formato"] . "'", "", $conn);
		$padre = busca_filtro_tabla("idformato,nombre,ruta_mostrar,nombre_tabla,cod_padre", "formato", "idformato=(select cod_padre from formato where nombre like '" . $_REQUEST["formato"] . "')", "", $conn);
		$superior = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $padre[0]["cod_padre"], "", $conn);
		$doc_padre = busca_filtro_tabla("documento_iddocumento", $padre[0]["nombre_tabla"], "id" . $padre[0]["nombre_tabla"] . "=" . $_REQUEST["padre"], "", $conn);
		if ($_REQUEST["opcion_item"] <> "adicionar") {
			if ($superior["numcampos"])
				echo "<script>
             var direccion = new String(window.parent.frames[0].location);
             param=direccion.split('&');
             direccion=param[0]+'&'+param[1]+'&seleccionar=" . $padre[0]["idformato"] . "-" . $superior[0][0] . "-" . $padre[0]["nombre_tabla"] . "-" . $doc_padre[0][0] . "';
             //window.parent.frames[0].location=direccion;
             window.location='../".$padre[0]["nombre"]."/".$padre[0]["ruta_mostrar"]."?idformato=".$padre[0]["idformato"]."&iddoc=".$doc_padre[0]["documento_iddocumento"]."';  //correccion para que los items no recargen el arbol
             </script>";
			else
				echo "<script>
             var direccion = new String(window.parent.frames[0].location);
             param=direccion.split('&');
             direccion=param[0]+'&'+param[1];
             window.parent.frames[0].location=direccion;
             </script>";
		}
		/*if($_REQUEST["opcion_item"]<>"adicionar")
		 redirecciona("../".$padre[0]["nombre"]."/".$padre[0]["ruta_mostrar"]."?iddoc=".$doc_padre[0][0]."&idformato=".$padre[0]["idformato"]);   */
		if ($_REQUEST["opcion_item"] == "adicionar")
			redirecciona("../" . $formato[0]["nombre"] . "/" . $formato[0]["ruta_adicionar"] . "?idpadre=" . $doc_padre[0][0] . "&idformato=" . $padre[0]["idformato"] . "&padre=" . $_REQUEST["padre"]);
	}
}
?>