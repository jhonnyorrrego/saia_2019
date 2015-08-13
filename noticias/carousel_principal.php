 <div class="panel-body">
    <div class="block-nav">
        <div class="summary" id="translate-home-summary">
            <strong>Por favor ingrese el nombre para buscar el carousel de noticias</strong>
        </div>
        <form class="quicksearch" onsubmit="return false;">
            <div class="container rounded-corners">
                <button title="Search" class="head search" id="search"/>
                <input type="text" class="input" id="buscado"/>
                <button title="Reset" class="tail reset" onclick="$(this).prev(':input').val('');" />
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
(function($){
    $('#search').click(function(){
        $('#container').kaiten('load', { kConnector:'html.page', url:'carousel_list.php?numero='+$("#buscado").val(), 'kTitle':'Resultado ', 'kWidth':'250px'});
    //$('#container').kaiten('load', data);
  });
})(jQuery);
</script>   