<link rel="stylesheet" type="text/css" href="/nueva_interfaz/saia2.0/asset/css/main.css">
<link rel="stylesheet" type="text/css" href="/nueva_interfaz/saia2.0/asset/css/contenedor.css">
<script>
jQuery(document).ready(function($) {
	$(".subfiltros").hide();
	$(".showFiltersToolbarSaia").mouseover(function(){$(".subfiltros").show();}).mouseout(function(){$(".subfiltros").hide();});
});
</script>
<div class="saia-toolbar">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="1412" height="29" align="left" valign="middle">
        <ul class="saia-toolbar-items">
          <li>
            <a href="#"><img src="/nueva_interfaz/saia2.0/imagenes/toolbar/back.gif" width="16" height="16" border="0" align="absmiddle"> Regresar</a>
          </li>
          <li>
            <a href="#"><img src="/nueva_interfaz/saia2.0/imagenes/toolbar/box.gif" width="16" height="16" border="0" align="absmiddle"> Archivar</a>
          </li>
          <li>
            <a href="#"><img src="/nueva_interfaz/saia2.0/imagenes/toolbar/x.gif" width="16" height="16" border="0" align="absmiddle"> Eliminar</a>
          </li>
          <li>
            <a href="#"><img src="/nueva_interfaz/saia2.0/imagenes/toolbar/reload.gif" width="16" height="16" border="0" align="absmiddle"> Recargar</a>
          </li>
        </ul>
      </td>
      <td width="719" align="right">
        <input type="text" name="basic_search" id="basic_search" class="saia-toolbar-filtro-input">
      </td>
      <td width="150" align="right" nowrap style="padding-right:10px;">
        <ul class="saia-toolbar-filtros">
          <li>
          </li>
          <li class="showFiltersToolbarSaia"><img src="/nueva_interfaz/saia2.0/imagenes/toolbar/btn_filtros.gif" width="61" height="19">
            <ul class="subfiltros">
              <li><label><input name="" type="checkbox" value=""> Vencen mañana</label></li>
              <li><label><input name="" type="checkbox" value=""> Vencen mañana</label></li>
              <li><label><input name="" type="checkbox" value=""> Vencen mañana</label></li>
              <li><label><input name="" type="checkbox" value=""> Vencen mañana</label></li>
              <li><label><input name="" type="checkbox" value=""> Vencen mañana</label></li>
              <li style="text-align:right"><img src="/nueva_interfaz/saia2.0/imagenes/toolbar/btn_avanzada.gif" width="133" height="21"></li>
            </ul>
          </li>
          <li>
            <input type="image" name="imageField" id="imageField" src="/nueva_interfaz/saia2.0/imagenes/toolbar/btn_buscar.gif" onclick="gridReload()">
          </li>
        </ul>
      </td>
    </tr>
  </table>
</div>
<div style="clear:both"></div>
