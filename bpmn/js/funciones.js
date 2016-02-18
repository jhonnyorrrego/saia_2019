$(document).ready(function(){
  $(".usertask").click(function(){
    alert("Abrir pantalla para almacenar las tareas de usuario(Listado de pantallas del sistema )");
  });
  $(".manualtask").click(function(){
    alert("Abrir tareas de usuario (Pantalla para terminar los pasos de forma manual)");
  });
  $(".startevent").click(function(){
    alert("Abrir definicion de inicio de proceso se debe definir un formato que limita todo el proceso");
  });  
  $(".endevent").click(function(){
    alert("Se deben terminar todas las actividades, pasos y demas cosas del paso ");
  });
});