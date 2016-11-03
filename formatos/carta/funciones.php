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
include_once($ruta_db_superior."formatos/librerias_funciones_generales.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
//***************
function mostrar_qr_carta($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$estado_doc=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"", $conn);
	if($estado_doc[0]['estado']=='APROBADO'){
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
		if($codigo_qr['numcampos']){
			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
			$img='<img src="http://'.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"  />';
		}else{
			generar_codigo_qr_carta($idformato,$iddoc);
			$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
			$img='<img src="http://'.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'"   />';
		}
		echo($img);
	}
}

function generar_codigo_qr_carta($idformato,$iddoc){
  global $conn,$ruta_db_superior;
	include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
  $codigo_qr=busca_filtro_tabla("ruta_qr, iddocumento_verificacion","documento_verificacion","documento_iddocumento=".$iddoc,"", $conn);
  $datos=busca_filtro_tabla("A.fecha,A.estado, A.numero","documento A","A.iddocumento=".$iddoc,"",$conn);
	$fecha=mostrar_fecha_saia($datos[0]['fecha']);
	$datos_qr="Fecha: ".$fecha." \n";
	$datos_qr.="Radicado No: ".$datos[0]["numero"]." \n";
	$firmas=busca_filtro_tabla("CONCAT(B.nombres,CONCAT(' ',B.apellidos)) AS nombre","buzon_salida A, funcionario B","A.origen=B.funcionario_codigo AND (A.nombre LIKE 'APROBADO' OR A.nombre LIKE 'REVISADO')AND A.archivo_idarchivo=".$iddoc,"idtransferencia asc", $conn);
	$datos_qr.="Firman: \n";
	for($i=0; $i<$firmas['numcampos']; $i++){
	  $datos_qr .= $firmas[$i]['nombre']." \n";
	}
	$formato_ruta = aplicar_plantilla_ruta_documento($iddoc);
	$ruta=RUTA_QR.$formato_ruta . '/qr/';

	$imagen=generar_qr_carta($ruta,$datos_qr);

	if($imagen==false){
	  alerta("Error al tratar de crear el codigo qr");
	}else{
	  $fun_qr=usuario_actual('idfuncionario');
	  $sql_documento_qr="INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion) VALUES (".$iddoc.",".$fun_qr.",".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').",'".$imagen."','vacio')";
	  phpmkr_query($sql_documento_qr);
	}
}

function generar_qr_carta($filename,$datos,$matrixPointSize = 2,$errorCorrectionLevel = 'Q'){
  global $ruta_db_superior;
  include_once ($ruta_db_superior."phpqrcode/qrlib.php");

  if ($datos) {
        if (trim($datos) == ''){
            return false;
        }else{
          crear_destino($ruta_db_superior.$filename);
          $filename .= 'qr'.date('Y_m_d_H_m_s').'.jpg';

          QRcode::png($datos,$ruta_db_superior.$filename, $errorCorrectionLevel, $matrixPointSize, 0);
          return $filename;
        }
    }else{
      return false;
    }
}
//***************

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

function mostrar_iniciales($idformato,$iddoc){
	global $conn;

	$datos=busca_filtro_tabla("B.nombres, B.apellidos","documento A, funcionario B","A.ejecutor=B.funcionario_codigo AND A.iddocumento=".$iddoc,"",$conn);

  $apellido = explode(' ', $datos[0]['apellidos']);
	$cadena= $datos[0]['nombres']." ".$apellido[0];

	echo ($cadena);
}

