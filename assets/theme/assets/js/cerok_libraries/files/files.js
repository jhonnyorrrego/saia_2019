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
                            <button class="btn btn-complete" id="upload_file">Guardar anexos</button>
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
                this.on("success", function (file, response) {
                    response = JSON.parse(response);

                    if (response.success) {
                        response.data.forEach(e => {
                            instance._loadedFiles.push(e);
                        });
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        })
                    }
                })
            }
        }
        this._dropzone = new Dropzone("#myDropzone", this.options.dropzone);
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

        $(document).off('click', '.file_option');
        $(document).on('click', '.file_option', function () {
            $(this).parent().find('.file_option').toggleClass('d-none');

            switch ($(this).data('type')) {
                case 'upload':
                    Files.upload($(this).data('id'));
                    break;
                case 'delete':
                    Files.delete($(this).data('id'));
                    break;
                case 'access':
                    Files.access($(this).data('id'));
                    break;
            }
        });
    }

    save(description) {
        this.options.save(description, this._loadedFiles);
        this.reset();
        this.getTable().bootstrapTable('refresh');
    }

    reset() {
        $('#file_description').val('');
        this._loadedFiles = [];
        this.getDropzone().removeAllFiles();
    }

    getTable() {
        return this._bootstrapTable;
    }

    getDropzone() {
        return this._dropzone
    }

    static getDefaultOptions() {
        return {
            baseUrl: '',
            selector: '#files_component',
            dropzone: {
                url: `${this.baseUrl}app/temporal/cargar_anexos.php`,
                dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
                maxFilesize: 3,
                maxFiles: 3,
                dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
                dictMaxFilesExceeded: 'Máximo 3 archivos',
                params: {
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
                classes: 'table table-sm table-hover mt-0',
                theadClasses: 'thead-light',
                columns: [
                    { field: 'icono', title: '' },
                    { field: 'etiqueta', title: 'nombre', editable: { mode: 'inline' } },
                    { field: 'descripcion', title: 'descripcion', editable: { mode: 'inline' } },
                    { field: 'version', title: 'version' },
                    { field: 'extension', title: 'clase' },
                    { field: 'usuario', title: 'responsable' },
                    { field: 'fecha', title: 'fecha' },
                    { field: 'peso', title: 'tamaño' },
                    {
                        field: 'options',
                        title: '',
                        align: 'center',
                        formatter: Files.OptionButttons
                    }
                ],
                onEditableSave: function (field, row, oldValue, $el) {
                    console.log(arguments);
                }
            },
            save: function (description, files) {
                console.log(arguments);
            }
        };
    }

    static OptionButttons(value, row, index) {
        return [
            `<span class="file_option fa fa-chevron-circle-down cursor f-20"><br></span>`,
            `<span data-type="upload" data-id="${row.id}" class="file_option fa fa-cloud-upload cursor f-20 d-none"><br></span>`,
            `<span data-type="delete" data-id="${row.id}" class="file_option fa fa-trash cursor f-20 d-none"><br></span>`,
            `<span data-type="access" data-id="${row.id}" class="file_option fa fa-lock cursor f-20 d-none"><br></span>`,
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
                        target[key] = Object.assign({}, target[key])
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
        return (item && typeof item === 'object' && !Array.isArray(item));
    }
    
    static upload(key) {
        alert(key);
    }
    static delete(key) {
        alert(key);
    }
    static access(key) {
        alert(key);
    }
}