$(function() {
    let params = $('#external_script').data('params');
    let scopes = {
        natural: 1,
        legal: 2,
        both: 3
    };

    $('#toggle_advanced').on('click', function() {
        $('#advanced').toggleClass('d-none');

        if ($('#advanced').hasClass('d-none')) {
            $(this).text('Mostrar opciones avanzadas');
        } else {
            $(this).text('Ocultar opciones avanzadas');
        }
    });

    $(document)
        .off('change', "[name='tipo']")
        .on('change', "[name='tipo']", function() {
            $('div[data-scope]').hide();

            if ($(this).val() == 1) {
                $('#name_container > label').text('NOMBRE COMPLETO');
                $(`
                div[data-scope='${scopes.natural}'],
                div[data-scope='${scopes.both}']`).show();
            } else {
                $(`
                div[data-scope='${scopes.legal}'],
                div[data-scope='${scopes.both}']`).show();
                $('#name_container > label').text('ORGANIZACIÓN');
            }
        });

    $('#btn_success').on('click', function() {
        $('#external_user_form').trigger('submit');
    });

    (function init() {
        findFields();
    })();

    function findFields() {
        $.post(
            `${params.baseUrl}app/tercero/campos_activos.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                fieldId: params.fieldId
            },
            function(response) {
                if (response.success) {
                    createForm(response.data.configurations);
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

    function createForm(data) {
        let frequently = [
            'tipo',
            'nombre',
            'tipo_identificacion',
            'identificacion',
            'ciudad'
        ];

        data.forEach(field => {
            switch (field.name) {
                case 'tipo':
                    var node = generateType(field);
                    break;
                case 'nombre':
                    var node = generateName(field);
                    break;
                case 'tipo_identificacion':
                    var node = generateIdentificationType(field);
                    break;
                case 'identificacion':
                    var node = generateIdentification(field);
                    break;
                case 'ciudad':
                    var node = generateCity(field);
                    break;
                case 'titulo':
                    var node = generateTitle(field);
                    break;
                case 'direccion':
                    var node = generateAddress(field);
                    break;
                case 'telefono':
                    var node = generatePhoneNumber(field);
                    break;
                case 'correo':
                    var node = generateEmail(field);
                    break;
                case 'sede':
                    var node = generateFranchise(field);
                    break;
                case 'cargo':
                    var node = generatePosition(field);
                    break;
                case 'empresa':
                    var node = generateCompany(field);
                    break;
                default:
                    console.error('campo indefinido');
                    break;
            }

            if (node) {
                if (frequently.includes(field.name)) {
                    $('#frequently').append(node);
                } else {
                    $('#advanced').append(node);
                }
            }
        });

        executeFormJavascript();
    }

    function executeFormJavascript() {
        if ($('#tipo_identificacion').length) {
            $('#tipo_identificacion').select2();
        }

        if ($('#titulo').length) {
            $('#titulo').select2();
        }

        if ($('#ciudad').length) {
            var select = $('#ciudad');
            select.select2({
                minimumInputLength: 3,
                language: 'es',
                ajax: {
                    url: `${params.baseUrl}app/configuracion/autocompletar_municipios.php`,
                    dataType: 'json',
                    delay: 200,
                    data: function(params) {
                        return {
                            term: params.term,
                            key: localStorage.getItem('key'),
                            token: localStorage.getItem('token')
                        };
                    },
                    processResults: function(response) {
                        return { results: response.data };
                    }
                }
            });
        }

        $(`[name='tipo'][value='${scopes.natural}']`)
            .prop('checked', true)
            .trigger('change');
    }

    function generateType(field) {
        let required = field.required ? 'required' : '';
        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'type_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<div>', {
                class: 'radio radio-success input-group'
            }).append(
                $('<input>', {
                    type: 'radio',
                    name: field.name,
                    id: field.name + 1,
                    value: 1,
                    required: field.required,
                    'aria-required': 'true'
                }),
                $('<label>', {
                    for: field.name + 1,
                    class: 'mr-3',
                    text: 'Persona natural'
                }),
                $('<input>', {
                    type: 'radio',
                    name: field.name,
                    id: field.name + 2,
                    value: 2,
                    'aria-required': 'true'
                }),
                $('<label>', {
                    for: field.name + 2,
                    class: 'mr-3',
                    text: 'Persona jurídica'
                })
            )
        );
    }

    function generateName(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'name_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<input>', {
                type: 'text',
                class: 'form-control',
                name: field.name,
                id: field.name,
                required: field.required
            })
        );
    }

    function generateIdentificationType(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class:
                'form-group form-group-default form-group-default-select2 ' +
                required,
            id: 'identification_type_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<div>', {
                class: 'form-group'
            }).append(
                $('<select>', {
                    name: field.name,
                    id: field.name,
                    required: field.required,
                    class: 'full-width'
                }).append(
                    $('<option>', {
                        value: '',
                        text: 'Seleccione...'
                    }),
                    $('<option>', {
                        value: 'CC',
                        text: 'CC'
                    }),
                    $('<option>', {
                        value: 'TI',
                        text: 'TI'
                    }),
                    $('<option>', {
                        value: 'TE',
                        text: 'TE'
                    })
                )
            )
        );
    }

    function generateIdentification(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'identification_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<input>', {
                type: 'text',
                class: 'form-control',
                name: field.name,
                id: field.name,
                required: field.required
            })
        );
    }

    function generateTitle(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class:
                'form-group form-group-default form-group-default-select2 ' +
                required,
            id: 'title_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<div>', {
                class: 'form-group'
            }).append(
                $('<select>', {
                    name: field.name,
                    id: field.name,
                    required: field.required,
                    class: 'full-width'
                }).append(
                    $('<option>', {
                        value: '',
                        text: 'Seleccione...'
                    }),
                    $('<option>', {
                        value: 'Señor',
                        text: 'Señor'
                    }),
                    $('<option>', {
                        value: 'Señora',
                        text: 'Señora'
                    })
                )
            )
        );
    }

    function generateAddress(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'address_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<input>', {
                type: 'text',
                class: 'form-control',
                name: field.name,
                id: field.name,
                required: field.required
            })
        );
    }

    function generatePhoneNumber(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'phone_number_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<input>', {
                type: 'text',
                class: 'form-control',
                name: field.name,
                id: field.name,
                required: field.required
            })
        );
    }

    function generateEmail(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'email_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<input>', {
                type: 'text',
                class: 'form-control',
                name: field.name,
                id: field.name,
                required: field.required
            })
        );
    }

    function generateFranchise(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'franchise_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<input>', {
                type: 'text',
                class: 'form-control',
                name: field.name,
                id: field.name,
                required: field.required
            })
        );
    }

    function generateCity(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class:
                'form-group form-group-default form-group-default-select2 ' +
                required,
            id: 'city_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<div>', {
                class: 'form-group'
            }).append(
                $('<select>', {
                    name: field.name,
                    id: field.name,
                    required: field.required,
                    class: 'full-width',
                    multiple: 'multiple'
                })
            )
        );
    }

    function generatePosition(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'position_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<input>', {
                type: 'text',
                class: 'form-control',
                name: field.name,
                id: field.name,
                required: field.required
            })
        );
    }

    function generateCompany(field) {
        let required = field.required ? 'required' : '';

        return $('<div>', {
            class: 'form-group form-group-default ' + required,
            id: 'company_container',
            'data-scope': field.scope
        }).append(
            $('<label>', {
                text: field.label
            }),
            $('<input>', {
                type: 'text',
                class: 'form-control',
                name: field.name,
                id: field.name,
                required: field.required
            })
        );
    }
});

$('#external_user_form').validate({
    submitHandler: function() {
        let params = $('#external_script').data('params');
        let data = $('#external_user_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                userId: params.userId
            });

        $.post(
            `${params.baseUrl}app/tercero/guardar.php`,
            data,
            function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    top.successModalEvent({
                        id: response.data.userId,
                        text: response.data.name
                    });
                } else {
                    top.notification({
                        message: response.message,
                        type: 'error',
                        title: 'Error!'
                    });
                }
            },
            'json'
        );
    }
});
