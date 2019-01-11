<?php
if($_REQUEST["formula"])
{$_REQUEST["formula"]=str_replace("{mas}","+",$_REQUEST["formula"]);
 $formula=preg_replace("([A-Za-z_]+[0-9]*)","1",$_REQUEST["formula"]);

 eval('$respuesta='.$formula.';'); 
 echo $respuesta;  
   echo "|$respuesta|$formula";
}
?>