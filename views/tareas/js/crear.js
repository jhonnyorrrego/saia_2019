$(function(){
    let baseUrl = Session.getBaseUrl();
    language = {
        errorLoading: function () {
            return "La carga falló" 
        },
        inputTooLong: function (e) {
            var t = e.input.length - e.maximum,
                n = "Por favor,elimine " + t + " car";
            return t == 1 ? n += "ácter" : n += "acteres"; 
        },
        inputTooShort: function (e) {
            var t = e.minimum - e.input.length,
            n = "Por favor,introduzca " + t + " car";
            return t == 1 ? n += "ácter" : n += "acteres";
        },
        loadingMore: function () {
            return "Cargando más resultados…" 
        },
        maximumSelected: function (e) {
            var t = "Sólo puede seleccionar " + e.maximum + " elemento";
            return e.maximum != 1 && (t += "s"); 
        },
        noResults: function () {
            return "No se encontraron resultados" 
        },
        searching: function () {
            return "Buscando…" 
        }
    };
    
    $("#manager,#followers").select2({
        minimumInputLength: 3,
        language: language,
        ajax: {
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            dataType: 'json',
            data: function (params) {
                var query = {
                    term: params.term,
                    key: localStorage.getItem('key')
                }

                return query;
            },
            processResults: function (response) {                                
                if(response.success){
                    data = {
                        results: response.data
                    };
                }else{
                    data = {};
                }

                return data;
            }
        }
    });
    
    $(".dropzone").dropzone({
        url: "/file/post" 
    });
    
    $(".toggle_advanced").on('click', function(){
        $(".toggle_advanced, .advanced").toggle();
    });

    setTimeout(() => {
        $('#followers_container').hide();
    }, 0);
});