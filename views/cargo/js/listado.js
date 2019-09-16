$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    $('#table_container').height(
        $(window).height() - $('#table_container').offset().top - 20
    );

    $('#treegrid').fancytree({
        extensions: ['filter', 'table'],
        icon: false,
        table: {
            indentation: 20, // indent 20px per node level
            nodeColumnIdx: 1, // render the node title into the 2nd column
            checkboxColumnIdx: 0 // render the checkboxes into the 1st column
        },
        source: {
            url: `${baseUrl}app/arbol/arbol_cargo.php`,
            data: {
                expandir: 1,
                checkbox: null,
                fields: ['codigo_cargo', 'nombre', 'tipo_cargo', 'estado']
            }
        },
        filter: {
            autoApply: true, // Re-apply last filter if lazy data is loaded
            autoExpand: true, // Expand all branches that contain matches while filtered
            counter: true, // Show a badge with number of matching child nodes near parent icons
            fuzzy: false, // Match single characters in order, e.g. 'fb' will match 'FooBar'
            hideExpandedCounter: true, // Hide counter badge if parent is expanded
            hideExpanders: false, // Hide expanders if all child nodes are hidden by filter
            highlight: true, // Highlight matches by wrapping inside <mark> tags
            leavesOnly: false, // Match end nodes only
            nodata: true, // Display a 'no data' status node if result is empty
            mode: 'hide' // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
        },
        renderColumns: function(event, data) {
            var node = data.node,
                $tdList = $(node.tr).find('>td');

            $tdList.eq(0).text(node.data.codigo_cargo);
            $tdList
                .eq(2)
                .text(
                    node.data.tipo_cargo == 1 ? 'Administrativo' : 'Funcional'
                );
            $tdList.eq(3).text(node.data.estado == 1 ? 'Activo' : 'Inactivo');
            $tdList.eq(4).html(`<div class="dropdown">
                <button class="btn bg-institutional mx-1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v fa-2x"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                    <a href="#" class="dropdown-item add" data-id="${node.key}">
                        <i class="fa fa-plus"></i> Nuevo
                    </a>
                    <a href="#" class="dropdown-item edit" data-id="${
                        node.key
                    }">
                        <i class="fa fa-edit"></i> Editar
                    </a>
                    <a href="#" class="dropdown-item add_function" data-id="${
                        node.key
                    }">
                        <i class="fa fa-cogs"></i> Funciones
                    </a>
                </div>
            </div>`);
        }
    });

    let tree = $('#treegrid').fancytree('getTree');
    $('#search').keyup(function(e) {
        tree.filterNodes.call(tree, $(this).val());
    });

    $(document)
        .off('click', '.add,.edit')
        .on('click', '.add,.edit', function() {
            var data = new Object();

            if ($(this).hasClass('add')) {
                data.parent = $(this).data('id');
            } else {
                data.id = $(this).data('id');
            }

            top.topModal({
                url: `${baseUrl}views/cargo/formulario.php`,
                params: data,
                size: 'modal-lg',
                title: 'Cargo',
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
                onSuccess: function() {
                    top.closeTopModal();
                    let tree = $('#treegrid').fancytree('getTree');
                    tree.reload();
                }
            });
        });

    $(document)
        .off('click', '.add_function')
        .on('click', '.add_function', function() {
            top.topModal({
                url: `${baseUrl}views/funciones/listado_cargo.php`,
                params: {
                    position: $(this).data('id')
                },
                size: 'modal-lg',
                title: 'Listado de funciones',
                buttons: {}
            });
        });
});
