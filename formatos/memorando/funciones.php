<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias/funciones_generales.php");

include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

function lista_destinos($idformato, $iddoc = NULL) {
	
	$datos = busca_filtro_tabla("nombre,nombre_tabla", "formato", "idformato=$idformato", "");
	$resultado = busca_filtro_tabla("destino," . fecha_db_obtener("fecha_" . $datos[0]["nombre"], "Y-m-d"), $datos[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "");

	$destinos = explode(",", $resultado[0]["destino"]);
	$nombres = array();
	$lista = array();
	foreach ($destinos as $fila) {

		if (strpos($fila, '#') > 0) {
			$datos = busca_filtro_tabla("nombre", "dependencia", "iddependencia=" . str_replace("#", "", $fila), "");
			$roles = busca_filtro_tabla("distinct funcionario_idfuncionario,iddependencia_cargo", "dependencia_cargo", "dependencia_iddependencia=" . str_replace("#", "", $fila), "");

			if ($roles["numcampos"] == 1) {
				$lista[] = cargos_memo($roles[0]["iddependencia_cargo"], $resultado[0]["fecha_memo"], "para", 5);
			} else {
				$lista[] = ucwords($datos[0]["nombre"]);
			}
		} else {
			$lista[] = cargos_memo($fila, $resultado[0]["fecha_" . $datos[0]["nombre_tabla"]], "para", 5);
		}
	}

	foreach ($lista as $value) {
		$des = explode(',', $value);
		if (sizeof($des) > 1) {
			echo('' . $des[0] . '<br />');
			echo($des[1]);
		} else {
			echo('' . $des[0] . '');
		}
		echo('<br />');
	}

}

function jerarquia_destinos($lista, $fecha) {
	
	$hijo = "";
	$list = implode(",", $lista);
	$cargos = busca_filtro_tabla("funcionario_codigo,nombres,apellidos,nombre", "cargo,dependencia_cargo,funcionario", "cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo in ($list) and (fecha_inicial <= " . fecha_db_almacenar($fecha, "Y-m-d") . " and fecha_final >= " . fecha_db_almacenar($fecha, "Y-m-d") . ")", "GROUP by funcionario_codigo order by codigo_cargo ASC");
	if (!$cargos["numcampos"])
		$cargos = busca_filtro_tabla("funcionario_codigo,nombres,apellidos,nombre", "cargo,dependencia_cargo,funcionario", "cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo in ($list)", "iddependencia_cargo desc");
	if ($cargos["numcampos"] > 0)
		for ($i = 0; $i < $cargos["numcampos"]; $i++)
			$hijo .= $cargos[$i]["nombres"] . "  " . $cargos[$i]["apellidos"] . " - " . $cargos[$i]["nombre"] . "<br />";
	echo $hijo;
	return (true);
}

function mostrar_origen($idformato, $iddoc = NULL) {
	
	$formato = busca_filtro_tabla("nombre_tabla,nombre", "formato", "idformato=$idformato", "");
	$resultado = busca_filtro_tabla("dependencia," . fecha_db_obtener("b.fecha", "Y-m-d") . " as fecha", $formato[0]["nombre_tabla"] . ",documento b", "documento_iddocumento=iddocumento and documento_iddocumento=$iddoc", "");
	$origen = explode(',', $resultado[0]["dependencia"]);
	for ($i = 0; $i < count($origen); $i++) {
		$dependencia = busca_filtro_tabla("C.nombre,D.nombres,D.apellidos", "dependencia_cargo A, cargo B, dependencia C,funcionario D", "A.iddependencia_cargo=" . $origen[$i] . " AND D.idfuncionario=A.funcionario_idfuncionario AND B.idcargo=A.cargo_idcargo AND A.dependencia_iddependencia=C.iddependencia AND A.estado=1", "");
		echo('' . $dependencia[0]["nombre"] . "<br />");
	}

}

function mostrar_copias_memo($idformato, $iddoc = NULL) {
	
	$datos = busca_filtro_tabla("nombre,nombre_tabla", "formato", "idformato=$idformato", "");
	$inf_memorando = busca_filtro_tabla("copia", $datos[0]["nombre_tabla"], "documento_iddocumento=$iddoc", "");
	if ($inf_memorando[0]["copia"] <> "") {echo '<span>Copia: ';
		$destinos = explode(",", $inf_memorando[0]["copia"]);
		$destinos = array_unique($destinos);
		sort($destinos);
		$lista = array();
		for ($i = 0; $i < count($destinos); $i++) {//si el destino es una dependencia
			if (strpos($destinos[$i], "#") > 0) {$resultado = busca_filtro_tabla("nombre", "dependencia", "iddependencia=" . str_replace("#", "", $destinos[$i]), "");
				$lista[] = ucwords($resultado[0]["nombre"]);
			} else//si el destino es un funcionario
			{
				$resultado = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre", "funcionario,cargo c,dependencia_cargo dc", "dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and iddependencia_cargo=" . $destinos[$i], "");
				$lista[] = ucwords(strtolower($resultado[0]["nombres"] . " " . $resultado[0]["apellidos"]));
			}
		}
		echo implode(", ", $lista);
		echo '</span><br/>';
	}
}

function nomenclatura($idformato, $iddoc = NULL) {
	
	$datos = busca_filtro_tabla("dependencia,fecha", "ft_memorando, documento", "iddocumento=documento_iddocumento and documento_iddocumento=$iddoc", "");

	$resultado = busca_filtro_tabla("c.nombre,c.iddependencia ", "dependencia c,dependencia_cargo dc", "c.iddependencia =dc.dependencia_iddependencia  and dc.iddependencia_cargo=" . $datos[0]["dependencia"], "");
	$nueva_fecha = date_parse($datos[0]["fecha"]);

	$comp = strlen($nueva_fecha["month"]);
	if ($comp == 1) {

		$nueva = "0" . $nueva_fecha["month"];
	} else {

		$nueva = $nueva_fecha["month"];

	}

	if ($resultado[0]["iddependencia"] == 4) {
		$texto = "DNC-" . $nueva_fecha["day"] . $nueva . $nueva_fecha["year"];
	}
	if ($resultado[0]["iddependencia"] == 5) {
		$texto = "DPI-" . $nueva_fecha["day"] . $nueva . $nueva_fecha["year"];
	}
	if ($resultado[0]["iddependencia"] == 6) {
		$texto = "GAF-" . $nueva_fecha["day"] . $nueva . $nueva_fecha["year"];
	}

	if ($resultado[0]["iddependencia"] == 7) {
		$texto = "GMC-" . $nueva_fecha["day"] . $nueva . $nueva_fecha["year"];
	}
	echo($texto);
}

function organizar_imagenes($idformato, $iddoc) {
	
	registrar_imagenes_documento($idformato, $iddoc, 'contenido');
}


function mostrar_imagenes_escaneadas_memo($idformato)
{ 
  
  $formato = busca_filtro_tabla("","formato","idformato=".$idformato." and detalle=1",""); 
  if(isset($_REQUEST["anterior"]) && $_REQUEST["anterior"]!="" && $formato["numcampos"] == 0)
  { 
   $doc = $_REQUEST["anterior"];
   $doc_anterior = busca_filtro_tabla("descripcion,numero","documento","iddocumento=$doc","");
   echo "<b>Se est&aacute; dando respuesta al documento: </b>&nbsp;&nbsp;".$doc_anterior[0]["numero"]." ".$doc_anterior[0]["descripcion"]."<br /><br />";  
   //Si el documento tiene imagenes escaneadas las muestra antes del formato de respuesta
   $imagenes=busca_filtro_tabla("consecutivo,imagen,ruta,pagina","pagina","id_documento=".$doc,""); 
    $codigo="";
    if($imagenes<>"")
       { 
        echo '<div id="mainContainer">
              <div id="content">';                 
         for($i=0; $i<$imagenes["numcampos"]; $i++)
          { ?>                
          		<a href="#" onclick="displayImage('<?php echo "../../".$imagenes[$i]["ruta"]?>','P&aacute;gina <?php echo $imagenes[$i]["pagina"]?>.','');return false"><img src="<?php echo "../../".$imagenes[$i]["imagen"]?>" border="1"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
           if($imagenes[$i]["pagina"]==(round($imagenes[$i]["pagina"]/8)*8))
            echo "<br><br>";
          }
          echo "</div></div>";
       }
   echo "<HR>";
 }
else if($_REQUEST["iddoc"]){
	$doc = $_REQUEST["iddoc"];
    $doc_anterior = busca_filtro_tabla("descripcion,numero","documento","iddocumento=$doc","");
     
   //Si el documento tiene imagenes escaneadas las muestra antes del formato de respuesta
    $imagenes=busca_filtro_tabla("consecutivo,imagen,ruta,pagina","pagina","id_documento=".$doc,""); 
    $codigo="";
    if($imagenes["numcampos"] > 0)
       {
       	echo "<b>Documentos escaneados<br /><br />"; 
        echo '<div id="mainContainer">
              <div id="content">';                 
         for($i=0; $i<$imagenes["numcampos"]; $i++)
          { ?>                
          		<a href="#" onclick="displayImage('<?php echo "../../".$imagenes[$i]["ruta"]?>','P&aacute;gina <?php echo $imagenes[$i]["pagina"]?>.','');return false"><img src="<?php echo "../../".$imagenes[$i]["imagen"]?>" border="1"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
           if($imagenes[$i]["pagina"]==(round($imagenes[$i]["pagina"]/8)*8))
            echo "<br><br>";
          }
          echo "</div></div>";
		  echo "<HR>";
       }
   
}
 return true;  
}


function mostrar_anexos($idformato,$iddoc){
	global $conn,$ruta_db_superior;
		$html="Anexos: ";
		$nombre_tabla=busca_filtro_tabla("b.nombre_tabla","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$iddoc,"");
		$anexos_fis=busca_filtro_tabla("anexos_fisicos",$nombre_tabla[0]['nombre_tabla'],"documento_iddocumento=".$iddoc,"");
		if($anexos_fis['numcampos']){
			if($anexos_fis[0]['anexos_fisicos']!=''){
				$html.=$anexos_fis[0]['anexos_fisicos'].", ";
			}
		}
	  $anex=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"");
		for($i=0;$i<$anex['numcampos'];$i++){
			if($_REQUEST["tipo"]==5)
				$html.= '<a title="Descargar" href="anexosdigitales/parsea_accion_archivo.php?idanexo='.$anex[$i]['idanexos'].'&amp;accion=descargar" border="0px">'.$anex[$i]['etiqueta'].'</a> &nbsp;';
			else
				$html.= '<a title="Descargar" href="../../anexosdigitales/parsea_accion_archivo.php?idanexo='.$anex[$i]['idanexos'].'&amp;accion=descargar" border="0px">'.$anex[$i]['etiqueta'].'</a> &nbsp;';
		}
		if($anexos_fis[0]['anexos_fisicos']!='' || $anex['numcampos']>0){
			echo $html."<br/><br/>";
		}
}

function mostrar_iniciales($idformato,$iddoc){
	

	$datos=busca_filtro_tabla("B.nombres, B.apellidos","documento A, funcionario B","A.ejecutor=B.funcionario_codigo AND A.iddocumento=".$iddoc,"");

  $apellido = explode(' ', $datos[0]['apellidos']);
	$cadena= $datos[0]['nombres']." ".$apellido[0];

	echo ($cadena);
}

//---------------------------------mostrar qr------------------------------//
function parsear_arbol_expediente_serie_memorando(){
    global $conn,$ruta_db_superior;
    ?>
    <script>
        $(document).ready(function(){
             tree_serie_idserie.setOnCheckHandler(parsear_expediente_serie);
        });
        function parsear_expediente_serie(nodeId){
            var idexpediente_idserie = nodeId.split('.');
            $('[name="serie_idserie"]').val(idexpediente_idserie[0]);
            $('[name="expediente_serie"]').val(idexpediente_idserie[1]);
            var seleccionados=tree_serie_idserie.getAllChecked();
            var vector_seleccionados=seleccionados.split(',');
            for(i=0;i<vector_seleccionados.length;i++){
            	if(vector_seleccionados[i]!=nodeId){
            		tree_serie_idserie.setCheck(vector_seleccionados[i],0 );
            	}
            }
        }
    </script>
    <?php  
}


function vincular_expediente_serie_memorando($idformato, $iddoc) {//POSTERIOR AL APROBAR
	global $conn, $ruta_db_superior;
	$datos = busca_filtro_tabla("expediente_serie,documento_iddocumento", "ft_memorando", "documento_iddocumento=" . $iddoc, "");
	if($datos["numcampos"] && !empty($datos[0][0])){
		$vinculado = busca_filtro_tabla("", "expediente_doc", "documento_iddocumento=" . $datos[0]['documento_iddocumento'] . " AND expediente_idexpediente=" . $datos[0]['expediente_serie'], "");
		if (!$vinculado['numcampos']) {
			$sql = "INSERT INTO expediente_doc (expediente_idexpediente,documento_iddocumento,fecha) VALUES (" . $datos[0]['expediente_serie'] . "," . $datos[0]['documento_iddocumento'] . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s') . ")";
			phpmkr_query($sql);
		}
	}
}

function formato_radicado_interno($idformato, $iddoc, $retorno = 0) {//MOSTRAR
	
	$formato = busca_filtro_tabla("", "formato A", "A.idformato=" . $idformato, "");
	$datos_documento = busca_filtro_tabla(fecha_db_obtener('A.fecha', 'Y-m-d') . " as x_fecha, A.*, B.*", "documento A, " . $formato[0]["nombre_tabla"] . " B", "A.iddocumento=B.documento_iddocumento AND A.iddocumento=" . $iddoc, "");
	$dep = busca_filtro_tabla("B.codigo,B.codigo_arbol", "dependencia_cargo A, dependencia B", "A.iddependencia_cargo=" . $datos_documento[0]["dependencia"] . " AND A.dependencia_iddependencia=B.iddependencia", "");

	$fecha = $datos_documento[0]["x_fecha"];
	//año mes dia
	$fecha_sin_guion = str_replace("-", "", $fecha);
	$cadena = $fecha_sin_guion;

	$ruta = busca_filtro_tabla("", "ruta", "tipo<>'INACTIVO' and documento_iddocumento=" . $iddoc, "");
	if ($ruta['numcampos'] > 0) {

		$depcar = $ruta[$ruta['numcampos'] - 1]['origen'];
		$dep2 = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia_cargo=" . $depcar, "");
		$cod = busca_filtro_tabla("", "dependencia", "iddependencia=" . $dep2[0]['iddependencia'], "");

		$dep = busca_filtro_tabla("codigo_arbol", "dependencia", "iddependencia=" . $dep2[0]['iddependencia'], "");
		$tem = explode('.', $dep[0]['codigo_arbol']);

		if (count($tem) == 2) {
			$tercer = busca_filtro_tabla("", "dependencia", "iddependencia=" . $tem[1], "");
		} else {
			$tercer = busca_filtro_tabla("", "dependencia", "iddependencia=" . $tem[2], "");
		}

		$cadena .= $tercer[0]['codigo'];
		// (muestra la direccion del ultimo en la ruta)

	} else {
		$tem = explode('.', $dep[0]['codigo_arbol']);
		if (count($tem) == 2) {
			$tercer = busca_filtro_tabla("", "dependencia", "iddependencia=" . $tem[1], "");
		} else {
			$tercer = busca_filtro_tabla("", "dependencia", "iddependencia=" . $tem[2], "");
		}

		$cadena .= $tercer[0]["codigo"];
	}

	if (strlen($datos_documento[0]["numero"]) == 1) {
		$cadena .= '000<b>' . $datos_documento[0]["numero"] . '</b>';
	}
	if (strlen($datos_documento[0]["numero"]) == 2) {
		$cadena .= '00<b>' . $datos_documento[0]["numero"] . '</b>';
	}
	if (strlen($datos_documento[0]["numero"]) == 3) {
		$cadena .= '0<b>' . $datos_documento[0]["numero"] . '</b>';
	}
	if (strlen($datos_documento[0]["numero"]) > 3) {
		$cadena .= '<b>' . $datos_documento[0]["numero"] . '</b>';
	}

	$cadena .= "-3";
	if ($retorno == 1) {
		return ($cadena);
	}
	echo($cadena);
}

?>
