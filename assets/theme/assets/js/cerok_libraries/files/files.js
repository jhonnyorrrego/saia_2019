class Files {
    constructor(options) {
        this.options = options;
        this._loadedFiles = [];

        this.init();
    }

    set options(data) {
        this._options = data;
    }

    get options() {
        return this._options;
    }

    init() {
        $(this.options.selector).empty();

        this.createForm();
        this.createTable();
        this.createEvents();
    }

    createForm() {
        let form = `<div class="row">
            <div class="col-6">
                <div id="myDropzone" class="dropzone"></div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <textarea id="file_description" rows="3" class="form-control" placeholder="Descripción del anexo"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-complete float-right" id="upload">Guardar anexos</button>
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
        this._bt = this.getTable().bootstrapTable(this.options.bootstrapTable);
    }

    createEvents() {
        let instance = this;

        let button = document.querySelector;

        $('#upload').on('click', function () {
            if (instance._loadedFiles.length) {
                instance.save($('#file_description').val());
            } else {
                top.notification({
                    type: 'error',
                    message: 'Debe indicar los anexos'
                });
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
}