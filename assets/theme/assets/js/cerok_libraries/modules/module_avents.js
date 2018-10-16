$(function(){
    var modules = new Modules(localStorage.getItem('key'));

    $(document).on('click', '.module_link', function(){
        $("#iframe_workspace").attr('src', $(this).attr('url'));

        let breakpoint = localStorage.getItem('breakpoint');
        
        if(['xs','sm'].indexOf(breakpoint) != -1){
            $('#toggle_sidebar').trigger('click');
        }
    });

    $('#iframe_workspace').on('load', function () {
        $(this).contents().eq(0).click(function () {
            let breakpoint = localStorage.getItem('breakpoint');

            if (['xs', 'sm'].indexOf(breakpoint) != -1) {console.log($('.page-sidebar').hasClass('visible'));
                if ($('.page-sidebar').hasClass('visible')) {
                    $('#toggle_sidebar').trigger('click');
                }

                if ($('#quickview').hasClass('open')) {
                    $('#close_quickview').trigger('click');
                }
            }
        });
    });
});