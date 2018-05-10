$(function() {
    var form_builder = {
        el: null,
        method: "POST",
        action: "",        
        delimeter: '=',
        setElement: function(el) {
            this.el = el;
        },
        getElement: function() {
            return this.el;
        },        
        addComponent: function(component) {        
            $.ajax({
	            type:'POST',
	            url: "../../pantallas/lib/llamado_ajax.php",
	            data: "librerias=pantallas/generador/librerias.php&funcion=adicionar_pantalla_campos&parametros="+$("#idpantalla").val()+";"+component.attr("idpantalla_componente")+";1&rand="+Math.round(Math.random()*100000),	            	           
	            success: function(html){                
                if(html){          
                  var objeto=jQuery.parseJSON(html);                  
                  if(objeto.exito){
                    $("#content").append(objeto.codigo_html);
                                      	
                  }                  
	            	}
	            }
	        	});                         
        }        
    };    
    $(document).on('click', '.element > .close', function(e) {
        e.stopPropagation();      
        hs.htmlExpand( null, {
          src: "eliminar_pantalla_campo.php?idpantalla_campos="+$(this).attr("idpantalla_campos"),				             	
          objectType: 'iframe', 
          outlineType: 'rounded-white', 
          wrapperClassName: 'highslide-wrapper drag-header', 
          preserveContent: false,				
          width: 497,
          height: 300								 
        });        
    });
    $(document).on('click', '.element', function() {
  		hs.htmlExpand( null, {
        src: "editar_pantalla_campo.php?idpantalla_componente="+$(this).attr("idpantalla_componente")+"&idpantalla_campos="+$(this).attr("idpantalla_campo"),					
        objectType: 'iframe', 
        outlineType: 'rounded-white', 
        wrapperClassName: 'highslide-wrapper drag-header', 
        preserveContent: false,				
        width: 497,
        height: 300								 
      });      
    });
    $(document).on('click', '.element > input, .element > textarea, .element > label', function(e) {
        e.preventDefault();
    });  
    $("#content").droppable({
        accept: '.component',
        hoverClass: 'content-hover',
        drop: function(e, ui) {
            form_builder.addComponent(ui.draggable);
        }
    })
    .sortable({
        placeholder: "element-placeholder",
        update: function(e, ui) {           
          var orden=$("#content").sortable("toArray"); 
          $.ajax({
            type:'POST',
            url: "../../pantallas/lib/llamado_ajax.php",
            data: "librerias=pantallas/generador/librerias_pantalla.php&funcion=ordenar_pantalla_campos&parametros="+orden+"&rand="+Math.round(Math.random()*100000),
            success: function(html){                              
              if(html){                                      
            	}
            }
        	});     
        }
    })
    .disableSelection();    
});