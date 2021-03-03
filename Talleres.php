<?php
include "Vistas/header.php";
require("PHP/conexiondb.php");
$sql="select * from talleres";
/* preparar los metodos */
$resultado=$base->prepare($sql);
$resultado->execute();
$ban=true;
?>
<!--Seccion 1-->
<div class="section">
  <h3 class="center teal-text darken-4">Nuestros talleres</h3>
  <div class="row">
    <div class="col l7 s10 offset-l3 offset-s1">
    </div>
  </div>
</div>
<!--Fin de seccion 1-->

<!--Seccion 2-->

<?php  
    while($ban==true){
      if(($registro=$resultado->fetch(PDO::FETCH_OBJ))==true){
        $id=$registro->ID;
        $nombre=$registro->NOMBRE;
        $info=$registro->INFO;
        ?>
        <div class="parallax-container">
          <div class="parallax"><img src="Imagenes/talleres/<?php echo $nombre?>.jpg"></div>
        </div>
        <div class="section white">
          <div class="row container">
          <h2 class="header"><?php echo $nombre?></h2>
          <p class="grey-text text-darken-3 lighten-3"><?php echo $info?></p>
        </div>
        </div>
        <?php
      }else{
        $ban=false;
      }
    }

    $base=NULL;
    ?>
<!--Columna media (Contenido)-->

<!--Fin de seccion 1-->


<?php
include "Vistas/formularios.php";
include "Vistas/pie.php";
?>
<script type="text/javascript">
  $('#ID_Ta').addClass("active brown lighten-4");
  $('#ID_Ta1').addClass("active brown lighten-4");
</script>