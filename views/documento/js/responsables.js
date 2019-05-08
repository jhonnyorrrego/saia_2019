$(function () {
    let params = $('script[data-route]').data('route');
    $('script[data-route]').removeAttr('data-route');
    let routeType = 0;

    $('.toggle_forms').on('click', function () {
        toggleForms();
    });

    $('#route_type').on('select2:select', function () {
        routeType = +$(this).val();
        hideRoutes();
        switch (routeType) {
            case 1:
                showRadicationRoute();
                break;
            case 2:
                showApprobationRoute();
                break;
            case 3:
                showRadicationRoute();
                break;
            default:
                hideRoutes();
                break;
        }
    });

    $(document)
        .off('select2:select', '.select_action')
        .on('select2:select', '.select_action', function () {
            let tr = $(this).parents('tr').first();
            let data = tr.data('info');
            data.action = $(this).val();
            tr.attr('data-info', JSON.stringify(data));
        });

    $(document)
        .off('click', '.remove_row')
        .on('click', '.remove_row', function () {
            let table = $(this).parents('table');
            $(this).parents('tr').first().remove();
            generateNewOrder(table);
        });

    $('#save_item').on('click', function () {
        let user = $('#manager').val();
        let action = $('#firm_type_container').is(':visible') ?
            $('#firm_type_select').val() : $('#action_type_select').val();

        if (!user.length) {
            top.notification({
                type: 'error',
                message: 'Debe indicar un funcionario'
            });
        } else {
            if (!action.length) {
                top.notification({
                    type: 'error',
                    message: 'Debe indicar una acción'
                });
            } else {
                let user = $('#manager').select2('data')[0];
                if (routeType == 1 || routeType == 3) {
                    addRadicationItem(user, action[0]);
                } else {
                    addApprobationItem(user, action[0]);
                }

                toggleForms();
            }
        }
    });

    $('#save_routes').on('click', function () {
        let data = [];
        let rows = $('#radication_route_container').is(':visible') ?
            $('#radication_route_container tbody tr') :
            $('#approbation_route_container tbody tr');

        rows.each(function () {
            data.push($(this).data('info'))
        });

        $.post(
            `${params.baseUrl}app/documento/guardar_ruta.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                documentId: params.documentId,
                type: routeType,
                data: data,
                flow: $('[name="flow"]').val()
            },
            function (response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
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

    (function init() {
        //hideApprobationType();
        createSelects();
        createAutocomplete();
    })();

    function hideApprobationType() {
        if (!+params.number) {
            $('#route_type').find('[value="2"]').remove();
        }
    }

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

    function createRadicationTable(data) {
        $('#radication_route_container table > tbody').remove();
        $('#radication_route_container table').append(
            $('<tbody>').css('cursor', 'move')
        );

        let tbody = $('#radication_route_container tbody');
        data.forEach(e => {
            let item = {
                order: e.order,
                user: e.destination,
                action: e.firm_type
            };
            tbody.append(generateRadicationItem(item));
        });

        $('#radication_route_container select').select2();
        addSortPlugin($('#radication_route_container table'));
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

    function createApprobationTable(data) {

        $('#approbation_route_container table > tbody').remove();
        $('#approbation_route_container table').append(
            $('<tbody>').css('cursor', 'move')
        )

        let tbody = $('#approbation_route_container tbody');
        data.forEach(e => {
            let item = {
                order: e.order,
                user: e.destination,
                action: e.action
            };
            tbody.append(generateApprobationItem(item));
        });

        $('#approbation_route_container select').select2();
        addSortPlugin($('#approbation_route_container table'));
    }

    function addRadicationItem(user, action) {
        let tbody = $('#radication_route_container tbody');
        let data = {
            order: tbody.find('tr').length + 1,
            user: {
                type: "5",
                typeId: user.id,
                name: user.text
            },
            action
        }
        tbody.append(generateRadicationItem(data));
        $('#radication_route_container select').select2();
    }

    function addApprobationItem(user, action) {
        let tbody = $('#approbation_route_container tbody');
        let data = {
            order: tbody.find('tr').length + 1,
            user: {
                type: "5",
                typeId: user.id,
                name: user.text
            },
            action
        }
        tbody.append(generateApprobationItem(data));
        $('#approbation_route_container select').select2();
    }

    function createSelects() {
        $("#route_type,#firm_type_select,#action_type_select").select2({
            placeholder: "Seleccione..",
        });
        $('#route_type').val(3).trigger('change').trigger('select2:select');
    }

    function createAutocomplete() {
        $("#manager").select2({
            minimumInputLength: 3,
            language: "es",
            ajax: {
                url: `${params.baseUrl}app/funcionario/autocompletar.php`,
                dataType: "json",
                data: function (params) {
                    return {
                        term: params.term,
                        key: localStorage.getItem("key"),
                        token: localStorage.getItem("token"),
                        roles: 1,
                        identificator: 'iddependencia_cargo'
                    };
                },
                processResults: function (response) {
                    return response.success ? { results: response.data } : {};
                }
            }
        });
    }

    function generateRadicationItem(data) {
        return $('<tr>').append(
            $('<td>', {
                class: 'text-center'
            }).text(data.order),
            $('<td>').text(data.user.name),
            $('<td>').append(
                $('<select>', {
                    class: 'full-width select_action'
                }).append(
                    $('<option>', {
                        value: 3,
                        text: 'Visto bueno - oculto'
                    }),
                    $('<option>', {
                        value: 2,
                        text: 'Visto bueno - visible'
                    }),
                    $('<option>', {
                        value: 0,
                        text: 'Firma oculta'
                    }),
                    $('<option>', {
                        value: 1,
                        text: 'Firma visible'
                    }),
                    $('<option>', {
                        value: 4,
                        text: 'Firma manual'
                    }),
                    $('<option>', {
                        value: 5,
                        text: 'Firma externa'
                    })
                )
                    .val(data.action)
                    .trigger('change')
            ),
            $('<td>', {
                class: 'remove_row text-center'
            }).append(
                $('<span>', {
                    class: 'cursor fa fa-trash f-20'
                })
            )
        ).attr('data-info', JSON.stringify({
            type: data.user.type,
            typeId: data.user.typeId,
            action: data.action,
            order: data.order
        }));
    }

    function generateApprobationItem(data) {
        return $('<tr>', {
            class: 'text-center'
        }).append(
            $('<td>').text(data.order),
            $('<td>').text(data.user.name),
            $('<td>').append(
                $('<select>', {
                    class: 'full-width select_action'
                }).append(
                    $('<option>', {
                        value: '1',
                        text: 'Visto bueno'
                    }),
                    $('<option>', {
                        value: '2',
                        text: 'Aprobar'
                    })
                )
                    .val(data.action)
                    .trigger('change')
            ),
            $('<td>', {
                class: 'remove_row'
            }).append(
                $('<span>', {
                    class: 'cursor fa fa-trash f-20'
                })
            )
        ).attr('data-info', JSON.stringify({
            type: data.user.type,
            typeId: data.user.typeId,
            action: data.action,
            order: data.order
        }));
    }

    function toggleForms() {
        $('#managers_container,#item_form_container').toggle();

        if ($('#item_form_container').is(':visible')) {
            $('#firm_type_container,#action_type_container').hide();
            if (routeType == 1 || routeType == 3) {
                $('#firm_type_container').show();
            } else {
                $('#action_type_container').show();
            }
        } else {
            $('#firm_type_select,#action_type_select,#manager')
                .val(null)
                .trigger('change');
        }
    }

    function generateNewOrder(table) {
        table.find('tbody tr').each(function (i) {
            let data = $(this).data('info');
            data.order = i + 1;
            $(this).attr('data-info', JSON.stringify(data));
            $(this).find('td:first').text(data.order);
        });
    }

    function addSortPlugin(table) {
        table.find('tbody').sortable({
            update: function (event, ui) {
                generateNewOrder($(this).parent());
            }
        });
    }

});