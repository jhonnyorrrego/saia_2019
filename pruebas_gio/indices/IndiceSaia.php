<?php

interface IndiceSaia {
	public function crear_indice(string $tabla, string $campo);

	public function consultar_indice(string $tabla, string $campo);

	public function listar_indices($tabla);

	public function validar_indices($lista_tablas);

}