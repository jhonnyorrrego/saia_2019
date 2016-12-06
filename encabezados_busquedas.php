<?php
//include_once("../db.php");
if(!isset($_SESSION))
  session_start();
$ewCurSec = 0; // Initialise
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
function encabezado($tabla,$funciones,$llave,$resultado,$registros)
{ global $conn;
$enlace="";
$imagen = "";
$enlaces_adicionales="";
$cambio_password = "";
$password = busca_filtro_tabla("valor","configuracion","nombre='cambio_password'","",$conn);  
if($password["numcampos"] && $password[0]["valor"]==1)
 $cambio_password = "&nbsp;&nbsp;<a href='../changepwd.php'>Cambiar contrase&ntilde;a</a>";
$lista = explode(",", $tabla); 
  if($lista[0]<>"")
    {$archivo=$lista[0];
     $pagina=$lista[0]."list.php";
     $adicionar=$lista[0]."add.php";
    }
  else
    {echo 'No se pudo crear el encabezado. Tabla desconocida.';
    }  
$sExport = @$_REQUEST["export"]; // Load Export Request
if ($sExport == "excel") 
  {         
  	header('Content-Type: application/vnd.ms-excel');
  	header("Content-Disposition: attachment; filename=".$archivo.".xls");
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");     
  }
if ($sExport == "word") 
  {
  	header('Content-Type: application/vnd.ms-word');
  	header("Content-Disposition: attachment; filename=".$archivo.".doc");
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  }
if ($sExport == "xml") 
  {
  	header('Content-Type: text/xml');
  	header("Content-Disposition: attachment; filename=".$archivo.".html");
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  }
if ($sExport == "csv") 
  {
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename='.$archivo.'.csv');
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  }

if ($sExport == "html") 
  {
  	// Printer Friendly
  }    if($lista[0]=="funcionario")   //nombre tabla principal
    { $titulo="FUNCIONARIOS";
    }
    else if($lista[0]=="diagram" && strpos($_SERVER["HTTP_REFERER"],"verificar_flujoslist")){
      // /*1,Ejecutado;2,Cerrado,3,Cancelado;4,Pendiente;5,Atrasado;6,Iniciado*/
      $enlaces='<link rel="stylesheet" type="text/css" href="../css/estilo_flujos.css"/></style>'."<table border='0' width='70%' style='border-collapse:collapse; float:left; '><tr><td style='vertical-align:top;'>&nbsp;<a href='../verificar_flujoslist.php?administrar_mis_flujo=1' target='centro'>Mostrar Todos Mis Flujos</a><br>&nbsp;<a href='../verificar_flujoslist.php?administrar_flujo=1' target='centro'>Mostrar Todos </a><br>&nbsp;<a href='../linea_tiempo.php' target='centro'>Pendientes linea tiempo</a></td>";
      $enlaces.="<td style='vertical-align:top;'>&nbsp;<a href='../verificar_flujoslist.php?estado_flujo=1,2' target='centro'>Flujos Terminados</a><div class='paso1' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td>";
      //$enlaces.="<td class='paso2'><a href='../verificar_flujoslist.php?estado_flujo=2' target='centro'>Flujos Cerrados</a>&nbsp;</td>";
      $enlaces.="<td style='vertical-align:top;'>&nbsp;<a href='../verificar_flujoslist.php?estado_flujo=4' target='centro'>Flujos Pendientes</a><div class='paso4' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div><br><br>&nbsp;<a href='../verificar_flujoslist.php?estado_flujo=4&verificar_asignacion=1' target='centro'>Mis Flujos pendientes</a><div class='paso4' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td>";
      $enlaces.="<td style='vertical-align:top;'>&nbsp;<a href='../verificar_flujoslist.php?estado_flujo=5' target='centro'>Flujos Atrasados</a>&nbsp;<div class='paso5' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div><br><br>&nbsp;<a href='../verificar_flujoslist.php?estado_flujo=3' target='centro'>Flujos Cancelados</a><div class='paso3' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div><br><br>&nbsp;<a href='../verificar_flujoslist.php?estado_flujo=7' target='centro'>Flujos Con devoluciones</a><div class='paso7' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td>";
      //$enlaces.="<td class='paso3'></td>";
      //$enlaces.="<td class='paso6'><a href='../verificar_flujoslist.php?estado_flujo=6' target='centro'>Flujos Iniciados</a>&nbsp;</td>";
      //$enlaces.="<td class='paso7'></td>";
      $enlaces.="</tr></table><br><br><br>";
      $sin_busqueda=1;
      $sin_adicionar=1;
      $sin_exportar=1;
      $sin_mostrar_todos=1; 
    //print_r($_REQUEST);
    }
    else if($lista[0]=="ft_hallazgo")
    {$titulo="LISTADO DE HALLAZGOS"; 
     $imagen="buscar_general.png";
      $enlaces="<table border='1' width='100%' style='border-collapse:collapse;'><tr><td>".agrega_boton('texto','','../planes_mejoramiento.php?tipo_plan=1','centro','Planes Institucionales','1','planes_institucionales',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../planes_mejoramiento.php?tipo_plan=2','centro','Planes de Proceso','1','planes_funcionales',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../planes_mejoramiento.php?tipo_plan=3','centro','Planes Individuales','1','planes_individuales',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../listado_hallazgos.php?tipo=pendiente','centro','Mis Hallazgos Pendientes','1','mis_hallazgos_pendientes',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../listado_hallazgos.php?tipo=terminados','centro','Mis Hallazgos Terminados','1','mis_hallazgos_terminados',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../listado_hallazgos.php?tipo=planes_individuales','centro','Mis Planes de Mejoramiento','1','mis_hallazgos_terminados',1)."&nbsp;</td>";
     $enlaces.="</tr></table>";
     $nueva_b="";
    }
    else if($lista[0]=="ft_plan_mejoramiento")
    {$titulo="LISTADO DE PLANES DE MEJORAMIENTO";
     $imagen="buscar_general.png";
     $enlaces="<table border='1' width='100%' style='border-collapse:collapse;'><tr><td>".agrega_boton('texto','','../planes_mejoramiento.php?tipo_plan=1','centro','Planes Institucionales','1','planes_institucionales',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../planes_mejoramiento.php?tipo_plan=2','centro','Planes de Proceso','1','planes_funcionales',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../planes_mejoramiento.php?tipo_plan=3','centro','Planes Individuales','1','planes_individuales',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../listado_hallazgos.php?tipo=pendiente','centro','Mis Hallazgos Pendientes','1','mis_hallazgos_pendientes',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../listado_hallazgos.php?tipo=terminados','centro','Mis Hallazgos Terminados','1','mis_hallazgos_terminados',1)."&nbsp;</td>";
     $enlaces.="<td>".agrega_boton('texto','','../listado_hallazgos.php?tipo=planes_individuales','centro','Mis Planes de Mejoramiento','1','mis_hallazgos_terminados',1)."&nbsp;</td>";
     $enlaces.="</tr></table><br /><br />";
     $nueva_b="plan_mejoramiento";
    }
    else if($lista[0]=="ft_solicitud_mantenimiento")
    { $titulo="LISTADO DE SOLICITUDES DE ATENCI&Oacute;N";
      $imagen="buscar_general.png";

      $enlaces="<br />".agrega_boton('texto','','../solicitudes_mantenimiento.php?filtro=sin_asignar&categoria='.$_REQUEST["categoria"],'centro','Sin_asignar','1','solicitudes_mto_no_asignadas',1)."&nbsp;".agrega_boton('texto','','../solicitudes_mantenimiento.php?filtro=asignadas&categoria='.$_REQUEST["categoria"],'centro','Asignadas','1','solicitudes_mto_asignadas',1)."&nbsp;".agrega_boton('texto','','../solicitudes_mantenimiento.php?categoria='.$_REQUEST["categoria"],'centro','Todas','1','solicitudes_mto_todas',1)."&nbsp;".agrega_boton('texto','','../solicitudes_mantenimiento.php?filtro=propios&estado=pendientes&categoria='.$_REQUEST["categoria"],'centro','Propias Pendientes','1','solicitudes_mto_propias',1)."&nbsp;".agrega_boton('texto','','../solicitudes_mantenimiento.php?filtro=propios&estado=proceso&categoria='.$_REQUEST["categoria"],'centro','Propias Proceso','1','solicitudes_mto_propias',1);
      $nueva_b="solicitud_mantenimiento";
      //echo "<br /><br /><br />".$resultado;

    }
    else if($lista[0]=="cargo")
    {
      $titulo="CARGOS";
    }
    else if($lista[0]=="ft_recibo_caja_menor")
    {$sin_adicionar=1;
     $nueva_b=1;
     $enlaces='<br /><a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 700, height:250,preserveContent:false } )" href="../formatos/recibo_caja_menor/filtrar_listado.php?tipo='.$_REQUEST["tipo"].'">Filtrar por n&uacute;mero</a><br /><br />';
	   $imagen="default.gif";
	   switch($_REQUEST["tipo"])
	     {case "privado": $tipo="PRIVADOS"; break;
	      case "publico": $tipo="P&Uacute;BLICOS"; break;
	      case "exp1": $tipo="EXP P&Uacute;BLICOS"; break;
        case "exp2": $tipo="EXP PRIVADOS"; break; 
        default: $tipo="TODOS";break;
       }
     $titulo="RECIBOS DE CAJA MENOR ($tipo)";
    }
		else if($lista[0]=="ft_radicacion_entrada"){
			$imagen="reportes.png";
			$titulo="Reporte de radiaciones de entrada-David";
			$nueva_b='1';
			//$enlaces='<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 400, height:250,preserveContent:false } )" href="../reportes/filtrar_reporte_documentos.php" style="font-size:8pt;color:blue">Filtrar</a>';
		}
		else if($lista[0]=="almacenamiento"){
			$sin_adicionar=1;
      $sin_busqueda=1;
      $enlaces = '<a class="highslide" style="font-size:8pt" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 400, height:400,preserveContent:false } )" href="../pantallas/almacenamiento/filtrar_almacenamiento.php">Filtrar</a>';
      $titulo = "";
	  $sin_exportar=1;
	  //$sin_mostrar_todos=1;
		}
    else if($lista[0]=="busquedas")
    {
      $titulo="BUSQUEDAS/LISTADOS";
      $adicionar="busquedaadd.php?accion=adicionar";
      $enlaces="   <a href='../funciones_busquedasadd.php?accion=adicionar' target='centro'>Adicionar Funcion</a>";
    }
    else if($lista[0]=="modulo")
    {
      $titulo="MODULOS";
      $adicionar="moduloadd.php?accion=adicionar";
    }
    else if($lista[0]=="dependencia_cargo")
    {
      $titulo="ROL DEL FUNCIONARIO";
    }
   else if($lista[0]=="ejecutor")
    {
      $titulo="EJECUTOR REMITENTE";
    }
   else if($lista[0]=="configuracion")
    {
      $titulo="CONFIGURACI&Oacute;N DEL SISTEMA";
      if(usuario_actual("login")=="cerok")
         $enlaces_adicionales="<br /><br /><br /><a target='_blank' href='../tarea_limpiar_instalacion.php'>Limpiar base de datos y carpetas</a>";
    }
   else if($lista[0]=="permiso_perfil")
    {
      $titulo="PERMISOS DE ACCESO";
      $imagen="permiso.png";
      //$adicionar="permiso_perfiladd.php?pantalla=listado";
      $enlaces_adicionales="<br /><br /><br /><a href='../busqueda_documentos.php?tipo_b=permisos_doc'>Permisos Documento</a>";
    } 
   else if($lista[0]=="evento")
    {
      $titulo="HISTORIAL";
      //echo $resultado;
    }
   else if(@$lista[0]=="tarea"){
    $titulo="ADICIONAR TAREAS";
    $adicionar="asignaciones/tareaadd.php";
    $imagen="asignar_tareas.png";
   } 
   else if(@$lista[0]=="documento")
    {if(@$lista[1]=="ft_hoja_vida")
        {$titulo="LISTADO DE HOJAS DE VIDA ";
         $nueva_b = "todos";

         switch(@$_REQUEST["estado"])
          {case 'activas':
              $titulo.="ACTIVAS"; 
              $imagen="../hoja_vida/hv_activos.png";
              break;
           case 'retirado':
              $titulo.="RETIRADOS"; 
              $imagen="../hoja_vida/hv_retirados.png";
              break;
           case 'pensionado':
              $titulo.="PENSIONADOS"; 
              $imagen="../hoja_vida/hv_pensionados.png";
              break;              
           default:
              $imagen="../hoja_vida/listar.png";
              break;       
          }
        }
     elseif(@$lista[1]=="ft_estructura_hoja_vida")
        {$titulo="ESTRUCTURA DE HOJAS DE VIDA ";
         $imagen="../hoja_vida/listar_estructura.png";
         $nueva_b = "todos";
        }
     elseif(isset($_REQUEST["estado"]))
        {//echo $_REQUEST["estado"];
         if($_REQUEST["estado"]=="GESTION")
            {$titulo="LISTADO DE DOCUMENTOS EN GESTI&Oacute;N";
             $nueva_b = "gestion";
            }
         else if($_REQUEST["estado"]=="CENTRAL")
            {$titulo="LISTADO DE DOCUMENTOS EN ARCHIVO CENTRAL";
             $nueva_b = "central";
            }
         else if($_REQUEST["estado"]=="HISTORICO")
            {$titulo="LISTADO DE DOCUMENTOS EN ARCHIVO HIST&Oacute;RICO";
             $nueva_b = "historico";
            }
         else if($_REQUEST["estado"]=="INICIADO")
            {$titulo="LISTADO DE DOCUMENTOS PENDIENTES";             
             $nueva_b = "rad_pendientes";
            }
        else if($_REQUEST["estado"]=="APROBADO")
            {$titulo="LISTADO DE DOCUMENTOS DE SALIDA";
             $nueva_b = "ejecutados";
             $imagen="documentos.png";
             $enlace='&nbsp;&nbsp;<a href="../impresion_despacho.php">Reporte de Despacho</a>&nbsp;&nbsp;&nbsp;<a href="../graficos/listado_graficos.php?lreportes=3">Documentos despachados</a>&nbsp;&nbsp;&nbsp;';                          
            }       
         else if($_REQUEST["estado"]=="ACTIVO")
            {$titulo="LISTADO DE DOCUMENTOS EN PROCESO";
             $nueva_b="rad_proceso";
             $imagen="en_proceso.png";
            } 
         else
            {$titulo="";
            }             
        }
     else
        {$titulo="LISTADO GENERAL";
         $imagen="buscar_general.png"; 
         $avanzada="buscador_general.php";
         $nueva_b="todos";
        }      
    } 
  if(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="anulaciones_pendientes"){
     $titulo="SOLICITUDES DE ANULACION PENDIENTES";
     $imagen="documentos.png";
     $enlace='&nbsp;&nbsp;<a href="../solicitar_anulacion.php?accion=listado_procesados">Solicitudes Procesadas</a>&nbsp;&nbsp;&nbsp;';
  }
  if(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="anulaciones_procesadas"){
     $titulo="SOLICITUDES DE ANULACION PROCESADAS";
     $imagen="documentos.png";
     $enlace='&nbsp;&nbsp;<a href="../solicitar_anulacion.php?accion=listado_pendientes">Solicitudes Pendientes</a>&nbsp;&nbsp;&nbsp;';
  }
  if(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="ejecutados"){
     $titulo="LISTADO DE DOCUMENTOS DE SALIDA";
     $nueva_b = "ejecutados";
     $imagen="documentos.png";
     $enlace='&nbsp;&nbsp;<a href="../impresion_despacho.php">Reporte de Despacho</a>&nbsp;&nbsp;&nbsp;<a href="../graficos/listado_graficos.php?lreportes=3">Documentos despachados</a>&nbsp;&nbsp;&nbsp;';
   //   echo "entra aqui!!!!!!!!!!!!!!!";
  }
  elseif(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="no_transferidos")
     {$titulo="LISTADO DE DOCUMENTOS POR TRANSFERIR";
      $nueva_b = "no_transferidos";
     }   
  elseif(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="pendientes")
     {$titulo="LISTADO DE DOCUMENTOS PENDIENTES";
      if(isset($_REQUEST["fun_permiso"]) && $_REQUEST["fun_permiso"]!="")
      { $nom = busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$_REQUEST["fun_permiso"],"",$conn);
        $titulo.=" DEL FUNCIONARIO ".$nom[0]["nombres"]." ".$nom[0]["apellidos"]; 
      }
      include_once("permiso_documentos.php");
      $nueva_b = "pendientes";
     }   
  elseif(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="proceso")
     {$titulo="LISTADO DE DOCUMENTOS EN PROCESO";
      $nueva_b = "proceso";
     }
  elseif(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="doc_plantillas")
   {  $titulo="LISTADO DE DOCUMENTOS CON PLANTILLA".strtoupper(@$_REQUEST["plantilla_ppal"]);
      if(isset($_REQUEST["list_plantillas"])) 
      { $lista_plantillas = explode("#",$_REQUEST["list_plantillas"]);
        $enlaces_adicionales="<br /><br />";
        $enlaces_adicionales.="<form name='general'><select name='plantilla'>";       
        for($i=0; $i<count($lista_plantillas); $i++)
        {
          $enlaces_adicionales.= '<option value="'.$lista_plantillas[$i].'"';          
          if(strtoupper($lista_plantillas[$i])==strtoupper($_REQUEST["plantilla_ppal"]))
            $enlaces_adicionales.= ' selected';
          $enlaces_adicionales.= '>'.$lista_plantillas[$i].'</option>';
        }
        $enlaces_adicionales.='</select><input type=button value="Buscar" onclick="window.location='."'../documentolistplantillas.php?plantilla_ppal='+general.plantilla.value".';"></form>';
        $enlaces_adicionales.= '<a href="../documentolist_todo.php">Volver</a>'.$cambio_password;     
      }        
   }               
      
 $tablas=implode(",",$lista);
   
// Export Data only
if (($sExport == "xml") || ($sExport == "csv")) 
  {
  	ExportData($sExport, $sSql);
   exit;
  }

if ($sExport == "") 
  {
  
   echo '<script type="text/javascript" src="../ew.js"></script>
         <script type="text/javascript"><!--
         EW_dateSep = "/"; // set date separator
         -->	
         </script>';
  // alerta($_SESSION["punto_retorno"]);
   if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="INICIADO")
      $url = "'#' onclick='window.history.go(-3)'"; 
   else
     $url = "'#' onclick='window.history.go(-2)'";
   if(!strpos($_SERVER["HTTP_REFERER"],'buscador/index.php'))
     $url = "'#' onclick='window.history.go(-3)'";  
   elseif(strpos($_SESSION["punto_retorno"],"list.php?cmd") || strpos($_SESSION["punto_retorno"],"documentos_especiales"))
     $url = $_SESSION["punto_retorno"];
   else
     $url = "'#' onclick='window.history.go(-2)'";
     
   //echo '<div class="phpmaker" style="position:absolute; top:0px; left:20px; width:300px;"><span class="phpmaker" align="left">USUARIO:&nbsp;&nbsp;<b>'.usuario_actual("nombres")." ".usuario_actual("apellidos").'</div>';
   //echo '<div  class="phpmaker" style="position:absolute; top:0px; right:17px; width:200px;"><span class="phpmaker" align="right"><a href='.$url.'>Volver</a>&nbsp;&nbsp;&nbsp;<a href="../mis_datos_cuenta.php" target="centro">Email</a>'.$cambio_password.'</span></div>';
  }
