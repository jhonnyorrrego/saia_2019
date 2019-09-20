class Files {
    constructor(options) {
        this.options = options;
        this._loadedFiles = [];

        this.init();
    }

    set options(data) {
        this._options = Files.generateOptions(Files.getDefaultOptions(), data);
    }

    get options() {
        return this._options;
    }

    set active(id) {
        this._activeFile = id;
    }

    get active() {
        return this._activeFile || null;
    }

    init() {
        let validate = Files.validate(this.options.selector);

        if (validate) {
            $(this.options.selector).empty();

            this.createForm();
            this.createTable();
            this.createEvents();
        }
    }

    createForm() {
        let form = `<div class="row mx-0">
            <div class="col-12 col-md-6 pl-0">
                <div id="myDropzone" class="dropzone"></div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row pt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea id="file_description" rows="3" class="form-control" placeholder="Descripción del anexo"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-12">
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-complete btn-block" id="upload_file">Guardar anexos</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-danger btn-block hide" id="stop_upload">Cancelar</button>
                        </div>
                    </div>
                </div>                
            </div>
        </div>`;
        $(this.options.selector).append(form);

        this.createDropzone();
    }

    createDropzone() {
        if (!this.options.dropzone.init) {
            let instance = this;
            instance.options.dropzone.init = function () {
                this.on('success', function (file, response) {
                    response = JSON.parse(response);

                    if (response.success) {
                        response.data.forEach(e => {
                            instance._loadedFiles.push(e);
                        });
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        });
                    }
                });
            };
        }
        this._dropzone = new Dropzone('#myDropzone', this.options.dropzone);
    }

    createTable() {
        let table = `<div class="row pt-2">
            <div class="col-12">
                <table id="table_files"></table>
            </div>
        </div>`;
        $(this.options.selector).append(table);

        this.createBootstrapTable();
    }

    createBootstrapTable() {
        this._bootstrapTable = $('#table_files');
        this._bootstrapTable.bootstrapTable(this.options.bootstrapTable);
    }

    createEvents() {
        let instance = this;

        $('#upload_file').on('click', function () {
            if (instance._loadedFiles.length) {
                instance.save($('#file_description').val());
            } else {
                top.notification({
                    type: 'error',
                    message: 'Debe indicar los anexos'
                });
            }
        });

        this.getStopButton().on('click', function () {
            instance.reset();
        });

        $(document).off('click', '.show_options');
        $(document).on('click', '.show_options', function () {
            let parentNode = $(this).parent();
            $.post(
                `${instance.options.baseUrl}app/permisos/permiso_funcionario.php`,
                {
                    key: localStorage.getItem('key'),
                    sourceReference:
                        instance.options.sourceReference || 'TIPO_ANEXO',
                    typeId: $(this).data('id')
                },
                function (response) {
                    if (response.success) {
                        if (!response.data.edit) {
                            parentNode.find('[data-type="upload"]').hide();
                            parentNode.find('[data-type="access"]').hide();
                        } else {
                            parentNode.find('[data-type="upload"]').show();
                            parentNode.find('[data-type="access"]').show();
                        }

                        if (!response.data.delete) {
                            parentNode.find('[data-type="delete"]').hide();
                        } else {
                            parentNode.find('[data-type="delete"]').show();
                        }

                        if (response.data.edit || response.data.delete) {
                            parentNode
                                .find('.file_option')
                                .toggleClass('d-none');
                        } else {
                            top.notification({
                                type: 'info',
                                message:
                                    'Actualmente no tiene permisos sobre este anexo'
                            });
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
        });

        $(document).off('click', '.file_option:not(".show_options")');
        $(document).on(
            'click',
            '.file_option:not(".show_options")',
            function () {
                switch ($(this).data('type')) {
                    case 'upload':
                        instance.upload($(this).data('id'));
                        break;
                    case 'delete':
                        instance.delete($(this).data('id'));
                        break;
                    case 'access':
                        instance.access($(this).data('id'));
                        break;
                    case 'edit':
                        instance.edit($(this).data('id'));
                        break;
                }

                $(this)
                    .parent()
                    .find('.file_option')
                    .toggleClass('d-none');
            }
        );

        instance
            .getTable()
            .on('expand-row.bs.table', function (event, index, row, $detail) {
                if (row.version > 1) {
                    instance.expand(row, $detail);
                } else {
                    $detail.html(
                        '<div class="alert alert-info my-0">No existen versiones para este anexo.</div>'
                    );
                }
            });

        instance
            .getTable()
            .on('click-cell.bs.table', function (
                event,
                field,
                value,
                row,
                $element
            ) {
                if (field == 'etiqueta') {
                    switch (row.extension) {
                        case 'xlsx':
                        case 'docx':
                        case 'pptx':
                            var viewer = 'viewer_kuku.php';
                            var type = instance.options.sourceReference;
                            break;
                        case 'pdf':
                            var viewer = 'viewer_annotate_pdf.php';
                            if (
                                instance.options.sourceReference == 'TIPO_ANEXO'
                            ) {
                                var type = 'TIPO_ANEXO_PDF';
                            } else {
                                var type = 'TIPO_ANEXOS_PDF';
                            }
                            break;
                        default:
                            var viewer = 'viewer_annotate_image.php';
                            if (
                                instance.options.sourceReference == 'TIPO_ANEXO'
                            ) {
                                var type = 'TIPO_ANEXO_IMAGEN';
                            } else {
                                var type = 'TIPO_ANEXOS_IMAGEN';
                            }
                            break;
                    }

                    let url = `${instance.options.baseUrl}views/visor/${viewer}?`;
                    url += $.param({
                        viewer: viewer,
                        type: type,
                        typeId: row.id,
                        key: localStorage.getItem('key')
                    });

                    top.topJsPanel({
                        headerTitle: 'Anexo',
                        contentSize: {
                            width: $(window).width() * 0.8,
                            height: $(window).height() * 0.9
                        },
                        content:
                            '<iframe src="' +
                            url +
                            '" style="width: 100%; height: 100%; border:none;"></iframe>'
                    });
                }
            });
    }

    save(description) {
        if (this.options.save(description, this._loadedFiles, this.active)) {
            this.reset();
            this.getTable().bootstrapTable('refresh');
        } else {
            console.error('error al guardar');
        }
    }

    reset() {
        this.active = 0;
        this._loadedFiles = [];
        $('#file_description').val('');
        this.getStopButton().addClass('hide');
        this.getDropzone().removeAllFiles();
        this.getDropzone().options.maxFiles = this.options.dropzone.maxFiles;
        this.getDropzone().options.dictMaxFilesExceeded = this.options.dropzone.dictMaxFilesExceeded;
    }

    getTable() {
        return this._bootstrapTable;
    }

    getDropzone() {
        return this._dropzone;
    }

    getStopButton() {
        return $('#stop_upload');
    }

    getExpandOptions(row) {
        return Files.generateOptions(
            Files.getExpandDefaultOptions(row),
            this.options.expandBootstrapTable(row)
        );
    }

    static getExpandDefaultOptions(row) {
        return {
            classes: 'table table-sm table-hover mt-0',
            theadClasses: 'thead-light',
            queryParams: function (queryParams) {
                queryParams.sortOrder = 'desc';
                queryParams.fileId = row.id;
                queryParams.key = localStorage.getItem('key');
                return queryParams;
            },
            columns: [
                { field: 'icono', title: '' },
                { field: 'etiqueta', title: 'nombre' },
                { field: 'descripcion', title: 'descripcion' },
                { field: 'version', title: 'version' },
                { field: 'extension', title: 'clase' },
                { field: 'usuario', title: 'responsable' },
                { field: 'fecha', title: 'fecha' },
                { field: 'peso', title: 'tamaño' }
            ]
        };
    }

    static getDefaultOptions() {
        return {
            baseUrl: '',
            selector: '#files_component',
            dropzone: {
                url: `${this.baseUrl}app/temporal/cargar_anexos.php`,
                dictDefaultMessage:
                    'Haga clic para elegir un archivo o Arrastre acá el archivo.',
                maxFilesize: 3,
                maxFiles: 3,
                addRemoveLinks: true,
                dictRemoveFile: 'Eliminar',
                dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
                dictMaxFilesExceeded: 'Máximo 3 archivos',
                params: {
                    token: localStorage.getItem('token'),
                    key: localStorage.getItem('key'),
                    dir: 'dir'
                },
                paramName: 'file'
            },
            bootstrapTable: {
                url: '',
                sidePagination: 'server',
                queryParamsType: 'other',
                queryParams: function (queryParams) {
                    queryParams.key = localStorage.getItem('key');
                    return queryParams;
                },
                pagination: true,
                pageSize: 5,
                classes: 'table table-hover mt-0',
                theadClasses: 'thead-light',
                columns: [
                    { field: 'icono', title: '' },
                    { field: 'etiqueta', title: 'nombre' },
                    { field: 'descripcion', title: 'descripcion' },
                    { field: 'version', title: 'version', align: 'center' },
                    { field: 'extension', title: 'clase', align: 'center' },
                    { field: 'usuario', title: 'responsable' },
                    { field: 'fecha', title: 'fecha', align: 'center' },
                    { field: 'peso', title: 'tamaño', align: 'center' },
                    {
                        field: 'options',
                        title: '',
                        align: 'center',
                        formatter: Files.OptionButttons
                    }
                ],
                detailView: true
            },
            save: function (description, files) {
                console.log(arguments);
            }
        };
    }

    static OptionButttons(value, row, index) {
        return [
            `<span data-id="${row.id}" class="file_option show_options fa fa-chevron-circle-down cursor f-20"><br></span>`,
            `<span data-type="edit" data-id="${row.id}" class="file_option fa fa-edit cursor f-20 d-none"><br></span>`,
            `<span data-type="upload" data-id="${row.id}" class="file_option fa fa-cloud-upload cursor f-20 d-none"><br></span>`,
            `<span data-type="delete" data-id="${row.id}" class="file_option fa fa-trash cursor f-20 d-none"><br></span>`,
            `<span data-type="access" data-id="${row.id}" class="file_option fa fa-lock cursor f-20 d-none"><br></span>`
        ].join('');
    }

    static validate(selector) {
        if (typeof Dropzone == 'undefined') {
            console.error('Debe cargar la libreria Dropzone');
        } else if (typeof $.BootstrapTable == 'undefined') {
            console.error('Debe cargar la libreria bootstrap table');
        } else if (!$(selector).length) {
            console.error('no se encuentra el elemento', selector);
        } else {
            return true;
        }
    }

    static generateOptions(target, ...sources) {
        if (!sources.length) return target;
        const source = sources.shift();

        if (Files.isObject(target) && Files.isObject(source)) {
            for (const key in source) {
                if (Files.isObject(source[key])) {
                    if (!target[key]) {
                        Object.assign(target, { [key]: {} });
                    } else {
                        target[key] = Object.assign({}, target[key]);
                    }
                    Files.generateOptions(target[key], source[key]);
                } else {
                    Object.assign(target, { [key]: source[key] });
                }
            }
        }

        return Files.generateOptions(target, ...sources);
    }

    static isObject(item) {
        return item && typeof item === 'object' && !Array.isArray(item);
    }

    upload(key) {
        this.reset();
        this.active = key;
        this.getDropzone().options.maxFiles = 1;
        this.getDropzone().options.dictMaxFilesExceeded = 'Máximo 1 archivo';
        this.getDropzone().hiddenFileInput.click();
        this.getStopButton().removeClass('hide');
    }

    delete(key) {
        let filesInstance = this;
        top.confirm({
            id: 'question',
            type: 'error',
            title: 'Eliminando!',
            message: 'Está seguro de eliminar este registro?',
            position: 'center',
            timeout: 0,
            buttons: [
                [
                    '<button><b>Si</b></button>',
                    function (instance, toast) {
                        if (filesInstance.options.delete(key)) {
                            instance.hide(
                                { transitionOut: 'fadeOut' },
                                toast,
                                'button'
                            );
                            filesInstance.getTable().bootstrapTable('refresh');
                        }
                    },
                    true
                ],
                [
                    '<button>NO</button>',
                    function (instance, toast) {
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

    access(fileId) {
        top.topModal({
            url: `views/permisos/asignar.php`,
            title: 'Permisos',
            params: {
                type: this.options.sourceReference,
                typeId: fileId
            },
            buttons: {}
        });
    }

    expand(row, element) {
        let options = this.getExpandOptions(row);
        element
            .html('<table></table>')
            .find('table')
            .bootstrapTable(options);
    }

    edit(fileId) {
        let data = this.getTable().bootstrapTable('getData', true);
        let row = data.find(f => f.id == fileId);

        top.topModal({
            url: `views/anexos/editar.php`,
            size: 'modal-sm',
            title: 'Permisos',
            params: {
                type: this.options.sourceReference,
                file: fileId,
                tag: row.etiqueta,
                description: row.descripcion
            }
        });
    }
}
