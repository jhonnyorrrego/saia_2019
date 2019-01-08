<?php 
echo(librerias_jquery("1.7"));
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior); ?>js/jquery.validate.1.13.1.js"></script>
<script type="text/javascript">
  $("#formulario_<?php echo($nombre_formulario_saia);?>").validate();
  $("#continuar_<?php echo($nombre_formulario_saia);?>").click(function(){
    var salida_<?php echo($nombre_formulario_saia);?> = false;
    $.ajax({
          type:'POST',
          async: false,
          url: "<?php echo $ruta_db_superior;?>formatos/librerias/encript_data.php",
          data: {datos:JSON.stringify($('#formulario_<?php echo($nombre_formulario_saia);?>').serializeArray(), null)},
          success: function(data) {
            $("#form_info_<?php echo($nombre_formulario_saia);?>").empty().val(data);
            salida_<?php echo($nombre_formulario_saia);?> = true;
        }
    });  
    return salida;
  });  
</script>