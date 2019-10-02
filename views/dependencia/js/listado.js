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
            nodeColumnIdx: 2, // render the node title into the 2nd column
            checkboxColumnIdx: 0 // render the checkboxes into the 1st column
        },
        source: {
            url: `${baseUrl}app/arbol/arbol_dependencia.php`,
            data: {
                expandir: 1,
                checkbox: null,
                fields: [
                    'codigo',
                    'nombre',
                    'sigla',
                    'estado',
                    'logo',
                    'extension',
                    'ubicacion_dependencia',
                    'descripcion'
                ]
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

            let image = !node.data.logo
                ? ''
                : $('<img>', {
                      src: baseUrl + node.data.logo,
                      width: '100'
                  });

            $tdList.eq(0).text(node.data.codigo);
            $tdList.eq(1).html(image);
            $tdList.eq(3).text(node.data.sigla);
            $tdList.eq(4).text(node.data.estado ? 'Activo' : 'Inactivo');
            $tdList.eq(5).text(node.data.extension);
            $tdList.eq(6).text(node.data.ubicacion_dependencia);
            $tdList.eq(7).text(node.data.descripcion);
            $tdList.eq(8).html(`<div class="dropdown">
                <button class="btn bg-institutional mx-1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v fa-2x"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                    <a href="#" class="dropdown-item add" data-id="${node.key}">
                        <i class="fa fa-plus"></i> Nuevo
                    </a>
                    <a href="#" class="dropdown-item edit" data-id="${node.key}">
                        <i class="fa fa-edit"></i> Editar
                    </a>
                </div>
            </div>`);
        }
    });

    let tree = $('#treegrid').fancytree('getTree');
    $('#search').keyup(function(e) {
        tree.filterNodes.call(tree, $(this).val());
    });

    $(document).on('click', '.add,.edit', function() {
        var data = new Object();

        if ($(this).hasClass('add')) {
            data.parent = $(this).data('id');
        } else {
            data.id = $(this).data('id');
        }

        top.topModal({
            url: `views/dependencia/formulario.php`,
            params: data,
            size: 'modal-lg',
            title: data.id ? 'Editar Dependencia' : 'Adicionar Dependencia',
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
});
