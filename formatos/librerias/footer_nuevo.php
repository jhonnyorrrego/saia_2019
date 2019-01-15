<?php
		if (!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1) :
			if (isset($_REQUEST["vista"]) && $_REQUEST["vista"]) {
				$vista = busca_filtro_tabla("pie_pagina", "vista_formato", "idvista_formato='" . $_REQUEST["vista"] . "'", "", $conn);
				$contenido_pie = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["pie_pagina"] . "'", "", $conn);
				$pie = busca_filtro_tabla("encabezado", $formato[0]["nombre_tabla"], "documento_iddocumento='" . $_REQUEST["iddoc"] . "'", "", $conn);
			} else {
				$contenido_pie = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["pie_pagina"] . "'", "", $conn);
				$pie = busca_filtro_tabla("encabezado", $formato[0]["nombre_tabla"], "documento_iddocumento='" . $_REQUEST["iddoc"] . "'", "", $conn);
			}?>
                    </table>
                </div>
            </div>
            <div class="page_margin_bottom" id="doc_footer">
                <?php if ($pie[0][0] && $contenido_pie["numcampos"]) {
                    echo crear_encabezado_pie_pagina(stripslashes($contenido_pie[0][0]), $_REQUEST["iddoc"], $formato[0]["idformato"]);
                } ?>
            </div>
            </div> <!-- end page-n -->
            </div> <!-- end #documento-->
            </div> <!-- end .container -->
		<?php else : ?>
			</table>
        <?php endif; ?>
	</body>
</html>