if ($sExport == "")
{
 $log = "";
 
 if($lista[0]=="evento")
    {
      $imagen = 'log.png';
      $log = 'LOG';
    }
 
 if(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="pendientes")      
    $imagen = 'pendiente_usuario.png';
 else if(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="proceso")      
    $imagen = 'proceso_usuario.png';  
 else if(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="no_transferidos")      
    $imagen = 'sin_transferir.png';  
 else if(isset($_REQUEST["pantalla"]) && $_REQUEST["pantalla"]=="ejecutados")      
    $imagen = 'salidaslist.png';      
 else if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="INICIADO")      
    $imagen = '../general/pendiente.png';
 else if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="APROBADO")      
    $imagen = 'documentos.png';
 else if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="GESTION")
    $imagen = 'gestion.png';
 else if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="CENTRAL")      
    $imagen = 'central.png';
 else if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="HISTORICO")
    $imagen = 'historico.png';
 else if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="ACTIVO")      
    $imagen = 'en_proceso.png';
 else if($imagen=="")
    $imagen = $lista[0].'.png';   
 
 if(isset($_REQUEST["adicionales"]))
 { 
   $adicionales=$_REQUEST["adicionales"];
  }
 else
    $adicionales="";
echo '<div style="position:absolute; top:15px; left:10px; width:600px;"><span class="internos">
      <img class="imagen_internos" src="../botones/principal/'.@$imagen.'" border="0" width="50px" height="50px">&nbsp;&nbsp;'.@$titulo;
