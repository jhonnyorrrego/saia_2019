$('#busqueda_cargo').validate({
  ignore: "",
  rules: {
    bqsaia_nombre: {
      minlength: 2,
    },
    bqsaia_codigo: {
      minlength: 2
    }
  },  
  highlight: function(label) {
  	$(label).closest('.control-group').addClass('error');
  }
});   
function llenar_valor(id,valor){
	$("#"+id).val(valor);
}

