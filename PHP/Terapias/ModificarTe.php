<?php

session_start();
require("../conexiondb.php");


$directorio="../../Imagenes/SERVICIOS/";
$nombre=$_POST["nombre1"].".jpg";
//echo $nombre;
if (isset($_FILES["file1"]["name"])) {
	$archivo= $directorio.basename($_FILES["file1"]["name"]);
	$tipoArrchivo=strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

	$size=getimagesize($_FILES["file1"]["tmp_name"]);

	if ($size!=false) {
		if ($tipoArrchivo=="jpg"|| $tipoArrchivo=="jpeg"|| $tipoArrchivo=="png") {
			if(move_uploaded_file($_FILES["file1"]["tmp_name"], $directorio.$nombre)){
				$sql="UPDATE terapias SET NOMBRE='".$_POST["nombre1"]."', INFO='".$_POST["info1"]."', PRECIO='".$_POST["precio1"]."' WHERE ID=".$_POST["IDS"];
				$resultado=$base->prepare($sql);
				$resp=$resultado->execute();
				print_r($resp);
			}
		}else{
			print_r("PoJ");
		}
	}else{
		print_r("NsI");
	}	
}
?>