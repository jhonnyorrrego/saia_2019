class Comments {
    constructor (userId, documentId){
        this.user = userId;
        this.document = documentId;
    }

    set baseUrl(route){
        this._baseurl = route
    }

    get baseUrl(){
        return this._baseurl ||
            Session.getBaseUrl() ||
            '';
    }

    set user(userId){
        this._user = userId
    }

    get user(){
        return this._user;
    }

    set document(documentId){
        this._document = documentId
    }

    get document(){
        return this._document;
    }
    
    set comments(data){
        this._comments = data;
    }

    get comments(){
        return this._comments;
    }

    createList(){
        let response = new String();

        if(this.comments){
            if(!this.comments.length){
                response = Comments.noDataFound();
            }else{
                let data = [];
                this.comments.forEach(c => {
                    data.push(Comments.createTemplate(c));
                })

                response = data.join('');
            }
        }else{
            response = this.findByDocument();
        }

        return response;
    }

    findByDocument(){
        let instance = this;
        let ouput = new String();

        $.ajax({
            url: `${this.baseUrl}app/comentarios/documento.php`,
            async: false,
            dataType: 'json',
            data: {
                key: this.user,
                documentId: this.document
            },
            success: function(response){
                if(response.success){
                    instance.comments = response.data;
                    ouput = instance.createList();
                }else{
                    top.notification({
                        message: response.message,
                        type: 'error',
                        title: 'Error!'
                    });
                }
            }
        });

        return ouput;
    }

    static createTemplate(comment){
        let baseUrl = Session.getBaseUrl();
        let key = localStorage.getItem('key');

        if(key !== comment.user.key){
            var template = `<div class="row mx-0 py-1">
                <div class="col-10 px-0 bg-master-lighter" style="border-radius:5px">
                    <div class="media">
                        <img class="align-self-center ml-1 mr-2 rounded-circle" src="${baseUrl + comment.user.image}" style="width:32px;height:32px;">
                        <div class="media-body">
                            <div class="m-0 p-0">
                                <span class="bold">${comment.user.name}</span>
                            </div>
                            <p class="my-2" style="line-height:1">
                                ${comment.comment}
                                <span class="float-right pr-3 hint-text">${comment.temporality}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>`;
        }else{
            var template = `<div class="row mx-0 py-1">
                <div class="offset-2 col-10 px-0 bg-complete-lighter" style="border-radius:5px">
                    <div class="media">
                        <div class="media-body pl-3">
                            <p class="my-2 text-justify" style="line-height:1">
                                ${comment.comment}
                                <span class="float-right pr-3 hint-text">${comment.temporality}</span>
                            </p>
                        </div>
                        <img class="align-self-center ml-1 mr-2 rounded-circle" src="${baseUrl + comment.user.image}" style="width:32px;height:32px;">
                    </div>
                </div>
            </div>`;
        }

        return template;
    }

    static save(comment){
        let baseUrl = Session.getBaseUrl();

        $.post(`${baseUrl}app/comentarios/guardar.php`, comment, function(response){
            if(!response.success){
                top.notification({
                    message: response.message,
                    type: 'error',
                    title: 'Error!'
                });
            }
        }, 'json');
    }

    static noDataFound(){
        return `<div class="row mx-0 py-1">
            <div class="col p-2 bg-complete-lighter" style="border-radius:5px">
                Sin Comentarios.
            </div>
        </div>`;
    }

}