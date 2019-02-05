<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.21/vue.min.js"></script>

<div id="todo-list-example">
  <form v-on:submit.prevent="addNewTodo">
    <label for="new-todo">Add a todo</label>
    <input
      v-model="newTodoText"
      id="new-todo"
      placeholder="E.g. Feed the cat"
    >
    <button>Add</button>
  </form>
  <ul>
    <li
      is="todo-item"
      v-for="(todo, index) in todos"
      v-bind:key="todo.id"
      v-bind:title="todo.title"
      v-on:remove="todos.splice(index, 1)"
    ></li>
  </ul>
</div>
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

	new Vue({
	  el: '#todo-list-example',
	  data: {
	    newTodoText: '',
	    todos: [
	      {
	        id: 1,
	        title: 'Do the dishes',
	      },
	      {
	        id: 2,
	        title: 'Take out the trash',
	      },
	      {
	        id: 3,
	        title: 'Mow the lawn'
	      }
	    ],
	    nextTodoId: 4
	  },
	  methods: {
	    addNewTodo: function () {
	      this.todos.push({
	        id: this.nextTodoId++,
	        title: this.newTodoText
	      })
	      this.newTodoText = ''
	    }
	  }
	})
</script>