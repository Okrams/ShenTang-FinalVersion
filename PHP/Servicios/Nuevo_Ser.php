<?php

session_start();
require("../conexiondb.php");


$directorio="../../Imagenes/SERVDISP/";
$nombre=$_POST["nombre"].".jpg";
//echo $nombre;
if (isset($_FILES["file"]["name"])) {
	$archivo= $directorio.basename($_FILES["file"]["name"]);
	$tipoArrchivo=strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

	$size=getimagesize($_FILES["file"]["tmp_name"]);

	if ($size!=false) {
		if ($tipoArrchivo=="jpg"|| $tipoArrchivo=="jpeg"|| $tipoArrchivo=="png") {
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $directorio.$nombre)){
				$sql="INSERT INTO servicios (nombre,contenido,precio,Max_per,Sesiones) VALUES ("
				.'"'.$_POST['nombre'].'","'.$_POST['Cont'].'",'.$_POST['precio'].",".$_POST['MaxP'].",".$_POST['Ses'].")";
				$resultado=$base->prepare($sql);
				$resp1=$resultado->execute();
				$ID_Ser=$base->lastInsertId();
				for ($i=0; $i < $_POST['Ses']; $i++) { 
					$sql="INSERT INTO sesiones (ID_serv,hora) VALUES($ID_Ser,"."'".$_POST['SesN'.$i]."'".")";
					$resultado=$base->prepare($sql);
					$resp=$resultado->execute();
				}
				print_r("Bien");
			}
		}else{
			print_r("PoJ");
		}
	}else{
		print_r("NsI");
	}	
}
?>