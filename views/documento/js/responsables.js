$(function () {
    let params = $('script[data-route]').data('route');
    $('script[data-route]').removeAttr('data-route');

    (function init() {
        findRoute();
    })()

    $('#save_route').on('click', function () {
        $.post(
            `${params.baseUrl}app/documento/guardar_ruta.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: params.documentId
            },
            function (response) {
                if (response.success) {
                    
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

    function findRoute() {
        $.post(
            `${params.baseUrl}app/documento/responsables.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: params.documentId
            },
            function (response) {
                if (response.success) {
                    createTable(response.data);
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

    function createTable(data) {
        let routes = [];
        data.forEach((v) => {
            $('#table_body').append(
                $('<tr>').append(
                    $('<td>').text(v.origin),
                    $('<td>').text(v.destination),
                    $('<td>').html(data.length  ? createRadios(v.firm_type, v.id) : ''),
                )
            );
            routes.push(v.id);
        });

        $('#table_body').append(
            $('<input>', {
                type: 'hidden',
                value: routes.join(','),
                name: 'routes'
            })
        );
    }

    function createRadios(selected, routeId) {
        return $('<div>', {
            class: 'radio radio-success'
        }).append(
            $('<input>', {
                type: 'radio',
                checked: selected == 1,
                value: 1,
                id: 'visible_firm',
                name: 'state_' + routeId
            }),
            $('<label>', {
                for: 'visible_firm',
                text: 'Firma visible'
            }),
            $('<input>', {
                type: 'radio',
                checked: selected == 2,
                value: 2,
                id: 'check',
                name: 'state_' + routeId
            }),
            $('<label>', {
                for: 'check',
                text: 'Revisado'
            }),
            $('<input>', {
                type: 'radio',
                checked: selected == 5,
                value: 5,
                id: 'external_firm',
                name: 'state_' + routeId
            }),
            $('<label>', {
                for: 'external_firm',
                text: 'Firma externa'
            }),
            $('<input>', {
                type: 'radio',
                checked: selected == 0,
                value: 0,
                id: 'none',
                name: 'state_' + routeId
            }),
            $('<label>', {
                for: 'none',
                text: 'Ninguna'
            })            
        );
    }
})