$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    $("#treegrid").fancytree({
        extensions: ["filter", "table"],
        icon: false,
        table: {
            indentation: 20,      // indent 20px per node level
            nodeColumnIdx: 2,     // render the node title into the 2nd column
            checkboxColumnIdx: 0  // render the checkboxes into the 1st column
        },
        source: {
            url: `${baseUrl}arboles/arbol_dependencia.php`,
            data: {
                expandir: 1,
                checkbox: null,
                fields: ['codigo', 'nombre', 'estado', 'logo']
            }
        },
        filter: {
            autoApply: true,   // Re-apply last filter if lazy data is loaded
            autoExpand: true, // Expand all branches that contain matches while filtered
            counter: true,     // Show a badge with number of matching child nodes near parent icons
            fuzzy: false,      // Match single characters in order, e.g. 'fb' will match 'FooBar'
            hideExpandedCounter: true,  // Hide counter badge if parent is expanded
            hideExpanders: false,       // Hide expanders if all child nodes are hidden by filter
            highlight: true,   // Highlight matches by wrapping inside <mark> tags
            leavesOnly: false, // Match end nodes only
            nodata: true,      // Display a 'no data' status node if result is empty
            mode: "hide",      // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
        },
        renderColumns: function(event, data) {

            var node = data.node,
                $tdList = $(node.tr).find(">td");
            
            $tdList.eq(0).text(node.data.codigo);
            $tdList.eq(1).text(node.data.logo);            
            $tdList.eq(3).text(node.data.estado ? 'Activo' : 'Inactivo');
            $tdList.eq(4).html(`<div class="dropdown d-lg-inline-block d-none">
            <button class="btn bg-institutional mx-1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-plus"></i> Nuevo
            </button>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="#" class="dropdown-item new_add" data-type="folder">
                    <i class="fa fa-folder-open"></i> Expediente
                </a>                
            </div>
        </div>`);
          }
    });
});