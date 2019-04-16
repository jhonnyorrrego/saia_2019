$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    (function init() {
        $('#table_container').height($(window).height() - $('#table_container').offset().top - 20);
        findProfileOptions();
    })();

    $("#treegrid").fancytree({
        extensions: ["filter", "table"],
        icon: false,
        table: {
            indentation: 20,      // indent 20px per node level
        },
        source: {
            url: `${baseUrl}arboles/arbol_modulos.php`
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
        renderColumns: function (event, data) {
            var node = data.node,
                $tdList = $(node.tr).find(">td");

            $tdList.eq(1).html($('<input>', {
                type: 'checkbox',
                dataId: node.key,
                checked: node.selected
            }));
        }
    });

    let tree = $("#treegrid").fancytree("getTree");
    $("#search").keyup(function (e) {
        tree.filterNodes.call(tree, $(this).val());
    });

    $(document).on('click', ':checkbox', function () {
        addPermission($(this).data('id'), $(this).is('checked'));
    });

    $('#profile').on('select2:select', function () {
        $("#treegrid").fancytree('option', 'source', {
            url: `${baseUrl}arboles/arbol_modulos.php`,
            data: {
                profile: $(this).val()
            }
        });
    });

    function addPermission(moduleId, add) {
        $.post(`${baseUrl}app/modulo/permiso_perfil.php`, {
            key: localStorage.getItem('key'),
            token: localStorage.getItem('token'),
            module: moduleId,
            add: add
        }, function (response) {
            if (response.success) {
                if (response.data) {
                    showModal()
                } else {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                }
            } else {
                top.notification({
                    type: 'error',
                    message: response.message
                });
            }
        }, 'json');
    }

    function showModal(moduleId) {
        top.confirm({
            id: "question",
            type: "info",
            message: "Habilitar creación del formato",
            position: "center",
            timeout: 0,
            buttons: [
                [
                    "<button><b>Si</b></button>",
                    function (instance, toast) {
                        addPermission(moduleId, true);
                        instance.hide(
                            { transitionOut: "fadeOut" },
                            toast,
                            "button"
                        );
                    },
                    true
                ],
                [
                    "<button>NO</button>",
                    function (instance, toast) {
                        addPermission(moduleId, false);
                        instance.hide(
                            { transitionOut: "fadeOut" },
                            toast,
                            "button"
                        );
                    }
                ]
            ]
        });
    }

    function findProfileOptions() {
        $.post(
            `${baseUrl}app/funcionario/consulta_perfiles.php`,
            {
                key: localStorage.getItem("key")
            },
            function (response) {
                if (response.success) {
                    response.data.forEach(element => {
                        $("#profile").append(
                            $("<option>", {
                                value: element.idperfil,
                                text: element.nombre
                            })
                        );
                    });
                    $("#profile").select2();
                }
            },
            "json"
        );
    }
});