class Users {
    constructor(options) {
        this.options = options;
        this.init();
    }

    set options(data) {
        this._options = data;
    }

    get options() {
        return this._options;
    }

    init() {
        if (Users.validate(this.options.selector)) {
            $(this.options.selector).empty();

            this.createTemplate();
            this.createEvents();
        }
    }

    createTemplate() {
        let form = `<div class="row">
                <div class="col-12">
                    <div class="radio radio-complete">
                        <input type="radio" id="input_radio_${this.options.identificator}" name="users_radio_${this.options.identificator}" checked="checked">
                        <label for="input_radio_${this.options.identificator}">Seleccionar por usuario</label>
                        <input type="radio" id="tree_radio_${this.options.identificator}" name="users_radio_${this.options.identificator}">
                        <label for="tree_radio_${this.options.identificator}">Seleccionar usuarios por dependencia</label>
                    </div>
                </div>
            </div>
            <div class="row" id="input_container_${this.options.identificator}">
                <div class="col-12">
                    <div class="form-group form-group-default">
                        <label>Puede buscar y elegir a los usuarios</label>
                        <select class="full-width" multiple id="select_${this.options.identificator}"></select>
                    </div>
                </div>
            </div>
            <div class="row" id="tree_container_${this.options.identificator}" style="display:none">
                <div class="col-12 mb-2">
                    <div id="tree_${this.options.identificator}"></div>
                </div>
            </div>`;
        $(this.options.selector).append(form);

        this.createAutocomplete();
        this.createTree();
    }

    createAutocomplete() {
        let baseUrl = this.options.baseUrl;
        $(`#select_${this.options.identificator}`).select2({
            minimumInputLength: 3,
            language: 'es',
            ajax: {
                url: `${baseUrl}app/funcionario/autocompletar.php`,
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term,
                        key: localStorage.getItem('key')
                    }
                },
                processResults: function (response) {
                    return response.success ? { results: response.data } : {};
                }
            }
        });
    }

    createTree() {
        let treeOptions = this.getTreeOptions();
        $(`#tree_${this.options.identificator}`).fancytree(treeOptions);
    }

    createEvents() {
        let identificator = this.options.identificator;
        $(`#input_radio_${identificator}`).on('click', function () {
            $(`#input_container_${identificator}`).show();
            $(`#tree_container_${identificator}`).hide();
        });

        $(`#tree_radio_${identificator}`).on('click', function () {
            $(`#input_container_${identificator}`).hide();
            $(`#tree_container_${identificator}`).show();
        });
    }

    getList() {
        let users = $(`#select_${this.options.identificator}`).val() || [];
        let nodes = $(`#tree_${this.options.identificator}`).fancytree('getTree').getSelectedNodes();

        nodes.forEach(n => {
            users.push(n.key);
        })

        return users;
    }

    setList(users) {
        let options = this.options;

        users.forEach(userId => {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: `${options.baseUrl}app/funcionario/autocompletar.php`,
                data: {
                    key: localStorage.getItem('key'),
                    defaultUser: userId
                },
                success: function (response) {
                    response.data.forEach(u => {
                        var option = new Option(u.text, u.id, true, true);
                        $(`#select_${options.identificator}`).append(option).trigger('change');
                    });
                }
            });
        });
    }

    cleanList() {
        $(`#select_${this.options.identificator}`).val(null).trigger('change');
        let tree = $(`#tree_${this.options.identificator}`).fancytree('getTree');
        let nodes = tree.getSelectedNodes();

        nodes.forEach(e => {
            e.setSelected(false);
        });
    }

    getTreeOptions() {
        return $.extend({},
            Users.getDefaultTreeOptions(this.options.baseUrl),
            this.options.fancytree
        );
    }

    static getDefaultTreeOptions(baseUrl) {
        let params = $.param({
            checkbox: 1,
            idcampofun: 'idfuncionario'
        });
        return {
            selectMode: 3,
            source: {
                url: `${baseUrl}arboles/arbol_funcionario.php?${params}`
            }
        };
    }

    static validate(selector) {
        if (typeof $().fancytree != 'function') {
            console.error('Debe cargar la libreria fancytree');
        } else if (typeof $().select2 != 'function') {
            console.error('Debe cargar la libreria select2');
        } else if (!$(selector).length) {
            console.error('no se encuentra el elemento', selector);
        } else {
            return true;
        }
    }
}
