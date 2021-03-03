<?php
session_start();
require("../conexiondb.php");
$estb="Entregado";
$sql="SELECT * FROM pedido WHERE Estado='Entregado' and ID_Pedido='".$_POST["ID"]."'";
$resultado=$base->prepare($sql);
$resultado->execute();
$NumF=$resultado->rowCount();
if($NumF==1){
	print_r("Ya");
}else{
	$sql="SELECT * FROM pedido WHERE Estado='Pendiente' and ID_Pedido='".$_POST["ID"]."'";
	$resultado=$base->prepare($sql);
	$resultado->execute();
	$NumF2=$resultado->rowCount();
	if ($NumF2==1) {
		print_r("NOS");
	}else{
		$sql="UPDATE pedido SET Estado='".$estb."' WHERE ID_Pedido='".$_POST["ID"]."'";
		$resultado=$base->prepare($sql);
		$resultado->execute();

		$mensaje="Gracias por comprar en Shen Tang centro de terapias alternativas, disfrute sus poductos. ";
		$tipo="Gracias";
		$nt=0;
    //Generar notificacion
		$sqlN="INSERT INTO notificacion (User,Asunto,tipo,estado) VALUES ("."'".$_POST["Nombre"]."','".$mensaje."','".$tipo."',".$nt.")";
		$resultadoN=$base->prepare($sqlN);
		$resp=$resultadoN->execute();
		print_r($resp);
	}
}
?>