function cargar_destinos_carta($idformato,$idcampo,$iddoc)
{global $conn;
 echo '<script>
 $("#destinos").before(\'<table><tr><td><b>Carga del Remitente:</b></td><td><a href="#" id="carga_respuesta" anterior="'.$_REQUEST["anterior"].'" >Cargar Remitente Origen</a></td><td><a href="#" id="exportar_remitentes" >Exportar Remitentes</a></td><td><a href="carga_remitentes.php?opcion=3" id="importar_remitentes" class="highslide" onclick="return hs.htmlExpand(this, { \'+"objectType: \'iframe\',width: 500, height:400,preserveContent:false"+\' } )">Importar Remitentes</a></td></tr></table>\');
    </script>';
}

function mostrar_anexos($idformato,$iddoc){
	global $conn,$ruta_db_superior;
		$html="Anexos: ";
		$anexos_fis=busca_filtro_tabla("anexos_fisicos","ft_comunicacion_interna","documento_iddocumento=".$iddoc,"",conn);
	  $html.=$anexos_fis[0]['anexos_fisicos']."&nbsp;";
	  $anex=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
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

function asunto_carta($idformato,$idcampo,$iddoc){
	global $conn;
	/*$formato=busca_filtro_tabla("plantilla, tipo_radicado, descripcion","documento","iddocumento=".$_REQUEST["anterior"],"",$conn);
	if($formato[0]["tipo_radicado"]==1){
		$texto.='<td>';
		$texto.= '<input type="text" name="asunto" id="asunto" size="60" value="'.$formato[0]["descripcion"].'">';
		$texto.='</td>';
		echo ($texto);
	}else{
		$plantilla=busca_filtro_tabla("asunto","ft_".$formato[0]["plantilla"],"documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
		if($plantilla[0]["asunto"]||$plantilla[0]["asunto"]!=""||$plantilla[0]["asunto"]!=NULL){
			//echo $plantilla[0]["asunto"];
			$texto.='<td>';
			$texto.='<input type="text" name="asunto" id="asunto" size="60" value="'.$plantilla[0]["asunto"].'">';
			$texto.='</td>';
			echo ($texto);

		}
	}*/

}
function mostrar_destinos($idformato,$iddoc)
{global $conn;

 $tabla=busca_filtro_tabla("ruta_mostrar,nombre,nombre_tabla",DB.".formato","idformato=".$idformato,"",$conn);

 $resultado=busca_filtro_tabla("",DB.".".$tabla[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);

  if(isset($_REQUEST["destino"]) && $_REQUEST["destino"]<>"" )
     {$ejecutor=busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa",DB.".datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$_REQUEST["destino"],"",$conn);
    // print_r($ejecutor);
      $destinos=explode(",",$resultado[0]["destinos"]);
     }
  elseif(strpos($resultado[0]["destinos"],",")>0)
    {$destinos=explode(",",$resultado[0]["destinos"]);
     $ejecutor=busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa",DB.".datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$destinos[0],"",$conn);
    }
  else
    $ejecutor=busca_filtro_tabla("nombre,telefono,titulo,direccion,ciudad,cargo,empresa",DB.".datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$resultado[0]["destinos"],"",$conn);

  $municipio=busca_filtro_tabla("nombre,departamento_iddepartamento","municipio","idmunicipio ='".strtolower($ejecutor[0]["ciudad"])."'","",$conn);
  if($ejecutor[0]["ciudad"]!=883)
   $departamento=busca_filtro_tabla("nombre,pais_idpais","departamento","iddepartamento=".$municipio[0]["departamento_iddepartamento"],"",$conn);
  $_pais="";
  if($departamento[0]["pais_idpais"]>1)
  {  $pais = busca_filtro_tabla("nombre","pais","idpais=".$departamento[0]["pais_idpais"],"",$conn);
    if($pais[0]["nombre"]!=$departamento[0]["nombre"])
     $_pais = ", ".$pais[0]["nombre"];
  }

 if((!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1) && isset($destinos))
     { ?>
     <div id="destinos" ">

     <?php
     echo 'Destinos:&nbsp;<select name="s_destinos" id="s_destinos"  onchange="window.location='."'".$tabla[0]["ruta_mostrar"]."?tipo=1&destino='+this.value+'&iddoc=".$iddoc."'".'">';
     $lista="'".implode("','",explode(",",$resultado[0]["destinos"]))."'";
     $destinos=busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa,iddatos_ejecutor",DB.".datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor in(".$lista.")","nombre",$conn);
     echo "<option value=''>Seleccionar...</option>";
     for($i=0;$i<$destinos["numcampos"];$i++)
        echo "<option value=".$destinos[$i]["iddatos_ejecutor"].">".$destinos[$i]["nombre"]."</option>";
     ?>

     </select>
     </div><br />
     <?php
      }
  echo  "".$ejecutor[0]["titulo"]."<br/>
        ".mayusculas($ejecutor[0]["nombre"])."<br />";
        if(ucwords($ejecutor[0]["cargo"])<>"")
            echo ("".$ejecutor[0]["cargo"])."<br />";
        if(ucwords($ejecutor[0]["empresa"])<>"")
            echo ('<b>'.$ejecutor[0]["empresa"].'</b>')."<br/>";
        if(ucwords($ejecutor[0]["direccion"])<>"")
            echo ("".$ejecutor[0]["direccion"])."<br>";
        if(ucwords($ejecutor[0]["telefono"])<>"")
            echo ("".$ejecutor[0]["telefono"])."<br />";
        echo "".$municipio[0]["nombre"].", ".ucwords(strtolower($departamento[0]["nombre"]))."$_pais.";
}

function mostrar_destinos_carta($idformato,$iddoc){
	global $conn;

 $tabla=busca_filtro_tabla("ruta_mostrar,nombre,nombre_tabla",DB.".formato","idformato=".$idformato,"",$conn);
 $resultado=busca_filtro_tabla("",DB.".".$tabla[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
  if(isset($_REQUEST["destino"]) && $_REQUEST["destino"]<>"" ){
  	$ejecutor=busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa",DB.".datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$_REQUEST["destino"],"",$conn);
      $destinos=explode(",",$resultado[0]["destinos"]);
     }
  elseif(strpos($resultado[0]["destinos"],",")>0){
  	$destinos=explode(",",$resultado[0]["destinos"]);
    $ejecutor=busca_filtro_tabla("nombre,titulo,telefono,direccion,ciudad,cargo,empresa",DB.".datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$destinos[0],"",$conn);
    }
  else
    $ejecutor=busca_filtro_tabla("nombre,telefono,titulo,direccion,ciudad,cargo,empresa",DB.".datos_ejecutor,ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$resultado[0]["destinos"],"",$conn);

	$nombres = '';
	for($i=0; $i < $ejecutor['numcampos']; $i++){
		$nombres .= $ejecutor[$i]['titulo'].' '.$ejecutor[$i]['nombre'].', ';
	}

	echo(ucwords(substr($nombres,0,-1)));
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
        //echo "<br>".$cargo[0]["nombre"]."<br>".$dep[0]["nombre"];
        //echo $cargo[0]["nombre"]."<br>";

        if(!$repetido)
        echo $antiguo[0]["nombre"]."(Suplente)";
        }

}
function mostrar_imagenes_escaneadas($idformato)
{
  global $conn;
  $formato = busca_filtro_tabla("","formato","idformato=".$idformato." and detalle=1","",$conn);
  if(isset($_REQUEST["anterior"]) && $_REQUEST["anterior"]!="" && $formato["numcampos"] == 0)
  {
   $doc = $_REQUEST["anterior"];
   $doc_anterior = busca_filtro_tabla("descripcion,numero","documento","iddocumento=$doc","",$conn);
   echo "<b>Se est&aacute; dando respuesta al documento: </b>&nbsp;&nbsp;".$doc_anterior[0]["numero"]." ".$doc_anterior[0]["descripcion"]."<br /><br />";
   //Si el documento tiene imagenes escaneadas las muestra antes del formato de respuesta
   $imagenes=busca_filtro_tabla("consecutivo,imagen,ruta,pagina","pagina","id_documento=".$doc,"",$conn);
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
    $doc_anterior = busca_filtro_tabla("descripcion,numero","documento","iddocumento=$doc","",$conn);

   //Si el documento tiene imagenes escaneadas las muestra antes del formato de respuesta
    $imagenes=busca_filtro_tabla("consecutivo,imagen,ruta,pagina","pagina","id_documento=".$doc,"",$conn);
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

function mostrar_dependencia_carta($idformato,$iddoc)
{
global $conn;
 $formato=busca_filtro_tabla("dependencia,firma_dependencia","ft_carta","documento_iddocumento=$iddoc","",$conn);
 if($formato[0]["firma_dependencia"]==1){
$dependencia=busca_filtro_tabla("dependencia_iddependencia","dependencia_cargo","  iddependencia_cargo =".$formato[0]["dependencia"],"",$conn);
$nombre_dependencia=busca_filtro_tabla("nombre","dependencia","iddependencia =".$dependencia[0]["dependencia_iddependencia"],"",$conn);
echo($nombre_dependencia[0]["nombre"]);

 }

}
if(@$_REQUEST["tipo"]!=5){
?>
<link rel="stylesheet" href="../css/image-enlarger.css" media="screen" type="text/css" />
<script type="text/javascript" src="../../js/dhtml-suite-for-applications.js"></script>
<script type='text/javascript' src='../../js/jquery.js'></script>
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

   if($("#destinos").val()!='' || $("#copia").val()!='')
   {
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

function mostrar_anexos_externa($idformato,$iddoc){
	$fisicos=mostrar_valor_campo('anexos_fisicos',$idformato,$iddoc,1);
	$digitales=mostrar_valor_campo('anexos_digitales',$idformato,$iddoc,1);
	if($fisicos!="" || $digitales!=""){
		$digitales=preg_replace("%(<div.*?>)(.*?)(<\/div.*?>)%is","",$digitales);
		echo "Anexos: ".$fisicos." ".strip_tags($digitales, '<a>')."<br/><br/>";
	}
}
function tamanio_texto_anexos_ext($idformato,$iddoc){
	global $conn;
	if(@$_REQUEST['tipo']!=5){
	?>
		<script type="text/javascript">
			$(document).ready(function(){
				//$("table tbody tr td a font").css("font-size","12pt");
				$('*').css('font-family','arial');
			});
		</script>
	<?php
	}
}


function mostrar_copias_comunicacion_ext($idformato,$iddoc=NULL){
	global $conn;
	$datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
	$inf_memorando=busca_filtro_tabla("copia,copiainterna,vercopiainterna",$datos[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
	if($inf_memorando[0][0]<>""){
		echo '<span>Copia: ';
		$destinos=explode(",",$inf_memorando[0][0]);
		$destinos=array_unique($destinos);
		sort($destinos);
		$lista=array();
		for($i=0;$i<count($destinos);$i++){
			$ejecutores=busca_filtro_tabla("nombre,cargo","ejecutor e,datos_ejecutor de","de.ejecutor_idejecutor=e.idejecutor and iddatos_ejecutor=".$destinos[$i],"",$conn);
			if($ejecutores[0][1]!=""){
				$cargo=",".ucwords(strtolower($ejecutores[0][1]));
			}
			$lista[]=ucwords(strtolower($ejecutores[0][0])).$cargo;
		}
		echo implode(", ",$lista);
		if($inf_memorando[0]['vercopiainterna']==1 && $inf_memorando[0]['copiainterna']<>""){
			$copiainterna=mostrar_cop_interna_externa($inf_memorando[0]['copiainterna']);
			echo ",".implode(", ",$copiainterna);
		}
		echo '</span><br/><br/>';
	}elseif($inf_memorando[0]['vercopiainterna']==1 && $inf_memorando[0]['copiainterna']<>""){
		echo '<span>Copia: ';
		$copiainterna=mostrar_cop_interna_externa($inf_memorando[0]['copiainterna']);
		echo implode(", ",$copiainterna).'</span><br/><br/>';
	}
}
function mostrar_cop_interna_externa($copiainterna){
global $conn;
 $destinos=explode(",",$copiainterna);
 $destinos=array_unique($destinos);
 sort($destinos);
 $lista=array();
 for($i=0;$i<count($destinos);$i++){//si el destino es una dependencia
   if(strpos($destinos[$i],"#")>0){
      	$resultado=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$destinos[$i]),"",$conn);
			  $lista[]=ucwords(strtolower($resultado[0]["nombre"]));
      }else{
   		$resultado=busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","funcionario,cargo c,dependencia_cargo dc","dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$destinos[$i],"",$conn);
      $lista[]=ucwords(strtolower($resultado[0]["nombres"]." ".$resultado[0]["apellidos"]));
			if($resultado[0]['nombre']<>""){
				 $lista[]=ucwords(strtolower($resultado[0]["nombre"]));
			}
   }
  }
return $lista;
}
function generar_correo_confirmacion($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	
	$formato=busca_filtro_tabla("nombre_tabla, nombre","formato","idformato=".$idformato,"",$conn);
	
	$formato_carta=busca_filtro_tabla("",$formato[0]['nombre_tabla'].",documento","documento_iddocumento=iddocumento and documento_iddocumento=".$iddoc,"",$conn);
	$usuario_confirma=busca_filtro_tabla("destino","buzon_entrada","nombre='POR_APROBAR' and activo=1 and archivo_idarchivo=".$iddoc,"idtransferencia asc",$conn);
	if($formato_carta[0]['email_aprobar']==1 && $formato_carta[0]['estado']=='ACTIVO'){
		$resultado=busca_filtro_tabla("","ruta","documento_iddocumento=".$iddoc,"idruta",$conn);
		if($resultado['numcampos']){
			if(!is_dir($ruta_db_superior."temporal_".$_SESSION["LOGIN"])){
        mkdir($ruta_db_superior."temporal_".$_SESSION["LOGIN"],0777);
      }
			$borrar_pdf="UPDATE documento set pdf='' where iddocumento=".$iddoc;
			phpmkr_query($borrar_pdf);
			$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
			if($consulta[0]['pdf']!=""){
	      $anexos[]=$ruta_db_superior.$consulta[0]['pdf'];
	    }else{
				//$nombre_archivo="temporal_".$_SESSION["LOGIN"]."/".$iddoc;
				$ch = curl_init();
		    //$fila = "http://".RUTA_PDF_LOCAL."/class_impresion.php?iddoc=".$iddoc."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&conexion_remota=1&usuario_actual=".$_SESSION["usuario_actual"]."&LLAVE_SAIA=".LLAVE_SAIA;
		    $fila = "http://".RUTA_PDF_LOCAL."/class_impresion.php?plantilla=".$formato[0]['nombre']."&iddoc=".$iddoc."&conexion_remota=1&conexio_usuario=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&LLAVE_SAIA=".LLAVE_SAIA;
		    curl_setopt($ch, CURLOPT_URL,$fila);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		    $contenido=curl_exec($ch);
		    curl_close ($ch);
				//$anexos[]=$ruta_db_superior.$nombre_archivo.".pdf";
	    }
			$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
			if($consulta[0]['pdf']!=""){
	      $anexos[]=$ruta_db_superior.$consulta[0]['pdf'];
	    }
			$funcionario=busca_filtro_tabla("","vfuncionario_dc","estado_dc=1 and estado=1 and funcionario_codigo=".$usuario_confirma[0]['destino'],"",$conn);
			$adjuntos=busca_filtro_tabla("ruta","anexos","documento_iddocumento=".$iddoc,"",$conn);
	    if($adjuntos["numcampos"]){
	      for($k=0;$k<$adjuntos["numcampos"];$k++){
	        $anexos[]=$ruta_db_superior.$adjuntos[$k]["ruta"];
	      }
	    }

			$info='iddoc-'.$iddoc.',usuario-'.$funcionario[0]['login'];
	    $resultado=base64_encode($info);
			$busca_configuracion_correo=busca_filtro_tabla("valor","configuracion","nombre='email_aprobacion'","",$conn);
			$enlaces='<a href="'.$busca_configuracion_correo[0]['valor'].'index.php?info='.$resultado.'" target="_blank">Gestionar Documento</a><br />';


			/*$mensaje='Saludos '.$funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].',<br /><br />
	        A continuaci&oacute;n se adjunta en formato PDF el documento de la comunicacion externa donde se encuentra usted como responsable.<br /><br />
	        Por favor dar click en los siguiente(s) enlace(s) y Aprobar o Rechazar el documento.<br/>'.$enlaces.'<br /><br />Antes de imprimir este mensaje, asegurese que es necesario. Proteger el medio ambiente tambien esta en nuestras manos.<br /><br />
	        ESTE ES UN MENSAJE AUTOMATICO, FAVOR NO RESPONDER.';*/

			$mensaje='

			Saludos '.$funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].',<br /><br />
                        Por medio de la presente se permite solicitar su aprobación o rechazo al documento adjunto donde se encuentra usted como responsable de aprobación, para hacer esto por favor siga estos dos pasos:
                        <br /><br />
                        1. Haga lectura del documento adjunto.
                        <br /><br />
                        2. Una vez tenga conocimiento del documento, acceda al siguiente link y decida si Aprobar o Rechazar.
                        <br /><br />
                        '.$enlaces.'
                        <br /><br />
                        ';

			enviar_mensaje('','codigo',array($funcionario[0]['funcionario_codigo']),'GESTION DE COMUNICACIONES EXTERNAS',$mensaje,$anexos);
		}
	}

	if(!isset($_REQUEST['refrescar'])){
		mostrar_formato($idformato,$iddoc);
	}
}
?>
