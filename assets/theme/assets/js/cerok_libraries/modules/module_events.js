$(function(){
    var modules = new Modules(localStorage.getItem('key'));
    var xDown = null;
    var yDown = null;
    
    $(document).on('click', '.module_link', function(){
        $("#iframe_workspace").attr('src', $(this).attr('url'));

        let breakpoint = localStorage.getItem('breakpoint');
        
        if(['xs','sm'].indexOf(breakpoint) != -1){
            $('#toggle_sidebar').trigger('click');
        }
    });

    $(".page-sidebar").on('touchstart', function (evt) {
        xDown = getTouches(evt)[0].clientX;
        yDown = getTouches(evt)[0].clientY;
    });

    $(".page-sidebar").on('touchmove', function (evt) {
        evt.preventDefault();
        
        if (!xDown || !yDown) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if (Math.abs(xDiff) > Math.abs(yDiff)) {/*most significant*/
            if (xDiff > 0) {
                $('#toggle_sidebar').trigger('click');
            } else {
                /** right swipe*/
            }
        } else {
            if (yDiff > 0) {/** up swipe*/} else {/** Dowsn swipe*/}
        }
        /* reset values */
        xDown = null;
        yDown = null;
    });

    function getTouches(evt) {
        return evt.touches || evt.originalEvent.touches;
    }
});