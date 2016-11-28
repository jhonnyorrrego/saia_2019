<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."pantallas/lib/librerias_notificaciones.php");
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
echo(librerias_bootstrap());
if($_REQUEST['guardar']==1){
    $sql="UPDATE ft_destino_radicacion SET recepcion='".$_REQUEST['funcionario']."', recepcion_fecha=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",estado_item=3,finalizacion_observa='".htmlentities($_REQUEST['descripcion'])."' WHERE idft_destino_radicacion={$_REQUEST['idft']}";
    phpmkr_query($sql);
    
    notificaciones("Item finalizado!","success",4500);
    unset($_REQUEST);
    ?>
    <script type="text/javascript">window.parent.hs.close();</script>
    <?php
}else{
?>
<div class="container">
        <div class="control-group" nombre="etiqueta">
            <legend>Finalizar Item</legend>
        </div>
        <form id="formulario_finalizacion" class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="etiqueta">Fecha*:</label>
                <div class="controls">
                    <input type="text" name="fecha" id="fecha" class="required" readonly="" value="<?php echo(date("Y-m-d H:i:s"));?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="etiqueta">Observacion:</label>
                <div class="controls">
                    <textarea id="descripcion" class="required" name="descripcion" placeholder="Descripcion"></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type='submit' class="btn btn-primary btn-mini" name="submit" id="submit" value="continuar">
                    <input type="hidden" name="funcionario" value="<?php echo(usuario_actual("funcionario_codigo"));?>">
                    <input type="hidden" name="idft" value="<?php echo($_REQUEST['idft'])?>">
                    <input type="hidden" name="guardar" value="1">
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/jquery.validate.1.13.1.js"></script>
    <style>
    label.error {
        font-weight: bold;
        color: red;
    }
    </style>
    <script>
        
    $(document).ready(function(){
        $("#formulario_finalizacion").validate();
    });
    </script>
<?php
}