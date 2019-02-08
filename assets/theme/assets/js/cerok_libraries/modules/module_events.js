$(function(){
    let iduser = localStorage.getItem("key");;
    let grouperSelector = "#appMenu";
    let listSelector = "#module_list";
    var xDown = null;
    var yDown = null;
    
    var modules = new Modules(iduser, grouperSelector, listSelector);

    $(document).on('click', '.grouper', function(){    
        let idmodule = $(this).attr('id');
        modules.find(idmodule);

        $('[data-pages-toggle="#appMenu"]').trigger("click");
    });

    $(document).on('click', '.parent_item', function (e) {
        if($(e.target).parent().find('.arrow').length){
            let moduleId = $(this).attr('id');
            let url = $(this).data('url');
            
            modules.find(moduleId, url);
        }
    });

    $(document).on('click', '.module_link', function(){
        $("#iframe_workspace").attr('src', $(this).attr('url'));

        let breakpoint = localStorage.getItem('breakpoint');
        
        if(['xs','sm'].indexOf(breakpoint) != -1){
            $('#toggle_sidebar').trigger('click');
        }
        
        $("#module_list").find('span.bg-institutional').removeClass('bg-institutional');
        $(this).find('span:last').addClass('bg-institutional');
    });

    document.getElementById('iframe_workspace').addEventListener('load', function () {
        let script = $('<script>').append(`$(document).ajaxSend(() => top.window.checkSession());`);
        $(this).contents().find('body').prepend(script)
    });

    $(".page-sidebar").on('touchstart', function (evt) {
        xDown = getTouches(evt)[0].clientX;
        yDown = getTouches(evt)[0].clientY;
    });

    $(".page-sidebar").on('touchmove', function (evt) {
        if (!xDown || !yDown) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if (Math.abs(xDiff) > Math.abs(yDiff)) {/*most significant*/
            if (xDiff > 0) {
                evt.preventDefault();
                setTimeout(() => {
                    $('#toggle_sidebar').trigger('click');
                }, 150);
            } else {
                /* right swipe*/
                return true;
            }
        } else {
            if (yDiff > 0) {
                /* up swipe* return true;*/
            } else {
                /* Dowsn swipe* return true;*/
            }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    });

    function getTouches(evt) {
        return evt.touches || evt.originalEvent.touches;
    }

    let interval = window.setInterval(() => {
        if ($(listSelector).find(".module_link").length){
            $(listSelector).find(".module_link").first().trigger("click");
            clearInterval(interval);
        }
    }, 50);
});