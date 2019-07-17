class TimeLine {
    constructor(options) {
        this.options = options;
        this.init();
    }

    set options(options) {
        this._options = options;
    }

    get options() {
        return this._options;
    }

    set events(events) {
        this._events = events;
    }

    get events() {
        return this._events;
    }

    init() {
        let list = new String();
        this.events = this.options.source();

        if (!this.events.length) {
            list = 'no data found';
        } else {
            list = this.createTemplate();
        }

        var div = document.createElement('section');
        div.setAttribute('class', 'timeline');
        div.innerHTML = list;

        document.querySelector(this.options.selector).appendChild(div);
        this.createEvent();
    }

    createTemplate() {
        let data = [];

        this.events.forEach(e => {
            this.activeItem = e;
            data.push(this.createItem());
        });

        return data.join('');
    }

    createItem() {
        let baseUrl = this.options.baseUrl;
        let showIcon = !this.activeItem.icon ? 'd-none' : '';
        let response = `<div class="timeline-block">
            <div class="timeline-point complete ${showIcon}" 
                data-identificator="${this.activeItem.id}">
                <i class="${this.activeItem.icon}"></i>
            </div>
            <div class="timeline-content">
                <div class="card social-card share full-width">
                    <div class="circle" data-toggle="tooltip" title="Label" data-container="body">
                    </div>
                    <div class="card-header clearfix">
                        <div class="user-pic">
                            <img alt="Profile Image" width="33" height="33"
                                src="${baseUrl + this.activeItem.imgRoute}">
                        </div>
                        <h5 class="my-auto">
                        ${this.activeItem.userName} - ${this.activeItem.title}
                        </h5>
                    </div>
                    <div class="card-description
                        ${!this.activeItem.content ? 'd-none' : ''}">
                        <p>${this.activeItem.content}</p>
                    </div>
                </div>
                <div class="event-date">
                    <small class="fs-12 hint-text">
                        ${this.activeItem.date}
                    </small>
                </div>
            </div>
        </div>`;

        return response;
    }

    createEvent() {
        return true;
        let options = this.options;
        document
            .querySelectorAll(`${this.options.selector} .timeline-point`)
            .forEach(e => {
                let item = this.events.find(
                    i => i.id == e.getAttribute('data-identificator')
                );
                e.addEventListener('click', function() {
                    options.iconClick(item);
                });
            });
    }
}
