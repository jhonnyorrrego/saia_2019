$(function () {
    var params = $("#script_documents").data('documents');
    $("#script_documents").removeAttr('data-documents');
    var sessionVars = {
        key: localStorage.getItem('key'),
        token: localStorage.getItem('token'),
        documentId: params.documentId
    };

    $("#document").select2({
        minimumInputLength: 2,
        language: "es",
        placeholder: "Buscar documento",
        ajax: {
            url: `${params.baseUrl}app/documento/autocompletar.php`,
            dataType: "json",
            data: function (params) {
                return {
                    query: params.term,
                    key: localStorage.getItem("key"),
                    token: localStorage.getItem("token"),
                    all: 1
                };
            },
            processResults: function (response) {
                return response.success ? { results: response.data } : {};
            }
        }
    });

    $('#document').on('select2:select', function (e) {
        var data = e.params.data;
        addRelation(data.id);
        $('#document').val(null).trigger('change');
    });

    $(document).off('click', '.unlink').on('click', '.unlink', function () {
        $.post(`${params.baseUrl}app/documento/desvincular_documento.php`, {
            key: localStorage.getItem('key'),
            token: localStorage.getItem('token'),
            documentId: params.documentId,
            relation: $(this).data('id')
        }, function (response) {
            if (response.success) {
                $('#linked_list').bootstrapTable('refresh');
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
        }, 'json');
    });

    $('#linked_list').bootstrapTable({
        url: `${params.baseUrl}app/documento/vinculados.php`,
        queryParams: function (queryParams) {
            queryParams = $.extend(queryParams, sessionVars);
            return queryParams;
        },
        columns: [
            {
                field: 'numero',
                title: 'numero',
                align: 'center'
            },
            {
                field: 'fecha',
                title: 'fecha',
                align: 'center'
            },
            {
                field: 'asunto',
                title: 'asunto'
            },
            {
                field: 'responsable',
                title: 'responsable'
            },
            {
                field: 'tipo',
                title: 'tipo'
            },
            {
                field: 'clase',
                title: 'clase',
                align: 'center'
            },
            {
                field: "options",
                title: "",
                align: "center",
                formatter: desvincular
            }
        ],
        classes: "table table-hover mt-0",
        theadClasses: "thead-light text-center",
        onClickCell: function (field, value, row, $element) {
            showDocument(row.id);
        }
    });

    $('#responses_list').bootstrapTable({
        url: `${params.baseUrl}app/documento/respuestas.php`,
        queryParams: function (queryParams) {
            queryParams = $.extend(queryParams, sessionVars);
            return queryParams;
        },
        columns: [
            {
                field: 'numero',
                title: 'numero',
                align: 'center'
            },
            {
                field: 'fecha',
                title: 'fecha',
                align: 'center'
            },
            {
                field: 'asunto',
                title: 'asunto'
            },
            {
                field: 'responsable',
                title: 'responsable'
            },
            {
                field: 'tipo',
                title: 'tipo'
            },
            {
                field: 'clase',
                title: 'clase',
                align: 'center'
            }
        ],
        classes: "table table-hover mt-0",
        theadClasses: "thead-light text-center",
        onClickCell: function (field, value, row, $element) {
            showDocument(row.id);
        }
    });

    function showDocument(documentId) {
        let iframe = $('<iframe>', {
            src: `${params.baseUrl}views/documento/index_acordeon.php?documentId=${documentId}`
        }).css({
            width: '100%',
            height: '100%',
            border: 'none',
        });

        jsPanel.ziBase = 10000;
        jsPanel.create({
            headerTitle: 'Documento',
            iconfont: 'fa',
            theme: 'dark',
            contentOverflow: 'hidden',
            position: {
                my: "center-top",
                at: "center-top"
            },
            contentSize: {
                width: $(window).width() * 0.8,
                height: $(window).height() * 0.9,
            },
            content: iframe.prop('outerHTML')
        });
    }

    function desvincular(e, row) {
        return `<span data-id="${row.id}" class="unlink fa fa-unlink cursor f-20"></span>`;
    }

    function addRelation(documentId) {
        $.post(`${params.baseUrl}app/documento/vincular_documento.php`, {
            key: localStorage.getItem('key'),
            token: localStorage.getItem('token'),
            documentId: params.documentId,
            relation: documentId
        }, function (response) {
            if (response.success) {
                $('#linked_list').bootstrapTable('refresh');
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
        }, 'json');
    }
});