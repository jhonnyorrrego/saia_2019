$(function(){
    var baseUrl = Session.getBaseUrl();
    var userId = localStorage.getItem('key');
    var params = {
        key: userId,
        number: 0,
        string: '',
        date: ''
    }

    $("#document_finder").autocomplete({
        serviceUrl: `${baseUrl}app/documento/buscador.php`,
        lookupLimit: 10,
        width:500,
        minChars:4,
        noCache: true,
        type: 'POST',
        params: params,
        onSelect: function (suggestion) {
            alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });

    $("#document_finder").on('keyup', function(){
        if(Number($(this).val())){
            $("#document_finder").autocomplete('setOptions', {minChars:1});
            $(this).trigger('focus');
        }else{
            $("#document_finder").autocomplete('setOptions', {minChars:4});
        }
    })

    $("#clean_finder").on('click', function(){
        $("#document_finder").val('');
    });

    $("#show_filters").on('click', function(){
        $("#document_finder").trigger('blur');
        let content = `
        <form id="form_filters">
        <div class="form-group form-group-default">
            <label>Radicado</label>
            <input name="number" type="number" class="form-control" value="${params.number || ''}">
        </div>
        <div class="form-group form-group-default">
            <label>Asunto</label>
            <input name="string" type="text" class="form-control" value="${params.string || ''}">
        </div>
        <div class="form-group form-group-default">
            <label>Fecha</label>
            <input name="date" type="date" class="form-control" value="${params.date || ''}">
        </div>
        </form>
        <script>
            $("#btn_success").on("click", function(){
                window.fillAutocompleteParams();
                $("#close_modal").trigger('click');
            });

            $("#form_filters :input").on('keyup change', function(){
                $("#form_filters :input").each(function(i,e){
                    if($(e).val()){
                        $("#document_finder").val($(e).val());
                    }
                }) 
            });

            $("#form_filters :input").first().trigger('keyup');
        </script>
        `;
        let options = {
            html: true, //for show specific html
            content: content, //string to put on modal
            size: "modal-sm", //'modal-lg', 'modal-sm'
            title: "Filtros", //title for modal
            centerAlign: false, 
            buttons: {
                success: {
                    label: 'Buscar',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cancelar',
                    class: 'btn btn-danger'
                }
            },
        }

        topModal(options);
    });

    window.fillAutocompleteParams = function(){
        $("#form_filters input").each(function(i, e){
            params[$(e).attr('name')] = $(e).val();
        });

        $("#document_finder").trigger('keyup');
        $("#document_finder").focus();
    }
    
});