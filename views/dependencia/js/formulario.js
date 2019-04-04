$(function () {
    let params = $('#area_script').data('params');
    let baseUrl = params.baseUrl;
    let myDropzone = null;

    (function init() {
        createFileInput();
        $('#type_select').select2();

        if (params.id) {
            findData(params.id);
        } else {
            createTree(params.parent);
        }
    })();

    $('#btn_success').on('click', function () {
        $('#area_form').trigger('submit');
    });

    function findData(id) {
        $.post(`${params.baseUrl}app/dependencia/consulta_datos.php`, {
            key: localStorage.getItem('key'),
            id: id
        }, function (response) {
            if (response.success) {
                fillForm(response.data);
            } else {
                top.notification({
                    type: 'error',
                    message: response.message
                });
            }
        }, 'json');
    }

    function fillForm(data) {
        for (let attribute in data) {
            let e = $(`[name='${attribute}']`);
            if (e.length && attribute != 'estado' && attribute != 'logo') {
                e.val(data[attribute]).trigger('change');
            } else if (attribute == 'estado') {
                $(`[name='estado'][value=${data.estado}]`).prop('checked', true);
            } else if (attribute == 'logo') {
                $(`[name='logo']`).val(data.logo.route);
                setImage(data.logo);
            }
        }

        createTree(data.cod_padre, [data.key]);
    }

    function createTree(parentId, unSelectables = []) {
        $('#areas_tree').fancytree({
            icon: false,
            checkbox: true,
            selectMode: 1,
            source: {
                url: `${baseUrl}arboles/arbol_dependencia.php`,
                data: {
                    expandir: 1,
                    unSelectables: unSelectables
                },
            },
            init: function () {
                if (parentId) {
                    let tree = $('#areas_tree').fancytree("getTree");
                    let node = tree.getNodeByKey(parentId);
                    node.setSelected(true);
                    $("[name='cod_padre'").val(parentId);
                }
            },
            click: function (event, data) {
                $("[name='cod_padre'").val(data.node.key);
            }
        });
    }

    function createFileInput() {
        $("#file").addClass("dropzone");
        myDropzone = new Dropzone("#file", {
            url: `${baseUrl}app/temporal/cargar_anexos.php`,
            dictDefaultMessage:
                "Haga clic para elegir un archivo o Arrastre acá el archivo.",
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar anexo',
            maxFilesize: 3,
            maxFiles: 1,
            dictFileTooBig: "Tamaño máximo {{maxFilesize}} MB",
            dictMaxFilesExceeded: "Máximo 1 archivo",
            params: {
                key: localStorage.getItem("key"),
                dir: "dependencia"
            },
            paramName: "file",
            init: function () {
                this.on("success", function (file, response) {
                    response = JSON.parse(response);

                    if (response.success) {
                        $('[name="logo"]').val(response.data[0]);
                    } else {
                        top.notification({
                            type: "error",
                            message: response.message
                        });
                    }
                });
            }
        });
    }

    function setImage(mockFile) {
        myDropzone.removeAllFiles();
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, baseUrl + mockFile.route);
        myDropzone.emit("complete", mockFile);
    }
});

$("#area_form").validate({
    ignore: '',
    rules: {
        codigo: {
            required: true
        },
        nombre: {
            required: true
        },
        cod_padre: {
            required: true
        },
        tipo: {
            required: true
        },
    },
    messages: {
        codigo: {
            required: "Campo requerido"
        },
        nombre: {
            required: "Campo requerido"
        },
        cod_padre: {
            required: "Debe seleccionar una dependencia"
        },
        tipo: {
            required: "Debe seleccionar un tipo"
        }
    },
    errorPlacement: function (error, element) {
        let node = element[0];

        if (
            node.tagName == "SELECT" &&
            node.className.indexOf("select2") !== false
        ) {
            error.addClass("pl-3");
            element.next().append(error);
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {
        let params = $("#area_script").data('params');
        let data = $("#area_form").serialize();
        data = data + '&' + $.param({
            key: localStorage.getItem("key"),
            id: params.id
        });

        $.post(
            `${params.baseUrl}app/dependencia/adicionar.php`,
            data,
            function (response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: "success"
                    });
                    top.successModalEvent();
                } else {
                    top.notification({
                        message: response.message,
                        type: "error",
                        title: "Error!"
                    });
                }
            },
            "json"
        );
    }
});
