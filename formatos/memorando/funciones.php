<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."pantallas/documento/librerias.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");

function lista_destinos($idformato,$iddoc=NULL){
 global $conn;
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("destino,".fecha_db_obtener("fecha_".$datos[0]["nombre"],"Y-m-d"),$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);
 
 $destinos=explode(",",$resultado[0]["destino"]);
 $nombres=array();
 $lista=array();
 foreach($destinos as $fila){
 	 
     if(strpos($fila,'#')>0){
	     	$datos=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$fila),"",$conn);
	      $roles = busca_filtro_tabla("distinct funcionario_idfuncionario,iddependencia_cargo","dependencia_cargo","dependencia_iddependencia=".str_replace("#","",$fila),"",$conn);
	
	      if($roles["numcampos"]==1){
	      	$lista[]=cargos_memo($roles[0]["iddependencia_cargo"],$resultado[0]["fecha_memo"],"para",5);
	      }else{
	      	$lista[]=ucwords($datos[0]["nombre"]);
	      }
		 }else{
       $lista[]=cargos_memo($fila,$resultado[0]["fecha_".$datos[0]["nombre_tabla"]],"para",5);
     }
    }
 
 foreach ($lista as $value) {
 	$des = explode(',', $value);
  if(sizeof($des)> 1){
  	echo(''.$des[0].'<br />');
		echo($des[1]);
  }else{
  	echo(''.$des[0].'');
  }
	echo('<br />');
 }
 
 /*$funcionario_cargo = explode(',',$lista[1]);
 echo('<b>'.$funcionario_cargo[0].'</b><br />'); 
 echo($funcionario_cargo[1].'<br />');
 //echo($lista[0]);*/   
}

function jerarquia_destinos($lista,$fecha)
{ global $conn;
 $hijo="";
 $list = implode(",",$lista);
  $cargos= busca_filtro_tabla("funcionario_codigo,nombres,apellidos,nombre","cargo,dependencia_cargo,funcionario","cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo in ($list) and (fecha_inicial <= ".fecha_db_almacenar($fecha,"Y-m-d")." and fecha_final >= ".fecha_db_almacenar($fecha,"Y-m-d").")","GROUP by funcionario_codigo order by codigo_cargo ASC",$conn); 
  if(!$cargos["numcampos"])
    $cargos= busca_filtro_tabla("funcionario_codigo,nombres,apellidos,nombre","cargo,dependencia_cargo,funcionario","cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo in ($list)","iddependencia_cargo desc",$conn); 
  if($cargos["numcampos"]>0)
  for($i=0; $i<$cargos["numcampos"]; $i++) 
    $hijo .= $cargos[$i]["nombres"]."  ".$cargos[$i]["apellidos"]." - ".$cargos[$i]["nombre"]."<br />";  
 echo $hijo; 
 return(true);  
}



function mostrar_origen($idformato,$iddoc=NULL){
	global $conn;
 $formato=busca_filtro_tabla("nombre_tabla,nombre","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("origen,".fecha_db_obtener("b.fecha","Y-m-d")." as fecha",$formato[0]["nombre_tabla"].",documento b","documento_iddocumento=iddocumento and documento_iddocumento=$iddoc","",$conn);  
 $origen = explode(',',$resultado[0]["origen"]);  
 for($i=0; $i<count($origen); $i++){
 	$dependencia=busca_filtro_tabla("C.nombre,D.nombres,D.apellidos","dependencia_cargo A, cargo B, dependencia C,funcionario D","A.iddependencia_cargo=".$origen[$i]." AND D.idfuncionario=A.funcionario_idfuncionario AND B.idcargo=A.cargo_idcargo AND A.dependencia_iddependencia=C.iddependencia AND A.estado=1","",$conn);	 
     echo(''.$dependencia[0]["nombre"]."<br />");
	}

}

function mostrar_copias_memo($idformato,$iddoc=NULL)
{global $conn;
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $inf_memorando=busca_filtro_tabla("copia",$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);
 if($inf_memorando[0]["copia"]<>"")
    {echo '<span>Copia: ';
     $destinos=explode(",",$inf_memorando[0]["copia"]);
     $destinos=array_unique($destinos);
     sort($destinos);
     $lista=array();
        	for($i=0;$i<count($destinos);$i++) 
            {//si el destino es una dependencia
             if(strpos($destinos[$i],"#")>0)
                {$resultado=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$destinos[$i]),"",$conn);
                 $lista[]=ucwords($resultado[0]["nombre"]); 
                }
             else//si el destino es un funcionario
                {$resultado=busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","funcionario,cargo c,dependencia_cargo dc","dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$destinos[$i],"",$conn);                 
                 $lista[]=ucwords(strtolower($resultado[0]["nombres"]." ".$resultado[0]["apellidos"]));
                }
            }    
     echo implode(", ",$lista);       
     echo '</span><br/><br/>';
}
}

