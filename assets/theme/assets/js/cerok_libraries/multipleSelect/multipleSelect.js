class MultipleSelect {
    constructor(options) {
        options = $.extend({}, MultipleSelect.getDefaultOptions(), options);
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
        if (MultipleSelect.validate(this.options.selector)) {
            $(this.options.selector).empty();

            this.createTemplate();
            this.createEvents();
        }
    }

    createTemplate() {
        let o = this.options;
        let template = `
        <div class="row multiple_select_container" 
            data-id="${o.identificator}">
            <div class="col-12 px-0 country_select_container" 
                data-id="${o.identificator}">
                <div class="form-group form-group-default
                    ${o.required ? 'required' : ''}">
                    <label>${o.countryLabel}</label>
                    <select class="full-width multiple_select" multiple 
                    data-id="${o.identificator}"
                    data-select-type="country"></select>
                </div>
            </div>
            <div class="col-12 px-0 state_select_container" 
                data-id="${o.identificator}">
                <div class="form-group form-group-default
                    ${o.required ? 'required' : ''}">
                    <label>${o.stateLabel}</label>
                    <select class="full-width multiple_select" multiple 
                    data-id="${o.identificator}"
                    data-select-type="state"></select>
                </div>
            </div>
            <div class="col-12 px-0 city_select_container" 
                data-id="${o.identificator}">
                <div class="form-group form-group-default
                    ${o.required ? 'required' : ''}">
                    <label>${o.cityLabel}</label>
                    <select class="full-width multiple_select" multiple 
                    data-id="${o.identificator}"
                    data-select-type="city"></select>
                    <input type="hidden" name="${o.identificator}"
                        ${o.required ? 'required' : ''}>
                </div>
            </div>
        </div>`;

        $(this.options.selector).append(template);
        this.createAutocompletes();
    }

    createAutocompletes() {
        let _this = this;
        let baseUrl = this.options.baseUrl;
        $(`.multiple_select[data-id='${this.options.identificator}']`).select2({
            minimumInputLength: 2,
            language: 'es',
            ajax: {
                url: `${baseUrl}app/localidades/autocompletar.php`,
                dataType: 'json',
                data: function(params) {
                    switch ($(this).data('selectType')) {
                        case 'state':
                            var parentType = 'country';
                            break;
                        case 'city':
                            var parentType = 'state';
                            break;
                        default:
                            var parentType = '';
                            break;
                    }

                    if (parentType) {
                        var parentSelect = $(
                            `[data-select-type='${parentType}'][data-id='${
                                _this.options.identificator
                            }']`
                        );
                        var parentValue = parentSelect.val()[0];
                    }

                    return {
                        term: params.term,
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        selectType: $(this).data('selectType'),
                        parentValue: parentValue || null
                    };
                },
                processResults: function(response) {
                    return response.success ? { results: response.data } : {};
                }
            }
        });

        if (_this.options.defaultValues || _this.options.defaultCity) {
            _this.findDefaultValues(_this.options.defaultCity);
        }
    }

    findDefaultValues(city) {
        let _this = this;
        let baseUrl = this.options.baseUrl;

        $.post(
            `${baseUrl}app/localidades/cargar_ciudad.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                city: city
            },
            function(response) {
                if (response.success) {
                    _this.putValues(response.data);
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            },
            'json'
        );
    }

    putValues(data) {
        if (!+data.country) {
            return true;
        }

        this.defaultValue('country', +data.country);
        if (!+data.state) {
            return true;
        }

        this.defaultValue('state', +data.state);
        if (!+data.city) {
            return true;
        }
        this.defaultValue('city', +data.city);
    }

    defaultValue(selectType, value) {
        let _this = this;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            async: false,
            url: `${_this.options.baseUrl}app/localidades/autocompletar.php`,
            data: {
                defaultValue: value,
                selectType: selectType,
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            success: function(response) {
                if (response.success && response.data) {
                    response.data.forEach(u => {
                        var option = new Option(u.text, u.id, true, true);
                        $(
                            `[data-select-type='${selectType}'][data-id='${
                                _this.options.identificator
                            }']`
                        )
                            .append(option)
                            .trigger('change');
                    });
                }
            }
        });
    }

    createEvents() {
        let _this = this;
        $(`.multiple_select[data-id='${_this.options.identificator}']`)
            .on('select2:selecting', function() {
                $(this)
                    .val(null)
                    .trigger('change');
            })
            .on('change', function() {
                let type = $(this).data('selectType');

                switch (type) {
                    case 'country':
                        $(
                            `[data-select-type='state'][data-id='${
                                _this.options.identificator
                            }']`
                        )
                            .val(null)
                            .trigger('change');

                        $(
                            `.city_select_container[data-id='${
                                _this.options.identificator
                            }']`
                        ).hide();
                        break;
                    case 'state':
                        $(
                            `[data-select-type='city'][data-id='${
                                _this.options.identificator
                            }']`
                        )
                            .val(null)
                            .trigger('change');

                        if ($(this).val().length) {
                            $(
                                `.city_select_container[data-id='${
                                    _this.options.identificator
                                }']`
                            ).show();
                        } else {
                            $(
                                `.city_select_container[data-id='${
                                    _this.options.identificator
                                }']`
                            ).hide();
                        }
                        break;
                    case 'city':
                        let city = $(this).val()[0];
                        $(`[name='${_this.options.identificator}']`).val(city);
                        break;
                }
            });
    }

    static validate(selector) {
        if (typeof $().select2 != 'function') {
            console.error('Debe cargar la libreria select2');
        } else if (!$(selector).length) {
            console.error('no se encuentra el elemento', selector);
        } else {
            return true;
        }
    }

    static getDefaultOptions() {
        return {
            identificator: Math.random() * 10000,
            countryLabel: 'Pais',
            stateLabel: 'Departamento',
            cityLabel: 'Municipio',
            required: false,
            defaultValues: true
        };
    }
}
