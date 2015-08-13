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
?>    
<!DOCTYPE html>     
<html>
  <head>    
  <?php               
  /*echo(librerias_html5());
  echo(librerias_jquery("1.7"));
  echo(estilo_bootstrap()); 
  echo(librerias_validar_formulario()); 
  echo(librerias_tooltips());*/
  ?>           
  </head>
  <body>
    <div class="container master-container">
       <form accept-charset="UTF-8" action="" class="simple_form form-horizontal" id="nueva_busqueda"  method="post" >  
        <legend>Adicionar B&uacute;squeda</legend>  
        <div class="control-group">
          <label class="string required control-label" for="nombre">
            <abbr title="Requerido">*</abbr> Nombre
          </label>
          <div class="controls">
            <input class="string required span6" id="nombre" name="nombre" size="50" type="text">
          </div>
        </div>
        <div class="control-group string required">
          <label class="string required control-label" for="etiqueta">
            <abbr title="Requerido">*</abbr> Etiqueta
          </label>
          <div class="controls">
            <input class="string required span6" id="etiqueta" name="etiqueta" size="50" type="text">
          </div>
        </div>
        <div class="row">
          <div class="control-group radio_buttons span4">
            <label class="radio_buttons optional control-label"><abbr title="Requerido">*</abbr> Estado
            </label>
            <div class="controls">
              <label class="radio inline">
                <input class="radio_buttons optional" id="estado1" name="estado" type="radio" value="1">Activo
              </label>
              <label class="radio inline">
                <input class="radio_buttons optional" id="estado2" name="estado" type="radio" value="0">Inactivo
              </label>
            </div>          
          </div> 
          <div class="control-group span4">
            <label class="text optional control-label" for="carga_pantalla"><abbr title="Requerido">*</abbr>Time Out pantalla 
            </label>
            <div class="controls">
              <input id="cantidad_registros" name="carga_pantalla" type="number" min="500" max="1000" value="500" step="100" >
            </div>
          </div>
          <div class="control-group span1">
          </div>  
        </div>  
        <div  class="row">
          <div class="control-group span4">
            <label class="control-label" for="ancho"><abbr title="Requerido">*</abbr>Ancho</label>
            <div class="controls" >
              <input id="ancho" type="number" name="ancho" min="200" max="600" value="240" step="10" >
            </div>
          </div>   
          <div class="control-group span4">  
            <label class="control-label" for="cantidad_registros"><abbr title="Requerido">*</abbr>Cantidad Registros</label>
            <div class="controls">
              <input id="cantidad_registros" name="cantidad_registros" type="number" min="10" max="100" value="30" step="10" >
              <input name="tipo_busqueda" type="hidden" value="1">
            </div>
          </div>
        </div>
        <div class="control-group pila">
          <label class="control-label" for="ruta_libreria"> Librer&iacute;as
          </label>          
          <div class="controls">                                 
            <input class="pila_cadena" type="text" >
            <button class="llenar_pila_saia"><i class="icon-plus"></i></button>
            <input type="hidden" name="ruta_librerias" id="ruta_librerias"><br>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>
                    <span class="caret toggle-table-body"></span>(<span class="numero_items_pila">0</span>)
                  </th>
                  <th>  
                    Items seleccionados  
                  </th>
                </tr>
              </thead>
              <tbody class="datos_pila_saia">
              </tbody>
            </table>           
          </div>          
        </div>   
        <input type="hidden" name="paso_siguiente_saia" id="paso_siguiente_saia" value="adicionar_componente_busqueda.php">

        
        
        <!--div class="control-group text optional">
          <label class="text optional control-label" for="article_content"> Content
          </label>
          <div class="controls">
