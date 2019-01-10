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
?>
<script>
$(document).ready(function(){
	tinymce.init({
      mode : "specific_textareas",
      editor_selector : "tiny_avanzado",
      language : "es", 
      autosave_ask_before_unload:false,              
      spellchecker_languages : "+English=en,Swedish=sv,Catala=ca,spanish=es",
      plugins: [
              "example advlist link image lists charmap print preview hr anchor pagebreak spellchecker",
              "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
              "table contextmenu directionality emoticons template textcolor paste textcolor"
      ],        
      toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | forecolor backcolor | code",
      toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent | undo redo | link unlink  subscript superscript",
      toolbar3: "image spellchecker | table | charmap pagebreak | fontsizeselect fontselect formatselect | plantillas_saia",
      
			content_css : "<?php echo($ruta_db_superior);?>css/bootstrap.css",

      menubar: false,
      toolbar_items_size: 'small',

      style_formats: [
              {title: 'Bold text', inline: 'b'},
              {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
              {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
              {title: 'Example 1', inline: 'span', classes: 'example1'},
              {title: 'Example 2', inline: 'span', classes: 'example2'},
              {title: 'Table styles'},
              {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
      ],

      templates: [
              {title: 'Test template 1', content: 'Test 1'},
              {title: 'Test template 2', content: 'Test 2'}
      ],
      paste_auto_cleanup_on_paste : true,
      paste_postprocess : function(pl, o) {
      	// remove extra line breaks        	
      	o.node.innerHTML = o.node.innerHTML.replace(/&nbsp;/ig, " ");
  		}     
	});
});
</script>