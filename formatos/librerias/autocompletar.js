	function lookup(digitado,idcomponente) 
  {
		if(digitado.length == 0) 
      {
  			// Hide the suggestion box.
  			$('#suggestions'+idcomponente).hide();
  		} 
    else 
      {
  			$.post("../librerias/autocompletar_formatos.php", {digitado: ""+digitado+"",idcomponente:idcomponente}, 
        function(data)
         {
  				if(data.length >0) 
             {
    					$('#suggestions'+idcomponente).show();
    					$('#list'+idcomponente).html(data);
    				 }
  			 });
  		}
	 } // lookup
	
	function fill(valor,mostrar,idcomponente,nombre) 
  {
		$('#input'+idcomponente).val(mostrar);
		$('#'+nombre).val(valor);
		setTimeout("$('#suggestions"+idcomponente+"').hide();", 200);
	}
