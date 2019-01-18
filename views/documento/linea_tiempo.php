<div class="container-fluid sm-p-l-5 bg-master-lighter ">
    <div class="timeline-container top-circle" id="linea">
    </div>
</div>
<script>
    $(function(){
        let baseUrl = $('script[data-baseurl]').data('baseurl');
        let documentId = "<?= $_REQUEST['identificator'] ?>";

        if(typeof TimeLine == 'undefined'){
            $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/timeLine/timeLine.js`, function(){
                init();
            });
        }else{
            init();
        }

        function init(){
            let options = {
                selector: '#linea',
                baseUrl: baseUrl,
                source: function(callback){
                    let data = new Array();
                    $.ajax({
                        url: `${this.baseUrl}app/documento/trazabilidad.php`,
                        dataType: 'json',
                        type: 'POST',
                        async: false,
                        data: {
                            key: localStorage.getItem('key'),
                            documentId: documentId
                        },
                        success: function(response){
                            if(response.success){
                                data = response.data;
                            }else{
                                top.notification({
                                    message: response.message,
                                    type: 'error',
                                    title: 'Error!'
                                });
                            }
                        }
                    });

                    return data;
                },
                iconClick: function(item){
                    console.log(item);
                }
            };

            let timeLine = new TimeLine(options);
        }
    });
</script>