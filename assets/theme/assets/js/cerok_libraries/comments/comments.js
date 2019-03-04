class Comments {
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

    set comments(data) {
        this._comments = data;
    }

    get comments() {
        return this._comments;
    }

    init() {
        document.querySelector(this.options.selector).innerHTML = "";

        if (this.options.order == "asc") {
            this.createList();
            this.createForm();
        } else {
            this.createForm();
            this.createList();
        }
    }

    createEvents() {
        let instance = this;

        let input = document.querySelector("#comment_content");
        let button = document.querySelector("#save_comment");

        input.addEventListener("keyup", function() {
            button.disabled = input.value.length ? false : true;
        });

        button.addEventListener("click", function() {
            instance.save(input.value);
        });
    }

    createForm() {
        if (this.options.showForm) {
            let form = `<div class="row">
                <div class="col">
                    <div class="form-group">
                        <textarea class="form-control" id="comment_content" rows="3" placeholder="${
                            this.options.placeholder
                        }"></textarea>
                    </div>
                </div>
                <div class="col-auto px-0 ">
                    <button class="btn btn-sm btn-complete" id="save_comment" disabled>
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </div>
            </div>`;
            let node = document.querySelector(this.options.selector);
            node.innerHTML = node.innerHTML + form;

            this.createEvents();
        }
    }

    createList() {
        let list = new String();
        this.comments = this.options.source();

        if (!this.comments.length) {
            list = Comments.noDataFound();
        } else {
            list = this.createTemplate();
        }

        if (document.querySelector("#comment_list")) {
            var div = document.querySelector("#comment_list");
        } else {
            var div = document.createElement("div");
            div.setAttribute("id", "comment_list");
        }

        div.innerHTML = list;

        let element = document.querySelector(this.options.selector);
        element.appendChild(div);
        element.scrollTop = element.scrollHeight;
    }

    createTemplate() {
        let data = [];

        this.comments.forEach(c => {
            this.activeComment = c;
            data.push(this.createItem());
        });

        return this.options.order == "desc"
            ? data.reverse().join("")
            : data.join("");
    }

    save(comment) {
        this.activeComment = {
            user: this.options.userData,
            comment: comment,
            temporality: Comments.getTemporality()
        };

        if (this.options.save(this.activeComment)) {
            this.createList();
            Comments.resetForm();
        } else {
            console.error("fail to save");
        }
    }

    createItem() {
        let baseUrl = this.options.baseUrl;
        
        let self = this.options.userData.id == this.activeComment.user.key;
        let response = new String();

        if (self) {
            response = `<div class="row mx-0 py-1">
                <div class="offset-2 col-10 px-0 bg-complete-lighter" style="border-radius:5px">
                    <div class="media">
                        <div class="media-body pl-3">
                            <p class="my-2 text-justify" style="line-height:1">
                                ${this.activeComment.comment}
                                <span class="float-right pr-3 hint-text">${
                                    this.activeComment.temporality
                                }</span>
                            </p>
                        </div>
                        <img class="align-self-center ml-1 mr-2 rounded-circle" src="${baseUrl +
                            this.activeComment.user
                                .image}" style="width:32px;height:32px;">
                    </div>
                </div>
            </div>`;
        } else {
            response = `<div class="row mx-0 py-1">
                <div class="col-10 px-0 bg-master-lighter" style="border-radius:5px">
                    <div class="media">
                        <img class="align-self-center ml-1 mr-2 rounded-circle" src="${baseUrl +
                            this.activeComment.user
                                .image}" style="width:32px;height:32px;">
                        <div class="media-body">
                            <div class="m-0 p-0">
                                <span class="bold">${
                                    this.activeComment.user.name
                                }</span>
                            </div>
                            <p class="my-2" style="line-height:1">
                                ${this.activeComment.comment}
                                <span class="float-right pr-3 hint-text">${
                                    this.activeComment.temporality
                                }</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        return response;
    }

    static noDataFound() {
        return `<div class="row mx-0 py-1">
            <div class="col p-2 bg-complete-lighter" style="border-radius:5px">
                Sin Comentarios.
            </div>
        </div>`;
    }

    static getTemporality() {
        let date = new Date();
        let response = date.getDate() + "-";
        response += date.getMonth() + "-";
        response += date.getFullYear() + " ";
        response +=
            date.getHours() > 12 ? date.getHours() - 12 : date.getHours() + ":";
        response += date.getMinutes() + "-";
        response += date.getHours() - 12 > 0 ? "pm" : "am";

        return response;
    }

    static resetForm() {
        document.querySelector("#comment_content").value = "";
        document
            .querySelector("#comment_content")
            .dispatchEvent(new Event("keyup"));
    }
}
