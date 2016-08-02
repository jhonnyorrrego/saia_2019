<?php 
@session_start();
$_SESSION['radicacion_masiva']=1;
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

if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
	$_SESSION["LOGIN".LLAVE_SAIA]="cerok";
	$_SESSION["usuario_actual"]="1";
}

include_once($ruta_db_superior."formatos/librerias/funciones_acciones.php");
include_once($ruta_db_superior."class_transferencia.php");

if(@$_REQUEST['cantidad'] && !@$_REQUEST['acumulado']){
    $repeticiones=$_REQUEST['cantidad'];
    $acumulado=0;
}
if(@$_REQUEST['acumulado']){
    $acumulado=intval($_REQUEST['acumulado']);
    $repeticiones=intval($_REQUEST['cantidad']);
}

if((@$_REQUEST['cantidad'] || @$_REQUEST['acumulado']) && @$_REQUEST['nombre_formato']){

$nombre_formato=@$_REQUEST['nombre_formato'];
$campos_formato_fijos=array('fecha_carta'=>date('Y-m-d'),'destinos'=>3,'copia'=>3,'copiainterna'=>'');
$datos_formato=busca_filtro_tabla("","formato","nombre='".$nombre_formato."'","",$conn);
$funcionarios=busca_filtro_tabla("iddependencia_cargo,funcionario_codigo","vfuncionario_dc","estado_dc=1 AND tipo_cargo=1","iddependencia_cargo ASC",$conn);
$vector_iddependencia_cargo=extrae_campo($funcionarios,'iddependencia_cargo');

if($datos_formato['numcampos']){
    
    $campos_formato=busca_filtro_tabla("","campos_formato","formato_idformato=".$datos_formato[0]['idformato'],"",$conn);
    if($campos_formato['numcampos']){
        
        $keys_restriccion=array('dependencia','documento_iddocumento','idft_'.$nombre_formato);  //llaves especiales que no deben tener valores
        
        if($acumulado<$repeticiones){
       // for($j=0;$j<$repeticiones;$j++){
            $valores_insertar=array(); //array a insertar en ft
            for($i=0;$i<$campos_formato['numcampos'];$i++){
                if( !array_key_exists($campos_formato[$i]['nombre'],$campos_formato_fijos) ){
                    if( !in_array($campos_formato[$i]['nombre'],$keys_restriccion) ){
                        if(is_null($campos_formato[$i]['predeterminado']) || $campos_formato[$i]['predeterminado']==''){
                            switch($campos_formato[$i]['tipo_dato']){
                                case 'TEXT':
                                    $valores_insertar[$campos_formato[$i]['nombre']] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
                                    break;
                                case 'VARCHAR':
                                    $valores_insertar[$campos_formato[$i]['nombre']] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                                    break;        
                                case 'CHAR':
                                    $valores_insertar[$campos_formato[$i]['nombre']] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
                                    break;
                                case 'INT':
                                   $valores_insertar[$campos_formato[$i]['nombre']] = rand ( 0 , 1000 );
                                    break;
                                case 'DATE':
                                    $valores_insertar[$campos_formato[$i]['nombre']] = fecha_aleatoria('Y-m-d');
                                    break;
                                case 'DATETIME':
                                     $valores_insertar[$campos_formato[$i]['nombre']] = fecha_aleatoria('Y-m-d H:i:s');
                                    break;
                                case 'TIME':
                                    $valores_insertar[$campos_formato[$i]['nombre']] = fecha_aleatoria('H:i');
                                    break;
                            }                
                        }else{
                             $valores_insertar[$campos_formato[$i]['nombre']] = $campos_formato[$i]['predeterminado'];
                        }
                    }else{ //fin keys restriccion
                        if( $campos_formato[$i]['nombre']=='dependencia' ){ //dependencias al azar
                            $iddependencia_cargo_aleatorio = array_rand($vector_iddependencia_cargo);
                            $valores_insertar[$campos_formato[$i]['nombre']] = $vector_iddependencia_cargo[$iddependencia_cargo_aleatorio];
                            $funcionario_codigo=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","iddependencia_cargo=". $valores_insertar[$campos_formato[$i]['nombre']],"",$conn);
                            $valores_insertar['ejecutor']= $funcionario_codigo[0]['funcionario_codigo'];
                        }
                    }
                }else{//fin if !campos_formato_fijos    
                    $valores_insertar[$campos_formato[$i]['nombre']] = $campos_formato_fijos[$campos_formato[$i]['nombre']];
                }
            } //fin for campos_formato
            
            
            unset($_REQUEST);
            unset($_POST);
            
            
            $valores_insertar['nombre_formato']=$nombre_formato;
            $valores_insertar['idformato']=$datos_formato[0]['idformato'];
            $valores_insertar['tipo_radicado']=$datos_formato[0]['contador_idcontador'];
    
            $_REQUEST=$valores_insertar;
            $_POST=$valores_insertar;
            
            $iddoc=pre_radicacion();
            
            //print_r($iddoc);
            //echo('<---'.($j+1).' <br><br>');
           
            $acumulado++;
             ?>
                 <script>
                     window.location='prueba_radicacion_masiva.php?nombre_formato=<?php echo($nombre_formato); ?>&cantidad=<?php echo($repeticiones); ?>&acumulado=<?php echo($acumulado); ?>';
                 </script>
             <?php
            
            
        }else{
            echo('Nombre del Formato: '.@$_REQUEST['nombre_formato'].'<br/><br/>');
            echo('FIN DE LA EJECUCION: '.date('Y-m-d H:i:s'));
            die();
            
        } //fin for repeticiones
        
    }else{
        alerta('no existen campos en el formato');
    }
}else{
    alerta('no existe formato con ese nombre');
}
}

