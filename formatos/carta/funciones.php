<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias_funciones_generales.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");


function link_editar_funcion($idformato,$iddoc){
	global $conn;

	$firmante=busca_filtro_tabla("destino","buzon_entrada","origen=18 and lower(nombre) like 'por_aprobar' and archivo_idarchivo=".$iddoc,"",$conn);
	$aprobado=busca_filtro_tabla("","buzon_salida","lower(nombre) like 'aprobado' and archivo_idarchivo=".$iddoc,"",$conn);

	if($_REQUEST["tipo"]<>5){
		$usuario=usuario_actual("funcionario_codigo");
		$texto="<a href='editar_carta.php?iddoc=".$iddoc."&idformato=".$idformato."'><img width='16' height='16' src='../../botones/comentarios/editar_documento.png'></a>";
		if($usuario==$firmante[0][0]&&$aprobado["numcampos"]==0){
			echo ($texto);
		}
	}
}


function cargar_destinos_carta($idformato,$idcampo,$iddoc)
{global $conn;
 echo '<script>
 $("#destinos").before(\'<table><tr><td><b>Carga del Remitente:</b></td><td><a href="#" id="carga_respuesta" anterior="'.$_REQUEST["anterior"].'" >Cargar Remitente Origen</a></td><td><a href="#" id="exportar_remitentes" >Exportar Remitentes</a></td><td><a href="carga_remitentes.php?opcion=3&campo=destinos" id="importar_remitentes" class="highslide" onclick="return hs.htmlExpand(this, { \'+"objectType: \'iframe\',width: 500, height:400,preserveContent:false"+\' } )" style="text-decoration:underline;">Importar Remitentes</a></td></tr></table>\');
    </script>';
}


function mostrar_destinos($idformato, $iddoc) {
	global $conn;
	$tabla = busca_filtro_tabla("ruta_mostrar,nombre,nombre_tabla", "formato", "idformato=" . $idformato, "", $conn);
	$resultado = busca_filtro_tabla("", $tabla[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
	if (isset($_REQUEST["destino"]) && $_REQUEST["destino"] <> "") {
		$ejecutor = busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa", "datos_ejecutor,ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $_REQUEST["destino"], "", $conn);
		$destinos = explode(",", $resultado[0]["destinos"]);
	} elseif (strpos($resultado[0]["destinos"], ",") > 0) {
		$destinos = explode(",", $resultado[0]["destinos"]);
		$ejecutor = busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa", "datos_ejecutor,ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $destinos[0], "", $conn);
	} else {
		$ejecutor = busca_filtro_tabla("nombre,telefono,titulo,direccion,ciudad,cargo,empresa", "datos_ejecutor,ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $resultado[0]["destinos"], "", $conn);
	}

	$municipio = busca_filtro_tabla("nombre,departamento_iddepartamento", "municipio", "idmunicipio ='" . strtolower($ejecutor[0]["ciudad"]) . "'", "", $conn);
	if ($ejecutor[0]["ciudad"] != 883) {
		$departamento = busca_filtro_tabla("nombre,pais_idpais", "departamento", "iddepartamento=" . $municipio[0]["departamento_iddepartamento"], "", $conn);
	}
	$_pais = "";
	if ($departamento[0]["pais_idpais"] > 1) {
		$pais = busca_filtro_tabla("nombre", "pais", "idpais=" . $departamento[0]["pais_idpais"], "", $conn);
		if ($pais[0]["nombre"] != $departamento[0]["nombre"])
			$_pais = ", " . $pais[0]["nombre"];
	}

	if ($_REQUEST["tipo"] != 5 && isset($destinos)) {
		$select_dest = '<div id="destinos">Destinos:&nbsp;<select name="s_destinos" id="s_destinos"  onchange="window.location=' . "'" . $tabla[0]["ruta_mostrar"] . "?tipo=1&destino='+this.value+'&iddoc=" . $iddoc . "'" . '">';
		$lista = "'" . implode("','", explode(",", $resultado[0]["destinos"])) . "'";
		$destinos = busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa,iddatos_ejecutor", "datos_ejecutor,ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor in(" . $lista . ")", "nombre", $conn);
		$select_dest .= "<option value=''>Seleccionar...</option>";
		for ($i = 0; $i < $destinos["numcampos"]; $i++) {
			$select_dest .= "<option value=" . $destinos[$i]["iddatos_ejecutor"] . ">" . $destinos[$i]["nombre"] . "</option>";
		}
		$select_dest .= "</select></div><br />";
		echo $select_dest;
	}
	$html = "";
	if ($ejecutor[0]["titulo"] != "") {
		$html .= $ejecutor[0]["titulo"] . "<br/>";
	}
	if ($ejecutor[0]["nombre"] != "") {
		$html .= mayusculas($ejecutor[0]["nombre"]) . "<br />";
	}
	if ($ejecutor[0]["cargo"] <> "") {
		$html .= $ejecutor[0]["cargo"] . "<br />";
	}
	if ($ejecutor[0]["empresa"] != "") {
		$html .= '<strong>' . $ejecutor[0]["empresa"] . '</strong><br/>';
	}
	if ($ejecutor[0]["direccion"] <> "") {
		$html .= $ejecutor[0]["direccion"] . "<br/>";
	}
	if ($ejecutor[0]["telefono"] != "") {
		$html .= $ejecutor[0]["telefono"] . "<br />";
	}
	if ($municipio[0]["nombre"] != "") {
		$html .= $municipio[0]["nombre"];
	}
	if ($departamento[0]["nombre"] != "") {
		$html .= ", " . ucwords(strtolower($departamento[0]["nombre"])) . $_pais;
	}
	echo $html;
}

function mostrar_destinos_carta($idformato, $iddoc) {
	global $conn;

	$tabla = busca_filtro_tabla("ruta_mostrar,nombre,nombre_tabla", "formato", "idformato=" . $idformato, "", $conn);
	$resultado = busca_filtro_tabla("", $tabla[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
	if (isset($_REQUEST["destino"]) && $_REQUEST["destino"] <> "") {
		$ejecutor = busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa", "datos_ejecutor,ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $_REQUEST["destino"], "", $conn);
		$destinos = explode(",", $resultado[0]["destinos"]);
	} elseif (strpos($resultado[0]["destinos"], ",") > 0) {
		$destinos = explode(",", $resultado[0]["destinos"]);
		$ejecutor = busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa", "datos_ejecutor,ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $destinos[0], "", $conn);
	} else
		$ejecutor = busca_filtro_tabla("nombre,telefono,titulo,direccion,ciudad,cargo,empresa", "datos_ejecutor,ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $resultado[0]["destinos"], "", $conn);

	$nombres = '';
	for ($i = 0; $i < $ejecutor['numcampos']; $i++) {
		$nombres .= $ejecutor[$i]['titulo'] . ' ' . $ejecutor[$i]['nombre'] . ', ';
	}

	echo(ucwords(substr($nombres, 0, -1)));
}

function copias_carta($idformato,$idcampo,$iddoc=NULL)
{if($iddoc==NULL)
   {echo '<td bgcolor="#F5F5F5">
    <input type="hidden" name="copia" id="nombre_copias" id="nombre_copias" value="" >
    <b>DESTINOS ELEGIDOS:</b><br />
    <input type="text" id="destinos_copias" value="" size=150 readonly=true >
    <hr />
    <iframe name="frame_copias" id="frame_copias" src="'.compara_ruta_archivos('/'.RUTA_SCRIPT.'/formatos/carta/funciones_adicionales.php').'?funcion=elegir_destinos&copia=1" width=100% height=190px class=phpmkr border=0 frameborder="0" y framespacing="0">
    </iframe></td>';
   }
 else
   {echo '<td bgcolor="#F5F5F5"><iframe src="'.compara_ruta_archivos('/'.RUTA_SCRIPT.'/formatos/carta/funciones_adicionales.php').'?funcion=editar_copias&iddoc='.$iddoc.'&tabla=ft_carta" width=100% height=170px class=phpmkr border=0 frameborder="0" framespacing="0" >
            </iframe></td>';
   }
}
function destinos_carta($idformato,$idcampo,$iddoc=NULL)
{global $conn;
 $tabla=busca_filtro_tabla("nombre_tabla","formato","idformato=$idformato","",$conn);
 if($iddoc==NULL)
    {echo '<td bgcolor="#F5F5F5">
     <input type="hidden" name="destinos" id="nombre" value="" class="required" obligatorio="obligatorio">
     <b>DESTINOS ELEGIDOS:</b><br />
     <input type="text" id="destinos_nombres" value="" size=150 readonly=true >
     <hr />
     <iframe name="frame_destinos" id="frame_destinos" src="'.compara_ruta_archivos('/'.RUTA_SCRIPT.'/formatos/carta/funciones_adicionales.php').'?funcion=elegir_destinos" width=100% height=210px class=phpmkr border=0 frameborder="0" y framespacing="0">
     </iframe></td>';
    }
 else
    {echo '<td bgcolor="#F5F5F5"><iframe src="'.compara_ruta_archivos('/'.RUTA_SCRIPT.'/formatos/carta/funciones_adicionales.php').'?funcion=editar_destinos&iddoc='.$iddoc.'&tabla='.$tabla[0]["nombre_tabla"].'" width=100% height=210px class=phpmkr border=0 frameborder="0" framespacing="0" >
            </iframe></td>';
    }
}
function mostrar_copias_carta($idformato,$iddoc=NULL)
{global $conn;

 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $inf_memorando=busca_filtro_tabla("copia,copiainterna,vercopiainterna,fecha_carta,tipo_copia_interna",$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);

 if($inf_memorando[0]["copia"]<>"")
    {echo '<div align="justify"><font size=2>Con Copia: ';
     $destinos=explode(",",$inf_memorando[0]["copia"]);
     $lista=array();
        	for($i=0;$i<count($destinos);$i++)
            {$resultado=busca_filtro_tabla("e.nombre,direccion,empresa,titulo,cargo,m.nombre as ciudad",DB.".ejecutor e, ".DB.".municipio m,".DB.".datos_ejecutor d","idejecutor=ejecutor_idejecutor and idmunicipio=d.ciudad and iddatos_ejecutor=".$destinos[$i],"",$conn);
            //print_r($resultado);
          $lista[]="- ".str_replace(", ,"," ",(($resultado[0]["titulo"]." ".$resultado[0]["nombre"].", ".$resultado[0]["cargo"].", ".$resultado[0]["empresa"].", ".$resultado[0]["direccion"].", ".$resultado[0]["ciudad"])));

                }
   $lista=implode("<br />",$lista);
   echo $lista.'<br /><br /></font></div>';
    }
  mostrar_copia_interna($inf_memorando[0]["copiainterna"],$inf_memorando[0]["vercopiainterna"],$inf_memorando[0]["fecha_carta"],$inf_memorando[0]["tipo_copia_interna"]);
}

function mostrar_copia_interna($copia,$tipo="",$fecha,$tipo_copia)
{
 global $conn;
 if($tipo!="" && $tipo==0)
  $copia ="";
 if($copia<>"")
    {echo '<font size=2>Copia interna: ';
     $destinos=explode(",",$copia);
     //jaja,print_r($destinos);
     $lista=array();
        	for($i=0;$i<count($destinos);$i++)
            {//si el destino es una dependencia
             if(strpos($destinos[$i],"#")>0)
                {$resultado=busca_filtro_tabla("nombre",DB.".dependencia","iddependencia=".str_replace("#","",$destinos[$i]),"",$conn);
                 $lista[]=ucwords($resultado[0]["nombre"]);
                }
             else//si el destino es un funcionario
                {/*$resultado=busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre",DB.".funcionario,".DB.".cargo c,".DB.".dependencia_cargo dc","dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and funcionario_codigo=".$destinos[$i],"",$conn);
                 $cargo=busca_filtro_tabla("nombre","cargo,dependencia_cargo","cargo_idcargo=idcargo and funcionario_idfuncionario=".$resultado[0]["idfuncionario"],"",$conn);*/
                 $condicion="";
                 if($tipo_copia==1)
                   $condicion=" and funcionario_codigo='".$destinos[$i]."' ";
                 elseif($tipo_copia==2)
                   $condicion=" and iddependencia_cargo='".$destinos[$i]."' ";
                 $resultado = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre,fecha_inicial","cargo c,dependencia_cargo,funcionario,dependencia d","c.idcargo=cargo_idcargo and funcionario_idfuncionario=idfuncionario $condicion and dependencia_iddependencia=iddependencia ","fecha_inicial desc",$conn);

              //si no tiene rol activo en esas fechas busco el ultimo
               if(!$resultado["numcampos"])
                 {$resultado = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","cargo c,dependencia_cargo,funcionario,dependencia d","c.idcargo=cargo_idcargo and funcionario_idfuncionario=idfuncionario and dependencia_iddependencia=iddependencia $condicion","fecha_inicial desc",$conn);

                               //$lista[]=cargos_memo($destinos[$i],$fecha,"para");
                }
              //print_r($resultado);
              $lista[]=("- ".(ucwords($resultado[0]["nombres"]." ".($resultado[0]["apellidos"])).", ").($resultado[0]["nombre"]));
            }
       }
     echo (implode("; ",$lista));
     echo '</font><br /><br />';

  }
 return true;
}

function arbol_copia_interna($idformato,$idcampo,$iddoc=Null)
{
 global $conn;
 $campo=busca_filtro_tabla("","campos_formato","idcampos_formato=$idcampo","",$conn);
 $copia_interna=0;
 if($iddoc<>NULL)
    {$tabla=busca_filtro_tabla("nombre_tabla","formato","idformato=$idformato","",$conn);
     $valor=busca_filtro_tabla($campo[0]["nombre"].",vercopiainterna,tipo_copia_interna",$tabla[0]['nombre_tabla'],"documento_iddocumento=$iddoc","",$conn);

     if($valor[0]["vercopiainterna"])
        $copia_interna=1;
     $vector=explode(",",str_replace("#","d",$valor[0][0]));
     $valores=str_replace("#","d",$valor[0][0]);
     $ruta="../../test_rol.php?tipo_arbol=r&seleccionado=$valores";
     //$ruta="../../test.php?seleccionado=$valores&tipo_arbol=r";
     $nombres=array();
     foreach($vector as $fila)
        {if(strpos($fila,'d')>0)
            {$datos=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("d","",$fila),"",$conn);
            $nombres[]=$datos[0]["nombre"];
            }
         else
            {if($valor[0]["tipo_copia_interna"]==1)
             $datos=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$fila,"",$conn);
             elseif($valor[0]["tipo_copia_interna"]==2)
             $datos=busca_filtro_tabla("nombres,apellidos","funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$fila,"",$conn);
             $nombres[]=$datos[0]["nombres"]." ".$datos[0]["apellidos"];;
            }
        }
     $nombres= implode("<br />",$nombres);
    }
 else
    {$ruta="../../test_rol.php?tipo_arbol=r";
     //$ruta="../../test.php?tipo_arbol=r";
     $valor[0][0]='';
     $nombres="";
    }
 $texto.='<td bgcolor="#F5F5F5">	'.$nombres.'<br /><br />
<div id="treeboxbox_'.$campo[0]["nombre"].'"></div>	';
//miro si ya estan incluidas las librerias del arbol
  $texto.= '<input type="hidden" name="'.$campo[0]["nombre"].'" id="'.$campo[0]["nombre"].'" ';
  if($campo[0]["obligatoriedad"])
      $texto.='class="required" obligatorio="obligatorio" ';
  else
      $texto.='obligatorio="" ';
  $texto.=' value="'.$valor[0][0].'" >
  <script type="text/javascript">
  <!--
			tree_'.$campo[0]["nombre"].'=new dhtmlXTreeObject("treeboxbox_'.$campo[0]["nombre"].'","100%","100%",0);
			tree_'.$campo[0]["nombre"].'.setImagePath("../../imgs/");
			tree_'.$campo[0]["nombre"].'.enableIEImageFix(true);
			tree_'.$campo[0]["nombre"].'.enableCheckBoxes(1);
			tree_'.$campo[0]["nombre"].'.enableThreeStateCheckboxes(true);
			tree_'.$campo[0]["nombre"].'.setXMLAutoLoading("'.$ruta.'");
			tree_'.$campo[0]["nombre"].'.loadXML("'.$ruta.'");
      tree_'.$campo[0]["nombre"].'.setOnCheckHandler(onNodeSelect_'.$campo[0]["nombre"].');
      function onNodeSelect_'.$campo[0]["nombre"].'(nodeId)
      {valor=document.getElementById("'.$campo[0]["nombre"].'");
       pos=nodeId.indexOf("_");
       if(pos>0)
           nodeId=nodeId.substring(0,pos);
       if(valor.value!="")
         {
          existe=buscarItem(valor.value,nodeId);
          if(existe>=0)
            {nuevo=eliminarItem(valor.value,nodeId);
             valor.value=nuevo;
            }
          else
            valor.value+=","+nodeId;
         }
      else
         valor.value=nodeId;
      }
	-->
	</script>
  </td></tr>';
   echo $texto;
  echo '<tr><td class="encabezado">VISIBLE LA COPIA INTERNA EN LA CARTA</td><td bgcolor="#F5F5F5"> <input type="radio" name="vercopiainterna" value="1" ';
  if($copia_interna)
     echo " checked ";
  echo '>Si&nbsp;&nbsp;<input type="radio" name="vercopiainterna" value="0" ';
  if(!$copia_interna)
     echo " checked ";
  echo '>No</td></tr>';
}

function reglas_documentos($idformato,$iddoc,$fund_cod,$nombre_cargos){
global $ruta_db_superior,$conn;

        $reemplazos=busca_filtro_tabla("","reemplazo A, dependencia_cargo B, funcionario C","A.activo=1 and nuevo=iddependencia_cargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo=".$fund_cod,"",$conn);
        //print_r($reemplazos);
        if($reemplazos["numcampos"]>0){
        $cargo=busca_filtro_tabla("","cargo","idcargo=".$reemplazos[0]["cargo_idcargo"],"",$conn);

        $nombre_cargos=array_unique($nombre_cargos);
        $cantidad=count($nombre_cargos);
        $repetido=False;
        for($i=0;$i<$cantidad;$i++){
        $antiguo=busca_filtro_tabla("","dependencia_cargo, cargo B","iddependencia_cargo=".$reemplazos[0]["antiguo"]." and cargo_idcargo=idcargo and lower(B.nombre) like '%".$nombre_cargos[$i]."%'","",$conn);
        if($antiguo["numcampos"]>0){
        $repetido=True;
        }

        }

        if(!$repetido)
        echo $antiguo[0]["nombre"]."(Suplente)";
        }

}


function mostrar_imagenes_escaneadas($idformato, $iddoc) {
	global $conn;
	$html = "";
	$formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato . " and detalle=1", "", $conn);
	if (isset($_REQUEST["anterior"]) && $_REQUEST["anterior"] != "" && $formato["numcampos"] == 0) {
		$doc = $_REQUEST["anterior"];
		$opt = 0;
	} else if ($_REQUEST["iddoc"]) {
		$doc = $_REQUEST["iddoc"];
		$opt = 1;
	}

	if(!empty($doc)) {
	    $doc_anterior = busca_filtro_tabla("descripcion,numero", "documento", "iddocumento=" . $doc, "", $conn);
	} else {
	    $doc_anterior = array("numcampos" => 0);
	}
	if ($doc_anterior["numcampos"] && $opt == 0) {
		$html .= "<strong>Se est&aacute; dando respuesta al documento: </strong>&nbsp;&nbsp;" . $doc_anterior[0]["numero"] . " " . $doc_anterior[0]["descripcion"] . "<br /><br />";
	}
	if(!empty($doc)) {
	    $imagenes = busca_filtro_tabla("consecutivo,imagen,ruta,pagina", "pagina", "id_documento=" . $doc, "", $conn);
	} else {
	    $imagenes = array("numcampos" => 0);
	}
	if ($imagenes["numcampos"]) {
		$html .= '<div id="mainContainer"><div id="content">';
		for ($i = 0; $i < $imagenes["numcampos"]; $i++) {
			$html .= '<a href="#" onclick="displayImage(\'' . $imagenes[$i]["ruta"] . '\',\'P&aacute;gina ' . $imagenes[$i]["pagina"] . '\',\'\');return false">
				<img src="" border="1">
			</a>';
			if ($imagenes[$i]["pagina"] == (round($imagenes[$i]["pagina"] / 8) * 8))
				$html .= "<br/><br/>";
		}
		$html .= "</div></div>";
	}
	$html .= "<hr/>";
	echo $html;
}


function mostrar_dependencia_carta($idformato,$iddoc)
{
    global $conn,$ruta_db_superior;
 $formato=busca_filtro_tabla("dependencia,firma_dependencia","ft_carta","documento_iddocumento=$iddoc","",$conn);
 if($formato[0]["firma_dependencia"]==1){
$dependencia=busca_filtro_tabla("dependencia_iddependencia","dependencia_cargo","  iddependencia_cargo =".$formato[0]["dependencia"],"",$conn);
$nombre_dependencia=busca_filtro_tabla("nombre","dependencia","iddependencia =".$dependencia[0]["dependencia_iddependencia"],"",$conn);
echo($nombre_dependencia[0]["nombre"]);

 }

}
if(@$_REQUEST["tipo"]!=5){
	echo(librerias_jquery('1.7'));
?>
<link rel="stylesheet" href="<?php echo ($ruta_db_superior); ?>css/image-enlarger.css" media="screen" type="text/css" />
<script type="text/javascript" src="<?php echo ($ruta_db_superior); ?>js/dhtml-suite-for-applications.js"></script>
<script>
function displayImage(imagePath,title,description)
{
		var enlargerObj = new DHTMLSuite.imageEnlarger();
		enlargerObj.setIsDragable(true);
		enlargerObj.setIsModal(false);
		DHTMLSuite.commonObj.setCssCacheStatus(false);
		enlargerObj.displayImage(imagePath,title,description);
}
$().ready(function() {
$("#exportar_remitentes").click(function(){
   if($("#destinos").val()!='' || $("#copia").val()!=''){
   window.open("carga_remitentes.php?opcion=2&destinos="+$("#destinos").val()+"&copias="+$("#copia").val());
   }
   else
    alert("No hay datos para exportar");
});

$("#carga_respuesta").click(function(){
 $.ajax({url: "carga_remitentes.php",
   type: "POST",
   data: "opcion=1&adicionales="+$("#carga_respuesta").attr("anterior")+"&formato_origen=radicacion_entrada&campo=persona_natural",
   success: function(msg) {
   if(msg==0)
      alert('El documento que está respondiendo debe ser una radicación de entrada para poder usar esta opción');
   else
     {vector=msg.split('|');
      $("#destinos").val(vector[1]);
      document.getElementById("frame_destinos").src="../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=copia&tabla=ft_carta&campos_auto=nombre,identificacion&tipo=multiple&campos=cargo,empresa,direccion,telefono,email,titulo,ciudad&destinos="+vector[1];
     }
  }
  });
});

});
/*
<Clase>
<Nombre> autocompletar
<Parametros>idcomponente-id del componente;digitado-valor digitado
<Responsabilidades>llama la función en php que consulta la bd y llena la lista de opciones
<Notas>para el autocompletar
<Excepciones>
<Salida>una lista de los valores coincidentes
<Pre-condiciones>
<Post-condiciones>
*/
function autocompletar(idcomponente,digitado,tipo)
{letras=digitado.length;
 if(letras!=1 && (letras%3)==0)
  {
  llamado("../../Autocompletar.php","comple"+idcomponente,"op=autocompl&idcomponente="+idcomponente+"&digitado="+digitado+"&depende=1&tipo="+tipo);
  document.getElementById("comple"+idcomponente).style.display="inline";
  }
}



</script>
<?php
}
function mostrar_datos_radicacion($idformato, $iddoc){
	global $conn;
	echo(estilo_bootstrap());
	$datos_radicacion = busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	$nombre_empresa = busca_filtro_tabla("valor","configuracion","LOWER(nombre) LIKE'nombre'","",$conn);
	if($_REQUEST['tipo']!=5){
		$margin="margin-top:37px;";
	}else{
		$margin="margin-top:-30px;";
	}
	$datos="<br/><b>
	".$nombre_empresa[0]['valor']."</b><br />";
	$datos.="<b>&nbsp;Radicación No:</b> ".formato_numero($idformato,$iddoc,1).'<br />';
	$date = new DateTime($datos_radicacion[0]['fecha']);
	$datos.="<b>&nbsp;Fecha:</b> ".$date->format('Y-m-d H:i').'<br />';

	echo($datos);
}

function mostrar_anexos_externa($idformato, $iddoc) {
	$fisicos = mostrar_valor_campo('anexos_fisicos', $idformato, $iddoc, 1);
	$digitales = mostrar_valor_campo('anexos_digitales', $idformato, $iddoc, 1);
	if ($fisicos != "" || $digitales != "") {
		$digitales = preg_replace("%(<div.*?>)(.*?)(<\/div.*?>)%is", "", $digitales);
		echo "Anexos: " . $fisicos . " " . strip_tags($digitales, '<a>') . "<br/><br/>";
	}
}

function mostrar_copias_comunicacion_ext($idformato, $iddoc) {
	global $conn;
	$datos = busca_filtro_tabla("nombre,nombre_tabla", "formato", "idformato=".$idformato, "", $conn);
	$inf_memorando = busca_filtro_tabla("copia,copiainterna,vercopiainterna", $datos[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
	if ($inf_memorando[0][0] <> "") {
		echo '<span>Copia: ';
		$destinos = explode(",", $inf_memorando[0][0]);
		$destinos = array_unique($destinos);
		sort($destinos);
		$lista = array();
		for ($i = 0; $i < count($destinos); $i++) {
			$ejecutores = busca_filtro_tabla("nombre,cargo", "ejecutor e,datos_ejecutor de", "de.ejecutor_idejecutor=e.idejecutor and iddatos_ejecutor=" . $destinos[$i], "", $conn);
			if ($ejecutores[0][1] != "") {
				$cargo = "," . ucwords(strtolower($ejecutores[0][1]));
			}
			$lista[] = ucwords(strtolower($ejecutores[0][0])) . $cargo;
		}
		echo implode(", ", $lista);
		if ($inf_memorando[0]['vercopiainterna'] == 1 && $inf_memorando[0]['copiainterna'] <> "") {
			$copiainterna = mostrar_cop_interna_externa($inf_memorando[0]['copiainterna']);
			echo "," . implode(", ", $copiainterna);
		}
		echo '</span><br/><br/>';
	} elseif ($inf_memorando[0]['vercopiainterna'] == 1 && $inf_memorando[0]['copiainterna'] <> "") {
		echo '<span>Copia: ';
		$copiainterna = mostrar_cop_interna_externa($inf_memorando[0]['copiainterna']);
		echo implode(", ", $copiainterna) . '</span><br/><br/>';
	}
}

function mostrar_cop_interna_externa($copiainterna) {
	global $conn;
	$destinos = explode(",", $copiainterna);
	$destinos = array_unique($destinos);
	sort($destinos);
	$lista = array();
	for ($i = 0; $i < count($destinos); $i++) {//si el destino es una dependencia
		if (strpos($destinos[$i], "#") > 0) {
			$resultado = busca_filtro_tabla("nombre", "dependencia", "iddependencia=" . str_replace("#", "", $destinos[$i]), "", $conn);
			$lista[] = ucwords(strtolower($resultado[0]["nombre"]));
		} else {
			$resultado = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre", "funcionario,cargo c,dependencia_cargo dc", "dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and iddependencia_cargo=" . $destinos[$i], "", $conn);
			$lista[] = ucwords(strtolower($resultado[0]["nombres"] . " " . $resultado[0]["apellidos"]));
			if ($resultado[0]['nombre'] <> "") {
				$lista[] = ucwords(strtolower($resultado[0]["nombre"]));
			}
		}
	}
	return $lista;
}



function parsear_arbol_expediente_serie_carta(){
    global $conn,$ruta_db_superior;
?>
<script>
	$(document).ready(function() {
		tree_serie_idserie.setOnCheckHandler(parsear_expediente_serie);
	});
	function parsear_expediente_serie(nodeId) {
		console.log(nodeId);
		var datos = tree_serie_idserie.getUserData(nodeId,"idexpediente");
		console.log(datos);
		if(datos) {
			$('[name="expediente_serie"]').val(datos);
		} else {
			$('[name="expediente_serie"]').val("");
		}
		/*if(idexpediente_idserie.length > 1) {
    		$('[name="expediente_serie"]').val(idexpediente_idserie[0]);
		}
		var seleccionados = tree_serie_idserie.getAllChecked();
		var vector_seleccionados = seleccionados.split(',');
		for ( i = 0; i < vector_seleccionados.length; i++) {
			if (vector_seleccionados[i] != nodeId) {
				tree_serie_idserie.setCheck(vector_seleccionados[i], 0);
			}
		}*/
	}
</script>
<?php
}

function vincular_expediente_serie_carta($idformato,$iddoc){ //POSTERIOR AL APROBAR
    global $conn,$ruta_db_superior;

    $datos=busca_filtro_tabla("expediente_serie,documento_iddocumento","ft_carta","documento_iddocumento=".$iddoc,"",$conn);
    //print_r($datos);die();

    $vinculado=busca_filtro_tabla("","expediente_doc","documento_iddocumento=".$datos[0]['documento_iddocumento']." AND expediente_idexpediente=".$datos[0]['expediente_serie'],"",$conn);
    if(!$vinculado['numcampos']){
        $sql="INSERT INTO expediente_doc (expediente_idexpediente,documento_iddocumento,fecha) VALUES (".$datos[0]['expediente_serie'].",".$datos[0]['documento_iddocumento'].",".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').")";
        phpmkr_query($sql);
    }
}

function formato_radicado_enviada($idformato, $iddoc, $retorno = 0) {
	global $conn;
	$cadena = "";
	$formato = busca_filtro_tabla("nombre_tabla", "formato A", "A.idformato=" . $idformato, "", $conn);
	if ($formato["numcampos"]) {
		$datos_documento = busca_filtro_tabla(fecha_db_obtener('A.fecha', 'Y-m-d') . " as x_fecha, A.*, B.*", "documento A, " . $formato[0]["nombre_tabla"] . " B", "A.iddocumento=B.documento_iddocumento AND A.iddocumento=" . $iddoc, "", $conn);
		if ($datos_documento["numcampos"]) {
			$cadena .= str_replace("-", "", $datos_documento[0]["x_fecha"]);
			$ruta = busca_filtro_tabla("origen,tipo_origen", "ruta", "tipo='ACTIVO' and documento_iddocumento=" . $iddoc, "orden desc", $conn);
			$ok = 0;
			if ($ruta["numcampos"] > 1) {
				if ($ruta[0]["tipo_origen"] == 5) {
					$dep = busca_filtro_tabla("codigo", "vfuncionario_dc", "iddependencia_cargo=" . $ruta[0]["origen"], "", $conn);
					if ($dep["numcampos"]) {
						$ok = 1;
					}
				} else {
					$dep = busca_filtro_tabla("codigo", "vfuncionario_dc", "tipo_cargo=1 and funcionario_codigo=" . $ruta[0]["origen"], "iddependencia_cargo asc", $conn);
					if ($dep["numcampos"]) {
						$ok = 1;
					}
				}
			}
			if (!$ok) {
				$dep = busca_filtro_tabla("codigo", "vfuncionario_dc", "iddependencia_cargo=" . $datos_documento[0]["dependencia"], "", $conn);
			}
			$cadena .= str_pad("<b>" . $datos_documento[0]["numero"] . "</b>", 11, "0", STR_PAD_LEFT);
			$cadena .= "-1";
		}
	}
	if ($retorno == 1) {
		return ($cadena);
	} else {
		echo $cadena;
	}
}



function vincular_distribucion_carta($idformato,$iddoc){  //POSTERIOR AL APROBAR
	global $conn,$ruta_db_superior;

	$datos=busca_filtro_tabla("tipo_mensajeria,requiere_recogida","ft_carta","documento_iddocumento=".$iddoc,"",$conn);

	$estado_recogida=0;
	$estado_distribucion=1;
	if(!$datos[0]['requiere_recogida']){
		$estado_recogida=1;
		$estado_distribucion=0;
	}
	if($datos[0]['tipo_mensajeria']==3){
		$estado_distribucion=3;
	}

	include_once($ruta_db_superior."distribucion/funciones_distribucion.php");

	pre_ingresar_distribucion($iddoc,'dependencia',1,'destinos',2,$estado_distribucion,$estado_recogida); //INT -EXT
}

?>
