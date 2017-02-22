<?php    
// Inicialiacin de las variables del calendario del planeador

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
// Inicialiaci�n de las variables del calendario del planeador
require_once($ruta_db_superior."calendario/activecalendar/source/activecalendar.php");
require_once($ruta_db_superior."calendario/activecalendar/source/activecalendarweek.php");
echo "<script type='text/javascript' src='".$ruta_db_superior."calendario/activecalendar/source/functions.js'></script>\n";
include_once($ruta_db_superior."class.funcionarios.php");
include_once($ruta_db_superior."phpmkrfn.php");


/*
 *               INICIO  CALENDARIOS  TAREAS  -   ASIGNACIONES 
 */

/*
 * Dibuja un calendario mensual con las asignaciones de un documento 
 */
function calendario_asignaciones_mes($id_documento,$anio=NULL,$mes=NULL,$script,$id_responsable=NULL,$tipo_responsable=NULL)
{ global $conn; 
    //TODO Implementar filtro por responsable func,cargo,dependencia, .....if(isset($id_responsable)&&isset($tipo_responsable))	

	//Se incia el calendario
	$flecha_atras="<img src=\"".compara_ruta_archivos("/".RUTA_SCRIPT."/calendario/activecalendar/data/img/back.png")."\" border=\"0\" alt=\"&lt;&lt;\" />"; // use png arrow back
   $flecha_adelante="<img src=\"".compara_ruta_archivos("/".RUTA_SCRIPT."/calendario/activecalendar/data/img/forward.png")."\" border=\"0\" alt=\"&gt;&gt;\" />"; // use png arrow forward
	
   $calendario= new ActiveCalendarWeek($anio,$mes);
   $calendario->setMonthNames(array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'));
   $calendario->setDayNames(array('Dom','Lun','Mar','Mie','Jue','Vie','Sab'));
   $calendario->enableYearNav($script."?id_documento=$id_documento");
   $calendario->enableMonthNav($script."?id_documento=$id_documento",$flecha_atras,$flecha_adelante); 
  
   // Obtengo el array de asignaciones para el mes actual 
   $ar_asignaciones=asignaciones_mes($id_documento,$anio,$mes,$id_responsable,$tipo_responsable); 

   $total=count($ar_asignaciones);
      for($i=0;$i<$total;$i++)  // recorre las asignaciones 
      {  
      	 $key=array_keys($ar_asignaciones[$i]);  // obtengo el key idasignacion
      	 $key=$key[0]; // solo hay una clave que es el idasignacion 
      	 $dias=$ar_asignaciones[$i][$key]; // obtengo los dias de el mes que ocupa la asignacion
      	 foreach ($dias AS $fecha)
      	 {  
      	  	
      	    $calendario->setEvent(date("Y",strtotime($fecha)),date("m",strtotime($fecha)),date("d",strtotime($fecha)),NULL,"detalleasignacion.php?key=".$key);
      	 }
      	 
      }

   ?><link rel="stylesheet" type="text/css" href="activecalendar/data/css/antique.css" /><?php
  	print $calendario->showMonth();
} // Calendario mes


function calendario_festivos($anio=NULL,$script=NULL)
{
    global $conn,$ruta_db_superior;
	// se incia el calendario
	
	if(!$anio)
     {
      $anio = date("Y");
     }
   
   $calendario= new ActiveCalendarWeek($anio,$fecha_inicial["month"]);
   $calendario->setMonthNames(array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'));
   $calendario->setDayNames(array('Dom','Lun','Mar','Mie','Jue','Vie','Sab'));
   $calendario->enableYearNav("festivos_list.php");
   $calendario->enableDayLinks($script);
// asignaciones 
 $asignaciones=busca_filtro_tabla("idasignacion,".fecha_db_obtener("fecha_inicial",'Y-m-d')." as fecha_inicial,".fecha_db_obtener("fecha_final",'Y-m-d')." as fecha_final","asignacion","asignacion.documento_iddocumento='-1'  AND ".fecha_db_obtener("fecha_inicial",'Y-m-d').">='$anio-01-01'  AND  ".fecha_db_obtener("fecha_inicial",'Y-m-d')."<='$anio-12-31'","",$conn);
 
 if($asignaciones["numcampos"])
	 {  
	  for($i=0;$i<$asignaciones["numcampos"];$i++) // Se recorren las asignaciones para el documento
	   {  		
	   	$fecha_inicial=date_parse ( $asignaciones[$i]["fecha_inicial"]);
	    $fecha_final=date_parse ( $asignaciones[$i]["fecha_final"]);
	   	    
	   /* Procesamiento de los eventos y asignacion al calendario
	    * se verifican las diversas posibilidades de rangos de fechas
	    */
	    $anioinicial=$fecha_inicial["year"];
        $mesinicial=$fecha_inicial["month"];
     	$diainicial=$fecha_inicial["day"];
    	$aniofinal=$fecha_final["year"];
     	$mesfinal=$fecha_final["month"];
     	$diafinal=$fecha_final["day"];
  //echo "$anioinicial,$mesinicial,$diainicial<br />";
     	$calendario->setEvent($anioinicial,$mesinicial,$diainicial,NULL,"festivos_func.php?key=".$asignaciones[$i]["idasignacion"]."&func=0");
     		 // $calendario->setEventContent($anioinicial,$mesinicial,$diainicial,);
 
	   } // Fin for

   }    // Fin if hay asignaciones

   ?><link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>calendario/activecalendar/data/css/default2.css" /><?php
  print $calendario->showYear(4); // tres meses por fila
} // Fin funcion calendario_festivos

function calendario_reservas($anio=NULL,$script=NULL)
{
    global $conn; 
	// se incia el calendario
	
	if(!$anio)
     {
      $an = date("Y");
     }
   else
      $an=$anio;
      
   //    
      
   $fecha_inicial=date("d-m-Y", mktime( 0, 0, 0, 1, 1,$an));
   $fecha_final=date("d-m-Y", mktime( 0, 0, 0, 13, 0,$an)); 
   $calendario= new ActiveCalendarWeek($anio,$fecha_inicial["month"]);
   $calendario->setMonthNames(array(Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre));
   $calendario->setDayNames(array(Dom,Lun,Mar,Mie,Jue,Vie,Sab));
  
   $calendario->enableYearNav($script."?solicitudes=".$_REQUEST["solicitudes"]."&posicion=".$_REQUEST["posicion"]);
   
// asignaciones 
 $asignaciones=busca_filtro_tabla("idreserva,".fecha_db_obtener("fecha_inicial",'Y-m-d')." as fecha_inicial,".fecha_db_obtener("fecha_final",'Y-m-d')." as fecha_final","reserva",fecha_db_obtener("fecha_inicial","d-m-Y").">='$fecha_inicial' and ".fecha_db_obtener("fecha_final","d-m-Y")."<='$fecha_final'","",$conn);

 if($asignaciones["numcampos"])
	 {  
	  for($i=0;$i<$asignaciones["numcampos"];$i++) // Se recorren las asignaciones para el documento
	   {  		
	   	$fecha_inicial=date_parse ( $asignaciones[$i]["fecha_inicial"]);
	    $fecha_final=date_parse ( $asignaciones[$i]["fecha_final"]);
	   	    
	   /* Procesamiento de los eventos y asignacion al calendario
	    * se verifican las diversas posibilidades de rangos de fechas
	    */
	    $anioinicial=$fecha_inicial["year"];
        $mesinicial=$fecha_inicial["month"];
     	$diainicial=$fecha_inicial["day"];
    	$aniofinal=$fecha_final["year"];
     	$mesfinal=$fecha_final["month"];
     	$diafinal=$fecha_final["day"];
      
     	//$calendario->setEvent($anioinicial,$mesinicial,$diainicial,NULL,"reservas_dia.php","mostrar_dia"); 
	  if($anioinicial==$aniofinal&&$mesinicial==$mesfinal) 
     {
     	for(;$diainicial<=$diafinal;$diainicial++)
     		{ 
     		  $calendario->setEvent($anioinicial,$mesinicial,$diainicial,NULL,"reservas_dia.php","mostrar_dia");
     		 // $calendario->setEventContent($anioinicial,$mesinicial,$diainicial,);
     		}
     }       
	 elseif ($anioinicial==$aniofinal) // la asignacion ocurre en varios meses  pero en el mismo anio
	 {  
	 for(;$mesinicial<$mesfinal;$mesinicial++) //itera en el mes
	 	{ 
	 		$ultimodia = strftime("%d",mktime(0, 0, 0, $mesinicial+1, 0, $anioinicial)); // ultimo dia del mes actual
	 		for(;$diainicial<=$ultimodia;$diainicial++)
	 		{   $calendario->setEvent($anioinicial,$mesinicial,$diainicial,NULL,"reservas_dia.php","mostrar_dia"); 		
	 			//$calendario->setEventContent($anioinicial,$mesinicial,$diainicial,"Rvdo");
	 		}
	 		$diainicial=1; // para los meses siquientes se inicia desde el primer dia
	 		
	 	}
	 	
	   for($diainicial=1;$diainicial<=$diafinal;$diainicial++) //itera los ultimos dias del mes final
	   {
		$calendario->setEvent($anioinicial,$mesinicial,$diainicial,NULL,"reservas_dia.php","mostrar_dia");	 	
	   	//$calendario->setEventContent($anioinicial,$mesinicial,$diainicial,"Rvdo");
	   }  
	 }else // a�os diferentes en la reserva (asignacion)
	 {
	 	for(;$mesinicial<13;$mesinicial++) //itera en los meses DEL PRESENTE A�O !!!!
	 	{ 
	 		$ultimodia = strftime("%d",mktime(0, 0, 0, $mesinicial+1, 0, $anioinicial)); // ultimo dia del mes actual
	 		for(;$diainicial<=$ultimodia;$diainicial++)
	 		{
	 			$calendario->setEvent($anioinicial,$mesinicial,$diainicial,NULL,"reservas_dia.php","mostrar_dia");
                //$calendario->setEventContent($anioinicial,$mesinicial,$diainicial,"Rvdo");
	 		}
	 		$diainicial=1; // para los meses siquientes se inicia desde el primer dia
	 		
	 	}
	 	
	   for($diainicial=1;$diainicial<=$diafinal;$diainicial++) //itera los ultimos dias del mes final
	   {
	 	  $calendario->setEvent($anioinicial,$mesinicial,$diainicial,NULL,"reservas_dia.php","mostrar_dia");
	 	
	   }
	 } // Fin asignacion de eventos para las fechas !!   	     
	
	   } // Fin for

   }    // Fin if hay asignaciones

  echo '<link rel="stylesheet" type="text/css" href="';
  echo compara_ruta_archivos("/".RUTA_SCRIPT.'/calendario/activecalendar/data/css/default2.css');
  echo '" />';
  print $calendario->showYear(3); // tres meses por fila
} // Fin funcion calendario_reservas


/*
 * Determina las asignaciones de un documento en un mes dado, retornando 
 * un array indexaddo con el id de la asignacion, y los dias consecutivos que ocupa en el mes  
 *     
 */
function asignaciones_mes($id_documento,$anio=NULL,$mes=NULL,$id_responsable=NULL,$tipo_responsable=NULL)
{
global $conn;
$ini_mes=date("Y-m-d H:i:s", mktime( 0, 0, 0, $mes, 1, $anio));
$fin_mes=date("Y-m-d H:i:s", mktime( 0, 0, 0, $mes+1, 1, $anio));

if(isset($id_documento))
{  
 $asignaciones=busca_filtro_tabla("idasignacion,".fecha_db_obtener("fecha_inicial",'Y-m-d')." as fecha_inicial,".fecha_db_obtener("fecha_final",'Y-m-d')." as fecha_final","asignacion","asignacion.documento_iddocumento=\"$id_documento\" AND fecha_inicial<=\"$fin_mes\" AND  fecha_final>=\"$ini_mes\"","",$conn);
 // Busco la serie del documento
 $series_doc=busca_filtro_tabla("documento.serie","documento","documento.iddocumento=\"$id_documento\"","",$conn);

  if($series_doc["numcampos"]) // Encontro la serie asociada al documento  
	{
	 $id_serie=$series_doc[0]["serie"];
	 //Busca asignaciones para la serie a la cual pertenece 
	 $asignaciones_serie=busca_filtro_tabla("idasignacion,".fecha_db_obtener("fecha_inicial",'Y-m-d')." as fecha_inicial,".fecha_db_obtener("fecha_final",'Y-m-d')." as fecha_final","asignacion","asignacion.serie_idserie=$id_serie AND fecha_inicial<=\"$fin_mes\" AND  fecha_final>=\"$ini_mes\"","",$conn);
	} 
 if ($asignaciones["numcampos"]) // unifica los resultados  
  {
  	for($i=0;$i<$asignaciones_serie["numcampos"];$i++)
  	{ 
  	  array_push($asignaciones,$asignaciones_serie[$i]); 
  	   
  	}
  	$asignaciones["numcampos"]+=$asignaciones_serie["numcampos"]; 
  }
else 
  $asignaciones=$asignaciones_serie; // no hay asignaciones por documento concatena lo que encuentra en asignaciones por serie   

  $lista_asignaciones=array();  
  
   if($asignaciones["numcampos"])
	 { 
	  for($i=0;$i<$asignaciones["numcampos"];$i++) // Se recorren las asignaciones para el documento
	   { $tmp_asignaciones=array();	 		
	        
	   	//rango de fechas de la asignacion
	  	$fecha_inicial = date("Y-m-d H:i:s",strtotime($asignaciones[$i]["fecha_inicial"]));
	    $fecha_final   = date("Y-m-d H:i:s",strtotime($asignaciones[$i]["fecha_final"]));
	   
	   	 // asignacion en el rango del mes
      if($fecha_inicial>=$ini_mes&&$fechames_final<=$fin_mes)  
          { 
            
		 }      // la asignacion inicia en un mes anterior pero termina en el mes
      elseif ($fecha_inicial<=$ini_mes&&$fecha_final<=$fin_mes)  
	    { 
	      $fecha_inicial = $ini_mes; 
	   	 		
	 	}      // la asignacion inicia en el mes  pero termina despues 
	  elseif($fecha_inicial>=$ini_mes&&$fechames_final>=$fin_mes)	
	   { $fecha_final = $fin_mes; 
	   }
	   else // la asignacion inicia antes del mes y termina despues de este (lo ocupa todo)
	   {
	   	 $fecha_inicial = $ini_mes; 
	   	 $fecha_final = $fin_mes; 
	   } 
	  	
	  $dia=$fecha_inicial; 
            while(strtotime($dia)<=strtotime($fecha_final)) 
            	{
                  array_push($tmp_asignaciones,$dia);
            	  $dia = date("Y-m-d H:i:s",strtotime( "$dia + 1 DAY")) ;
            	 
            	}  
      // crea una matriz      
     array_push($lista_asignaciones,array($asignaciones[$i]["idasignacion"]=> $tmp_asignaciones));     	 
    }  // Fin for asignaciones 
  }  // Fin if hay asignaciones   
} // Fin $id_documento  verificacion del parametro 
  return $lista_asignaciones;
} // Fin funcion asignaciones_mes


/*
 * Determina las asignaciones de un documento en particular  en una fecha determinada 
 * opcionalmente se reciben los parametros anio mes dia hora minuto segundo  
 * para especializar busqueda     
 */


/*
 *  FUNCIONES DE SELECCION DE FECHA
 */

function selector_fecha($nombre_campo,$nombre_form,$formato,$mes=NULL,$anio=NULL,$css="default.css",$ruta_relativa=NULL,$parametros_tarea=NULL,$tipo=NULL,$cuadro_texto=NULL,$asigna_tarea=NULL,$hora=NULL,$minuto=NULL,$am_pm=NULL,$retornar=0)
{
  global $ruta_db_superior;
 $texto="";   
if(!isset($anio)||!isset($mes)) //Obtiene la fecha actual por defecto si no se envia nada
 {
	$fecha=getdate(); 
	$anio=$fecha["year"];
	$mes=$fecha["month"];
 } 

 
 $param=$ruta_relativa."calendario/selec_fecha.php"; // Funcion que llamara el popup por ajax  
 $param.="?nombre_campo=".$nombre_campo."&amp;nombre_form=".$nombre_form."&amp;formato=".$formato."&amp;anio=".$anio."&amp;mes=".$mes."&amp;css=".$css;
 if(isset($parametros_tarea)) // si se envian parametros para restringir dias, verificar tareas etc a select fecha se agregan aca
 $param.="&amp;adicionales_tarea=".$parametros_tarea;
 if($hora!=NULL)
  $param.="&amp;hora=".$hora;
 if($minuto!=NULL)
  $param.="&amp;minuto=".$minuto; 
 if($am_pm!=NULL)
  $param.="&amp;am_pm=".$am_pm;  
 if(!$tipo)
  $tipo="VENTANA";
 
 if($tipo=="VENTANA") // Verifica el tipo de calendario  
   { 
    if($cuadro_texto)
     { 
       $texto.= "<input type=\"text\" id=\"".$nombre_campo."\" name=\"".$nombre_campo."\" />&nbsp;&nbsp;&nbsp;<a href=\"javascript:showcalendar('$nombre_cuadro','$nombre_form','$formato','$param',220,225)\" ><img id=\"icono_calendario\" src=\"".$ruta_db_superior."calendario/activecalendar/data/img/calendar.gif"."\" border=\"0\" alt=\"Elija Fecha\" style=\"vertical-align:top;\" /></a>";
   
     }
    else 
    { $texto.= "&nbsp;<a href=\"javascript:showcalendar('$nombre_campo','$nombre_form','$formato','$param',220,225)\" ><img id=\"icono_calendario\" src=\"".$ruta_db_superior."calendario/activecalendar/data/img/calendar.gif"."\" border=\"0\" alt=\"Elija Fecha\" style=\"vertical-align:top;\" /></a>";
    }    
   $texto.= $asginar_tarea;
  //se quita el calendario de asignacion de tareas 2012-10-19 agallego
  /* if($asigna_tarea) // Se imprime el control de asignacion de tareas
     { 
      $param_asig=$ruta_db_superior."asignaciones/asignacionadd.php?popup=1&nom_form=".$nombre_form."&nom_campo="."asig_".$nombre_campo; 
       if($cuadro_texto)
        $texto.= "<br /> <input type=\"text\" id=\""."asig_".$nombre_campo."\" name=\""."asig_".$nombre_campo."\" />&nbsp;&nbsp;&nbsp;";     
      
      $texto.= "&nbsp;&nbsp;&nbsp; <a href=\"javascript:showasignatarea('$nombre_cuadro','$nombre_form','$formato','$param_asig',500,500)\" >";
      $texto.= "<img src=\"".$ruta_db_superior."/calendario/activecalendar/data/img/tareas.png"."\" border=\"0\" alt=\"Asignacion\" /></a>";
     } */ 
    
   } 
    
 elseif($tipo=="POPUP") // Tipo  popup .. calendario anterior modificado
  { 
     $texto.= "<script src=\"".compara_ruta_archivos("/".RUTA_SCRIPT."/popcalendar.js")."\" type=\"text/javascript\" language=\"javascript\"></script>";
  	 $texto.=  "<input type=\"text\" id=\"".$nombre_campo."\" name=\"".$nombre_campo."\" />&nbsp;&nbsp;&nbsp;<a href=\"javascript:popUpCalendar(this, this.form.fecha_inicial,'dd/mm/yyyy');\" ><img src=\"".compara_ruta_archivos("/".RUTA_SCRIPT."/calendario/activecalendar/data/img/calendar.gif")."\" border=\"0\" alt=\"Elija Fecha\" /></a>";
  }
 if($retornar)
   return($texto);
 else
   echo $texto;  																														 							
}
/*
 Esta Funcion verifica los dias habiles que se interpongan en un periodo 

*/

function dias_habiles($dias,$formato=NULL,$fecha_inicial=NULL){
	global $conn; 
   if(!$formato)
     $formato="d-m-Y"; 
   $formato_bd= "dd-mm-YYYY"; // Formato validor para el motor y DEBE SER COMPATIBLE CON $formato
   if(!$fecha_inicial)
     $fecha_inicial =date($formato);

   for($i=0;$i<$dias;$i++){			
			$ar_fechaini=date_parse($fecha_inicial);
		  $anioinicial=$ar_fechaini["year"];
		  $mesinicial=$ar_fechaini["month"];
		  $diainicial=$ar_fechaini["day"];
		 	$fecha_inicial=date($formato, mktime( 0, 0, 0,$mesinicial, $diainicial + 1,$anioinicial));
		
			$asignacion=busca_filtro_tabla("","asignacion a","a.documento_iddocumento=-1 and ".fecha_db_obtener('a.fecha_inicial',$formato)."<='".$fecha_inicial."' and ".fecha_db_obtener('a.fecha_final',$formato).">'".$fecha_inicial."'","",$conn);
			
			if($asignacion["numcampos"])$dias++;
	 }
	 return($fecha_inicial);
}
?>