function fecha_aleatoria($formato) {
    $format_date=$formato;
    $fecha = date($format_date);
    $nuevafecha = strtotime ( '-1 year' , strtotime ( $fecha ) ) ;
    $fecha_rand=date($format_date, rand($nuevafecha, date($format_date) ) );
    return($fecha_rand);
}

function pre_radicacion(){
  $_REQUEST["encabezado"] = 1;
  $_REQUEST["firma"] = 1;
  $_REQUEST["campo_descripcion"] = "4948"; //se colocan los idcampos del campo descripcion;
  $_REQUEST["accion"] = "guardar_detalle";// esto siempre va
  $_REQUEST["funcion"] = "radicar_plantilla";// esto siempre va
  $_REQUEST["continuar"] = "Solicitar Radicado";  //Siempre va esto
  $_POST=$_REQUEST;
  
  
 
  $iddoc=radicar_plantilla2();
  return($iddoc);
}


function radicar_plantilla2(){ 
    global $conn,$sql,$ruta_db_superior;  
    $retorno=array();

   
   //print_r($_REQUEST); die("aquiii");
   $valores=array();
   $plantilla="'".strtoupper(@$_POST['nombre_formato'])."'";
   $_REQUEST["tabla"] = strtolower("ft_".@$_POST['nombre_formato']);
   $_POST["tabla"] = strtolower("ft_".@$_POST['nombre_formato']);
   $idformato=intval(@$_POST['idformato']);
   //hace el ejecutor igual al codigo del funcionario logueado actualmente
   if(!@$_POST["ejecutor"]){
        $_POST["ejecutor"]=$_SESSION["usuario_actual"];
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
    if(isset($_POST["serie_idserie"]) && @$_POST["serie_idserie"]){
      $valores["serie"]=$_POST["serie_idserie"];
    }
    else{
        $valores["serie"]=0;
    } 
    $valores["plantilla"]=$plantilla;
    
    if(isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"]<>""){
        $valores["responsable"]=$_REQUEST["dependencia"];      
    }
    if(@$_POST["tipo_radicado"]){  
        $valores["tipo_radicado"]=$_POST["tipo_radicado"];
    }else{
         $valores["tipo_radicado"]=0;
    }
	
    if($valores["tipo_radicado"]){
      $tipo_rad=busca_filtro_tabla("","contador","idcontador=".$valores["tipo_radicado"],"",$conn);
      $_POST["tipo_radicado"]=$tipo_rad[0]["nombre"];
    }else{
        $retorno['exito']=0;
        $retorno['mensaje']='No hay Consecutivo';
    	return($retorno);
    	die();
    } 
	
    $valores["numero"]=0;       
    if(isset($_POST["municipio"])){
         $valores["municipio_idmunicipio"]=$_POST["municipio"];
    }else if(isset($_POST["municipio_idmunicipio"])){
         $valores["municipio_idmunicipio"]=$_POST["municipio_idmunicipio"]; 
    }else{
        $mun=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
        if($mun["numcampos"]){
            $valores["municipio_idmunicipio"]=$mun[0][0];
        }else{
            $valores["municipio_idmunicipio"]=633; 
        }
    }	  
    //radico el documento
    //print_r($valores);
    /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
    llama_funcion_accion(NULL,$idformato,"radicar","ANTERIOR");
	//print_r($valores);die();
    $_POST["iddoc"]=radicar_documento_prueba(trim($_POST["tipo_radicado"]),$valores,Null);
    $iddoc=$_POST["iddoc"];
	
   include_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");  
   $permisos=NULL;    
   cargar_archivo($_POST["iddoc"],$permisos); 
    /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
    llama_funcion_accion($iddoc,$idformato,"radicar","POSTERIOR");

   if(!array_key_exists("destino",$_POST)){ 
        if($_POST["tabla"]=="encabezado_factura"){
            $_POST["destino"]=$_POST["revisa"];
        }
        else{
            $_POST["destino"]=$_POST["revisado"];
        }
    }
   //  echo "Request  :"; print_r($_REQUEST); 	
   //  echo "Valores :"; print_r($valores);
   //  die();
    //guardo la relaci?n del documento creado como respuesta con su antecesor
    if(array_key_exists("anterior",$_REQUEST)){          
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
    if(isset($_REQUEST["tabla"])){
         $ins_calidad=busca_filtro_tabla("*","estructura_calidad","nombre LIKE '".strtolower($_REQUEST["tabla"])."'","",$conn);    
    }  
     
    //guardo los datos del formulario principal del documento (plantilla)
    if(@$_POST["tabla"]=="scdp"){
        phpmkr_query("UPDATE scdp SET documento_iddocumento=".$_POST["iddoc"]." WHERE num_previo=".$_POST["num_previo"],$conn);
    }elseif($ins_calidad["numcampos"]){
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
      $idplantilla=guardar_documento2($_POST["iddoc"]);
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
		llama_funcion_accion($iddoc,$idformato,"adicionar","POSTERIOR");
    if(in_array("e",$banderas)){
      aprobar2($_POST["iddoc"]);
    }
   return $_POST["iddoc"];
   }
}


function guardar_documento2($iddoc,$tipo=0)
{ 
   global $conn,$ruta_db_superior;
   $insertado=0;
   $lasignaciones=array();
   $_POST["fecha"]=date("Y-m-d H:i:s");

    if(isset($_REQUEST["origen"])){
    $pos=strpos($_REQUEST["origen"],"_");
     if($pos!==false){
      $_REQUEST["origen"]=substr($_REQUEST["origen"],0,$pos);
     }
    }
    $valores=array();
    $campos=array();
    $lista_campos=array();
    
   $buscar = phpmkr_query("SELECT A.* FROM ".$_REQUEST["tabla"]." A WHERE 1=0",$conn);
   
   if(@$_REQUEST["idformato"]){
    $idformato=$_REQUEST["idformato"];
   }
   else if(@$_REQUEST["tabla"]){
    $formato = busca_filtro_tabla("idformato","formato","nombre_tabla LIKE '".strtolower($_REQUEST["tabla"])."'","",$conn);
    if($formato["numcampos"]){
      $idformato = $formato[0]["idformato"]; 
    }
    else 
      $idformato=0;   
   }
   else 
    $idformato=0;
   for($i=0;$i<phpmkr_num_fields($buscar);$i++){
    $nombre_campo=phpmkr_field_name($buscar,$i);
    array_push($lista_campos,$nombre_campo);
   }
  
   if($idformato){
    $ltareas=array();
    $larchivos=array();
    $where= "formato_idformato=".$idformato." AND (banderas NOT LIKE '%pk%' OR banderas IS NULL)";
    if($i)
      $where.=" AND nombre IN('".implode("','",$lista_campos)."')";
    $lcampos=busca_filtro_tabla("idcampos_formato,tipo_dato,nombre,etiqueta_html,valor,longitud","campos_formato",$where,"",$conn);



   for($j=0;$j<$lcampos["numcampos"];$j++)
    {//si el valor es un array
     if(is_array($_REQUEST[$lcampos[$j]["nombre"]])&&$lcampos[$j]["etiqueta_html"]<>"archivo")
        {array_push($valores,"'".implode(',',@$_REQUEST[$lcampos[$j]["nombre"]])."'");
         array_push($campos,$lcampos[$j]["nombre"]);
        }
     elseif($lcampos[$j]["valor"]=="{*form_ejecutor*}")     
        {array_push($campos,$lcampos[$j]["nombre"]);
         $valor=ejecutoradd($_REQUEST[$lcampos[$j]["nombre"]]);
         array_push($valores,$valor);           
        }
     else
      {    
    /*Valida las etiquetas html Para organizar arreglos especificos para procesar Ej:detalles,tareas*/
      switch($lcampos[$j]["etiqueta_html"]){
        case "detalle":
          if(@$_REQUEST["anterior"]){
           $formato_detalle=busca_filtro_tabla("id".$lcampos[$j]["nombre"],$lcampos[$j]["nombre"],"documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
           if($formato_detalle["numcampos"])
             $_REQUEST[$lcampos[$j]["nombre"]]=$formato_detalle[0]["id".$lcampos[$j]["nombre"]];
          }
        break;
        case "tarea":
          if(@$_REQUEST["tarea_".$lcampos[$j]["nombre"]]){
            array_push($ltareas,array("tarea"=>$_REQUEST["tarea_".$lcampos[$j]["nombre"]],"fecha"=>$_REQUEST[$lcampos[$j]["nombre"]]));
          }
        break;
	     case "archivo":
	        array_push($larchivos,$lcampos[$j]["idcampos_formato"]);
        break;
        case "fecha":
          if(@$_REQUEST["asig_".$lcampos[$j]["nombre"]] && $_REQUEST["asig_".$lcampos[$j]["nombre"]]!=""){
            array_push($lasignaciones,$_REQUEST["asig_".$lcampos[$j]["nombre"]]);
          }
        break;
	
      }
    
      /*Validaciones especiales para los tipos de dato */
   
      if(isset($_REQUEST[$lcampos[$j]["nombre"]]))
      {//print_r($lcampos[$j]);
       switch(strtoupper($lcampos[$j]["tipo_dato"])){
         
        case "TEXT":
        $_REQUEST[$lcampos[$j]["nombre"]]=str_replace("'","&#39;",stripslashes($_REQUEST[$lcampos[$j]["nombre"]]));
        //echo $lcampos[$j]["longitud"]."//".$lcampos[$j]["nombre"]."<br />";
         if($tipo==1&&$lcampos[$j]["longitud"]>=4000)
           {
            $contenido=htmlentities(limpia_tabla(@$_REQUEST[$lcampos[$j]["nombre"]]));
            guardar_lob($lcampos[$j]["nombre"],$_REQUEST["tabla"],"documento_iddocumento=".$iddoc,$contenido,"texto",$conn);
           }
         elseif($lcampos[$j]["longitud"]<4000)
           {$contenido=limpia_tabla(@$_REQUEST[$lcampos[$j]["nombre"]]);
            array_push($valores,"'".@$_REQUEST[$lcampos[$j]["nombre"]]."'");
            array_push($campos,$lcampos[$j]["nombre"]);
           }
        
        break;
        case "BLOB":
          if($tipo==1)
           {$apuntador=fopen($_FILES[$lcampos[$j]["nombre"]]["tmp_name"],"rb");
            $contenido=fread($apuntador,$_FILES[$lcampos[$j]["nombre"]]["size"]);
            fclose($apuntador);
            guardar_lob($lcampos[$j]["nombre"],$_REQUEST["tabla"],"documento_iddocumento=".$iddoc,$contenido,"archivo",$conn);
           }          
        break;
        case "TIME":
          array_push($valores,"'".@$_REQUEST[$lcampos[$j]["nombre"]]."'");
          array_push($campos,$lcampos[$j]["nombre"]);
        break;
        case "DATE":
          array_push($campos,$lcampos[$j]["nombre"]);
          if(@$_REQUEST[$lcampos[$j]["nombre"]]&&$_REQUEST[$lcampos[$j]["nombre"]]<>'0000-00-00'){
            array_push($valores,fecha_db_almacenar(@$_REQUEST[$lcampos[$j]["nombre"]],'Y-m-d'));
          }
          else {
            array_push($valores,"NULL");
          }  
        break;
        case "DATETIME":
          array_push($campos,$lcampos[$j]["nombre"]);   
          if(@$_REQUEST[$lcampos[$j]["nombre"]]&&$_REQUEST[$lcampos[$j]["nombre"]]<>'0000-00-00 00:00'){
            array_push($valores,fecha_db_almacenar(@$_REQUEST[$lcampos[$j]["nombre"]],'Y-m-d H:i:s'));
          }
          else {
            array_push($valores,"NULL");
          } 
          break; 
         default:
         $_REQUEST[$lcampos[$j]["nombre"]]=str_replace("'","&#39;",stripslashes($_REQUEST[$lcampos[$j]["nombre"]]));
         if(is_array($_REQUEST[$lcampos[$j]["nombre"]]))
            array_push($valores,"'".implode(',',@$_REQUEST[$lcampos[$j]["nombre"]])."'");
         elseif(@$_REQUEST[$lcampos[$j]["nombre"]]<>'')
            array_push($valores,"'".htmlentities((@$_REQUEST[$lcampos[$j]["nombre"]]))."'");
         else 
          {  array_push($valores,"''");  
             
          }
         array_push($campos,$lcampos[$j]["nombre"]);           
        break;
      }
     }       
    }
    }
   }

 if(count($campos) && count($valores) && $tipo==0){
    if(!in_array('documento_iddocumento',$campos))
      {array_push($campos,"documento_iddocumento");
       array_push($valores,$iddoc);
      }
    else
      {$pos=array_search ('documento_iddocumento',$campos);
       $valores[$pos]=$iddoc;
      } 
     llama_funcion_accion($iddoc,$idformato,"adicionar","ANTERIOR");
  
    $sql="INSERT INTO ".strtolower($_REQUEST["tabla"])."(".implode(",",$campos).") VALUES (".implode(",",$valores).")";
  		/*if(usuario_actual("login")=="cerok"){  			
  			print_r($sql);die();
  		}*/
     phpmkr_query($sql,$conn);  
    //echo ($sql);
   $insertado=phpmkr_insert_id();
   $sql="insert into permiso_documento(funcionario,documento_iddocumento,permisos) values('".usuario_actual("funcionario_codigo")."','".$iddoc."','e,m,r')";
   phpmkr_query($sql,$conn);

     if($insertado){
        //guardo los campos tipo clob y blob
         for($j=0;$j<$lcampos["numcampos"];$j++)
           {if(isset($_REQUEST[$lcampos[$j]["nombre"]]))
              {
               switch(strtoupper($lcampos[$j]["tipo_dato"]))
               {
                case "TEXT":
                 if($lcampos[$j]["longitud"]>=4000)
                   {$contenido=htmlentities(limpia_tabla(@$_REQUEST[$lcampos[$j]["nombre"]]));
                    guardar_lob($lcampos[$j]["nombre"],$_REQUEST["tabla"],"documento_iddocumento=".$iddoc,$contenido,"texto",$conn);
                   }
                break;
                case "BLOB":
                  $apuntador=fopen($_FILES[$lcampos[$j]["nombre"]]["tmp_name"],"rb");
                  $contenido=fread($apuntador,$_FILES[$lcampos[$j]["nombre"]]["size"]);
                  fclose($apuntador);
                  guardar_lob($lcampos[$j]["nombre"],$_REQUEST["tabla"],"documento_iddocumento=".$iddoc,$contenido,"archivo",$conn);          
                break;
               } 
             }
           }
  // si el contenido se debe guardar como una plantilla para el usuario Pilas que aqui se puede confundir con el nombre plantilla del documento  
      if(isset($_REQUEST["plantilla"]) && $_REQUEST["plantilla"]==1) 
         {crear_pretexto($_REQUEST["asplantilla"],$_REQUEST["contenido"]);
         } 
     //borrar datos guardados en autoguardado
     $nomformato=busca_filtro_tabla("nombre","formato","idformato=$idformato","",$conn);
     $sql="delete from autoguardado where usuario='".usuario_actual("funcionario_codigo")."' and formato='".$nomformato[0]["nombre"]."'";
      phpmkr_query($sql,$conn);
     }
     else
      {alerta("No se ha podido Crear el Formato.");  
       die($sql);
      }
   }
   elseif($tipo==1)  //cuando voy a editar
     {$update=array();
      for($i=0;$i<count($campos);$i++)
         $update[]=$campos[$i]."=".$valores[$i];
      /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
      llama_funcion_accion($iddoc,$idformato,"editar","ANTERIOR");
       $sql="UPDATE ".strtolower($_REQUEST["tabla"])." SET ".implode(",",$update)." WHERE documento_iddocumento=$iddoc";
     //echo ($sql);
      phpmkr_query($sql,$conn); 
      $pos=array_search("serie_idserie",$campos);
      if($pos!==false)
         {//die("$sql<br />serie:".$valores[$pos]);
          if($valores[$pos]=="''")
             $valores[$pos]="'0'";
          $sql="UPDATE documento SET serie=".$valores[$pos]." WHERE iddocumento='$iddoc'";
          phpmkr_query($sql,$conn);
         }
      $insertado=$idplantilla;  
       
  //    die($sql);
      /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
      llama_funcion_accion($iddoc,$idformato,"editar","POSTERIOR");

     }
 //actualizo la descripcion del documento cuando los campos descripcion cambian
 if(isset($_REQUEST["campo_descripcion"])){
    include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
    $campo=busca_filtro_tabla("","campos_formato","idcampos_formato IN(".$_REQUEST["campo_descripcion"].")","orden",$conn);
    for($i=0;$i<$campo["numcampos"];$i++){
      if(isset($_REQUEST[$campo[$i]["nombre"]])){
        if($i==0)
          $descripcion=$campo[$i]["etiqueta"].": ".mostrar_valor_campo($campo[$i]["nombre"],$idformato,$iddoc,1);
        else  $descripcion.="<br />".$campo[$i]["etiqueta"].": ".mostrar_valor_campo($campo[$i]["nombre"],$idformato,$iddoc,1);
      }
    }
   }
   else if(!isset($_REQUEST["descripcion"]) && isset($_REQUEST["asunto"]))
        $descripcion="'".$_REQUEST["asunto"]."'";  
   else if($_REQUEST["descripcion"])
       $descripcion="'".$_REQUEST["descripcion"]."'";
   $descripcion=str_replace("'","",$descripcion);
   $sql="UPDATE documento SET descripcion='".$descripcion."' WHERE iddocumento='$iddoc'";  
   phpmkr_query($sql,$conn);
  // die();
/*asigno las tareas al documento y formato creado dependiendo de la(s) tarea(s) solicitada(s)*/
        if(count($ltareas)){
          include_once("asignaciones/funciones.php");
          asignar_tarea_a_documento($iddoc,$ltareas);
        }
	       
        /*Actualiza las asignaciones con el documento actual*/
        if(count($lasignaciones)){
          $sql="UPDATE asignacion SET documento_iddocumento=".$iddoc." WHERE idasignacion IN(".implode(",",$lasignaciones).")";
          
          phpmkr_query($sql,$conn);
          
        }
//print_r($larchivos);
      if(count($larchivos)){
        /*envio los datos a cargar_archivo*/
       include_once("anexosdigitales/funciones_archivo.php");
       cargar_archivo_formato($larchivos,$idformato,$iddoc);
       //die();
	//die("idformato: $insertado");
      }  
return($insertado);
}
function aprobar2($iddoc=0,$url="")
  {//$con=new Conexion("radica_camara");
   //$buscar=new SQL($con->Obtener_Conexion(), "Oracle");
   global $conn;
   $transferir=1;
    if(isset($_REQUEST["iddoc"])&&$_REQUEST["iddoc"])
      $iddoc=$_REQUEST["iddoc"];

   $tipo_radicado=busca_filtro_tabla("documento.*,contador.nombre,idformato","documento,contador,formato","idcontador=tipo_radicado and iddocumento=$iddoc and lower(plantilla)=lower(formato.nombre)","",$conn);
   
   $formato=strtolower($tipo_radicado[0]["plantilla"]);
   $registro_actual=busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and A.destino=".$_SESSION["usuario_actual"],"A.idtransferencia",$conn);
       
   /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
   llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"confirmar","ANTERIOR");
   if($registro_actual["numcampos"]>0)
      {$registro_anterior=busca_filtro_tabla("A.*","buzon_entrada A","A.nombre='POR_APROBAR' and A.activo=1 and A.idtransferencia<".$registro_actual[0]["idtransferencia"]." and A.archivo_idarchivo=".$iddoc." and origen=".$_SESSION["usuario_actual"],"A.idtransferencia desc",$conn);
       $terminado=busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.nombre='POR_APROBAR' and A.activo=1","A.idtransferencia",$conn);
	   
	   
     //realizar la transferencia
      if($registro_actual["numcampos"]>0 && $registro_anterior["numcampos"]==0)
        {
          $destino=$registro_actual[0]["destino"];
          $origen=$registro_actual[0]["origen"]; 
          //cambie count($terminado)
          
          if(($terminado["numcampos"]==$registro_actual["numcampos"]) || ($terminado["numcampos"]==1 && $terminado[0]["destino"]==$_SESSION["usuario_actual"]))
              $estado="APROBADO";
          else
              $estado="REVISADO"; 
          $campos="archivo_idarchivo,nombre,origen,fecha,destino,tipo,tipo_origen,tipo_destino,ruta_idruta";
          //buzon de salida
         for($i=0;$i<$registro_actual["numcampos"];$i++)
            {
              //--------------Actualizacion para cuando se cree una ruta se le pueda mandar a una misma persona-----------
              $registro_intermedio= busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<".$registro_actual[$i]["idtransferencia"],"A.idtransferencia",$conn);             
              if($registro_intermedio["numcampos"])
                  break;              
             $valores=$iddoc.",'$estado',".$registro_actual[$i]["destino"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".$registro_actual[$i]["origen"].",'DOCUMENTO',1,1";
             if($registro_actual[$i]["ruta_idruta"]<>"")
              $valores.=",".$registro_actual[$i]["ruta_idruta"];
             else
              $valores.=",''"; 
             phpmkr_query("INSERT INTO buzon_salida (".$campos.") VALUES (".$valores.")",$conn);
             //buzon de entrada
             phpmkr_query("UPDATE buzon_entrada SET activo=0 WHERE idtransferencia=".$registro_actual[$i]["idtransferencia"],$conn);
             $valores=$iddoc.",'$estado',$origen,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$destino,'DOCUMENTO',1,1,";
            }                            
          if($registro_actual[0]["ruta_idruta"]<>"")
            $valores.=$registro_actual[0]["ruta_idruta"];
          else
            $valores.="''";   
          //reviso si la ruta es restrictiva
          if($registro_actual[0]["ruta_idruta"]>0)
           {$restrictiva=busca_filtro_tabla("restrictivo","ruta","idruta=".$registro_actual[0]["ruta_idruta"],"",$conn);
            if($restrictiva["numcampos"] && $restrictiva[0]["restrictivo"]==1)
              {//busco cuantos faltan por aprobar si es restrictiva
               $cuantos_faltan=busca_filtro_tabla("count(idtransferencia) as cuantos","buzon_entrada","nombre='POR_APROBAR' and activo=1 and ruta_idruta=".$registro_actual[0]["ruta_idruta"]." and archivo_idarchivo=".$_REQUEST["iddoc"],"",$conn);
               if($cuantos_faltan[0]["cuantos"])
                  {$valores=$iddoc.",'VERIFICACION',$origen,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$destino,'DOCUMENTO',1,1";
                   if($registro_actual[$i]["ruta_idruta"]<>"")
                    $valores.=",".$registro_actual[$i]["ruta_idruta"];
                   else
                    $valores.=",''"; 
                   phpmkr_query("INSERT INTO buzon_entrada(".$campos.") VALUES (".$valores.")",$conn);
                   if($registro_actual[$i]["origen"] != $registro_actual[$i]["destino"])
                 {  
                   $documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=$iddoc","",$conn);
                   $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];
                   $x_tipo_envio[] = 'msg';
                   $x_tipo_envio[] = 'e-interno';                         
                   $destino_mns[0] = $registro_actual[$i]["origen"];             
                   //enviar_mensaje("origen",$destino_mns,$mensaje);
                  }
                   $transferir=0;
                  }
               else
                  {$update="update buzon_entrada set nombre='TRANSFERIDO' where ruta_idruta=".$registro_actual[0]["ruta_idruta"]." and archivo_idarchivo=$iddoc and nombre='VERIFICACION'"; 
                   phpmkr_query($update,$conn);
                   $transferir=1;
                  }   
              }
           }
         if($transferir==1)
            {
             for($i=0;$i<$registro_actual["numcampos"];$i++)
                {
                  $registro_intermedio= busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<".$registro_actual[$i]["idtransferencia"],"A.idtransferencia",$conn);             
              if($registro_intermedio["numcampos"])
                  break;                  
                  $valores=$iddoc.",'$estado',".$registro_actual[$i]["origen"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".$registro_actual[$i]["destino"].",'DOCUMENTO',1,1,";
                 if($registro_actual[$i]["ruta_idruta"]<>"")
                    $valores.=$registro_actual[$i]["ruta_idruta"];
                 else
                    $valores.="''";    
                 phpmkr_query("INSERT INTO buzon_entrada(".$campos.") VALUES (".$valores.")",$conn);
                 procesar_estados($registro_actual[$i]["destino"],$registro_actual[$i]["origen"],$estado,$iddoc);
                 if($registro_actual[$i]["origen"] != $registro_actual[$i]["destino"])
                 { 
                  $documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=$iddoc","",$conn);
                  $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];
                  $x_tipo_envio[] = 'msg';
                  $x_tipo_envio[] = 'e-interno';      
                  $destino_mns[0] = $registro_actual[$i]["origen"];                               
                  //enviar_mensaje("origen",$destino_mns,$mensaje,$x_tipo_envio);   
                 }
                }
            }
          if(($terminado["numcampos"]==$registro_actual["numcampos"]) || ($terminado["numcampos"]==1 && $terminado[0]["destino"]==$_SESSION["usuario_actual"]))
              {llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"aprobar","ANTERIOR");
               $tipo_radicado=busca_filtro_tabla("documento.*,contador.nombre,plantilla,idformato","documento,contador,formato C","idcontador=tipo_radicado and iddocumento=$iddoc AND lower(plantilla)=lower(C.nombre)","",$conn);

               if($tipo_radicado[0]["numero"]==0)
                  {$numero=contador($iddoc,$tipo_radicado[0]["nombre"]);
                   phpmkr_query("UPDATE documento SET estado='APROBADO', fecha=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." WHERE iddocumento=".$iddoc,$conn);
                  }
               else
                   phpmkr_query("UPDATE documento SET estado='APROBADO',activa_admin=0, fecha=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." WHERE iddocumento=".$iddoc,$conn);               
              // Para los casos de los formatos mensajes (e-mail)
               if($tipo_radicado[0]["plantilla"]=='MENSAJE')
               {                
                require("email/email_doc.php");                                
                enviar_email($iddoc);
               }
                              //si el formato tiene el campo de la fecha con el nombre predeterminado lo actualizo tambien    

              $nombre_tabla=busca_filtro_tabla("nombre_tabla,banderas","formato","nombre like '$formato'","",$conn);
              $tabla=$nombre_tabla[0]["nombre_tabla"];
               $campos_formato=listar_campos_tabla($tabla); 
              
               if(in_array('fecha_'.$formato,$campos_formato))
                  {$sql="update ".$tabla." set fecha_".$formato."=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." where documento_iddocumento=".$iddoc;
                  //echo ($sql);
                   phpmkr_query($sql,$conn);
                  }
               $respuestas=busca_filtro_tabla("origen,estado","respuesta,documento","iddocumento=origen and destino='".$iddoc."' and estado in('TRAMITE','ACTIVO','APROBADO')","",$conn);
               if($respuestas["numcampos"]>0)      
               { $origen_respuesta = busca_filtro_tabla("origen","buzon_salida","archivo_idarchivo=$iddoc and nombre='BORRADOR'","",$conn);        
                 $datos["origen"]=$origen_respuesta[0]["origen"];
                 $datos["nombre"]="RESPONDIDO";
                 $datos["tipo"]="";
                 $datos["tipo_origen"]="1";
                 $datos["tipo_destino"]="1";
                 for($i=0;$i<$respuestas["numcampos"];$i++)
                  {if($respuestas[$i]["estado"]=="TRAMITE" || $respuestas[$i]["estado"]=="ACTIVO")
                     {$sql="UPDATE documento set estado='APROBADO' where iddocumento='".$respuestas[$i]["origen"]."'";
                      phpmkr_query($sql,$conn);
                     } 
                   $datos["archivo_idarchivo"]=$respuestas[$i]["origen"];
                   $destino_respuesta[0]=$origen_respuesta[0]["origen"];
                   $destino_respuesta[0]=usuario_actual("funcionario_codigo");
                   transferir_archivo_prueba($datos,$destino_respuesta,"","");    
                  }
               }       
               //para enviarla a los otros destinos si los tiene
               $datos["archivo_idarchivo"]=$iddoc;
               $datos["nombre"]="APROBADO";
               $datos["tipo"]="";
                 $destino=array();
               //si son varios destinos
               /* if($tipo_radicado[0]["plantilla"]=="CARTA")
              {
               $destinos=busca_filtro_tabla("copiainterna","ft_carta","documento_iddocumento=$iddoc and copiainterna is not null","",$conn);  
               if($destinos["numcampos"]>0 && $destinos[0]["copiainterna"]!="")
                 $destino=explode(",",$destinos[0]["copiainterna"]);
              }
              elseif($tipo_radicado[0]["plantilla"]=="MEMORANDO")
               {
               $destinos=busca_filtro_tabla("destino,copia","ft_memorando","documento_iddocumento=$iddoc","",$conn);
               if($destinos[0]["copia"]=="")
                  $destino=explode(",",$destinos[0]["destino"]);
               else
                  $destino=explode(",",$destinos[0]["destino"].",".$destinos[0]["copia"]);
                
               }
               elseif($tipo_radicado[0]["plantilla"]=="CIRCULAR_CULTURA")
               {
               $destinos=busca_filtro_tabla("destino,copia","ft_circular_cultura","documento_iddocumento=$iddoc","",$conn);
               if($destinos[0]["copia"]=="")
                  $destino=explode(",",$destinos[0]["destino"]);
               else
                  $destino=explode(",",$destinos[0]["destino"].",".$destinos[0]["copia"]);
                
               }
               $aux_destino=array();
               if(count($destino)>0)
                 {$dep=array();
                  foreach($destino as $fila)
                    {
                    if(strpos($fila,"#")>0)
                        {
                         $dep = buscar_funcionarios(str_replace("#","",$fila), $dep);
                         $datos["tipo_destino"]=1; 
                        }
                     else if($fila<>"")  
                        {$aux_destino[]=codigo_rol($fila,5);
                         $datos["tipo_destino"]=1;
                        }
                      $aux_destino=array_merge($aux_destino,$dep);  
                    }
                  $aux_destino = array_unique($aux_destino);
                 
                  transferir_archivo_prueba($datos,$aux_destino,"","");   
                  $mensaje = "Tiene un nuevo documento para su revision: Tipo. ".$tipo_radicado[0]["plantilla"]." - Descripcion: ".$tipo_radicado[0]["descripcion"];
                  $x_tipo_envio[] = 'msg';
                  $x_tipo_envio[] = 'e-interno';
                  $list_destino = implode(',',$aux_destino);
                  $l_destino[] = $list_destino;
                 // enviar_mensaje("origen",$l_destino,$mensaje,'msg');        
                 }  */
                 llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"aprobar","POSTERIOR");
                //$url="html2ps/public_html/demo/html2ps.php?plantilla=$formato&iddoc=".$iddoc;
               }
              $array_banderas=explode(",",$nombre_tabla[0]["banderas"]);
            } 
        }
        else
         aprobar_reemplazo($iddoc);  

  llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"confirmar","POSTERIOR");      
    return;
}


?>