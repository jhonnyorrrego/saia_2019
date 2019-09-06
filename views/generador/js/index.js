$(document).ready(function() {
    let params = $('#script_generador_pantalla').data('params');
    let step = 1;

    (function init() {
        $('#serie_idserie,#tipo_registro,#contador_idcontador').select2();

        if (params.formatId) {
            setFormatData();
            createHeaderFooterSelect();
            findFunctions();
        } else {
            $('.nav li').addClass('disabled');
            $('#generar_pantalla').addClass('disabled');

            $('#tabs_formulario li:first').removeClass('disabled');
        }
    })();

    $('#guardar').on('click', function() {
        if (step == 1) {
            saveFormat();
        } else if (step == 3) {
            saveBody();
        } else {
            return false;
        }
    });

    $('#generar').on('click', function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: `${params.baseUrl}app/generador/generar.php`,
            data: {
                token: localStorage.getItem('token'),
                key: localStorage.getItem('key'),
                formatId: params.formatId
            },
            beforeSend: xhr => {
                if (!params.formatId) {
                    top.notification({
                        type: 'error',
                        message: 'Debe diligenciar los datos del formato'
                    });
                    xhr.abort();
                } else {
                    top.notification({
                        type: 'info',
                        title: 'Generando formato',
                        message: 'Esto puede tardar un poco, por favor espere'
                    });
                }
            },
            success: function(response) {
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
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });

    $('.nav li').click(function() {
        return !$(this).hasClass('disabled');
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $(e.relatedTarget).css({
            color: '#666',
            background: '#eee',
            'font-weight': 'normal'
        });
        $(e.target).css({
            color: '#fff',
            background: '#49b0e8',
            'font-weight': 'bold'
        });

        switch ($(e.target).attr('id')) {
            case 'nav-vista_previa':
                step = 4;
                getPreview();
                break;
            case 'nav-mostrar':
                step = 3;
                break;
            case 'nav-campos':
                step = 2;
                break;
            case 'nav-informacion':
                step = 1;
                break;
        }

        if (step == 1 || step == 3) {
            $('#guardar').css({
                color: '#fff',
                background: '#49b0e8',
                'font-weight': 'bold'
            });
        } else {
            $('#guardar').css({
                color: '#666',
                background: '#eee',
                'font-weight': 'normal'
            });
        }
    });

    $('#etiqueta_formato').change(function() {
        if (!params.formatId) {
            if ($(this).val()) {
                var nombre = normalizar($(this).val());
                $('#nombre_formato').val(nombre);
            }
        }
    });

    $('#tipo_registro').change(function() {
        switch ($(this).val()) {
            case '1':
                $('#item').val('0');
                $('#mostrar_pdf').val('1');
                $('.tipo_edicion').show();
                $("input[name='paginar']").attr('checked', 'checked');
                $("input[name='mostrar_pdf']").attr('checked', true);
                break;
            case '2':
                $('#item').val('0');
                $('#mostrar_pdf').val('0');
                $('.tipo_edicion').hide();
                $("input[name='paginar']").attr('checked', false);
                $("input[name='mostrar_pdf']").attr('checked', false);
                break;
            case '3':
                $('#item').val('1');
                $('#mostrar_pdf').val('0');
                $('.tipo_edicion').hide();
                $("input[name='mostrar_pdf']").attr('checked', false);
                break;
            default:
                $('#item').val('0');
                $('#mostrar_pdf').val('0');
                $("input[name='paginar']").attr('checked', false);
                $("input[name='mostrar_pdf']").attr('checked', false);
                break;
        }
    });

    $(document)
        .off('click', '.funcionesPropias')
        .on('click', '.funcionesPropias', function() {
            var funcion = $(this).data('name');
            CKEDITOR.instances['editor_mostrar'].insertText(`{*${funcion}*}`);
        });

    $('.select_header_footer').on('change', function() {
        let type = $(this).data('type');

        if (type) {
            $.post(
                `${params.baseUrl}app/generador/actualizar_encabezado_pie.php`,
                {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    formatId: params.formatId,
                    type: type,
                    identificator: $(this).val()
                },
                function(response) {
                    if (response.success) {
                        top.notification({
                            type: 'success',
                            message: response.message
                        });
                        if (type == 'header') {
                            showHeader();
                        } else {
                            showFooter();
                        }
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

    $('.delete_header_footer').on('click', function() {
        let type = $(this).data('type');
        let identificator =
            type == 'header'
                ? $('#select_header').val()
                : $('#select_footer').val();

        $.post(
            `${params.baseUrl}app/generador/eliminar_encabezado_pie.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                identificator: identificator,
                formatId: params.formatId,
                type: type
            },
            function(response) {
                if (response.success) {
                    createHeaderFooterSelect();

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

    $('.edit_header_footer').on('click', function() {
        let type = $(this).data('type');
        let identificator =
            type == 'header'
                ? $('#select_header').val()
                : $('#select_footer').val();

        if (identificator) {
            top.topModal({
                url: `${params.baseUrl}views/generador/editor_encabezado.php`,
                params: {
                    identificator: identificator
                },
                size: 'modal-xl',
                title: 'Editar contenido',
                buttons: {
                    success: {
                        label: 'Guardar',
                        class: 'btn btn-complete'
                    },
                    cancel: {
                        label: 'Cerrar',
                        class: 'btn btn-danger'
                    }
                },
                onSuccess: function(data) {
                    createHeaderFooterSelect();
                    top.closeTopModal();
                }
            });
        } else {
            top.notification({
                type: 'error',
                message: 'Debe seleccionar un item'
            });
        }
    });

    $('.add_header_footer').on('click', function() {
        let type = $(this).data('type');

        top.topModal({
            url: `${params.baseUrl}views/generador/editor_encabezado.php`,
            size: 'modal-xl',
            title: 'Crear contenido',
            buttons: {
                success: {
                    label: 'Guardar',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cerrar',
                    class: 'btn btn-danger'
                }
            },
            onSuccess: function(data) {
                createHeaderFooterSelect();
                top.closeTopModal();
            }
        });
    });

    $('#serie_idserie')
        .change(function() {
            $('.codigoSerie').each(function() {
                if ($(this).val() == $('#serie_idserie').val()) {
                    $('#codigoSerieInput').val($(this).attr('codigo'));
                }
            });
        })
        .trigger('change');

    $('[data-toggle="tooltip"]').tooltip();

    function createHeaderFooterSelect() {
        $.post(
            `${params.baseUrl}app/generador/consulta_encabezados.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                formatId: params.formatId
            },
            function(response) {
                if (response.success) {
                    $('#select_header,#select_footer').empty();
                    response.data.headers.forEach(item => {
                        $('#select_header,#select_footer').append(
                            $('<option>', {
                                value: item.id,
                                text: item.label
                            })
                        );
                    });

                    $('#select_header').val(response.data.header);
                    $('#select_footer').val(response.data.footer);
                    $('#select_header,#select_footer').select2();

                    showHeader();
                    showFooter();
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

    function showHeader() {
        if ($('#select_header').val()) {
            $.post(
                `${params.baseUrl}app/generador/obtener_contenido_encabezado.php`,
                {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    identificator: $('#select_header').val()
                },
                function(response) {
                    if (response.success) {
                        $('#header_content').html(response.data.content);
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
    }

    function showFooter() {
        if ($('#footer_content').val()) {
            $.post(
                `${params.baseUrl}app/generador/obtener_contenido_encabezado.php`,
                {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    identificator: $('#select_footer').val()
                },
                function(response) {
                    if (response.success) {
                        $('#footer_content').html(response.data.content);
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
    }

    function saveFormat() {
        if ($('#datos_formato').valid()) {
            let data =
                $('#datos_formato').serialize() +
                '&' +
                $.param({
                    token: localStorage.getItem('token'),
                    key: localStorage.getItem('key')
                });
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: `${params.baseUrl}app/generador/guardar_formato.php`,
                data: data,
                success: function(response) {
                    if (response.success) {
                        top.notification({
                            type: 'success',
                            message: response.message
                        });

                        if (!params.formatId) {
                            window.location.href =
                                window.location.pathname +
                                '?idformato=' +
                                response.data.formatId;
                        }
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        });
                    }
                }
            });
        } else {
            top.notification({
                type: 'warning',
                message: 'Debe diligenciar los campos obligatorios'
            });
            $('.error')
                .first()
                .focus();
            return false;
        }
    }

    function saveBody() {
        var content = CKEDITOR.instances['editor_mostrar'].getData();

        $.post(
            `${params.baseUrl}app/generador/actualizar_cuerpo_formato.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                content: content,
                formatId: params.formatId
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                    $('#tabs_formulario a[href="#pantalla_previa-tab"]').tab(
                        'show'
                    );
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

    function getPreview() {
        $.post(
            `${params.baseUrl}app/generador/obtener_vista_previa.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                formatId: params.formatId
            },
            function(response) {
                if (response.success) {
                    $('#preview_container').html(response.data);
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

    function findFunctions() {
        $.post(
            `${params.baseUrl}app/generador/listado_funciones_nucleo.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                formatId: params.formatId
            },
            function(response) {
                if (response.success) {
                    createFunctionList(response.data);
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

    function createFunctionList(data) {
        data.functions.forEach(f => {
            $('#funcion_list').append(
                $('<li>', {
                    id: 'function-' + f.idfunciones_nucleo,
                    'data-name': f.nombre_funcion,
                    text: f.etiqueta,
                    class: 'bg-master-lightest funcionesPropias'
                })
            );
        });

        $('#funcion_list').append(
            $('<li>', {
                class: 'bg-master-light',
                text: 'Listado de campos'
            })
        );

        data.fields.forEach(f => {
            $('#funcion_list').append(
                $('<li>', {
                    id: 'field-' + f.id,
                    'data-name': f.name,
                    text: f.label,
                    class: 'bg-master-lightest funcionesPropias'
                })
            );
        });
    }

    function setFormatData() {
        var formato = params.formato;

        if (formato) {
            CKEDITOR.replace('editor_mostrar');
            CKEDITOR.instances['editor_mostrar'].setData(formato.cuerpo);
            $('#etiqueta_formato').val(formato.etiqueta);
            $('#descripcion_formato').val(formato.descripcion_formato);
            $('#proceso_pertenece').val(formato.proceso_pertenece);
            $('#serie_id_serie').val(formato.serie_idserie);
            $('#version').val(formato.version);
            $('#librerias_formato').val(formato.librerias);
            $('#etiqueta_formato').val(formato.etiqueta);
            $('#ruta_formato').val(formato.ruta_formato);
            $('#ayuda_formato').val(formato.ayuda);
            $('#ruta_almacenamiento_formato').val(formato.ruta_almacenamiento);
            $('#idformato').val(formato.idformato);
            $('#tipo_formato_' + formato.tipo_formato).attr(
                'checked',
                'checked'
            );
            $('#versionar_' + formato.versionar).attr('checked', 'checked');
            $('#accion_eliminar_' + formato.accion_eliminar).attr(
                'checked',
                'checked'
            );
            if (formato.tipo_formato == 2) {
                $('#campos_formato').show();
            }
            $('#aprobacion_automatica_' + formato.aprobacion_automatica).attr(
                'checked',
                'checked'
            );
            $('#tabs_formulario a[href="#datos_formulario-tab"]').tab('show');
            $('#componentes_acciones').hide();
            $('.nav li').removeClass('disabled');

            var item = formato.item;
            var mostrar_pdf = formato.mostrar_pdf;
            if (item == 0 && mostrar_pdf == 0) {
                $('#tipo_registro').val(2);
                $('.tipo_edicion').hide();
            }
            if (item == 0 && mostrar_pdf == 1) {
                $('#tipo_registro').val(1);
                $('.tipo_edicion').show();
            }
            if (item == 1 && mostrar_pdf == 0) {
                $('#tipo_registro').val(3);
                $('.tipo_edicion').hide();
            }
        }
    }
});
