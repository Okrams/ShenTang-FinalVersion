<?php
session_start();
require("../conexiondb.php");
//Verifica si el usuario ya tiene cita
$sql="SELECT * FROM citas_ser WHERE Fecha="."'".$_POST['Fts']."'"." and ID_Ser=".$_POST['IDSe']." and ID_Hor=".$_POST['selh']." and User="."'".$_SESSION["user"]."'";
$resultado=$base->prepare($sql);
$resultado->execute();
$Existe=$resultado->rowCount();
if ($Existe==1) {
	print_r("Existe");
}else{
	//Cuantas reservas hay ese día
	$sql="SELECT * FROM citas_ser WHERE Fecha="."'".$_POST['Fts']."'"." and ID_Ser=".$_POST['IDSe']." and ID_Hor=".$_POST['selh'];
	$resultado=$base->prepare($sql);
	$resultado->execute();
	$NumRs=$resultado->rowCount();
	//Cuantos personas pueden tomar ese servicio
	$sql="SELECT Max_per,nombre FROM servicios WHERE ID_Ser=".$_POST['IDSe'];
	$resultado=$base->prepare($sql);
	$resultado->execute();
	$registro=$resultado->fetch(PDO::FETCH_OBJ);
	//Verifica si hay cupo
	if($NumRs<=$registro->Max_per){
		//Hace la reserva
		$sql="INSERT INTO citas_ser (User,Fecha,ID_Ser,ID_Hor) VALUES
		("."'".$_SESSION["user"]."',"."'".$_POST['Fts']."',".$_POST['IDSe'].",".$_POST['selh'].")";
		$resultado=$base->prepare($sql);
		$resp=$resultado->execute();
		//Ver hora de servicio
		$sqlH="SELECT Hora FROM sesiones WHERE ID_HR=".$_POST['selh'];
		$resultadoH=$base->prepare($sqlH);
		$resultadoH->execute();
		$registroH=$resultadoH->fetch(PDO::FETCH_OBJ);
		//Envia Notificacion
		$mensaje="Gracias por inscribirte, te esperamos el día ".$_POST['Fts']." de ".$registroH->Hora." para el servicio de ".$registro->nombre."";
		$tipo="Inscripcion de servicio";
		$nt=0;
		//Inserta la notificacion
		$sqlN="INSERT INTO notificacion (User,Asunto,tipo,estado) VALUES ("."'".$_SESSION["user"]."','".$mensaje."','".$tipo."',".$nt.")";
		$resultadoN=$base->prepare($sqlN);
		$resultadoN->execute();
		//Actualiza las notificaciones
		$sql="SELECT * FROM notificacion WHERE estado='0' and  User="."'".$_SESSION["user"]."'";
		$exe=$base->prepare($sql);
		$exe->execute();
		$datosP=$exe->fetch(PDO::FETCH_OBJ);
		$NumN=$exe->rowCount();
		print_r($NumN);
	}else{
		print_r("SN");
	}
}
?>