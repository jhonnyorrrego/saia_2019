<?php
session_start();
?>
<frameset rows="50%,40%">
 <frame frameborder="0"  id="frasignaciones" name="frasignaciones" src="asignacionlist.php?modo=<?php echo $_REQUEST["modo"];?>&idfuncionario=<?php echo $_REQUEST['idfuncionario'];?>" scrolling="auto" >
 <frame frameborder="0"  id="frcontrol" name="frcontrol"  src="">    
</frameset>
