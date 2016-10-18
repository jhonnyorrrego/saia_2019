<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}    
include_once($ruta_db_superior."db.php"); 
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");
//print_r($_REQUEST);
/*
<Clase>
<Nombre>colilla
<Parametros>
<Responsabilidades>muestra la colilla con la informacion de radicado del documento especificado
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
if(@$_REQUEST["validar"])
	validar_confirmacion();
clearstatcache();
$no_cache = md5(time()); 
$doc=FALSE; 
if(@$_REQUEST["doc"] || @$_REQUEST["key"]){
  $doc=@$_REQUEST["key"];
  if(@$_REQUEST["doc"]){
    $doc=$_REQUEST["doc"];
  }
  //registrar_accion_digitalizacion($doc,'IMPRIME COLILLA');
}else{
	if(@$_REQUEST["generar_consecutivo"]){	
		validar_confirmacion_salida($_REQUEST["generar_consecutivo"]);
	}else if(@$_REQUEST["consecutivo"] && @$_REQUEST["salidas"]){
		$formato=$_REQUEST["consecutivo"];
		$_REQUEST["enlace"]="pantallas/buscador_principal.php?idbusqueda=10";
	}else{
		$formato='radicacion_entrada';
	}
  $doc=generar_ingreso_formato($formato);
}
$plantilla=busca_filtro_tabla("","documento a, formato b","lower(plantilla)=b.nombre AND iddocumento=".$doc,"",$conn);
$datos=busca_filtro_tabla("numero,tipo_radicado,".fecha_db_obtener("A.fecha",'d/m/Y-H:i:s')." AS fecha_oracle,A.descripcion,lower(plantilla) AS plantilla,ejecutor,paginas","documento A, ".$plantilla[0]["nombre_tabla"]." B","A.iddocumento=$doc AND A.iddocumento=B.documento_iddocumento","",$conn); 
$ejecutor["numcampos"]='';
$atras="1";
if(@$_REQUEST["enlace"]){
  if(strpos($_REQUEST["enlace"],'?')>0)
    $enlace=$_REQUEST["enlace"]."&key=".$doc;
  else
    $enlace=$_REQUEST["enlace"]."?key=".$doc;
}
else{  
  if($datos[0]["plantilla"]){
    $plantilla = busca_filtro_tabla("B.*","documento A,formato B","'".strtolower($datos[0]["plantilla"])."'=lower(B.nombre) AND A.iddocumento=".$doc." AND lower(A.plantilla)=lower(B.nombre)","",$conn);
	  
    $enlace = $ruta_db_superior."formatos/".$plantilla[0]["nombre"]."/mostrar_".$plantilla[0]["nombre"].".php?iddoc=$doc&idformato=".$plantilla[0]["idformato"];
  }
  else if(isset($_REQUEST["pagina"])){
    $atras=2;
  }
  else{
    $atras=1;
  }
}
if(@$_REQUEST["enlace2"] != '')
    $enlace .= '&enlace2='.$_REQUEST["enlace2"];
if($_REQUEST["defecto"]){
	$enlace.="&defecto=".$_REQUEST["defecto"];
}
if($_REQUEST["mostrar_formato"]){
	$enlace.="&mostrar_formato=".$_REQUEST["mostrar_formato"];
}
if($doc<>FALSE){
  $ejecutor=busca_filtro_tabla("nombre AS nombre, empresa","ejecutor A,datos_ejecutor B","A.idejecutor=B.ejecutor_idejecutor AND iddatos_ejecutor=".$datos[0]["ejecutor"],"",$conn);
  $radicador1=busca_filtro_tabla("nombres,apellidos","digitalizacion,funcionario","funcionario=funcionario_codigo and documento_iddocumento=$doc","",$conn); 
  $radicador = busca_filtro_tabla("destino,D.nombre,B.nombres, B.apellidos","buzon_salida A,funcionario B,dependencia_cargo C,dependencia D","A.destino=B.funcionario_codigo AND B.idfuncionario=C.funcionario_idfuncionario AND C.dependencia_iddependencia=D.iddependencia AND A.archivo_idarchivo=$doc AND A.nombre='TRANSFERIDO'","A.idtransferencia ASC",$conn);  
  $responsable=busca_filtro_tabla("B.nombres,B.apellidos","documento A,funcionario B","A.ejecutor=B.funcionario_codigo AND iddocumento=".$doc,"",$conn);
    if($radicador["numcampos"]){
      $usu=$radicador[0]["nombre"];
    }
    else 
      $usu="RADICACION";
  if($datos[0]["tipo_radicado"]==1){
    if($ejecutor["numcampos"]) 
      $origen=ucwords(strtolower($responsable[0]["nombres"]." ".$responsable[0]["apellidos"]));
    else 
      $origen=ucwords(strtolower($responsable[0]["nombres"]." ".$responsable[0]["apellidos"]));    
    $destino=$usu;
  
  }
  else if($datos[0]["tipo_radicado"]==2){
    $origen=ucwords(strtolower($responsable[0]["nombres"]." ".$responsable[0]["apellidos"])); 
    $destino=$ejecutor[0]["nombre"];
  }
  else{
    $origen=ucwords(strtolower($responsable[0]["nombres"]." ".$responsable[0]["apellidos"]));
    $destino=$radicador[0]["nombres"]." ".$radicador[0]["apellidos"];
  }
$anexos=busca_filtro_tabla("count(*) AS cantidad","anexos","documento_iddocumento=".$doc,"",$conn);
$paginas=busca_filtro_tabla("count(*) AS paginas","pagina","id_documento=".$doc,"",$conn);     
  $configuracion=busca_filtro_tabla("*","configuracion A","A.tipo='impresion'","",$conn);  
  $imprime=0;
  for($i=0;$i<$configuracion["numcampos"];$i++){
   if($configuracion[$i]["nombre"]=="colilla") 
    $imprime=$configuracion[$i]["valor"];
  }
  $web_empresa="";
  $nombre_empresa="EMPRESA";
  $logo_empresa=""; 
  $datos_fecha = $datos[0]['fecha_oracle'];
  $datos_numero = $datos[0]['numero'];
  $datos_asunto = $datos[0]['descripcion'];
  $codigo_empresa='';
  if($datos["numcampos"]&&$imprime){
    $tipo_r=busca_filtro_tabla("idcontador,etiqueta_contador","contador","idcontador=".$datos[0]["tipo_radicado"],"",$conn);   
    $empresa=busca_filtro_tabla("A.nombre, A.valor","configuracion A","A.tipo='empresa'","A.nombre",$conn);  
  
    for($i=0;$i<$empresa["numcampos"];$i++){ 
      switch($empresa[$i]["nombre"]){
        case "nombre": 
            $nombre_empresa=$empresa[$i]["valor"];       
        break;
        case "logo": 
            $logo_empresa=$empresa[$i]["valor"];
        break;
				case "logo_colilla": 
            //$logo_empresa=$empresa[$i]["valor"];
        break;
        case "web": 
            $web_empresa=$empresa[$i]["valor"];
        break;
        case "codigo_empresa": 
            $codigo_empresa=$empresa[$i]["valor"];
        break;
        default: 
        break;         
      }
    }
 //$logo_empresa="";  
$fecha=date_parse($datos[0]["fecha_oracle"]); 
if(@$_REQUEST["target"]){
	$target=$_REQUEST["target"];
}
else{
	$target="centro";
}

if($datos[0]["numero"]){
	$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$doc,"", $conn);	
	$qr='';
	if($codigo_qr['numcampos']){
	    
	    if(file_exists(PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/".$codigo_qr[0]['ruta_qr'])){
            $qr='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/'.$codigo_qr[0]['ruta_qr'].'" width="50px" height="50px">';		        
	    }else{
    		include_once($ruta_db_superior."pantallas/qr/librerias.php");
    		generar_codigo_qr('',$doc);
    		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$doc,"", $conn);	
    		$qr='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/'.$codigo_qr[0]['ruta_qr'].'" width="50px" height="50px">';		        
	    }
	}
	else{
		include_once($ruta_db_superior."pantallas/qr/librerias.php");
		generar_codigo_qr('',$doc);
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$doc,"", $conn);	
		$qr='<img src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/'.$codigo_qr[0]['ruta_qr'].'" width="50px" height="50px">';		        
	}
}
?>
<style type="text/css">
<!--
td {
	font-family: VERDANA;
	font-size:7px;
	height:0px;
	border:0px solid;
	vertical-align:top;
	padding-left:5px;
}
.resaltar{
  font-weight:bold;
}
-->
</style>
<script language="javascript">
<!--
/*
<Clase>
<Nombre>comando_documento
<Parametros>sComando-comando que se desea ejecutar 
<Responsabilidades>Ejecuta el comando especificado sobre el documento
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function comando_documento(sComando){
    if (!document.execCommand){
        alert("Función no disponible en su explorador");
        return false;
    }
    document.execCommand(sComando);
}
/*
<Clase>
<Nombre>imprime
<Parametros>atras-numero de saltos desde la pagina que la llama
<Responsabilidades>retorna a la pagina que llamó a la colilla después de mostrarla 
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function imprime(atras){
  window.focus();
  var url = "<?php echo $enlace; ?>"; 
  
  window.print();
  //comando_documento('ClearAuthenticationCache');
  if(url!=""){
      window.open("<?php echo $enlace; ?>","<?php echo $target; ?>");
  }else{
      window.history.go(-atras);
  }       
     
}	
-->
</script>
<html lang="en">
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.9.1.custom.min.css" />
<script src="js/jquery-1.8.2.js"></script>    
<script src="js/jquery-ui-1.8rc3.custom.min.js"></script> 
</head>
<br/><br/>

<table height="94px" width="189px" align="right" border="0px" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
  <tr> 
	<td><?php echo "<br/><center>".($qr)."</center>"; ?></td>
	<td border="1px" colspan="2" align="left" height="2px" cellspacing="0" cellpadding="0">
		<strong><?php echo($nombre_empresa);?>
		</strong><br/><br/>
		<b>Radicaci&oacute;n No: <?php echo($codigo_empresa."-".$datos[0]["numero"]."-".$fecha["year"]);?></b>
  <br/>
  <b>Fecha: <?php echo $datos_fecha; ?></b><br/>
 <b>Origen: <?php echo($origen);?></b><br/>
  
  <?php if($datos[0]["tipo_radicado"]==1){?>
  <b>Destino: <?php echo substr(($destino),0,22)."..."; ?></b>
  
  <?php }   	
  	$validar_impresion = busca_filtro_tabla("valor","configuracion","lower(nombre) LIKE'imprimir_colilla_automatico'","",$conn);
		
		if($validar_impresion[0]['valor'] == 1){
			$imprimir_colilla = 'onLoad="imprime('.$atras.')"';	
			//abrir_url($enlace,'_self');		
		}else{
		    
			abrir_url($enlace,'_self');			
		}	 	
  ?>
	</td>
</tr>
<tr>
	<td colspan="2"> <center><b>El radicado no implica su aceptaci&oacute;n</b></center></td>
</tr>
</table>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" <?php echo(@$imprimir_colilla);?> >
</body>
</html>
  <?php
	}
}

function generar_ingreso_formato($nombre_formato){
	$formato=busca_filtro_tabla("A.*,B.nombre as nombre_campo, B.*","formato A, campos_formato B","A.nombre='".$nombre_formato."' AND idformato=formato_idformato AND obligatoriedad=1","",$conn);
	$dependencia=busca_filtro_tabla("","dependencia_cargo","funcionario_idfuncionario=".usuario_actual("idfuncionario")." AND estado=1","",$conn);
	
	for($i=0;$i<$formato["numcampos"];$i++){
		if(strtolower($formato[$i]["tipo_dato"])=='date'){
			$_REQUEST[$formato[$i]["nombre_campo"]]=date('Y-m-d');
		}
		else if(strtolower($formato[$i]["tipo_dato"])=='datetime'){
			$_REQUEST[$formato[$i]["nombre_campo"]]=date('Y-m-d H:i:s');
		}
		else if(strtolower($formato[$i]["tipo_dato"])=='int'){
			$_REQUEST[$formato[$i]["nombre_campo"]]='0';
		}
		else if(strtolower($formato[$i]["tipo_dato"])=='varchar'){
			$_REQUEST[$formato[$i]["nombre_campo"]]='&nbsp;';
		}
	}
	if($nombre_formato=='radicacion_entrada'){
		$_REQUEST["descripcion"]='Pendiente por llenar datos';
    $_REQUEST["campo_descripcion"] = "39"; //se colocan los idcampos del campo descripcion;
	}
	else if($nombre_formato=='radicacion_salida'){
		$_REQUEST["descripcion_salida"]='Pendiente por llenar datos';
    $_REQUEST["campo_descripcion"] = "2191"; //se colocan los idcampos del campo descripcion;
	}
	
	$_REQUEST["serie_idserie"] = $formato[0]["serie_idserie"]; //idserie del formato;
	$_REQUEST["dependencia"]= $dependencia[0]["dependencia_iddependencia"]; //iddependencia_cargo de la persona;
	$_REQUEST["encabezado"] = 1;
	$_REQUEST["firma"] = 1;
	$_REQUEST["fecha_almacenar"] = date('Y-m-d');
	//$_REQUEST["padre"] = $id;
	
	$_REQUEST["accion"] = "guardar_detalle";
	$_REQUEST["tipo_radicado"] = $nombre_formato; //se envia el nombre del radicado del formato;
	$_REQUEST["funcion"] = "radicar_plantilla";// esto siempre va
	$_REQUEST["tabla"] = $formato[0]["nombre_tabla"]; //nombre de la tabla del formato en la base de datos.
	$_REQUEST["formato"] = $nombre_formato;  //nombre del formato
	$_REQUEST["continuar"] = "Solicitar Radicado";  //Siempre va esto
	$_REQUEST["ejecutor"] = usuario_actual("funcionario_codigo");
	$_REQUEST["estado_radicado"]='2';
	
	//Adicionales
	if($nombre_formato=="radicacion_entrada"){
		$_REQUEST["idflujo"] = 1;
	}
	
	$_POST=$_REQUEST;
	return radicar_plantilla2();
}
function radicar_plantilla2()
  { 
   global $conn,$sql,$ruta_db_superior;
   //print_r($_REQUEST); die("aquiii");
   $valores=array();
   $plantilla="";
   $idformato=0;
   //hace el ejecutor igual al codigo del funcionario logueado actualmente
   if(!@$_POST["ejecutor"])
      $_POST["ejecutor"]=$_SESSION["usuario_actual"];

    if(@$_POST["formato"]){       
      $plantilla="'".strtoupper($_POST["formato"])."'";
      $formato=busca_filtro_tabla("idformato,nombre_tabla","formato A","A.nombre LIKE '".strtolower($_POST["formato"])."'","",$conn);
      //print_r($formato);
      if($formato["numcampos"]){
        $idformato=$formato[0]["idformato"];
        $campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND banderas LIKE '%u%'","",$conn);
        //print_r($campos);
        for($l=0;$l<$campos["numcampos"];$l++){
          if($_REQUEST[$campos[$l]["nombre"]]){
            $dato=busca_filtro_tabla("",$formato[0]["nombre_tabla"],$campos[$l]["nombre"]."=".$_REQUEST[$campo[$l]["nombre"]],"",$conn);
            //print_r($dato);
            if($dato["numcampos"]){
              alerta("El campo ".$campos[$l]["nombre"]." Debe ser Unico por Favor Vuelva a Insertar la informacion");
              volver(1);
            }
          }  
        }

      }
    }
 	//busco los valores del formulario que van en la tabla documento
    $buscar = phpmkr_query("SELECT A.* FROM documento A WHERE 1=0",$conn);
    $lista_campos = array();
    for($i=0;$i<phpmkr_num_fields($buscar);$i++)
      array_push($lista_campos,strtolower(phpmkr_field_name($buscar,$i)));
    /////////////////////////////////////////////////////////////////////      	  
    $valores=array("fecha"=>fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s'));
    //print_r($_POST);
    //echo("<br />-------<br />");
    foreach($_POST as $key=>$valor){
      if(in_array($key,$lista_campos)&&$key<>"estado"){
        if($valor[0]!="'")
          $valor="'".$valor."'";
        $valores[$key]=$valor;
	   }
    }
    //si le env?o el tipo de radicado 
    if(isset($_POST["serie_idserie"]) && $_POST["serie_idserie"]){
      $valores["serie"]=$_POST["serie_idserie"];
    }
    else $valores["serie"]=0;
    $valores["plantilla"]=$plantilla;
    if(isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"]<>"")
      $valores["responsable"]=$_REQUEST["dependencia"];      
    if(@$_POST["tipo_radicado"]){  
      $tipo_radicado=busca_filtro_tabla("idcontador","contador","nombre='".$_POST["tipo_radicado"]."'","",$conn);
      if($tipo_radicado["numcampos"]){
        $valores["tipo_radicado"]=$tipo_radicado[0]["idcontador"];
      }  
      else if(isset($formato)&&$formato["numcampos"]){
        $valores["tipo_radicado"]=$formato[0]["contador_idcontador"];
      }
      else $valores["tipo_radicado"]=0;
    }
    if(isset($formato) && $formato["numcampos"] && $valores["tipo_radicado"]){
      $tipo_rad=busca_filtro_tabla("","contador","idcontador=".$valores["tipo_radicado"],"",$conn);
      if($tipo_rad["numcampos"])
        $_POST["tipo_radicado"]=$tipo_rad[0]["nombre"];
    }
    else{
      alerta("El Documento que intenta Radicar no posee Secuencia");
      volver(1);
    } 
    $valores["numero"]=0;       
    if(isset($_POST["municipio"]))
        $valores["municipio_idmunicipio"]=$_POST["municipio"];
    else if(isset($_POST["municipio_idmunicipio"]))
        $valores["municipio_idmunicipio"]=$_POST["municipio_idmunicipio"]; 
    else
    {$mun=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
      if($mun["numcampos"])
          $valores["municipio_idmunicipio"]=$mun[0][0];
     else	  
          $valores["municipio_idmunicipio"]=633;
    }	  
    //radico el documento
    //print_r($valores);
    /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
    llama_funcion_accion(NULL,$idformato,"radicar","ANTERIOR");
    $_POST["iddoc"]=radicar_documento_prueba(trim($_POST["tipo_radicado"]),$valores,Null);
    $iddoc=$_POST["iddoc"];
    include_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");  
   $permisos=NULL;    
   cargar_archivo($_POST["iddoc"],$permisos); 
    /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
    llama_funcion_accion($iddoc,$idformato,"radicar","POSTERIOR");

   if(!array_key_exists("destino",$_POST)) 	
        { 
         if($_POST["tabla"]=="encabezado_factura")
         		{$_POST["destino"]=$_POST["revisa"];
      		  }
         else
         		{$_POST["destino"]=$_POST["revisado"];
      		  }
      	}
   //  echo "Request  :"; print_r($_REQUEST); 	
   //  echo "Valores :"; print_r($valores);
   //  die();
    //guardo la relaci?n del documento creado como respuesta con su antecesor
    if(array_key_exists("anterior",$_REQUEST))
      {          
       /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
       llama_funcion_accion($_REQUEST["anterior"],$idformato,"responder","ANTERIOR");
       $idbuzon=busca_filtro_tabla("max(A.idtransferencia) as idbuzon","buzon_entrada A","A.archivo_idarchivo=".$_REQUEST["anterior"],"",$conn);
       phpmkr_query("INSERT INTO respuesta(fecha,destino,origen,idbuzon,plantilla) VALUES (".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').",".$_POST["iddoc"].",".$_REQUEST["anterior"].",".$idbuzon[0]["idbuzon"].",".$plantilla.")",$conn);
       $estado_anterior=busca_filtro_tabla("A.estado,B.nombre_tabla","documento A,formato B","A.plantilla=B.nombre AND A.iddocumento=".$_REQUEST["anterior"],"",$conn);       
        if($estado_anterior["numcampos"]){
          if($estado_anterior[0]["estado"]=="ACTIVO"){         
          phpmkr_query("update documento set estado='TRAMITE' where iddocumento=".$_REQUEST["anterior"],$conn);
          //arreglo con los datos que necesita transferir archivo
          }
          $formato_detalle=busca_filtro_tabla("id".$estado_anterior[0]["nombre_tabla"],$estado_anterior[0]["nombre_tabla"],"documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
          if($formato_detalle["numcampos"])
            $valores[$estado_anterior[0]["nombre_tabla"]]=$formato_detalle[0]["id".$estado_anterior[0]["nombre_tabla"]];
        }
        else
         { $estado_anterior=busca_filtro_tabla("A.estado","documento A","A.iddocumento=".$_REQUEST["anterior"],"",$conn);       
           if($estado_anterior["numcampos"] && $estado_anterior[0]["estado"]=="ACTIVO")          
             phpmkr_query("update documento set estado='TRAMITE' where iddocumento=".$_REQUEST["anterior"],$conn);      
         }       
        $datos["archivo_idarchivo"]=$_REQUEST["anterior"];
        $datos["nombre"]="TRAMITE";
        $datos["tipo_destino"]=1;
        $datos["tipo"]="";
        $destino_tramite[]=usuario_actual("funcionario_codigo");        
        transferir_archivo_prueba($datos,$destino_tramite,"","");
        /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
        llama_funcion_accion($_REQUEST["anterior"],$idformato,"responder","POSTERIOR");
      }     
    $ins_calidad["numcampos"]=0;  
    if(isset($_REQUEST["tabla"]))  
      $ins_calidad=busca_filtro_tabla("*","estructura_calidad","nombre LIKE '".strtolower($_REQUEST["tabla"])."'","",$conn);    
    //guardo los datos del formulario principal del documento (plantilla)
    if($_POST["tabla"]=="scdp")
      phpmkr_query("UPDATE scdp SET documento_iddocumento=".$_POST["iddoc"]." WHERE num_previo=".$_POST["num_previo"],$conn);
    elseif($ins_calidad["numcampos"]){
      $estructuras=explode(",",$_REQUEST["estructura"]);
      foreach($estructuras as $fila){
        $datos_est=explode("#",$fila); 
        $sql_calidad="insert into doc_calidad(documento_iddocumento,estructura_idestructura,cod_padre) values(".$_POST["iddoc"].",".$datos_est[0].",".$datos_est[1].")"; 
        phpmkr_query($sql_calidad,$conn);
      }
      if(!isset($_POST["descripcion"])){
        if(isset($_POST["nombre_".strtolower($REQUEST["tabla"])])){
          $_POST["descripcion"]=$_POST["nombre_".strtolower($REQUEST["tabla"])];
        }
        $_POST["encabezado"]=1;
      }       
    } 
    llama_funcion_accion($iddoc,$idformato,"adicionar","ANTERIOR");
   /* if($_POST["iddoc"] && $_POST["tabla"]=="ft_decision_disciplinaria")
      $idplantilla=guardar_decision_disciplinaria($_POST["iddoc"]);
    else*/if($_POST["iddoc"])
      $idplantilla=guardar_documento($_POST["iddoc"]);
 	  //die();
    if(!$idplantilla)  
      {alerta("No se ha podido Crear el Formato..");
       phpmkr_query("update documento set estado='ELIMINADO' where iddocumento=".$_POST["iddoc"],$conn);
      } 
    else
    {  
    //si es una factura busco el id de la ruta donde voy
    $formato=busca_filtro_tabla("","formato","nombre_tabla LIKE '".@$_POST["tabla"]."'","",$conn);
    $banderas=array();
    if($formato["numcampos"])
      $banderas=explode(",",$formato[0]["banderas"]);
    //print_r($banderas);
    //arreglo con los datos que necesita transferir archivo
    $datos["archivo_idarchivo"]=$_POST["iddoc"];
    $datos["nombre"]="BORRADOR";
    $datos["tipo_destino"]=1;
    $datos["tipo"]="";
    $aux_destino[0]=$_SESSION["usuario_actual"];
    if(!isset($adicionales))
      $adicionales="";
    //realizo la primera transferencia del creador de la plantilla para el mismo,
    //para poder editarla antes de enviarla
    transferir_archivo_prueba($datos,$aux_destino,$adicionales,"");
    //para enviarla a los otros destinos si los tiene
    $datos["archivo_idarchivo"]=$_POST["iddoc"];
    $datos["nombre"]="POR_APROBAR";
    $datos["tipo"]="";
    $adicionales["activo"]="1";
    if( (!isset($_POST["firmado"]) || (isset($_POST["firmado"]) && $_POST["firmado"]=="una")))
    {
      //lo transfiero al radicador de salida
      $radicador=busca_filtro_tabla("f.funcionario_codigo","configuracion c,funcionario f","c.nombre='radicador_salida' and f.login=c.valor","",$conn);
      if($radicador["numcampos"]){
        $aux_destino[0]=$radicador[0]["funcionario_codigo"];
        transferir_archivo_prueba($datos,$aux_destino,$adicionales);   
      }      
    }
    elseif(isset($_POST["firmado"]) && $_POST["firmado"]=="varias")
    {
     die();
    }
    if(in_array("e",$banderas)){
      aprobar($_POST["iddoc"]);
    }   
   llama_funcion_accion($iddoc,$idformato,"adicionar","POSTERIOR");   
   return $_POST["iddoc"];
   }
}
function validar_confirmacion(){
	global $conn;
	$cantidad=busca_filtro_tabla("","configuracion a","a.nombre='cantidad_confirmacion'","",$conn);
	$por_ingresar=busca_filtro_tabla("count(*) as cant","documento a","lower(a.estado)='iniciado' AND a.tipo_radicado=1","",$conn);
	
	if(($por_ingresar[0]["cant"]+1)>$cantidad[0]["valor"]){
		$datos_url=array();
		foreach($_REQUEST as $clave => $valor){
			if($clave!='validar')
				$datos_url[]=$clave."=".$valor;
		}
		$cadena=implode("&",$datos_url);
		?>
		<script>
		var ingreso=confirm("Esta seguro de generar un nuevo radicado?");
		if(ingreso){
			window.open("colilla.php?<?php echo $cadena; ?>","_self");
		}
		else{
			window.open("pantallas/buscador_principal.php?idbusqueda=7","_self");
		}
		</script>
		<?php
		die();
	}
	else
		return;
}
function validar_confirmacion_salida($consecutivo){
	global $conn;
	if($consecutivo=='radicacion_salida'){
		?>
		<script>
		var ingreso=confirm("Esta seguro de generar un nuevo radicado?");
		if(ingreso){
			window.open("colilla.php?consecutivo=radicacion_salida&salidas=1","_self");
		}else{
			window.open("pantallas/buscador_principal.php?idbusqueda=10","_self");
		}
		</script>
		<?php
		die();
	}
}
?>