<?php

class ArbolFt {

    private $cadenas = [
    "loading" => "Cargando...",
    "loadError" => "Error en la carga!",
    "moreData" => "Mas...",
    "noData" => "Sin datos."];

    private $opciones_filtro = [
    "autoApply" => true, // Re-apply last filter if lazy data is loaded
    "autoExpand" => true, // Expand all branches that contain matches while filtered
    "counter" => true, // Show a badge with number of matching child nodes near parent icons
    "fuzzy" => false, // Match single characters in order, e.g. 'fb' will match 'FooBar'
    "hideExpandedCounter" => true, // Hide counter badge if parent is expanded
    "hideExpanders" => false, // Hide expanders if all child nodes are hidden by filter
    "highlight" => true, // Highlight matches by wrapping inside <mark> tags
    "leavesOnly" => false, // Match end nodes only
    "nodata" => true, // Display a 'no data' status node if result is empty
    "mode" => "hide" // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
    ];

    private $opciones = [
    "icon" => false,
    "debugLevel" => 1,
    "autoScroll" => true, // Automatically scroll nodes into visible area.
    "quicksearch" => true, // Navigate to next node by typing the first letters.
    "keyboard" => false, // Support keyboard navigation.
    "selectMode" => 1, // 1: single 2: multi 3: multi-hier
    "clickFolderMode" => 2];

    private $campo;
    private $seleccionados;
    private $fuenteDatos;
    private $opcionesArbol;
    private $extensiones;
    private $con_filtro = false;
    private $con_funcion_select = false;
    private $con_funcion_click = false;
    private $con_funcion_dblclick = false;
    private $html = "";
    private $obligatorio = 0;

    public function __construct($campo, $fuenteDatos, $opcionesArbol = array(), $extensiones = array()) {
        $this -> campo = $campo;
        $this -> fuenteDatos = $fuenteDatos;
        $this -> opcionesArbol = $opcionesArbol;
        $this -> extensiones = $extensiones;
    }

    public function generar_html() {
        $this -> procesar_opciones();
        $this -> crear_arbol();
        return $this -> html;
    }

    private function procesar_opciones() {
        if (empty($this -> opcionesArbol["strings"])) {
            $this -> opcionesArbol["strings"] = $this -> cadenas;
        }
        if (empty($this -> fuenteDatos["params"]["seleccionados"])) {
            $this -> seleccionados = '';
        } else {
            $this -> seleccionados = $this -> fuenteDatos["params"]["seleccionados"];
        }

        $this -> opcionesArbol["source"] = array(
            "url" => $this -> fuenteDatos["ruta_db_superior"] . $this -> fuenteDatos["url"],
            "data" => $this -> fuenteDatos["params"]
        );

        if (isset($this -> opcionesArbol["busqueda_item"]) && $this -> opcionesArbol["busqueda_item"]) {
            $this -> con_filtro = true;
            $opciones_filtro = array();
            if (isset($this -> extensiones["filter"])) {
                if (!empty($this -> extensiones["filter"])) {
                    $opciones_filtro = $this -> extensiones["filter"];
                    $this -> opciones_filtro = array_merge($this -> opciones_filtro, $opciones_filtro);
                } else {
                    $this -> extensiones["filter"] = $this -> opciones_filtro;
                }
            } else {
                $this -> extensiones["filter"] = $this -> opciones_filtro;
            }
            $this -> opcionesArbol["extensions"] = array_keys($this -> extensiones);
            unset($this -> opcionesArbol["busqueda_item"]);
            $this -> opcionesArbol["filter"] = $this -> extensiones["filter"];
        }

        if (empty($this -> opcionesArbol)) {
            $this -> opcionesArbol = $this -> opciones;
        } else {
            $opciones = array_merge($this -> opciones, $this -> opcionesArbol);
            $this -> opcionesArbol = $opciones;
        }

        if (!isset($this -> opcionesArbol["onNodeSelect"])) {
            $this -> opcionesArbol["select"] = "###AquiFuncionSelect###";
        } else {
            $this -> con_funcion_select = $this -> opcionesArbol["onNodeSelect"];
            unset($this -> opcionesArbol["onNodeSelect"]);
        }
        if (isset($this -> opcionesArbol["onNodeClick"])) {
            $this -> con_funcion_click = $this -> opcionesArbol["onNodeClick"];
            unset($this -> opcionesArbol["onNodeClick"]);
        }
        if (isset($this -> opcionesArbol["onNodeDblClick"])) {
            $this -> con_funcion_dblclick = $this -> opcionesArbol["onNodeDblClick"];
            unset($this -> opcionesArbol["onNodeDblClick"]);
        }
        if (isset($this -> opcionesArbol["lazy"])) {
            $this -> opcionesArbol["lazyLoad"] = "###AquiFuncionLazy###";
        }
        if(isset($this->opcionesArbol["obligatorio"])) {
        	$this->obligatorio = $this -> opcionesArbol["obligatorio"];
        }
    }

