$(function () {
    let params = $('script[data-route]').data('route');
    $('script[data-route]').removeAttr('data-route');

    $('#route_type').on('select2:select', function () {
        hideRoutes();
        switch (+$(this).val()) {
            case 1:
                showRadicationRoute();
                break;
            case 2:
                showApprobationRoute();
                break;
            case 3:
                showRadicationRoute();
                showApprobationRoute();
                break;
            default:
                hideRoutes();
                break;
        }
    });

    (function init() {
        $('#route_type').select2();
        $('#route_type').val(3).trigger('change').trigger('select2:select');
    })();
    
    function hideRoutes() {
        $('#radication_route_container,#approbation_route_container').hide();
    }

    function showRadicationRoute() {
        $.post(
            `${params.baseUrl}app/documento/rutas.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: params.documentId,
                type: 'radication'
            },
            function (response) {
                if (response.success) {
                    createRadicationTable(response.data);
                    $('#radication_route_container').show();
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

    function createRadicationTable(data){
        $('#radication_route_container table > tbody').remove();
        $('#radication_route_container table').append($('<tbody>'))

        let tbody = $('#radication_route_container tbody');
        data.forEach(e => {
            tbody.append(
                $('<tr>').append(
                    $('<td>').text(e.order),
                    $('<td>').text(e.destination),
                    $('<td>').append(
                        $('<select>', {
                            class: 'full-width'
                        }).append(
                            $('<option>',{
                                value: 1,
                                text: 'a'
                            }),
                            $('<option>',{
                                value: 2,
                                text: 'b'
                            }),
                            $('<option>',{
                                value: 3,
                                text: 'c'
                            }),
                            $('<option>',{
                                value: 4,
                                text: 'd'
                            })
                        )
                        .val(e.firm_type)
                        .trigger('change')
                    )
                )
            );
        });

        $('#radication_route_container select').select2();
    }

    function showApprobationRoute() {
        $.post(
            `${params.baseUrl}app/documento/rutas.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: params.documentId,
                type: 'approbation'
            },
            function (response) {
                if (response.success) {
                    createApprobationTable(response.data);
                    $('#approbation_route_container').show();
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

    function createApprobationTable(data){
        $('#approbation_route_container table > tbody').remove();
        $('#approbation_route_container table').append($('<tbody>'))

        let tbody = $('#approbation_route_container tbody');
        data.forEach((e, i) => {
            tbody.append(
                $('<tr>').append(
                    $('<td>').text(e.order),
                    $('<td>').text(e.destination),
                    $('<td>').append(
                        $('<select>', {
                            class: 'full-width'
                        }).append(
                            $('<option>',{
                                value: 'visto bueno',
                                text: 'Visto bueno'
                            }),
                            $('<option>',{
                                value: 'Aprobar',
                                text: 'Aprobar'
                            })                            
                        )
                        .val(e.action)
                        .trigger('change')
                    )
                )
            );
        });

        $('#approbation_route_container select').select2();
    }
})