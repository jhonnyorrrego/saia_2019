$(function () {
    let params = $('#scriptGrillaTrdTemp').data('params');
    $('#scriptGrillaTrdTemp').removeAttr('data-params');

    (function init() {
        createTable();
        modalAddEdit();
    })();


    function modalAddEdit() {

        $('#btn_add').on('click', function () {
            top.topModal({
<<<<<<< HEAD:views/trd/serie/js/grilla_trd.js
                url: `views/trd/serie/adicionar.php`,
                size: 'modal-xl',
                title: 'Crear',
                params: {
                    sourceTemp: 0
                },
                onSuccess: function (data) {
=======
                url: `views/serie/adicionar.php`,
                params: {
                    sourceTemp: 1
                },
                size: 'modal-xl',
                title: 'Crear',
                onSuccess: function () {
>>>>>>> 42363a8ff886fcd53274440435165a8503b8c422:views/trd/serie/js/grilla_trd_temp.js
                    top.closeTopModal();
                    refreshTable();
                },
                buttons: {
                    success: {
                        label: 'Guardar',
                        class: 'btn btn-complete'
                    },
                    cancel: {
                        label: 'Cancelar',
                        class: 'btn btn-danger'
                    }
                }
            });
        });

        $(document).on('click', '.edit-serie', function () {

            let type = $(this).data('type');
            let id = $(this).data('id');
            let iddep = $(this).data('iddep');
            let name = [];
            name[1] = 'Serie';
            name[2] = 'Subserie';
            name[3] = 'Tipo documental';

            top.topModal({
<<<<<<< HEAD:views/trd/serie/js/grilla_trd.js
                url: `views/trd/serie/editar.php`,
=======
                url: `views/serie_temp/editar.php`,
>>>>>>> 42363a8ff886fcd53274440435165a8503b8c422:views/trd/serie/js/grilla_trd_temp.js
                size: 'modal-xl',
                title: 'Editar ' + name[type],
                params: {
                    idserie: id,
                    iddependencia: iddep,
                },
                onSuccess: function () {
                    top.closeTopModal();
                    refreshTable();
                },
                buttons: {
                    success: {
                        label: 'Guardar',
                        class: 'btn btn-complete'
                    },
                    cancel: {
                        label: 'Cancelar',
                        class: 'btn btn-danger'
                    }
                }
            });
        });
    }

    function createTable() {
<<<<<<< HEAD:views/trd/serie/js/grilla_trd.js
        $('#trd_table').bootstrapTable({
=======
        $('#trd_table_temp').bootstrapTable({
>>>>>>> 42363a8ff886fcd53274440435165a8503b8c422:views/trd/serie/js/grilla_trd_temp.js
            url: `${params.baseUrl}app/trd/serie_version/reporte_trd.php`,
            queryParams: function (queryParams) {
                queryParams = $.extend(queryParams, {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    id: params.id,
<<<<<<< HEAD:views/trd/serie/js/grilla_trd.js
                    type: params.type,
=======
                    type: 'json_trd',
>>>>>>> 42363a8ff886fcd53274440435165a8503b8c422:views/trd/serie/js/grilla_trd_temp.js
                    generateTRD: () => {
                        return $("#generateTRD").val();
                    }
                });
                return queryParams;
            },
            responseHandler: function (response) {
<<<<<<< HEAD:views/trd/serie/js/grilla_trd.js
                $("#generateTRD").val(0);

                if (params.currentVersion == 1 && params.type == 'json_trd') {
=======
>>>>>>> 42363a8ff886fcd53274440435165a8503b8c422:views/trd/serie/js/grilla_trd_temp.js

                $("#generateTRD").val(0);

                for (let index = 0; index < response.rows.length; index++) {
                    let dataParams = {
                        'idserie': response.rows[index].idserie,
                        'idsubserie': response.rows[index].idsubserie,
                        'idtipo': response.rows[index].idtipo,
                        'iddependencia': response.rows[index].iddependencia
                    };
                    response.rows[index].opciones = templateOptions(dataParams);
                }
                return response;
            },
            toolbar: '#toolbar',
            search: true,
            showSearchButton: true,
            showColumns: true,
            icons: {
                search: 'fa fa-search',
                columns: 'fa fa-th-list',
                export: 'fa fa-download'
            },
            classes: 'table table-hover table-bordered mt-0',
            theadClasses: 'thead-light',
            queryParamsType: 'other',
            pagination: true,
            paginationSuccessivelySize: 1,
            paginationPagesBySide: 1,
            filterControl: true,
            showExport: true,
            exportTypes: ['csv', 'txt', 'excel', 'pdf'],
            exportDataType: 'all',
            exportOptions: {
                fileName: 'Borrador TRD',
                jspdf: {
                    orientation: 'l',
                    margins: { left: 10, right: 10, top: 30, bottom: 30 },
                    autotable: {
                        styles: {
                            cellPadding: 2,
                            rowHeight: 20,
                            fontStyle: 'normal',
                            overflow: 'linebreak',
                            valign: 'middle'
                        },
                        tableWidth: 'wrap'
                    }
                }
            },
            columns: trdColumns()
        });

        $(".keep-open").before("<div class='refresh-table btn-group'><button class='btn btn-secondary' title='Actualizar' id='btn_refresh'><i class='fa fa-refresh'></i></button></div>");

        $('#btn_refresh').on('click', function () {
            refreshTable();
        });

        $(".keep-open").before("<div class='refresh-table btn-group'><button class='btn btn-secondary' title='Actualizar' id='btn_refresh'><i class='fa fa-refresh'></i></button></div>");

        $('#btn_refresh').on('click', function () {
            refreshTable();
        });
    }

    function refreshTable() {
        $("#generateTRD").val(1);
        $('#trd_table').bootstrapTable("refresh");
    }

    function refreshTable() {
        $("#generateTRD").val(1);
        $('#trd_table_temp').bootstrapTable("refresh");
    }

    function templateOptions(data) {
        let template = `<div class="dropdown f-20">
            <button class="btn mx-1" 
                type="button" 
                data-toggle="dropdown" 
                aria-haspopup="true" 
                aria-expanded="false"
            >
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="#" target="_self" data-type="1" data-id="${data.idserie}" data-iddep="${data.iddependencia}" class="dropdown-item edit-serie">
                    <i class="fa fa-edit"></i> Editar Serie
                </a>
                <a href="#" target="_self" data-type="2" data-id="${data.idsubserie}" data-iddep="${data.iddependencia}" class="dropdown-item edit-serie">
                <i class="fa fa-edit"></i> Editar Subserie
            </a>
            <a href="#" target="_self" data-type="3" data-id="${data.idtipo}" data-iddep="${data.iddependencia}" class="dropdown-item edit-serie">
            <i class="fa fa-edit"></i> Editar Tipo documental
        </a>
            </div>
        </div>`;
        return template;
    }

    function trdColumns() {
        return [
            [
                {
                    title: 'Códigos',
                    colspan: 3,
                    align: 'center'
                },
                {
                    title: 'Descripción documental',
                    colspan: 3,
                    align: 'center'
                },
                {
                    title: 'Retención',
                    colspan: 2,
                    align: 'center'
                },
                {
                    title: 'Soporte',
                    colspan: 2,
                    align: 'center'
                },
                {
                    title: 'Disposición',
                    colspan: 4,
                    align: 'center'
                },
                {
                    field: 'procedimiento',
                    title: 'Procedimiento',
                    rowspan: 2,
                    align: 'center'
                },
                {
                    field: 'opciones',
                    title: 'Opciones',
                    rowspan: 2,
                    align: 'center'
                }
            ],
            [
                {
                    field: 'dependencia',
                    title: 'Dependencia',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'serie',
                    title: 'Serie',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'subSerie',
                    title: 'SubSerie',
                    filterControl: 'select',
                    align: 'center'
                },
                {
                    field: 'serieDocumental',
                    title: 'Serie Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                {
                    field: 'subSerieDocumental',
                    title: 'SubSerie Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                {
                    field: 'tipoDocumental',
                    title: 'Tipo Documental',
                    filterControl: 'input',
                    align: 'center'
                },
                { field: 'gestion', title: 'Gestion', align: 'center' },
                { field: 'central', title: 'Central', align: 'center' },
                { field: 'p', title: 'P', align: 'center' },
                { field: 'el', title: 'El', align: 'center' },
                { field: 'e', title: 'E', align: 'center' },
                { field: 's', title: 'S', align: 'center' },
                { field: 'ct', title: 'Ct', align: 'center' },
                { field: 'md', title: 'Md', align: 'center' }
            ]
        ];
    }

});
