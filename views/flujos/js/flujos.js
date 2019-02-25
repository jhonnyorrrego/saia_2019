$(function () {

    let baseUrl = $("script[data-baseurl]", parent.document).data('baseurl');
    var consulta64 = $("script[data-consulta64]").data('consulta64');
    $('#expediente_flujo').selectize({
        valueField: 'value',
        labelField: 'text',
        searchField: 'text',
        persist: false,
        createOnBlur: true,
        create: false,
        maxItems: 1,
        load: function (query, callback) {
            if (!query.length)
                return callback();
            $.ajax({
                url: baseUrl + "autocompletar.php",
                type: 'POST',
                dataType: 'json',
                data: {
                    consulta: consulta64,
                    valor: query
                },
                error: function () {
                    callback();
                },
                success: function (res) {
                    callback(res);
                }
            });
        }
    });

    //var upload_url = 'cargar_archivos_flujo.php';
    

});