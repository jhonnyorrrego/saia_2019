<?php

require_once ("calendario.php"); // Funciones se servidor para calendario, en este archivo   
								 // se incluyen los scrips para el activecalendar 
								 
$myurl=$_SERVER['PHP_SELF']."?css=".@$_REQUEST['css']."&formato=".@$_REQUEST['formato']."&nombre_campo=".@$_REQUEST['nombre_campo']."&nombre_form=".@$_REQUEST['nombre_form']."&adicionales_tarea=".@$_REQUEST['adicionales_tarea']; // the links url is this page
$fecha=getdate();

if(!isset($_REQUEST["anio"])) // no enviaron fecha inicializo fecha actual
  $anio=$fecha["year"];  
else 
  $anio=$_REQUEST["anio"];
  
if(!isset($_REQUEST['mes'])) // no enviaron fecha inicializo fecha actual
  $mes=$fecha["month"];  
else 
  $mes=$_REQUEST['mes'];
  
if(!isset($_REQUEST["formato"])) // no enviaron fecha inicializo fecha actual
  $formato="d-m-Y";  
else 
  $formato=$_REQUEST["formato"];
  $imgatras="<img src=\"activecalendar/data/img/back.png\" border=\"0\" alt=\"&lt;&lt;\" />"; // imagen png atras
  $imgadelante="<img src=\"activecalendar/data/img/forward.png\" border=\"0\" alt=\"&gt;&gt;\" />"; // imagen png adelanate
 // se incia el calendario
  $calendario= new ActiveCalendarWeek($anio,$mes);
  $calendario->setMonthNames(array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'));
  $calendario->setDayNames(array('Dom','Lun','Mar','Mie','Jue','Vie','Sab'));
  

  $select_parametros=NULL;//Parametros que seran pasados a la funcion javascript que retorna los valores 
                          // formato,nombre_campo,nombre_form
  $select_parametros="'".$_REQUEST['formato']."','".$_REQUEST['nombre_campo']."','".$_REQUEST['nombre_form']."'";
   if(strpos($formato,"H")==TRUE) // solicitaron un picker con seleccion de hora
     {
      $select_parametros.=",1";
     }   
   else 
    {
     $select_parametros.=",0";
    }
       
     //die($select_parametros);
  $calendario->enableDayLinks(NULL,"retDate",$select_parametros); 
	
  $flecha_atras="<img src=\"activecalendar/data/img/back.png\" border=\"0\" alt=\"&lt;&lt;\" />"; // use png arrow back
  $flecha_adelante="<img src=\"activecalendar/data/img/forward.png\" border=\"0\" alt=\"&gt;&gt;\" />"; // use png arrow forward

  $calendario->enableMonthNav($myurl,$flecha_atras,$flecha_adelante); // Navegacion  meses
  $calendario->enableYearNav($myurl,$flecha_atras,$flecha_adelante);  // Navegacion anios
//$calendario->enableDatePicker(false,false,$myurl,"Selec."); 
$calendario->setFirstWeekDay(1); // primer dia el lunes
 
?> 
<?php print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head><title>Seleccione una fecha</title>
<link rel="stylesheet" type="text/css" href="<?php echo "activecalendar/data/css/".$_REQUEST['css'] ?>" />
<script src="functions.js" type="text/javascript" language="javascript"></script>
</head>
<body>
<?php

   if(strpos($formato,"H")==TRUE) // solicitaron un picker con seleccion de hora
    {
     // Minutos de en intervalos  de 5 para evitar un select muy largo
     if(!isset($_REQUEST["hora"]))
        $hora=date("g");
     else 
        $hora=$_REQUEST["hora"];
    
    if(!isset($_REQUEST["am_pm"]))                
      $am_pm=date("a");
     else 
      $am_pm=$_REQUEST["am_pm"];
   
    if(!isset($_REQUEST["minuto"]))    
      $minuto=date("i");
    else 
       $minuto=$_REQUEST["minuto"];
    $minuto=((int)($minuto/5))*5;
    
   echo '<div class="cssMonthNav" style="vertical-align:middle;">Fecha y Hora:
<select name="hora" id="hora">';
for($i=1;$i<13;$i++)
 { if($i==$hora)
     echo '<option value="'.$i.'" selected>'.$i.'</option>';
   else 
     echo '<option value="'.$i.'">'.$i.'</option>'; 
  }
echo '</select>';

echo '<select name="minuto" id="minuto">';
 for($i=0;$i<65;$i+=5)
 { if($i<10) // casos 00 05
     $mi="0".$i;
   else 
     $mi=$i; 
    if($i==$minuto)
     echo '<option value="'.$mi.'" selected>'.$mi.'</option>';
   else 
     echo '<option value="'.$mi.'">'.$mi.'</option>'; 
  }
 echo '</select>'; 
$am_pm=strtolower($am_pm);
echo '<select name="ampm" id="ampm">';
echo '<option value="AM" '; if($am_pm == "am") echo "selected"; 
echo '>AM</option>';
echo '<option value="PM"';  if($am_pm == "pm") echo "selected";
echo '>PM</option>';
echo '</select>';
}
?>
</div>
<center>
<?php
  echo $calendario->showMonth();
?>
</center>
</body>
</html>