echo $enlaces_adicionales."</div>";
}

if ($sExport == "" && $registros>0 && @$sin_exportar=="") 
  {?>
  <form name="exportar" id="exportar" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
     <input type="hidden" name="busqueda" value="busqueda">
      <input type="hidden" name="func_busqueda" value="<?php echo $funciones; ?>">
      <input type="hidden" name="llave" value="<?php echo $llave; ?>">
      <input type="hidden" name="registros" value="1000">
      <input type="hidden" name="tablas" value="tablas">
      <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
      <input type="hidden" name="sql" value="<?php echo $resultado;?>"> 
      <input type="hidden" name="export" id="export" value="">  
</form> 
<?php
   echo '<table align=right><tr><td><a style="cursor:pointer;" onclick="document.getElementById(\'export\').value=\'excel\';exportar.submit();"><img src="../enlaces/excel.gif" border="0" ALT="Exportar a Excel"></a>
    &nbsp;&nbsp;</td><td><a style="cursor:pointer" onclick="document.getElementById(\'export\').value=\'word\';exportar.submit();"><img src="../enlaces/word.gif" border="0" ALT="Exportar a Word">
    </a></td></tr></table>';
  }
echo '</span></p>';
//<input type=hidden name='func_busqueda' value='' id='funciones'>
if ($sExport == "") 
  {if(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="INICIADO")
      $estado="&estado=INICIADO";
   elseif(isset($_REQUEST["estado"]) && $_REQUEST["estado"]=="APROBADO")
      $estado="&estado=APROBADO";   
   else
      $estado="";
      
   //echo "<br /><br /><br />".$_REQUEST["estado"]."estado $estado";    
   if(isset($_REQUEST["ver"]))
      $ver="ver=".$_REQUEST["ver"];
   else
      $ver="";      
  if(isset($_REQUEST["llave"]))
      $llave=$_REQUEST["llave"];
   else
      $llave="";      
   echo '<div style="left:300px; top:15px;"><form action="'.$_SERVER['PHP_SELF'].'">
          <table border="0" cellspacing="0" cellpadding="0">
          	<tr>
          		<td><span class="phpmaker">';
   if(isset($_REQUEST["busca_ejecutor"]))
     {echo '<a href="../'.$avanzada.'">Buscar por Ejecutor</a>&nbsp;&nbsp;&nbsp;';
     }
       	
  if($lista[0]=="evento")
      {echo '<div style="position:absolute; left:300px; top:52px;"><a href="../eventolist.php?archivo=backups/log_2007-04-01.txt"><img src="../botones/configuracion/descargar_log.png" border="0" alt="Descargar archivo log &uacute;ltimo mes"> </a>DESCARGAR</div>';
      }
   
   echo '</span></td>          		
          	</tr>          	
          	</table>
          </form></div">';

      ?>
      <form name="bavanzada" id="bavanzada" action="<?php echo $_SERVER['PHP_SELF'];?>"" method="POST">
      <input type="hidden" name="tabla" value="<?php echo $tabla;?>">
      <input type="hidden" name="llave" value="<?php echo $llave;?>">
      <input type="hidden" name="adicionales" value="<?php echo $adicionales;?>">
      <input type="hidden" name="ver" value="<?php echo $ver;?>">
      <?php if($estado<>"") { ?>
       <input type="hidden" name="estado" value="<?php echo $estado;?>">
      <?php } ?>
      <?php if(@$_REQUEST["pantalla"]<>"") { ?>
       <input type="hidden" name="pantalla" value="<?php echo $_REQUEST["pantalla"];?>">
      <?php } ?>
      <input type="hidden" name="func_busqueda" value="<?php echo $funciones;?>">
      <input type="hidden" name="registros" value="1000">
      <input type="hidden" name="formu" value="<?php echo $tablas;?>">
      <input type="hidden" name="tipo_b" value="busqueda">
      <?php
       if(isset($_REQUEST["adicionales"]) && $_REQUEST["adicionales"]<>""){
         $adic=explode(";",str_replace("=",",",$_REQUEST["adicionales"]));
          foreach($adic as $variable)
           {$variable=explode(",",$variable);
            echo "<input type=\"hidden\" name=\"".$variable[0]."\" value=\"$variable[1]\">"; 
           }
        }

      ?>
      
</form> 
               		
      <form name="btodos" id="btodos" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <input type="hidden" name="busqueda" value="busqueda">
      <input type="hidden" name="func_busqueda" value="<?php echo $funciones; ?>">
      <input type="hidden" name="llave" value="<?php echo $llave; ?>">
      <?php if(isset($_REQUEST["estado"])&&$_REQUEST["estado"]){ ?>
      <input type="hidden" name="estado" value="<?php echo $_REQUEST["estado"]; ?>">
      <?php } ?>
      <?php if(isset($_REQUEST["tipo"])&&$_REQUEST["tipo"]){ ?>
      <input type="hidden" name="tipo" value="<?php echo $_REQUEST["tipo"]; ?>">
      <?php } ?>
      <input type="hidden" name="registros" value="<?php echo $registros; ?>">
      <input type="hidden" name="tablas" value="tablas">
      <input type="hidden" name="tabla" value="<?php echo $tabla; ?>">
      <input type="hidden" name="sql" value="<?php echo rawurlencode($resultado);?>">
      <div style="position:absolute; top:65px; left:10px; width:100%;">    
      <span class="phpmaker">
      <?php 

        if(@$nueva_b!=""){
          //echo "<a href='../documento.buscar.php'>B&uacute;squeda Avanzada</a>";
        }else if(@$sin_busqueda=="")
         {  
       ?>
      <A href="javascript:submit_bavanzada()">B&uacute;squeda Avanzada</A>      
      <?php
         }
      if($_REQUEST["num_reg"]>0  && @$sin_mostrar_todos=="")
       {
      ?> 
      &nbsp;&nbsp;&nbsp;
      <A href="javascript:submit_btodos()">Mostrar Todos</A>
      <?php
       }
     
      echo($enlace); 
      if($lista[0]=="expediente")
        echo "&nbsp;&nbsp;<a href='../busqueda_documentos.php?pagina_expediente=1&tipo_b=todos'>Buscar Documentos</a>";
     
     echo "</div><br /><br /><br />";
     
      //echo $lista[0];
      if(@$enlaces<>"")
        echo $enlaces;  
     /* if(isset($_REQUEST['avanzada']))
        {echo '<br /><br />Serie:<select name="serie">
               <option value="0">Seleccionar...</option>';
         $series=busca_filtro_tabla("nombre,idserie","serie","","nombre",$conn);
         for($i=0;$i<$series["numcampos"];$i++)
             echo '<option value="'.$series[$i]["idserie"].'">'.$series[$i]["nombre"].'</option>';
         echo '</select>
               <input type=button value="Buscar" onclick="window.location='."'../".$_REQUEST['avanzada'].".php?serie='+btodos.serie.value".';">';
                echo '&nbsp;&nbsp;Plantillas:<select name="plantilla">
               <option value="0">Seleccionar...</option>';
         $formato=busca_filtro_tabla("nombre,etiqueta","formato","mostrar=1","etiqueta",$conn);         
         for($i=0;$i<$formato["numcampos"];$i++)
             echo '<option value="'.$formato[$i]["nombre"].'">'.$formato[$i]["etiqueta"].'</option>';
         echo '</select>         
      <input type=button value="Buscar" onclick="window.location='."'../documentolistplantillas.php?plantilla_ppal='+btodos.plantilla.value".';">';
        }*/
      ?>
       </span></form>
       <SCRIPT language="JavaScript">
       <!--
      function submit_bavanzada()
      {
        document.bavanzada.submit();
      }
      function submit_btodos()
      {
        document.btodos.submit();
      }
      -->
      </SCRIPT>
      <?php
  }
