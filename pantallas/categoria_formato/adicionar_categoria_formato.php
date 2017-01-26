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

if(@$_REQUEST['adicionar']){
    
	$tabla="";
	$fieldList=array();
	$fieldList["cod_padre"] = 2;	
	$fieldList["nombre"] = decodifica_encabezado(htmlentities($_REQUEST['nombre'])); 
	$fieldList["descripcion"] = decodifica_encabezado(htmlentities($_REQUEST['descripcion']));
	
	$strsql = "INSERT INTO ".$tabla." (fecha,";
	$strsql .= implode(",", array_keys($fieldList));			
	$strsql .= ") VALUES (".fecha_db_almacenar(date('Y-m-d'),'Y-m-d').",'";			
	$strsql .= implode("','", array_values($fieldList));			
	$strsql .= "')";
    
    print_r($strsql);
    
    die();
}
?>
<div class="container">
    <legend>Crear Categoria Formato</legend>
    <br>
    <form name="formulario_adicionar_categoria_formato" id="formulario_adicionar_categoria_formato" method="POST" action="adicionar_categoria_formato.php">
        
        <div class="control-group element">
            <label class="control-label" for="nombre">Nombre *</label>
            <div class="controls"> 
                <input type="text" name="nombre" id="nombre" class="required">
            </div>        
        </div>

        <div class="control-group element">
            <label class="control-label" for="nombre">Descripcion </label>
            <div class="controls"> 
                <textarea name="descripcion" id="descripcion"></textarea>
            </div>        
        </div>        
        <input type="hidden" name="adicionar" value="1">
        <button class="btn btn-primary btn-mini" id="submit_formulario_adicionar_categoria_formato">Aceptar</button>
    </form>
</div>
<?php  
echo(librerias_jquery('1.7'));
echo(librerias_validar_formulario('11'));
?>
<script>
    $(document).ready(function(){
        $('#formulario_adicionar_categoria_formato').validate();
    });
</script>