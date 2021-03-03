<?php
	require("../conexiondb.php");
	session_start();
	//Generar total
	$sql="SELECT ID_Producto,NOMBRE,PRECIO, CantidadP,Subtotal FROM pre_pedido,productos where ID_Producto=IDP and Usuario="."'".$_SESSION["user"]."'";
	$resultado=$base->prepare($sql);
	$resultado->execute();
	$total=0;
	while($registro=$resultado->fetch(PDO::FETCH_OBJ)){
		$total=$total+$registro->Subtotal;
	}
	//Generar pedido
    $estp="Pendiente";
	$sql="INSERT INTO pedido (N_Usuario,Total,Estado) VALUES ("."'".$_SESSION["user"]."',".$total.","."'".$estp."'".")";
	$resul=$base->prepare($sql);
    $resul->execute();
    //Obtenemos el ID ingresado
    $ID_PE=$base->lastInsertId();
    //Generamos el reporte del pedido
    $sql="SELECT ID_Producto,NOMBRE,PRECIO, CantidadP,Subtotal FROM pre_pedido,productos where ID_Producto=IDP and Usuario="."'".$_SESSION["user"]."'";
	$res=$base->prepare($sql);
	$res->execute();
	$newStk=0;
    while($regis=$res->fetch(PDO::FETCH_OBJ)) {
    	$newStk=0;
    	$sql="INSERT INTO detalle_pedido (ID_Pedido,ID_Product,Subtotal,Cantidad) VALUES (".$ID_PE.",".$regis->ID_Producto.",".$regis->Subtotal.",".$regis->CantidadP.")";
    	$resultado=$base->prepare($sql);
    	$resultado->execute();
    	//Actualizar stock
    	//Obtener el stok actual del producto
    	$sqlD="SELECT stock FROM productos WHERE IDP=".$regis->ID_Producto;
    	$exe=$base->prepare($sqlD);
    	$exe->execute();
    	$dt=$exe->fetch(PDO::FETCH_OBJ);
    	$newStk=$dt->stock - $regis->CantidadP;
    	//Actualizar tabla
    	$sqlAc="UPDATE productos SET stock=".$newStk." WHERE IDP=".$regis->ID_Producto;
    	$r=$base->prepare($sqlAc);
    	$r->execute();
    }
    //Eliminar los registros del prepedido
    $sql="DELETE FROM pre_pedido WHERE Usuario="."'".$_SESSION["user"]."'";
    $resultado=$base->prepare($sql);
    $resultado->execute();
    $mensaje="Tu pedido esta en proceso por favor espere la notificacion para poder recoger tus productos Gracias por comprar en Shentang";
    $tipo="Nuevo pedido";
    $nt=0;
    //Generar notificacion
    $sqlN="INSERT INTO notificacion (User,Asunto,tipo,estado) VALUES ("."'".$_SESSION["user"]."','".$mensaje."','".$tipo."',".$nt.")";
    $resultadoN=$base->prepare($sqlN);
    $resultadoN->execute();

    $sql="SELECT * FROM notificacion WHERE estado='0' and  User="."'".$_SESSION["user"]."'";
    $exe=$base->prepare($sql);
    $exe->execute();
    $datosP=$exe->fetch(PDO::FETCH_OBJ);
    $NumN=$exe->rowCount();
    print_r($NumN);
?>