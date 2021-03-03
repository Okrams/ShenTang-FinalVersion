<?php
require("../conexiondb.php");
session_start();
$sql="SELECT * FROM detalle_pedido where ID_Pedido=".$_POST['ID'];
$resultado=$base->prepare($sql);
$resultado->execute();
$NumF=$resultado->rowCount();
$datos=array(
	"Num"=>$NumF
);
while($registro=$resultado->fetch(PDO::FETCH_OBJ)){
	//Nombre
	$sqlNP="SELECT * FROM productos where IDP=".$registro->ID_Product;
	$resultadoNP=$base->prepare($sqlNP);
	$resultadoNP->execute();
	$registroNP=$resultadoNP->fetch(PDO::FETCH_OBJ);

	array_push($datos, $registroNP->NOMBRE);
	array_push($datos, $registro->Cantidad);
	array_push($datos, $registro->Subtotal);
}
echo json_encode($datos);
?>