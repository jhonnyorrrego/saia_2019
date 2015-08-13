<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."class_transferencia.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
?>
<div id="waitDiv" style="position:absolute;left:0;top:20;visibility:hidden; border:none;">
<img src="<?php echo $ruta_db_superior."imagenes/cargando.gif"; ?>" border="0">
</div>
<SCRIPT>
<!--
//setTimeout(100);
var DHTML = (document.getElementById || document.all || document.layers);
function ap_getObj(name) {
if (document.getElementById)
{ return document.getElementById(name).style; }
else if (document.all)
{ return document.all[name].style; }
else if (document.layers)
{ return document.layers[name]; }
}
function ap_showWaitMessage(div,flag) {
//if (!DHTML) return;
var x = ap_getObj(div); 
x.visibility = (flag) ? 'visible':'hidden'
if(! document.getElementById) 
  if(document.layers) 
    x.left=280/2; 
return true; 
} 
ap_showWaitMessage('waitDiv', 3);
//-->
</SCRIPT>
