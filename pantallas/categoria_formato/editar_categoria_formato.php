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


if(!@$_REQUEST['idcategoria_formato']){
   die(); 
}
$datos_categoria=busca_filtro_tabla("nombre,descripcion","categoria_formato","idcategoria_formato=".@$_REQUEST['idcategoria_formato'],"",$conn);
?>
<div class="container">
    <legend>Crear Categoria Formato</legend>
    <br>
    <form name="formulario_adicionar_categoria_formato" id="formulario_adicionar_categoria_formato" method="POST" action="librerias.php">
        
        <div class="control-group element">
            <label class="control-label" for="nombre">Nombre *</label>
            <div class="controls"> 
                <input type="text" name="nombre" id="nombre" class="required" value="<?php echo(codifica_encabezado(html_entity_decode($datos_categoria[0]['nombre']))); ?>">
            </div>        
        </div>

        <div class="control-group element">
            <label class="control-label" for="nombre">Descripcion </label>
            <div class="controls"> 
                <textarea name="descripcion" id="descripcion"><?php echo(codifica_encabezado(html_entity_decode($datos_categoria[0]['descripcion']))); ?></textarea>
            </div>        
        </div>        
        <input type="hidden" name="ejecutar_funcion" value="edit_categoria">
        <input type="hidden" name="idbusqueda_componente" value="<?php echo(@$_REQUEST['idbusqueda_componente']); ?>">
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