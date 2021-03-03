<?php
session_start();
require("../conexiondb.php");

$directorio="../../Imagenes/PRODUCTOS/";
$nombre=$_POST["nombre1"].".jpg";
//echo $nombre;

$archivo= $directorio.basename($_FILES["file1"]["name"]);
$tipoArrchivo=strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

$size=getimagesize($_FILES["file1"]["tmp_name"]);

if ($size!=false) {
	if ($tipoArrchivo=="jpg"|| $tipoArrchivo=="jpeg"|| $tipoArrchivo=="png") {
		if(move_uploaded_file($_FILES["file1"]["tmp_name"], $directorio.$nombre)){
			$sql="UPDATE productos SET NOMBRE='".$_POST["nombre1"]."',CANTIDAD='".$_POST["Cant1"]."'
			,TIPO_PRODUCTO='".$_POST["Tp1"]."',PRECIO='".$_POST["precio1"]."',stock='".$_POST["stock1"]."'
			,MARCA='".$_POST["marca1"]."',MODELO='".$_POST["modelo1"]."',CARACTERISTICAS='".$_POST["carac1"]."' WHERE IDP='".$_POST["IDS1"]."'";

			$sql="UPDATE productos SET NOMBRE='".$_POST["nombre1"]."', CANTIDAD='".$_POST['Cant1']."', TIPO_PRODUCTO='".$_POST['Tp1']."', PRECIO=".$_POST['precio1'].", stock=".$_POST['stock1'].", MARCA='".$_POST['marca1']."', MODELO='".$_POST['modelo1']."', CARACTERISTICAS='".$_POST['carac1']."' WHERE IDP='".$_POST['IDS1']."'";
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

?> 
