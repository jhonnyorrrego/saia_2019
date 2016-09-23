
<p>
   <input type="text" class="email" value="hola mundo x" style="display:none;">
</p>
<button class="botonCopiar">Copiar</button>

<script>
var boton = document.querySelector('.botonCopiar');
 
boton.addEventListener('click', function(event) {
  // seleccionar el texto de la dirección de email
  var email = document.querySelector('.email');
  var range = document.createRange();
  range.selectNode(email);
  window.getSelection().addRange(range);
 
  try {
    // intentar copiar el contenido seleccionado
    var resultado = document.execCommand('copy');
    console.log(resultado ? 'Email copiado' : 'No se pudo copiar el email');
  } catch(err) {
    console.log('ERROR al intentar copiar el email');
  }
 
  // eliminar el texto seleccionado
  window.getSelection().removeAllRanges();
  // cuando los navegadores lo soporten, habría
  // que utilizar: removeRange(range)
});
</script>


