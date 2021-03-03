<?php
session_start();
require("../conexiondb.php");
$sql="DELETE FROM servicios WHERE ID_Ser=".$_POST['ID'];
$resultado=$base->prepare($sql);
$resp=$resultado->execute();
$sql="DELETE FROM sesiones WHERE ID_serv=".$_POST['ID'];
$resultado=$base->prepare($sql);
$resp=$resultado->execute();
print_r($resp);
?>