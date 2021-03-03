<?php
session_start();
require("../conexiondb.php");
$sql="SELECT * FROM sesiones WHERE ID_serv=".$_POST['ID'];
$resultado=$base->prepare($sql);
$resultado->execute();
$Hrs=$resultado->rowCount();
$datos=array(
	"Cantidad"=>$Hrs,
);
$i=1;
//<option value="" disabled selected>Selecione una opcion</option>
while($registro=$resultado->fetch(PDO::FETCH_OBJ)){
	$vard="H".$i;
	$option="'"."<option value='".$registro->ID_HR."'>".$registro->Hora."</option>'";
	array_push($datos, $option);
	$i++;
}

echo  json_encode($datos);
?>