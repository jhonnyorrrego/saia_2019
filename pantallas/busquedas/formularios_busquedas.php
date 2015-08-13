<form action="procesa_filtro_busqueda.php">
  <table>  
    <tr>    <td>      Nombres:     </td>    <td>      
        <input type="text" name="bqsaia_nombres" value="">    </td>  
    </tr>  
    <tr>    <td>      Apellidos:     </td>    <td>           
        <input type="text" name="bqsaia_apellidos" value="">    </td>     
    </tr>     
    <tr>    
      <td colspan="2">                                                                                          
        <input type="hidden" value="<?php echo($_REQUEST["idbusqueda_componente"]);?>" name="idbusqueda_componente">      
        <input type="hidden" value="1" name="adicionar_consulta">      
        <input type="button" class="btn btn-primary" value="Continuar">    </td>     
    </tr>   
  </table>
</form>