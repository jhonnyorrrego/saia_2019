<?php
@set_time_limit(0);
//parametros predeterminados para saia
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "formatos/librerias/encabezado_pie_pagina.php");

$marca="";

if (array_key_exists('funcionario_codigo',$_REQUEST)) {	
  $funcionario_codigo = $_REQUEST["funcionario_codigo"];
} else {
  $funcionario_codigo = usuario_actual("funcionario_codigo");    
}

if($_REQUEST["iddoc"]&&$_REQUEST["plantilla"] &&!$_REQUEST["vista"])
{if(isset($_REQUEST["destinos"]))
  $_REQUEST["destino"]=$_REQUEST["destinos"];
 $header=encabezado_pie_pagina($_REQUEST["plantilla"],$_REQUEST["iddoc"]);  
}
$marca="";   
if(isset($_REQUEST["plan_mejoramiento"]))
{$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/plan_mejoramiento/mostrar_plan_mejoramiento.php?recrear=1&iddoc=".$_REQUEST["iddoc"]."&tipo=5&idformato=1&tipo_impresion=".$_REQUEST["tipo_impresion"]."&font_size=".$_REQUEST["font_size"];
}
elseif(isset($_REQUEST["tipo_vista"]))
{$encabezado=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=18","",$conn);
$encabezado2=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=20","",$conn);
$encabezado3=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=21","",$conn);
//print_r($encabezado2);
 $html=$encabezado[0][0];
 $html2="";
 if($_REQUEST["tipo_vista"]=="nomina")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/nomina2/nomina2.php?iddoc=".$_REQUEST["iddoc"]."&idformato=69&tipo=6&idfunc=".$funcionario_codigo;   
   }
 elseif($_REQUEST["tipo_vista"]=="fondo_ahorro")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/fondo_ahorro/fondo_ahorro.php?iddoc=".$_REQUEST["iddoc"]."&idformato=97&tipo=6";
    $html=str_replace("(N&oacute;mina)","Vi&aacute;ticos (N&oacute;mina)",$html);
   }
   
 elseif($_REQUEST["tipo_vista"]=="pago_tercero")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/pagos_terceros/mostrar_pagos_terceros.php?iddoc=".$_REQUEST["iddoc"]."&idformato=86&tipo=";
    $html=$encabezado2[0][0];
    $padre=busca_filtro_tabla("iddocumento","ft_pagos_terceros p,documento d, ft_solicitud_terceros s","idft_solicitud_terceros=ft_solicitud_terceros and s.documento_iddocumento=iddocumento and idft_pagos_terceros=".$_REQUEST["iddoc"],"",$conn);
    $_REQUEST["iddoc"]=$padre[0][0];
   }
   elseif($_REQUEST["tipo_vista"]=="pago_tercero_e")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/pagos_ter_educ/mostrar_pagos_ter_educ.php?iddoc=".$_REQUEST["iddoc"]."&idformato=160&tipo=";
    $html=$encabezado2[0][0];
    $padre=busca_filtro_tabla("iddocumento","ft_pagos_ter_educ p,documento d, ft_terceros_educacion s","idft_terceros_educacion=ft_terceros_educacion and s.documento_iddocumento=iddocumento and idft_pagos_ter_educ=".$_REQUEST["iddoc"],"",$conn);
    $_REQUEST["iddoc"]=$padre[0][0];
   }
    elseif($_REQUEST["tipo_vista"]=="solicitud_pago_viaticos")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/nomina2/solicitud_pago_viaticos.php?iddoc=".$_REQUEST["iddoc"]."&idformato=69";
    $html=$encabezado2[0][0];
    $padre=busca_filtro_tabla("iddocumento","ft_pagos_ter_educ p,documento d, ft_terceros_educacion s","idft_terceros_educacion=ft_terceros_educacion and s.documento_iddocumento=iddocumento and idft_pagos_ter_educ=".$_REQUEST["iddoc"],"",$conn);
    $_REQUEST["iddoc"]=$padre[0][0];
   }
 elseif($_REQUEST["tipo_vista"]=="pago_embargos")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/pagos_embargos/mostrar_pagos_embargos.php?iddoc=".$_REQUEST["iddoc"]."&idformato=106&tipo=";
    $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
   }      
 elseif($_REQUEST["tipo_vista"]=="solicitud_pago2")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/fondo_ahorro/solicitud_pago.php?iddoc=".$_REQUEST["iddoc"]."&idformato=97&tipo=6";
    $html=str_replace("(N&oacute;mina)","Vi&aacute;ticos (N&oacute;mina)",$html);
   }    
 elseif($_REQUEST["tipo_vista"]=="viaticos")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/nomina2/viaticos.php?iddoc=".$_REQUEST["iddoc"]."&idformato=69&tipo=6&idfunc=".$funcionario_codigo;
    $html=str_replace("(N&oacute;mina)","Vi&aacute;ticos (N&oacute;mina)",$html);
   }
 elseif($_REQUEST["tipo_vista"]=="solicitud_pago")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/nomina2/solicitud_pago.php?iddoc=".$_REQUEST["iddoc"]."&idformato=69&tipo=6&idfunc=".$funcionario_codigo;  
    $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
   }
 elseif($_REQUEST["tipo_vista"]=="parafiscales")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/parafiscales_nomina/parafiscales.php?iddoc=".$_REQUEST["iddoc"]."&idformato=72&tipo=6&idfunc=".$funcionario_codigo;
    $html=str_replace("(N&oacute;mina)","Parafiscales",$html);
    $html=str_replace("Vigencia: 04-11","Vigencia: 06-11",$html);
   }
 elseif($_REQUEST["tipo_vista"]=="solicitud_parafiscales")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/parafiscales_nomina/solicitud_parafiscales.php?iddoc=".$_REQUEST["iddoc"]."&idformato=72&tipo=6&idbeneficiario=".$_REQUEST["idbeneficiario"];   
    $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
   }  
 elseif($_REQUEST["tipo_vista"]=="solicitud_pago_aporte_seguridad_social")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/aportes_seguridad_social/solicitud_pago_aporte_seguridad.php?idbeneficiario=".$_REQUEST["idbeneficiario"]."&idformato=87&tipo=6";
    $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
   }  
 elseif($_REQUEST["tipo_vista"]=="solicitud_pago_aporte_fna")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/solicitud_pago_fna/solicitud_pago_fna.php?idbeneficiario=".$_REQUEST["idbeneficiario"]."&idformato=102&tipo=6";
    $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
   }
 elseif($_REQUEST["tipo_vista"]=="resumen_nomina_pago_viaticos_cesantias")
   {$_REQUEST["URL"]="http://".RUTA_PDF."/formatos/nomina2/resumen_nomina_pago_viaticos_cesantias.php?iddoc=".$_REQUEST["iddoc"]."&idformato=78&tipo=6";
    $html=str_replace("Solicitud de Certificado de Registro Presupuestal","Resumen de n&oacute;mina pago de vi&aacute;ticos y cesant&iacute;as",$html);
    $html=str_replace("Vigencia: 04-11","Vigencia: 07-11",$html);
   }
   
	 $_REQUEST["leftmargin"]=25;
   $_REQUEST["rightmargin"]=25;
   $_REQUEST["topmargin"]=40 ;
   $_REQUEST["bottommargin"]=20 ;
   $_REQUEST["tipo"]=6; 
   $_REQUEST["headerhtml"]=crear_encabezado_pie_pagina(stripslashes($html),$_REQUEST["iddoc"],69,1);
   $_REQUEST["footerhtml"]=crear_encabezado_pie_pagina(stripslashes($html2),$_REQUEST["iddoc"],69,1);   
}elseif(isset($_REQUEST["tipo_vista1"]))
{
   
   $encabezado=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=48","",$conn); 
   $encabezado1=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=49","",$conn); 
   $encabezado2=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=51","",$conn);
   $encabezado3=busca_filtro_tabla("contenido","encabezado_formato","idencabezado_formato=21","",$conn);
   $html=$encabezado[0][0];  
   
   
  if($_REQUEST["tipo_vista1"]=="nomina_educacion"){
    $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/nomina_educacion.php?iddoc=".$_REQUEST["iddoc"]."&idformato=128&tipo=6&idfunc=".$funcionario_codigo; 
  }elseif($_REQUEST["tipo_vista1"]=="viaticos_educacion"){
    $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/viaticos.php?iddoc=".$_REQUEST["iddoc"]."&idformato=128&tipo=6&idfunc=".$funcionario_codigo; 
  }
    elseif($_REQUEST["tipo_vista1"]=="escalafon"){
    $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/escalafon.php?iddoc=".$_REQUEST["iddoc"]."&idformato=128&tipo=6&idfunc=".$funcionario_codigo; 
  }elseif($_REQUEST["tipo_vista1"]=="solicitud_pago_educacion"){
    $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/solicitud_pago.php?iddoc=".$_REQUEST["iddoc"]."&idformato=128&tipo=6&idfunc=".$funcionario_codigo; 
  }
   elseif($_REQUEST["tipo_vista1"]=="resumen_nomina"){
    $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/resumen_nomina_pago_viaticos_cesantias.php?iddoc=".$_REQUEST["iddoc"]."&idformato=128&tipo=6&idfunc=".$funcionario_codigo; 
  }elseif($_REQUEST["tipo_vista1"]=="parafiscales"){
  $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/parafiscales.php?iddoc=".$_REQUEST["iddoc"]."&idformato=133&tipo=6&idfunc=".$funcionario_codigo;
   $html=$encabezado1[0][0]; 
  }elseif($_REQUEST["tipo_vista1"]=="parafiscales_educacion"){
    $html=$encabezado1[0][0]; 
    $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/parafiscales_educacion.php?iddoc=".$_REQUEST["iddoc"]."&idformato=133&tipo=6&idfunc=".$funcionario_codigo;
    
  }
  elseif($_REQUEST["tipo_vista1"]=="solicitud_parafiscales1"){
 
  $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/solicitud_parafiscales.php?iddoc=".$_REQUEST["iddoc"]."&idformato=133&tipo=6&idbeneficiario=".$_REQUEST["idbeneficiario"];
    $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
  
  }elseif($_REQUEST["tipo_vista1"]=="solicitud_parafiscales_nuevo"){
 
  $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/solicitud_parafiscales_nuevo.php?iddoc=".$_REQUEST["iddoc"]."&idformato=133&tipo=6&idbeneficiario=".$_REQUEST["idbeneficiario"];
	  
   $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
  } elseif($_REQUEST["tipo_vista1"]=="solicitud_escalafon"){
 
  $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/solicitud_supernumericos.php?iddoc=".$_REQUEST["iddoc"]."&idformato=152&tipo=6&idbeneficiario=".$_REQUEST["idbeneficiario"];
   $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
  } elseif($_REQUEST["tipo_vista1"]=="parafiscales_escalafon"){
 
  $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/parafiscales_escalafon.php?iddoc=".$_REQUEST["iddoc"]."&idformato=152&tipo=6&idbeneficiario=".$_REQUEST["idbeneficiario"];
   $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
  }elseif($_REQUEST["tipo_vista1"]=="solicitud_supernumericos"){
 
  $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/solicitud_supernumericos1.php?iddoc=".$_REQUEST["iddoc"]."&idformato=152&tipo=6&idbeneficiario=".$_REQUEST["idbeneficiario"];
   $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
  } elseif($_REQUEST["tipo_vista1"]=="parafiscales_supernumericos"){
 
  $_REQUEST["URL"]="http://".RUTA_PDF."/archivos_nomina_educacion/parafiscales_supernumericos.php?iddoc=".$_REQUEST["iddoc"]."&idformato=152&tipo=6&idbeneficiario=".$_REQUEST["idbeneficiario"];
   $html=$encabezado2[0][0];
    $html2=$encabezado3[0][0];
  }
   $_REQUEST["leftmargin"]=25;
   $_REQUEST["rightmargin"]=25;
   $_REQUEST["topmargin"]=40 ;
   $_REQUEST["bottommargin"]=20 ;
   $_REQUEST["tipo"]=6; 
   $_REQUEST["headerhtml"]=crear_encabezado_pie_pagina(stripslashes($html),$_REQUEST["iddoc"],128,1);
   $_REQUEST["footerhtml"]=crear_encabezado_pie_pagina(stripslashes($html2),$_REQUEST["iddoc"],128,1);    

}elseif(isset($_REQUEST["entrega_documentos"]))
  {$_REQUEST["URL"]="http://".RUTA_PDF."/reportes/entrega_documentos.php?no_encabezado=1&fecha_inicial=".$_REQUEST["fecha_inicial"]."&fecha_final=".$_REQUEST["fecha_inicial"];
   $_REQUEST["orientacion"]="1";
   $_REQUEST["leftmargin"]=5;
   $_REQUEST["rightmargin"]=5;
   $_REQUEST["topmargin"]=30 ;
   $_REQUEST["bottommargin"]=10 ;
   $_REQUEST["headerhtml"]='<table width="98%" style="font-family:verdana;font-size:8pt" align="center"><tr>
  <td width="60%" rowspan="2" align="center" valign="middle">'.logo_empresa().'</td>
  <td align="center"><b>SUBGERENCIA ADMINISTRATIVA Y FINANCIERA - GESTION DOCUMENTAL</b>				
</td>
 </tr>
 <tr>
  <td align="center"><b>REGISTRO DE ENTREGA DE DOCUMENTOS<br />Pagina ##PAGE## de ##PAGES##</b>				
</td>
 </tr></table>';
  }
