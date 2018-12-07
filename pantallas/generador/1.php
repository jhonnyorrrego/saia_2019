                            $aux2 = [];
                            if ($campos[$h]["valor"] != "") {
                                $parametros = explode("@", $campos[$h]["valor"]);
                                if (is_numeric($parametros[0])) {
                                    $aux2[] = 'min="' . $parametros[0] . '"';
                                }
                                if (is_numeric($parametros[1])) {
                                    $aux2[] = 'max="' . $parametros[1] . '"';
                                }
                                if (is_numeric($parametros[2]))
                                    $aux2[] = 'step="' . $parametros[2] . '"';
                                    if (is_numeric($parametros[3]) && $parametros[3]) {
                                        $aux[] = 'lock:true';
                                    }
                            }
                            if (is_array($aux2)) {
                                $adicionales .= implode(" ", $aux2);
                            }
                            $texto .= '<div class="form-group" id="tr_' . $campos[$h]["nombre"] . '">
                     <label class="etiqueta_campo" title="' . $campos[$h]["ayuda"] . '" for="' . $campos[$h]["nombre"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                     <input class="form-control" ' . " $adicionales $tabindex" . ' type="number" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' value="' . $valor . '">
                    </div></div>';
                            $indice_tabindex++;
                            //$spinner++;
                            break;

