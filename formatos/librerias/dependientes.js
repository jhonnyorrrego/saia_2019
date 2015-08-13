$(document).ready(function(){
	$("select").change(function(){
		//valor del select hijo
    var hijo=$(this).attr("hijo");
		// Tomo el valor de la opción seleccionada 
		valor = $(this).val();	
	//si tiene hijo
		if(hijo)
      {if(valor=="")//si ha elegido la opción "Seleccionar..." quito la seleccion de todos los hijos que siguen
			   {combo=hijo;
          while(combo)
            {$("#"+combo).html('	<option value="" selected="selected">Seleccionar...</option>')
             combo=$("#"+combo).attr("hijo");
            }
			    
         }
       else
        {
  			 $("#"+hijo).html('<option selected="selected" value="">Cargando...</option>')
  			/* Verificamos si el valor seleccionado es diferente de "Seleccionar..."*/
  			 if(valor!="")
          {
  			// Llamamos a pagina de combos.php donde ejecuto las consultas para llenar los combos
  				 $.post("../librerias/dependientes.php",{
  									idcomponente:$(this).attr("idcomponente"), // idcampos_formato
  									pos:$(this).attr("pos"),//posicion del select dentro de los parametros
  									valor:$(this).val() // Valor seleccionado
  									},function(data){
  													$("#"+hijo).html(data);	//Tomo el resultado de pagina e inserto los datos en el combo indicado																				
  													})												
  			  }
  		  }
		 } 
	})		
})
