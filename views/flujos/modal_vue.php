<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<style>
	[v-cloak] {display: none}
	</style>
	<link rel="stylesheet" href="style.css">
</head>
<style>
  .autocomplete {
    position: relative;
    width: 130px;
  }

  .autocomplete-results {
    padding: 0;
    margin: 0;
    border: 1px solid #eeeeee;
    height: 120px;
    overflow: auto;
  }

  .autocomplete-result {
    list-style: none;
    text-align: left;
    padding: 4px 2px;
    cursor: pointer;
  }

  .autocomplete-result:hover {
    background-color: #4AAE9B;
    color: white;
  }
</style>

<body>

	<div id="app" v-cloak>

		<input v-model="term" id="new-todo" type="search" placeholder="Escriba un nombre">
		<button @click="search">Buscar</button>
	
	
		<ul v-show="isOpen" class="autocomplete-results" >
		    <li
		      v-for="(result, i) in results"
		      :key="result.idfuncionario"
		      @click="setResult(result)"
		      class="autocomplete-result"
		    >
		      {{result.nombres}} {{result.apellidos}} {{result.email}}
		    </li>
		</ul>

		<div v-if="noResults">No se encontraron resultados</div>

		<div v-if="searching">
			<i>Buscando...</i>
		</div>

		<ul>
			<li is="todo-item" 
			v-for="(todo, index) in listado" 
			v-bind:key="todo.id"
			v-bind:title="todo.nombre" 
			v-on:remove="listado.splice(index, 1)"></li>
		</ul>

	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.21/vue.min.js"></script>

<script>

Vue.component('todo-item', {
	  template: '\
	    <li>\
	      {{ title }}\
	      <button v-on:click="$emit(\'remove\')">Remove</button>\
	    </li>\
	  ',
	  props: ['title']
	})

const app = new Vue({
	  el: '#app',
	  data: {
		  term: '',
		  results:[],
		  noResults:false,
		  searching:false,
		  isOpen:false,
		  listado: [],
	    nextTodoId: 4
	  },
	  watch: {
		  term(after, before) {
	            this.search();
	        }
	    },
	  methods: {
			search:function() {
				if(this.term.length < 3) {
					return false;
				}
				this.searching = true;
				this.isOpen = true;
				fetch(`buscar_funcionario.php?termino=${encodeURIComponent(this.term.toLowerCase())}&limit=10`)
				.then((res) => res.json())
				.then((data) => {
					this.searching = false;
					this.results = data;
					this.noResults = this.results.length === 0;
				})
				.catch((err)=>console.error(err));
			},
			setResult: function(result) {
				var obj = {id: result.idfuncionario, nombre: result.nombres + ' ' + result.apellidos, email:result.email};
				this.listado.push(obj);
		        this.term = '';
		        this.isOpen = false;
		      }
	  }
	})
</script>

</body>
</html>