if ($sExport == "" && $tabla<>"evento" && $lista[0]<>"ft_solicitud_mantenimiento"&& $lista[0]<>"ft_plan_mejoramiento"&& $lista[0]<>"documento" && $lista[0]<>"ft_hallazgo" && $lista[0]<>"ejecutor" && $lista[0]<>"ft_radicacion_entrada" && @$sin_adicionar=="")  // style="border:1px solid;" 
  {echo '<div><table border="0" cellspacing="0" cellpadding="0"> 
  	     <tr>
  		   <td><span class="phpmaker"><a href="../'.$adicionar.'">Adicionar</a></span></td>
        	</tr>
        </table>
        </div>';
  }
          

if(isset($_REQUEST["vinculos"])) // vinculos adicionales para  el encabezado 
 {  // -> etiqueta,ruta
   $vinculos=explode(";",$_REQUEST["vinculos"]);
 
  echo '<div style="border:1px solid;"><table border="0" cellspacing="6" cellpadding="0"><tr>'; 
   foreach($vinculos AS $enlace )
   {
   	$dat=explode(',',$enlace);  
   	echo '<td><span class="phpmaker"><a href="../'.$dat[1].'">'.$dat[0].'</a></span></td>';
   }
  echo '</tr></table></div>' ;   	
 } 

} 
if(@$_REQUEST["export"]=="" || !isset($_REQUEST["export"]))
{
	$idbusqueda=explode(",",$_REQUEST["func_busqueda"]);
	$busqueda=busca_filtro_tabla("","funciones_busqueda A,busquedas B","A.busquedas_idbusqueda=B.idbusquedas AND A.idfunciones_busqueda =".$idbusqueda[0],"",$conn);
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>asset/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>asset/js/main.js"></script>
<script type="text/javascript">
$(document).ready(function  () {
	top.setTitulo("<?php echo($busqueda[0]["etiqueta"]);?>");  
});
</script>
<?php
}
?>