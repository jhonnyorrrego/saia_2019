$(function(){
    let baseUrl = Session.getBaseUrl();
    let params = JSON.parse($('script[data-params]').attr('data-params'));
    let language = {
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

    (function init(){
        if (!params.id) {
            let finaldate = moment(params.finalTime, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DDThh:mm');
            $('#final_date').val(finaldate);
            checkName();
        }else{
            findFormData(params.id);
        }
    })();
    
    $("#manager").select2({
        minimumInputLength: 3,
        language: language,
        ajax: {
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            dataType: 'json',
            data: function (params) {
                return {
                    term: params.term,
                    key: localStorage.getItem('key')
                }
            },
            processResults: function (response) {                                
                return response.success ? {results: response.data} : {};
            }
        }
    });

    $("#manager").on('select2:unselect', function (e) {
        let id = e.params.data.id;
        $(this).find(`[value="${id}"]`).remove();
    });

    $(document).on('keyup', '#name', function () {
        checkName();
    });
    
    $('#save').on('click', function(){
        let key = localStorage.getItem('key');
        let managers = getOptions('#manager');
        let initial = moment($('#final_date').val(), 'YYYY-MM-DDThh:mm')
            .subtract(30, "minutes").format('YYYY-MM-DD HH:mm:ss');
        let final = moment($('#final_date').val(), 'YYYY-MM-DDThh:mm').format('YYYY-MM-DD HH:mm:ss');

        data = {
            task: params.id || 0,
            key: key,
            name: $('#name').val(),
            managers: managers.length ? managers : [key],
            notification: $('#send_notification').is(':checked') ? 1 : 0,
            initialDate: initial,
            finalDate: final,
            description: $('#description').val(),
        }
        
        $.post(`${baseUrl}/app/tareas/guardar.php`, data, function(response){
            if(response.success){
                top.notification({
                    type: 'success',
                    message: response.message
                });

                let newParams = JSON.stringify({ id: response.data });
                $('script[data-params]').attr('data-params', newParams);
                $('.tasktab.disabled').removeClass('disabled');
                $('#iframe_workspace').contents().find('.fc-refresh-button').trigger('click');
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

    function findFormData(id){
        $.post(`${baseUrl}app/tareas/consulta.php`, {
            key: localStorage.getItem('key'),
            task: id
        }, function(response){
            if(response.success){
                fillForm(response.data);
            }else{
                top.notification({
                    type: 'error',
                    message: response.message
                })
            }
        }, 'json');
    }

    function fillForm(data){
        $('#name').val(data.task.nombre);        
        let finaldate = moment(data.task.fecha_final, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DDThh:mm');
        $('#final_date').val(finaldate);
        $('#description').val(data.task.descripcion);
        fillSelect('#manager', data.users.managers);
    }

    function fillSelect(selector, data){
        if(data.length){
            data.forEach(u => {
                $(selector).append(
                    $('<option>',{
                        value: u.id,
                        text: u.name,
                        selected: true
                    })
                );
            })
        }
    }

    function checkName() {        
        $('#save').attr('disabled', $('#name').val().length ? false : true);
    }
});