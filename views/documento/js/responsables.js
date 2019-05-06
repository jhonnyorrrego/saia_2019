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
                let user = $('#manager').select2('data')[0].text;
                if (routeType == 1 || routeType == 3) {
                    addRadicationItem(user, action[0]);
                } else {
                    addApprobationItem(user, action[0]);
                }

                toggleForms();
            }
        }
    });

    (function init() {
        createSelects();
        createAutocomplete();
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

    function createRadicationTable(data) {
        $('#radication_route_container table > tbody').remove();
        $('#radication_route_container table').append($('<tbody>'))

        let tbody = $('#radication_route_container tbody');
        data.forEach(e => {
            let data = {
                order: e.order,
                user: e.destination,
                action: e.firm_type
            };
            tbody.append(generateRadicationItem(data));
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

    function createApprobationTable(data) {
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
                            $('<option>', {
                                value: 'visto bueno',
                                text: 'Visto bueno'
                            }),
                            $('<option>', {
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

    function addRadicationItem(user, action) {
        let tbody = $('#radication_route_container tbody');
        let data = {
            order: tbody.find('tr').length + 1,
            user,
            action
        }
        tbody.append(generateRadicationItem(data));
        $('#radication_route_container select').select2();
    }

    function addApprobationItem(user, action) {
        console.log(arguments);
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
            $('<td>').text(data.order),
            $('<td>').text(data.user),
            $('<td>').append(
                $('<select>', {
                    class: 'full-width'
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
                    }),
                )
                    .val(data.action)
                    .trigger('change')
            )
        );
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
})