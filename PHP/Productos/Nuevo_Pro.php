<?php
session_start();
require("../conexiondb.php");

$directorio="../../Imagenes/PRODUCTOS/";
$nombre=$_POST["nombre"].".jpg";
//echo $nombre;
if (isset($_FILES["file"]["name"])) {
	$archivo= $directorio.basename($_FILES["file"]["name"]);
	$tipoArrchivo=strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

	$size=getimagesize($_FILES["file"]["tmp_name"]);

	if ($size!=false) {
		if ($tipoArrchivo=="jpg"|| $tipoArrchivo=="jpeg"|| $tipoArrchivo=="png") {
			if(move_uploaded_file($_FILES["file"]["tmp_name"], $directorio.$nombre)){
			$sql="INSERT INTO productos(NOMBRE,CANTIDAD,TIPO_PRODUCTO,PRECIO,stock,MARCA,MODELO,CARACTERISTICAS) VALUES (".'"'.$_POST['nombre'].'","'.$_POST['Cant'].'","'.$_POST['tp'].'",'.$_POST['precio'].','.$_POST['stock'].',"'.$_POST['marca'].'","'.$_POST['modelo'].'","'.$_POST['caracteristicas'].'")';

				$resultado=$base->prepare($sql);
				$resp=$resultado->execute();
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