function nomenclatura($idformato,$iddoc=NULL)
{global $conn;
  $datos=busca_filtro_tabla("dependencia,fecha","ft_memorando, documento","iddocumento=documento_iddocumento and documento_iddocumento=$iddoc","",$conn);
  
 $resultado=busca_filtro_tabla("c.nombre,c.iddependencia ","dependencia c,dependencia_cargo dc","c.iddependencia =dc.dependencia_iddependencia  and dc.iddependencia_cargo=".$datos[0]["dependencia"],"",$conn);   
 $nueva_fecha=date_parse($datos[0]["fecha"]);

  $comp = strlen($nueva_fecha["month"]);
  if($comp==1){
  
  $nueva="0".$nueva_fecha["month"];
  }else {
  
  $nueva=$nueva_fecha["month"];
  
  }
  
  
 if($resultado[0]["iddependencia"]==4){
  $texto="DNC-".$nueva_fecha["day"].$nueva.$nueva_fecha["year"];
 } 
 if($resultado[0]["iddependencia"]==5){
   $texto="DPI-".$nueva_fecha["day"].$nueva.$nueva_fecha["year"];
 }  
 if($resultado[0]["iddependencia"]==6){
   $texto="GAF-".$nueva_fecha["day"].$nueva.$nueva_fecha["year"]; 
 }
 
 if($resultado[0]["iddependencia"]==7){
  $texto="GMC-".$nueva_fecha["day"].$nueva.$nueva_fecha["year"];
 }
 echo($texto);
}
function organizar_imagenes($idformato,$iddoc){
	global $conn;
	include_once("../librerias/funciones_generales.php");
	registrar_imagenes_documento($idformato,$iddoc,'contenido');
}
function mostrar_imagenes_escaneadas_memo($idformato)
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
function seleccionar_origen($idformato,$idcampo,$iddoc)
{global $conn;
 $actual=busca_filtro_tabla("origen,tipo_origen","ft_memorando","documento_iddocumento=$iddoc","",$conn);
 if($actual[0]["tipo_origen"]==1){//funcionario_codigo
 $ruta=busca_filtro_tabla("distinct funcionario_codigo as id,nombres,apellidos,'' nombre","buzon_entrada b,funcionario f","funcionario_codigo=destino and archivo_idarchivo='$iddoc' and b.nombre='POR_APROBAR'","",$conn);
 }
 else //rol
   $ruta=busca_filtro_tabla("distinct iddependencia_cargo as id,nombres,apellidos,concat('-',c.nombre) nombre","buzon_entrada b,funcionario f,dependencia_cargo dc,cargo c","funcionario_idfuncionario=idfuncionario and cargo_idcargo=idcargo and funcionario_codigo=destino and archivo_idarchivo='$iddoc' and dc.estado=1 and b.nombre='POR_APROBAR'","",$conn);
 echo "<td><select name='origen'>";
 for($i=0;$i<$ruta["numcampos"];$i++)
    {echo '<option value="'.$ruta[$i]["id"].'" ';
     if($ruta[$i]["id"]==$actual[0]["origen"])
       echo ' selected ';
     echo '>'.$ruta[$i]["nombres"]." ".$ruta[$i]["apellidos"]." ".$ruta[$i]["nombre"].'</option>';
    }
 echo "</select></td>";
}
//---------------------------------mostrar qr------------------------------//
function mostrar_qr_interna($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$estado_doc=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"", $conn);
	if($estado_doc[0]['estado']=='APROBADO'){	
		$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
		if($codigo_qr['numcampos']){
			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
			$img='&nbsp;<img src="http://'.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'" />';
		}else{
			generar_codigo_qr_interna($idformato,$iddoc);
			$codigo_qr=busca_filtro_tabla("","documento_verificacion","documento_iddocumento=".$iddoc,"iddocumento_verificacion DESC", $conn);
			$extension=explode(".",$codigo_qr[0]['ruta_qr']);
			$img='&nbsp;<img src="http://'.RUTA_PDF.'/'.$codigo_qr[0]['ruta_qr'].'" />';	
		}
		echo($img);
	}
}

function generar_codigo_qr_interna($idformato,$iddoc){
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
	
	$imagen=generar_qr_interna($ruta,$datos_qr);
	
	if($imagen==false){
	  alerta("Error al tratar de crear el codigo qr");
	}else{
	   $codigo_hash=obtener_codigo_hash_archivo($imagen,'crc32'); 
	  $fun_qr=usuario_actual('idfuncionario');
	  if(!$fun_qr){
	      $fun_qr=1;
	  }	   
	  $sqlqr="INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion,codigo_hash) VALUES (".$iddoc.",".$fun_qr.",".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').",'".$imagen."','vacio','".$codigo_hash."')";
	// $sqlqr="INSERT INTO documento_verificacion(documento_iddocumento,funcionario_idfuncionario,fecha,ruta_qr,verificacion,codigo_hash) VALUES (".$iddoc.",".$fun_qr.",'".date("Y-m-d H:i:s")."','".$imagen."','vacio','".$codigo_hash."')";
	 //print_r($sqlqr);die();
	  phpmkr_query($sqlqr);
	}
}

function generar_qr_interna($filename,$datos,$matrixPointSize = 2,$errorCorrectionLevel = 'Q'){
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

?>
