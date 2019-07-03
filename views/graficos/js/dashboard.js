$(function() {
    let params = $('#graph_script').data('params');
    $('#graph_script').removeAttr('data-params');
    let graphs = [];

    (function init() {
        if (!params.screen) {
            return;
        }

        removeClosePanelButton();
        findGraphList();
    })();

    function removeClosePanelButton() {
        let panelId = $('.k-focus', parent.document).attr('id');
        let breadCrumb = $(`#crumb-${panelId}`, parent.document);
        breadCrumb.find('a').removeAttr('style');
        breadCrumb.find('button').remove();
    }

    function findGraphList() {
        $.post(
            `${params.baseUrl}app/graficos/listado_pantalla.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                screen: params.screen
            },
            function(response) {
                if (response.success) {
                    graphs = response.data;
                    findGraphs(Object.keys(graphs));
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }

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
        let container = null;
        if (!$(`#graph_${data.id}`).length) {
            container = $('<div>', {
                id: `graph_${data.id}`,
                class: 'col-12 col-md-4'
            });
            $('#graph_list').append(container);
            container.height(container.width());
        } else {
            container = $(`#graph_${data.id}`);
        }

        if (data.json.toolbox && data.json.toolbox.feature) {
            for (let object in data.json.toolbox.feature) {
                let functionName = data.json.toolbox.feature[object].onclick;
                if (functionName) {
                    data.json.toolbox.feature[object].onclick =
                        window[functionName];
                }
            }
        }

        var graph = echarts.init(container[0], 'walden');
        graph.setOption(data.json);
    }

    window.seeReport = function(i, ga) {
        findComponent(ga, openPanel);
    };

    window.showFilters = function(i, ga) {
        findComponent(ga, openModal);
    };

    function findComponent(ga, callback) {
        let graphName = ga.getOption().series[0].name;
        let graph = Object.values(graphs).find(g => g.name == graphName);

        $.post(
            `${params.baseUrl}app/busquedas/consulta_componente.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                graphName: graphName
            },
            function(response) {
                if (response.success) {
                    callback(response.data, graph);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }

    function openPanel(component, graph) {
        var routeParams = $.param({
            idbusqueda_componente: component.idbusqueda_componente,
            idbusqueda_filtro_temp: graph.filterId
        });
        var params = {
            kConnector: 'iframe',
            url: `${component.url}?${routeParams}`,
            kTitle: component.etiqueta
        };

        parent.crear_pantalla_busqueda(params);
    }

    function openModal(component, graph) {
        top.topModal({
            url: params.baseUrl + graph.searchRoute,
            params: {
                idbusqueda_componente: component.idbusqueda_componente
            },
            size: 'modal-xl',
            title: 'Búsqueda',
            buttons: {
                success: {
                    label: 'Buscar',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cerrar',
                    class: 'btn btn-danger'
                }
            },
            onSuccess: function(data) {
                if (data.exito) {
                    let parts = data.filtro.split('=');
                    graph.filterId = parts[1];
                    graphs[graph.id] = graph;
                    filterGraph(graph);
                }
            }
        });
    }

    function filterGraph(graph) {
        $.post(
            `${params.baseUrl}app/graficos/generar_json.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                graph: graph.id,
                filterId: graph.filterId
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
    }
});
