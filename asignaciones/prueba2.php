<?php


//echo fecha_db_obtener('ss',"yyyy");
//include_once 'arbolxml.php';
//adicionar_tarea("Tarea de Prueba","Tarea de Pruebas ",240);
//$identidad=1;
//$llave_entidad=array(1,2);
//asignar_tarea(5,NULL,7,$llave_entidad,$identidad);	
//asignaciones_documento(2);
//echo date("d-m-Y",mktime( 0, 0, 0, 1, 1,2008));
//calendario_asignaciones_anio(2,2008,"prueba2.php");

//$anio=date("Y");
//$fecha_fin=date("d-m-Y", mktime( 0, 0, 0,1, 1,$anio+1));
?>
<link type="text/css" rel="stylesheet" href="css/main.css" media="screen" />
<link type="text/css" rel="stylesheet" href="css/jDrawer.css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.jDrawer.js"></script>

		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				$("#jDrawer-1").jDrawer({event: "click"});
				$("#jDrawer-2").jDrawer({speed: 500, sticky: false});
				$("#jDrawer-3").jDrawer({direction: "left", sticky: false});
				$("#jDrawer-4").jDrawer({direction: "left", event: "click"});
				$("#jDrawer-5").jDrawer();
				$("#jDrawer-6").jDrawer({callback: function() { alert("hover"); } });
			});
		</script>
<ul id="jDrawer-1">
<li>Hidden<br><br><br><br><br>Visible</li>
<li>Hidden<br><br><br><br><br>Visible</li>
<li>Hidden<br><br><br><br><br><div style="jDrawer-handle">Visible</div></li>
</ul>	

 
	