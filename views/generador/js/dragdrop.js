$(document).ready(function() {
    let params = $('#script_generador_pantalla').data('params');

    (function initDrag() {
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

                var parent = this.parentNode;

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
                ////////////////////// Guardar el orden de los campos en la tabla campos_formato ////////////////////////////

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
                    }
                    if (this.classList.contains('agregado')) {
                        eliminarComponente(this);
                    }
                    return;
                }

                var next = DragUtils.nextItem(this);
                var previous = DragUtils.previousItem(this);

                if (next == null && previous == null) {
                    if (this.classList.contains('panel')) {
                        var nuevo = this.cloneNode(true);
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
                        }
                    }
                }

                if (next == null && previous != null) {
                    if (!previous.classList.contains('panel')) {
                        if (this.classList.contains('panel')) {
                            var nuevo = this.cloneNode(true);
                            clonarComponente(this, nuevo);
                        }
                    }
                }

                if (next != null && previous == null) {
                    if (!next.classList.contains('panel')) {
                        if (this.classList.contains('panel')) {
                            var nuevo = this.cloneNode(true);
                            clonarComponente(this, nuevo);
                        }
                    }
                }

                //  $(next).position().top

                this.parentNode.onDragOut();
                this.style['top'] = '0px';
                this.style['left'] = '0px';

                if (nwPosition.y != posicionInicial.y) {
                    if (next != null) {
                        if (
                            next.getAttribute('idpantalla_campo') != nextInicial
                        ) {
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
                //////////////////////////////////////////// Duplicar componente cuando se arrastra al listado creado /////////////////////////////////////////////////////

                function clonarComponente(actual, nuevo) {
                    document
                        .getElementById('itemsComponentes')
                        .appendChild(nuevo);
                    nuevo.setAttribute('class', 'panel');
                    nuevo.style.top = '0px';
                    nuevo.style.left = '0px';
                    $(actual).append(
                        "<div class='eliminar' style='position:absolute;right:24px;top:20px;font-size:150%;cursor:pointer;' title='Eliminar componente'><i class='fa fa-trash'></i></div>"
                    );
                    DragDrop.makeItemDragable(nuevo);
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

                //////////////////////////////////////////////  Eliminar Componente arrastrando afuera //////////////////////////////////////////
                function eliminarComponente(componente) {
                    let filesInstance = componente;
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
                                        dataType: 'json',
                                        type: 'POST',
                                        data: {
                                            componente: $(filesInstance).attr(
                                                'idpantalla_campo'
                                            ),
                                            token: localStorage.getItem(
                                                'token'
                                            ),
                                            key: localStorage.getItem('key')
                                        },
                                        success: function(respuesta) {
                                            instance.hide(
                                                { transitionOut: 'fadeOut' },
                                                toast,
                                                'button'
                                            );
                                        }
                                    });
                                },
                                true
                            ],
                            [
                                '<button>NO</button>',
                                function(instance, toast) {
                                    var nuevo = filesInstance.cloneNode(true);
                                    document
                                        .getElementById('contenedorComponentes')
                                        .appendChild(nuevo);
                                    nuevo.setAttribute('class', 'agregado');
                                    nuevo.style.top = '0px';
                                    nuevo.style.left = '0px';
                                    DragDrop.makeItemDragable(nuevo);

                                    instance.hide(
                                        { transitionOut: 'fadeOut' },
                                        toast,
                                        'button'
                                    );
                                }
                            ]
                        ]
                    });
                }
                /////////////////////////////////////////////// Actualizar el orden de los componentes   ////////////////////////////////////////////////////

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
    })();

    //////////////////////////////// Clic para llamar modal y editar componente ////////////////////////////////////////////
    $('#contenedorComponentes').on('click', 'li', function() {
        top.topModal({
            url: `${params.baseUrl}views/generador/editar_componente_generico.php`,
            params: {
                idformato: $('#idformato').val(),
                idpantalla_campos: $(this).attr('idpantalla_campo'),
                idpantalla_componente: $(this).attr('idpantalla_componente')
            },
            size: 'modal-xl',
            title: 'Configurar campo',
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
                top.closeTopModal();
            }
        });
    });

    function successEditarComponente() {
        console.log('Edicion');
    }

    //Eliminar componente
    $('#contenedorComponentes').on('click', '.agregado .eliminar', function(
        event
    ) {
        event.stopPropagation();
        eliminarComponente(this);
    });

    //////////////////////////////////////////////////////// Eliminar componente desde boton eliminar ////////////////////////////////////////////
    function eliminarComponente(componente) {
        let filesInstance = componente;
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
                                componente: $(filesInstance)
                                    .parents('.agregado')
                                    .attr('idpantalla_campo'),
                                token: localStorage.getItem('token'),
                                key: localStorage.getItem('key')
                            },
                            success: function(respuesta) {
                                if (
                                    $(filesInstance)
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
    }
});
