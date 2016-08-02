<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery());
echo(librerias_UI());


$usuario=usuario_actual('nombres').' '.usuario_actual('apellidos');
$usuario=ucwords(strtolower($usuario));
$fecha=date('Y-m-d');
$color='green';
$estado='APROBADO';
$x=1288;
$y=531;

?>
<div id="mueveme">
	<span style="cursor:move;" id="funcionario"><b><?php echo($usuario);?></b></span>	
	<br>
	<span><?php echo($fecha);?></span>
	<br>
	<textarea style="resize: none; width:250px;height:100px;" id="notas"></textarea>
	<br>
	
	<center><B><?php echo($estado); ?></B></center>
</div>

<script type="text/javascript">

var x=$(document);
x.ready(inicio);

function inicio(){
    var x=$("#mueveme");
    x.draggable({ 
    	handle: "#funcionario", 
    	stop: cordenadas
    });
}

function cordenadas(){
	 var offset = $('#mueveme').offset();
     var x = offset.left;
     var y = offset.top;	 
     //alert(x+'-'+y);
	 
}

</script>

<style type="text/css">
#mueveme{
	padding:10px;
    width:250px;
    height:150px;
    border:1px solid black;
    color:<?php echo($color); ?>;
    border-color:<?php echo($color); ?>;
    
    position: absolute;
    left: <?php echo($x); ?>px;
    top: <?php echo($y); ?>px;  
}
</style>