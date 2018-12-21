$(function(){
    let baseUrl = Session.getBaseUrl();
    let params = $('script[data-params]').data('params');
    let loadedFiles = [];
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

    //default actions
    setTimeout(() => {
        $('#followers_container').hide();

        let finaldate = moment(params.finalTime, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DDThh:mm')
        $('#final_date').val(finaldate)
    }, 0);
    
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
    
    
    var myDropzone = new Dropzone("#task_files", { 
        url: `${baseUrl}app/tareas/cargar_anexos.php`,
        params: {
            key: localStorage.getItem('key')
        },
        paramName: 'task_file',
        init: function() {
            this.on("success", function(file, response) {
                response = jQuery.parseJSON(response)

                if(response.success){
                    response.data.forEach(e => {
                        loadedFiles.push(e);
                    })
                }else{
                    top.notification({
                        type: 'error',
                        message: response.message
                    })
                }
            })
        }
    });
    
    $(".toggle_advanced").on('click', function(){
        $(".toggle_advanced, .advanced").toggle();
    });    

    $('#btn_success').on('click', function(){
        let key = localStorage.getItem('key');
        let managers = getOptions('#manager');
        let followers = getOptions('#followers');

        data = {
            key: key,
            name: $('#name').val(),
            managers: managers.length ? managers : [key],
            notification: $('#send_notification').is(':checked') ? 1 : 0,
            initialDate: params.initialTime,
            finalDate: moment($('#final_date').val(),'YYYY-MM-DDThh:mm').format('YYYY-MM-DD HH:mm:ss'),
            priority: $('#priority').val(),
            description: $('#description').val(),
            followers: followers.length ? followers : '',
            files: loadedFiles
        }
        
        $.post(`${baseUrl}/app/tareas/guardar.php`, data, function(response){
            if(response.success){
                top.notification({
                    type: 'success',
                    message: 'Nota creada'
                });

                //se debe mejorar, actualiza el calendario
                if($('#iframe_workspace').contents().find('#iframe_right_workspace').length){
                    $('#iframe_workspace').contents().find('#iframe_right_workspace').contents().find('.fc-refresh-button').trigger('click');
                }else{
                    $('#iframe_workspace').contents().find('.fc-refresh-button').trigger('click');
                }
                $('#close_modal').trigger('click');
            }
        }, 'json')
    });

    function getOptions(selector){
        let data = [];

        if($(selector).children().length){
            $.each($(selector).children(), function(i, e){
                data.push($(e).val());
            });
        }

        return data;
    }
});