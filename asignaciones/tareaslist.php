<?php if(!isset($_SESSION))
  session_start();	
?>
<frameset cols="60%,*">
     <frame name="listado_tareas" src="tareas_documentoslist.php?modulo=1" frameborder="1" marginwidth="0" marginheight="10" scrolling="auto" noresize>
     <frame name="listado_docs" src="" marginwidth="10" marginheight="10" scrolling="auto" >
</frameset>   
