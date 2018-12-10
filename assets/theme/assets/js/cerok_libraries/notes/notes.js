class Notes {
    constructor(iduser) {
        this.baseUrl = Session.getBaseUrl();
        this.user = iduser;
    }

    set baseUrl(route){
        this._baseUrl = route;
    }

    get baseUrl(){
        return this._baseUrl;
    }

    set selected(data) {
        this._selected = data;
    }

    get selected() {
        return this._selected;
    }

    set active(data) {
        this._activeNote = data;
    }

    get active() {
        return this._activeNote;
    }

    set user(iduser) {
        this._user = iduser;
    }

    get user() {
        return this._user;
    }

    set notes(data) {
        this._notes = data;
    }

    get notes() {
        return this._notes;
    }

    getInfoFromActive(){
        return this.notes.find(n => n.idnota_funcionario == this.active);
    }

    list(refresh = 0) {
        if (this.notes && !refresh) {
            return this.createNodes();
        } else {
            return this.findNotes();
        }
    }

    findNotes() {
        const note = this;

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: this.baseUrl + 'app/notas/buscarNotas.php',
            async: false,
            data: { iduser: this.user },
            success: function (response) {
                if (response.success) {
                    note.notes = response.data;
                } else {
                    note.notes = {};
                    toastr.error(response.message, 'Error!');
                }
            }
        });

        return note.list(0);
    }

    createNodes() {
        var elements = [];

        if (this.notes.length) {
            for (const note of this.notes) {
                let fecha = moment(note.fecha, 'YYYY-MM-DD ').format('DD-MM-YYYY');
                elements.push({
                    id: note.idnota_funcionario,
                    node: `<li data-noteid="` + note.idnota_funcionario + `" class="note_item">
                        <div class="left">
                                <div class="checkbox check-warning no-margin" class="label_checkbox_note">
                                    <input id="qncheckbox`+ note.idnota_funcionario + `" type="checkbox" value="` + note.idnota_funcionario + `" class="checkbox_note">
                                    <label for="qncheckbox`+ note.idnota_funcionario + `"></label>
                                </div>
                                <p class="note-preview">`+ note.contenido + `</p>
                        </div>
                        <div class="right pull-right">
                            <span class="date">`+ fecha + `</span>
                            <a href="#" data-navigate="view" data-view-port="#note-views" data-view-animation="push">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </div></li>`
                });
            }
        }

        return elements;
    }

    save(content) {
        let instance = this;

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: this.baseUrl + 'app/notas/guardarNota.php',
            data: {
                id: this.active,
                content: content,
                key: localStorage.getItem('key')
            },
            success: function (response) {
                if (response.success) {
                    instance.active = response.data;
                    instance.refreshList();
                    $("#save_note").attr('disabled', false);
                } else {
                    toastr.error(response.error, 'Error!');
                }
            }
        });
    }

    refreshList() {
        let ids = [];
        let list = this.list(1);

        if (list.length) {
            if ($(".delete-note-link").hasClass('selected')) {
                $(".delete-note-link").trigger('click');
            }

            $('#empty_notes').hide();

            $.each($("#list_note > li"), function (i, element) {
                ids.push($(element).data('noteid'));
            });

            for (const item of list) {
                if ($.inArray(+item.id, ids) == -1) {
                    $("#list_note").prepend(item.node);
                }
            }
        } else {
            $('#empty_notes').show();
        }
    }

    delete(){
        if (this.selected && this.selected.length){
            let instance = this;
            
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: this.baseUrl + 'app/notas/eliminarNota.php',
                data: {
                    ids: this.selected,
                    iduser: instance.user
                },
                success: function (response) {
                    if (response.success) {
                        instance.selected = null;                        
                        instance.refreshList();
                    } else {
                        toastr.error(response.message, 'Error!');
                    }
                }
            });
        }else{
            toastr.info('<span class="bold">Seleccione una tarea</span>', 'Error!');
        }
    }
}