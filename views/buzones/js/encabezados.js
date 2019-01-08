$(function(){
    $('#table').on('check.bs.table uncheck.bs.table', function () {
        if ($(this).data('selections').length){
            if ($('#component_actions').is(':hidden')){
                $('#component_actions').show('slide');
            }
        }else{
            $('#component_actions').hide('slide');
        }
    });
});