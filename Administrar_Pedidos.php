<?php
include "Vistas/headerAdm.php";

if (isset($_SESSION['user']) and isset( $_SESSION['per'])) {
  ?>
  
  <div class="row" style="margin-top: 3%;margin-bottom: 3%;">
    <div class="col s12 m10 offset-m1">
      
    </div>
    <div class="col s12">
      <div id="Tb_Gest_Pe"></div>
    </div>  
  </div>


  <?php
  include "Vistas/Modal_ped.php";
  include "Vistas/pie_adm.php"; 
}else{
  header("Location: index.php");
}
?>
<script type="text/javascript" src="JS/pedidos.js"></script>
<script >
  document.addEventListener('DOMContentLoaded', function(){
    M.AutoInit();
  });
</script>

<script type="text/javascript">
  $('#ID_Pe').addClass("active brown lighten-4");
  $('#ID_P1').addClass("active brown lighten-4");
  $(document).ready(function(){
      $('#Tb_Gest_Pe').load("Vistas/Gestor/TablaGestorPedidos.php");
    });
</script>