if(isset($_REQUEST["margenes"])&&$_REQUEST["margenes"])
{$margenes=explode(",",$_REQUEST["margenes"]);
 $header[0]["margen_izquierda"]=$margenes[0];
 $header[0]["margen_derecha"]=$margenes[1];
 $header[0]["margen_inferior"]=$margenes[3];
 $header[0]["margen_superior"]=$margenes[2];
}  
if(!isset($_REQUEST["URL"])){
    $_REQUEST["URL"]="http://".RUTA_PDF_LOCAL."/formatos/".$_REQUEST["plantilla"]."/mostrar_".$_REQUEST["plantilla"].".php?tipo=5&iddoc=".$_REQUEST["iddoc"]."&output=2&idfunc=".$funcionario_codigo;  
    if(isset($_REQUEST["font_size"])){
    	$_REQUEST["URL"].="&font_size=".$_REQUEST["font_size"];
    }
  
    
    
    if(isset($_REQUEST["destinos"]) || strtolower($_REQUEST["plantilla"])=="carta" || strtolower($_REQUEST["plantilla"])=="calidad_agua" || strtolower($_REQUEST["plantilla"])=="respuesta_calidad_aguas")
      {global $conn;
       $destinos=busca_filtro_tabla("destinos","ft_".strtolower($_REQUEST["plantilla"]),"documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);

       $lista=explode(",",$destinos[0]["destinos"]);
       if(count($lista)>1)
         {$_REQUEST["process_mode"]="batch";
         $_REQUEST["toc-location"] = "before";
         $_REQUEST["smartpagebreak"] =1;
         $_REQUEST["convert"] = "Convert File"; 
          for($i=0;$i<count($lista);$i++)
            {$_REQUEST["batch"][$i]=$_REQUEST["URL"]."&destino=".$lista[$i];
            }
         }
        else 
         {
           $_REQUEST["process_mode"]="single";
         }      
      }
//die($_REQUEST["URL"]);
    if(isset($_REQUEST["plantilla"])){
      if(isset($_REQUEST["iddoc"])){
        $borrador=busca_filtro_tabla("pdf,iddocumento,estado,plantilla,".fecha_db_obtener('fecha','Y-m-d')." as fecha,".fecha_db_obtener('fecha','Y-m')." as fecha2,numero ",DB.".documento","iddocumento=".$_REQUEST["iddoc"],"",$conn); 
        if($borrador[0]["estado"]=='ANULADO')
          $marca="ANULADO";     
        if($borrador["numcampos"] && isset($borrador[0]["estado"]) && ($borrador[0]["estado"]=='ACTIVO' || $borrador[0]["estado"]=='TRAMITE' || $borrador[0]["estado"]=='BORRADOR')){
          $marca="BORRADOR";
          $borrador[0]["nombre"]=$borrador[0]["iddocumento"]."_BORRADOR_";
          if($borrador[0]["plantilla"]!="")
            $borrador[0]["nombre"].=$borrador[0]["plantilla"]."_";
          $borrador[0]["nombre"].=str_replace("-","_",$borrador[0]["fecha"]);  
          $filename=$borrador[0]["nombre"];
        }
        else if($borrador["numcampos"] && isset($borrador[0]["estado"]) && ($borrador[0]["estado"]=='APROBADO' || $borrador[0]["estado"]=='GESTION' || $borrador[0]["estado"]=='CENTRAL' || $borrador[0]["estado"]=='HISTORICO'))
        {
          $borrador[0]["nombre"]="";
            $consulta=busca_filtro_tabla("","ft_solicitud_certificado_pro","documento_iddocumento=".$_REQUEST["iddoc"]." and estado_inactivo=1","",$conn);
          if($_REQUEST["plantilla"]=='solicitud_certificado_pro' && $consulta["numcampos"]){
          $marca="ANULADO";
          }          
          if($borrador[0]["plantilla"]!="")
            $borrador[0]["nombre"]=$borrador[0]["plantilla"]."_";
          $borrador[0]["nombre"].=$borrador[0]["numero"]."_".str_replace("-","_",$borrador[0]["fecha"]);  
          $filename=$borrador[0]["nombre"];
          //$ruta_nueva = "../".$borrador[0]["estado"]."/";
          $ruta_nueva = $ruta_db_superior.RUTA_PDFS.$borrador[0]["estado"]."/";
		  $ruta_a_guardar=RUTA_PDFS.$borrador[0]["estado"]."/";
		  
          if(!is_dir($ruta_nueva))
          	if(!mkdir($ruta_nueva,0777))          	
          	 alerta("Problemas al crear la carpeta ".$ruta_nueva." de crear PDF Por favor Comuniquese con su Administrador");
          $ruta_nueva .= $borrador[0]["fecha2"]."/"; 	 
		  $ruta_a_guardar .= $borrador[0]["fecha2"]."/";
          if(!is_dir($ruta_nueva))
          	if(!mkdir($ruta_nueva,0777))          	
          	 alerta("Problemas al crear la carpeta ".$ruta_nueva." de crear PDF Por favor Comuniquese con su Administrador");
          $ruta_nueva .= $_REQUEST["iddoc"]."/";    
		  $ruta_a_guardar .= $_REQUEST["iddoc"]."/";       	 
          if(!is_dir($ruta_nueva))
          	if(!mkdir($ruta_nueva,0777))          	
          	 alerta("Problemas al crear la carpeta ".$ruta_nueva." de crear PDF Por favor Comuniquese con su Administrador");   	 
          $ruta_nueva .= "pdf/";       
		  $ruta_a_guardar .= "pdf/";	 
		      	 
          if(!is_dir($ruta_nueva))
          	if(!mkdir($ruta_nueva,0777))          	
          	 alerta("Problemas al crear la carpeta ".$ruta_nueva." de crear PDF Por favor Comuniquese con su Administrador");
			crear_destino($ruta_nueva);
			$nomarch=$ruta_nueva.$filename.".pdf";
			$nomarch2=$ruta_a_guardar.$filename.".pdf";		
			
          if($borrador[0]["pdf"]<>"" && is_file($nomarch)&&!isset($_REQUEST["nombre_archivo"])){   // alerta("Ver PDF");
              	if(!$_REQUEST["no_redirecciona"]){
              		redirecciona($nomarch);
              		die();	
              	}             
          }else{
          	$sql="UPDATE ".DB.".documento SET pdf='".$nomarch2."' WHERE iddocumento=".$_REQUEST["iddoc"];
            phpmkr_query($sql,$conn,$funcionario_codigo);
          }
        }   
      }
////Las referencias deben ir relativas a la plantilla o donde se genere el formarto  
     
    //$header=encabezado_pie_pagina($_REQUEST["plantilla"],$_REQUEST["iddoc"]);  
    }         
}elseif($_REQUEST["URL"] && $_REQUEST["imprimir_pdf"] == 3){
	
	
	 $_REQUEST["URL"] = "http://".RUTA_PDF_LOCAL."/".str_replace("|","&", $_REQUEST["URL"])."&tipo=5&font_size=".$_REQUEST["font_size"];
	 
	 $_REQUEST["font_size"] = $_REQUEST["font_size"];	 
	
	 if(!$_REQUEST["orientacion"]){
	 	$_REQUEST["orientacion"] = 1;	
	 }
	 	 	 	   
	 if(!$_REQUEST["papel"]){
	 	$_REQUEST["papel"] = "Letter";
	 }
	 
	 if(!$_REQUEST["leftmargin"]){
	 	$_REQUEST["leftmargin"] = 5;
	 }
	 
	 if(!$_REQUEST["rightmargin"]){
	 	$_REQUEST["rightmargin"] = 5;
	 }
	 
	 if(!$_REQUEST["topmargin"]){
	 	$_REQUEST["topmargin"] = 10;
	 }
	 
	 if(!$_REQUEST["bottommargin"]){
	 	$_REQUEST["bottommargin"] = 10;
	 } 
	 
	 if(!$_REQUEST["filename"]){
	 	$filename="impresion_pdf";	
	 }else{
	 	$filename=$_REQUEST["filename"];
	 }	 	 
}else{
	$borrador=busca_filtro_tabla("pdf,iddocumento,estado,plantilla,".fecha_db_obtener('fecha','Y-m-d')." as fecha,".fecha_db_obtener('fecha','Y-m')." as fecha2,numero ",DB.".documento","iddocumento=".$_REQUEST["iddoc"],"",$conn); 
    if($borrador[0]["estado"]=='ANULADO')
      $marca="ANULADO";
	if($borrador[0]["estado"]=='ACTIVO')
      $marca="BORRADOR";
}

if(isset($_REQUEST["nombre_archivo"]))
  $filename=$ruta_db_superior.$_REQUEST["nombre_archivo"];
  
$_REQUEST["output"]="2";
//$_REQUEST["pixels"]="640";
//$_REQUEST["scalepoints"]="1" ;
$_REQUEST["renderimages"]="1" ;
//$_REQUEST["renderlinks"]="0" ;
$_REQUEST["renderfields"]="0" ;
$_REQUEST["media"]="Letter" ;
//orientacion
if(isset($_REQUEST["orientacion"])&&$_REQUEST["orientacion"]=="1")
  $_REQUEST["landscape"]=1;
$_REQUEST["cssmedia"]="screen" ;
if(isset($header)){
  $_REQUEST["leftmargin"]=$header[0]["margen_izquierda"] ;
  $_REQUEST["rightmargin"]=$header[0]["margen_derecha"];
  $_REQUEST["topmargin"]=$header[0]["margen_superior"] ;
  $_REQUEST["bottommargin"]=$header[0]["margen_inferior"] ;
  $_REQUEST["headerhtml"]=$header[0]["encabezado"];
  $_REQUEST["footerhtml"]=$header[0]["pie_pagina"];
}
$_REQUEST["encoding"]="" ;
$_REQUEST["watermarkhtml"]=$marca;
$_REQUEST["method"]="fpdf" ;
$_REQUEST["pdfversion"]="1.3" ;

$_REQUEST["scalepoints"]="1" ;
$_REQUEST["pslevel"]="3";

function encabezado_pie_pagina($plantilla,$doc){
global $conn;
$header=array();
$header=busca_filtro_tabla("margenes,nombre_tabla,idformato,encabezado,pie_pagina,orientacion","formato","nombre='".$plantilla."'","",$conn);
$mostrar=busca_filtro_tabla("encabezado",$header[0]['nombre_tabla'],"documento_iddocumento=$doc","",$conn);

if(!$mostrar[0]["encabezado"])
   {$header[0]["encabezado"]="";
    $header[0]["pie_pagina"]="";
   }
   
  $margenes=explode(",",$header[0]["margenes"]);
  $header[0]["margen_izquierda"]=$margenes[0];
  $header[0]["margen_derecha"]=$margenes[1];
  $header[0]["margen_inferior"]=$margenes[3];
  $header[0]["margen_superior"]=$margenes[2];
  
  if($header[0]["orientacion"])
    $_REQUEST["orientacion"]=1;
  
  if($header[0]["encabezado"]!=""){
    $datos=busca_filtro_tabla('contenido','encabezado_formato','idencabezado_formato='.$header[0]["encabezado"],'',$conn);
    $header[0]["encabezado"]=$datos[0][0];
  }
  if($header[0]["pie_pagina"]!=""){
    $datos=busca_filtro_tabla('contenido','encabezado_formato','idencabezado_formato='.$header[0]["pie_pagina"],'',$conn);
    $header[0]["pie_pagina"]=$datos[0][0];
  }  
  if($header[0]["margen_izquierda"]=="" || $header[0]["margen_izquierda"]==Null){
    $header[0]["margen_izquierda"]=35;
  }
  if($header[0]["margen_derecha"]=="" || $header[0]["margen_derecha"]==Null){
    $header[0]["margen_derecha"]=26;
  }
  if($header[0]["margen_inferior"]=="" || $header[0]["margen_inferior"]==Null){
    $header[0]["margen_inferior"]=30;
  }
  if($header[0]["margen_superior"]=="" || $header[0]["margen_superior"]==Null){
    $header[0]["margen_superior"]=20;
  }  
$header[0]["encabezado"]=crear_encabezado_pie_pagina($header[0]["encabezado"],$doc,$header[0]["idformato"]);
$header[0]["pie_pagina"]=crear_encabezado_pie_pagina($header[0]["pie_pagina"],$doc,$header[0]["idformato"]);
return($header);
}
?>
