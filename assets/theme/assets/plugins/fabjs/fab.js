function Fab(json) {
    var __element = document.querySelector(json.selector);
    var positions = ['top-left', 'top-right', 'bottom-left', 'bottom-right'],
        countposition = 0;
    if (!json.selector || !__element) {
        console.error(
            "There is no selector or you have not written one, write one in the option 'selector' in the json"
        );
        return false;
    }
    positions.forEach(function(e, i) {
        if (positions[i] != json.position) {
            countposition++;
        }
        if (countposition == 4) {
            __element.classList.add('default');
        }
    });
    __element.classList.add('fab_contenedor');
    __element.classList.add(json.position);
    __element.classList.add(json.direction);

    __element.insertAdjacentHTML(
        'beforeend',
        `<button class='fab primary ${json.button.style}'>
      ${json.button.html}
      <i class='${json.icon.style}'>${json.icon.html}</i>
  	</button>`
    );

    __element.insertAdjacentHTML('afterbegin', `<dl></dl>`);

    Object.values(json.buttons).forEach(function(e, i) {
        __element.querySelector('dl').insertAdjacentHTML(
            'afterbegin',
            `<dt>
                <button
                    id="${e.button.id || Math.random()}"
                    class="fab ${e.button.class} btn${i} 
                        ${!e.button.visible ? 'd-none' : ''}"
                    data-info='${JSON.stringify(e.button.data)}'
                    data-toggle="tooltip"
                    data-placement="bottom"
                    title="${e.button.tooltip || ''}">
                    ${e.button.html}
                    <i class="${e.icon.class}">${e.icon.html}</i>
                </button>
            </dt>`
        );
    });
    var button = __element.querySelectorAll('dl dt button');

    $(json.selector + ' .fab.primary').hover(function() {
        __element.querySelector('dl').classList.add('visible');
        button.forEach(function(e, i) {
            button[i].classList.add('transform');
        });
        $(json.selector).hover(
            function() {},
            function() {
                __element.querySelector('dl').classList.remove('visible');
                button.forEach(function(e, i) {
                    button[i].classList.remove('transform');
                });
            }
        );
    });
}
