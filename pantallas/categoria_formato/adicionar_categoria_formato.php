<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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
echo(estilo_bootstrap()); 

?>

<div class="container">
    <form name="formulario_adicionar_categoria_formato" id="formulario_adicionar_categoria_formato">
        
        <div class="control-group element">
            <label class="control-label" for="nombre">Nombre *</label>
            <div class="controls"> 
                <input type="text" name="nombre" id="nombre" >
            </div>        
        </div>
    </form>
</div>

<?php  
echo(librerias_jquery('1.7'));
echo(librerias_validar_formulario());
?>