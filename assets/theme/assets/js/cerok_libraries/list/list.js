class List {
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

    set data(data) {
        this._data = data;
    }

    get data() {
        return this._data;
    }

    init() {
        this.data = this.options.source() || [];
        this.createList();
        this.createEvents();
    }

    createList() {
        let list = [];
        this.data.forEach(i => {
            list.push(this.createItem(i));
        });

        let ul = document.createElement('ul');
        ul.classList = 'list-group';
        ul.innerHTML = list.length ? list.join('') : 'Sin registros';

        if (this.options.title) {
            let title = document.createElement('h5');
            title.textContent = this.options.title;
            document.querySelector(this.options.selector).appendChild(title);
        }

        document.querySelector(this.options.selector).appendChild(ul);
    }

    createItem(item) {
        let template = `
            <li class="listItem list-group-item" data-itemid="${item.id}">
                <span class="float-left">${item.label}</span>
                <span class="float-right">${this.generateButtons(
                    item.id
                )}</span>
            </li>
        `;

        return template;
    }

    generateButtons(itemId) {
        let buttons = [];

        this.options.inlineButtons.forEach((b, i) => {
            let template = `<span class="mx-1 cursor f-20 btnListAction${i}" data-item="${itemId}"><i class="${
                b.icon
            }"></i></span>`;
            buttons.push(template);
        });

        return buttons.join('');
    }

    createEvents() {
        this.options.inlineButtons.forEach((b, i) => {
            document.querySelectorAll(`.btnListAction${i}`).forEach(e => {
                let item = this.data.find(
                    i => i.id == e.getAttribute('data-item')
                );
                e.addEventListener('click', function() {
                    b.click(item);
                });
            });
        });
    }
}
