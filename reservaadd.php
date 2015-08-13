<?php 
/*
<Clase>
<Nombre>reservaadd
<Parametros>
<Responsabilidades>Este archivo hace uso del calendario dhtmlgoodies-week-planner para mostrar las fechas de reserva
                   del documento que pretendemos reservar
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
//session_start();
include_once("db.php");
include_once("calendario/calendario.php");  
//include ("header.php");
//$conn = new Conexion("MySql","localhost","saia","*adminsaia%","saia","3306");
//$consultas = new SQL($conn->Obtener_Conexion(), $conn->Motor);
global $conn;
$rowHeight = 20;

?>

<html>
<head>
<style type="text/css">
html{
	margin:0px;
	padding:0px;
	height:100%;
	width:100%;
}
body{
	margin:0px;
	padding:0px;
	font-family:verdana;
	font-size:9px;	
	height:100%;
	width:100%;
}

p,h2{
	margin:2px;
}

h1{
	font-size:1.4em;
	margin:2px;
}
h2{
	font-size:1.3em;
}
.weekButton{
	width:80px;
	font-size:0.8em;
	font-family:arial;
}
#weekScheduler_container{
	border:1px solid #000;
	width:948px;	
}

.weekScheduler_appointments_day{	/* Column for each day */
	width:127px;
	float:left;
	background-color: #FFFFD5;
	border-right:1px solid #F6DBA2;	
	position:relative;
}
#weekScheduler_top{
	background-color:buttonface;
	height:20px;
	border-bottom:1px solid #ACA899;
}
.calendarContentTime,.spacer{
	background-color:buttonface;
	text-align:center;
	font-family:arial;
	font-size:10px;
	line-height:<?php echo $rowHeight; ?>px;
	height:<?php echo $rowHeight; ?>px;	/* Height of hour rows */
	border-right:1px solid #ACA899;
	width:50px;
}

.weekScheduler_appointmentHour{	/* Small squares for each hour inside the appointment div */
	height:<?php echo $rowHeight+1; ?>px; /* Height of hour rows */
	border-bottom:1px solid #F6DBA2;	
}

.spacer{
	height:20px;
	float:left;
}	

#weekScheduler_hours{
	width:50px;
	float:left;
}
.calendarContentTime{
	border-bottom:1px solid #ACA899;

}

#weekScheduler_appointments{	/* Big div for appointments */
	width:896px;
	float:left;
}
.calendarContentTime .content_hour{
	font-size:10px;
	text-decoration:superscript;	
	vertical-align:top;
	line-height:<?php echo $rowHeight; ?>px;
}
	
#weekScheduler_top{
	position:relative;
	clear:both;
}
#weekScheduler_content{
	clear:both;
	height:294px;
	position:relative;
	overflow:auto;
}
.days div{
	width:127px;
	float:left;
	background-color:buttonface;
	text-align:center;
	font-family:verdana;
	height:20px;
	font-size:9px;
	line-height:20px;
	border-right:1px solid #ACA899;	
}

.weekScheduler_anAppointment{	/* A new appointment */
	position:absolute;
	background-color:#FFF;
	border:1px solid #000;
	z-index:1000;
	overflow:hidden;
}

.weekScheduler_appointment_header{	/* Appointment header row */
	height:4px;
	background-color:#ACA899;
}
.weekScheduler_appointment_headerActive{ /* Appointment header row  - when active*/
	height:4px;
	background-color:#00F;
}

.weekScheduler_appointment_textarea{	/* Textarea where you edit appointments */
	font-size:0.7em;
	font-family:arial;
}

.weekScheduler_appointment_txt{
	font-size:0.7em;
	font-family:arial;
	padding:2px;
	padding-top:5px;
	overflow:hidden;

}

.weekScheduler_appointment_footer{
	position:absolute;
	bottom:-1px;
	border-top:1px solid #000;
	height:4px;
	width:100%;
	font-size:0.8em;
	background-color:#000;
}

.weekScheduler_appointment_time{
	position:absolute;
	border:1px solid #000;
	right:1px;
	top:5px;
	width:80px;
	height:12px;
	z-index:100000;
	font-size:0.7em;
	padding:1px;
	background-color:#F6DBA2;
}
.eventIndicator{
	background-color:#00F;
	z-index:50;
	display:none;
	position:absolute;
}

table tbody td{	
	font-family: Verdana; 
  font-size: 9px;
}

table thead td {
font-weight:bold;
cursor:pointer;
background-color:#000077;
text-align: center;
font-family: Verdana; 
font-size: 9px;
text-transform:Uppercase;
vertical-align:middle;    
}

