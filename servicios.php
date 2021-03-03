<?php
include "Vistas/header.php";
require("PHP/conexiondb.php");
$sql="select * from servicios";
$VId=0;
/* preparar los metodos */
$resultado=$base->prepare($sql);
$resultado->execute();
$ban=true;
?>
<!-- iniciar con las consultas -->
<div class="section">
  <h3 class="center teal-text darken-4">Nuestros Servicios</h3>
  <div class="row">
    <div class="col l7 s10 offset-l3 offset-s1">
    </div>
  </div>
</div>
<div class="row">
  <div class="col l2 hide-on-med-and-down">
    <span></span>
  </div>
  <div class="col col l10 s12">
    <p></p>
    <?php  
    while($ban==true){
      if(($registro=$resultado->fetch(PDO::FETCH_OBJ))==true){
        $ides=$registro->ID_Ser;
        $nombre=$registro->nombre;
        $info=$registro->contenido;
        $NSes=$registro->Sesiones;
        ?>
        <div class="col s4 ">         
          <div class="card">
            <div class="card-image  waves-block waves-light">
              <img class="activator" src="Imagenes/SERVDISP/<?php echo $nombre;?>.jpg">
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
              <h5><?php echo $nombre;?></h5>
               <p style='font-weight: bold' class='green-text text-darken-2 flow-textx'>INFORMACIÓN BASICA DEL SERVICIO</p>
              <p class="green-text darken-4">Precio: <span class="black-text">$<?php echo $registro->precio?></span></p>
              <p class="green-text darken-4">Personas por sesion: <span class="black-text"><?php echo $registro->Max_Per ?> personas</span></p>
              <p class="green-text darken-4">Sesiones al día: <span class="black-text"><?php echo $registro->Sesiones ?> sesiones</span></p>
              
            </div>
            <div class="card-action">
              <a class="modal-trigger black-text " href="#<?php echo $nombre;?>">¿Qué es?</a>
              <?php
              if ($adentro==true){
                ?>
                <a onclick="asignarID(<?php echo $ides.",'".$nombre."',".$NSes; ?>)" href="#modalAS" class="modal-trigger right black-text">Apartar</a>
                <?php
              }
              ?>
            </div>
          </div>
        </div>

        <div id="<?php echo $nombre;?>" class="modal">
          <div class="modal-content">
            <h4><?php echo $nombre;?></h4>
            <div class="section container col s6" >

            </div>

            <p><?php echo $info;?></p>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat green">CERRAR</a>
          </div>
        </div>
        <?php
      }else{
        $ban=false;
      }
    }

    $base=NULL;
    ?>
  </div>
</div>
<?php
include "Vistas/formularios.php";
include "Vistas/pie.php";
?>
<div id="modalAS" class="modal">
  <div class="modal-content">
    <h4 id="Serv">Modal Header</h4>
    <h6>Agendar</h6>
    <p></p>
    <div class="row">
      <form id="FormSer" method="POST" onsubmit="return AgendarServicio()">
        <div class="input-field col s12 l6 hide">
          <input placeholder="" id="IDSe" name="IDSe" type="text" class="validate" required>
          <label for="IDSe">ID</label>
        </div>
        <div class="input-field col s12">
          <input placeholder="" id="Fts" name="Fts" type="text" class="validate datepicker" required>
          <label for="Fts">Fecha</label>
        </div>
        <div class="input-field col s12" >
          <select id="selh" name="selh">

          </select>
          <label for="Hrs">Horario</label>
        </div>
        <div class="col s12">
          <br><br>
          <button class="center btn btn-large">Agendar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
  </div>
</div>
<script type="text/javascript">
  $('#ID_Se').addClass("active brown lighten-4");
  $('#ID_Se1').addClass("active brown lighten-4");
  
  $(document).ready(function(){
    $('select').formSelect();
  });

  function AgendarServicio(){
    //Fecha Actual
    var f=new Date(); 
    anio=f.getFullYear();
    mes=f.getMonth();
    dia=f.getDay();
    mes=mes+1;
    //Fecha entrada
    var fecAux=$('#Fts').val();
    anioE=parseInt(fecAux[0]+fecAux[1]+fecAux[2]+fecAux[3]);
    mesE=parseInt(fecAux[5]+fecAux[6]);
    diaE=parseInt(fecAux[8]+fecAux[9]);
    ban=0;
    if (anioE>anio) {
     ban=1;
   }else if (anioE==anio) {
    if (mesE>mes) {
     ban=1;
   }else if (mes==mesE) {
    if (diaE>dia) {
     ban=1;
   }else{
    ban=0;
  }
}else{
  ban=0;
}
}else{
  ban=0;
}
if (ban==0) {
  swal("Por favor ingrese una fecha correcta");
}else{
  if($('#selh').serialize()==""){
    swal("Por favor ingrese un Horario");
  }else{
    $.ajax({
      type:"POST",
      data:$('#FormSer').serialize(),
      url:"PHP/Servicios/Reservar.php",
      success: function(respuesta){
       console.log(respuesta);
       if (respuesta=="Existe") {
        swal("Ya tiene una cita para ese día a esa hora");
      }else if (respuesta=="SN") {
       swal("Lo sentimos ya no hay espacio");
     }else {
       swal("Reservado", "Usted esta inscrito, lo esperamos c:", "success");
       $('#Noti').text(respuesta);
       $('#Noti1').text(respuesta);
     }
   }
 });
  }
}
event.preventDefault();
}
function asignarID (id,nombre,Ns) {
  $('#IDSe').val(id);
  $('#Serv').text(nombre);
  $('#selh').empty();
  $('#selh').append('<option value="" disabled selected>Selecione una opcion</option>');

  $.ajax({
    type: "POST",
    data:"ID="+id,
    url:"PHP/Servicios/ObtenerS.php",
    success: function(respuesta){
      respuesta = jQuery.parseJSON(respuesta);
      for (var i = 0; i < respuesta['Cantidad']; i++) {
        $('#selh').append(respuesta[i]);
      }
      $('select').formSelect();
    }
  });
    //Actualizar
  }
  $(document).ready(function(){
    $('.datepicker').datepicker({format:'yyyy/mm/dd'});
  });
</script>