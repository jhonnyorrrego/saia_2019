$(document).ready(function() {
    let params = $('#script_generador_pantalla').data('params');
    let step = 1;
    var idpantalla_campo = 0;
    var posicionInicial;
    var nextInicial;
    var DragDrop = {
        firstContainer: null,
        lastContainer: null,
        makeListContainer: function(list) {
            // each container becomes a linked list node
            if (this.firstContainer == null) {
                this.firstContainer = this.lastContainer = list;
                list.previousContainer = null;
                list.nextContainer = null;
            } else {
                list.previousContainer = this.lastContainer;
                list.nextContainer = null;
                this.lastContainer.nextContainer = list;
                this.lastContainer = list;
            }

            // these functions are called when an item is draged over
            // a container or out of a container bounds.  onDragOut
            // is also called when the drag ends with an item having
            // been added to the container
            list.onDragOver = new Function();
            list.onDragOut = new Function();

            var items = list.getElementsByTagName('li');

            for (var i = 0; i < items.length; i++) {
                DragDrop.makeItemDragable(items[i]);
            }
        },
        makeItemDragable: function(item) {
            Drag.makeDraggable(item);
            item.setDragThreshold(5);

            // tracks if the item is currently outside all containers
            item.isOutside = false;

            item.onDragStart = DragDrop.onDragStart;
            item.onDrag = DragDrop.onDrag;
            item.onDragEnd = DragDrop.onDragEnd;
        },
        onDragStart: function(nwPosition, sePosition, nwOffset, seOffset) {
            // update all container bounds, since they may have changed
            // on a previous drag
            //
            // could be more smart about when to do this

            var container = DragDrop.firstContainer;
            while (container != null) {
                container.northwest = Coordinates.northwestOffset(
                    container,
                    true
                );
                container.southeast = Coordinates.southeastOffset(
                    container,
                    true
                );
                container = container.nextContainer;
            }

            // item starts out over current parent

            posicionInicial = nwPosition;

            var next = DragUtils.nextItem(this);
            if (next != null) {
                nextInicial = next.getAttribute('idpantalla_campo');
            } else {
                nextInicial = 0;
            }

            this.parentNode.onDragOver();
        },
        onDrag: function(nwPosition, sePosition, nwOffset, seOffset) {
            // check if we were nowhere
            if (this.isOutside) {
                // check each container to see if in its bounds
                var container = DragDrop.firstContainer;
                while (container != null) {
                    if (
                        nwOffset.inside(
                            container.northwest,
                            container.southeast
                        ) ||
                        seOffset.inside(
                            container.northwest,
                            container.southeast
                        )
                    ) {
                        // we're inside this one
                        container.onDragOver();
                        this.isOutside = false;

                        // since isOutside was true, the current parent is a
                        // temporary clone of some previous container node and
                        // it needs to be removed from the document
                        var tempParent = this.parentNode;
                        tempParent.removeChild(this);
                        container.appendChild(this);
                        tempParent.parentNode.removeChild(tempParent);
                        break;
                    }
                    container = container.nextContainer;
                }
                // we're still not inside the bounds of any container
                if (this.isOutside) return;

                // check if we're outside our parent's bounds
            } else if (
                !(
                    nwOffset.inside(
                        this.parentNode.northwest,
                        this.parentNode.southeast
                    ) ||
                    seOffset.inside(
                        this.parentNode.northwest,
                        this.parentNode.southeast
                    )
                )
            ) {
                this.parentNode.onDragOut();
                this.isOutside = true;

                // check if we're inside a new container's bounds
                var container = DragDrop.firstContainer;
                while (container != null) {
                    if (
                        nwOffset.inside(
                            container.northwest,
                            container.southeast
                        ) ||
                        seOffset.inside(
                            container.northwest,
                            container.southeast
                        )
                    ) {
                        // we're inside this one
                        container.onDragOver();
                        this.isOutside = false;
                        this.parentNode.removeChild(this);
                        container.appendChild(this);
                        break;
                    }
                    container = container.nextContainer;
                }
                // if we're not in any container now, make a temporary clone of
                // the previous container node and add it to the document
                if (this.isOutside) {
                    var tempParent = this.parentNode.cloneNode(false);
                    this.parentNode.removeChild(this);
                    tempParent.appendChild(this);
                    document
                        .getElementsByTagName('body')
                        .item(0)
                        .appendChild(tempParent);
                    return;
                }
            }

            // if we get here, we're inside some container bounds, so we do
            // everything the original dragsort script did to swap us into the
            // correct position

            var item = this;
            var next = DragUtils.nextItem(item);
            while (next != null && this.offsetTop >= next.offsetTop - 2) {
                var item = next;
                var next = DragUtils.nextItem(item);
            }
            if (this != item) {
                DragUtils.swap(this, next);
                return;
            }

            var item = this;
            var previous = DragUtils.previousItem(item);
            while (
                previous != null &&
                this.offsetTop <= previous.offsetTop + 2
            ) {
                var item = previous;
                var previous = DragUtils.previousItem(item);
            }
            if (this != item) {
                DragUtils.swap(this, item);
                return;
            }
        },
        onDragEnd: function(nwPosition, sePosition, nwOffset, seOffset) {
            if (this.isOutside) {
                tempParent = this.parentNode;
                this.parentNode.removeChild(this);
                tempParent.parentNode.removeChild(tempParent);

                if (this.classList.contains('panel')) {
                    var nuevo = this.cloneNode(true);
                    document
                        .getElementById('itemsComponentes')
                        .appendChild(nuevo);
                    nuevo.setAttribute('class', 'panel');
                    nuevo.style.top = '0px';
                    nuevo.style.left = '0px';
                    DragDrop.makeItemDragable(nuevo);
                    cargarComponentes();
                }

                return;
            }

            var next = DragUtils.nextItem(this);
            var previous = DragUtils.previousItem(this);

            if (next == null && previous == null) {
                if (this.classList.contains('panel')) {
                    var nuevo = this.cloneNode(true);
                    cargarComponentes();
                    clonarComponente(this, nuevo);
                }
            }

            if (next != null && previous != null) {
                if (
                    !next.classList.contains('panel') ||
                    !previous.classList.contains('panel')
                ) {
                    if (this.classList.contains('panel')) {
                        var nuevo = this.cloneNode(true);
                        cargarComponentes();
                        clonarComponente(this, nuevo);
                    }
                }

                if (
                    next.classList.contains('panel') ||
                    previous.classList.contains('panel')
                ) {
                    if (this.classList.contains('agregado')) {
                        this.parentNode.removeChild(this);
                        return;
                    } else {
                        cargarComponentes();
                    }
                }
            }

            if (next == null && previous != null) {
                if (!previous.classList.contains('panel')) {
                    if (this.classList.contains('panel')) {
                        var nuevo = this.cloneNode(true);
                        clonarComponente(this, nuevo);
                    }
                } else {
                    cargarComponentes();
                }
            }

            if (next != null && previous == null) {
                if (!next.classList.contains('panel')) {
                    if (this.classList.contains('panel')) {
                        var nuevo = this.cloneNode(true);
                        clonarComponente(this, nuevo);
                    }
                } else {
                    cargarComponentes();
                }
            }

            this.parentNode.onDragOut();
            this.style['top'] = '0px';
            this.style['left'] = '0px';

            if (nwPosition.y != posicionInicial.y) {
                if (next != null) {
                    if (next.getAttribute('idpantalla_campo') != nextInicial) {
                        if (this.classList.contains('agregado')) {
                            actualizarOrdenComponente();
                        }
                    }
                } else {
                    if (nextInicial != 0) {
                        if (this.classList.contains('agregado')) {
                            actualizarOrdenComponente();
                        }
                    }
                }
            }

            findFunctions();
            //////////////////////////////////////////// Duplicar componente cuando se arrastra al listado creado /////////////////////////////////////////////////////

            function clonarComponente(actual, nuevo) {
                document.getElementById('itemsComponentes').appendChild(nuevo);
                nuevo.setAttribute('class', 'panel');
                nuevo.style.top = '0px';
                nuevo.style.left = '0px';
                $(actual).append(
                    "<div class='eliminar' style='position:absolute;right:24px;top:20px;font-size:150%;cursor:pointer;' title='Eliminar componente'><i class='fa fa-trash'></i></div>"
                );
                DragDrop.makeItemDragable(nuevo);
                cargarComponentes();
                obtenerComponente(actual);
            }

            function obtenerComponente(componente) {
                $.ajax({
                    url: `${params.baseUrl}app/generador/guardar_campo_formato.php`,
                    dataType: 'json',
                    type: 'POST',
                    data: {
                        idpantalla_componente: componente.getAttribute(
                            'idpantalla_componente'
                        ),
                        idFormato: params.formatId,
                        token: localStorage.getItem('token'),
                        key: localStorage.getItem('key')
                    },
                    success: function(respuesta) {
                        if (respuesta.success == 1) {
                            componente.setAttribute(
                                'idpantalla_campo',
                                respuesta.data
                            );
                            componente.setAttribute('class', 'agregado');
                            $('#c_').attr('id', 'c_' + respuesta.data);
                            actualizarOrdenComponente();
                        } else {
                            componente.parentNode.removeChild(componente);
                        }
                    }
                });

                if (componente.hasAttribute('idpantalla_campo')) {
                    retorno = 1;
                }
            }

            // Actualizar el orden de los componentes
            function actualizarOrdenComponente() {
                var listado = [];

                var contenedor = document.getElementById(
                    'contenedorComponentes'
                );
                var componentes = contenedor.getElementsByTagName('li');

                for (var i = 0; i < componentes.length; i++) {
                    listado.push(
                        componentes[i].getAttribute('idpantalla_campo')
                    );
                }

                $.post(
                    `${params.baseUrl}app/generador/ordenar_campos_formato.php`,
                    {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        ordenComponentes: listado
                    },
                    function(response) {
                        if (!response.success) {
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
    };
    var DragUtils = {
        swap: function(item1, item2) {
            var parent = item1.parentNode;
            parent.removeChild(item1);
            parent.insertBefore(item1, item2);

            item1.style['top'] = '0px';
            item1.style['left'] = '0px';
        },

        nextItem: function(item) {
            var sibling = item.nextSibling;
            while (sibling != null) {
                if (sibling.nodeName == item.nodeName) return sibling;
                sibling = sibling.nextSibling;
            }
            return null;
        },

        previousItem: function(item) {
            var sibling = item.previousSibling;
            while (sibling != null) {
                if (sibling.nodeName == item.nodeName) return sibling;
                sibling = sibling.previousSibling;
            }
            return null;
        }
    };

    (function init() {
        $(
            '#serie_idserie,#tipo_registro,#contador_idcontador,#papel,#font_size'
        ).select2();

        if (params.formatId) {
            setFormatData();
            createHeaderFooterSelect();
            findFunctions();

            var list = document.getElementById('contenedorComponentes');
            DragDrop.makeListContainer(list);
            list.onDragOver = function() {
                this.style['background'] = '#EEF';
            };
            list.onDragOut = function() {
                this.style['background'] = '#eee';
            };
            list = document.getElementById('itemsComponentes');
            DragDrop.makeListContainer(list);
            list.onDragOver = function() {
                this.style['border'] = '1px dashed #AAA';
            };
            list.onDragOut = function() {
                this.style['border'] = '1px solid white';
            };

            cargarComponentes();
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
                    if (type == 'header') {
                        $('#header_content').empty();
                    } else {
                        $('#footer_content').empty();
                    }

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
                url: `views/generador/editor_encabezado.php`,
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
            url: `views/generador/crear_encabezado_pie.php`,
            size: 'modal-xl',
            title: 'Crear contenido',
            params: { idformato: params.formatId, type: type },
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

    $('#contenedorComponentes').on('click', 'li', function() {
        idpantalla_campo = $(this).attr('idpantalla_campo');
        var idpantalla_componente = $(this).attr('idpantalla_componente');
        top.topJsPanel({
            header: false,
            contentSize: {
                width: 900,
                height: 600
            },
            content:
                '<iframe src="' +
                `${params.baseUrl}views/generador/editar_componente_generico.php?fieldId=${idpantalla_campo}&idpantalla_componente=${idpantalla_componente}` +
                '" style="width: 100%; height: 100%; border:none;"></iframe>',
            callback: function() {
                idPanel = this.getAttribute('id');
            },
            onbeforeclose: function() {
                if (this.getAttribute('respuesta') != null) {
                    if (
                        idpantalla_componente != 13 &&
                        idpantalla_componente != 14 &&
                        idpantalla_componente != 15
                    ) {
                        $('#c_' + idpantalla_campo).html(
                            this.getAttribute('respuesta')
                        );
                    }
                }
                return 'close';
            }
        });
    });

    //Eliminar componente
    $('#contenedorComponentes').on('click', '.agregado .eliminar', function(
        event
    ) {
        event.stopPropagation();
        top.confirm({
            id: 'question',
            type: 'error',
            title: 'Eliminar Componente!',
            message: 'Está seguro de realizar esta acción',
            position: 'center',
            timeout: 0,
            buttons: [
                [
                    '<button><b>Si</b></button>',
                    function(instance, toast) {
                        $.ajax({
                            url: `${params.baseUrl}app/generador/eliminar_campo_formato.php`,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                componente: $(this)
                                    .parents('.agregado')
                                    .attr('idpantalla_campo'),
                                token: localStorage.getItem('token'),
                                key: localStorage.getItem('key')
                            },
                            success: function(respuesta) {
                                if (
                                    $(this)
                                        .parents('.agregado')
                                        .remove()
                                ) {
                                    instance.hide(
                                        { transitionOut: 'fadeOut' },
                                        toast,
                                        'button'
                                    );
                                }
                            }
                        });
                    },
                    true
                ],
                [
                    '<button>NO</button>',
                    function(instance, toast) {
                        instance.hide(
                            { transitionOut: 'fadeOut' },
                            toast,
                            'button'
                        );
                    }
                ]
            ]
        });
    });

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
        if ($('#select_footer').val()) {
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
        $('#funcion_list').append(
            $('<h5>', {
                class: 'bg-master-light pl-4',
                id: 'tituloListado',
                text: 'Funciones de núcleo'
            })
        );
        data.functions.forEach(f => {
            $('#funcion_list').append(
                $('<li>', {
                    id: 'function-' + f.idfunciones_nucleo,
                    'data-name': f.nombre_funcion,
                    html:
                        '<i class="fa ' +
                        f.imagen +
                        ' mr-3"></i><div class="d-inline">' +
                        f.etiqueta +
                        '</div>',
                    class: 'bg-master-lightest funcionesPropias pl-3'
                })
            );
        });

        $('#funcion_list').append(
            $('<h5>', {
                class: 'bg-master-light pl-4',
                id: 'tituloListado',
                text: 'Listado de campos'
            })
        );

        data.fields.forEach(f => {
            $('#funcion_list').append(
                $('<li>', {
                    id: 'field-' + f.id,
                    'data-name': f.name,
                    html:
                        '<i class="fa ' +
                        f.imagen +
                        ' mr-3" ></i><div class="d-inline">' +
                        f.label +
                        '</div>',
                    class: 'bg-master-lightest funcionesPropias pl-3'
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
    function cargarComponentes() {
        var listado = [];

        var contenedor = document.getElementById('itemsComponentes');
        var componentes = contenedor.getElementsByTagName('li');

        for (var i = 0; i < componentes.length; i++) {
            listado.push(componentes[i].getAttribute('idpantalla_componente'));
        }
        $.post(
            `${params.baseUrl}app/generador/cargar_campos_formato.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                ordenComponentes: listado
            },
            function(response) {
                if (!response.success) {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                } else {
                    $('#itemsComponentes').empty();
                    $('#itemsComponentes').html(response.data);
                    list = document.getElementById('itemsComponentes');
                    var items = list.getElementsByTagName('li');
                    for (var i = 0; i < items.length; i++) {
                        DragDrop.makeItemDragable(items[i]);
                    }
                }
            },
            'json'
        );
    }
});