.encabezado_list { 
background-color:#000077; 
color:white ; 
vertical-align:middle;
text-align: center;
font-weight: bold;	
font-family: Verdana; 
font-size: 9px;
}

.imagen_internos {vertical-align:middle} 
.internos {font-family: Verdana; font-size: 9px; font-weight: bold;}
	/* If you wish to highlight current sortable column, add layout effects below */
	.highlightedColumn{
  background-color:#CCC;
} 
</style>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
// It's important that this JS section is above the line below wher dhtmlgoodies-week-planner.js is included
var itemRowHeight= <?php echo $rowHeight; ?>;
var mydate=new Date();
var year=mydate.getYear();
if (year < 1000)
  year+=1900;
var day=mydate.getDay();
var month=mydate.getMonth()+1;
if (month<10)
month="0"+month;
var daym=mydate.getDate();
if (daym<10)
daym="0"+daym;
var initDateToShow = year+"-"+month+"-"+daym;	// Initial date to show
//var initDateToShow = '2007-06-25';	// Initial date to show
</script>
<script src="js/dhtmlgoodies-week-planner.js?random=20060214" type="text/javascript"></script>
<!--style type="text/css">@import url(calendario/calendar-win2k-cold-2.css);</style>
<script type="text/javascript" src="calendario/calendar.js"></script>
<script type="text/javascript" src="calendario/calendar-es.js"></script>
<script type="text/javascript" src="calendario/calendar-setup.js"></script-->

<link rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

</head>
<title>Reservas</title>
<body>


<!--p><span class="internos"><img class="imagen_internos" src="botones/configuracion/documento.gif" border="0">&nbsp;&nbsp;DOCUMENTOS EN EL FOLDER
<br-->
<?php include_once('header.php');?>
<form action="reservaadd.php" method="post" name="formulario">
<?php 

/*
Esta parte se encarga de verificar los datos que llegaron, existe la el elemento "accion" que le indica
al programa la accion a realizar en esta pantalla, insertando o redireccionando segun sea el caso
*/