    private function crear_arbol() {
        if ($this -> con_filtro) {
            $this -> html .= <<<FINHTML
               <p style="font-family: Verdana; font-size: 9px;">
                   <label>Buscar:</label>
                   <input name="stext_{$this->campo}" placeholder="Buscar..." autocomplete="off">
                   <button type="button" id="btnSearch_{$this->campo}">&times;</button>
                   <span id="matches_{$this->campo}"></span>
                </p>
FINHTML;
        }

        $opciones_json = json_encode($this -> opcionesArbol, JSON_NUMERIC_CHECK);
        $cadena_funcion = <<<FINJS
            function(event, data) { // Display list of selected nodes
                var seleccionados = Array();
                var items = data.tree.getSelectedNodes();
                for(var i=0;i<items.length;i++){
                    seleccionados.push(items[i].key);
                }
                var s = seleccionados.join(",");
                $("#{$this->campo}").val(s);
            }
FINJS;
        $funcion_lazy = <<<FINJS
            function(event, data){
              var node = data.node;
              data.result = $.ajax({
                url: "{$this->opcionesArbol["source"]["url"]}",
                data: {
                    cargar_partes: 1,
                    id: node.key
                },
                cache: true
              });
            },
FINJS;
        $opciones_json = preg_replace('/"###AquiFuncionSelect###"/', $cadena_funcion, $opciones_json);
        $opciones_json = preg_replace('/"###AquiFuncionLazy###"/', $funcion_lazy, $opciones_json);
        if($this->obligatorio == 1) {
        	$obligatorio = 'class="required"';
        }
        $this -> html .= <<<FINHTML
        <div id="treebox_{$this->campo}"></div>
        <input type="hidden" {$obligatorio} name="{$this->campo}" id="{$this->campo}" value="{$this -> seleccionados}">
        <script type="text/javascript">
        $(document).ready(function() {
            var configuracion={$opciones_json};
            $("#treebox_{$this->campo}").fancytree(configuracion);
            var tree = $("#treebox_{$this->campo}").fancytree("getTree");
FINHTML;
        if (!empty($this -> con_funcion_select)) {
            $this -> html .= <<<FINHTML
        $("#treebox_{$this->campo}").on("fancytreeselect", {$this->con_funcion_select});

FINHTML;
        }
        if (!empty($this -> con_funcion_click)) {
            $this -> html .= <<<FINHTML
        $("#treebox_{$this->campo}").on("fancytreeclick", {$this->con_funcion_click});

FINHTML;
        }
        if (!empty($this -> con_funcion_dblclick)) {
            $this -> html .= <<<FINHTML
        $("#treebox_{$this->campo}").on("fancytreedblclick", {$this->con_funcion_dblclick});

FINHTML;
        }
        if ($this -> con_filtro) {
            $this -> html .= $this -> funciones_buscador();
        }
        $this -> html .= <<<FINHTML
    });
</script>
FINHTML;
    }

    private function funciones_buscador() {
        $texto = <<<FINHTML
      $("input[name=stext_{$this->campo}]").keyup(function(e){
          var coincidencias = " coincidencias";
          var n,
          opts = {};
          var filterFunc = tree.filterNodes;
          var match = $(this).val();

          opts.mode = "dimm";

          if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
              $("button#btnSearch_{$this->campo}").click();
              return;
          }
          // Pass a string to perform case insensitive matching. Puede pasar un 3er parametro opts
          n = filterFunc.call(tree, match);
          if(n == 1) {
              coincidencias = " coincidencia";
          }
          $("button#btnSearch_{$this->campo}").attr("disabled", false);
          $("span#matches_{$this->campo}").text("(" + n + coincidencias + ")");
      }).focus();

      $("button#btnSearch_{$this->campo}").click(function(e){
          $("input[name=stext_{$this->campo}]").val("");
          $("span#matches_{$this->campo}").text("");
          tree.clearFilter();
      }).attr("disabled", true);

FINHTML;
        return $texto;
    }

}

/*
if (isset($_REQUEST["xml"]) && isset($_REQUEST["campo"])) {
    $parametros = procesar_solicitud();
    $url = parse_url($_REQUEST["xml"]);
    $params_url = array();
    if (isset($url["query"])) {
        $params_url = $url["query"];
    }
    $fuente = array(
        "url" => $url["path"],
        "params" => $params_url,
        "ruta_db_superior" => $parametros["ruta_db_superior"]
    );
    unset($parametros["ruta_db_superior"]);
    $arbol = new ArbolFt($_REQUEST["campo"], $fuente, $parametros);
    echo $arbol -> generar_html();
}

function procesar_solicitud() {
    $parametros = array();
    if ($_REQUEST["xml"] != "" && $_REQUEST["campo"]) {
        $parametros = array(
            "selectMode" => 2,
            "busqueda_item" => 0,
            "onNodeSelect" => "",
            "ruta_db_superior" => "",
            "seleccionar_todos" => ""
        );
        if (isset($_REQUEST["selectMode"])) {
            $parametros["selectMode"] = $_REQUEST["selectMode"];
        }
        if (isset($_REQUEST["onNodeSelect"])) {
            $parametros["onNodeSelect"] = $_REQUEST["onNodeSelect"];
        }
        if (isset($_REQUEST["ruta_db_superior"])) {
            $parametros["ruta_db_superior"] = $_REQUEST["ruta_db_superior"];
        }
        if (isset($_REQUEST["busqueda_item"])) {
            $parametros["busqueda_item"] = $_REQUEST["busqueda_item"];
        }
    }
    return $parametros;
}*/
?>
