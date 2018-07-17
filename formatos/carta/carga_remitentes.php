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

switch($_REQUEST["opcion"])
{case '1':
	$padre=busca_filtro_tabla("ejecutor,tipo_radicado,plantilla","documento","iddocumento=".$_REQUEST["adicionales"],"",$conn);
	if($_REQUEST["formato_origen"]!='' && $_REQUEST["adicionales"]!=""){
		$padre=busca_filtro_tabla("ejecutor,tipo_radicado,plantilla, b.*","documento a, ft_".$_REQUEST["formato_origen"]." b","iddocumento=".$_REQUEST["adicionales"]." AND documento_iddocumento=iddocumento","",$conn);
		
		if($padre["numcampos"]){
			echo "1|".$padre[0][$_REQUEST["campo"]];
		}
		else{
			$padre=busca_filtro_tabla("ejecutor,tipo_radicado,plantilla","documento a","iddocumento=".$_REQUEST["adicionales"],"",$conn);
			if($padre["numcampos"]){
				echo "1|".$padre[0]["ejecutor"];
			}
			else{
				echo "0";
			}
		}
	}
	else if($padre[0]["tipo_radicado"]==1 && $_REQUEST["adicionales"])
		echo "1|".$padre[0]["ejecutor"];
		else
			echo "0";
			break;
case '2':
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename=remitentes.csv');
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	if(@$_REQUEST["destinos"]){
		$destinos=$_REQUEST["destinos"];
	}
	if($_REQUEST["copias"]){
		$destinos.=','.$_REQUEST["copias"];
	}
	$columnas=array("nombre","identificacion","cargo","empresa","direccion","telefono","correo","titulo","ciudad");
	$fila=array();
	foreach($columnas AS $key=>$columna){
		array_push($fila,ucfirst($columna));
	}
	array_push($fila,"Departamento");
	echo(implode(",",$fila));
	echo("\n");
	$columnas[6]="email";
	$remitentes= busca_filtro_tabla(implode(",",$columnas),"vejecutor","iddatos_ejecutor IN(".$destinos.")","",$conn);
	for($i=0;$i<$remitentes["numcampos"];$i++){
		$fila=array();
		foreach($columnas AS $key=>$columna){
			if(trim($remitentes[$i][$columna])){
				if($columna=='ciudad'){
					$dato_ciudad=busca_filtro_tabla("A.nombre AS ciudad,B.nombre AS departamento","municipio A,departamento B","A.departamento_iddepartamento=B.iddepartamento AND A.idmunicipio=".$remitentes[$i]["ciudad"]);
					if($dato_ciudad["numcampos"]){
						array_push($fila,codifica_encabezado(html_entity_decode($dato_ciudad[0]["ciudad"])));
						array_push($fila,codifica_encabezado(html_entity_decode($dato_ciudad[0]["departamento"])));
					}
				}
				else{
					array_push($fila,codifica_encabezado(html_entity_decode($remitentes[$i][$columna])));
				}
			}
			else {
				array_push($fila,'');
			}
		}
		echo(implode(",",$fila));
		echo("\n");
	}
	break;
case '3':
	include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
	?>
   <form action="" name="form1" enctype="multipart/form-data" method="post">
   <input type="file" name="archivo" >
   <input type="submit" value="Cargar" >
   <input type="hidden" value="<?php echo($_REQUEST['campo'])?>">
   <input type="hidden" value="4" name="opcion" >
   </form>
   <table>
   	<tr>
   		<td>Tener en cuenta:</td>
   	</tr>
   	<tr>
   		<td>
   			<ul>
   				<li>Se debe crear el excel o descargarlo del enlace <a href="carga.xls">ejemplo</a></li>
   				<li>El excel debe tener 10 columnas con los siguientes datos:<br />Nombres,Identificaci&oacute;n,Cargo,Empresa,Direcci&oacute;n,Tel&eacute;fono,Correo,Titulo,Ciudad,Departamento</li>
   				<li>Despu&eacute;s de tener el excel de esta manera, se debe exportar al formato "csv", con la opci&oacute;n delimitado por coma (,)</li>
   				<li>Notas:<br />
   				1. El archivo de excel siempre debe tener las 10 columnas, en caso de que no exista datos para esa columna se debe dejar vacio y la columna se conserva.<br />
   				2. Los datos no deben contener caracteres especiales y el caracter coma (,) ya que este es el delimitador de las columnas.<br />
   				3. Los encabezados deben permanecer ya que la  primera fila no es tenida en cuenta en el archivo.<br />
   				Nota: Se deben seguir las instrucciones para que los datos sean cargados sin inconvenientes.
   				</li>
   				<li>Posterior a estos pasos, ya se puede subir el archivo para que los remitentes sean cargados</li>
   				<li>Dar clic en el bot&oacute;n cargar</li>
   			</ul>
   		</td>
   	</tr>
   </table>
   <?php
 break; 
 case '4':
    if($_FILES["archivo"]["error"]){
      alerta("No se pudo cargar el archivo");
			abrir_url("carga_remitentes.php?opcion=3&campo=".$_REQUEST["Campo"],"_self");
		}
    else{
    	echo("1");
    	validar_ciudades();
    	echo("2");
    	$link=fopen($_FILES["archivo"]["tmp_name"],'r');
		$cont=1;	
    	$valores=array();
			while($linea=fgetcsv($link,0,",")){
				if($cont>1){
					if(trim($linea[0])=="" && trim($linea[1])=="" && trim($linea[2])=="" && trim($linea[3])=="" && trim($linea[4])=="" && trim($linea[5])=="" && trim($linea[6])=="" && trim($linea[7])=="" && trim($linea[8])==""){
						continue;
					}else{
						foreach($linea AS $key=>$lin){
							$linea[$key]=htmlentities(codifica_encabezado($lin));
						}
						$valores[]=datos_proveedor($linea[0],$linea[1],$linea[2],$linea[3],$linea[4],$linea[5],$linea[6],$linea[7],$linea[8],$linea[9]);
					}
				}
				$cont++;
			}
      fclose($link);
      $cant=count($valores);
			if($cant>=1){
      	echo "<script>window.parent.document.getElementById('destinos').value='".implode(",",$valores)."';
              window.parent.document.getElementById('frame_destinos').src='../librerias/acciones_ejecutor.php?formulario_autocompletar=formulario_formatos&campo_autocompletar=".$_REQUEST['campo']."&tabla=ft_carta&campos_auto=nombre,identificacion&tipo=multiple&campos=cargo,empresa,direccion,telefono,email,titulo,ciudad&destinos=".implode(",",$valores)."';
        </script>";
			}
      echo "<script>window.parent.hs.close();</script>";   
		}  
	break;
}
function datos_proveedor($nombre,$identificacion,$cargo,$empresa,$direccion,$telefono,$email,$titulo,$ciudad,$departamento){
  global $conn;
  unset($_POST);
  
  $campos_ejecutor=array();
  if($cargo){
    $campos_ejecutor[]="cargo";
    $_POST["cargo"]=$cargo;
  }
  if($empresa){
    $campos_ejecutor[]="empresa";
    $_POST["empresa"]=$empresa;
  }
  if($direccion){
    $campos_ejecutor[]="direccion";
    $_POST["direccion"]=$direccion;
  }
  if($telefono){
    $campos_ejecutor[]="telefono";
    $_POST["telefono"]=$telefono;
  }
  if($email){
    $campos_ejecutor[]="email";
    $_POST["email"]=$email;
  }
  if($titulo){
    $campos_ejecutor[]="titulo";
    $_POST["titulo"]=$titulo;
  }
  if($ciudad){
    $campos_ejecutor[]="ciudad";
    $valor=busca_filtro_tabla("","municipio A, departamento B","A.nombre like '".str_replace("?", "%", trim(html_entity_decode(decodifica_encabezado($ciudad))))."' and A.departamento_iddepartamento=B.iddepartamento and B.nombre like '".trim(html_entity_decode(decodifica_encabezado($departamento)))."'","",$conn);
    $_POST["ciudad"]=$valor[0]["idmunicipio"];
  }
  if($nombre){
    $nombre=trim(str_replace(",","",$nombre));
  }
  if($identificacion){
    $identificacion=trim(str_replace(",","",$identificacion));
  }
  $ejecutor["numcampos"]=0;
  if(trim($identificacion)<>""){
    $ejecutor=busca_filtro_tabla("","ejecutor","identificacion LIKE '".@$identificacion."'" ,"",$conn);
  
    if(!$ejecutor["numcampos"]){
      $ejecutor=busca_filtro_tabla("","ejecutor","lower(nombre) LIKE lower('".@$nombre."') and (identificacion is null or identificacion='')","",$conn);
    }
  }  elseif(trim($nombre)<>""){
    $ejecutor=busca_filtro_tabla("","ejecutor","lower(nombre) LIKE lower('".@$nombre."')","",$conn);
  }
	
	
  if($ejecutor["numcampos"]){
    $otros=""; 
    if(isset($identificacion)&&$identificacion&&$identificacion<>"undefined"){
      $otros.=",identificacion='".$identificacion."'";
    }
    $sql="UPDATE ejecutor SET nombre ='".@$nombre."'".$otros." WHERE idejecutor=".$ejecutor[0]["idejecutor"];
    phpmkr_query($sql);
    $idejecutor=$ejecutor[0]["idejecutor"];
  }
  else{
    $sql="INSERT INTO ejecutor(nombre,identificacion)VALUES('".@$nombre."','".@$identificacion."')";
    phpmkr_query($sql);
    $insertado=1;
    $idejecutor=phpmkr_insert_id();
  }
  $campos_excluidos=array("nombre","identificacion");
  $campos_ejecutor=array_diff($campos_ejecutor,$campos_excluidos);
  sort($campos_ejecutor);
  $campos_todos=array("direccion","telefono","email","cargo","empresa","ciudad","titulo","codigo");
  
  $condicion_actualiza="";
  for($i=0;$i<count($campos_ejecutor);$i++){
    if(isset($_POST[$campos_ejecutor[$i]])){
      if($_POST[$campos_ejecutor[$i]])
        $condicion_actualiza.=' AND '.$campos_ejecutor[$i]."='".$_POST[$campos_ejecutor[$i]]."'";
      else{
        $condicion_actualiza.=' AND ('.$campos_ejecutor[$i]." IS NULL or ".$campos_ejecutor[$i]."='')";
      }
    }  
  }
  $datos_ejecutor=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$idejecutor.$condicion_actualiza,"",$conn);

  if((!$datos_ejecutor["numcampos"] ||$insertado) && $condicion_actualiza!=""){
    $datos_ejecutor=busca_filtro_tabla("","datos_ejecutor","ejecutor_idejecutor=".$idejecutor,"iddatos_ejecutor desc",$conn);
    $campos=array();
    $valores=array();
    
    if(!isset($_POST["ciudad"])|| strtolower($_POST["ciudad"])=="undefined"){
      $config=busca_filtro_tabla("valor","configuracion","lower(nombre) like 'ciudad'","",$conn);
      if($config["numcampos"])
        $_POST["ciudad"]=$config[0][0];
      else
        $_POST["ciudad"]=658;
    }
    
    for($i=0;$i<=count($campos_todos);$i++){
      if($campos_todos[$i]<>"fecha_nacimiento"){
        if(isset($_POST[$campos_todos[$i]])&&in_array($campos_todos[$i],$campos_ejecutor)){
          array_push($valores,$_POST[$campos_todos[$i]]);
          array_push($campos,$campos_todos[$i]);
          $actualizado=1;
        }
        else if($datos_ejecutor["numcampos"] && $datos_ejecutor[0][$campos_todos[$i]]<>""){
          array_push($valores,$datos_ejecutor[0][$campos_todos[$i]]);
          array_push($campos,$campos_todos[$i]);
        }
      }     
    }
    if($actualizado){
      $valor_insertar="'".implode("','",str_replace("'","''",$valores))."',";
      $campos_insertar=implode(",",$campos).",";
    }
    $sql='INSERT INTO datos_ejecutor('.$campos_insertar."ejecutor_idejecutor,fecha) VALUES(".$valor_insertar.$idejecutor.",".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").")";
    phpmkr_query($sql);
    
    $iddatos_ejecutor=phpmkr_insert_id();
  }
  else if($datos_ejecutor["numcampos"]){
    $iddatos_ejecutor=$datos_ejecutor[0]["iddatos_ejecutor"];
  }
  unset($_POST);
  return($iddatos_ejecutor);
}
function validar_ciudades(){
	global $conn;
	$link=fopen($_FILES["archivo"]["tmp_name"],'r');
	
	$error=array();
	$cont=1;
	//Verificacion de ciudades y departamentos
	while($linea2=fgetcsv($link,0,",")){
		$mensaje=false;
		if($cont>1){
			/*$file = file_get_contents("somefile.txt",$linea2[8]);
			$encodings = implode(',', mb_list_encodings());
			print_r(mb_detect_encoding($file, $encodings, true));*/
			
			
			$ciudad=str_replace("?", "%", trim(htmlentities(decodifica_encabezado($linea2[8]))));
	
			//$ciudad=htmlspecialchars_decode(htmlentities(utf8_decode($linea2[8])));
			$departamento=htmlentities(decodifica_encabezado($linea2[9]));
			
			$nombre=codifica_encabezado(htmlentities($linea2[0]));
			$identificacion=codifica_encabezado(htmlentities($linea2[1]));
			if(trim($nombre)=='' && trim($identificacion)==''){
				$mensaje.="Errro en campo obligatorio: El campo nombre y apellidos o el campo identificaci&oacute;n debe ser diligenciado <br>";
			}
			if(trim($departamento)!=''){
				if(trim($ciudad)!=''){
					$busqueda_depto=busca_filtro_tabla("","departamento a","lower(a.nombre) like '".$departamento."'","",$conn);
					if($busqueda_depto["numcampos"]){
						$busqueda_ciudad=busca_filtro_tabla("","municipio a","lower(a.nombre) like '%".strtolower($ciudad)."%' and a.departamento_iddepartamento=".$busqueda_depto[0]["iddepartamento"],"",$conn);
						if(!$busqueda_ciudad["numcampos"]){
							$mensaje.="Error municipio: <b>".$ciudad."</b>, proveedor: ".$nombre." ".$identificacion."";
							if(strpos(htmlentities($ciudad), '&')!==false){
								$leng=strpos(htmlentities($ciudad), '&');
								$leng=substr($ciudad,0,$leng);
								$dat=$leng.'%';
								$relaciones=busca_filtro_tabla("nombre","municipio a","lower(a.nombre) like '".strtolower($dat)."'","",$conn);
								$mensaje.="<br>Municipios relacionados en el sistema: ".mayusculas(implode(",", extrae_campo($relaciones,"nombre")));
							}
						}
					}else{
						$mensaje.="Error departamento: <b>".$departamento."</b>, Ejecutor: ".$nombre." ".$identificacion." No existe <br>";
					}
				}
				else{
					$mensaje.="Error ciudad: <b>".$departamento."</b>, Ejecutor: ".$nombre." ".$identificacion." No puede ser vacio<br>";
				}
			}
			if($mensaje){
				$error[]="<b>".$cont."</b> ".$mensaje;
			}
		}
		$cont++;
	}
	fclose($link);
	if(count($error)){
		echo('<p style="font-size:8pt"><a href="carga_remitentes.php?opcion=3">Volver</a><br/><br/><b>Error:</b><br/>'.implode("<br/>",$error).'</p>');
		die();
	}
}
?>