$solicitudes="";
$adicion=0;
$fechaActual = Date("Y-m-d H:i");
if(isset($_REQUEST["solicitudes"]) && $_REQUEST["solicitudes"]!="")
{
    $solicitudes = $_REQUEST["solicitudes"];
    $row = explode(",", $solicitudes);
    $posicion = $_REQUEST["posicion"];
    if(isset($_POST["accion"])AND($_POST["accion"]!=""))
    {
      if($_POST["accion"]=="Omitir")
      {
        $strsql = "UPDATE solicitud SET estado = 'DESCARTADO' WHERE idsolicitud = ".$row[$posicion];
	      phpmkr_query($strsql, $conn) or error("Falló la sentencia" . phpmkr_error() . ' SQL:' . $sSql);
        $posicion++;
        if($posicion>=count($row))
          redirecciona("solicitudadd.php");      
      }
      else
      {
        // Parte de la disponibilidad que tiene que ver con las mismas reservas        
        $disponibilidad = busca_filtro_tabla("A.idreserva","reserva A", "A.documento_iddocumento=".$_POST["docactual"]." AND ((A.fecha_inicial<=".fecha_db_almacenar($_POST["fecha_inicial"])." AND A.fecha_final>=". fecha_db_almacenar($_POST["fecha_inicial"]).") OR (A.fecha_inicial<=".fecha_db_almacenar($_POST["fecha_final"])." AND A.fecha_final>=".fecha_db_almacenar($_POST["fecha_final"]).") OR (A.fecha_inicial>=".fecha_db_almacenar($_POST["fecha_inicial"])." AND A.fecha_final<=".fecha_db_almacenar($_POST["fecha_final"])."))", "A.fecha_final DESC", $conn);
        if($disponibilidad["numcampos"] == 0)
        {
          $investigador = usuario_actual("funcionario_codigo");
          $registro = busca_filtro_tabla("A.descripcion, A.estado","documento A", "A.iddocumento=".$row[$posicion], "", $conn);
          $sqlInsert = "INSERT INTO reserva(documento_iddocumento, solicitud_idsolicitud, investigador_idinvestigador, fecha_inicial, fecha_final) VALUES (".$_POST["docactual"].",".$row[$posicion].",".$investigador.",".fecha_db_almacenar($_POST["fecha_inicial"].":00","Y-m-d H:i:s").",".fecha_db_almacenar($_POST["fecha_final"].":00","Y-m-d H:i:s").")";
  //die($sqlInsert);
          phpmkr_query($sqlInsert, $conn);
          $strsql = "UPDATE solicitud SET estado = 'PENDIENTE', solicitar_a = ".$_POST["x_peticion"]." WHERE idsolicitud = ".$row[$posicion];
	        phpmkr_query($strsql, $conn) or error("Falló la sentencia" . phpmkr_error() . ' SQL:' . $sSql);
	        
          $posicion++;
          ?>
          <script>alert('La reserva ha sido realizada con exito');</script>
          <?php
          $adicion=1;
        }
        else
        {
        ?>
        <script>alert('Las fechas ingresadas no son validas, ya que no puede ser reservado para ellas');</script>
        <?php
        }       
        if($_POST["accion"]=="Terminar" AND $adicion==1)
          redirecciona("solicitudadd.php");
      }
    }
    $registro = busca_filtro_tabla("A.documento_iddocumento, A.investigador_idinvestigador, B.descripcion, B.numero","solicitud A, documento B", "B.iddocumento=A.documento_iddocumento AND A.idsolicitud=".$row[$posicion], "", $conn);
    echo "DOCUMENTO NO: ".$registro[0]["numero"]."&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "DESCRIPCI&Oacute;N: ".$registro[0]["descripcion"]."<br>";
 //print_r($registro);   
    /*Calculo de la fecha en la que se deberia entregar el documento*/
    
    $reservas = busca_filtro_tabla("A.fecha_inicial, A.fecha_final","reserva A, solicitud B", "A.solicitud_idsolicitud=B.idsolicitud AND A.documento_iddocumento=".$registro[0]["documento_iddocumento"]." AND B.estado='PENDIENTE' AND A.fecha_inicial>".fecha_db_almacenar($fechaActual,"Y-m-d H:i"), "A.fecha_inicial", $conn);
    $fechaMax = "";
    if($reservas["numcampos"]>0)
      $fechaMax = $reservas[0]["fecha_inicial"];
    $maximoTiempo = busca_filtro_tabla("A.max_prestamo","serie A, documento B", "B.serie=A.idserie AND B.iddocumento=".$registro[0]["documento_iddocumento"], "", $conn);
    $devolucion = Date("Y-m-d H:i", mktime(substr($fechaActual,11,2) + $maximoTiempo[0]["max_prestamo"], substr($fechaActual,14,2), 0, substr($fechaActual,5,2), substr($fechaActual,8,2), substr($fechaActual,0,4)));
    if($fechaMax=="")
      $fechaMax = $devolucion;
    else
      if($devolucion<$fechaMax)
        $fechaMax = $devolucion;  
    
    ////////////////////////////////////////////////////////////////*/
  
  ?>
  <table border="0" width="100%">
  <tr rowspan="3" valing="center" >
  <td>
     <table border="0" >
		<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">SOLICITUD</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCION</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">NUMERO</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">RESERVADO</span></td>
		</tr>
		<?php
		foreach($row as $solicit)
		{
		  $datossol=busca_filtro_tabla("A.numero, A.descripcion, B.estado","documento A, solicitud B", "B.documento_iddocumento=A.iddocumento AND B.idsolicitud=".$solicit, "", $conn);
		?>
		  <tr bgcolor="#FFFFFF">
		  <td><?php echo $solicit?></td><td><?php echo $datossol[0]["descripcion"]?></td><td><?php echo $datossol[0]["numero"]?></td>
		  <td><?php if($datossol[0]["estado"]=='DESCARTADO' OR $datossol[0]["estado"]=='INICIADO') echo "NO"; else echo "SI";?></td>
		  </tr>
		<?php
		}
		?>
		</table>

  </td>
  <td>
  SOLICITAR A:
	<select id="x_peticion" name="x_peticion" style="font-family:verdana;font-size:9px;"><option value="">Seleccione...</option>
	<?php
	   // para que esta consulta tenga exito es necesario que exista el registro en la base de datos del individuo
     $encargados = busca_filtro_tabla("A.funcionario_codigo, A.nombres, A.apellidos","funcionario A, dependencia_cargo B, cargo C", "A.idfuncionario=B.funcionario_idfuncionario AND B.cargo_idcargo=C.idcargo AND C.nombre='ENCARGADO DE PRESTAMO'", "", $conn);
     echo "encargados: ";     
     for($i=0; $i<$encargados["numcampos"]; $i++)
       echo "<option value=".$encargados[$i]["funcionario_codigo"].">".$encargados[$i]["nombres"]." ".$encargados[$i]["apellidos"]."</option>";
  ?>
  </select>
  </td>
  </tr><tr><td></td><td>
  FECHA INICIAL :
  <!--input type="text"  name="fecha_inicial" style="font-family:verdana;font-size:9px;" value="<?php echo $fechaActual;?>" --> 
  <input type="text" style="font-family:verdana;font-size:9px;" name="fecha_inicial" id="fecha_inicial" value="<?php echo $fechaActual;?>" >
  <?php selector_fecha("fecha_inicial","formulario","Y-m-d H:i",date('m'),date('Y'),"default.css","","AD:VALOR"); ?>
  </td></tr><tr><td></td><td>
  FECHA FINAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
  <!--input type="text"  name="fecha_final" value="<?php echo $fechaMax;?>" style="font-family:verdana;font-size:9px;" --> 
  <input type="text" style="font-family:verdana;font-size:9px;" name="fecha_final" id="fecha_final" value="<?php echo $fechaMax;?>" >
  <?php selector_fecha("fecha_final","formulario","Y-m-d H:i",date('m'),date('Y'),"default.css","","AD:VALOR"); ?>
  
  <input type="hidden" id="solicitudes" name="solicitudes" value="<?php echo $solicitudes?>">
  <input type="hidden" id="posicion" name="posicion" value="<?php echo $posicion ?>">
  <input type="hidden" id="accion" name="accion" value="<?php if($posicion < count($row)-1) echo "Adicionar"; else echo "Terminar";?>">
  <input type="hidden" id="docactual" name="docactual" value="<?php echo $registro[0]["documento_iddocumento"]?>"">
  <br>
    <?php
}
?>
</td></tr><tr><td>
</td><td>
<br>
<input type="submit" id="siguiente" name="siguiente" value="Reservar" style="width:100" onclick="return verificar(formulario)">
<input type="submit" id="omitir" name="omitir" value="Omitir" style="width:100" onclick="accion.value='Omitir'">
</td></tr>
</table>
<br><br/>
<table width="100%">
<tr><td width="50%" aling="center">
<form>
<?php
 include_once("calendario/calendario.php");
 if(isset($_REQUEST["anio"]))
   $anio=$_REQUEST["anio"];
 else
   $anio=date("Y");
 calendario_reservas($anio,"reservaadd.php");