<textarea class="text optional span6" cols="40" id="article_content" name="article[content]" rows="20"></textarea>
          </div>
        </div>
        <div class="control-group check_boxes optional">
          <label class="check_boxes optional control-label"> Stacked checkboxes
          </label>
          <div class="controls">
            <label class="checkbox">
              <input class="check_boxes optional" id="article_content_type_blog" name="article[content_type][]" type="checkbox" value="Blog">Blog
            </label>
            <label class="checkbox">
              <input class="check_boxes optional" id="article_content_type_editorial" name="article[content_type][]" type="checkbox" value="Editorial">Editorial
            </label>
            <label class="checkbox">
              <input class="check_boxes optional" id="article_content_type_announce" name="article[content_type][]" type="checkbox" value="Announce">Announce
            </label>
            <label class="checkbox">
              <input class="check_boxes optional" id="article_content_type_advertisement" name="article[content_type][]" type="checkbox" value="Advertisement">Advertisement
            </label>
            <input name="article[content_type][]" type="hidden" value="">
          </div>
        </div>
        <div class="control-group check_boxes optional">
          <label class="check_boxes optional control-label"> Inline checkboxes
          </label>
          <div class="controls">
            <label class="checkbox inline">
              <input class="check_boxes optional" id="article_content_type_blog" name="article[content_type][]" type="checkbox" value="Blog">Blog
            </label>
            <label class="checkbox inline">
              <input class="check_boxes optional" id="article_content_type_editorial" name="article[content_type][]" type="checkbox" value="Editorial">Editorial
            </label>
            <label class="checkbox inline">
              <input class="check_boxes optional" id="article_content_type_announce" name="article[content_type][]" type="checkbox" value="Announce">Announce
            </label>
            <label class="checkbox inline">
              <input class="check_boxes optional" id="article_content_type_advertisement" name="article[content_type][]" type="checkbox" value="Advertisement">Advertisement
            </label>
            <input name="article[content_type][]" type="hidden" value="">
          </div>
        </div>
        <div class="control-group radio_buttons optional">
          <label class="radio_buttons optional control-label"> Stacked radios
          </label>
          <div class="controls">
            <label class="radio">
              <input class="radio_buttons optional" id="article_content_type_blog" name="article[content_type]" type="radio" value="Blog">Blog
            </label>
            <label class="radio">
              <input class="radio_buttons optional" id="article_content_type_editorial" name="article[content_type]" type="radio" value="Editorial">Editorial
            </label>
            <label class="radio">
              <input class="radio_buttons optional" id="article_content_type_announce" name="article[content_type]" type="radio" value="Announce">Announce
            </label>
            <label class="radio">
              <input class="radio_buttons optional" id="article_content_type_advertisement" name="article[content_type]" type="radio" value="Advertisement">Advertisement
            </label>
          </div>
        </div>       
        <div class="control-group select optional">
          <label class="select optional control-label" for="article_content_type"> Content type
          </label>
          <div class="controls">
            <input name="article[content_type][]" type="hidden" value="">
            <select class="select optional" id="article_content_type" multiple="multiple" name="article[content_type][]">
              <option value="Blog">Blog
              </option>
              <option value="Editorial">Editorial
              </option>
              <option value="Announce">Announce
              </option>
              <option value="Advertisement">Advertisement
              </option>
            </select>
            <p class="help-block">multiple select
            </p>
          </div>
        </div>
        <div class="control-group select optional">
          <label class="select optional control-label" for="article_category"> Category
          </label>
          <div class="controls">
            <select class="select optional" id="article_category" name="article[category]">
              <option value="">
              </option>
              <option value="Blog">Blog
              </option>
              <option value="Editorial">Editorial
              </option>
              <option value="Announce">Announce
              </option>
              <option value="Advertisement">Advertisement
              </option>
            </select>
            <p class="help-block">simple select box
            </p>
          </div>
        </div>
        <div class="control-group text optional">
          <label class="text optional control-label" for="article_content"> Content
          </label>
          <div class="controls">
