<?php
session_start();
require("../conexiondb.php");
$estb="Surtido";
$sql="SELECT * FROM pedido WHERE Estado='Surtido' and ID_Pedido='".$_POST["ID"]."'";
$resultado=$base->prepare($sql);
$resultado->execute();
$NumF=$resultado->rowCount();
if($NumF==1){
	print_r("Ya");
}else{
	$sql="SELECT * FROM pedido WHERE Estado='Entregado' and ID_Pedido='".$_POST["ID"]."'";
	$resultado=$base->prepare($sql);
	$resultado->execute();
	$NumF2=$resultado->rowCount();
	if ($NumF2==1) {
		print_r("YEN");
	}else{
		$sql="UPDATE pedido SET Estado='".$estb."' WHERE ID_Pedido='".$_POST["ID"]."'";
		$resultado=$base->prepare($sql);
		$resultado->execute();

		$mensaje="Tu pedido esta listo, puedes recogerlo en cualquier momento. Gracias por comprar en Shentang";
		$tipo="Pedido listo";
		$nt=0;
    	//Generar notificacion
		$sqlN="INSERT INTO notificacion (User,Asunto,tipo,estado) VALUES ("."'".$_POST["Nombre"]."','".$mensaje."','".$tipo."',".$nt.")";
		$resultadoN=$base->prepare($sqlN);
		$resp=$resultadoN->execute();
		print_r($resp);
	}
}
?>