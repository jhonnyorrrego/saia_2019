$(function() {
    let params = $('#graph_script').data('params');
    $('#graph_script').removeAttr('data-params');

    (function init() {
        if (!params.screen) {
            return;
        }

        $.post(
            `${params.baseUrl}app/graficos/listado_pantalla.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                screen: params.screen
            },
            function(response) {
                if (response.success) {
                    findGraphs(response.data.keys);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    })();

    function findGraphs(data) {
        data.forEach(element => {
            $.post(
                `${params.baseUrl}app/graficos/generar_json.php`,
                {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    graph: element
                },
                function(response) {
                    if (response.success) {
                        paintGraph(response.data);
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        });
                    }
                },
                'json'
            );
        });
    }

    function paintGraph(data) {
        let container = $('<div>', {
            id: `graph_${data.id}`,
            class: 'col-12 col-md-3'
        });
        $('#graph_list').append(container);
        container.height(container.width());
        var graph = echarts.init(container[0]);
        graph.setOption(data.json);
    }
});