<textarea class="text optional span6" cols="40" id="article_content" name="article[content]" rows="20"></textarea>
          </div>
        </div>
        <div class="control-group string optional disabled">
          <label class="string optional control-label" for="article_disabled_text"> Disabled text
          </label>
          <div class="controls">
            <input class="string optional disabled" disabled="disabled" id="article_disabled_text" name="article[disabled_text]" size="50" type="text">
            <p class="help-block">an example of disabled input
            </p>
          </div>
        </div>
        <div class="control-group string optional">
          <label class="string optional control-label" for="article_disabled_text"> Disabled text
          </label>
          <div class="controls">
            <div class="input-prepend">    
              <label class="add-on">      
                <input id="remove" name="remove" type="checkbox" value="true">
              </label>    
              <input class="string optional disabled" disabled="disabled" id="article_disabled_text" name="article[disabled_text]" size="50" type="text">
            </div>
            <span class="help-block">This is the hint text
            </span>
          </div>
        </div>
        <div class="control-group string optional">
          <label class="string optional control-label" for="article_disabled_text"> Disabled text
          </label>
          <div class="controls">
            <div class="input-append">    
              <input class="string optional disabled mini" disabled="disabled" id="article_disabled_text" name="article[disabled_text]" size="50" type="text">    
              <label class="add-on active">      
                <input id="remove" name="remove" type="checkbox" value="true">
              </label>
            </div>
            <span class="help-block">This is the hint text
            </span>
          </div>
        </div-->
        <div class="form-actions">    
          <input class="btn btn-primary" name="commit" type="submit" value="Crear B&uacute;squeda">    
          <input class="btn btn-danger" name="commit" type="reset" value="Cancelar">  
        </div>
      </form>
    </div>  
<?php 
   // echo(librerias_bootstrap());
      ?>
  </body>
  <script type="text/javascript">
  $.validator.addMethod("validar_pilas", function(value, element,param) {
    return( this.optional(element) || value != "");
  }, "Alerta Pila");
$('#nueva_busqueda').validate({
  ignore: "",
  rules: {
    nombre: {
      minlength: 2,
      required: true
    },
    etiqueta: {
      required: true,
      minlength: 2
    }//,
    /*ruta_librerias: {
      required:true,
      validar_pilas:true
    } */
  },
  
  highlight: function(label) {
  	$(label).closest('.control-group').addClass('error');
  },
  submitHandler: function(form) {
    dataString = $("#nueva_busqueda").serialize();    
    $.ajax({
      type: "POST",
      url: "clase_busqueda.php",
      data: dataString,
      success: function(data) { 
        if(data){
          enlace=data.split("@");                                
          activar_paso_wizard("siguiente",enlace[0],enlace[1]);
        }
        else{    
          alert("Error");
        }
      }    
    });
    
    return true;  
  }
});
$('abbr').qtip({
  style: {
    classes: 'ui-tooltip qtip ui-tooltip-default ui-tooltip-shadow ui-tooltip-jtools'
  }
});
$(".llenar_pila_saia").click(function (){
  valor_pila=$(this).prev().val();
  if(valor_pila!=''){ 
    $(this).closest(".controls").find(".datos_pila_saia").append("<tr><td><i class='icon-remove eliminar_pila_saia'></i></td><td>"+valor_pila+"</td></tr>");
    $(this).closest(".controls").find(".numero_items_pila").html(parseInt($(this).closest(".controls").find(".numero_items_pila").html())+1);
    $(this).prev().val('');
  }
  return(false);  
}); 
$(".pila_cadena").keypress(function(event){
  if(event.which == 13){
    event.preventDefault();
    $(this).next().click();
  }
});
$('.toggle-table-body').click(function(){
     $(this).closest('table').children('tbody').toggle();
  }); 
$('.toggle-table-body').closest('table').children('tbody').toggle();                                    
$(".controls").on("click",".eliminar_pila_saia",function(){    
  $(this).closest("table").find(".numero_items_pila").html(parseInt($(this).closest(".controls").find(".numero_items_pila").html())-1);
  $(this).parent().parent().remove();
  return(false);  
});    
</script>
</html>