?>     
<input type="hidden" id="reservados" name="reservados">
</form>
<td valign="top" >
<h1>DETALLES RESERVAS DIA</h1>
<iframe name="mostrar_dia" id="mostrar_dia" width="100%" height="500px" frameborder="0" scrolling="no"></iframe>
</td></tr>
</table>
<?php include_once('footer.php');?>
<script>
/*
<Clase>
<Nombre>sgtesolicitud
<Parametros>
<Responsabilidades>Invocar a reservaadd con el siguiente documento a tratar, segun el listado de las solicitudes
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function sgtesolicitud()
{
  var solicitudes = document.getElementById('solicitudes').value;
  var numero = solicitudes.split(',');
  var posicion = document.getElementById('posicion').value;
  window.location="<?php print('reservaadd.php?solicitudes="+solicitudes+"&posicion="+posicion+"&descartar=1');?>";
}

/*
<Clase>
<Nombre>verificar
<Parametros>formulario: el fomulario actual
<Responsabilidades>Valida que el formulario halla sido tramitado correctamente
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function verificar(formulario)
{
  var mydate=new Date();
  if(formulario.x_peticion.value == "")
  {
    alert('Debe elegir hacia quien va dirigida la solicitud');
    return false;
  }  
  if(formulario.fecha_inicial.value =="")
  {
    alert('Debe ingresar el intervalo de fechas para la reserva');
    return false;
  }
  if(formulario.fecha_final.value =="")
  {
    alert('Debe ingresar el intervalo de fechas para la reserva');
    return false;
  }
  var d_ini = new Date(formulario.fecha_inicial.value.substring(0,4), formulario.fecha_inicial.value.substring(5,7)-1, formulario.fecha_inicial.value.substring(8,10), formulario.fecha_inicial.value.substring(11,13), formulario.fecha_inicial.value.substring(14,16));
  var d_ini_val = new Date(formulario.fecha_inicial.value.substring(0,4), formulario.fecha_inicial.value.substring(5,7)-1, formulario.fecha_inicial.value.substring(8,10), formulario.fecha_inicial.value.substring(11,13), formulario.fecha_inicial.value.substring(14,16)+5);
  var d_fin = new Date(formulario.fecha_final.value.substring(0,4), formulario.fecha_final.value.substring(5,7)-1, formulario.fecha_final.value.substring(8,10), formulario.fecha_final.value.substring(11,13), formulario.fecha_final.value.substring(14,16));
  if(d_ini>d_fin)
  {
    alert('La fecha inicial no puede ser mayor que la final');
    return false;
  }
  if(d_ini_val<mydate)
  {
    alert('La fecha ingresada es invalida, es menor que la fecha actual');
    return false;
  }
  return true;
}
</script>


</body>
</html>

